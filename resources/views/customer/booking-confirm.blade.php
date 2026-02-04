@extends('frontend.layouts.customer-dash')

@section('content')

<div class="container">

    <h3 class="mb-3">
        {{ $booking->status === 'customer_confirmed'
            ? 'Offer Confirmed'
            : 'Confirm Offer'
        }}
    </h3>

    {{-- STATUS --}}
    <p>
        <strong>Status:</strong>
        {{ ucwords(str_replace('_',' ',$booking->status)) }}
    </p>

    <hr>

    {{-- PROPERTY INFO --}}
    <h5>Property</h5>
    @foreach($booking->items as $item)
        <p>{{ $item->property->title ?? 'N/A' }}</p>
    @endforeach

    <hr>

    {{-- COMMISSION INFO --}}
    <h5>Commission Summary</h5>
    <p><strong>Agreement Cost:</strong>
        ₹ {{ number_format($booking->agreement_cost) }}
    </p>
    <p><strong>Commission %:</strong>
        {{ $booking->commission_percentage }}%
    </p>
    <p><strong>Actual Commission:</strong>
        ₹ {{ number_format($booking->actual_commission) }}
    </p>

    <p><strong>Offer Value:</strong>
        ₹ {{ number_format($booking->offer_pool) }}
    </p>

    <hr>

    {{-- ===========================
       CASE 1: CUSTOMER NOT CONFIRMED
    ============================ --}}
    @if($booking->status === 'waiting_customer_confirmation')

        @if(!$booking->offers)
            <p>No offers available.</p>
        @else
            <h5>Select One Offer</h5>

            <form method="POST"
                  action="{{ route('customer.booking.confirm',$booking->id) }}">
                @csrf

                @foreach(json_decode($booking->offers,true) as $offer)
                    <div style="margin-bottom:10px;">
                        <label>
                            <input type="radio"
                                   name="selected_offer"
                                   value="{{ $offer['label'] }}"
                                   required>
                            <strong>{{ $offer['label'] }}</strong>
                            – ₹ {{ number_format($offer['amount']) }}
                        </label>
                    </div>
                @endforeach

                <hr>

                <button type="submit"
                        style="padding:8px 20px; background:#000; color:#fff; border:none;">
                    Confirm Selected Offer
                </button>
            </form>
        @endif

    {{-- ===========================
       CASE 2: CUSTOMER ALREADY CONFIRMED
    ============================ --}}
    @elseif($booking->status === 'customer_confirmed')

        <p style="color:green;">
            ✔ You have already confirmed your offer.
        </p>

        <p>
            <strong>Selected Offer:</strong>
            {{ $booking->selected_offer }}
            – ₹ {{ number_format($booking->offer_pool) }}
        </p>

        <hr>

        <p>
            Our team will finalize your booking shortly.
        </p>

    @endif

</div>

@endsection
