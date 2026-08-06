@extends('layouts.header')

@section('content')

<div class="container py-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Edit Lead</h4>

</div>

<div class="card-body">

<form action="{{ route('referraldsa.update',$lead->id) }}"
method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label>Applicant Name</label>

<input
type="text"
name="customer_name"
value="{{ $lead->customer_name }}"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Mobile</label>

<input
type="text"
name="mobile_no"
value="{{ $lead->mobile_no }}"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
value="{{ $lead->email }}"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Loan Category</label>

<select
name="loan_category_id"
class="form-control">

@foreach($loanCategories as $category)

<option
value="{{ $category->loan_category_id }}"
{{ $lead->loan_type==$category->loan_category_id ? 'selected':'' }}>

{{ $category->category_name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Loan Amount</label>

<input
type="number"
name="loan_amount"
value="{{ $lead->loan_amount }}"
class="form-control">

</div>

<div class="col-md-12 mb-3">

<label>Remarks</label>

<textarea
name="remarks"
class="form-control"
rows="3">{{ $lead->remarks }}</textarea>

</div>

<div class="col-md-12">

<button class="btn btn-success">

Update Lead

</button>

<a href="{{ route('referraldsa.list') }}"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</form>

</div>

</div>

</div>

@endsection