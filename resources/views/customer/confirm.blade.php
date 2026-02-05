@extends('frontend.layouts.customer-dash')
@section('content')
<form method="POST" action="/booking/confirm/{{ $booking->id }}">
@csrf
<p>Offer Type: {{ $booking->offer_type }}</p>
<p>Final Commission: {{ $booking->final_commission }}</p>
<button>Confirm</button>
</form>
@endsection
