@extends('layouts.header')
@section('title')
@parent
JFS | Wallet Balance 
@endsection
@section('content')

@section('content')
@parent

<style>
 #wrapper #content-wrapper #content{
    background:#f4f7fe;
}

.dashboard-card{

    background:#fff;
    border-radius:20px;
    padding:28px;
    display:block;
    text-decoration:none;
    height:248px;
    border:1px solid #edf2f7;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    transition:.35s;
}

.dashboard-card:hover{

    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(0,0,0,.15);
    text-decoration:none;
}

.card-header-top{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;
}

.icon-box{

    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.purple{

    background:#efe9ff;
    color:#6d28d9;
}

.orange{

    background:#fff2e7;
    color:#f97316;
}

.status-badge{

    padding:8px 18px;
    border-radius:30px;
    font-size:14px;
    font-weight:600;
}

.green{

    background:#e9f9ef;
    color:#16a34a;
}

.red{

    background:#ffecec;
    color:#ef4444;
}

.dashboard-card h5{

    font-size:30px;
    color:#4b5563;
    margin-bottom:15px;
}

.dashboard-card h2{

    font-size:50px;
    font-weight:700;
    color:#0f172a;
    margin-bottom:12px;
}

.dashboard-card p{

    color:#94a3b8;
    font-size:15px;
}

@media(max-width:768px){

.dashboard-card{

    height:auto;
    margin-bottom:20px;
}

.dashboard-card h5{

    font-size:22px;
}

.dashboard-card h2{

    font-size:38px;
}

}}
   
</style>

<!-- Breadcrumbs -->
<div class="container-fluid mb-4">

    <div class="row g-4">

        <div class="col-lg-6 col-md-6">

            <a href="{{ route('referral_earnings') }}" class="dashboard-card">

                <div class="card-header-top">

                    <div class="icon-box purple">
                        <i class="fas fa-wallet"></i>
                    </div>

                    <span class="status-badge green">
                        Earnings
                    </span>

                </div>

                <h5>Referral Earnings</h5>

                <h2><h2>{{ $referralCount }}</h2></h2>

                <p>Click to view referral earnings</p>

            </a>

        </div>

        <div class="col-lg-6 col-md-6">

            <a href="{{ route('admin.transactions') }}" class="dashboard-card">

                <div class="card-header-top">

                    <div class="icon-box orange">
                        <i class="fas fa-history"></i>
                    </div>

                    <span class="status-badge red">
                        History
                    </span>

                </div>

                <h5>Transaction History</h5>

                <h2>{{ $transactionCount }}</h2>

                <p>Click to view transaction history</p>

            </a>

        </div>

    </div>

</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<div class="card custom-card shadow-sm border-0">

    <div class="card-header bg-white border-0 py-3 px-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-1 fw-bold text-dark">
                    <i class="fas fa-wallet text-primary me-2"></i>
                    Withdrawal Requests
                </h4>

                <small class="text-muted">
                    Manage and approve referral withdrawal requests
                </small>

            </div>

            <span class="badge bg-primary fs-6 px-3 py-2">
                {{ count($requests) }} Requests
            </span>

        </div>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table id="example" class="table custom-table align-middle">

                <thead>

                    <tr>

                       <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Email ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th width="120">Action</th>

                    </tr>

                </thead>
<tbody>

@foreach($requests as $request)

<tr>

    <td>
        <strong>{{ $request->name }}</strong>
    </td>

    <td>
        {{ $request->mobile }}
    </td>

    <td>
        {{ $request->email }}
    </td>

    <td>
        <span class="amount-badge">
            ₹{{ number_format($request->amount,2) }}
        </span>
    </td>

    <td>
        @if($request->status=='approved')
            <span class="badge bg-success">
                Approved
            </span>
        @elseif($request->status=='pending')
            <span class="badge bg-warning text-dark">
                Pending
            </span>
        @else
            <span class="badge bg-danger">
                {{ ucfirst($request->status) }}
            </span>
        @endif
    </td>

    <td>
        <button
            class="btn btn-primary btn-sm rounded-pill px-3"
            data-bs-toggle="modal"
            data-bs-target="#viewRequestModal{{ $request->id }}">
            <i class="fa fa-eye me-1"></i> View
        </button>
    </td>

