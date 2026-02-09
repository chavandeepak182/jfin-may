@extends('layouts.header')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Book Visit Leads</h3>

    @if($leads->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Visit Date</th>
                    <th>Assign To Agent</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $key => $lead)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email ?? '-' }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td class="text-capitalize">{{ $lead->visitedate }}</td>
                        <td>
                            <form action="{{ route('bookvisit.assign') }}" method="POST">
                                @csrf
                                <input type="hidden" name="lead_id" value="{{ $lead->id }}">

                                <select name="agent_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                    <option value="">-- Select Agent --</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}"
                                            {{ $lead->assigned_to == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            @if($lead->agent)
                                <small class="text-success">Assigned</small>
                            @else
                                <small class="text-danger">Unassigned</small>
                            @endif
                        </td>
                        <td>{{ $lead->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">
            No visit enquiries found.
        </div>
    @endif
</div>
@endsection
