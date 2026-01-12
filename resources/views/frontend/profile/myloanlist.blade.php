@extends('frontend.layouts.customer-dash')
@section('title', 'All Loan List')

@section('content')
    <div class="container-fluid p-0">
        <!-- Filter Form -->
        <div class="row mt-3">
            <div class="col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="mb-3 text-dark">My Loan List</h2>
                    </div>
                    <div class="col-md-8 mx-auto mb-3">
                        <div class="d-flex justify-content-end">
                            @if (!$hasActiveLoan)
                            <a href="{{ route('loan.form') }}" class="btn btn-primary me-2">Apply New Loan</a>
                            @endif
                            <form method="GET" action="{{ route('loans.loans-list') }}">
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Filter by Status --</option>
                                    <option value="approved" {{ request()->status == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected" {{ request()->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                    <option value="disbursed" {{ request()->status == 'disbursed' ? 'selected' : '' }}>
                                        Disbursed</option>
                                    <option value="in process" {{ request()->status == 'in process' ? 'selected' : '' }}>In
                                        Process</option>
                                </select>
                            </form>
                        </div>

                    </div>
                </div>
                @if ($loans && count($loans) > 0)
                    <table class="table table-hover my-0 bg-white rounded-0">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="d-none d-xl-table-cell">Loan Reference ID</th>
                                    <th class="d-none d-xl-table-cell">Applied Amount</th>
                                    <th class="d-none d-xl-table-cell">Disbursed Amount</th>
                                    <th>Status</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
                                    <th class="d-none d-md-table-cell">Action</th>
                                </tr>
                            </thead>

 <tbody>
@foreach ($loans as $index => $loan)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $loan->loan_reference_id }}</td>

        {{-- Applied Amount --}}
        <td>
            ₹ {{ number_format($loan->amount, 2) }}
        </td>

        {{-- Disbursed Amount --}}
        <td>
            @if($loan->status === 'disbursed' && !empty($loan->amount_approved))
                ₹ {{ number_format($loan->amount_approved, 2) }}
            @else
                <span class="text-muted">—</span>
            @endif
        </td>

        <td>{{ ucfirst($loan->status) }}</td>

        <td>
            {{ \Carbon\Carbon::parse($loan->created_at)->format('d-m-Y') }}
        </td>

<td>
    {{-- Edit button (hide only after disbursement) --}}
    @if (strtolower($loan->status) !== 'disbursed')
        <a href="loanedit/{{ $loan->loan_id }}" class="btn btn-sm btn-warning">
            Edit
        </a>
    @endif

    {{-- View Sanction Letter (when Approved OR Disbursed) --}}
    @if (
        !empty($loan->sanction_letter) &&
        in_array(strtolower($loan->status), ['approved', 'disbursed'])
    )
        <a href="{{ asset('storage/sanction_letters/' . $loan->sanction_letter) }}"
           class="btn btn-sm btn-primary"
           target="_blank">
            View
        </a>
    @endif

    {{-- Rejected --}}
    @if (strtolower($loan->status) === 'rejected')
        <span class="text-muted">N/A</span>
    @endif
</td>


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
