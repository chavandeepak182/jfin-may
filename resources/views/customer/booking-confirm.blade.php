
@extends('frontend.layouts.customer-dash')

@section('content')
<style>
    .title{
    color:#1565C0;  
    font-size:27px;
    margin-bottom:20px;
}
.section{
    margin-bottom:20px;
}
.offer-title{
    color: #000 !important;
}
h5 {
    color: #000 !important;
}
h2 {
    color: #000 !important;
}

label {
    color: #000 !important;
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
.calculation-panel {
            background: linear-gradient(135deg, #f8fafc 0%, #ddecfb 100%);
            padding: 12px 24px 0;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            display:grid;
            grid-template-columns:1fr 1fr;
        }
.calculation-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e2e8f0;
    }
.calculation-row:last-child {
                border-bottom: none;
    }
.calculation-row p {
            font-size: 16px;
            color: #4a5568;
            font-weight: 500; 
            margin-bottom:0;

    }
.calculation-row span{
    font-size: 16px;
    font-weight: 600;
    color: #2d3748;
}
h4
{
    color:#000;
}

.selected-prop{
    width:100%;
    background:linear-gradient(135deg, #f8fafc 0%, #ddecfb 100%);
    border-radius: 8px;
    border: 2px solid #e2e8f0;
    padding:20px;
}
.selected-title{
    font-size:12px;
    color:#70798a;
}
.property-name{
    color:#4a5568;;
    font-size:16px;
    margin-bottom:0;
}
.offer-title{
    color: #fff;
    font-size:21px;
    display:flex;
    justify-content:center;
    padding:15px 25px;
    border-radius:8px;
    background: linear-gradient(135deg, #0381fd 0%, #003a74 100%);
}
.offers{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap:26px;
    margin-bottom:20px;
}
.offer-item{
    width:100%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    text-align:center;
    padding:15px;
    border-radius:10px;
    border:2px solid #b6bec9;
}
.offer-name{
    color:#000; 
    font-size:18px;
    text-transform:uppercase;
    display:flex;
    align-items:center;
    gap:12px;
}
.offer-name input[type="radio"]{
    appearance:none;
    width:18px;
    height:18px;
    border:2px solid #000;
    border-radius:50%;
    display: inline-block;
    position: relative;
    cursor: pointer;
}
.offer-name input[type="radio"]:checked{
    background: #fff;
    box-shadow: inset 0 0 0 4px #004181;
}
.offer-item:has(input[type="radio"]:checked){
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.2);
}
.offer-amount{
    margin-bottom:0;
    color:green;
    font-weight:600;
    font-size:21px;
}
.confirm-btn{
    width:100%;
    display:flex;
    justify-content:center;
}
.btn {
            max-width:320px;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
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
.selected-offer{
    font-size: 18px;
    color: #00428d;
    margin-bottom: 0;
    text-transform: uppercase;
}
.team-msg{
    text-align:center;
    color:#002f64;
}

.offers img{
    max-width:100%;
    height:auto;
    border-radius:8px;
    margin-top:8px;
}
</style>
<div class="container">

    <h2 class="title">
        {{ $booking->status === 'customer_confirmed'
            ? 'Offer Confirmed'
            : 'Confirm Offer'
        }}
    </h2>

    <p>
        <strong>Status:</strong>
        {{ ucwords(str_replace('_',' ',$booking->status)) }}
    </p>

    <hr>

    {{-- PROPERTY --}}
    <h5 class="section-title">Property</h5>
    <div class="selected-prop">
        @foreach($booking->items as $item)
            <p>{{ $item->property->title ?? 'N/A' }}</p>
        @endforeach
    </div>

    <hr>

    {{-- COMMISSION --}}
    <h5 class="section-title">Commission Summary</h5>
    <p><strong>Offer Value:</strong> ₹ {{ number_format($booking->offer_pool,2) }}</p>

    <hr>

    @if($booking->status === 'waiting_customer_confirmation')

        @php
            $offers = json_decode($booking->offers, true);
        @endphp

        @if(!$offers)
            <p>No offers available.</p>
        @else
        @if($errors->any())
    <div style="background:red;color:white;padding:10px;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

        <form id="confirmForm"
              method="POST"
              action="{{ route('customer.booking.confirm',$booking->id) }}">
            @csrf

            <h5>Select Offer Options</h5>

            <div class="offers">

                @foreach($offers as $mainIndex => $main)

                    <div style="margin-bottom:15px; border:1px solid #ddd; padding:12px; border-radius:6px;">

                        {{-- MAIN --}}
                        <label>
    <input type="checkbox"
class="main-checkbox"
data-index="{{ $mainIndex }}"
data-label="{{ strtolower($main['label']) }}">

    <strong>{{ $main['label'] }}</strong>
    – ₹ 
    <span class="main-amount"
          id="main_amount_{{ $mainIndex }}">
        {{ number_format($main['amount'],2) }}
    </span>
</label>

                        {{-- SUB ITEMS --}}
                        @if(!empty($main['items']))
                            <div style="margin-left:25px; margin-top:8px;">
                              @foreach($main['items'] as $subIndex => $sub)

    <div style="margin-bottom:15px; padding:10px; border:1px solid #e2e8f0; border-radius:8px;">

       <label style="display:flex; gap:8px; align-items:center;">

<input type="checkbox"
class="sub-checkbox"
data-parent="{{ $mainIndex }}"
data-label="{{ $sub['label'] }}"
data-amount="{{ $sub['amount'] }}"
data-id="{{ $mainIndex }}_{{ $subIndex }}">

<input type="hidden"
name="selected_items[{{ $mainIndex }}_{{ $subIndex }}][label]"
value="{{ $sub['label'] }}"
disabled>

<input type="hidden"
name="selected_items[{{ $mainIndex }}_{{ $subIndex }}][description]"
value="{{ $sub['description'] ?? '' }}"
disabled>

<input type="hidden"
name="selected_items[{{ $mainIndex }}_{{ $subIndex }}][image]"
value="{{ $sub['image'] ?? '' }}"
disabled>

<input type="hidden"
name="selected_items[{{ $mainIndex }}_{{ $subIndex }}][amount]"
value="{{ $sub['amount'] }}"
disabled>

<strong>{{ $sub['label'] }}</strong>
– ₹ {{ number_format($sub['amount'],2) }}

</label>
        <div class="remaining-display" 
     id="remaining_for_{{ $mainIndex }}_{{ $subIndex }}" 
     style="color:#004181; font-weight:600; margin-top:6px;">
</div>

        {{-- DESCRIPTION + IMAGE --}}
        @if(!empty($sub['description']))
            <div style="margin-top:8px; padding:10px; background:#f8fafc; border-radius:6px;">
                {!! $sub['description'] !!}
            </div>
        @endif

    </div>

@endforeach
                            </div>
                        @endif

                    </div>

                @endforeach

            </div>

            <hr>

            <p>
                <strong>Total Selected: ₹ 
                    <span id="selected_total">0.00</span>
                </strong>
                <p>
    <strong>Remaining Cashback: ₹ 
        <span id="remaining_cashback">
            {{ number_format($booking->offer_pool,2) }}
        </span>
    </strong>
</p>
            </p>
            

            <button type="submit" class="btn btn-primary">
                Confirm Selection
            </button>

        </form>

        @endif

   @elseif($booking->status === 'customer_confirmed' || $booking->status === 'completed')
        <p style="color:green;">
            ✔ You have confirmed your selection.
        </p>

        @php
            $selected = json_decode($booking->selected_offer, true);
        @endphp

@foreach($selected as $item)

<div style="border:1px solid #ddd;padding:20px;border-radius:10px;margin-bottom:20px;">

<h3 style="margin-bottom:10px;color:#000;">
{{ ucfirst($item['label']) }}
</h3>

@if(!empty($item['image']))
<div style="margin-bottom:10px;">
<img src="{{ $item['image'] }}" style="max-width:250px;border-radius:8px;">
</div>
@endif

@if(!empty($item['description']))
<div style="margin-bottom:10px;">
{!! $item['description'] !!}
</div>
@endif

<p style="font-size:18px;color:green;font-weight:600;">
₹ {{ number_format($item['amount'],2) }}
</p>

</div>

@endforeach

    @endif

</div>
<script>
document.addEventListener("DOMContentLoaded", function(){

    let offerPool = {{ $booking->offer_pool ?? 0 }};
    let totalSpan = document.getElementById('selected_total');
    let remainingSpan = document.getElementById('remaining_cashback');

  function update(triggered = null){

    let selectedSubs = document.querySelectorAll('.sub-checkbox:checked');

    let subTotal = 0;

    selectedSubs.forEach(cb => {
        subTotal += Number(cb.dataset.amount);
    });

    // 🚨 Limit check
    if(subTotal > offerPool){

        alert("Offer limit exceeded. You only have ₹" + offerPool);

        if(triggered){
            triggered.checked = false;
        }

        selectedSubs = document.querySelectorAll('.sub-checkbox:checked');

        subTotal = 0;
        selectedSubs.forEach(cb => {
            subTotal += Number(cb.dataset.amount);
        });
    }

    let remaining = offerPool - subTotal;

    if(remaining < 0){
        remaining = 0;
    }

    totalSpan.innerText = subTotal.toFixed(2);

    remainingSpan.innerHTML =
        "<span style='color:green;font-weight:700;'>₹ "
        + remaining.toFixed(2) +
        "</span>";

    // clear old
    document.querySelectorAll('.remaining-display')
        .forEach(div => div.innerHTML = "");

    // show remaining under last selected item
    if(selectedSubs.length > 0){

        let last = selectedSubs[selectedSubs.length - 1];
        let id = last.dataset.id;

        let displayDiv = document.getElementById("remaining_for_" + id);

        if(displayDiv){
            displayDiv.innerHTML =
                "<span style='color:green;font-weight:700;'>Remaining Cashback: ₹ "
                + remaining.toFixed(2) +
                "</span>";
        }
    }

    // enable disable hidden inputs
document.querySelectorAll('.sub-checkbox').forEach(cb => {

let id = cb.dataset.id;

let labelInput = document.querySelector(
'input[name="selected_items['+id+'][label]"]'
);

let amountInput = document.querySelector(
'input[name="selected_items['+id+'][amount]"]'
);

let descriptionInput = document.querySelector(
'input[name="selected_items['+id+'][description]"]'
);

let imageInput = document.querySelector(
'input[name="selected_items['+id+'][image]"]'
);

if(labelInput) labelInput.disabled = !cb.checked;
if(amountInput) amountInput.disabled = !cb.checked;
if(descriptionInput) descriptionInput.disabled = !cb.checked;
if(imageInput) imageInput.disabled = !cb.checked;

});
}
    document.querySelectorAll('.sub-checkbox')
        .forEach(sub => {
            sub.addEventListener('change', function(){
                update(this);
            });
        });

    update();

    // Prevent main change if sub selected
   

});
</script>
<script>
    document.querySelectorAll('.main-checkbox').forEach(main => {

    main.addEventListener('change', function(){

        let label = this.dataset.label.toLowerCase();

        // If Cashback selected
        if(label.includes('cashback') && this.checked){

            // uncheck all other main offers
            document.querySelectorAll('.main-checkbox').forEach(cb=>{
                if(cb !== this){
                    cb.checked = false;
                }
            });

            // disable sub items
            document.querySelectorAll('.sub-checkbox').forEach(sub=>{
                sub.checked = false;
                sub.disabled = true;
            });

            remainingSpan.innerHTML =
                "<span style='color:green;font-weight:700;'>₹ "
                + offerPool.toFixed(2) +
                "</span>";
        }

        else if(!label.includes('cashback') && this.checked){

            // uncheck cashback
            document.querySelectorAll('.main-checkbox').forEach(cb=>{
                if(cb.dataset.label.includes('cashback')){
                    cb.checked = false;
                }
            });

            // enable sub items
            document.querySelectorAll('.sub-checkbox').forEach(sub=>{
                sub.disabled = false;
            });

        }

        // if everything unchecked
        if(!document.querySelector('.main-checkbox:checked')){

            document.querySelectorAll('.sub-checkbox').forEach(sub=>{
                sub.disabled = false;
            });

        }

    });

});
</script>
@endsection
  