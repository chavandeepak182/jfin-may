@extends('frontend.layouts.header')

@section('title', 'Register User')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid py-5 bg-light" style="background-image: url(../theme/frontend/img/bg-reg.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="contact-img d-flex justify-content-center">
                        <div class="contact-img-inner">
                            <img src="{{ asset('theme/frontend/img/agreement.png') }}" class="img-fluid w-100" alt="Image">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5 wow fadeInRight" data-wow-delay="0.4s">
                    <div>
                        <h4 class="text-white pb-3">Register Your Account</h4>
                        
                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Display validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Registration Form -->
                        <form action="{{ route('registerUser') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0 @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Phone" required>
                                        <label for="mobile_no">Your Phone</label>
                                        @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> 
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-0 @error('email_id') is-invalid @enderror" name="email_id" id="email_id" value="{{ old('email_id') }}" placeholder="Your Email" required>
                                        <label for="email_id">Your Email</label>
                                        @error('email_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>       
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control border-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                        <label for="password">Your Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>        
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control border-0 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Re-type Password" required>
                                        <label for="password_confirmation">Re-type Password</label>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>        
                                </div>
                                <div class="col-md-6 pt-3">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Register Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
