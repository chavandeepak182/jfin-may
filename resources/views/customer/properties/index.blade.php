@extends('frontend.layouts.customer-dash')

@section('content')

<h2>Available Properties</h2>

@if(session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

<div style="
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap:20px;
">

@foreach($properties as $property)

    <div style="
        border:1px solid #ddd;
        padding:15px;
        border-radius:6px;
        background:#fff;
        box-shadow:0 2px 6px rgba(0,0,0,0.05);
    ">

        <h4 style="margin-bottom:8px;">
            {{ $property->title }}
        </h4>

        <p><strong>Builder:</strong> {{ $property->builder_name }}</p>
        <p><strong>City:</strong> {{ ucfirst($property->city) }}</p>
        <p><strong>BHK:</strong> {{ $property->select_bhk }}</p>

        <p>
            <strong>Price:</strong>
            ₹ {{ number_format($property->s_price) }}
        </p>

        {{-- BOOK → OPEN FORM (NOT DIRECT SUBMIT) --}}
        <a href="{{ route('customer.property.book.form', $property->properties_id) }}"
           style="
                display:inline-block;
                margin-top:10px;
                padding:8px 14px;
                background:#000;
                color:#fff;
                text-decoration:none;
                border-radius:4px;
           ">
            Book Property
        </a>

    </div>

@endforeach

</div>

@endsection
