@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
 @section('script')
@parent
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

<style>
.analytics-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px;
    height: 150px;
    border: 2px solid #e5efff;
    box-shadow: 0 10px 25px rgba(59,130,246,0.12);
    transition: all 0.2s ease;
}

.analytics-card.active {
    border-color: #3b82f6;
}

.analytics-card:hover {
    transform: translateY(-3px);
}

.analytics-row {
    display: flex;
    align-items: flex-start;
    gap: 18px;
}

.analytics-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

.icon-blue   { background: #e0ecff; color: #3b82f6; }
.icon-pink   { background: #ffe3ef; color: #ec4899; }
.icon-yellow { background: #fff4cc; color: #f59e0b; }
.icon-green  { background: #dcfce7; color: #22c55e; }

.analytics-content {
    flex: 1;
}

.analytics-title {
    font-size: 18px;
    color: #6b7280;
    margin-bottom: 8px;
}

.analytics-bottom {
    display: flex;
    align-items: center;
    gap: 14px;
}

.analytics-value {
    font-size: 30px;
    font-weight: 700;
    color: #111827;
}

.analytics-growth {
    font-size: 13px;
    color: #22c55e;
}

/* FIX PAGINATION UI */
.pagination {
    justify-content: center;
}

.pagination li a,
.pagination li span {
    font-size: 14px !important;
    line-height: 1.5 !important;
    padding: 6px 12px !important;
}

.pagination svg {
    width: 16px !important;
    height: 16px !important;
}

.pagination li {
    display: inline-block;
}

</style>

    

 
             <!-- Header -->
<div class="page-header d-flex justify-content-between align-items-center">
    <h1>Master</h1>

    <div class="d-flex gap-2">

        

       
        <div id="addBankBtn" style="display:none;">
            <button type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addBankView">
                <i class="fa fa-plus"></i> Add Bank
            </button>
        </div>

       
        <div id="addEstimatedBtn" style="display:none;">
            <a href="{{ route('estimatedFile.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add Estimated File
            </a>
            

        </div>
            <div id="addMonthlyBtn" style="display:none;">
            <a href="{{ route('monthlyPL.index') }}"
                class="btn btn-primary">
                + Create Monthly P&L
                </a>
            

        </div>
       
        

    </div>
</div>

    <div class="row g-4">
            



   
    

            <!-- Estimated Files -->
            <!-- <div class="col-xl-3 col-lg-4 col-md-6"> 
                <div class="analytics-card"
                    onclick="showEstimatedFiles()"
                    style="cursor:pointer;">

                    <div class="analytics-row">
                        <div class="analytics-icon icon-purple">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>

                        <div class="analytics-content">
                            <div class="analytics-title">Estimated Files</div>

                            <div class="analytics-bottom">
                                <div class="analytics-value">
                                    {{ $totalEstimatedFiles }}
                                </div>
                            </div>

                            <div class="analytics-bottom">
                                <div class="analytics-growth">
                                    Calculated from records
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>  -->


            <div class="col-xl-3 col-lg-4 col-md-6">
    <a href="{{ url('admin/estimated-file') }}" style="text-decoration:none; color:inherit;">
        <div class="analytics-card" style="cursor:pointer;">

            <div class="analytics-row">
                <div class="analytics-icon icon-purple">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>

                <div class="analytics-content">
                    <div class="analytics-title">Estimated Files</div>

                    <div class="analytics-bottom">
                        <div class="analytics-value">
                            {{ $totalEstimatedFiles }}
                        </div>
                    </div>

                    <div class="analytics-bottom">
                        <div class="analytics-growth">
                            Calculated from records
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </a>
</div>

<!-- 
            <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="analytics-card"
                onclick="showMonthlyPL()"
                style="cursor:pointer;">

                <div class="analytics-row">
                    <div class="analytics-icon icon-blue">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>

                    <div class="analytics-content">
                        <div class="analytics-title">Monthly P&amp;L</div>

                        <div class="analytics-bottom">
                            <div class="analytics-value">
                                {{ $totalMonthlyPL }}
                            </div>
                        </div>

                        <div class="analytics-bottom">
                            <div class="analytics-growth">
                                Tracked from records
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>  -->

            <div class="col-xl-3 col-lg-4 col-md-6">
    <a href="{{ url('admin/monthly-pl-list') }}" style="text-decoration:none; color:inherit;">
        <div class="analytics-card" style="cursor:pointer;">

            <div class="analytics-row">
                <div class="analytics-icon icon-blue">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>

                <div class="analytics-content">
                    <div class="analytics-title">Monthly P&amp;L</div>

                    <div class="analytics-bottom">
                        <div class="analytics-value">
                            {{ $totalMonthlyPL }}
                        </div>
                    </div>

                    <div class="analytics-bottom">
                        <div class="analytics-growth">
                            Tracked from records
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </a>
</div>

                   <div class="col-xl-3 col-lg-4 col-md-6"> 
                    <div class="analytics-card"
                        onclick="showLoanBanks()"
                        style="cursor:pointer;">

                        <div class="analytics-row">
                            <div class="analytics-icon icon-green">
                                <i class="fas fa-university"></i>
                            </div>

                            <div class="analytics-content">
                                <div class="analytics-title">All Banks</div>

                                <div class="analytics-bottom">
                                    <div class="analytics-value">
                                        {{ $loanbanks->total() }}
                                    </div>
                                </div>

                                <div class="analytics-bottom">
                                    <div class="analytics-growth">
                                        +22.5% from last month
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div> 

                   <!--commistion  -->
                   <div class="col-xl-3 col-lg-4 col-md-6">
    <a href="{{ route('allCommission') }}" style="text-decoration:none; color:inherit;">
        <div class="analytics-card" style="cursor:pointer;">

            <div class="analytics-row">
                <div class="analytics-icon icon-blue">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>

                <div class="analytics-content">
                    <div class="analytics-title">Commission</div>

                    <div class="analytics-bottom">
                        <div class="analytics-value">
                            1
                        </div>
                    </div>

                    <div class="analytics-bottom">
                        <div class="analytics-growth">
                            Total commission earned
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </a>
</div>

        
    </div> 


<!-- loanbank -->
 <div id="loanBankSection" class="card mt-5" style="display:none;">
    <div class="card-body">
        <div class="table-responsive">
            <div class="mb-3">
    <input type="text"
           id="bankSearch"
           class="form-control"
           placeholder="Search bank name, IFSC, branch, manager, mobile...">
</div>

            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>Bank Name</th>
                        <th>IFSC</th>
                        <th>Branch</th>
                        <th>Manager Name</th>
                        <th>Manager Number</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loanbanks as $bank)
                    <tr>
                        <td>{{ $bank->bank_name }}</td>
                        <td>{{ $bank->ifsc_code }}</td>
                        <td>{{ $bank->bank_id }}</td>
                        <td>{{ $bank->branch_name }}</td>
                        <td>{{ $bank->manager_name }}</td>
                        <td>{{ $bank->manager_number }}</td>
                        <td>{{ $bank->bank_address }}</td>
                        <td>
                            <button class="btn btn-primary btn-xs"
                                onclick="openEditBankModal(this)"
                                data-id="{{ $bank->bank_id }}"
                                data-bank_name="{{ $bank->bank_name }}"
                                data-ifsc_code="{{ $bank->ifsc_code }}"
                                data-branch_name="{{ $bank->branch_name }}"
                                data-manager_name="{{ $bank->manager_name }}"
                                data-bank_address="{{ $bank->bank_address }}"
                                data-manager_number="{{ $bank->manager_number }}">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-xs"
                                onclick="deleteBank('{{ $bank->bank_id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

          {{ $loanbanks->links('pagination::bootstrap-5') }}

        </div>
    </div>
</div> 
<!-- Add Bank Modal -->
<div class="modal fade" id="addBankView" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankModalTitle">Add New Bank</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
               <form id="addBank" method="POST">
    

                    @csrf

                    <div class="row">
                       <div class="col-lg-4 mb-3">
    <label for="bank_name" class="form-label">
        Bank Name <span class="text-danger">*</span>
    </label>
    <input 
        type="text" 
        class="form-control" 
        id="bank_name"
        name="bank_name" 
        placeholder="Enter Bank Name"
        required>
</div>
                        <div class="form-group col-lg-4">
                            <label>IFSC Code:</label>
                            <input type="text" class="form-control" name="ifsc_code" >
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Branch Name:</label>
                            <input type="text" class="form-control" name="branch_name">
                        </div>
                    </div>
                    <input type="hidden" name="bank_id" id="bank_id">


                    <div class="row mt-2">
                        <div class="form-group col-lg-4">
                            <label>Manager Name:</label>
                            <input type="text" class="form-control" name="manager_name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Bank Address:</label>
                            <input type="text" class="form-control" name="bank_address">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Manager Number:</label>
                            <input type="text" class="form-control" name="manager_number">
                        </div>
                    </div>

                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                      <button type="submit" class="btn btn-primary" id="bankSubmitBtn">
                        Save Bank
                    </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- estimated -->
 <div id="estimatedFileSection" class="card mt-5" style="display:none;">

    

   
    <div class="p-4 bg-white">
      <form method="GET" action="{{ route('admin.bank') }}">


            <div class="row g-3 align-items-end">

                <div class="col-lg-4">
                    <label>Search</label>
                    <input type="text" name="search"
                           class="form-control"
                           value="{{ request('search') }}">
                </div>

                <div class="col-lg-3">
                    <label>Report Month</label>
                    <input type="month"
                           name="report_month"
                           class="form-control"
                           value="{{ request('report_month') }}">
                </div>

                <div class="col-lg-5 d-flex gap-2">
                    <button class="btn btn-primary">
                        Calculate
                    </button>

                    <a href="Route::get('admin/banklist', ...)->name('admin.bank');"
                       class="btn btn-light border">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>

   
    @if(request('report_month'))
        <div class="alert alert-info m-4 d-flex justify-content-between">
            <strong>
                Gross Revenue – Loan
                ({{ \Carbon\Carbon::createFromFormat('Y-m', request('report_month'))->format('M Y') }})
            </strong>
            <span class="fw-bold">
                ₹ {{ number_format($grossRevenue, 2) }}
            </span>
        </div>
    @endif

    
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Customer Name</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($estimatedFiles as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row->customer_name }}</td>
                    <td>{{ $row->mobile }}</td>
                    <td>
                        <a href="{{ route('estimatedFile.edit', $row->id) }}"
                           class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No records found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
<div id="estimatedFileSection" class="card mt-5" style="display:none;">
   ...
   <div class="card-body">
       <table>...</table>

       {{ $estimatedFiles->links('pagination::bootstrap-5') }}
   </div>
</div>



<div id="monthlyPLSection" class="card mt-5" style="display:none;">


    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h4 style="color:#000">Monthly P&amp;L</h4>

      
    </div>

   
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th class="text-end">Revenue Total</th>
                        <th class="text-end">Net Profit</th>
                        <th class="text-end">Net To Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($pls as $key => $pl)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ \Carbon\Carbon::createFromDate($pl->year, $pl->month, 1)->format('M Y') }}</td>
                        <td class="text-end">₹ {{ number_format($pl->revenue_total, 2) }}</td>
                        <td class="text-end">₹ {{ number_format($pl->net_profit, 2) }}</td>
                        <td class="text-end">₹ {{ number_format($pl->net_company, 2) }}</td>
                        <td>
                            <a href="{{ route('monthlyPL.exportFormatted', $pl->id) }}"
                               class="btn btn-sm btn-success">
                                Excel
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No Monthly P&amp;L records found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
             <!-- ✅ pagination INSIDE section -->
        {{ $pls->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div> 


<script>
function showMonthlyPL() {
    hideAllSections();
    document.getElementById('monthlyPLSection').style.display = 'block';
     document.getElementById('addMonthlyBtn').style.display = 'block';
    localStorage.setItem('activeSection', 'monthlypl','addMonthlyBtn');
}
</script>
<script>
/* ================= HIDE ALL SECTIONS ================= */
function hideAllSections() {
    const sections = [
        'loanBankSection',
        'estimatedFileSection',
        'monthlyPLSection'
    ];

    const buttons = [
        'addBankBtn',
        'addEstimatedBtn',
        'addMonthlyBtn'
    ];

    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });

    buttons.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });
}

