@extends('layouts.header')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold" style="color:#000">My Leads</h3>

        <a href="{{ route('referraldsa.add.lead') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Lead
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow border-0">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>#</th>
                        <th>Applicant Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Loan Category</th>
                        <th>Loan Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th width="150">Action</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($leads as $lead)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $lead->customer_name }}</td>

                        <td>{{ $lead->mobile_no }}</td>

                        <td>{{ $lead->email }}</td>

                        <td>{{ $lead->category_name ?? $lead->loan_type }}</td>

                        <td>₹ {{ number_format($lead->loan_amount) }}</td>

                        <td>

                            @if($lead->status=='New')
                                <span class="badge bg-primary">New</span>

                            @elseif($lead->status=='Pending')
                                <span class="badge bg-warning">Pending</span>

                            @elseif($lead->status=='Approved')
                                <span class="badge bg-success">Approved</span>

                            @elseif($lead->status=='Rejected')
                                <span class="badge bg-danger">Rejected</span>

                            @else
                                <span class="badge bg-secondary">
                                    {{ $lead->status }}
                                </span>
                            @endif

                        </td>

                        <td>{{ date('d M Y', strtotime($lead->created_at)) }}</td>

                        <td>

                            <a href="{{ route('referraldsa.edit',$lead->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                         <form
action="{{ route('referraldsa.delete',$lead->id) }}"
method="POST"
class="d-inline">

@csrf

@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this lead?')">

<i class="fas fa-trash"></i>

</button>

</form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="text-center">
                            No Leads Found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

            @if(method_exists($leads,'links'))
                <div class="mt-3">
                    {{ $leads->links() }}
                </div>
            @endif

        </div>

    </div>

</div>

@endsection