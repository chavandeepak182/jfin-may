@extends('layouts.header')

@section('content')
<style>
.section {
            margin-bottom: 32px;
        }
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
    padding: 6px 10px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
}
.calculation-panel {
            display:grid;
            grid-template-columns:1fr 1fr;
            background: linear-gradient(135deg, #f8fafc 0%, #e8eef5 100%);
            padding: 12px 24px 0;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }
.calculation-row {
            display: flex;
            gap:12px;
            align-items: center;
            padding: 12px 24px;
            border-bottom: 1px solid #e2e8f0;
    }
.calculation-row:last-child {
                border-bottom: none;
    }
.calculation-row p {
    margin-bottom:0;
            font-size: 14px;
            color: #69707d;
            font-weight:500;
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
.add-offer-section{
    display:flex;
    justify-content:center;
}
.btn-add-offer {
            width: 100%;
            padding: 14px 24px;
            background: white;
            border: 2px dashed #cbd5e0;
            border-radius: 8px;
            color: #667eea;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: inherit;
        }
        .checkbox-label {
            font-size: 15px;
            font-weight: 500;
            color: #2d3748;
            cursor: pointer;
        }
.offer-table{
    width:100%;
    border-collapse: separate;
    border-spacing: 0 18px;
}
.offer-head{
    border-radius:8px;
    background-color:#f1f5f9;
    padding:12px;
    margin-bottom:20px;
}
.offer_row{
    padding:10px;
    border-bottom: 2px solid #e2e8f0;
    margin-bottom:10px;
    font-size: 13px;
    transition: all 0.2s;
    background: #fff;
}
.offer_row input{
    border:none;
}
.offer_row button{
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor: pointer;
}
.offer-table tr{
    margin:10px 0;
    border
}
.submit-btn{
            text-align:center;
            margin-top:20px;
        }
.btn {
            padding: 14px 64px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
        }
.offer-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 16px; /* gap between cards */
}

.offer-item td {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    padding: 18px 20px;
}

.offer-item td:first-child {
    border-radius: 8px 0 0 8px;
}

.offer-item td:last-child {
    border-radius: 0 8px 8px 0;
    width: 70px;
    text-align: center;
}

.offer-item:hover td {
    border-color: #cbd5e0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* label + input */
.offer-input-wrapper {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.offer-input-label {
    font-size: 13px;
    font-weight: 600;
    color: #64748b; 
    text-transform: uppercase;
}

.offer-input {
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    font-size: 15px;
}

.offer-input:focus {
    outline: none;
    border-color: #667eea;
}

/* remove btn */
.offer-remove-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #fee2e2;
    background: #fef2f2;
    color: #dc2626;
    border-radius: 8px;
    cursor: pointer;
}

/* empty */
.empty-row td {
    text-align: center;
    color: #94a3b8;
}
.action-cell{
    text-align:center;
}
.offer-selected{
    padding:20px 0;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    border-radius:6px;
    background:  linear-gradient(135deg, #d1fae5 0%, #f2fff3 100%);
    
}
.offer-selected h4{
    color:#2d3748;
}
.cashback-p{
    color: #008000;
    font-size:20px;
    margin-bottom:0;
}
.final-btn{
padding:10px 24px; 
font-size:18px;
background: linear-gradient(135deg, #00be5d 0%, #005930 100%);
color:#fff; 
border-radius:8px;
}
.offer-amount-display{
    padding:12px;
    width:auto;
    font-size:20px;
    background:#
}
.selected-offer{
    width:100%;
    background:linear-gradient(135deg, #f8fafc 0%, #e8eef5 100%);
    border-radius: 8px;
    border: 2px solid #e2e8f0;
    padding:16px;
}
.offer-amt{
    font-size:20px;
    margin-bottom:0;
}
.final-aprrove-section{
    margin-top:32px;
    margin-bottom:20px;
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

<div class="section">
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
            <p>Actual Commission:</p>
            <span id="actual_commission"> ₹ {{ number_format($booking->actual_commission ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p>TDS Amount:</p>
             <span id="tds_amount"> ₹ {{ number_format($booking->tds_amount ?? 0,2) }}</span>
        </div>
        <div class="calculation-row">   
            <p>GST Amount:</p>
             <span id="gst_amount"> ₹ {{ number_format($booking->gst_amount ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p>Net Commission:</p>
             <span id="net_commission"> ₹ {{ number_format($booking->net_commission ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p>Offer Pool (50%):</p>
             <span id="offer_pool"> ₹ {{ number_format($booking->offer_pool ?? 0,2) }}</span>
            
        </div>
        <div class="calculation-row">
            <p>Company Share (50%):</p>
             <span id="final_commission"> ₹ {{ number_format($booking->final_commission ?? 0,2) }}</span>

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

<div class="section" id="offers_box" style="margin-top:10px; {{ $booking->offers ? '' : 'display:none;' }}">
    <div class="selected-offer">
        <p class="offer-amt"><strong>Offer Amount:</strong>
            ₹ {{ number_format($booking->offer_pool ?? 0,2) }}
        </p>
    </div>
    <table class="offer-table">
        <thead>
            <tr class="offer-head">
                <th>Offer Name</th>
                @if(!$isLocked)<th class="action-cell">Action</th>@endif
            </tr>
        </thead>
        <tbody id="offer_rows">
            @if($booking->offers)
                @foreach(json_decode($booking->offers,true) as $offer)
                    <tr class="offer-item">
                        <td style="padding:0; border:none;">
                            <div class="offer-input-wrapper">
                            
                                <input 
                                    class="offer-input"
                                    type="text"
                                    name="offers[]"
                                    value="{{ $offer['label'] }}"
                                    {{ $isLocked ? 'readonly' : '' }}>
                            </div>
                        </td>
                        @if(!$isLocked)
                        <td class="action-cell">
                            <button class="offer-remove-btn" type="button" onclick="this.closest('tr').remove()">❌</button>
                        </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    
        @if(!$isLocked)
            <button class="btn-add-offer" type="button" onclick="addOffer()">➕ Add Offer</button>
        @endif

<div class="submit-btn">
@if(!$isLocked)
    
    <button class="btn btn-primary" type="submit">Submit & Proceed</button>
    
@endif
</div>
</form>

{{-- ===========================
   CUSTOMER SELECTED OFFER
=========================== --}}

@if(in_array($booking->status,['customer_confirmed','completed']))
<div class="offer-selected">
    <div>
<h4>Customer Selected Offer</h4>
</div>
<div>
<p class="cashback-p">
    ✔ {{ $booking->selected_offer }}
    – ₹ {{ number_format($booking->offer_pool ?? 0,2) }}
</p>
</div>
@endif
</div>
</div>
{{-- ===========================
   FINAL SUBMIT
=========================== --}}
<div class="section">
@if($booking->status === 'customer_confirmed')
<h4 class="section-title final-aprrove-section">Final Approval</h4>

<form method="POST"
      action="{{ url('admin/booking/final/'.$booking->id) }}"
      onsubmit="return confirm('Finalize booking and distribute MLM commission?')">
    @csrf
    <button class="final-btn">
        Final Submit & Complete Booking
    </button>
</form>
@endif
</div>
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
        <tr class="offer_item">
            <td>
            <div class="offer-input-wrapper">
                <input class="offer-input" type="text" name="offers[]" placeholder="Enter Offer name"></td>
            </div>
            <td class="action-cell"><button class="offer-remove-btn" type="button" onclick="this.closest('tr').remove()">❌</button></td>
        </tr>`;
    offer_rows.insertAdjacentHTML('beforeend', row);
}
</script>
@endif

@endsection
