@extends('layouts.header')

@section('content')
<form method="POST" action="/admin/booking/review/{{ $booking->id }}">
@csrf
<input name="agreement_cost" placeholder="Agreement Cost">
<input name="commission_percentage" placeholder="Commission %">
<button>Save</button>
</form>

<hr>

<form method="POST" action="/admin/booking/offer/{{ $booking->id }}">
@csrf

<select name="offer_type">
    <option value="none">No Offer</option>
    <option value="cashback">Cashback</option>
    <option value="furniture">Furniture</option>
</select>

<input name="cashback_amount" placeholder="Cashback">

<input name="admin_amount" placeholder="Admin Furniture Amount">
<input name="customer_amount" placeholder="Customer Furniture Amount">

<button>Submit</button>
</form>
@endsection