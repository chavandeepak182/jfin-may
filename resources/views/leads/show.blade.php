@extends('layouts.header')

@section('content')

<div class="container mt-5">
    <!-- Lead Details Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Lead Details</h3>
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
                <a href="{{ route('leads.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fa fa-arrow-left"></i> Back to Leads
                </a>
                <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-warning btn-lg">
                    <i class="fa fa-edit"></i> Edit Lead
                </a>
                <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this lead?')">
                        <i class="fa fa-trash"></i> Delete Lead
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
