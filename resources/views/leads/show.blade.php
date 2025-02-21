@extends('layouts.header')

@section('content')
<!-- Lead Details Section -->
<div class="card shadow-sm">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">All Leads</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lead's Details</li>
                </ol>
            </nav>
            <a href="{{ route('leads.index') }}" class="btn btn-primary float-right rounded"><i class="fa fa-arrow-left"></i> Back</a>
            <!-- Search Bar -->
            <!-- <div class="d-flex ms-auto">
                <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchLead()">
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <!-- Lead Info Table -->
        <table class="table table-bordered table-striped">
            <tr>
                <th class="bg-light">Full Name</th>
                <td>{{ $lead->name }}</td>
            </tr>
            <tr>
                <th class="bg-light">Email</th>
                <td>{{ $lead->email }}</td>
            </tr>
            <tr>
                <th class="bg-light">Phone</th>
                <td>{{ $lead->phone }}</td>
            </tr>
            <tr>
                <th class="bg-light">Lead Source</th>
                <td>{{ $lead->lead_source }}</td>
            </tr>
            <tr>
                <th class="bg-light">Interested In</th>
                <td>{{ $lead->property_type }}</td>
            </tr>
            <tr>
                <th class="bg-light">Budget</th>
                <td>{{ $lead->budget_min }} - {{ $lead->budget_max }}</td>
            </tr>
            <tr>
                <th class="bg-light">Lead Status</th>
                <td>
                    <span class="badge 
                        @if($lead->lead_status == 'New') badge-success 
                        @elseif($lead->lead_status == 'Contacted') badge-warning
                        @elseif($lead->lead_status == 'Closed') badge-danger 
                        @else badge-secondary @endif">
                        {{ $lead->lead_status }}
                    </span>
                </td>
            </tr>
            <tr>
                <th class="bg-light">Assigned Agent</th>
                <td>{{ $lead->agent->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th class="bg-light">Notes</th>
                <td>{{ $lead->notes ?? 'No additional notes available' }}</td>
            </tr>
        </table>

        <!-- Action Buttons -->
        <div class="mt-4">
            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning  px-3 py-2 rounded">
                <i class="fa fa-edit"></i> Edit
            </a>
            <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-3 py-2 rounded" onclick="return confirm('Are you sure you want to delete this lead?')">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
