@extends('layouts.header')

@section('title')
    @parent
    JFS | View Estimated File
@endsection

@section('content')
@parent

<!-- ================= CARD HEADER ================= -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('estimatedFile.index') }}">Estimated Files</a>
                </li>
                <li class="breadcrumb-item active">View Estimated File</li>
            </ol>
        </nav>

        <a href="{{ route('estimatedFile.index') }}"
           class="btn btn-secondary btn-icon-text">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>
    </div>
</div>

<!-- ================= VIEW BODY ================= -->
<div class="row bg-white">
    <div class="col-lg-9 p-5">
        <div class="row">

            <!-- REPORT -->
            <div class="col-lg-4 mb-3">
                <label class="form-label">Report Month</label>
                <input type="month" class="form-control"
                       value="{{ $estimatedFile->report_month }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">App / LOS No</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->app_no }}" readonly>
            </div>

            <!-- MANAGEMENT -->
            <div class="col-lg-4 mb-3">
                <label class="form-label">BM / CH Name</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->bm_ch_name }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">Sub Manager</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->sub_manager }}" readonly>
            </div>

            <!-- PRODUCT -->
            <div class="col-lg-4 mb-3">
                <label class="form-label">Product</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->product }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">Sub Product</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->sub_product }}" readonly>
            </div>

            <!-- CUSTOMER -->
            <div class="col-lg-8 mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->customer_name }}" readonly>
            </div>

            <!-- BANK -->
            <div class="col-lg-6 mb-3">
                <label class="form-label">Bank</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->bank?->bank_name ?? '-' }}" readonly>
            </div>

            <!-- FINANCIALS -->
            <div class="col-lg-3 mb-3">
                <label class="form-label">Net Amt Disbursed</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->net_amt_disbursed }}" readonly>
            </div>

            <div class="col-lg-3 mb-3">
                <label class="form-label">Estimate Revenue</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->estimate_revenue }}" readonly>
            </div>

            <div class="col-lg-3 mb-3">
                <label class="form-label">Est Net %</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->est_net_percent }}" readonly>
            </div>

            <div class="col-lg-3 mb-3">
                <label class="form-label">DSA Payout %</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->dsa_payout_percent }}" readonly>
            </div>

            <div class="col-lg-3 mb-3">
                <label class="form-label">Est DSA Payout Amt</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->est_dsa_payout_amt }}" readonly>
            </div>

            <div class="col-lg-3 mb-3">
                <label class="form-label">TDS</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->tds }}" readonly>
            </div>

            <div class="col-lg-3 mb-3">
                <label class="form-label">Net Revenue</label>
                <input type="number" class="form-control"
                       value="{{ $estimatedFile->net_revenue }}" readonly>
            </div>

            <!-- EMP / DSA -->
            <div class="col-lg-4 mb-3">
                <label class="form-label">EMP Name</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->emp_name }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">EMP Code</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->emp_code }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">DSA Name</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->dsa_name }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">DSA Code</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->dsa_code }}" readonly>
            </div>

            <!-- CONTACT -->
            <div class="col-lg-4 mb-3">
                <label class="form-label">Mobile</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->mobile }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control"
                       value="{{ $estimatedFile->email }}" readonly>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="form-label">Source</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->source }}" readonly>
            </div>

            <!-- KYC -->
            <div class="col-lg-6 mb-3">
                <label class="form-label">PAN</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->pan }}" readonly>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="form-label">AADHAR</label>
                <input type="text" class="form-control"
                       value="{{ $estimatedFile->aadhaar }}" readonly>
            </div>

        </div>
    </div>
</div>

@endsection
