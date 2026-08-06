@extends('layouts.header')

@section('title')
@parent
JFS | Wallet Balance 
@endsection

@section('content')
<style>
   .dashboard-card{

    display:block;
    background:#fff;
    border-radius:22px;
    padding:28px;
    text-decoration:none;
    color:#222;
    border:1px solid #edf2f7;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.35s;
    min-height:210px;

}

.dashboard-card:hover{

    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,.12);
    text-decoration:none;
    color:#222;

}

.card-top{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;

}

.card-icon{

    width:65px;
    height:65px;
    border-radius:18px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:26px;

}

.purple{

    background:#efe9ff;
    color:#6f42c1;

}

.orange{

    background:#fff3e8;
    color:#ff7a00;

}

.card-badge{

    padding:8px 18px;
    border-radius:30px;
    font-size:14px;
    font-weight:600;

}

.badge-success{

    background:#e9fbef;
    color:#16a34a;

}

.badge-danger{

    background:#ffecec;
    color:#ef4444;

}

.dashboard-card h4{

    font-size:28px;
    margin-bottom:15px;
    color:#374151;
    font-weight:600;

}

.dashboard-card h2{

    font-size:42px;
    color:#2563eb;
    margin-bottom:15px;

}

.dashboard-card p{

    color:#94a3b8;
    margin:0;
    font-size:15px;

}

@media(max-width:768px){

.dashboard-card{

    margin-bottom:20px;

}

}


.invoice-modal{

    border:none;

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 20px 50px rgba(0,0,0,.15);

}

.invoice-modal .modal-header{

    background:#f8fafc;

    border-bottom:1px solid #edf2f7;

    padding:20px 25px;

}

.invoice-modal .modal-body{

    background:#fff;

}

.invoice-header{

    text-align:center;

    margin-bottom:25px;

}

.invoice-logo{

    width:170px;

    margin-bottom:15px;

}

.invoice-header h3{

    font-weight:700;

    color:#1e293b;

    margin-bottom:5px;

}

.invoice-header p{

    color:#64748b;

}

.invoice-box{

    background:#f8fafc;

    border-radius:14px;

    padding:18px;

    margin-bottom:20px;

}

.invoice-box p{

    margin-bottom:10px;

}

.invoice-table{

    width:100%;

    border-collapse:collapse;

    margin-top:20px;

}

.invoice-table th{

    background:#2563eb;

    color:#fff;

    padding:12px;

    text-align:left;

}

.invoice-table td{

    padding:12px;

    border-bottom:1px solid #edf2f7;

}

.invoice-total{

    font-size:18px;

    font-weight:700;

    color:#16a34a;

}

.invoice-status{

    display:inline-block;

    padding:8px 18px;

    border-radius:30px;

    background:#dcfce7;

    color:#15803d;

    font-weight:600;

}

.btn-success{

    border-radius:10px;

}

.btn-close{

    box-shadow:none;

}
</style>
<div class="container-fluid mb-4">



    <!-- Dashboard Cards -->
    <div class="row g-4">

        <!-- Redeem Request Card -->
        <div class="col-lg-6 col-md-6">

            <a href="{{ route('admin.withdrawal.requests') }}" class="dashboard-card">

                <div class="card-top">

                    <div class="card-icon purple">
                        <i class="fas fa-wallet"></i>
                    </div>

                    <span class="card-badge badge-success">
                        Redeem
                    </span>

                </div>

                <h4>Redeem Requests</h4>

                <h2>
                    <i class="fas fa-arrow-circle-right"></i>
                </h2>

                <p>
                    View all redeem requests
                </p>

            </a>

        </div>

        <!-- Referral Card -->

        <div class="col-lg-6 col-md-6">

            <a href="{{ route('referral_earnings') }}" class="dashboard-card">

                <div class="card-top">

                    <div class="card-icon orange">
                        <i class="fas fa-users"></i>
                    </div>

                    <span class="card-badge badge-danger">
                        Referral
                    </span>

                </div>

                <h4>Referral Earnings</h4>

                <h2>
                    <i class="fas fa-arrow-circle-right"></i>
                </h2>

                <p>
                    View all referral earnings
                </p>

            </a>

        </div>

    </div>

