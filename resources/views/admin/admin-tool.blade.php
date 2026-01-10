@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
  
<<<<<<< HEAD
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
</style>

    

 
             <!-- Header -->
<div class="page-header d-flex justify-content-between align-items-center">
    <h1>Tools</h1>

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
                    <div class="col-xl-3 col-lg-4 col-md-6"> 
                    <div class="analytics-card"
                        onclick="showLoanBanks()"
                        style="cursor:pointer;">

                        <div class="analytics-row">
                            <div class="analytics-icon icon-green">
                                <i class="fas fa-university"></i>
                            </div>

                            <div class="analytics-content">
                                <div class="analytics-title">All Loan Banks</div>

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



   
    

            <!-- Estimated Files -->
            <div class="col-xl-3 col-lg-4 col-md-6"> 
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
            </div> 


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
            </div>        
        
    </div> 


<!-- loanbank -->
 <div id="loanBankSection" class="card mt-5" style="display:none;">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>Bank Name</th>
                        <th>IFSC</th>
                        <th>Branch</th>
                        <th>Manager</th>
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
                        <td>{{ $bank->branch_name }}</td>
                        <td>{{ $bank->manager_name }}</td>
                        <td>{{ $bank->manager_number }}</td>
                        <td>{{ $bank->bank_address }}</td>
                        <td>
                            <a href="{{ url('editBank/'.$bank->bank_id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-xs"
                                onclick="deleteBank('{{ $bank->bank_id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $loanbanks->links() }}
        </div>
    </div>
</div> 
<!-- Add Bank Modal -->
<div class="modal fade" id="addBankView" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="addBank" method="post">
                    @csrf

                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Bank Name:</label>
                            <input type="text" class="form-control" name="bank_name" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>IFSC Code:</label>
                            <input type="text" class="form-control" name="ifsc_code" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Branch Name:</label>
                            <input type="text" class="form-control" name="branch_name" required>
                        </div>
                    </div>

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
                        <button type="submit" class="btn btn-primary">
                            Add Bank
                        </button>
                    </div>

                </form>
=======


    
 <style>/* ===== Overlay ===== */
.modal-overlay {
    background: rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== Container ===== */
.modal-container,
.modal-dialog.modal-container {
    max-width: 900px;
    width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    padding: 24px 28px 30px;
}

/* ===== Header ===== */
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: none;
    padding: 0 0 16px;
}

.modal-header h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.modal-header p {
    font-size: 13px;
    color: #6b7280;
    margin: 4px 0 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 14px;
    color: #2563eb;
    cursor: pointer;
}

/* ===== Section Titles ===== */
.personal-details-form h4,
.section-title {
    font-size: 14px;
    font-weight: 600;
    margin: 22px 0 10px;
}

/* ===== Form Layout ===== */
.personal-details-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 20px;
}

.personal-details-form .form-group {
    display: flex;
    flex-direction: column;
}

.personal-details-form .form-row {
    grid-column: span 2;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 20px;
}

/* ===== Labels ===== */
.personal-details-form label {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 6px;
    color: #111827;
}

/* ===== Inputs ===== */
.personal-details-form input {
    height: 42px;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    outline: none;
    transition: border 0.2s;
}

.personal-details-form input::placeholder {
    color: #9ca3af;
}

.personal-details-form input:focus {
    border-color: #3b82f6;
}

/* Full width fields */
.personal-details-form .form-group:nth-child(3),
.personal-details-form .form-group:nth-child(4),
.personal-details-form .form-group:nth-child(6),
.personal-details-form .form-group:nth-child(9) {
    grid-column: span 2;
}

/* ===== Footer ===== */
.modal-footer {
    grid-column: span 2;
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* ===== Buttons ===== */
.btn-back {
    background: transparent;
    border: none;
    color: #6b7280;
    font-size: 14px;
    cursor: pointer;
}

.btn-submit {
    background: #3b82f6;
    color: #fff;
    border: none;
    padding: 12px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    width: 100%;
}

.btn-submit:hover {
    background: #2563eb;
}

/* Remove underline & blue color from clickable cards */


.overview-link {
  text-decoration: none;
  color: inherit;
  display: block;
}

.overview-link:hover,
.overview-link:focus,
.overview-link:active {
  text-decoration: none;
  color: inherit;
}
</style>
 
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid bg-white">

            <div class="customer-overview-grid">

                <!-- ================= ALL LOAN BANK ================= -->
                <a href="{{ route('loanbanks') }}" class="overview-link">
                    <div class="overview-card green">

                        <div class="overview-icon">
                            <i class="fas fa-landmark"></i>
                        </div>

                        <div class="overview-content">
                            <h3>All Loan Bank</h3>
                            <p>{{ $totalloanbank }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

                <!-- ================= ALL MIS ================= -->
                <a href="{{ route('mis.index') }}" class="overview-link">
                    <div class="overview-card yellow">

                        <div class="overview-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>

                        <div class="overview-content">
                            <h3>All MIS</h3>
                            <p>{{ $totalmis }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

                <!-- ================= MONTHLY P&L ================= -->
                <a href="{{ route('monthlyPL.list') }}" class="overview-link">
                    <div class="overview-card blue">

                        <div class="overview-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>

                        <div class="overview-content">
                            <h3>Monthly P&amp;L</h3>
                            <p>{{ $totalMonthlyPL }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

                <!-- ================= ESTIMATED FILE ================= -->
                <a href="{{ route('estimatedFile.index') }}" class="overview-link">
                    <div class="overview-card purple">

                        <div class="overview-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>

                        <div class="overview-content">
                            <h3>Estimated File</h3>
                            <p>{{ $totalEstimatedFiles }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
            </div>

        </div>
    </div>
</div>
<<<<<<< HEAD
<!-- estimated -->
 <div id="estimatedFileSection" class="card mt-5" style="display:none;">

    

   
    <div class="p-4 bg-white">
        <form method="GET" action="{{ route('admin.listlead') }}">
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

                    <a href="{{ route('admin.listlead') }}"
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

<div id="monthlyPLSection" class="card mt-5" style="display:none;">


    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h4>Monthly P&amp;L</h4>

      
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
        'addEstimatedBtn'
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
=======

>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa

@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection