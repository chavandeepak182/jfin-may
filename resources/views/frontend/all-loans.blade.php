@extends('layouts.header')

@section('title')
    @parent
    All Loans
@endsection

@section('content')
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
    #wrapper #content-wrapper #content{

        background-color: #f8f9fc;
        
    }
    
</style>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
           
                <!-- Header -->
   <div class="page-header">
    <h1>Loan Applications</h1>

    <a href="../loan-application" class="btn-new-application">
        <i class="fas fa-user-plus"></i>
        New Application
    </a>
</div>

<!-- <div class="customer-overview-grid">

   
    <a href="{{ route('loans.index') }}" style="text-decoration:none; color:inherit;">
        <div class="overview-card blue active">

            <div class="overview-icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>

            <div class="overview-content">
                <h3>Total Loans</h3>
                <h4>{{ $totalLoans }}</h4>
                <div class="stat-footer">Tracked from Records</div>
            </div>

        </div>
    </a>


    <a href="{{ route('inprocess.loans') }}" style="text-decoration:none; color:inherit;">
        <div class="overview-card green">

            <div class="overview-icon">
                <i class="fas fa-sync-alt"></i>
            </div>

            <div class="overview-content">
                <h3>In Process Loans</h3>
                <h4>{{ $inProcessLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>

        </div>
    </a>

    
    <a href="{{ route('agent.approved.loans') }}" style="text-decoration:none; color:inherit;">
        <div class="overview-card purple">

            <div class="overview-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="overview-content">
                <h3>Approved Loans</h3>
                <h4>{{ $approvedLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>

        </div>
    </a>

   
    <a href="{{ route('disbursed.loans') }}" style="text-decoration:none; color:inherit;">
        <div class="overview-card white">

            <div class="overview-icon">
                <i class="fas fa-building-columns"></i>
            </div>

            <div class="overview-content">
                <h3>Disbursed Loans</h3>
                <h4>{{ $disbursedLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>

        </div>
    </a>

 
    <a href="{{ route('rejectedLoans') }}" style="text-decoration:none; color:inherit;">
        <div class="overview-card red">

            <div class="overview-icon">
                <i class="fas fa-times-circle"></i>
            </div>

            <div class="overview-content">
                <h3>Rejected Loans</h3>
                <h4>{{ $rejectedLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>

        </div>
    </a>

    <a href="{{ route('trashed.loans') }}" style="text-decoration:none; color:inherit;">
        <div class="overview-card orange">

            <div class="overview-icon">
                <i class="fas fa-trash-alt"></i>
            </div>

            <div class="overview-content">
                <h3>Trashed Loans</h3>
                <h4>{{ $trashedLoans }}</h4>
                <div class="stat-footer">Tracked from Records</div>
            </div>

        </div>
    </a>

</div> -->

<div class="customer-overview-grid">

    <!-- Total -->
    <a href="{{ route('loans.index') }}" class="card-link">
        <div class="overview-card blue {{ request('card') == null ? 'active' : '' }}">
            <div class="overview-icon"><i class="fas fa-file-invoice-dollar"></i></div>
            <div class="overview-content">
                <h3>Total Loans</h3>
                <h4>{{ $totalLoans }}</h4>
                <div class="stat-footer">Tracked from Records</div>
            </div>
        </div>
    </a>

    <!-- In Process -->
    <a href="{{ route('loans.index',['card'=>'inprocess']) }}" class="card-link">
        <div class="overview-card green {{ request('card')=='inprocess'?'active':'' }}">
            <div class="overview-icon"><i class="fas fa-sync-alt"></i></div>
            <div class="overview-content">
                <h3>In Process</h3>
                <h4>{{ $inProcessLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </div>
    </a>

    <!-- Approved -->
    <a href="{{ route('loans.index',['card'=>'approved']) }}" class="card-link">
        <div class="overview-card purple {{ request('card')=='approved'?'active':'' }}">
            <div class="overview-icon"><i class="fas fa-check-circle"></i></div>
            <div class="overview-content">
                <h3>Approved</h3>
                <h4>{{ $approvedLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </div>
    </a>

    <!-- Disbursed -->
    <a href="{{ route('loans.index',['card'=>'disbursed']) }}" class="card-link">
        <div class="overview-card white {{ request('card')=='disbursed'?'active':'' }}">
            <div class="overview-icon"><i class="fas fa-building-columns"></i></div>
            <div class="overview-content">
                <h3>Disbursed</h3>
                <h4>{{ $disbursedLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </div>
    </a>

    <!-- Rejected -->
    <a href="{{ route('loans.index',['card'=>'rejected']) }}" class="card-link">
        <div class="overview-card red {{ request('card')=='rejected'?'active':'' }}">
            <div class="overview-icon"><i class="fas fa-times-circle"></i></div>
            <div class="overview-content">
                <h3>Rejected</h3>
                <h4>{{ $rejectedLoans }}</h4>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </div>
    </a>

    <!-- Trashed -->
    <a href="{{ route('loans.index',['card'=>'trashed']) }}" class="card-link">
        <div class="overview-card orange {{ request('card')=='trashed'?'active':'' }}">
            <div class="overview-icon"><i class="fas fa-trash-alt"></i></div>
            <div class="overview-content">
                <h3>Trashed</h3>
                <h4>{{ $trashedLoans }}</h4>
                <div class="stat-footer">Tracked from Records</div>
            </div>
        </div>
    </a>

</div>
<style>.card-link,
.card-link:hover,
.card-link:focus,
.card-link:active {
    text-decoration: none !important;
    color: inherit !important;
}
</style>



          
        </div>
      <div class="table-card-large">
    <div class="table-header-large">
        <h3>All Loans</h3>
    </div>

    <div class="table-container-large">
        <table class="loans-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CUSTOMER</th>
                    <th>LOAN TYPE</th>
                    <th>AMOUNT</th>
                    <th>BANK</th>
                    <th>LOCATION</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($data['loans'] as $loan)
                    <tr>
                        <!-- SR NO -->
                        <td>
                            {{ $loop->iteration + ($data['loans']->currentPage() - 1) * $data['loans']->perPage() }}
                        </td>

                        <!-- CUSTOMER -->
                        <td>
                            <div class="customer-cell">
                                <div class="customer-avatar">
                                    {{ strtoupper(substr($loan['user_name'] ?? 'NA', 0, 2)) }}
                                </div>
                                <div class="customer-info">
                                    <div class="customer-name">
                                        {{ $loan['user_name'] }}
                                    </div>
                                    <div class="customer-id">
                                        {{ $loan['loan_reference_id'] }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- LOAN TYPE -->
                        <td>{{ $loan['loan_category_name'] }}</td>

                        <!-- AMOUNT -->
                        <td>₹{{ number_format($loan['amount']) }}</td>

                        <!-- BANK -->
                        <td>{{ $loan['bank_name'] }}</td>

                        <!-- LOCATION -->
                        <td>{{ $loan['city'] }}</td>

                        <!-- STATUS -->
                        <td>
                            <span class="status-badge active">
                                {{ ucfirst($loan['status'] ?? 'Pending') }}
                            </span>
                        </td>

                        <!-- ACTIONS -->
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('loan.view', $loan['loan_id']) }}"
                                   class="action-icon-btn" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('editLoan', $loan['loan_id']) }}"
                                   class="action-icon-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="action-icon-btn"
                                        onclick="deleteLoan('{{ $loan['loan_id'] }}')"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;">
                            No loan records found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <div class="pagination-info">
            Showing {{ $data['loans']->firstItem() }}
            to {{ $data['loans']->lastItem() }}
            of {{ $data['loans']->total() }} loans
        </div>

        <div class="pagination-controls">
            {{ $data['loans']->onEachSide(1)->links('pagination::bootstrap-4') }}
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Reduce width of search bar input */
    .form-control.form-control-sm {
        width: 600px !important; /* adjust as per your layout */
        display: inline-block;
        margin-left:40px;

    }
    label {
        margin-left:40px; /* adjust value: -5px to -15px as per look */
    }
</style>


    <script>
        $(document).ready(function() {
            // Check if DataTable is already initialized
            if (!$.fn.DataTable.isDataTable('#loansTable')) {
                // Initialize DataTable with export buttons
                $('#loansTable').DataTable({
                    paging: false,
                    info: false,
                    searching: true,
                    ordering: true,
                    lengthChange: true,
                    pageLength: 10,
                    dom: 'Bfrtip',
                    buttons: [{
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
                    url: '/path-to-submit-loan', // Change with the actual URL for submission
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
                    url: "{{ route('deleteLoan') }}",
                    method: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'loan_id': loanId
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', 'Loan has been deleted.', 'success')
                        .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Error!', 'There was an error deleting the loan.', 'error');
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
                buttons: [{
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
