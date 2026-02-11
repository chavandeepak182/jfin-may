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
                                   data-label="{{ $main['label'] }}"
                                   data-amount="{{ $main['amount'] }}">
                            <strong>{{ $main['label'] }}</strong>
                            – ₹ {{ number_format($main['amount'],2) }}
                        </label>

                        {{-- SUB ITEMS --}}
                        @if(!empty($main['items']))
                            <div style="margin-left:25px; margin-top:8px;">
                                @foreach($main['items'] as $subIndex => $sub)
                                    <div>
                                        <label>
                                            <input type="checkbox"
                                                   class="sub-checkbox"
                                                   data-parent="{{ $mainIndex }}"
                                                   data-label="{{ $sub['label'] }}"
                                                   data-amount="{{ $sub['amount'] }}">
                                            {{ $sub['label'] }}
                                            – ₹ {{ number_format($sub['amount'],2) }}
                                        </label>
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
            </p>

            <button type="submit" class="btn btn-primary">
                Confirm Selection
            </button>

        </form>

        @endif

    @elseif($booking->status === 'customer_confirmed')

        <p style="color:green;">
            ✔ You have confirmed your selection.
        </p>

        @php
            $selected = json_decode($booking->selected_offer, true);
        @endphp

        @foreach($selected as $item)
            <p>
                <strong>{{ $item['label'] }}</strong>
                – ₹ {{ number_format($item['amount'],2) }}
            </p>
        @endforeach

    @endif

</div>
<script>
document.addEventListener("DOMContentLoaded", function(){

    let form = document.getElementById("confirmForm");
    if(!form) return;

    let offerPool = {{ $booking->offer_pool ?? 0 }};
    let totalSpan = document.getElementById('selected_total');

    function updateTotal() {
        let total = 0;

        document.querySelectorAll('.sub-checkbox:checked')
            .forEach(cb => {
                total += parseFloat(cb.dataset.amount || 0);
            });

        // If main has NO sub items
        document.querySelectorAll('.main-checkbox:checked')
            .forEach(main => {

                let parent = main.dataset.index;

                let subs = document.querySelectorAll(
                    '.sub-checkbox[data-parent="'+parent+'"]'
                );

                if(subs.length === 0){
                    total += parseFloat(main.dataset.amount || 0);
                }
            });

        totalSpan.innerText = total.toFixed(2);
        return total;
    }

    /* MAIN CLICK */
    document.querySelectorAll('.main-checkbox')
        .forEach(main => {
            main.addEventListener('change', function(){

                let index = this.dataset.index;

                let subs = document.querySelectorAll(
                    '.sub-checkbox[data-parent="'+index+'"]'
                );

                subs.forEach(s => s.checked = this.checked);

                updateTotal();
            });
        });

    /* SUB CLICK */
    document.querySelectorAll('.sub-checkbox')
        .forEach(sub => {
            sub.addEventListener('change', function(){

                let parent = this.dataset.parent;

                let subs = document.querySelectorAll(
                    '.sub-checkbox[data-parent="'+parent+'"]'
                );

                let main = document.querySelector(
                    '.main-checkbox[data-index="'+parent+'"]'
                );

                let allChecked = true;
                subs.forEach(s => {
                    if(!s.checked) allChecked = false;
                });

                if(main) main.checked = allChecked;

                updateTotal();
            });
        });

    /* SUBMIT */
    form.addEventListener("submit", function(e){

        let total = updateTotal();

        if(total !== offerPool){
            alert("Total selected amount must equal ₹ " + offerPool.toFixed(2));
            e.preventDefault();
            return;
        }

        document.querySelectorAll('.dynamic-input')
            .forEach(el => el.remove());

        let index = 0;

        // SUB ITEMS
        document.querySelectorAll('.sub-checkbox:checked')
            .forEach(cb => {

                let labelInput = document.createElement("input");
                labelInput.type = "hidden";
                labelInput.name = "selected_items["+index+"][label]";
                labelInput.value = cb.dataset.label;
                labelInput.classList.add("dynamic-input");

                let amountInput = document.createElement("input");
                amountInput.type = "hidden";
                amountInput.name = "selected_items["+index+"][amount]";
                amountInput.value = cb.dataset.amount;
                amountInput.classList.add("dynamic-input");

                form.appendChild(labelInput);
                form.appendChild(amountInput);

                index++;
            });

        // MAIN WITHOUT SUBS
        document.querySelectorAll('.main-checkbox:checked')
            .forEach(main => {

                let parent = main.dataset.index;

                let subs = document.querySelectorAll(
                    '.sub-checkbox[data-parent="'+parent+'"]'
                );

                if(subs.length === 0){

                    let labelInput = document.createElement("input");
                    labelInput.type = "hidden";
                    labelInput.name = "selected_items["+index+"][label]";
                    labelInput.value = main.dataset.label;
                    labelInput.classList.add("dynamic-input");

                    let amountInput = document.createElement("input");
                    amountInput.type = "hidden";
                    amountInput.name = "selected_items["+index+"][amount]";
                    amountInput.value = main.dataset.amount;
                    amountInput.classList.add("dynamic-input");

                    form.appendChild(labelInput);
                    form.appendChild(amountInput);

                    index++;
                }
            });

        if(index === 0){
            alert("Please select at least one option.");
            e.preventDefault();
        }

    });

});
</script>



@endsection
