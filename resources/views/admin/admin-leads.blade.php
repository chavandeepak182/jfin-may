@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent



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
/* FIX BROKEN PAGINATION */
.pagination {
    display: flex !important;
    justify-content: center;
    gap: 6px;
}

.pagination li {
    list-style: none;
}

.pagination li a,
.pagination li span {
    position: static !important;
    width: auto !important;
    height: auto !important;
    transform: none !important;
}

.pagination i,
.pagination svg {
    display: none !important;
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
</div>


        

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
    <div class="analytics-card"
         onclick="showMISList()"
         style="cursor:pointer;">
        <div class="analytics-row">
            <div class="analytics-icon icon-yellow">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="analytics-content">
                <div class="analytics-title">All MIS</div>
                <div class="analytics-bottom">
                    <div class="analytics-value">{{ $misRecords->total() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Referral Leads -->
<div class="col-xl-3 col-lg-4 col-md-6">
    <div class="analytics-card"
         onclick="showReferralLeads()"
         style="cursor:pointer;">

        <div class="analytics-row">
            <div class="analytics-icon icon-green">
                <i class="fas fa-share-alt"></i>
            </div>

            <div class="analytics-content">
                <div class="analytics-title">Referral Leads</div>

                <div class="analytics-bottom">
                    <div class="analytics-value">
                        {{ $referralLeads->count() }}
                    </div>
                </div>

                <div class="analytics-bottom">
                    <div class="analytics-growth">
                        Tracked from users
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





    
     



   
    

   

    






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
        {{ $enquiries->links('pagination::bootstrap-4') }}


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
                       <td class="d-flex gap-1">
                                <!-- Edit -->
                                <a class="btn btn-warning btn-xs" href="{{ route('leads.edit', $lead->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

           {{ $leads->links('pagination::bootstrap-4') }}

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this lead?')) {
                this.submit();
            }
        });
    });
});
</script>


<!-- mis -->
 <div id="misSection" class="card mt-5" style="display:none;">
  <!-- ✅ SUCCESS MESSAGE (ADD HERE) -->
    <div id="misSuccessMsg"
         class="alert alert-success text-center fw-bold d-none mt-3">
        ✅ MIS added successfully
    </div>
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
                        <td class="d-flex gap-1">
                            <!-- Edit -->
                            <a href="{{ route('mis.edit', $mis->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <!-- Delete -->
                        <button type="button"
                                class="btn btn-sm btn-danger"
                                onclick="deleteMIS({{ $mis->id }})"
                                title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

          {{ $misRecords->links('pagination::bootstrap-4') }}

        </div>
    </div>
</div>

<script>
function deleteMIS(id) {
    swal({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {

        if (willDelete) {
            $.ajax({
                url: "{{ route('mis.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    if (response.status === true) {
                        swal("Deleted", response.message, "success")
                            .then(() => location.reload());
                    } else {
                        swal("Error", response.message, "error");
                    }
                },
                error: function () {
                    swal("Error", "Something went wrong", "error");
                }
            });
        }

    });
}
</script>


<div id="referralLeadsSection" class="card mt-5" style="display:none;">

    <div class="card-header">
        <h4>Referral Leads</h4>
    </div>

    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Referrer</th>
                    <th>Referrer Mobile</th>
                    <th>Referral Code</th>
                    <th>Lead Name</th>
                    <th>Lead Mobile</th>
                    <th>Lead Email</th>
                    <th>Product Type</th>   <!-- ✅ ADDED -->
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
            @forelse($referralLeads as $i => $lead)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $lead->referrer_name }}</td>
                    <td>{{ $lead->referrer_mobile }}</td>

                    <td>
                        <span class="fw-bold text-primary">
                            {{ $lead->referral_code }}
                        </span>
                    </td>

                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->mobile }}</td>
                    <td>{{ $lead->email ?? '-' }}</td>

                    <!-- ✅ PRODUCT TYPE -->
                    <td>
    <span class="badge bg-info">
        {{ $lead->product_name ?? '-' }}
    </span>
</td>


                    <td>
                        <span class="badge
                            {{ $lead->status === 'pending' ? 'bg-warning' : 'bg-success' }}">
                            {{ ucfirst($lead->status) }}
                        </span>
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">
                        No referral leads found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $referralLeads->links('pagination::bootstrap-4') }}
    </div>
</div>

</div>