function showLoanBanks() {
    hideAllSections();
    document.getElementById('loanBankSection').style.display = 'block';
    document.getElementById('addBankBtn').style.display = 'block';
    localStorage.setItem('activeSection', 'loanbanks');
}

function showEstimatedFiles() {
    hideAllSections();
    document.getElementById('estimatedFileSection').style.display = 'block';
    document.getElementById('addEstimatedBtn').style.display = 'block';
    localStorage.setItem('activeSection', 'estimatedfiles');
}

function showMonthlyPL() {
    hideAllSections();
    document.getElementById('monthlyPLSection').style.display = 'block';
    document.getElementById('addMonthlyBtn').style.display = 'block';
    localStorage.setItem('activeSection', 'monthlypl');
}

document.addEventListener('DOMContentLoaded', function () {
    const active = localStorage.getItem('activeSection');

    switch (active) {
        case 'loanbanks':
            showLoanBanks();
            break;
        case 'estimatedfiles':
            showEstimatedFiles();
            break;
        case 'monthlypl':
            showMonthlyPL();
            break;
        default:
            showLoanBanks();
    }
});

/* ================= SHOW LOAN BANKS ================= */
function showLoanBanks() {
    hideAllSections();
    document.getElementById('loanBankSection').style.display = 'block';
    document.getElementById('addBankBtn').style.display = 'block';

    localStorage.setItem('activeSection', 'loanbanks');
}

