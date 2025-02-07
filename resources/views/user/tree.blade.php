@extends('frontend.layouts.customer-dash')
@section('title', "LegDown")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">Your Downline & Their Loans</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
			<div class="w-100">
                @if($descendants->isEmpty())
                    <p class="text-center">No child nodes found for this user.</p>
                @else
                    <table class="table table-bordered bg-white mt-4">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Referral Code</th>
                                <th>Parent Name</th>
                                <th>Loans</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($descendants as $index => $descendant)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $descendant->name }}</td>
                                    <td>{{ $descendant->referral_code }}</td>
                                    <td>{{ $descendant->parent_name }}</td>
                                    <td>
                                        <select class="form-select child-loans-dropdown" data-user-id="{{ $descendant->user_id }}">
                                            <option value="" selected disabled>Select to view loans</option>
                                            <option value="view">View Loans</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div id="loan-details" class="mt-4" style="display:none;">
                        <h3>Loans for Selected User</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Loan Reference ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom-script')
<script src="{{ asset('theme') }}/user-dash/js/app.js"></script>
<script>
    document.querySelectorAll('.child-loans-dropdown').forEach(dropdown => {
    dropdown.addEventListener('change', function() {
        const userId = this.getAttribute('data-user-id');
        
        fetch(`/loans-by-child?user_id=${userId}`)
            .then(response => response.json())
            .then(data => {
                const loanDetailsDiv = document.getElementById('loan-details');
                const tableBody = loanDetailsDiv.querySelector('tbody');
                tableBody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach((loan, index) => {
                        const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${loan.loan_reference_id}</td>  <!-- Display the loan_reference_id -->
                            <td>${loan.amount}</td>
                            <td>${loan.status}</td>
                            <td>${loan.category_name}</td>
                            <td>${loan.created_at}</td>
                        </tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    tableBody.innerHTML = '<tr><td colspan="6">No loans found for this user.</td></tr>';
                }

                loanDetailsDiv.style.display = 'block';
            });
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const loanDetailsSection = document.getElementById('loan-details');
    const loanDetailsBody = loanDetailsSection.querySelector('tbody');

    document.querySelectorAll('.child-loans-dropdown').forEach(dropdown => {
        dropdown.addEventListener('change', async (event) => {
            const userId = event.target.getAttribute('data-user-id');
            const action = event.target.value;

            if (action === 'view') {
                loanDetailsBody.innerHTML = '<tr><td colspan="6" class="text-center">Loading...</td></tr>';
                dropdown.disabled = true;

                try {
                    const response = await fetch(`/api/loans/${userId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const loans = await response.json();
                    loanDetailsBody.innerHTML = '';

                    if (loans.length > 0) {
                        loans.forEach((loan, index) => {
                            loanDetailsBody.innerHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${loan.loan_reference_id}</td>
                                    <td>${loan.amount}</td>
                                    <td>${loan.status}</td>
                                    <td>${loan.category}</td>
                                    <td>${loan.created_at}</td>
                                </tr>`;
                        });
                    } else {
                        loanDetailsBody.innerHTML = '<tr><td colspan="6" class="text-center">No loans found for this user.</td></tr>';
                    }

                    loanDetailsSection.style.display = 'block';
                } catch (error) {
                    console.error('Error fetching loans:', error);
                   
                } finally {
                    dropdown.disabled = false;
                }
            }
        });
    });
});
</script>
@endsection