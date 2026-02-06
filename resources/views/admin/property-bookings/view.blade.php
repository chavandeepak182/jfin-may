@extends('layouts.header')

@section('content')

@php
    // Lock everything once customer interaction starts
    $isLocked = in_array($booking->status, [
        'waiting_customer_confirmation',
        'customer_confirmed',
        'completed'
    ]);
@endphp

<h2>Property Booking Review</h2>

<p>
    <strong>Status:</strong>
    {{ ucwords(str_replace('_',' ',$booking->status)) }}
</p>

<hr>

<h4>Customer</h4>
<p>{{ $booking->customer->name }} | {{ $booking->customer->mobile_no }}</p>

<h4>Property</h4>
@foreach($booking->items as $item)
    <p>{{ $item->property->title }}</p>
@endforeach
<h4>Co-Applicant Details</h4>
<p>{{ $booking->co_name }} | {{ $booking->customer_mobile }} | {{ $booking->customer_email }}</p>
<hr>

<form method="POST" action="{{ url('admin/booking/offer/'.$booking->id) }}">
@csrf

{{-- ===========================
   AGREEMENT & COMMISSION
=========================== --}}

<h4>Agreement & Commission</h4>

<label>Agreement Cost (₹)</label><br>
<input type="number" id="agreement_cost" name="agreement_cost"
       value="{{ $booking->agreement_cost }}"
       {{ $isLocked ? 'readonly' : 'required' }}>
<br><br>

<label>Commission %</label><br>
<input type="number" id="commission_percentage" name="commission_percentage" step="0.01"
       value="{{ $booking->commission_percentage }}"
       {{ $isLocked ? 'readonly' : 'required' }}>
<br><br>

<label>TDS %</label><br>
<input type="number" id="tds_percentage" name="tds_percentage" step="0.01"
       value="{{ $booking->tds_percentage }}"
       {{ $isLocked ? 'readonly' : 'required' }}>
<br><br>

<label>GST %</label><br>
<input type="number" id="gst_percentage" name="gst_percentage" step="0.01"
       value="{{ $booking->gst_percentage }}"
       {{ $isLocked ? 'readonly' : 'required' }}>
<br><br>

<label>MLM Amount (₹)</label><br>
<input type="number" id="mlm_amount" name="mlm_amount"
       value="{{ $booking->mlm_amount }}"
       {{ $isLocked ? 'readonly' : 'required' }}>

<hr>

{{-- ===========================
   SYSTEM CALCULATIONS
=========================== --}}

<p><strong>Actual Commission:</strong>
₹ <span id="actual_commission">{{ number_format($booking->actual_commission ?? 0,2) }}</span>
</p>

<p><strong>TDS Amount:</strong>
₹ <span id="tds_amount">{{ number_format($booking->tds_amount ?? 0,2) }}</span>
</p>

<p><strong>GST Amount:</strong>
₹ <span id="gst_amount">{{ number_format($booking->gst_amount ?? 0,2) }}</span>
</p>

<p><strong>Net Commission:</strong>
₹ <span id="net_commission">{{ number_format($booking->net_commission ?? 0,2) }}</span>
</p>

<p><strong>Offer Pool (50%):</strong>
₹ <span id="offer_pool">{{ number_format($booking->offer_pool ?? 0,2) }}</span>
</p>

<p><strong>Company Share (50%):</strong>
₹ <span id="final_commission">{{ number_format($booking->final_commission ?? 0,2) }}</span>
</p>

<hr>

{{-- ===========================
   OFFERS (DYNAMIC)
=========================== --}}

<h4>Offers (Optional)</h4>

<label>
    <input type="checkbox"
           id="enable_offers"
           name="enable_offers"
           value="1"
           {{ $booking->offers ? 'checked' : '' }}
           {{ $isLocked ? 'disabled' : '' }}
           onchange="toggleOffers()">
    Enable Offers
</label>

<div id="offers_box" style="margin-top:10px; {{ $booking->offers ? '' : 'display:none;' }}">

    <p><strong>Offer Amount:</strong>
        ₹ {{ number_format($booking->offer_pool ?? 0,2) }}
    </p>

    <table border="1" cellpadding="6" width="100%">
        <thead>
            <tr>
                <th>Offer Name</th>
                @if(!$isLocked)<th>Action</th>@endif
            </tr>
        </thead>
        <tbody id="offer_rows">
            @if($booking->offers)
                @foreach(json_decode($booking->offers,true) as $offer)
                    <tr>
                        <td>
                            <input type="text"
                                   name="offers[]"
                                   value="{{ $offer['label'] }}"
                                   {{ $isLocked ? 'readonly' : '' }}>
                        </td>
                        @if(!$isLocked)
                        <td>
                            <button type="button" onclick="this.closest('tr').remove()">❌</button>
                        </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if(!$isLocked)
        <br>
        <button type="button" onclick="addOffer()">➕ Add Offer</button>
    @endif
</div>

@if(!$isLocked)
    <br><br>
    <button type="submit">Submit & Proceed</button>
@endif

</form>

{{-- ===========================
   CUSTOMER SELECTED OFFER
=========================== --}}

@if(in_array($booking->status,['customer_confirmed','completed']))
<hr>
<h4>Customer Selected Offer</h4>

<p style="color:green;">
    ✔ {{ $booking->selected_offer }}
    – ₹ {{ number_format($booking->offer_pool ?? 0,2) }}
</p>
@endif

{{-- ===========================
   FINAL SUBMIT
=========================== --}}

@if($booking->status === 'customer_confirmed')
<hr>
<h4>Final Approval</h4>

<form method="POST"
      action="{{ url('admin/booking/final/'.$booking->id) }}"
      onsubmit="return confirm('Finalize booking and distribute MLM commission?')">
    @csrf
    <button style="padding:10px 24px; background:#198754; color:#fff; border:none;">
        Final Submit & Complete Booking
    </button>
</form>
@endif

{{-- ===========================
   JS CALCULATIONS
=========================== --}}
@if(!$isLocked)
<script>
function recalc() {
    let cost = +agreement_cost.value || 0;
    let percent = +commission_percentage.value || 0;
    let tds = +tds_percentage.value || 0;
    let gst = +gst_percentage.value || 0;
    let mlm = +mlm_amount.value || 0;

    let actual = cost * percent / 100;
    let tdsAmt = actual * tds / 100;
    let gstAmt = actual * gst / 100;
    let net = actual - tdsAmt - gstAmt;
    let remaining = net - mlm;
    let pool = remaining / 2;

    actual_commission.innerText = actual.toFixed(2);
    tds_amount.innerText = tdsAmt.toFixed(2);
    gst_amount.innerText = gstAmt.toFixed(2);
    net_commission.innerText = net.toFixed(2);
    offer_pool.innerText = pool.toFixed(2);
    final_commission.innerText = pool.toFixed(2);
}

['agreement_cost','commission_percentage','tds_percentage','gst_percentage','mlm_amount']
.forEach(id => document.getElementById(id)?.addEventListener('input', recalc));

function toggleOffers() {
    offers_box.style.display = enable_offers.checked ? 'block' : 'none';
}

function addOffer() {
    let row = `
        <tr>
            <td><input type="text" name="offers[]" placeholder="Offer name"></td>
            <td><button type="button" onclick="this.closest('tr').remove()">❌</button></td>
        </tr>`;
    offer_rows.insertAdjacentHTML('beforeend', row);
}
</script>
@endif

@endsection
