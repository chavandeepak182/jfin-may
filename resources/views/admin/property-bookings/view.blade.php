@extends('layouts.header')

@section('content')
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
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

.offer-description-box{
    margin-top:8px;
    padding:12px;
    background:#f8fafc;
    border-radius:8px;
    border:1px solid #e2e8f0;
    max-height:160px;
    overflow:auto;
    font-size:14px;
}

.offer-description-box img{
    max-width:100%;
    height:auto;
}
/* ready to final css */
.final-card{
    margin-top:30px;
    padding:28px;
    background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
    border-radius:14px;
    border:1px solid #bbf7d0;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
}

.final-header{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:20px;
}

.success-icon{
    width:50px;
    height:50px;
    background:#16a34a;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    font-size:22px;
    font-weight:bold;
}

.final-header h3{
    margin:0;
    font-size:20px;
    color:#065f46;
}

.sub-text{
    margin:0;
    font-size:13px;
    color:#047857;
}

.selected-item-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 16px;
    background:#ffffff;
    border-radius:8px;
    margin-bottom:10px;
    border:1px solid #e5e7eb;
    transition:0.2s;
}

.selected-item-row:hover{
    transform:translateY(-2px);
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}

.item-name{
    font-weight:600;
    color:#1f2937;
    text-transform:capitalize;
}

.item-amount{
    font-weight:700;
    color:#059669;
    font-size:16px;
}

.total-row{
    margin-top:18px;
    padding-top:14px;
    border-top:2px dashed #bbf7d0;
    display:flex;
    justify-content:space-between;
    font-size:17px;
    font-weight:700;
    color:#065f46;
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
            <th>Main Offer</th>
            <th>Amount</th>
            @if(!$isLocked)<th>Action</th>@endif
        </tr>
    </thead>
    <tbody id="offer_rows">

    @if($booking->offers)
        @foreach(json_decode($booking->offers,true) as $i => $offer)
        <tr class="offer-item">
            <td>
                <input class="offer-input"
                       type="text"
                       name="offers[{{ $i }}][label]"
                       value="{{ $offer['label'] }}"
                       {{ $isLocked ? 'readonly' : '' }}>
            </td>

            <td>
                <input class="offer-input"
                       type="number"
                       name="offers[{{ $i }}][amount]"
                       value="{{ $offer['amount'] }}"
                       {{ $isLocked ? 'readonly' : '' }}>
            </td>

            @if(!$isLocked)
            <td class="action-cell">
                <button type="button"
    class="offer-remove-btn"
    onclick="removeSubItem(this, ${parentIndex})">❌</button>
                </td>
            </td>
            @endif
        </tr>

        {{-- SUB ITEMS --}}
        @if(!empty($offer['items']))
            @foreach($offer['items'] as $j => $sub)
          <tr>
    <td style="padding-left:40px;">

        <!-- NAME -->
        <input class="offer-input"
               type="text"
               value="{{ $sub['label'] }}"
               readonly>

        <!-- DESCRIPTION SHOW -->
       @if(!empty($sub['description']))
<div class="offer-description-box">
    {!! $sub['description'] !!}
</div>
@endif

    </td>

    <td>
        <input class="offer-input"
               type="number"
               value="{{ $sub['amount'] }}"
               readonly>
    </td>
    <td></td>
</tr>
            @endforeach
        @endif

        @endforeach
    @endif

    </tbody>
</table>

@if(!$isLocked)
<button type="button" class="btn-add-offer" onclick="addMainOffer()">
    ➕ Add Main Offer
</button>
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

@php
    $selectedOffers = json_decode($booking->selected_offer, true);
@endphp

<div class="final-card">

    <div class="final-header">
        <div class="success-icon">✔</div>
        <div>
            <h3>Customer Selected Offer</h3>
            <p class="sub-text">Selection confirmed successfully</p>
        </div>
    </div>

    @if($selectedOffers)
        @php $total = 0; @endphp

        @foreach($selectedOffers as $item)
            @php $total += $item['amount']; @endphp

            <div class="selected-item-row">
                <span class="item-name">{{ $item['label'] }}</span>
                <span class="item-amount">
                    ₹ {{ number_format($item['amount'],2) }}
                </span>
            </div>
        @endforeach

        <div class="total-row">
            <span>Total Selected</span>
            <span>₹ {{ number_format($total,2) }}</span>
        </div>
    @endif

</div>

@endif

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

let offerIndex = {{ $booking->offers ? count(json_decode($booking->offers,true)) : 0 }};

/* =========================
   CALCULATION
========================= */
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

    let offerPool = net / 2;
    let companyShare = net / 2;

    let finalOfferPool = offerPool - mlm;
    if (finalOfferPool < 0) finalOfferPool = 0;

    actual_commission.innerText = actual.toFixed(2);
    tds_amount.innerText = tdsAmt.toFixed(2);
    gst_amount.innerText = gstAmt.toFixed(2);
    net_commission.innerText = net.toFixed(2);
    offer_pool.innerText = finalOfferPool.toFixed(2);
    final_commission.innerText = companyShare.toFixed(2);

    window.finalOfferPoolAmount = finalOfferPool;
}

