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
        'offers.*.items.*.description' => 'nullable|string',
        'mlm_amount'            => 'required|numeric|min:0',

        'offers' => 'nullable|array',
        'offers.*.label' => 'required|string|max:255',
        'offers.*.amount' => 'required|numeric|min:0',
        'offers.*.items' => 'nullable|array',
        'offers.*.items.*.label' => 'required|string|max:255',
        
'offers.*.items.*.image' => 'nullable|string',
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
    'label'       => $sub['label'],
    'description' => $sub['description'] ?? null,
    'image'       => $sub['image'] ?? null,
    'amount'      => $sub['amount'],
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
// public function customerConfirm(Request $request, $id)
// {
//   $validated = $request->validate([
//     'selected_items' => 'nullable|array', // ✅ change this
//     'selected_items.*.label' => 'required|string',
//     'selected_items.*.amount' => 'required|numeric|min:0',
//     'selected_items.*.description' => 'nullable|string',
//     'selected_items.*.image' => 'nullable|string',
// ]);
//     $booking = PropertyBooking::where('id', $id)
//         ->where('customer_id', auth()->id())
//         ->firstOrFail();

//     if ($booking->status !== 'waiting_customer_confirmation') {
//         return redirect()
//             ->route('customer.bookings')
//             ->with('error', 'Offer already confirmed.');
//     }

//     // Calculate total selected
//     $total = collect($request->selected_items)->sum(function ($item) {
//         return floatval($item['amount']);
//     });

//     if ($total > $booking->offer_pool) {
//         return back()->withErrors(
//             'Selected amount cannot exceed ₹ ' . $booking->offer_pool
//         );
//     }

//     $remaining = $booking->offer_pool - $total;

//     // Clean selected items
//     $selectedItems = collect($request->selected_items)
//         ->filter(function ($item) {
//             return floatval($item['amount']) > 0;
//         })
//       ->map(function ($item) {
//     return [
//         'label' => $item['label'],
//         'amount' => floatval($item['amount']),
//         'description' => $item['description'] ?? null,
//         'image' => $item['image'] ?? null
//     ];
// })
//         ->values()
//         ->toArray();

//     // Add cashback if remaining
//     if ($remaining > 0) {
//         $selectedItems[] = [
//             'label' => 'Cashback',
//             'amount' => $remaining,
//             'description' => 'Remaining cashback amount',
//             'image' => null
//         ];
//     }

//     $booking->update([
//         'selected_offer' => json_encode($selectedItems),
//         'status' => 'customer_confirmed'
//     ]);

//     return redirect()
//         ->route('customer.bookings')
//         ->with('success', 'Offer confirmed successfully');
// }



// public function customerConfirm(Request $request, $id)
// {
//     $validated = $request->validate([
//         'selected_items' => 'nullable|array',
//        'selected_items.*.label' => 'nullable|string',
//         'selected_items.*.amount' => 'nullable|numeric|min:0',
//         'selected_items.*.description' => 'nullable|string',
//         'selected_items.*.image' => 'nullable|string',
//     ]);

//     $booking = PropertyBooking::where('id', $id)
//         ->where('customer_id', auth()->id())
//         ->firstOrFail();

//     if ($booking->status !== 'waiting_customer_confirmation') {
//         return redirect()
//             ->route('customer.bookings')
//             ->with('error', 'Offer already confirmed.');
//     }

//     /* ===============================
//        ✅ CASHBACK ONLY CASE HANDLE
//     =============================== */
//     if (empty($request->selected_items)) {

//         $selectedItems = [
//             [
//                 'label' => 'Cashback',
//                 'amount' => $booking->offer_pool,
//                 'description' => 'Full cashback selected',
//                 'image' => null
//             ]
//         ];

//         $booking->update([
//             'selected_offer' => json_encode($selectedItems),
//             'status' => 'customer_confirmed'
//         ]);

//         return redirect()
//             ->route('customer.bookings')
//             ->with('success', 'Cashback confirmed successfully');
//     }

//     /* ===============================
//        REMOVE ZERO AMOUNT ITEMS
//     =============================== */
//     $selectedCollection = collect($request->selected_items)
//         ->filter(function ($item) {
//             return floatval($item['amount']) > 0;
//         });

//     // ❗ IMPORTANT: at least 1 item required
//     if ($selectedCollection->isEmpty()) {
//         return back()->withErrors('Please select at least one offer item');
//     }

