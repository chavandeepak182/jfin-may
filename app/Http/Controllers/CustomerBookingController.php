<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyBooking;
use App\Models\PropertyBookingItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Models\PropertyController;


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

    $validated = $request->validate([
        'agreement_cost'        => 'required|numeric|min:1',
        'commission_percentage' => 'required|numeric|min:0|max:100',
        'tds_percentage'        => 'required|numeric|min:0|max:100',
        'gst_percentage'        => 'required|numeric|min:0|max:100',
        'mlm_amount'            => 'required|numeric|min:0',

        'offers' => 'nullable|array',
        'offers.*.label' => 'required|string|max:255',
        'offers.*.amount' => 'required|numeric|min:0',
        'offers.*.items' => 'nullable|array',
        'offers.*.items.*.label' => 'required|string|max:255',
        'offers.*.items.*.amount' => 'required|numeric|min:0',
    ]);

    $booking = PropertyBooking::findOrFail($id);

    /* ================= CALCULATION ================= */

    $actualCommission = $request->agreement_cost *
        ($request->commission_percentage / 100);

    $tdsAmount = $actualCommission * ($request->tds_percentage / 100);
    $gstAmount = $actualCommission * ($request->gst_percentage / 100);

    $netCommission = $actualCommission - $tdsAmount - $gstAmount;

    $offerPool = $netCommission / 2;
    $companyShare = $netCommission / 2;

    $finalOfferPool = $offerPool - $request->mlm_amount;

    if ($finalOfferPool < 0) {
        return back()->withErrors('MLM amount exceeds offer pool');
    }

    /* ================= BUILD OFFERS ================= */

    $offers = [];

    if ($request->offers) {

        foreach ($request->offers as $mainOffer) {

            $subTotal = 0;
            $items = [];

            if (!empty($mainOffer['items'])) {

                foreach ($mainOffer['items'] as $sub) {
                    $subTotal += $sub['amount'];

                    $items[] = [
                        'label'  => $sub['label'],
                        'amount' => $sub['amount'],
                    ];
                }

                if ($subTotal != $mainOffer['amount']) {
                    return back()->withErrors(
                        'Sub items total must equal main offer amount'
                    );
                }
            }

            $offers[] = [
                'label'  => $mainOffer['label'],
                'amount' => $mainOffer['amount'],
                'items'  => $items
            ];
        }
    }

    /* ================= SAVE ================= */

    $booking->update([
        'agreement_cost'        => $request->agreement_cost,
        'commission_percentage' => $request->commission_percentage,
        'tds_percentage'        => $request->tds_percentage,
        'gst_percentage'        => $request->gst_percentage,

        'actual_commission' => $actualCommission,
        'tds_amount'        => $tdsAmount,
        'gst_amount'        => $gstAmount,
        'net_commission'    => $netCommission,

        'mlm_amount'        => $request->mlm_amount,

        'offer_pool'        => $finalOfferPool,
        'final_commission'  => $companyShare,

        'offers' => !empty($offers) ? json_encode($offers) : null,

        'status' => !empty($offers)
            ? 'waiting_customer_confirmation'
            : 'completed',
    ]);

    return redirect()
        ->route('admin.property.bookings')
        ->with('success', 'Offer sent to customer');
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
    \Log::info('CUSTOMER CONFIRM HIT', [
        'booking_id' => $id,
        'auth_id' => auth()->id(),
        'input' => $request->all()
    ]);

    try {

        /* =========================
           VALIDATION
        ========================== */
        $validated = $request->validate([
            'selected_items' => 'required|array',
            'selected_items.*.label' => 'required|string',
            'selected_items.*.amount' => 'required|numeric|min:0',
        ]);

        \Log::info('VALIDATION PASSED');

        /* =========================
           FETCH BOOKING
        ========================== */
        $booking = PropertyBooking::where('id', $id)
            ->where('customer_id', auth()->id())
            ->where('status', 'waiting_customer_confirmation')
            ->first();

        if (!$booking) {
            \Log::error('BOOKING NOT FOUND OR STATUS INVALID');
            return back()->withErrors('Booking not found or already confirmed.');
        }

        \Log::info('BOOKING FOUND', [
            'status' => $booking->status,
            'offer_pool' => $booking->offer_pool
        ]);

        /* =========================
           CALCULATE TOTAL
        ========================== */
        $total = 0;

        foreach ($request->selected_items as $item) {
            $total += $item['amount'];
        }

        \Log::info('TOTAL CALCULATED', [
            'selected_total' => $total,
            'expected_total' => $booking->offer_pool
        ]);

        if (round($total, 2) != round($booking->offer_pool, 2)) {

            \Log::error('TOTAL MISMATCH');

            return back()->withErrors(
                'Selected total must equal ₹ ' . $booking->offer_pool
            );
        }

        /* =========================
           UPDATE BOOKING
        ========================== */
        $booking->update([
            'selected_offer' => json_encode($request->selected_items),
            'status' => 'customer_confirmed'
        ]);

        \Log::info('BOOKING UPDATED SUCCESSFULLY');

        return redirect()
            ->route('customer.bookings')
            ->with('success', 'Offer confirmed successfully');

    } catch (\Exception $e) {

        \Log::error('CUSTOMER CONFIRM ERROR', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);

        return back()->withErrors('Something went wrong.');
    }
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
        ->where('status','waiting_customer_confirmation')
        ->firstOrFail();

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

    // $query = Property::active();
    $query = Property::with('category')->active();

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('builder_name', 'like', '%' . $request->search . '%')
              ->orWhere('title', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%')
              ->orWhere('s_price', 'like', '%' . $request->search . '%');
        });
    }

    $properties = $query->orderBy('created_at', 'desc')->get();
        // ✅ Correct Line
    $categories = DB::table('property_category')->get();



    return view('customer.properties.index', compact('properties','categories'));
}

