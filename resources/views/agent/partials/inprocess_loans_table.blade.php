<div class="card mt-3">
    <div class="card-body">

        <!-- Search -->
        <div class="mb-3 col-md-4">
            <input type="text" id="inprocessSearch"
                   class="form-control"
                   placeholder="Search Loan / User / Category">
        </div>

        <div class="table-responsive" id="loanTableWrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>User</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Tenure</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                        <tr>
                            <td>{{ $loan->loan_reference_id }}</td>
                            <td>{{ optional($loan->user)->name }}</td>
                            <td>{{ optional($loan->loanCategory)->category_name }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->tenure }}</td>
                            <td>{{ ucfirst($loan->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No In-Process Loans</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between">
                <div>
                    Showing {{ $loans->firstItem() }} to {{ $loans->lastItem() }}
                    of {{ $loans->total() }} entries
                </div>
                {{ $loans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<script>
$('#inprocessSearch').keyup(function () {
    let search = $(this).val();

    $.get("{{ route('agent.inprocessLoans.ajax') }}", { search }, function (html) {
        $('#assignedLoansContainer').html(html);
    });
});
</script>