<script>
function hideAllSections() {
    document.getElementById('enquiryList').style.display = 'none';
    document.getElementById('leadsSection').style.display = 'none';
    document.getElementById('misSection').style.display = 'none';

    document.getElementById('addLeadBtn').style.display = 'none';
    document.getElementById('misBtns').style.display = 'none';
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
    localStorage.setItem('activeSection', 'mis');
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
<!-- Add MIS Record Modal -->
<div class="modal fade" id="addMISView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="addMISRecord">
    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="contact" class="col-form-label">Contact:</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <!-- <div class="form-group col-lg-6">
                            <label for="office_contact" class="col-form-label">Office Contact:</label>
                            <input type="text" class="form-control" id="office_contact" name="office_contact" required>
                        </div> -->
                        <div class="form-group col-lg-6">
                            <label for="product_type" class="col-form-label">Product Type:</label>
                            <select class="form-control" id="product_type" name="product_type" required>
                                <option value="">Select Product Type</option>
                                <option value="Home Loan">Home Loan</option>
                                <option value="Personal Loan">Personal Loan</option>
                                <option value="MSME">MSME</option>
                                <option value="BT + Topup">BT + Topup</option>
                                <option value="Lap/Mortage">Lap/Mortage</option>
                                <option value="Project Funding">Project Funding</option>
                                <option value="CGTMS">CGTMS</option>
                                <option value="Term Loan">Term Loan</option>
                                <option value="Working Capital">Working Capital</option>
                                <option value="Machinary Loan">Machinary Loan</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="occupation" class="col-form-label">Occupation:</label>
                            <select class="form-control" id="occupation" name="occupation" required>
                                <option value="">Select Occupation</option>
                                <option value="Salaried" {{ old('occupation', $misRecord->occupation ?? '') == 'Salaried' ? 'selected' : '' }}>Salaried</option>
                                <option value="Self Employed" {{ old('occupation', $misRecord->occupation ?? '') == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="bank_name" class="col-form-label">Bank Name:</label>
                            <select class="form-control" id="bank_name" name="bank_name" required>
                                <option value="">Select Bank Name</option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="branch_name" class="col-form-label">Branch Name:</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="bm_name" class="col-form-label">BM Name:</label>
                            <input type="text" class="form-control" id="bm_name" name="bm_name">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="login_date" class="col-form-label">Login Date:</label>
                            <input type="date" class="form-control" id="login_date" name="login_date">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="status" class="col-form-label">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="open">Open</option>
                                <option value="processing">Processing</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="in_principle" class="col-form-label">In-Principle:</label>
                            <select class="form-control" id="in_principle" name="in_principle">
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="remark" class="col-form-label">Remark:</label>
                            <textarea class="form-control" id="remark" name="remark" rows="2"></textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="legal" class="col-form-label">Legal:</label>
                            <input type="text" class="form-control" id="legal" name="legal">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="valuation" class="col-form-label">Valuation:</label>
                            <input type="text" class="form-control" id="valuation" name="valuation">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="leads" class="col-form-label">Leads:</label>
                            <input type="text" class="form-control" id="leads" name="leads">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="file_work" class="col-form-label">File Work:</label>
                            <input type="text" class="form-control" id="file_work" name="file_work">
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="amount" class="col-form-label">Amount:</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="city" class="col-form-label">City:</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="address" class="col-form-label">Residencial Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="office_address" class="col-form-label">Office Address:</label>
                            <textarea class="form-control" id="office_address" name="office_address" rows="3" required></textarea>
                        </div>
                    </div> -->
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MIS Details Modal -->
<div class="modal fade" id="misDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4 border-0">
      
      <!-- Header -->
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title fw-bold">📋 MIS Record Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body p-4">

        <!-- Name & Contact on top -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="fw-bold text-dark mb-0" id="detail_name">-</h4>
          <div class="text-muted">
            <i class="bi bi-envelope"></i> <span id="detail_email">-</span> &nbsp; | &nbsp;
            <i class="bi bi-phone"></i> <span id="detail_contact">-</span>
          </div>
        </div>
        <hr>

        <div class="row gy-2">
          <div class="col-md-6">
            <strong>ID:</strong> <span id="detail_id">-</span>
          </div>
          <div class="col-md-6">
            <strong>Product Type:</strong> <span id="detail_product">-</span>
          </div>
          <div class="col-md-6">
            <strong>Occupation:</strong> <span id="detail_occupation">-</span>
          </div>
          <div class="col-md-6">
            <strong>Bank:</strong> <span id="detail_bank">-</span>
          </div>
          <div class="col-md-6">
            <strong>Branch:</strong> <span id="detail_branch">-</span>
          </div>
          <div class="col-md-6">
            <strong>Login Date:</strong> <span id="detail_login">-</span>
          </div>
          <div class="col-md-6">
            <strong>Status:</strong> <span id="detail_status" class="badge bg-success">-</span>
          </div>
          <div class="col-md-6">
            <strong>Leads:</strong> <span id="detail_leads">-</span>
          </div>
          <div class="col-md-6">
            <strong>Amount:</strong> ₹<span id="detail_amount">-</span>
          </div>
          <div class="col-md-6">
            <strong>City:</strong> <span id="detail_city">-</span>
          </div>
          <div class="col-12">
            <strong>Address:</strong> <span id="detail_address" style="white-space:pre-wrap;">-</span>
          </div>
        </div>

      </div>
      
      <!-- Footer -->
      <div class="modal-footer border-0">
        <button class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function hideAllSections() {
    const sections = [
        'enquiryList',
        'leadsSection',
        'misSection',
        'referralLeadsSection'
    ];

    const buttons = [
        'addLeadBtn',
        'misBtns'
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

function showEnquiryList() {
    hideAllSections();
    document.getElementById('enquiryList').style.display = 'block';
    localStorage.setItem('activeSection', 'enquiry');
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

function showReferralLeads() {
    hideAllSections();
    document.getElementById('referralLeadsSection').style.display = 'block';
    localStorage.setItem('activeSection', 'referral');
}

document.addEventListener('DOMContentLoaded', function () {
    const active = localStorage.getItem('activeSection');

    if (active === 'leads') {
        showLeadsList();
    } else if (active === 'mis') {
        showMISList();
    } else if (active === 'referral') {
        showReferralLeads();
    } else {
        showEnquiryList();
    }
});
</script>

<script>
$('#addMISRecord').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('mis.store') }}",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            // ✅ SUCCESS
            if (response.status === true) {
                swal("Success", response.message, "success").then(() => {
                    location.reload(); // record will appear in list
                });
            } else {
                swal("Error", response.message ?? "Something went wrong", "error");
            }
        },

        error: function (xhr) {
            // ❌ VALIDATION ERROR
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let firstError = Object.values(errors)[0][0];
                swal("Validation Error", firstError, "warning");
            } else {
                swal("Error", "Something went wrong", "error");
            }
        }
    });
});
</script>













@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection
