@extends('layouts.header')

@section('title')
    @parent
    JFS | Add Estimated File
@endsection

@section('content')
@parent

<form method="POST" action="{{ route('estimatedFile.store') }}">
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
                        Add Estimated File
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
                    <span class="text">Save</span>
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
                        <input type="month" name="report_month" class="form-control" required>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">App/LOS No</label>
                        <input type="text" name="app_no" class="form-control">
                    </div>
                </div>

                <!-- <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">LOS No</label>
                        <input type="text" name="los_no" class="form-control">
                    </div>
                </div> -->

                <!-- MANAGEMENT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">BM / CH Name</label>
                        <input type="text" name="bm_ch_name" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Sub Manager</label>
                        <input type="text" name="sub_manager" class="form-control">
                    </div>
                </div>

                <!-- PRODUCT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <input type="text" name="product" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Sub Product</label>
                        <input type="text" name="sub_product" class="form-control">
                    </div>
                </div>

                <!-- CUSTOMER -->
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label><span class="text-danger">*</span>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>
                </div>

                <!-- BANK -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Bank</label><span class="text-danger">*</span>
                        <select name="bank_id" class="form-control" required>
                            <option value="">Select Bank</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->bank_id }}">
                                    {{ $bank->bank_name }} ({{ $bank->ifsc_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- FINANCIALS -->
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Net Amt Disbursed</label>
                        <input type="number" step="0.01" name="net_amt_disbursed" class="form-control">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Estimate Revenue</label>
                        <input type="number" step="0.01" name="estimate_revenue" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Est Net %</label>
                        <input type="number" step="0.01" name="est_net_percent" class="form-control">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">DSA Payout %</label>
                        <input type="number" step="0.01" name="dsa_payout_percent" class="form-control">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Est DSA Payout Amt</label>
                        <input type="number" step="0.01" name="est_dsa_payout_amt" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">TDS</label>
                        <input type="number" step="0.01" name="tds" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Net Revenue</label>
                        <input type="number" step="0.01" name="net_revenue" class="form-control" readonly>
                    </div>
                </div>

                <!-- EMP / DSA -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">EMP Name</label>
                        <input type="text" name="emp_name" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">EMP Code</label>
                        <input type="text" name="emp_code" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">DSA Name</label>
                        <input type="text" name="dsa_name" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">DSA Code</label>
                        <input type="text" name="dsa_code" class="form-control">
                    </div>
                </div>

                <!-- CONTACT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Source</label>
                        <input type="text" name="source" class="form-control">
                    </div>
                </div>

                <!-- KYC -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">PAN</label>
                        <input type="text" name="pan" class="form-control">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">AADHAR</label>
                        <input type="text" name="aadhaar" class="form-control">
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@push('scripts')
<script>
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

    document.querySelector('[name="net_amt_disbursed"]').addEventListener('input', calculateRevenue);
    document.querySelector('[name="est_net_percent"]').addEventListener('input', calculateRevenue);
    document.querySelector('[name="dsa_payout_percent"]').addEventListener('input', calculateRevenue);
</script>
@endpush
@endsection
