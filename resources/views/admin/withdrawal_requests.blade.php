@extends('layouts.header')
@section('title')
@parent
JFS | Wallet Balance 
@endsection
@section('content')

@section('content')
@parent
<!-- Breadcrumbs -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wallet Balance</li>
            </ol>
        </nav>
    </div>
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive" id="loan_table">
                <table id="example" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Reffer Code</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->referral_code }}</td>
                            <td>{{ $request->name }}</td> <!-- Display the user's name -->
                            <td>₹{{ number_format($request->amount, 2) }}</td>
                            <td>{{ ucfirst($request->status) }}</td>
                            <td>
                                <!-- View Button -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewRequestModal{{ $request->id }}">
                                    View
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="viewRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="viewRequestModalLabel{{ $request->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewRequestModalLabel{{ $request->id }}">Request Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Referral Code:</strong> {{ $request->referral_code }}</p>
                                                <p><strong>Amount:</strong> ₹{{ number_format($request->amount, 2) }}</p>
                                                <p><strong>Name:</strong> {{ $request->name }}</p>
                                                <p><strong>Requested On:</strong> {{ \Carbon\Carbon::parse($request->created_at)->format('d M, Y') }}</p>

                                                <!-- GST Dropdown -->
                                                <form action="{{ route('admin.withdrawal.approve', $request->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="gst">Select GST (%)</label>
                                                        <select name="gst" id="gst{{ $request->id }}" class="form-control">
                                                            <option value="0">0%</option>
                                                            <option value="2">2%</option>
                                                            <option value="5">5%</option>
                                                            <option value="12">12%</option>
                                                            <option value="18">18%</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label for="tds">Select TDS (%)</label>
                                                        <select name="tds" id="tds{{ $request->id }}" class="form-control">
                                                            <option value="0">0%</option>
                                                            <option value="1">1%</option>
                                                            <option value="2">2%</option>
                                                            <option value="5">5%</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label for="transaction_id">Transaction ID</label>
                                                        <input type="text" name="transaction_id" class="form-control" required>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label for="actual_amount">Actual Amount After GST Deduction</label>
                                                        <input type="text" id="actual_amount{{ $request->id }}" class="form-control" disabled>
                                                    </div>

                                                    <button type="submit" class="btn btn-success mt-3">Approve</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Reffer Code</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @if(session('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div> 

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
