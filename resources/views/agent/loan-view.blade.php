@extends('layouts.header')

@section('title', 'Loan Details')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Loan Details</h2>

    <!-- Loan Details Form -->
    <form>
        <!-- Personal Information Section -->
        <h4 class="mb-3">Personal Information</h4>
        <div class="row">
            <div class="col-md-4">
                <label for="full_name" class="form-label">Full Name:</label>
                <input type="text" class="form-control" id="full_name" value="{{ $loan->user->name }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email ID:</label>
                <input type="email" class="form-control" id="email_id" value="{{ $loan->user->email_id }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="mobile" class="form-label">Mobile Number:</label>
                <input type="tel" class="form-control" id="mobile_no" value="{{ $loan->user->mobile_no }}" readonly>
            </div>
        </div>

        <hr>

        <!-- Loan Information Section -->
        <h4 class="mb-3">Loan Information</h4>
        <div class="row">
            <div class="col-md-4">
                <label for="loan_category" class="form-label">Loan Category:</label>
                <input type="text" class="form-control" id="loan_category" value="{{ $loan->loanCategory->name }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="amount" class="form-label">Loan Amount:</label>
                <input type="text" class="form-control" id="amount" value="{{ $loan->amount }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="tenure" class="form-label">Tenure:</label>
                <input type="text" class="form-control" id="tenure" value="{{ $loan->tenure }}" readonly>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <label for="loan_reference_id" class="form-label">Loan Reference ID:</label>
                <input type="text" class="form-control" id="loan_reference_id" value="{{ $loan->loan_reference_id }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="agent" class="form-label">Assigned Employee:</label>
                <input type="text" class="form-control" id="agent" value="{{ $loan->agent->name ?? 'Not Assigned' }}" readonly>
            </div>
            <div class="col-md-4">
                <label for="status" class="form-label">Status:</label>
                <input type="text" class="form-control" id="status" value="{{ $loan->status }}" readonly>
            </div>
        </div>

        <hr>

        <!-- Loan Documents Section -->
        <h4 class="mb-3">Loan Documents</h4>
        <div class="row">
            <div class="col-md-6">
                <label for="document1" class="form-label">Document 1:</label>
                <a href="{{ asset('storage/' . $loan->document1) }}" target="_blank" class="form-control-link">View Document</a>
            </div>
            <div class="col-md-6">
                <label for="document2" class="form-label">Document 2:</label>
                <a href="{{ asset('storage/' . $loan->document2) }}" target="_blank" class="form-control-link">View Document</a>
            </div>
        </div>

        <hr>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('loans.index') }}" class="btn btn-secondary">Back to Loans List</a>
        </div>
    </form>
</div>
@endsection
