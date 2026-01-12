@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- your custom JS here -->

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
    <h1>Analytics</h1>

    <div class="d-flex gap-2">

        <!-- Add Lead -->
        <div id="addLeadBtn" style="display:none;">
            <a href="{{ route('leads.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Lead
            </a>
        </div>

        <!-- MIS Buttons -->
        <div id="misBtns" style="display:none;">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMISView">
                <i class="fa fa-plus"></i> Add MIS
            </button>
            <button class="btn btn-success" id="exportExcel">
                Export to Excel
            </button>
        </div>

<!--        
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
            <div id="addEstimatedBtn" style="display:none;">
            <a href="{{ route('monthlyPL.index') }}"
                class="btn btn-primary">
                + Create Monthly P&L
                </a>
            

        </div> -->
        

    </div>
</div>






<div class="row g-4">

    <!-- All Enquiry Leads -->
 <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="analytics-card active"
         onclick="showEnquiryList()" style="cursor:pointer;">
        <div class="analytics-row">
            <div class="analytics-icon icon-blue">
                <i class="fas fa-globe"></i>
            </div>
            <div class="analytics-content">
                <div class="analytics-title">All Enquiry Leads</div>

                <div class="analytics-bottom">
                    <div class="analytics-value">{{ $enquiriesCount }}</div>
                </div>

                <div class="analytics-bottom">
                    <div class="analytics-growth">+12.5% from last month</div>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- All Leads -->
<div class="col-xl-3 col-lg-4 col-md-6">
    <div class="analytics-card" onclick="showLeadsList()" style="cursor:pointer;">
        <div class="analytics-row">
            <div class="analytics-icon icon-pink">
                <i class="fas fa-users"></i>
            </div>
            <div class="analytics-content">
                <div class="analytics-title">All Leads</div>
                <div class="analytics-bottom">
                    <div class="analytics-value">{{ $leadsCount }}</div>
                </div>
                <div class="analytics-bottom">
                    <div class="analytics-growth">+8.2% from last month</div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- All MIS -->
   <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="analytics-card" onclick="showMISList()" style="cursor:pointer;">
        <div class="analytics-row">
            <div class="analytics-icon icon-yellow">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="analytics-content">
                <div class="analytics-title">All MIS</div>
                <div class="analytics-bottom">
                    <div class="analytics-value">{{ $misRecords->total() }}</div>
                </div>
                <div class="analytics-bottom">
                    <div class="analytics-growth">+15.3% from last month</div>
                </div>
            </div>
        </div>
    </div>
</div>


    
     <!-- <div class="col-xl-3 col-lg-4 col-md-6">
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
    </div> -->



   
    

    <!-- Estimated Files -->
    <!-- <div class="col-xl-3 col-lg-4 col-md-6 mt-5">
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
    </div> -->


    <!-- Monthly P&l -->
     <!-- <div class="col-xl-3 col-lg-4 col-md-6 mt-5">
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
</div> -->






</div>

<div id="enquiryList" class="card mt-5">
    <div class="card-header">
        <h4>All Enquiry Leads</h4>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enquiries as $enquiry)
                <tr>
                    <td>{{ $enquiry->enquiry_id }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->contact }}</td>
                    <td>{{ $enquiry->message }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="leadsSection" class="card mt-5" style="display:none;">
    

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Lead Source</th>
                        <th>Follow Up Date</th>
                        <th>Assigned To</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $index => $lead)
                    <tr>
                        <td>{{ $leads->firstItem() + $index }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->lead_source }}</td>
                        <td>{{ \Carbon\Carbon::parse($lead->follow_up_date)->format('d M Y') }}</td>
                        <td>{{ $lead->agent->name ?? 'N/A' }}</td>
                        <td>
                            <a class="btn btn-warning btn-xs" href="{{ route('leads.edit', $lead->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $leads->links() }}
        </div>
    </div>
</div>


<!-- mis -->
 <div id="misSection" class="card mt-5" style="display:none;">

    <!-- MIS Header -->
    

    <!-- MIS Table -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product Type</th>
                        <th>Amount</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($misRecords as $mis)
                    <tr>
                        <td>{{ $mis->id }}</td>
                        <td>{{ $mis->name }}</td>
                        <td>{{ $mis->email }}</td>
                        <td>{{ $mis->contact }}</td>
                        <td>{{ $mis->product_type }}</td>
                        <td>{{ $mis->amount }}</td>
                        <td>{{ $mis->city }}</td>
                        <td>
                            <a href="{{ route('mis.edit', $mis->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $misRecords->links() }}
        </div>
    </div>
</div>
<!-- loanbank -->
 <!-- <div id="loanBankSection" class="card mt-5" style="display:none;">
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
</div> -->