//     /* ===============================
//        CALCULATE TOTAL
//     =============================== */
//     $total = $selectedCollection->sum(function ($item) {
//         return floatval($item['amount']);
//     });

//     if ($total > $booking->offer_pool) {
//         return back()->withErrors(
//             'Selected amount cannot exceed ₹ ' . $booking->offer_pool
//         );
//     }

//     $remaining = $booking->offer_pool - $total;

//     /* ===============================
//        FORMAT DATA
//     =============================== */
//     $selectedItems = $selectedCollection
//         ->map(function ($item) {
//             return [
//                 'label' => $item['label'],
//                 'amount' => floatval($item['amount']),
//                 'description' => $item['description'] ?? null,
//                 'image' => $item['image'] ?? null
//             ];
//         })
//         ->values()
//         ->toArray();

//     /* ===============================
//        ADD CASHBACK (ONLY IF SOME SELECTED)
//     =============================== */
//     if ($remaining > 0) {
//         $selectedItems[] = [
//             'label' => 'Cashback',
//             'amount' => $remaining,
//             'description' => 'Remaining cashback amount',
//             'image' => null
//         ];
//     }

//     /* ===============================
//        SAVE
//     =============================== */
//     $booking->update([
//         'selected_offer' => json_encode($selectedItems),
//         'status' => 'customer_confirmed'
//     ]);

//     return redirect()
//         ->route('customer.bookings')
//         ->with('success', 'Offer confirmed successfully');
// }
public function customerConfirm(Request $request, $id)
{
    $validated = $request->validate([
        'selected_items' => 'nullable|array',
        'selected_items.*.label' => 'nullable|string',
        'selected_items.*.amount' => 'nullable|numeric|min:0',
        'selected_items.*.description' => 'nullable|string',
        'selected_items.*.image' => 'nullable|string',
    ]);

    $booking = PropertyBooking::where('id', $id)
        ->where('customer_id', auth()->id())
        ->firstOrFail();

    if ($booking->status !== 'waiting_customer_confirmation') {
        return redirect()
            ->route('customer.bookings')
            ->with('error', 'Offer already confirmed.');
    }

    /* ===============================
       FILTER (FIXED 🔥)
    =============================== */
    $selectedCollection = collect($request->selected_items)
        ->filter(function ($item) {
            return floatval($item['amount']) > 0;
        });

    /* ===============================
       ❌ NO SELECTION
    =============================== */
   if ($selectedCollection->isEmpty()) {

    // 👉 cashback only case
    if ($booking->offer_pool > 0) {

        $selectedItems = [
            [
                'label' => 'Cashback',
                'amount' => $booking->offer_pool,
                'description' => 'Full cashback selected',
                'image' => null
            ]
        ];

        $booking->update([
            'selected_offer' => json_encode($selectedItems),
            'status' => 'customer_confirmed'
        ]);

        return redirect()
            ->route('customer.bookings')
            ->with('success', 'Cashback confirmed successfully');
    }

    return back()->withErrors('Please select at least one offer item');
}

    /* ===============================
       TOTAL
    =============================== */
    $total = $selectedCollection->sum(function ($item) {
        return floatval($item['amount']);
    });

    if ($total > $booking->offer_pool) {
        return back()->withErrors(
            'Selected amount cannot exceed ₹ ' . $booking->offer_pool
        );
    }

    $remaining = $booking->offer_pool - $total;

    /* ===============================
       FORMAT (FIXED 🔥)
    =============================== */
    $selectedItems = $selectedCollection
        ->map(function ($item) {
            return [
                'label' => $item['label'] ?? 'Cashback',
                'amount' => floatval($item['amount']),
                'description' => $item['description'] ?? null,
                'image' => $item['image'] ?? null
            ];
        })
        ->values()
        ->toArray();

    /* ===============================
       ADD CASHBACK
    =============================== */
    if ($remaining > 0) {
        $selectedItems[] = [
            'label' => 'Cashback',
            'amount' => $remaining,
            'description' => 'Remaining cashback amount',
            'image' => null
        ];
    }

    /* ===============================
       SAVE
    =============================== */
    $booking->update([
        'selected_offer' => json_encode($selectedItems),
        'status' => 'customer_confirmed'
    ]);

    return redirect()
        ->route('customer.bookings')
        ->with('success', 'Offer confirmed successfully');
}
//   public function adminFinalSubmit($id)
// {
//     if (auth()->user()->role_id != config('constants.roles.admin')) {
//         abort(403);
//     }

