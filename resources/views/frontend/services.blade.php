@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Business loan services in Pune - Jfinserv")
@section('description', "Discover tailored home loan solutions and comprehensive financial services in Pune. Our expert team is business loan services in Pune.")
@section('keywords', "financial services in pune, Home loan services in Pune, business loan provider in pune, Business loan services in Pune, Business loan in Pune")

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Services</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Service</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->


        <!-- Service Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">One Stop Solution</h4>
                    <h1 class="display-4 mb-4">We Handle All Your Lending Needs</h1>
                    <p class="mb-0">Select your desired loan amount, complete a brief set of questions, and receive an instant loan offer. Effortlessly provide the required documents to our representative. Choose the final sanctioned loan offer with terms that align with your needs.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Home_Loan.svg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Home Loan</a>
                                    <p class="mb-4">We acknowledge that buying a home is one of life's most significant financial decisions.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Loan_Against_Property.svg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Loan Against Property</a>
                                    <p class="mb-4">Check out your loan against property eligibility and get exclusive add on benefits and tax benefits.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Project_Loan.svg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Project Loan</a>
                                    <p class="mb-4">We'll help take the stress out of financing your building or renovation with our low rates & easy app.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/blog-4.png" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Overdraft Facility</a>
                                    <p class="mb-4">An overdraft facility allows you to withdraw funds from a fixed line of credit as and when you need to.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/blog-4.png" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Lease Rental Discounting (LRD)</a>
                                    <p class="mb-4">An overdraft facility allows you to withdraw funds from a fixed line of credit as and when you need to.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/MSME_Loan.svg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">MSME Loan</a>
                                    <p class="mb-4">An overdraft facility allows you to withdraw funds from a fixed line of credit as and when you need to fixed line of credit as and when.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

@endsection