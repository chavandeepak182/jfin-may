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
                </table>
                <div class="d-flex justify-content-between align-items-center mt-4">
    <div class="dataTables_info">
        Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }} of
        {{ $loans->total() }} entries
    </div>

    <div class="dataTables_paginate paging_simple_numbers">
        {{ $loans->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</div>

            </div>
        </div>
@section('script')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // $(document).ready(function () {
    //     $('#example').DataTable({
    //         "paging": true,
    //         "searching": true,
    //         "info": true,
    //         "lengthChange": true,
    //         "ordering": true,
    //     });

    //     @if(session('success'))
    //         Swal.fire({
    //             title: 'Success!',
    //             text: "{{ session('success') }}",
    //             icon: 'success',
    //             confirmButtonText: 'OK'
    //         });
    //     @elseif(session('error'))
    //         Swal.fire({
    //             title: 'Error!',
    //             text: "{{ session('error') }}",
    //             icon: 'error',
    //             confirmButtonText: 'OK'
    //         });
    //     @endif
    // });

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

