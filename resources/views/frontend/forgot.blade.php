@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')

<script>
    $("document").ready(function(){
        setTimeout(function(){
        $(".alert-danger").remove();
        }, 3000 ); // 3 secs

        setTimeout(function(){
        $(".alert-success").remove();
        }, 6000 );
    });
</script>

<!-- Contact Start -->
    <div class="container-fluid contact bg-breadcrumb ptb-100 mb-5">
        <div class="container">
            <div class="row pt-5 pb-5 g-5 align-items-center">
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="contact-img d-flex justify-content-center" >
                        <div class="contact-img-inner">
                            <img src="{{ asset('theme') }}/frontend/img/forgot-pass.png" class="img-fluid w-100"  alt="Image">
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div>    
                        <h3 class="text-white">Reset Your Password</h3>
                        <p class="text-white mb-4">Enter your email address below, and we'll send you a link to create a new one.</p>
                        @if (session('status'))
                            <div class="alert alert-dismissable alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-dismissable alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{route('reset_password_link')}}" method="POST" id="register-form" role="form" autocomplete="off" class="form">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-0" id="email" name="email" placeholder="Registered Email address" required>
                                        <label for="name">Your Email</label>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12">
                                        <input name="recover-submit" class="btn btn-primary w-75 py-3" value="Reset Password" type="submit">
                                    </div>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Contact End -->
@endsection