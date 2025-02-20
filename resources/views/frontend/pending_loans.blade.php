@extends('layouts.header')

@section('title')
@parent
Pending Loans
@endsection

@section('content')
@parent


<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pending Loans</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>User</th>
                        <th>Loan Category</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>Assign To</th>
                        <th>Agent Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingLoans as $loan)
                        <tr>
                            <td>{{ $loan->loan_reference_id }}</td>
                            <td>{{ $loan->user_name ?? 'N/A' }}</td>
                            <td>{{ $loan->category_name ?? 'N/A' }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->tenure }}</td>
                            <td>
                                <form action="{{ route('assignAgent') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="loan_id" value="{{ $loan->loan_id }}">
                                    <div class="form-group">
                                        <label for="agent_id">Assign Agent:</label>
                                        <select name="agent_id" id="agent_id_{{ $loan->loan_id }}" class="form-control assign-agent" data-loan-id="{{ $loan->loan_id }}">
                                            <option value="">Select Agent</option>
                                            @foreach($agents as $agent)
                                                <option value="{{ $agent->id }}" {{ $loan->agent_id == $agent->id ? 'selected' : '' }}>
                                                    {{ $agent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($loan->agent_action === 'pending')
                                        <button type="submit" class="btn btn-primary">Assign</button>
                                    @elseif($loan->agent_action === 'rejected')
                                        <button type="submit" class="btn btn-warning">Reassign</button>
                                    @endif
                                </form>
                            </td>
                            <td>{{ ucfirst($loan->agent_action) ?? 'Pending' }}</td>
                            <td>
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
                        <th>Loan ID</th>
                        <th>User</th>
                        <th>Loan Category</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>Assign To</th>
                        <th>Agent Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Pagination -->
            <div class="float-right mt-3">
                {{ $pendingLoans->links() }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script>
    $(document).ready(function () {
        // Initialize DataTable with no pagination
        $('#example').DataTable({
            "paging": false, // Disable DataTables pagination
            "searching": true,
            "info": true,
            "lengthChange": false,
            "ordering": true,
        });

        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @elseif(session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    });

    $('.assign-agent').change(function() {
        var agentId = $(this).val();
        var loanId = $(this).data('loan-id');

        if(agentId) {
            $.ajax({
                url: "{{ route('assignAgent') }}",
                method: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'loan_id': loanId,
                    'agent_id': agentId,
                },
                success: function (response) {
                    Swal.fire({
                        title: response.msg,
                        text: "",
                        icon: "success",
                        confirmButtonText: 'OK'
                    }).then(function () {
                        location.reload();
                    });
                },
                error: function (response) {
                    Swal.fire({
                        title: response.msg,
                        text: "",
                        icon: "error",
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    // Define deleteLoan function
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
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Your loan has been deleted.',
                            'success'
                        ).then(function () {
                            location.reload();
                        });
                    },
                    error: function (response) {
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