/* ================= SHOW ESTIMATED FILES ================= */
function showEstimatedFiles() {
    hideAllSections();
    document.getElementById('estimatedFileSection').style.display = 'block';
    document.getElementById('addEstimatedBtn').style.display = 'block';

    localStorage.setItem('activeSection', 'estimatedfiles');
}

/* ================= SHOW MONTHLY P&L ================= */
function showMonthlyPL() {
    hideAllSections();
    document.getElementById('monthlyPLSection').style.display = 'block';
     document.getElementById('addMonthlyBtn').style.display = 'block';

    localStorage.setItem('activeSection', 'monthlypl','addMonthlyBtn');
}

/* ================= RESTORE STATE AFTER RELOAD ================= */
document.addEventListener('DOMContentLoaded', function () {
    const active = localStorage.getItem('activeSection');

    switch (active) {
        case 'loanbanks':
            showLoanBanks();
            break;
        case 'estimatedfiles':
            showEstimatedFiles();
            break;
        case 'monthlypl':
            showMonthlyPL();
            break;
        default:
            showLoanBanks(); // default view
    }
});
</script>
<script>
/* ================= HIDE ALL SECTIONS ================= */
function hideAllSections() {

    const sections = [
        'loanBankSection',
        'estimatedFileSection',
        'monthlyPLSection'
    ];

    const buttons = [
        'addBankBtn',
        'addEstimatedBtn',
        'addMonthlyBtn'
    ];

    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });

    buttons.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    });
}

