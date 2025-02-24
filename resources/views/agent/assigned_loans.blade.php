@extends('layouts.header')

@section('title')
@parent
Assigned Loans
@endsection

@section('content')
@parent
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<div style="">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="d-flex align-items-center">
                    <ol class="breadcrumb m-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assigned Loans</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>User</th>
                            <th>Loan Category</th>
                            <th>Amount</th>
                            <th>Tenure</th>
                            <th>Agent Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loan->loan_reference_id }}</td>
                                <td>{{ $loan->user->name ?? 'N/A' }}</td>
                                <td>{{ $loan->loanCategory->category_name ?? 'N/A' }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->tenure }}</td>
                                <td>{{ ucfirst($loan->agent_action) ?? 'Pending' }}</td>
                                <td>
                                    @if($loan->agent_action == 'pending')
                                        <form action="{{ route('agent.acceptLoan') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="loan_id" value="{{ $loan->loan_id }}">
                                            <button type="submit" class="btn btn-success btn-xs">Accept</button>
                                        </form>
                                        <form action="{{ route('agent.rejectLoan') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="loan_id" value="{{ $loan->loan_id }}">
                                            <input type="text" name="remarks" placeholder="Enter remarks" required>
                                            <button type="submit" class="btn btn-danger btn-xs">Reject</button>
                                        </form>
                                    @elseif($loan->agent_action == 'accepted')
                                        <span class="badge bg-success">Accepted</span>
                                    @elseif($loan->agent_action == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
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
                            <th>Agent Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- Pagination controls handled by DataTables -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
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
