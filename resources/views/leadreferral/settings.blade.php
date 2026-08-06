@extends('layouts.header')

@section('title','Settings')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Change Password</h4>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('referraldsa.change-password') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password"
                           name="current_password"
                           class="form-control">

                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password"
                           name="new_password"
                           class="form-control">

                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password"
                           name="new_password_confirmation"
                           class="form-control">
                </div>

                <button class="btn btn-primary">
                    Change Password
                </button>

            </form>

        </div>

    </div>

</div>

@endsection