/* ================= SHOW LOAN BANKS ================= */
function showLoanBanks() {
    hideAllSections();
    document.getElementById('loanBankSection').style.display = 'block';
    document.getElementById('addBankBtn').style.display = 'block';

    localStorage.setItem('activeSection', 'loanbanks');
}

/* ================= SHOW ESTIMATED FILES ================= */
function showEstimatedFiles() {
    hideAllSections();
    document.getElementById('estimatedFileSection').style.display = 'block';
    document.getElementById('addEstimatedBtn').style.display = 'block';
   

    localStorage.setItem('activeSection', 'estimatedfiles');
}

/* ================= SHOW MONTHLY P&L ================= */
function showMonthlyPL() {
    hideAllSections();
    document.getElementById('monthlyPLSection').style.display = 'block';
     document.getElementById('addMonthlyBtn').style.display = 'block';
    localStorage.setItem('activeSection', 'monthlypl');
}

/* ================= RESTORE ACTIVE SECTION AFTER RELOAD ================= */
document.addEventListener('DOMContentLoaded', function () {
    const active = localStorage.getItem('activeSection');

    switch (active) {
        case 'loanbanks':
            showLoanBanks();
            break;
        case 'estimatedfiles':
            showEstimatedFiles();
            break;
        case 'monthlypl':
            showMonthlyPL();
            break;
        default:
            showLoanBanks(); // default section
    }
});
</script>

<!-- <script>
document.getElementById('addBank').addEventListener('submit', function (e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    let bankId = document.querySelector('input[name="bank_id"]').value;

    let url = bankId 
        ? "{{ route('updateBank') }}"   // EDIT
        : "{{ route('admin.loanbank.store') }}"; // ADD

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 1) {
            alert(data.msg);
            window.location.reload();
        } else {
            alert('Something went wrong');
        }
    });
});
</script> -->
<script>
function deleteBank(bankId) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch("{{ route('deleteBank') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ bank_id: bankId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 1) {
                    Swal.fire('Deleted!', data.msg, 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error', data.msg, 'error');
                }
            });

        }

    });
}
</script>

