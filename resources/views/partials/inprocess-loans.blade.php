<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Loan ID</th>
                        <th>User Name</th>
                        <th>Loan Category</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        <!-- ✅ Proper serial number -->
                        <td>
                            {{ ($loans->currentPage() - 1) * $loans->perPage() + $loop->iteration }}
                        </td>

                        <td>{{ $loan->loan_reference_id }}</td>
                        <td>{{ $loan->user_name }}</td>
                        <td>{{ $loan->category_name }}</td>
                        <td>₹ {{ number_format($loan->amount) }}</td>
                        <td>{{ $loan->tenure }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('loan.view', $loan->loan_id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-warning"
                               href="{{ route('editLoan', $loan->loan_id) }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button class="btn btn-sm btn-danger"
                                onclick="deleteLoan({{ $loan->loan_id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No in-process loans found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ✅ Pagination -->
        @if ($loans->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }}
                of {{ $loans->total() }} results
            </div>

            {{ $loans->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>User Name</th>
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
                        <td>{{ $loan->user_name }}</td>
                        <td>{{ $loan->category_name }}</td>
                        <td>₹ {{ number_format($loan->amount) }}</td>
                        <td>{{ $loan->tenure }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('loan.view', $loan->loan_id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-warning"
                               href="{{ route('editLoan', $loan->loan_id) }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button class="btn btn-sm btn-danger"
                                onclick="deleteLoan({{ $loan->loan_id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No in-process loans found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

           
        </div>
    </div>
</div>
