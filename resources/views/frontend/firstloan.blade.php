@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Content Section -->
        <div class="col-md-6 mb-5 p-5">
            <h2 class="fw-bold">For Salaried Employees</h2>
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
            <ul class="text-muted list-unstyled">
                <li><i class="fa fa-check-circle text-danger me-2"></i>Aadhar number connected with a mobile number</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>PAN number</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>EPFO verification (if applicable)</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>ITR e-filing credential</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Account aggregator's consent for fetching bank statement details</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Proposed property details</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Web-camera for clicking picture and performing video KYC</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Co-borrower/Co-owner details (if applicable)</li>
            </ul>

            <a class="btn-search btn btn-danger rounded-1 py-2 px-3 mt-3" href="{{ route('loan.form') }}">APPLY NOW <i class="fa fa-arrow-right"></i></a>
        </div>

        <div class="col-md-6 mb-5 p-5">
            <h2 class="fw-bold">For Business Owners</h2>
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
            <ul class="text-muted list-unstyled">
                <li><i class="fa fa-check-circle text-danger me-2"></i>Aadhar number connected with a mobile number</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>PAN number</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>EPFO verification (if applicable)</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>ITR e-filing credential</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Account aggregator's consent for fetching bank statement details</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Proposed property details</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Web-camera for clicking picture and performing video KYC</li>
                <li><i class="fa fa-check-circle text-danger me-2"></i>Co-borrower/Co-owner details (if applicable)</li>
            </ul>

            <a class="btn-search btn btn-danger rounded-1 py-2 px-3 mt-3" href="{{ route('loan.form') }}">APPLY NOW <i class="fa fa-arrow-right"></i></a>
        </div>

        <!-- Right Image Section
        <div class="col-md-6 rt-img"></div> -->
    </div>
</div>
@endsection