@extends('layouts.header')

@section('title')
@parent
Admin MIS
@endsection

@section('content')

<!-- Breadcrumbs -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">MIS</li>
            </ol>
        </nav>

        <!-- Search Bar -->
        <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchUser()">
        </div>

        <!-- Add User Button -->
        <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addUserView">
            <i class="fa fa-plus"></i> Add User
        </button>
    </div>
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">


<div> 
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            
        </div>

        <div class="card-body">
            <div class="table-responsive">
            <table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Loan No.</th>
            <th>Name</th>
            <th>Product Type</th>
            <th>Contact</th>
            <th>Loan Amount</th>
            <th>Bank</th>                            
            <th>Location</th>
            @if(session()->get('role_id') == 4)
                <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data['loans'] as $loan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $loan->loan_reference_id }}</td>
                <td>
                    <a class="btn btn-link p-0" href="{{ route('admin.mis.view', ['id' => $loan->loan_id]) }}" title="View">
                        {{ $loan->user_name }}
                    </a>
                </td>
                <td>{{ $loan->loan_category_name ?? 'N/A' }}</td>
                <td>{{ $loan->mobile_no }}</td>
                <td>{{ $loan->amount }}</td>   
                <td>{{ $loan->bank_name ?? 'N/A' }}</td>                             
                <td>{{ $loan->city }}</td>
                @if(session()->get('role_id') == 4)
                    <td>
                        <a class="btn btn-primary btn-xs view" title="View" href="{{ route('admin.mis.view', ['id' => $loan->loan_id]) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-primary btn-xs edit" title="Edit" href="{{ route('editLoan', ['id' => $loan->loan_id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
                <div class="d-flex justify-content-center mt-3"> 
                    {{ $data['loans']->links() }}
                </div>
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
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
    $('#example').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthChange: true,
        pageLength: 10,
        dom: 'Bfrtip',  // Add this line to place buttons above the table
        buttons: [
            {
                extend: 'excelHtml5',  // Export to Excel
                text: 'Export to Excel',
                title: 'MIS Data', // Title of the file
            },
            {
                extend: 'pdfHtml5',   // Export to PDF
                text: 'Export to PDF',
                title: 'MIS Data', // Title of the file
                orientation: 'portrait', // 'portrait' or 'landscape'
                pageSize: 'A4', // Page size
                customize: function (doc) {
                    // Customize the PDF here (Optional)
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            }
        ],
    });
});

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
                        'loan_id': loanId,
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your loan has been deleted.',
                            'success'
                        ).then(function() {
                            location.reload();
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
</script>
@endsection
