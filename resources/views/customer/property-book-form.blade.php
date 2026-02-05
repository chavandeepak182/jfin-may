@extends('frontend.layouts.customer-dash')

@section('content')

<h3>Property Booking Form</h3>

<form method="POST" action="{{ route('customer.property.book.submit') }}">
@csrf

<input type="hidden" name="property_id" value="{{ $property->properties_id }}">

<h4>Customer Details</h4>

<input type="text" name="customer_name"
       value="{{ $customer->name }}" required placeholder="Name"><br><br>

<input type="email" name="customer_email"
       value="{{ $customer->email_id }}" required placeholder="Email"><br><br>

<input type="text" name="customer_mobile"
       value="{{ $customer->mobile_no }}" required placeholder="Mobile"><br><br>

<input type="text" name="customer_pan"
       value="{{ $customer->pan_no }}" placeholder="PAN (Optional)"><br><br>

<hr>

<h4>Property</h4>
<p><strong>{{ $property->title }}</strong></p>
<p>{{ $property->city }} | {{ $property->select_bhk }}</p>

<hr>

<h4>Co-Applicant (Optional)</h4>

<input type="text" name="co_name" placeholder="Name"><br><br>
<input type="email" name="co_email" placeholder="Email"><br><br>
<input type="text" name="co_mobile" placeholder="Mobile"><br><br>

<select name="co_employment_type">
    <option value="">Employment Type</option>
    <option value="salaried">Salaried</option>
    <option value="self_employed">Self Employed</option>
</select><br><br>

<input type="text" name="co_designation" placeholder="Designation"><br><br>

<select name="co_gender">
    <option value="">Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
</select><br><br>

<select name="co_marital_status">
    <option value="">Marital Status</option>
    <option value="single">Single</option>
    <option value="married">Married</option>
</select><br><br>

<button type="submit"
        style="padding:10px 20px;background:#000;color:#fff;border:none;">
    Submit Booking
</button>

</form>

@endsection