<script>
function hideAllSections() {
    document.getElementById('enquiryList').style.display = 'none';
    document.getElementById('leadsSection').style.display = 'none';
    document.getElementById('misSection').style.display = 'none';
    // document.getElementById('loanBankSection').style.display = 'none';

    document.getElementById('addLeadBtn').style.display = 'none';
    document.getElementById('misBtns').style.display = 'none';
    // document.getElementById('addBankBtn').style.display = 'none';
}

function showEnquiryList() {
    hideAllSections();
    document.getElementById('enquiryList').style.display = 'block';
}

function showLeadsList() {
    hideAllSections();
    document.getElementById('leadsSection').style.display = 'block';
    document.getElementById('addLeadBtn').style.display = 'block';
}

function showMISList() {
    hideAllSections();
    document.getElementById('misSection').style.display = 'block';
    document.getElementById('misBtns').style.display = 'block';
}

// function showLoanBanks() {
//     hideAllSections();
//     // document.getElementById('loanBankSection').style.display = 'block';
//     // document.getElementById('addBankBtn').style.display = 'block';
// }
</script>

<!-- Add Bank Modal -->
<!-- <div class="modal fade" id="addBankView" tabindex="-1" aria-hidden="true">
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
            </div>

        </div>
    </div>
</div> -->



<!-- estimated -->
 <!-- <div id="estimatedFileSection" class="card mt-5" style="display:none;">

    

   
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

</div> -->

<!-- <div id="monthlyPLSection" class="card mt-5" style="display:none;">


    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h4>Monthly P&amp;L</h4>

        <a href="{{ route('monthlyPL.index') }}"
           class="btn btn-primary">
            + Create Monthly P&amp;L
        </a>
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
</div> -->

<script>
/* ================= COMMON HIDE FUNCTION ================= */
function hideAllSections() {
   const sections = [
    'enquiryList',
    'leadsSection',
    'misSection',
    // 'loanBankSection',
    // 'estimatedFileSection',
    // 'monthlyPLSection' 
];


    const buttons = [
        'addLeadBtn',
        'misBtns',
        // 'addBankBtn',
        // 'addEstimatedBtn'
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

/* ================= SECTION SHOW FUNCTIONS ================= */
function showEnquiryList() {
    hideAllSections();
    document.getElementById('enquiryList').style.display = 'block';
    localStorage.setItem('activeSection', 'enquiries');
}

function showLeadsList() {
    hideAllSections();
    document.getElementById('leadsSection').style.display = 'block';
    document.getElementById('addLeadBtn').style.display = 'block';
    localStorage.setItem('activeSection', 'leads');
}

function showMISList() {
    hideAllSections();
    document.getElementById('misSection').style.display = 'block';
    document.getElementById('misBtns').style.display = 'block';
    localStorage.setItem('activeSection', 'mis');
}

// function showLoanBanks() {
//     hideAllSections();
//     document.getElementById('loanBankSection').style.display = 'block';
//     document.getElementById('addBankBtn').style.display = 'block';
//     localStorage.setItem('activeSection', 'loanbanks');
// }

// function showEstimatedFiles() {
//     hideAllSections();
//     document.getElementById('estimatedFileSection').style.display = 'block';
//     document.getElementById('addEstimatedBtn').style.display = 'block';
//     localStorage.setItem('activeSection', 'estimatedfiles');
// }

/* ================= RESTORE STATE AFTER RELOAD ================= */
document.addEventListener('DOMContentLoaded', function () {
    const active = localStorage.getItem('activeSection');

    switch (active) {
    case 'leads':
        showLeadsList();
        break;
    case 'mis':
        showMISList();
        break;
    
    default:
        showEnquiryList();
}

});

/* ================= ADD BANK MODAL ================= */
// function openAddBankModal() {
//     const modal = new bootstrap.Modal(document.getElementById('addBankView'));
//     modal.show();
// }

/* ================= ADD BANK AJAX ================= */
// $('#addBank').on('submit', function (e) {
//     e.preventDefault();

//     $.ajax({
//         url: "{{ route('insertLoanBank') }}",
//         method: "POST",
//         data: new FormData(this),
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             if (response.status === 1) {
//                 $('#addBankView').modal('hide');

                
//                 localStorage.setItem('activeSection', 'loanbanks');
//                 location.reload();
//             } else {
//                 alert('Failed to add bank');
//             }
//         },
//         error: function () {
//             alert('Something went wrong');
//         }
//     });
// });
</script>

<!-- <script>
function showMonthlyPL() {
    hideAllSections();
    document.getElementById('monthlyPLSection').style.display = 'block';
    localStorage.setItem('activeSection', 'monthlypl');
}
</script> -->

@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection
