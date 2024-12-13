@extends('layouts.header')
@section('title')
@parent
JFS | ReferTool 
@endsection

@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Refer Tool</li>
    </ol>
</nav>
<div class="container">
    <h1 class="my-4">User List</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Referral Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email_id }}</td>
                    <td>{{ $user->referral_code ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection