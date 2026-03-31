<div class="card-body">


           <div class="table-responsive" id="loanTableWrapper">

                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Loan ID</th>
                            <th>User</th>
                            <th>Loan Category</th>
                            <th>Amount</th>
                            <th>Tenure</th>
                             <th>Status</th>
                            <th>Agent Status</th>
                            @if (session()->get('role_id') == 2)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                  <tbody>
                        @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->loan_reference_id }}</td>
                            <td>{{ optional($loan->user)->name }}</td>
                            <td>{{ optional($loan->loanCategory)->category_name }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->tenure }}</td>
                            <td>{{ ucfirst($loan->status) }}</td>
                            <td>{{ $loan->agent_action ? ucfirst($loan->agent_action) : 'Pending' }}</td>

                            @if (session()->get('role_id') == 2)
                            <td>
                            

                            <td>
                            <!-- View (Always visible) -->
                            <a class="btn btn-primary btn-xs view"
                            href="{{ route('agent.loan.view',$loan->loan_id) }}">
                            <i class="fa fa-eye"></i>
                            </a>

                            <!-- Edit (ONLY if NOT disbursed) -->
                           @if(trim(strtolower($loan->status)) != 'disbursed')
                                <a class="btn btn-warning btn-xs edit"
                                href="{{ route('agent.editLoan',$loan->loan_id) }}">
                                <i class="fa fa-edit"></i>
                                </a>
                            @endif

                            <!-- ❌ Delete button COMPLETELY REMOVED -->
                        </td>
                            @endif

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
                            @if (session()->get('role_id') == 2)
                                <th>Action</th>
                            @endif
                        </tr>
                    </tfoot>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-between align-items-center mt-4">
    <div class="dataTables_info">
        Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }}
        of {{ $loans->total() }} entries
    </div>
    <div class="dataTables_paginate paging_simple_numbers">
        {{ $loans->links('pagination::bootstrap-4') }}
    </div>
</div>

            </div>
        </div>
          <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            

            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @elseif (session('error'))
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

        document.getElementById('statusFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
    <script>
$(document).on('click', '#loanTableWrapper .pagination a', function (e) {
    e.preventDefault(); // ⛔ stop page reload

    let url = $(this).attr('href');

    $('#assignedLoansContainer').html(
        '<div class="text-center mt-4">Loading...</div>'
    );

    $.get(url, function (response) {
        $('#assignedLoansContainer').html(response);
    });
});
</script>

    
