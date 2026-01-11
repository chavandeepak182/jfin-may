<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Amount</th>
                    <th>Tenure</th>
                    <th>Customer Name</th>
                    <th>Loan Category</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_reference_id }}</td>
                        <td>₹ {{ number_format($loan->amount) }}</td>
                        <td>{{ $loan->tenure }}</td>
                        <td>{{ $loan->user_name }}</td>
                        <td>{{ $loan->category_name }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                               href="{{ route('loan.view', $loan->loan_id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-warning btn-sm"
                               href="{{ route('editLoan', $loan->loan_id) }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button class="btn btn-danger btn-sm"
                                onclick="deleteLoan('{{ $loan->loan_id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No disbursed loans found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ✅ Pagination -->
        @if ($loans->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }}
                of {{ $loans->total() }} entries
            </div>

            {{ $loans->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>
</div>
