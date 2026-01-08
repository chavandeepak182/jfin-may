<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Customer Name</th>
                    <th>Loan Category</th>
                    <th>Amount</th>
                    <th>Tenure</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_reference_id }}</td>
                        <td>{{ $loan->user_name ?? 'N/A' }}</td>
                        <td>{{ $loan->loan_category_name ?? 'N/A' }}</td>
                        <td>₹ {{ number_format($loan->amount) }}</td>
                        <td>{{ $loan->tenure }}</td>
                        <td>
                            <a class="btn btn-primary btn-xs"
                               href="{{ route('agent.loan.view', $loan->loan_id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-warning btn-xs"
                               href="{{ route('agent.editLoan', $loan->loan_id) }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button class="btn btn-danger btn-xs"
                                onclick="deleteLoan('{{ $loan->loan_id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No rejected loans found
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
