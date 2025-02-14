@extends('layouts.header')

@section('title')
@parent
All Loans
@endsection

@section('content')
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Loans</li>
                </ol>
            </nav>
        </div>

        <form method="GET" action="{{ route('loans.index') }}" class="mt-4 mb-3">
            <div class="row justify-content-space-between">
                <div class="col-md-3">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">All</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="disbursed" {{ request('status') == 'disbursed' ? 'selected' : '' }}>Disbursed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary ms-2">Reset</a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="loansTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Loan No.</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Amount</th>
                        <th>Bank</th>
                        <th>Location</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['loans'] as $loan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loan->loan_reference_id }}</td>
                            <td>{{ $loan->user_name ?? 'N/A' }}</td>
                            <td>{{ $loan->loan_category_name ?? 'N/A' }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->bank_name ?? 'N/A' }}</td>
                            <td>{{ $loan->city ?? 'N/A' }}</td>
                            <!-- <td>{{ ucfirst($loan->agent_action) ?? 'Pending' }}</td> -->
                            <td>
                                <a class="btn btn-primary btn-xs view" title="View" href="{{ route('loan.view', ['id' => $loan->loan_id]) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-primary btn-xs edit" title="Edit" href="{{ route('editLoan', ['id' => $loan->loan_id]) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteLoan('{{ $loan->loan_id }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Loan No.</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Amount</th>
                        <th>Bank</th>
                        <th>Location</th>
                        <th>Action</th> 
                    </tr>
                </tfoot>
            </table>
            <div class="float-right"> 
                {{ $data['loans']->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding loan -->
<div class="modal fade" id="addLoanModal" tabindex="-1" aria-labelledby="addLoanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLoanLabel">Add New Loan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLoanForm" method="post">
                    @csrf
                    <!-- Form fields for loan details -->
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="user_name" class="col-form-label">User Name:</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="amount" class="col-form-label">Amount:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tenure" class="col-form-label">Tenure:</label>
                            <input type="text" class="form-control" id="tenure" name="tenure" required>
                        </div>
                    </div>
                    <!-- Additional form fields can be added here -->

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@parent
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

<!--export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized
        if (!$.fn.DataTable.isDataTable('#loansTable')) {
            // Initialize DataTable with export buttons
            $('#loansTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: true,
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        title: 'Loans Data'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        title: 'Loans Data'
                    }
                ]
            });
        }

        // Handling the form submission (Example AJAX for adding loan)
        $('#addLoanForm').on('submit', function(e) {
            e.preventDefault();
            // Add AJAX request for form submission
            $.ajax({
                url: '/path-to-submit-loan',  // Change with the actual URL for submission
                method: 'POST',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    // Handle success (e.g., show a success message or update the table)
                    alert('Loan added successfully!');
                    // Optionally, reload the table after submission (if needed)
                    reloadLoansTable();
                },
                error: function(response) {
                    // Handle error (e.g., show an error message)
                    alert('Error adding loan!');
                }
            });
        });
    });

    // Delete loan function with confirmation
    function deleteLoan(loanId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('deleteLoan') }}",  // Adjust the route for deletion
                    method: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'loan_id': loanId,
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your loan has been deleted.',
                            'success'
                        ).then(function() {
                            // Optionally reload table after deletion
                            reloadLoansTable();
                        });
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the loan.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    // Function to reload DataTable (after AJAX updates)
    function reloadLoansTable() {
        // Destroy current DataTable instance
        var table = $('#loansTable').DataTable();
        table.clear().destroy(); // Clears existing data and destroys current DataTable instance
        
        // Reinitialize DataTable
        $('#loansTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'Loans Data'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    title: 'Loans Data'
                }
            ]
        });
    }
</script>
@endsection