</div>
<!-- DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container-fluid mt-4">

    <!-- Search Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('admin.transactions') }}">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <input type="text"
                               name="search"
                               class="form-control search-box"
                               placeholder="Search by Name / Transaction ID..."
                               value="{{ request()->search }}">

                    </div>

                    <div class="col-md-4 text-end">

                        <button class="btn btn-primary px-4">

                            <i class="fas fa-search me-2"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <!-- Transaction Card -->

    <div class="card transaction-card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 py-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h4 class="mb-1 fw-bold">

                        <i class="fas fa-credit-card text-primary me-2"></i>

                        Transactions List

                    </h4>

                    <small class="text-muted">

                        Total Transactions :
                        {{ $data['transactions']->total() }}

                    </small>

                </div>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table transaction-table align-middle mb-0">

                    <thead>

                    <tr>

                        <th>#</th>

                        <th>User</th>

                        <th>Transaction ID</th>

                        <th>Amount</th>

                        <th>Status</th>

                        <th>Date</th>

                        <th>Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($data['transactions'] as $transaction)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            <strong>

                                {{ $transaction->user_name }}

                            </strong>

                        </td>

                        <td>

                            <span class="txn-id">

                                {{ $transaction->transaction_id }}

                            </span>

                        </td>

                        <td>

                            <span class="amount-badge">

                                ₹{{ number_format($transaction->amount,2) }}

                            </span>

                        </td>

                        <td>

                            @if(strtolower($transaction->status)=='approved')

                                <span class="badge bg-success rounded-pill px-3">

                                    Approved

                                </span>

                            @elseif(strtolower($transaction->status)=='pending')

                                <span class="badge bg-warning text-dark rounded-pill px-3">

                                    Pending

                                </span>

                            @else

                                <span class="badge bg-danger rounded-pill px-3">

                                    {{ ucfirst($transaction->status) }}

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}

                            <br>

                            <small class="text-muted">

                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('h:i A') }}

                            </small>

                        </td>

                        <td>

                            <button
                                class="btn btn-primary rounded-pill px-3 show-history-btn"
                                data-transaction-id="{{ $transaction->transaction_id }}">

                                <i class="fa fa-eye me-1"></i>

                                Invoice

                            </button>

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white border-0 py-3">

            {!! $data['transactions']->appends(['search'=>request()->search])->links('pagination::bootstrap-5') !!}

        </div>

    </div>

</div>

<!-- Modern Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content invoice-modal">

            <div class="modal-header">

                <h4 class="modal-title fw-bold">

                    <i class="fas fa-file-invoice-dollar text-primary me-2"></i>

                    Transaction Invoice

                </h4>

                <div>

                    <button id="downloadInvoice" class="btn btn-success me-2">

                        <i class="fa fa-download"></i>

                        Download

                    </button>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>

                </div>

            </div>

            <div class="modal-body p-4">

                <div id="transaction-invoice-content">

                    <!-- Logo -->

                    <div class="invoice-header">

                        <img src="../theme/frontend/img/logo.png"
                             class="invoice-logo">

                        <h3>JFinserv Consultant</h3>

                        <p class="text-muted">

                            Transaction Invoice

                        </p>

                    </div>

                    <hr>

                    <!-- AJAX Content Here -->

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('script')
@parent
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Handle clicking on the 'eye' button to show the invoice
    $('.show-history-btn').on('click', function() {
        var transactionId = $(this).data('transaction-id');

        $.ajax({
            url: '/admin/transactions/' + transactionId + '/history',
            method: 'GET',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                var invoiceHtml = `
                    <div id="transaction-invoice-content" style="padding: 20px;">
                        <div style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                            <img src="../theme/frontend/img/logo.png" alt="Company Logo" style="width: 50%;margin-bottom: 10px;">
                        </div>                        
                        <div style="margin-top: 20px; border-bottom: 2px dashed #ddd; padding-bottom: 10px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">                                
                                <p style="margin: 0;"><strong>Date:</strong> ${data.created_at}</p>
                            </div>
                            <p style="margin: 0;"><strong>Transaction ID:</strong> ${data.transaction_id}</p>
                            <p style="margin: 0;"><strong>Name:</strong> ${data.user_name}</p>
                            <p style="margin: 0;"><strong>Email:</strong> ${data.email_id }</p>
                            <p style="margin: 0;"><strong>Contact:</strong> ${data.contact}</p>
                        </div>
                        <div style="margin-top: 20px;">
                            <h5>Transaction Details</h5>
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="padding: 5px;"><strong>Requested Amount:</strong></td>
                                    <td style="padding: 5px; text-align: right;">₹${data.amount}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>GST (2%):</strong></td>
                                    <td style="padding: 5px; text-align: right;">₹${data.gst}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px;"><strong>TDS (2%):</strong></td>
                                    <td style="padding: 5px; text-align: right;">₹${data.tds}</td>
                                </tr>
                                <tr style="border-top: 2px solid #000;">
                                    <td style="padding: 5px;"><strong>Final Amount:</strong></td>
                                    <td style="padding: 5px; text-align: right; font-weight: bold;">₹${data.final_amount}</td>
                                </tr>
                            </table>
                        </div>
                        <div style="margin-top: 20px; text-align: center; border-top: 2px solid #ddd; padding-top: 10px;">
                            <p>Status: <strong>${data.status}</strong></p>
                        </div>
                    </div>
                `;

                $('#transaction-invoice-content').html(invoiceHtml);
                $('#invoiceModal').modal('show');
            },
            error: function() {
                alert('Error fetching transaction history.');
            }
        });
    });
});
</script>
<script>
    document.getElementById('downloadInvoice').addEventListener('click', function() {
        // Open the print dialog
        window.print();
    });
</script>
@endsection
