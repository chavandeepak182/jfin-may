<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Customer Name</th>
                    <th>Loan Category</th>
                    <th>Amount</th>
                    <th>Tenure</th>
                    <th>Assign To</th>
                    <th>Agent Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingLoans as $loan)
                <tr>
                    <td>{{ $loan->loan_reference_id }}</td>
                    <td>{{ $loan->user->name ?? 'N/A' }}</td>
                    <td>{{ $loan->loanCategory->category_name ?? 'N/A' }}</td>
                    <td>₹ {{ number_format($loan->amount) }}</td>
                    <td>{{ $loan->tenure }}</td>

                    <td>
                        <form action="{{ route('assignAgent') }}" method="POST">
                            @csrf
                            <input type="hidden" name="loan_id" value="{{ $loan->loan_id }}">

                            <select name="agent_id" class="form-control mb-1">
                                <option value="">Select Agent</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ $loan->agent_id == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if (empty($loan->agent_action) || $loan->agent_action === 'pending')
                                <button type="submit" class="btn btn-sm btn-primary">Assign</button>
                            @elseif ($loan->agent_action === 'rejected')
                                <button type="submit" class="btn btn-sm btn-warning">Reassign</button>
                            @endif
                        </form>
                    </td>

                    <td>{{ ucfirst($loan->agent_action ?? 'Pending') }}</td>

                    <td>
                        <a href="{{ route('editLoan', $loan->loan_id) }}" class="btn btn-sm btn-warning">
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
                    <td colspan="8" class="text-center text-muted">No pending loans found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ✅ Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            Showing {{ $pendingLoans->firstItem() }} to {{ $pendingLoans->lastItem() }}
            of {{ $pendingLoans->total() }} results
        </div>

        {{ $pendingLoans->links('pagination::bootstrap-5') }}
    </div>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Customer Name</th>
                    <th>Loan Category</th>
                    <th>Amount</th>
                    <th>Tenure</th>
                    <th>Assign To</th>
                    <th>Agent Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingLoans as $loan)
                <tr>
                    <td>{{ $loan->loan_reference_id }}</td>
                    <td>{{ $loan->user_name ?? 'N/A' }}</td>
                    <td>{{ $loan->category_name ?? 'N/A' }}</td>
                    <td>₹ {{ number_format($loan->amount) }}</td>
                    <td>{{ $loan->tenure }}</td>
                    <td>
    <form action="{{ route('assignAgent') }}" method="POST">
        @csrf
        <input type="hidden" name="loan_id" value="{{ $loan->loan_id }}">

        <select name="agent_id" class="form-control mb-1">
            <option value="">Select Agent</option>
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}"
                    {{ $loan->agent_id == $agent->id ? 'selected' : '' }}>
                    {{ $agent->name }}
                </option>
            @endforeach
        </select>

        @if (empty($loan->agent_action) || $loan->agent_action === 'pending')
            <button type="submit" class="btn btn-sm btn-primary">Assign</button>
        @elseif ($loan->agent_action === 'rejected')
            <button type="submit" class="btn btn-sm btn-warning">Reassign</button>
        @endif
    </form>
</td>

                    <td>{{ ucfirst($loan->agent_action ?? 'Pending') }}</td>
                    <td>
                        <a href="{{ route('editLoan', $loan->loan_id) }}" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger"
                            onclick="deleteLoan({{ $loan->loan_id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pendingLoans->links() }}
    </div>
</div>
