
<style>
    table {
    width: 100%;
    background: #fff;
}
.pagination-wrapper {
    position: relative;
    z-index: 1000;
}

#loanListArea {
    position: relative;
    z-index: 1000;
    overflow: visible !important;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
            <td>{{ $loan->user->name }}</td>
            <td>{{ $loan->loanCategory->category_name }}</td>
            <td>₹ {{ number_format($loan->amount) }}</td>
            <td>{{ $loan->bankDetails->bank_name }}</td>
            <td>{{ $loan->user->profile->cityRelation->city }}</td>
         <td>
    {{-- View --}}
    <a class="btn btn-sm btn-primary"
       href="{{ route('loan.view', ['id' => $loan->loan_id]) }}">
        <i class="fa fa-eye"></i>
    </a>

    {{-- Edit --}}
    <a class="btn btn-sm btn-warning"
       href="{{ route('editLoan', ['id' => $loan->loan_id]) }}">
        <i class="fa fa-edit"></i>
    </a>

    {{-- Delete --}}
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
function deleteLoan(id) {
    if (!confirm('Are you sure you want to delete this loan?')) {
        return;
    }

    fetch("{{ url('agent/loan/delete') }}/" + id, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || 'Loan deleted successfully');
        location.reload();
    })
    .catch(error => {
        alert('Something went wrong');
    });
}
</script>

@if($loans->count())
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
                            <th>Loan No.</th>
                            <th> Customer Name</th>
                            <!-- <th>Product Type</th> -->
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
    <!-- Id -->
    <td>{{ $loan->loan_id }}</td>

    <!-- Loan No -->
    <td>{{ $loan->loan_reference_id ?? '-' }}</td>

    <!-- Customer Name -->
    <td>{{ $loan->user->name ?? '-' }}</td>

    <!-- Product Type -->
    <td>{{ $loan->loanCategory->category_name ?? '-' }}</td>


    <!-- Amount -->
    <td>₹ {{ number_format($loan->amount) }}</td>

    <!-- Bank -->
    <td>{{ $loan->bankDetails->bank_name ?? '-' }}</td>

    <!-- Location -->
    <td>{{ $loan->user->profile->cityRelation->city ?? '-' }}</td>


    <!-- Action -->
   <td>
    <!-- View -->
    <a href="{{ route('agent.loan.view', $loan->loan_id) }}"
       class="btn btn-sm btn-primary"
       title="View">
        <i class="fa fa-eye"></i>
    </a>

    <!-- Edit -->
    <a href="{{ route('editLoan', ['id' => $loan->loan_id]) }}"
       class="btn btn-sm btn-warning"
       title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    <!-- Delete -->
    <button type="button"
        class="btn btn-sm btn-danger"
        title="Delete"
        onclick="deleteLoan({{ $loan->loan_id }})">
        <i class="fa fa-trash"></i>
    </button>
</td>

</tr>
@endforeach
</tbody>


</table>
{{ $loans->links() }}
@else
<div class="text-center text-muted py-5">
    No loans found
</div>
@endif
<script>
function deleteLoan(id) {
    if (!confirm('Are you sure you want to delete this loan?')) {
        return;
    }

    fetch("{{ url('agent/loan/delete') }}/" + id, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || 'Loan deleted successfully');
        location.reload();
    })
    .catch(error => {
        alert('Something went wrong');
    });
}
</script>