<script>
function openEditBankModal(btn) {

    // change modal title
    document.getElementById('bankModalTitle').innerText = 'Edit Bank';

    // change submit button text
    document.getElementById('bankSubmitBtn').innerText = 'Update Bank';

    // fill form values
    document.querySelector('input[name="bank_id"]').value = btn.dataset.id;
    document.querySelector('input[name="bank_name"]').value = btn.dataset.bank_name;
    document.querySelector('input[name="ifsc_code"]').value = btn.dataset.ifsc_code;
    document.querySelector('input[name="branch_name"]').value = btn.dataset.branch_name;
    document.querySelector('input[name="manager_name"]').value = btn.dataset.manager_name;
    document.querySelector('input[name="bank_address"]').value = btn.dataset.bank_address;
    document.querySelector('input[name="manager_number"]').value = btn.dataset.manager_number;

    // open modal
    let modal = new bootstrap.Modal(document.getElementById('addBankView'));
    modal.show();
}
</script>
<!-- validation bank -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('addBank');
    if (!form) return;

    const bankInput    = form.querySelector('[name="bank_name"]');
    const branchInput  = form.querySelector('[name="branch_name"]');
    const managerInput = form.querySelector('[name="manager_name"]');
    const mobileInput  = form.querySelector('[name="manager_number"]');

    /* ===============================
       EXISTING BANK NAMES (TABLE)
    ================================ */
    let existingBanks = [];
    document.querySelectorAll('#example tbody tr td:first-child').forEach(td => {
        existingBanks.push(td.innerText.trim().toLowerCase());
    });

    /* ===============================
       HELPER – ERROR MESSAGE
    ================================ */
    function errorBelow(input, text) {
        const small = document.createElement('small');
        small.className = 'text-danger';
        small.innerText = text;
        small.style.display = 'none';
        input.after(small);
        return small;
    }

    const bankErr    = errorBelow(bankInput, 'This bank already exists');
    const branchErr  = errorBelow(branchInput, 'Only letters allowed');
    const managerErr = errorBelow(managerInput, 'Only letters allowed');
    const mobileErr  = errorBelow(mobileInput, 'Mobile number must be 10 digits');

    let isDuplicate = false;

    /* ===============================
       LETTER-ONLY FIELDS
    ================================ */
    function lettersOnly(input, errorEl) {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            errorEl.style.display = 'none';
        });
    }

    lettersOnly(bankInput, bankErr);
    lettersOnly(branchInput, branchErr);
    lettersOnly(managerInput, managerErr);

    /* ===============================
       DUPLICATE BANK CHECK
    ================================ */
    bankInput.addEventListener('input', function () {
        const val = this.value.trim().toLowerCase();
        if (existingBanks.includes(val)) {
            bankErr.style.display = 'block';
            isDuplicate = true;
        } else {
            bankErr.style.display = 'none';
            isDuplicate = false;
        }
    });

    /* ===============================
       MOBILE – ONLY 10 DIGITS
    ================================ */
    mobileInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }

        mobileErr.style.display =
            this.value.length === 0 || this.value.length === 10
                ? 'none'
                : 'block';
    });

    mobileInput.addEventListener('keydown', function (e) {
        if (
            this.value.length >= 10 &&
            !['Backspace','Delete','ArrowLeft','ArrowRight','Tab'].includes(e.key)
        ) {
            e.preventDefault();
        }
    });

    /* ===============================
       SUBMIT
    ================================ */
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let hasError = false;

        if (isDuplicate) {
            bankErr.style.display = 'block';
            hasError = true;
        }

        if (mobileInput.value && mobileInput.value.length !== 10) {
            mobileErr.style.display = 'block';
            hasError = true;
        }

        if (hasError) return; // ❌ NO POPUP

        /* ===============================
           FETCH SUBMIT
        ================================ */
        let formData = new FormData(form);
        let bankId = form.querySelector('[name="bank_id"]').value;

        let url = bankId
            ? "{{ route('updateBank') }}"
            : "{{ route('admin.loanbank.store') }}";

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name=_token]').value
            },
            body: formData
        })
       .then(res => res.text())
.then(text => {
    console.log("RAW RESPONSE:", text); // 👈 THIS WILL SHOW ERROR

    try {
        let data = JSON.parse(text);

        if (data.status === 1) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.msg
            }).then(() => location.reload());
        } else {
            alert(data.msg);
        }

    } catch (e) {
        console.error("SERVER ERROR:", text);
        alert("Backend error — check console");
    }
});
    });

});
</script>

<!-- serachbar script -->
 <script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('bankSearch');
    const table = document.getElementById('example');
    if (!searchInput || !table) return;

    const rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

});
</script>


@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection
