@extends('frontend.layouts.customer-dash')
@section('content')
<form method="POST" action="/booking/store">
@csrf

@foreach($properties as $property)
    <input type="checkbox" name="property_ids[]" value="{{ $property->id }}">
    {{ $property->name }} <br>
@endforeach

<button type="submit">Book Property</button>
</form>
@endsection