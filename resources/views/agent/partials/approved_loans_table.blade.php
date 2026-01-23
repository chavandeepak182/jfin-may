<div class="card mt-3">
    <div class="card-body">

        <h5 class="mb-3">
            Approved Loans ({{ $approvedCount }})
        </h5>

        <div class="table-responsive" id="loanTableWrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>User</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->loan_reference_id }}</td>
                        <td>{{ $loan->amount }}</td>
                        <td>{{ $loan->tenure }}</td>
                        <td>{{ optional($loan->user)->name }}</td>
                        <td>{{ optional($loan->loanCategory)->category_name }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('agent.loan.view',$loan->loan_id) }}">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a class="btn btn-sm btn-primary"
                               href="{{ route('agent.editLoan',$loan->loan_id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No approved loans found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $loans->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
