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

    {{-- STATUS --}}
    <p>
        <strong>Status:</strong>
        {{ ucwords(str_replace('_',' ',$booking->status)) }}
    </p>

    <hr>

    {{-- PROPERTY INFO --}}
    <h5 class="section-title">Property</h5>
    <div class="selected-prop">
        <h3 class="selected-title">SELECTED PROPERTY</h3>
    @foreach($booking->items as $item)
        <p class="property-name">{{ $item->property->title ?? 'N/A' }}</p>
    @endforeach
    </div>
    <hr>

    {{-- COMMISSION INFO --}}
    <h5 class="section-title">Commission Summary</h5>
    <div class="calculation-panel">
        <div class="calculation-row">
            <p><strong>Agreement Cost:</strong>
                ₹ {{ number_format($booking->agreement_cost) }}
            </p>
        </div>
        <div class="calculation-row">
            <p><strong>Commission %:</strong>
                {{ $booking->commission_percentage }}%
            </p>
        </div>
        <div class="calculation-row">
            <p><strong>Actual Commission:</strong>
                ₹ {{ number_format($booking->actual_commission) }}
            </p>
        </div>
        <div class="calculation-row">
            <p><strong>Offer Value:</strong>
                ₹ {{ number_format($booking->offer_pool) }}
            </p>
        </div>
    </div>
    <hr>

    {{-- ===========================
       CASE 1: CUSTOMER NOT CONFIRMED
    ============================ --}}
    @if($booking->status === 'waiting_customer_confirmation')
        
        @if(!$booking->offers)
        <div>
            <p class="offer-title">No offers available.</p>
        </div>
        @else
        <div class="section">
            <h5 class="offer-title">Select One Offer</h5>
        </div>
        <div class="section">
            <form method="POST"
                  action="{{ route('customer.booking.confirm',$booking->id) }}">
                @csrf
            <div class="offers">
                @foreach(json_decode($booking->offers,true) as $offer)
                    <div class="offer-item" style="margin-bottom:10px;">
                        <label class="offer-name">
                            <input class="offer-input"
                                type="radio"
                                   name="selected_offer"
                                   value="{{ $offer['label'] }}"
                                   required>
                            <strong>{{ $offer['label'] }}</strong></label>

                            <p class="offer-amount">₹ {{ number_format($offer['amount']) }}</p>
                    </div>
                @endforeach
            </div>
        
            <div class="confirm-btn">
                <button class="btn btn-primary" type="submit">
                    Confirm Selected Offer
                </button>
            </div>
            </form>
        </div>
        @endif

    {{-- ===========================
       CASE 2: CUSTOMER ALREADY CONFIRMED
    ============================ --}}
    @elseif($booking->status === 'customer_confirmed')

        <p style="color:green;">
            ✔ You have already confirmed your offer.
        </p>

        <h2 class="section-title">
            Selected Offer:</h2>
            <div class="selected-prop">
        <p class="selected-offer"><strong>{{ $booking->selected_offer }}</strong>
            – ₹ {{ number_format($booking->offer_pool) }}
        </p>
        </div>

        <hr>

        <p class="team-msg">
            Our team will finalize your booking shortly.
        </p>

    @endif

</div>

@endsection
