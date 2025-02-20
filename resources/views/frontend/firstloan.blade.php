@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Right Image Section -->
        <div class="col-md-6 mb-5 rt-img"></div>
        
        <!-- Left Content Section -->
        <div class="col-md-6 mb-5 p-5">
            <h2 class="fw-bold">Apply for a Loan Online with JFinserv's Digital Loan Portal.</h2>
            <p>Apply for a loan online with JFinserv's Digital Loan Portal for quick approvals and personalized options.</p>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="rounded-1 nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Salaried</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Self-Employed</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Identity Proof (Any one of the following)</strong>
                            <ul>
                                <li>Aadhaar Card</li>
                                <li>PAN Card</li>
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
                                <li>ITR & Form 16 (Last 2 years)</li>
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
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>KYC Documents</strong>
                            <ul>
                                <li>Aadhaar Card</li>
                                <li>PAN Card</li>
                                <li>Passport</li>
                                <li>Current & Permanent Residence Proof</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Income Proof</strong>
                            <ul>
                                <li>ITR with Tax Paid challan</li>
                                <li>Balance Sheet (Last 2-3 years)</li>
                                <li>Bank Statement (Last 12 months)</li>
                                <li>Bank account statements for the last 12 months from all banks</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Business Proof</strong>
                            <ul>
                                <li>Workplace rent agreement (if rented) & Electricity Bill</li>
                                <li>Business License like Shop Act, GST Registration, UDYAM, last 3 months GST Return</li>
                            </ul>
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-check-circle text-danger"></i>
                            <strong>Others</strong>
                            <ul>
                                <li>Closure letter</li>
                                <li>Degree Certificate</li>
                                <li>All Property (Chain) Documents</li>
                                <li>If takeover existing loan statement, sanction letter</li>
                                <li>Loan statement for the last 12 months with sanction letter & repayment schedule</li>
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