//     DB::transaction(function () use ($id) {

//         $booking = PropertyBooking::with('customer')->findOrFail($id);

//         if ($booking->status !== 'customer_confirmed') {
//             throw new \Exception('Booking not ready for final submit');
//         }

//         $customer = $booking->customer;

//         $categoryController = app(\App\Http\Controllers\CategoryController::class);

//         /* =========================
//            ADD USER TO MLM (ONCE)
//         ========================= */

//         $alreadyInMlm = DB::table('categories')
//             ->where('user_id', $customer->id)
//             ->exists();

//         if (!$alreadyInMlm) {

//             $categoryController->store(
//                 new \Illuminate\Http\Request([
//                     'parent_user_id' => $customer->refer_user_id ?? null,
//                     'user_id'        => $customer->id,
//                     'category'       => $customer->name,
//                 ])
//             );
//         }

//         /* =========================
//            DISTRIBUTE MLM AMOUNT
//            (EVERY BOOKING)
//         ========================= */

//         $categoryController->distributeMlmAmount(
//             $customer->id,
//             $booking->mlm_amount
//         );

//         /* =========================
//            COMPLETE BOOKING
//         ========================= */

//         $booking->update([
//             'status' => 'completed'
//         ]);
//     });

//     return redirect()
//         ->route('admin.property.bookings')
//         ->with('success', 'Booking finalized successfully');
// }
public function adminFinalSubmit(Request $request, $id)
{
    if (auth()->user()->role_id != config('constants.roles.admin')) {
        abort(403);
    }

    \Log::info('ADMIN FINAL SUBMIT HIT', [
        'booking_id' => $id,
        'referral_code' => $request->referral_code
    ]);

    /* =========================
       GET REFERRAL USER (OPTIONAL)
    ========================= */
    $refUser = null;

    if ($request->filled('referral_code')) {

        $refUser = \App\Models\User::where('referral_code', $request->referral_code)->first();

        \Log::info('REFERRAL CHECK', [
            'code' => $request->referral_code,
            'found_user_id' => $refUser?->id
        ]);

        // ❌ Invalid referral → stop
        if (!$refUser) {
            return back()->withErrors('Invalid referral code');
        }
    }

    DB::transaction(function () use ($id, $refUser) {

        $booking = PropertyBooking::with('customer')->findOrFail($id);

        if ($booking->status !== 'customer_confirmed') {
            throw new \Exception('Booking not ready for final submit');
        }

        \Log::info('BOOKING READY FOR FINAL', [
            'booking_id' => $booking->id
        ]);

        $customer = $booking->customer;

        $categoryController = app(\App\Http\Controllers\CategoryController::class);

        /* =========================
           ADD USER TO MLM (ONCE)
        ========================= */
        $alreadyInMlm = DB::table('categories')
            ->where('user_id', $customer->id)
            ->exists();

        if (!$alreadyInMlm) {

            \Log::info('ADDING USER TO MLM', [
                'customer_id' => $customer->id,
                'parent_user_id' => $refUser ? $refUser->id : null
            ]);

            $categoryController->store(
                new \Illuminate\Http\Request([
                    'parent_user_id' => $refUser ? $refUser->id : null,
                    'user_id'        => $customer->id,
                    'category'       => $customer->name,
                ])
            );
        } else {
            \Log::info('USER ALREADY IN MLM', [
                'customer_id' => $customer->id
            ]);
        }

        /* =========================
           DISTRIBUTE MLM AMOUNT
        ========================= */
        \Log::info('START MLM DISTRIBUTION', [
            'user_id' => $customer->id,
            'amount' => $booking->mlm_amount
        ]);

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

        \Log::info('BOOKING COMPLETED', [
            'booking_id' => $booking->id
        ]);
    });

    return redirect()
        ->route('admin.property.bookings')
        ->with('success', 'Booking finalized successfully');
}

// public function showConfirmOffer($id)
// {
//     \Log::info('CUSTOMER CONFIRM PAGE HIT', [
//         'booking_id' => $id,
//         'auth_id' => auth()->id(),
//         'role_id' => auth()->user()->role_id
//     ]);

//     if (auth()->user()->role_id != config('constants.roles.customer')) {
//         abort(403);
//     }

