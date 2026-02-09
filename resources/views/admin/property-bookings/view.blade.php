@extends('layouts.header')

@section('content')
<style>
.container{
    padding:0 10px;
}
.title{
    color:#1565C0;  
    font-size:27px;
    margin-bottom:20px;
}
.section-title {
    font-size: 18px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.section-title::before {
    content: '';
    width: 4px;
    height: 20px;
    background: #667eea;
    border-radius: 2px;
}
.customer-details{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 16px;
    background: #f4f7fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}
.info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
}
.info-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #64748b;
    letter-spacing: 0.5px;
}
.info-value {
    font-size: 15px;
    color: #1a202c;
    font-weight: 500;
}
.sub-heading{
    color:#1565C0;
    padding-left:10px;
    font-size:23px;
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
}
.form-group input {
    padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 10px;
            transition: all 0.2s;
}
.calculation-panel {
            background: linear-gradient(135deg, #f8fafc 0%, #e8eef5 100%);
            padding: 12px 24px 0;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }
.calculation-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
    }
.calculation-row:last-child {
                border-bottom: none;
    }
.calculation-row p {
            font-size: 14px;
            color: #4a5568;
            font-weight: 500; 
    }
.calculation-row span{
    font-size: 16px;
    font-weight: 600;
    color: #2d3748;
}
.checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s;
        }

        .checkbox-wrapper:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }
        .checkbox-label {
            font-size: 15px;
            font-weight: 500;
            color: #2d3748;
            cursor: pointer;
        }
</style>
@php
    // Lock everything once customer interaction starts
    $isLocked = in_array($booking->status, [
        'waiting_customer_confirmation',
        'customer_confirmed',
        'completed'
    ]);
@endphp
<div class="container">
<h2 class="title">Property Booking Review</h2>

<p>
    <strong>Status:</strong>
    {{ ucwords(str_replace('_',' ',$booking->status)) }}
</p>

<hr>
<div class="details">
    <h2 class="section-title">Booking Details</h2>
    <div class="customer-details">
        <div class="info-item">
            <h4 class="info-label">Customer</h4>
            <p class="info-value">{{ $booking->customer->name }} | {{ $booking->customer->mobile_no }}</p>
        </div>
        <div class="info-item">
            <h4 class="info-label">Property</h4>
            @foreach($booking->items as $item)
                <p class="info-value">{{ $item->property->title }}</p>
            @endforeach
        </div>
        <div class="info-item">
            <h4 class="info-label">Co-Applicant Details</h4>
            <p class="info-value">{{ $booking->co_name }} | {{ $booking->customer_mobile }} | {{ $booking->customer_email }}</p>
        </div>
        
    </div>
</div>
<hr>

<form method="POST" action="{{ url('admin/booking/offer/'.$booking->id) }}">
@csrf

{{-- ===========================
   AGREEMENT & COMMISSION
=========================== --}}
<div class="section">
    <h2 class="section-title">Agreement & Commission</h2>
    <div class="form-grid">
        <div class="form-group">
            <label>Agreement Cost (₹)</label>
            <input type="number" id="agreement_cost" name="agreement_cost"
                value="{{ $booking->agreement_cost }}"
                {{ $isLocked ? 'readonly' : 'required' }}>
        </div>
        <div class="form-group">
            <label>Commission %</label>
            <input type="number" id="commission_percentage" name="commission_percentage" step="0.01"
                   value="{{ $booking->commission_percentage }}"
                   {{ $isLocked ? 'readonly' : 'required' }}>
        </div>
        <div class="form-group">
            <label>TDS %</label>
            <input type="number" id="tds_percentage" name="tds_percentage" step="0.01"
                   value="{{ $booking->tds_percentage }}"
                   {{ $isLocked ? 'readonly' : 'required' }}>
        </div>
        <div class="form-group">
            <label>GST %</label>
            <input type="number" id="gst_percentage" name="gst_percentage" step="0.01"
                   value="{{ $booking->gst_percentage }}"
                   {{ $isLocked ? 'readonly' : 'required' }}>
        </div>
        <div class="form-group">
            <label>MLM Amount (₹)</label>
            <input type="number" id="mlm_amount" name="mlm_amount"
                   value="{{ $booking->mlm_amount }}"
                   {{ $isLocked ? 'readonly' : 'required' }}>
        </div>
    </div>
</div>

<hr>
<div class="section">
    <h2 class="section-title">Calculation Summary</h2>
    <div class="calculation-panel">
        <div class="calculation-row">
            <p><strong>Actual Commission:</strong></p>
            <span id="actual_commission">₹ {{ number_format($booking->actual_commission ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p><strong>TDS Amount:</strong></p>
             <span id="tds_amount">₹ {{ number_format($booking->tds_amount ?? 0,2) }}</span>
        </div>
        <div class="calculation-row">   
            <p><strong>GST Amount:</strong></p>
             <span id="gst_amount">₹ {{ number_format($booking->gst_amount ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p><strong>Net Commission:</strong></p>
             <span id="net_commission">₹ {{ number_format($booking->net_commission ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p><strong>Offer Pool (50%):</strong></p>
             <span id="offer_pool">₹ {{ number_format($booking->offer_pool ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p><strong>Company Share (50%):</strong></p>
             <span id="final_commission">₹ {{ number_format($booking->final_commission ?? 0,2) }}</span>

        </div>
    </div>
</div>

{{-- ===========================
   OFFERS (DYNAMIC)
=========================== --}}
<div class="section">
    <h2 class="section-title">Offers (Optional)</h2>

    <label class="checkbox-wrapper">
    
    <input type="checkbox"
           id="enable_offers"
           name="enable_offers"
           value="1"
           {{ $booking->offers ? 'checked' : '' }}
           {{ $isLocked ? 'disabled' : '' }}
           onchange="toggleOffers()">
    <span class="checkbox-label">Enable Offers</span>
</label>
</div>

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
</div>

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