['agreement_cost','commission_percentage','tds_percentage','gst_percentage','mlm_amount']
.forEach(id => document.getElementById(id)?.addEventListener('input', recalc));

function toggleOffers() {

    let box = document.getElementById('offers_box');
    let checkbox = document.getElementById('enable_offers');

    if (!box || !checkbox) return;

    box.style.display = checkbox.checked ? 'block' : 'none';
}

/* =========================
   ADD MAIN OFFER
========================= */
function addMainOffer() {

    let fixedAmount = window.finalOfferPoolAmount || 0;

    let html = `
    <tr class="offer-main" data-offer="${offerIndex}">
        <td>
            <input class="offer-input"
                type="text"
                name="offers[${offerIndex}][label]"
                placeholder="Main Offer Name"
                required>
        </td>

        <td>
            <input class="offer-input"
                type="number"
                name="offers[${offerIndex}][amount]"
                value="${fixedAmount.toFixed(2)}"
                readonly>
        </td>

        <td class="action-cell">
            <button type="button"
                class="offer-remove-btn"
                onclick="removeOfferGroup(${offerIndex})">❌</button>
        </td>
    </tr>
    <tr class="offer-summary" data-summary="${offerIndex}">
    <td colspan="3" style="padding-left:60px;">
        <div style="display:flex; justify-content:space-between; font-weight:600;">
            <span>Total of Sub Items: ₹ 
                <span class="sub-total" data-parent="${offerIndex}">0.00</span>
            </span>

            <span style="color:green;">
                Remaining Cashback: ₹ 
                <span class="remaining-cashback" data-parent="${offerIndex}">
                    ${fixedAmount.toFixed(2)}
                </span>
            </span>
        </div>
    </td>
</tr>

    <tr class="offer-sub-btn" data-offer="${offerIndex}">
        <td colspan="3" style="padding-left:30px;">
            <button type="button"
                onclick="addSubItem(${offerIndex})"
                class="btn-add-offer">
                ➕ Add Sub Item
            </button>
        </td>
    </tr>
    `;

    document.getElementById('offer_rows')
        .insertAdjacentHTML('beforeend', html);

    offerIndex++;
}