//     $booking = PropertyBooking::with(['items.property'])
//         ->where('id', $id)
//         ->where('customer_id', auth()->id())
//         ->where('status','waiting_customer_confirmation')
//         ->firstOrFail();

//     return view('customer.booking-confirm', compact('booking'));
// }



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


public function showConfirmOffer($id)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $booking = PropertyBooking::with(['items.property'])
        ->where('id', $id)
        ->where('customer_id', auth()->id())
        ->firstOrFail();

    return view('customer.booking-confirm', compact('booking'));
}

public function showProperties(Request $request)
{
    if (auth()->user()->role_id != config('constants.roles.customer')) {
        abort(403);
    }

    $query = Property::with('category')->active();

    /* ================= SEARCH ================= */
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('builder_name', 'like', '%' . $request->search . '%')
              ->orWhere('title', 'like', '%' . $request->search . '%')
              ->orWhere('address', 'like', '%' . $request->search . '%')
              ->orWhere('s_price', 'like', '%' . $request->search . '%');
        });
    }

    $properties = $query->orderBy('created_at', 'desc')->get();

    /* ================= IMAGE LOGIC ADD ================= */
    $propertyImages = DB::table('property_images')
        ->whereIn('properties_id', $properties->pluck('properties_id'))
        ->select('properties_id', 'image_url')
        ->orderBy('is_featured', 'DESC')
        ->get()
        ->groupBy('properties_id');

    foreach ($properties as $property) {
        $property->image = isset($propertyImages[$property->properties_id])
            ? $propertyImages[$property->properties_id]->first()->image_url
            : 'default.jpg';
    }

    /* ================= CATEGORY ================= */
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
        // professional
        'profession_type' => 'nullable|string|max:100',
        'company_name' => 'nullable|string|max:255',
        'experience_year' => 'nullable|numeric',
        'company_address' => 'nullable|string|max:500',
        'industry' => 'nullable|string|max:255',
        'designation' => 'nullable|string|max:255',
        'netsalary' => 'nullable|numeric',
        'gross_salary' => 'nullable|numeric',
        'business_establish_date' => 'nullable|date',
        'selfincome' => 'nullable|numeric',
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
        DB::table('professional_details')->insert([

        'user_id' => $user->id,
        'loan_id' => null,

        'profession_type' => $request->profession_type,
        'company_name' => $request->company_name,
        'experience_year' => $request->experience_year,
        'company_address' => $request->company_address,
        'industry' => $request->industry,
        'designation' => $request->designation,
        'netsalary' => $request->netsalary,
        'gross_salary' => $request->gross_salary,
        'business_establish_date' => $request->business_establish_date,
        'selfincome' => $request->selfincome,

        'created_at' => now(),
        'updated_at' => now()
        ]);
            });

    return redirect()
        ->route('customer.bookings')
        ->with('success','Property booking submitted successfully');
}


public function adminEdit($id)
{
    if (auth()->user()->role_id != config('constants.roles.admin')) {
        abort(403);
    }

    $booking = PropertyBooking::with(['customer','items.property'])
        ->findOrFail($id);

    // ❌ LOCK after customer confirm
    if (in_array($booking->status, ['customer_confirmed','completed'])) {
        return redirect()->back()->with('error','Cannot edit after customer confirmation');
    }

   return view('customer.properties.edit', compact('booking'));
}
public function adminUpdate(Request $request, $id)
{
    $booking = PropertyBooking::findOrFail($id);

    // ❌ LOCK
    if (in_array($booking->status, ['customer_confirmed','completed'])) {
        return redirect()->back()->with('error','Editing not allowed');
    }

    $booking->update([
        'agreement_cost' => $request->agreement_cost,
        'commission_percentage' => $request->commission_percentage,
        'tds_percentage' => $request->tds_percentage,
        'gst_percentage' => $request->gst_percentage,
        'mlm_amount' => $request->mlm_amount,
        'offers' => $request->offers ? json_encode($request->offers) : null,
    ]);

    return redirect()->route('admin.property.bookings')
        ->with('success','Booking updated successfully');
}
public function checkReferral(Request $request)
{
    $request->validate([
        'referral_code' => 'required|string'
    ]);

    $user = \App\Models\User::where('referral_code', $request->referral_code)->first();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid referral code'
        ]);
    }

    return response()->json([
        'status' => true,
        'name' => $user->name,
        'user_id' => $user->id
    ]);
}

}
