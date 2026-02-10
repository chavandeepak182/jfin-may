<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyBooking;
use App\Models\PropertyBookingItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;

class CustomerBookingController extends Controller
{
    /* ===========================
       CUSTOMER – CREATE BOOKING
    ============================*/
    public function store(Request $request)
    {
        if (auth()->user()->role_id != config('constants.roles.customer')) {
            abort(403);
        }

        $request->validate([
            'property_id' => 'required|exists:properties,properties_id'
        ]);

        DB::transaction(function () use ($request) {

            $booking = PropertyBooking::create([
                'customer_id' => auth()->id(),
                'status' => 'pending_admin_review',
            ]);

            PropertyBookingItem::create([
                'property_booking_id' => $booking->id,
                'property_id' => $request->property_id
            ]);

            auth()->user()->update(['is_property_applied' => 1]);
        });

        return back()->with('success', 'Property booking request submitted');
    }

    /* ===========================
       ADMIN – REVIEW & COMMISSION
    ============================*/
   public function adminIndex()
{
    if (auth()->user()->role_id != config('constants.roles.admin')) {
        abort(403);
    }

    $bookings = PropertyBooking::with([
            'customer',
            'items.property'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.property-bookings.index', compact('bookings'));
}
    public function adminReview(Request $request, $id)
    {
        $request->validate([
            'agreement_cost'        => 'required|numeric|min:1',
            'commission_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $booking = PropertyBooking::findOrFail($id);

        $actualCommission =
            $request->agreement_cost *
            ($request->commission_percentage / 100);

        $booking->update([
            'admin_id' => auth()->id(),
            'agreement_cost' => $request->agreement_cost,
            'commission_percentage' => $request->commission_percentage,
            'actual_commission' => $actualCommission,
        ]);

        return back()->with('success', 'Commission details saved');
    }
    public function adminView($id)
{
    if (auth()->user()->role_id != config('constants.roles.admin')) {
        abort(403);
    }

    $booking = PropertyBooking::with([
            'customer',
            'items.property'
        ])->findOrFail($id);

    return view('admin.property-bookings.view', compact('booking'));
}
    /* ===========================
       ADMIN – OFFER SUBMIT
    ============================*/
public function adminOffer(Request $request, $id)
{
    if (auth()->user()->role_id != config('constants.roles.admin')) {
        abort(403);
    }

    $request->validate([
        'agreement_cost'        => 'required|numeric|min:1',
        'commission_percentage' => 'required|numeric|min:0|max:100',

        'tds_percentage' => 'required|numeric|min:0|max:100',
        'gst_percentage' => 'required|numeric|min:0|max:100',
        'mlm_amount'     => 'required|numeric|min:0',

        'offers'   => 'nullable|array',
        'offers.*' => 'required|string|max:255',
    ]);

    $booking = PropertyBooking::findOrFail($id);

    /* =====================
       CALCULATIONS
    ====================== */

    $actualCommission = $request->agreement_cost *
        ($request->commission_percentage / 100);

    $tdsAmount = $actualCommission * ($request->tds_percentage / 100);
    $gstAmount = $actualCommission * ($request->gst_percentage / 100);

    $netCommission = $actualCommission - $tdsAmount - $gstAmount;

    $remainingAfterMlm = $netCommission - $request->mlm_amount;

    if ($remainingAfterMlm < 0) {
        throw new \Exception('MLM amount exceeds commission');
    }

    $offerPool   = $remainingAfterMlm / 2;
    $companyShare = $remainingAfterMlm / 2;

    /* =====================
       BUILD OFFERS
    ====================== */

    $offers = [];

    if ($request->offers) {
        foreach ($request->offers as $label) {
            $offers[] = [
                'label'  => $label,
                'amount' => $offerPool,
            ];
        }
    }

    /* =====================
       SAVE
    ====================== */

    $booking->update([
        'agreement_cost'        => $request->agreement_cost,
        'commission_percentage' => $request->commission_percentage,

        'tds_percentage' => $request->tds_percentage,
        'gst_percentage' => $request->gst_percentage,

        'actual_commission' => $actualCommission,
        'tds_amount'        => $tdsAmount,
        'gst_amount'        => $gstAmount,

        'net_commission' => $netCommission,
        'mlm_amount'     => $request->mlm_amount,

        'offer_pool'        => $offerPool,
        'final_commission'  => $companyShare,

        'offers' => !empty($offers) ? json_encode($offers) : null,

        'status' => !empty($offers)
            ? 'waiting_customer_confirmation'
            : 'completed',
    ]);

    return redirect()
        ->route('admin.property.bookings')
        ->with('success', 'Offer saved and sent to customer');
}



    /* ===========================
       CUSTOMER – CONFIRM OFFER
    ============================*/
  public function customerBookings()
{
    $bookings = PropertyBooking::with('items.property')
        ->where('customer_id', auth()->id())
        ->orderBy('created_at','desc')
        ->get();

    return view('customer.bookings.index', compact('bookings'));
}
   public function customerConfirm(Request $request, $id)
{
    $request->validate([
        'selected_offer' => 'required|in:cashback,furniture'
    ]);

    $booking = PropertyBooking::where('id',$id)
        ->where('customer_id',auth()->id())
        ->firstOrFail();

    $booking->update([
        'selected_offer' => $request->selected_offer,
        'status' => 'customer_confirmed'
    ]);

    return redirect()->back()->with('success','Offer confirmed');
}

    /* ===========================
       ADMIN – FINAL SUBMIT
    ============================*/
  public function adminFinalSubmit($id)
{
    if (auth()->user()->role_id != config('constants.roles.admin')) {
        abort(403);
    }

    DB::transaction(function () use ($id) {

        $booking = PropertyBooking::with('customer')->findOrFail($id);

        if ($booking->status !== 'customer_confirmed') {
            throw new \Exception('Booking not ready for final submit');
        }

        $customer = $booking->customer;

        $categoryController = app(\App\Http\Controllers\CategoryController::class);

        /* =========================
           ADD USER TO MLM (ONCE)
        ========================= */

        $alreadyInMlm = DB::table('categories')
            ->where('user_id', $customer->id)
            ->exists();

        if (!$alreadyInMlm) {

            $categoryController->store(
                new \Illuminate\Http\Request([
                    'parent_user_id' => $customer->refer_user_id ?? null,
                    'user_id'        => $customer->id,
                    'category'       => $customer->name,
                ])
            );
        }

        /* =========================
           DISTRIBUTE MLM AMOUNT
           (EVERY BOOKING)
        ========================= */

        $categoryController->distributeMlmAmount(
            $customer->id,
            $booking->mlm_amount
        );

        /* =========================
           COMPLETE BOOKING
        ========================= */

        $booking->update([
            'status' => 'completed'
        ]);
    });

    return redirect()
        ->route('admin.property.bookings')
        ->with('success', 'Booking finalized successfully');
}


public function showConfirmOffer($id)
{
    \Log::info('CUSTOMER CONFIRM PAGE HIT', [
        'booking_id' => $id,
        'auth_id' => auth()->id(),
        'role_id' => auth()->user()->role_id
    ]);

    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $booking = PropertyBooking::with(['items.property'])
        ->where('id', $id)
        ->where('customer_id', auth()->id())
        ->firstOrFail(); // ❗ no status filter

    return view('customer.booking-confirm', compact('booking'));
}



//     public function showProperties()
// {
//     // Ensure only customer accesses this
//     if (auth()->user()->role_id != config('constants.roles.customer')) {
//         abort(403);
//     }

//     $properties = Property::active()
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return view('customer.properties.index', compact('properties'));
// }

public function showProperties(Request $request)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $query = Property::active();

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('builder_name', 'like', '%' . $request->search . '%')
              ->orWhere('title', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%')
              ->orWhere('s_price', 'like', '%' . $request->search . '%');
        });
    }

    $properties = $query->orderBy('created_at', 'desc')->get();

    return view('customer.properties.index', compact('properties'));
}

public function showBookingForm($id)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $property = Property::where('properties_id', $id)->firstOrFail();
    $customer = auth()->user();

    return view('customer.property-book-form', compact('property','customer'));
}
public function submitBookingForm(Request $request)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $request->validate([
        'property_id' => 'required|exists:properties,properties_id',

        'customer_name'   => 'required|string|max:255',
        'customer_email'  => 'required|email',
        'customer_mobile' => 'required|string|max:20',

        'co_name' => 'nullable|string|max:255',
        'co_email' => 'nullable|email',
        'co_mobile' => 'nullable|string|max:20',
        'co_employment_type' => 'nullable|in:salaried,self_employed',
        'co_designation' => 'nullable|string|max:255',
        'co_gender' => 'nullable|in:male,female,other',
        'co_marital_status' => 'nullable|in:single,married',
    ]);

    DB::transaction(function () use ($request) {

        $booking = PropertyBooking::create([
            'customer_id' => auth()->id(),
            'status'      => 'pending_admin_review',

            // customer snapshot
            'customer_name'   => $request->customer_name,
            'customer_email'  => $request->customer_email,
            'customer_mobile' => $request->customer_mobile,
            'customer_pan'    => $request->customer_pan,

            // co-applicant
            'co_name' => $request->co_name,
            'co_email' => $request->co_email,
            'co_mobile' => $request->co_mobile,
            'co_employment_type' => $request->co_employment_type,
            'co_designation' => $request->co_designation,
            'co_gender' => $request->co_gender,
            'co_marital_status' => $request->co_marital_status,
        ]);

        PropertyBookingItem::create([
            'property_booking_id' => $booking->id,
            'property_id' => $request->property_id
        ]);
    });

    return redirect()
        ->route('customer.bookings')
        ->with('success','Property booking submitted successfully');
}
}
