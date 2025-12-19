@extends('layouts.header')

@section('title')
    @parent
    JFS | Edit Estimated File
@endsection

@section('content')
@parent

<form method="POST" action="{{ route('estimatedFile.update', $estimatedFile->id) }}">
    @csrf

    <!-- ================= CARD HEADER ================= -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Estimated File
                    </li>
                </ol>
            </nav>

            <!-- Buttons -->
            <div class="hstack gap-3">
                <button type="button"
                        class="btn btn-light border btn-icon-text"
                        onclick="window.history.back()">
                    <i class="bi bi-x"></i>
                    <span class="text">Cancel</span>
                </button>

                <button type="submit" class="btn btn-primary btn-icon-text">
                    <i class="bi bi-save"></i>
                    <span class="text">Update</span>
                </button>
            </div>

        </div>
    </div>

    <!-- ================= FORM BODY ================= -->
    <div class="row bg-white">
        <div class="col-lg-9 p-5">
            <div class="row">

                <!-- REPORT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Report Month</label><span class="text-danger">*</span>
                        <input type="month"
                               name="report_month"
                               class="form-control"
                               value="{{ \Carbon\Carbon::parse($estimatedFile->report_month)->format('Y-m') }}"
                               required>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">App No</label>
                        <input type="text" name="app_no" class="form-control"
                               value="{{ $estimatedFile->app_no }}">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">LOS No</label>
                        <input type="text" name="los_no" class="form-control"
                               value="{{ $estimatedFile->los_no }}">
                    </div>
                </div>

                <!-- MANAGEMENT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">BM / CH Name</label>
                        <input type="text" name="bm_ch_name" class="form-control"
                               value="{{ $estimatedFile->bm_ch_name }}">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Sub Manager</label>
                        <input type="text" name="sub_manager" class="form-control"
                               value="{{ $estimatedFile->sub_manager }}">
                    </div>
                </div>

                <!-- PRODUCT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" name="product" class="form-control"
                               value="{{ $estimatedFile->product }}">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Sub Product</label>
                        <input type="text" name="sub_product" class="form-control"
                               value="{{ $estimatedFile->sub_product }}">
                    </div>
                </div>

                <!-- CUSTOMER -->
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label><span class="text-danger">*</span>
                        <input type="text" name="customer_name" class="form-control"
                               value="{{ $estimatedFile->customer_name }}" required>
                    </div>
                </div>

                <!-- BANK -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Bank</label><span class="text-danger">*</span>
                        <select name="bank_id" class="form-control" required>
                            <option value="">Select Bank</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->bank_id }}"
                                    {{ $estimatedFile->bank_id == $bank->bank_id ? 'selected' : '' }}>
                                    {{ $bank->bank_name }} ({{ $bank->ifsc_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- FINANCIALS -->
                <div class="col-lg-3">
                    <label class="form-label">Net Amt Disbursed</label>
                    <input type="number" step="0.01" name="net_amt_disbursed"
                           class="form-control" value="{{ $estimatedFile->net_amt_disbursed }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Estimate Revenue</label>
                    <input type="number" step="0.01" name="estimate_revenue" readonly
                           class="form-control" value="{{ $estimatedFile->estimate_revenue }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Est Net %</label>
                    <input type="number" step="0.01" name="est_net_percent"
                           class="form-control" value="{{ $estimatedFile->est_net_percent }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">DSA Payout %</label>
                    <input type="number" step="0.01" name="dsa_payout_percent"
                           class="form-control" value="{{ $estimatedFile->dsa_payout_percent }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Est DSA Payout Amt</label>
                    <input type="number" step="0.01" name="est_dsa_payout_amt" readonly
                           class="form-control" value="{{ $estimatedFile->est_dsa_payout_amt }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">TDS</label>
                    <input type="number" step="0.01" name="tds" readonly
                           class="form-control" value="{{ $estimatedFile->tds }}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">Net Revenue</label>
                    <input type="number" step="0.01" name="net_revenue" readonly
                           class="form-control" value="{{ $estimatedFile->net_revenue }}">
                </div>

                <!-- EMP / DSA -->
                <div class="col-lg-4">
                    <label class="form-label">EMP Name</label>
                    <input type="text" name="emp_name" class="form-control"
                           value="{{ $estimatedFile->emp_name }}">
                </div>

                <div class="col-lg-4">
                    <label class="form-label">EMP Code</label>
                    <input type="text" name="emp_code" class="form-control"
                           value="{{ $estimatedFile->emp_code }}">
                </div>

                <div class="col-lg-4">
                    <label class="form-label">DSA Name</label>
                    <input type="text" name="dsa_name" class="form-control"
                           value="{{ $estimatedFile->dsa_name }}">
                </div>

                <div class="col-lg-4">
                    <label class="form-label">DSA Code</label>
                    <input type="text" name="dsa_code" class="form-control"
                           value="{{ $estimatedFile->dsa_code }}">
                </div>

                <!-- CONTACT -->
                <div class="col-lg-4">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control"
                           value="{{ $estimatedFile->mobile }}">
                </div>

                <div class="col-lg-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $estimatedFile->email }}">
                </div>

                <div class="col-lg-4">
                    <label class="form-label">Source</label>
                    <input type="text" name="source" class="form-control"
                           value="{{ $estimatedFile->source }}">
                </div>

                <!-- KYC -->
                <div class="col-lg-6">
                    <label class="form-label">PAN</label>
                    <input type="text" name="pan" class="form-control"
                           value="{{ $estimatedFile->pan }}">
                </div>

                <div class="col-lg-6">
                    <label class="form-label">AADHAR</label>
                    <input type="text" name="aadhaar" class="form-control"
                           value="{{ $estimatedFile->aadhaar }}">
                </div>

            </div>
        </div>
    </div>
</form>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function calculateRevenue() {
        let netAmt = parseFloat(document.querySelector('[name="net_amt_disbursed"]').value) || 0;
        let netPct = parseFloat(document.querySelector('[name="est_net_percent"]').value) || 0;
        let dsaPct = parseFloat(document.querySelector('[name="dsa_payout_percent"]').value) || 0;

        let estimateRevenue  = (netAmt * netPct) / 100;
        let dsaPayoutAmt     = (netAmt * dsaPct) / 100;
        let tds              = (estimateRevenue * 5) / 100;
        let netRevenue       = estimateRevenue - dsaPayoutAmt - tds;

        document.querySelector('[name="estimate_revenue"]').value = estimateRevenue.toFixed(2);
        document.querySelector('[name="est_dsa_payout_amt"]').value = dsaPayoutAmt.toFixed(2);
        document.querySelector('[name="tds"]').value = tds.toFixed(2);
        document.querySelector('[name="net_revenue"]').value = netRevenue.toFixed(2);
    }

    // Run once on page load (IMPORTANT for edit)
    calculateRevenue();

    // Attach listeners
    document.querySelector('[name="net_amt_disbursed"]').addEventListener('input', calculateRevenue);
    document.querySelector('[name="est_net_percent"]').addEventListener('input', calculateRevenue);
    document.querySelector('[name="dsa_payout_percent"]').addEventListener('input', calculateRevenue);

});
</script>
@endpush
@endsection