/* =========================
   ADD SUB ITEM
========================= */
function addSubItem(parentIndex) {

    let buttonRow = document.querySelector(
        'tr.offer-sub-btn[data-offer="'+parentIndex+'"]'
    );

    if (!buttonRow) return;

    let subCount = document.querySelectorAll(
        'tr.sub-item[data-parent="'+parentIndex+'"]'
    ).length;

   
    let html = `
<tr class="sub-item" data-parent="${parentIndex}">
<td colspan="3">

<div style="display:flex; gap:20px; align-items:flex-start; width:100%;">

    <!-- LEFT SIDE (Name + Description) -->
    <div style="flex:2; display:flex; flex-direction:column; gap:10px;">

        <!-- NAME -->
        <input class="offer-input"
            type="text"
            name="offers[${parentIndex}][items][${subCount}][label]"
            placeholder="Sub Item Name"
            required>

        <!-- DESCRIPTION -->
        <textarea class="offer-input summernote"
            name="offers[${parentIndex}][items][${subCount}][description]"
            placeholder="Description"
            style="width:100%;"></textarea>

    </div>

    <!-- AMOUNT -->
    <div style="flex:1;">
        <input class="offer-input sub-amount"
            type="number"
            name="offers[${parentIndex}][items][${subCount}][amount]"
            placeholder="Amount"
            oninput="updateSubTotals(${parentIndex})"
            required>
    </div>

    <!-- DELETE BUTTON -->
    <div style="display:flex; align-items:center;">
        <button type="button"
            class="offer-remove-btn"
            onclick="removeSubItem(this, ${parentIndex})">❌</button>
    </div>

</div>

</td>
</tr>
`;

buttonRow.insertAdjacentHTML('afterend', html);
initSummernote();
}

/* =========================
   REMOVE ENTIRE OFFER GROUP
========================= */
function removeOfferGroup(index) {

    // remove main row + summary + button row
    document.querySelectorAll('[data-offer="'+index+'"], [data-summary="'+index+'"]')
        .forEach(el => el.remove());

    // remove all sub items of that main offer
    document.querySelectorAll('tr.sub-item[data-parent="'+index+'"]')
        .forEach(el => el.remove());

    // reset totals
    updateSubTotals(index);
}

/* =========================
   VALIDATE TOTAL SPLIT
========================= */
document.querySelector("form").addEventListener("submit", function(e){

    if (!enable_offers.checked) return;

    let finalOfferPool = window.finalOfferPoolAmount || 0;

    let allSubInputs = document.querySelectorAll('[name*="[items]"][name$="[amount]"]');

    let total = 0;

    allSubInputs.forEach(function(input){
        total += parseFloat(input.value) || 0;
    });

    if (Math.round(total) !== Math.round(finalOfferPool)) {

        alert(
            "Sub items total must equal Offer Pool amount (₹ " +
            finalOfferPool.toFixed(2) + ")"
        );

        e.preventDefault();
    }
});

recalc();
toggleOffers();
function updateSubTotals(parentIndex) {

    let finalOfferPool = window.finalOfferPoolAmount || 0;

    let inputs = document.querySelectorAll(
        'tr.sub-item[data-parent="'+parentIndex+'"] input[name$="[amount]"]'
    );

    let total = 0;

    inputs.forEach(function(input){
        total += parseFloat(input.value) || 0;
    });

    // ❌ If total exceeds pool
   if (total > finalOfferPool) {

    alert("Offer amount exceeded! Max allowed ₹ " + finalOfferPool.toFixed(2));

    let lastInput = document.activeElement;

    if (lastInput && lastInput.classList.contains('sub-amount')) {

        let currentVal = parseFloat(lastInput.value) || 0;

        // remove only excess part
        let allowed = finalOfferPool - (total - currentVal);

        lastInput.value = allowed > 0 ? allowed.toFixed(2) : 0;
    }

    total = finalOfferPool;
}

    // ✅ Update total
    let totalEl = document.querySelector(
        '.sub-total[data-parent="'+parentIndex+'"]'
    );

    if (totalEl) totalEl.innerText = total.toFixed(2);

    // ✅ Remaining
    let remaining = finalOfferPool - total;

    let remainEl = document.querySelector(
        '.remaining-cashback[data-parent="'+parentIndex+'"]'
    );

    if (remainEl) remainEl.innerText = remaining.toFixed(2);
}
function removeSubItem(button, parentIndex) {

    // row remove
    button.closest('tr').remove();

    // total update
    updateSubTotals(parentIndex);
}
function initSummernote() {
    $('.summernote').summernote({
        height: 100,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol']],
            ['insert', ['link']],
            ['view', ['codeview']]
        ]
    });
}

document.addEventListener("DOMContentLoaded", function() {
    initSummernote();
});

</script>


@endif


@endsection




  