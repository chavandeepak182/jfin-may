@extends('frontend.layouts.customer-dash')
@section('title', "All Loan List")

@section('content')
<div class="container-fluid p-0">
    <h2 class="mb-3 text-center">My Loan List</h2>
    <!-- Filter Form -->
    <div class="row">
        <div class="col-md-4 mx-auto mb-3">
            <form method="GET" action="{{ route('loans.loans-list') }}">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Filter by Status --</option>
                    <option value="approved" {{ request()->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request()->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="disbursed" {{ request()->status == 'disbursed' ? 'selected' : '' }}>Disbursed</option>
                    <option value="in process" {{ request()->status == 'in process' ? 'selected' : '' }}>In Process</option>
                </select>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            @if ($loans && count($loans) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Loan Reference ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $index => $loan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $loan->loan_reference_id }}</td>
                                <td>{{ number_format($loan->amount, 2) }}</td>
                                <td>{{ ucfirst($loan->status) }}</td>
                                <td>{{ \Carbon\Carbon::parse($loan->created_at)->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No loans found.</p>
            @endif
        </div>
    </div>
</div>
@endsection                
