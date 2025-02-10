@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Right Image Section -->
        <div class="col-md-6 mb-5 rt-img"></div>
        
        <!-- Left Content Section -->
        <div class="col-md-6 mb-5 p-5">
            <h2 class="fw-bold">For Salaried Individuals:</h2>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="age-tab" data-bs-toggle="tab" data-bs-target="#age" type="button" role="tab" aria-controls="age" aria-selected="true">Salaried</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="income-tab" data-bs-toggle="tab" data-bs-target="#income" type="button" role="tab" aria-controls="income" aria-selected="false">Self-Employed</button>
                </li>
            </ul>
            <div class="tab-content py-3" id="myTabContent">
                <div class="tab-pane fade show active" id="age" role="tabpanel" aria-labelledby="age-tab">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Identity Proof (Any one of the following)</strong>
                            <ul>
                                <li>Aadhaar Card</li>
                                <li>PAN Card</li>
                                <li>Voter ID</li>
                                <li>Passport</li>
                                <li>Driving License</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Address Proof (Any one of the following)</strong>
                            <ul>
                                <li>Aadhaar Card</li>
                                <li>Passport</li>
                                <li>Utility Bill (Electricity, Water, or Gas – last 3 months)</li>
                                <li>Rent Agreement</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Income Proof</strong>
                            <ul>
                                <li>Salary Slips (Last 3-6 months)</li>
                                <li>Bank Statement (Last 6 months)</li>
                                <li>Form 16 (Last 2 years)</li>
                                <li>Income Tax Returns (ITR) (Last 2 years)</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Employment Proof</strong>
                            <ul>
                                <li>Employment Offer Letter</li>
                                <li>HR Verification Letter</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Loan-Specific Documents</strong>
                            <ul>
                                <li>Loan Application Form</li>
                                <li>Passport-size Photographs</li>
                                <li>Existing Loan Statements (if applicable)</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Identity Proof (Any one of the following)</strong>
                            <ul>
                                <li>Aadhaar Card</li>
                                <li>PAN Card</li>
                                <li>Voter ID</li>
                                <li>Passport</li>
                                <li>Driving License</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Address Proof (Any one of the following)</strong>
                            <ul>
                                <li>Aadhaar Card</li>
                                <li>Passport</li>
                                <li>Utility Bill (Electricity, Water, or Gas – last 3 months)</li>
                                <li>Rent Agreement</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Income Proof</strong>
                            <ul>
                                <li>Salary Slips (Last 3-6 months)</li>
                                <li>Bank Statement (Last 6 months)</li>
                                <li>Form 16 (Last 2 years)</li>
                                <li>Income Tax Returns (ITR) (Last 2 years)</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Employment Proof</strong>
                            <ul>
                                <li>Employment Offer Letter</li>
                                <li>HR Verification Letter</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Loan-Specific Documents</strong>
                            <ul>
                                <li>Loan Application Form</li>
                                <li>Passport-size Photographs</li>
                                <li>Existing Loan Statements (if applicable)</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <a class="btn-search btn btn-danger rounded-1 py-2 px-4 mt-3" href="{{ route('loan.form') }}">APPLY NOW <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection