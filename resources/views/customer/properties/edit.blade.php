@extends('layouts.header')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<style>
.container{padding:0 10px;}
.title{color:#1565C0;font-size:27px;margin-bottom:20px;}
.section{margin-bottom:32px;}
.section-title{font-size:18px;font-weight:600;margin-bottom:16px;}
.form-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:20px;}
.form-group input{padding:8px;border:2px solid #e2e8f0;border-radius:8px;}
.offer-table{width:100%;border-spacing:0 16px;}
.offer-item td{background:#f8fafc;border:2px solid #e2e8f0;padding:18px;}
.offer-input{padding:10px;border:2px solid #e2e8f0;border-radius:6px;width:100%;}
.btn-primary{padding:12px 30px;background:#667eea;color:#fff;border:none;}
</style>

@php
$isLocked = in_array($booking->status, ['customer_confirmed','completed']);
@endphp

<div class="container">

<h2 class="title">Edit Property Booking</h2>

<form method="POST" action="{{ route('admin.booking.update', $booking->id) }}">
@csrf

{{-- AGREEMENT --}}
<div class="section">
<div class="form-grid">

<div class="form-group">
<label>Agreement Cost (₹)</label>
<input type="number" name="agreement_cost" value="{{ $booking->agreement_cost }}">
</div>

<div class="form-group">
<label>Commission %</label>
<input type="number" name="commission_percentage" value="{{ $booking->commission_percentage }}">
</div>

<div class="form-group">
<label>TDS %</label>
<input type="number"
       step="0.01"
       name="tds_percentage"
       value="{{ ($booking->tds_percentage == '0.00' || $booking->tds_percentage == 0) ? '' : $booking->tds_percentage }}">
</div>

<div class="form-group">
<label>GST %</label>
<input type="number"
       step="0.01"
       name="gst_percentage"
       value="{{ ($booking->gst_percentage == '0.00' || $booking->gst_percentage == 0) ? '' : $booking->gst_percentage }}">
</div>

<div class="form-group">
<label>MLM Amount (₹)</label>
<input type="number"
       step="0.01"
       name="mlm_amount"
       value="{{ ($booking->mlm_amount == '0.00' || $booking->mlm_amount == 0) ? '' : $booking->mlm_amount }}">
</div>
</div>
</div>

<hr>

{{-- OFFERS --}}
<h3>Offers</h3>

<table class="offer-table">
<tbody id="offer_rows">

@foreach(json_decode($booking->offers,true) ?? [] as $i => $offer)

<tr class="offer-item" data-offer="{{ $i }}">
<td>
<input class="offer-input"
type="text"
name="offers[{{ $i }}][label]"
value="{{ $offer['label'] }}">
</td>

<td>
<input class="offer-input"
type="number"
name="offers[{{ $i }}][amount]"
value="{{ $offer['amount'] }}"
oninput="updateSubTotals({{ $i }})">
</td>

<td>
<button type="button" onclick="removeOfferGroup({{ $i }})">❌</button>
</td>
</tr>

{{-- SUMMARY --}}
<tr>
<td colspan="3">
<b>Total:</b> ₹ 
<span class="sub-total" data-parent="{{ $i }}">0.00</span>

&nbsp;&nbsp;&nbsp;

<b style="color:green;">Remaining:</b> ₹ 
<span class="remaining" data-parent="{{ $i }}">0.00</span>
</td>
</tr>

{{-- SUB ITEMS --}}
@foreach($offer['items'] ?? [] as $j => $sub)
<tr class="sub-item" data-parent="{{ $i }}">
<td>

<input class="offer-input"
type="text"
name="offers[{{ $i }}][items][{{ $j }}][label]"
value="{{ $sub['label'] }}">

<textarea class="summernote"
name="offers[{{ $i }}][items][{{ $j }}][description]">
{!! $sub['description'] !!}
</textarea>

</td>

<td>
<input class="offer-input sub-amount"
type="number"
name="offers[{{ $i }}][items][{{ $j }}][amount]"
value="{{ $sub['amount'] }}"
oninput="updateSubTotals({{ $i }})">
</td>

<td>
<button type="button" onclick="removeSubItem(this)">❌</button>
</td>
</tr>
@endforeach

<tr>
<td colspan="3">
<button type="button" onclick="addSubItem({{ $i }})">➕ Add Sub Item</button>
</td>
</tr>

@endforeach

</tbody>
</table>

<button type="button" onclick="addMainOffer()">➕ Add Main Offer</button>

<br><br>

<button class="btn-primary" type="submit">Update Booking</button>

</form>

</div>

<script>

let offerIndex = {{ $booking->offers ? count(json_decode($booking->offers,true)) : 0 }};

function addMainOffer(){
let html = `
<tr data-offer="${offerIndex}">
<td><input class="offer-input" name="offers[${offerIndex}][label]"></td>
<td><input class="offer-input" type="number" name="offers[${offerIndex}][amount]" oninput="updateSubTotals(${offerIndex})"></td>
<td><button onclick="removeOfferGroup(${offerIndex})">❌</button></td>
</tr>

<tr>
<td colspan="3">
<b>Total:</b> ₹ <span class="sub-total" data-parent="${offerIndex}">0</span>
<b style="color:green;">Remaining:</b> ₹ <span class="remaining" data-parent="${offerIndex}">0</span>
</td>
</tr>

<tr>
<td colspan="3">
<button type="button" onclick="addSubItem(${offerIndex})">➕ Add Sub Item</button>
</td>
</tr>
`;

document.getElementById('offer_rows').insertAdjacentHTML('beforeend', html);
offerIndex++;
}

function addSubItem(parentIndex){

let count = document.querySelectorAll('.sub-item[data-parent="'+parentIndex+'"]').length;

let html = `
<tr class="sub-item" data-parent="${parentIndex}">
<td>
<input class="offer-input" name="offers[${parentIndex}][items][${count}][label]">
<textarea class="summernote" name="offers[${parentIndex}][items][${count}][description]"></textarea>
</td>
<td>
<input class="offer-input sub-amount" type="number"
name="offers[${parentIndex}][items][${count}][amount]"
oninput="updateSubTotals(${parentIndex})">
</td>
<td>
<button onclick="removeSubItem(this)">❌</button>
</td>
</tr>
`;

document.getElementById('offer_rows').insertAdjacentHTML('beforeend', html);
initSummernote();
}

function updateSubTotals(parentIndex){

let main = document.querySelector('[name="offers['+parentIndex+'][amount]"]');
let mainAmount = parseFloat(main?.value) || 0;

let inputs = document.querySelectorAll('.sub-item[data-parent="'+parentIndex+'"] input[name$="[amount]"]');

let total = 0;
inputs.forEach(i => total += parseFloat(i.value) || 0);

let totalEl = document.querySelector('.sub-total[data-parent="'+parentIndex+'"]');
if(totalEl) totalEl.innerText = total.toFixed(2);

let remaining = mainAmount - total;

let remainEl = document.querySelector('.remaining[data-parent="'+parentIndex+'"]');
if(remainEl) remainEl.innerText = remaining.toFixed(2);
}

function removeOfferGroup(index){
document.querySelectorAll('[data-offer="'+index+'"]').forEach(e=>e.remove());
}

function removeSubItem(btn){
btn.closest('tr').remove();
}

function initSummernote(){
$('.summernote').summernote({height:100});
}

document.addEventListener("DOMContentLoaded", function(){
initSummernote();
document.querySelectorAll('[data-offer]').forEach(row=>{
updateSubTotals(row.getAttribute('data-offer'));
});
});

</script>


@endsection