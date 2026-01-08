<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Loan No.</th>
                    <th> Customer Name</th>
                    <th>Loan Type</th>
                    <th>Amount</th>
                    <th>Bank</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loop->iteration + ($loans->currentPage() - 1) * $loans->perPage() }}</td>
                        <td>{{ $loan['loan_reference_id'] }}</td>
                        <td>{{ $loan['user_name'] }}</td>
                        <td>{{ $loan['loan_category_name'] }}</td>
                        <td>₹ {{ number_format($loan['amount']) }}</td>
                        <td>{{ $loan['bank_name'] }}</td>
                        <td>{{ $loan['city'] }}</td>
                        <td>
                            <button class="btn btn-warning btn-xs"
                                onclick="restoreLoan('{{ $loan['loan_id'] }}')">
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

        <!-- Pagination -->
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
