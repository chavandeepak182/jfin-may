@extends('layouts.header')

@section('content')

<div class="container py-4">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">
Add New Lead
</h4>

</div>

<div class="card-body">

<form method="POST"
action="{{ route('referraldsa.store') }}"
enctype="multipart/form-data">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label>Applicant Name <span class="text-danger">*</span></label>

<input type="text"
name="customer_name"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Mobile Number <span class="text-danger">*</span></label>

<input type="text"
maxlength="10"
name="mobile_no"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email ID <span class="text-danger">*</span></label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Gender</label>

<select
name="gender"
class="form-select">

<option value="">Select</option>

<option>Male</option>

<option>Female</option>

</select>

</div>

<div class="col-md-12 mb-3">

<label>Address <span class="text-danger">*</span></label>

<textarea
name="address"
rows="3"
class="form-control"
required></textarea>

</div>

<div class="col-md-6 mb-3">

<label>Pin Code</label>

<input
type="text"
maxlength="6"
name="pin_code"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Loan Category <span class="text-danger">*</span></label>

<select
name="loan_category_id"
class="form-select"
required>

<option value="">
Select Loan Category
</option>

@foreach($loanCategories as $category)

<option value="{{ $category->loan_category_id }}">
{{ $category->category_name }}
</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Loan Amount <span class="text-danger">*</span></label>

<input
type="number"
name="loan_amount"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Monthly Income</label>

<input
type="number"
name="monthly_income"
class="form-control">

</div>

<div class="col-md-12 mb-3">

<label>Remarks / Notes</label>

<textarea
name="remarks"
rows="3"
class="form-control"></textarea>

</div>

<div class="col-md-12 mb-4">

<label>Documents Upload (Optional)</label>

<input
type="file"
name="documents[]"
multiple
class="form-control">

<small class="text-muted">
Upload ID Proof, Income Proof, PDF, JPG, PNG
</small>

</div>

<div class="col-md-12 text-end">

<button
class="btn btn-primary px-5">

<i class="fas fa-save"></i>

Save Lead

</button>

</div>

</div>

</form>

</div>

</div>

</div>

@endsection