public function showBookingForm($id)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $property = Property::where('properties_id', $id)->firstOrFail();
    $customer = auth()->user();
    $profile = DB::table('profile')
                ->where('user_id', $customer->id)
                ->first();

    return view('customer.property-book-form', compact('property','customer','profile'));
}
public function submitBookingForm(Request $request)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    // $request->validate([
    //     'property_id' => 'required|exists:properties,properties_id',

    //     'customer_name'   => 'required|string|max:255',
    //     'customer_email'  => 'required|email',
    //     'customer_mobile' => 'required|string|max:20',

    //     'co_name' => 'nullable|string|max:255',
    //     'co_email' => 'nullable|email',
    //     'co_mobile' => 'nullable|string|max:20',
    //     'co_employment_type' => 'nullable|in:salaried,self_employed',
    //     'co_designation' => 'nullable|string|max:255',
    //     'co_gender' => 'nullable|in:male,female,other',
    //     'co_marital_status' => 'nullable|in:single,married',
    // ]);
$request->validate([
    'property_id' => 'required|exists:properties,properties_id',

    // CUSTOMER
    'customer_name'   => ['required','regex:/^[A-Za-z ]+$/','max:255'],
    'customer_email'  => 'required|email|max:255',
    'customer_mobile' => 'required|digits:10',
    'customer_pan'    => ['nullable','regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],

    // CO-APPLICANT
    'co_name'         => ['nullable','regex:/^[A-Za-z ]+$/','max:255'],
    'co_email'        => 'nullable|email|max:255',
    'co_mobile'       => 'nullable|digits:10',
    'co_employment_type' => 'nullable|in:salaried,self-employed,business,professional',
    'co_designation'  => 'nullable|string|max:255',
    'co_gender'       => 'nullable|in:male,female,other',
    'co_marital_status' => 'nullable|in:single,married,divorced,widowed',
]);
    DB::transaction(function () use ($request) {

        $user = auth()->user();

        // fetch PAN from profile table
        $profile = DB::table('profile')
            ->where('user_id', $user->id)
            ->first();

        $booking = PropertyBooking::create([
            'customer_id' => $user->id,
            'status'      => 'pending_admin_review',

            // customer snapshot from DB (not from form)
            'customer_name'   => $user->name,
            'customer_email'  => $user->email_id,
            'customer_mobile' => $user->mobile_no,
            'customer_pan'    => $profile->pan_number ?? null,

            // co-applicant from form
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
