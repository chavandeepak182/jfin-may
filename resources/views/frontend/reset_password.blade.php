@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<style>
    .form-gap {
        padding-top: 70px;
    }
    .card {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }
    .card-body {
        padding: 2rem;
    }
    .btn-primary {
        background-color: #0056b3;
        border: none;
    }
    .btn-primary:hover {
        background-color: #004494;
    }
    .alert {
        margin-top: 1rem;
    }
</style>

<script>
    $(document).ready(function(){
        setTimeout(() => $(".alert-danger").fadeOut(), 3000);
        setTimeout(() => $(".alert-success").fadeOut(), 60000);
    });
</script>

<div class="form-gap"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body text-center">
                    @php
                        $email = session('email_id');
                        $user_id = session('user_id');
                        $auth_id = session('auth_id');
                    @endphp

                    <img class="mb-4 rounded-circle" src="{{ asset('theme/jixlogo.png') }}" width="80" height="80" alt="Logo">
                    <h3 class="mb-3">Reset Password</h3>
                    <p class="text-muted">Use a strong and unique password you haven't used elsewhere.</p>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('update_password') }}">
                        @csrf

                        <div class="form-group text-left">
                            <label for="pass">New Password</label>
                            <input type="password" id="pass" name="password" class="form-control" required
                                placeholder="Enter new password"
                                title="Password must be 8–12 characters, include 1 uppercase, 1 lowercase, 1 number & 1 special character">
                        </div>

                        <div class="form-group text-left">
                            <label for="cpass">Confirm Password</label>
                            <input type="password" id="cpass" name="cpassword" class="form-control" required placeholder="Confirm your password">
                        </div>

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="auth_id" value="{{ $auth_id }}">

                        <button type="submit" class="btn btn-primary btn-block mt-4">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
