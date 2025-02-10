@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<div class="container-fluid bg-light">
    <div class="row align-items-center">
        <!-- Left Content Section -->
        <div class="col-md-6 p-5">
            <h2 class="fw-bold">Apply for Loan Online with Jfinserv</h2>
            <p class="text-muted">Apply for a home loan online from the comfort of your home. Easy, faster & convenient digital home loan.</p>
            
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-2">
                    <i class="fa fa-check-circle text-danger me-2"></i>
                    <strong>30 years loan tenure</strong>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <i class="fa fa-check-circle text-danger me-2"></i>
                    <strong>Funding up to 85%* of property cost</strong>
                </li>
                <li class="d-flex align-items-center mb-2">
                    <i class="fa fa-check-circle text-danger me-2"></i>
                    <strong>No prepayment charges</strong>
                </li>
            </ul>

            <h5 class="fw-bold mt-4">Online application process requires the following details:</h5>
            <ul class="text-muted">
                <li>Aadhar number connected with a mobile number</li>
                <li>PAN number</li>
                <li>EPFO verification (if applicable)</li>
                <li>ITR e-filing credential</li>
                <li>Account aggregator's consent for fetching bank statement details</li>
                <li>Proposed property details</li>
                <li>Web-camera for clicking picture and performing video KYC</li>
                <li>Co-borrower/Co-owner details (if applicable)</li>
            </ul>

            <a href="{{ route('loan.form') }}" class="btn btn-danger btn-lg mt-3">Apply For Loan <i class="fa fa-arrow-right"></i></a>
        </div>

        <!-- Right Image Section -->
        <div class="col-md-6 text-center p-5">
            <img src="{{ asset('theme') }}/frontend/img/firstloan.jpg"  class="img-fluid w-100" alt="Home Loan Image">
        </div>
    </div>
</div>
@endsection