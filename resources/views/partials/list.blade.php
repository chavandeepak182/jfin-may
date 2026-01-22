@if($loans->count())

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Loan No.</th>
            <th>Customer Name</th>
            <th>Loan Type</th>
            <th>Amount</th>
            <th>Bank</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->loan_id }}</td>
            <td>{{ $loan->loan_reference_id }}</td>

            {{-- SAFE relation access --}}
            <td>{{ optional($loan->user)->name ?? '-' }}</td>
            <td>{{ optional($loan->loanCategory)->category_name ?? '-' }}</td>
            <td>₹ {{ number_format($loan->amount) }}</td>
            <td>{{ optional($loan->bankDetails)->bank_name ?? '-' }}</td>

            {{-- Deep relation safe --}}
            <td>
                {{ optional(optional(optional($loan->user)->profile)->cityRelation)->city ?? '-' }}
            </td>

            <td>
                <a class="btn btn-sm btn-primary"
                   href="{{ route('loan.view', ['id' => $loan->loan_id]) }}">
                    <i class="fa fa-eye"></i>
                </a>

                <a class="btn btn-sm btn-warning"
                   href="{{ route('editLoan', ['id' => $loan->loan_id]) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <button class="btn btn-sm btn-danger"
                        onclick="deleteLoan('{{ $loan->loan_id }}')">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-end mt-3">
    {{ $loans->links('pagination::bootstrap-5') }}
</div>

@else
<div class="text-center text-muted py-4">
    No loans found
</div>
@endif
<script>
function deleteLoan(loanId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This loan will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('deleteLoan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    loan_id: loanId
                },
                success: function (response) {
                    Swal.fire(
                        'Deleted!',
                        response.msg ?? 'Loan deleted successfully.',
                        'success'
                    );

                    // ✅ Remove row from table (NO reload)
                    $('#loan-row-' + loanId).fadeOut(400, function () {
                        $(this).remove();
                    });
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Something went wrong while deleting.',
                        'error'
                    );
                }
            });
        }
    });
}
</script>