</tr>

<!-- Modal -->
<div class="modal fade" id="viewRequestModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Request Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p><strong>Name:</strong> {{ $request->name }}</p>
                <p><strong>Mobile Number:</strong> {{ $request->mobile }}</p>
                <p><strong>Email ID:</strong> {{ $request->email }}</p>
                <p><strong>Amount:</strong> ₹{{ number_format($request->amount,2) }}</p>

                <form action="{{ route('admin.withdrawal.approve',$request->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>GST</label>
                        <select name="gst" id="gst{{ $request->id }}" class="form-control">
                            <option value="0">0%</option>
                            <option value="2">2%</option>
                            <option value="5">5%</option>
                            <option value="12">12%</option>
                            <option value="18">18%</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>TDS</label>
                        <select name="tds" id="tds{{ $request->id }}" class="form-control">
                            <option value="0">0%</option>
                            <option value="1">1%</option>
                            <option value="2">2%</option>
                            <option value="5">5%</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Actual Amount</label>
                        <input type="text" id="actual_amount{{ $request->id }}" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Approve
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

@endforeach

</tbody>
                

            </table>

        </div>

    </div>

</div>
<style>
    .custom-card{

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.custom-card .card-header{

    background:#fff;

    border-bottom:1px solid #edf2f7;

}

.custom-table{

    margin-bottom:0;

}

.custom-table thead{

    background:#f8fafc;

}

.custom-table thead th{

    border:none;

    padding:16px;

    color:#475569;

    font-weight:700;

    white-space:nowrap;

}

.custom-table tbody td{

    padding:16px;

    border-top:1px solid #eef2f7;

    vertical-align:middle;

}

.custom-table tbody tr{

    transition:.3s;

}

.custom-table tbody tr:hover{

    background:#f8fbff;

}

.amount-badge{

    background:#e8fff2;

    color:#16a34a;

    padding:8px 14px;

    border-radius:25px;

    font-weight:600;

}

.btn-primary{

    border-radius:30px;

}

.dataTables_wrapper .dataTables_filter input{

    border-radius:10px;

    border:1px solid #ddd;

    padding:6px 12px;

}

.dataTables_wrapper .dataTables_length select{

    border-radius:8px;

}

.modal-content{

    border:none;

    border-radius:18px;

}

.modal-header{

    background:#f8fafc;

    border-bottom:1px solid #eee;

}

.modal-footer{

    border-top:1px solid #eee;

}
    </style>

@endsection

@section('script')
@parent

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script>
// Add event listener for GST and TDS selection change
$(document).ready(function () {
    @foreach($requests as $request)
    $('#gst{{ $request->id }}').on('change', function () {
        calculateAmount({{ $request->id }}, {{ $request->amount }});
    });

    $('#tds{{ $request->id }}').on('change', function () {
        calculateAmount({{ $request->id }}, {{ $request->amount }});
    });
    @endforeach
});

// Function to calculate the actual amount after GST and TDS deduction
function calculateAmount(requestId, amount) {
    var gstRate = $('#gst' + requestId).val(); // Get the selected GST rate
    var tdsRate = $('#tds' + requestId).val(); // Get the selected TDS rate

    var gstAmount = (amount * gstRate) / 100; // Calculate GST amount
    var tdsAmount = (amount * tdsRate) / 100; // Calculate TDS amount

    var actualAmount = amount - gstAmount - tdsAmount; // Subtract GST and TDS from original amount

    $('#actual_amount' + requestId).val('₹' + actualAmount.toFixed(2)); // Display actual amount after GST and TDS
}
</script>

@endsection
