@extends('layouts.header')

@section('title')
    @parent
    JFS | Add Estimated File
@endsection

@section('content')
@parent
<style>
    .abbr {
    position: relative;
    cursor: pointer;
}

/* Tooltip Box */
.abbr::after {
    content: attr(data-title);
    position: absolute;
    bottom: 130%;
    left: 50%;
    transform: translateX(-50%) translateY(10px);
    
    background: #1e293b;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    white-space: nowrap;
    
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10;
}

/* Small Arrow */
.abbr::before {
    content: "";
    position: absolute;
    bottom: 120%;
    left: 50%;
    transform: translateX(-50%);
    
    border-width: 6px;
    border-style: solid;
    border-color: #1e293b transparent transparent transparent;
    
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

/* Hover Effect */
.abbr:hover::after,
.abbr:hover::before {
    opacity: 1;
    visibility: visible;
    transform: translateX(-15%) translateY(0);
}
.fa-circle-info{
    width:12px;
    height:12px;
}
.hover-msg{
    font-size:12px;
    color:#827fc7;
    margin-bottom:0;
}
</style>
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
                <p class="hover-msg">Please Hover on the labels to know more about them.</p>
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
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Application / Loan Origination System Number">App/LOS No</span></label>
                        <input type="text" name="app_no" class="form-control">
                        <small class="text-danger d-none"></small>
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
                        <label class="form-label"><span class="abbr" data-title="Branch Manager / Channel Head Name">BM / CH Name</span></label>
                        <input type="text" name="bm_ch_name" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Subordinate Manager">Sub Manager</span></label>
                        <input type="text" name="sub_manager" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <!-- PRODUCT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title=" Type of financial product">Product</span></label>
                        <input type="text" name="product" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title=" Sub-category of product">Sub Product</span></label>
                        <input type="text" name="sub_product" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <!-- CUSTOMER -->
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label><span class="text-danger">*</span>
                        <input type="text" name="customer_name"
       oninput="this.value=this.value.replace(/[^a-zA-Z ]/g,'')" class="form-control">
       <small class="text-danger d-none"></small>

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
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <!-- FINANCIALS -->
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title=" Net Amount Disbursed">Net Amt Disbursed</span</label>
                        <input type="number" step="0.01" name="net_amt_disbursed" class="form-control">
                        <small class="text-danger d-none"></small>
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
                        <label class="form-label"><span class="abbr" data-title=" Estimated Net Percentage">Est Net %</span></label>
                        <input type="number" step="0.01" name="est_net_percent" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title=" Estimated Net Percentage">DSA Payout %</span></label>
                        <input type="number" step="0.01" name="dsa_payout_percent" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title=" Estimated Direct Selling Agent Payout Amount">Est DSA Payout Amt</span></label>
                        <input type="number" step="0.01" name="est_dsa_payout_amt" class="form-control" readonly>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Tax Deducted at Source">TDS</span></label>
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
                        <label class="form-label"><span class="abbr" data-title="Employee Name">EMP Name</span></label>
                        <input type="text" name="emp_name" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Employee Code">EMP Code</span></label>
                        <input type="text" name="emp_code" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Direct Selling Agent Name">DSA Name</span></label>
                        <input type="text" name="dsa_name" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Direct Selling Agent Code">DSA Code</span></label>
                        <input type="text" name="dsa_code" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <!-- CONTACT -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Mobile</label>
                                            <input type="text"
                        name="mobile"
                        maxlength="10"
                        class="form-control"
                        placeholder="10 digit mobile"
                        oninput="onlyNumber(this)">
<small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="Lead Source">Source</span></label>
                        <input type="text" name="source" class="form-control">
                        <small class="text-danger d-none"></small>
                    </div>
                </div>

                <!-- KYC -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label"><span class="abbr" data-title="permanent Account Number">PAN</span></label>
                        <input type="text"
                        name="pan"
                        maxlength="10"
                        class="form-control"
                        placeholder="ABCDE1234F"
                        oninput="formatPAN(this)"
                        style="text-transform:uppercase">
                        <small class="text-danger d-none"></small>


                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">AADHAR</label>
                        <input type="text" name="aadhaar" maxlength="12"
       oninput="this.value=this.value.replace(/[^0-9]/g,'')" class="form-control">
       <small class="text-danger d-none"></small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@push('scripts')

<script>
document.addEventListener('input', function (e) {
    const el = e.target;
    if (!el.classList.contains('form-control')) return;

    const name = el.getAttribute('name');
    const small = el.parentElement.querySelector('small');
    if (!small) return;

    const show = (msg) => {
        small.innerText = msg;
        small.classList.remove('d-none');
    };

    const hide = () => {
        small.innerText = '';
        small.classList.add('d-none');
    };

    let oldVal = el.value;

    /* ===== MOBILE ===== */
    if (name === 'mobile') {
        el.value = el.value.replace(/[^0-9]/g, '');
        if (el.value.length > 0 && el.value.length < 10) {
            show('Mobile must be 10 digits');
        } else {
            hide();
        }
    }

    /* ===== AADHAAR ===== */
    else if (name === 'aadhaar') {
        el.value = el.value.replace(/[^0-9]/g, '');
        if (el.value.length > 0 && el.value.length < 12) {
            show('Aadhaar must be 12 digits');
        } else {
            hide();
        }
    }

    /* ===== PAN ===== */
    else if (name === 'pan') {
        el.value = el.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
        const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]$/;
        if (el.value.length === 10 && !panRegex.test(el.value)) {
            show('PAN format: ABCDE1234F');
        } else {
            hide();
        }
    }

    /* ===== ONLY TEXT FIELDS ===== */
    else if (
        ['customer_name','bm_ch_name','sub_manager','product','sub_product',
         'emp_name','dsa_name','source'].includes(name)
    ) {
        el.value = el.value.replace(/[^a-zA-Z ]/g, '');
        oldVal !== el.value
            ? show('Only characters allowed')
            : hide();
    }

    /* ===== ALPHANUMERIC ===== */
    else if (
        ['app_no','emp_code','dsa_code'].includes(name)
    ) {
        el.value = el.value.replace(/[^a-zA-Z0-9]/g, '');
        oldVal !== el.value
            ? show('Only letters & numbers allowed')
            : hide();
    }

    /* ===== NUMBERS ONLY ===== */
    else if (
        ['net_amt_disbursed','est_net_percent','dsa_payout_percent'].includes(name)
    ) {
        el.value = el.value.replace(/[^0-9.]/g, '');
        oldVal !== el.value
            ? show('Only numbers allowed')
            : hide();
    }
});
</script>


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
<script>
function onlyNumber(el){
    el.value = el.value.replace(/[^0-9]/g,'');
}

function onlyText(el){
    el.value = el.value.replace(/[^a-zA-Z ]/g,'');
}
</script>
<script>
function formatPAN(el){
    // remove special chars
    el.value = el.value.replace(/[^a-zA-Z0-9]/g, '');

    // force CAPITAL
    el.value = el.value.toUpperCase();
}
</script>

<script>
function onlyNumber(el){
    el.value = el.value.replace(/[^0-9]/g, '');
}
</script>

@endpush
@endsection
