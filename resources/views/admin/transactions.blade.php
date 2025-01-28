@extends('layouts.header')

@section('title')
@parent
JFS | Wallet Balance 
@endsection

@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #transaction-invoice-content, #transaction-invoice-content * {
            visibility: visible;
        }
        #transaction-invoice-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Wallet Balance</li>
    </ol>
</nav>

<!-- DataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div style="padding: 1%"> 
    <h1 class="text-white"><center>All Transactions</center></h1> 
    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.transactions') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search transactions..." value="{{ request()->input('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- Transactions Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transactions List</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive" id="transaction_table">
            <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th> <!-- Added Action Column for Eye Button -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['transactions'] as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->user_name }}</td>
                        <td>{{ $transaction->transaction_id }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') }}</td>
                        <td>
                            <!-- Eye Button to Show History -->
                            <button class="btn btn-info show-history-btn" data-transaction-id="{{ $transaction->transaction_id }}">
                                <i class="fa fa-eye"></i> View Invoice
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Laravel Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {!! $data['transactions']->appends(['search' => request()->input('search')])->links('pagination::bootstrap-5') !!}
            </div>

            </div>
        </div>
    </div>
</div>

<!-- Transaction Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div style="text-align; margin-bottom: 10px;">
                    <button id="downloadInvoice" class="btn btn-primary">
                        <i class="fa fa-download"></i>
                    </button>
                </div>
                <h5 class="modal-title" id="invoiceModalLabel">Transaction Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="transaction-invoice-content" style="padding: 20px;">
                <div style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 10px;">
                    <!-- Logo and Company Name -->
                    <img src="../theme/frontend/img/logo.png" alt="Company Logo" style="width: 40%;margin-bottom: 10px;">
                    <h3 style="margin: 0;">JFinserv Consultant</h3>
                </div>

                <div style="margin-top: 20px; border-bottom: 2px dashed #ddd; padding-bottom: 10px;">
                    <!-- Customer Info -->
                    <p><strong>Transaction ID:</strong> ${data.transaction_id}</p>
                    <p><strong>Name:</strong> ${data.user_name}</p>
                    <p><strong>Email:</strong> ${data.email_id }</p>
                    <p><strong>Contact:</strong> ${data.contact}</p>
                </div>

                <div style="margin-top: 20px;">
                    <!-- Transaction Details -->
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
                    <!-- Footer -->
                    <p>Status: <strong>${data.status}</strong></p>
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
