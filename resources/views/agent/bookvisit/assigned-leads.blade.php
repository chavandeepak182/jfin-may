@extends('layouts.header')

@section('content')
<div class="container">
    <h3>My Assigned Visit Leads</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Visit Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leads as $lead)
                <tr>
                    <td>{{ $lead->name }}</td>
                    <td>{{ $lead->phone }}</td>
                    <td>{{ $lead->email ?? '-' }}</td>
                    <td>{{ ucfirst($lead->visitedate) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No assigned leads</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
