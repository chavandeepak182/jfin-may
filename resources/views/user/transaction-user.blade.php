@extends('frontend.layouts.customer-dash')
@section('title', "Transactions History")

@section('content')
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="row">
                <div class="col-md-6">
                    <h2 class="mb-3">All Transactions</h2>
                </div>
                <div class="col-md-6">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('transactions.list') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search transactions..." value="{{ request()->input('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div> 

            <!-- Transactions Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transactions List</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive" id="transaction_table">
                        <table class="table table-hover my-0 bg-white rounded-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="d-none d-xl-table-cell">User Name</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction) <!-- Directly use transactions variable -->
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->user_name ?? 'No Name' }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') }}</td>
                                    <td>
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
                            {!! $transactions->appends(['search' => request()->input('search')])->links('pagination::bootstrap-5') !!}
                        </div>

                    </div>
                </div>
            </div>

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
        </div>
    </div>
</div>

@endsection

@section('custom-script')
	<script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
    <!-- DataTables and Export Buttons scripts -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            }
        });
    });

    $('#downloadInvoice').on('click', function() {
        var invoiceContent = $('#transaction-invoice-content').html();
        var blob = new Blob([invoiceContent], { type: 'application/pdf' });
        var link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'Invoice.pdf';
        link.click();
    });
});
</script>
@endsection