<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Loan No.</th>
                    <th>Customer Name</th>
                    <th>Loan Type</th>
                    <th>Amount</th>
                     <th>Status</th>
                    <th>Bank</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <!-- Correct serial number across pages -->
                        <td>
                            {{ ($loans->currentPage() - 1) * $loans->perPage() + $loop->iteration }}
                        </td>

                        <td>{{ $loan->loan_reference_id ?? '-' }}</td>
                        <td>{{ $loan->user->name ?? 'N/A' }}</td>
                        <td>{{ $loan->loanCategory->category_name ?? 'N/A' }}</td>
                        <td>₹ {{ number_format($loan->amount) }}</td>
                        <td>{{ ucfirst($loan->status) }}</td>

                        <td>{{ $loan->bankDetails->bank_name ?? 'N/A' }}</td>
                        <td>{{ $loan->user->profile->cityRelation->city ?? 'N/A' }}</td>

                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="restoreLoan('{{ $loan->loan_id }}')">
                                <i class="fa fa-undo"></i> Restore
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            No trashed loans found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ✅ Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }}
                of {{ $loans->total() }} entries
            </div>

            <div>
                {{ $loans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
<script>
function restoreLoan(loanId) {
    Swal.fire({
        title: 'Restore loan?',
        text: 'This loan will be restored.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, restore'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('loan.restore') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    loan_id: loanId
                },
                success: function (response) {
                    Swal.fire(
                        'Restored!',
                        response.msg ?? 'Loan restored successfully.',
                        'success'
                    );

                    // ✅ Reload list OR remove row
                    location.reload();
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Failed to restore loan.',
                        'error'
                    );
                }
            });
        }
    });
}
</script>

