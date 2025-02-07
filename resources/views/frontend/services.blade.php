@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Business loan services in Pune - Jfinserv")
@section('description', "Discover tailored home loan solutions and comprehensive financial services in Pune. Our expert team is business loan services in Pune.")
@section('keywords', "financial services in pune, Home loan services in Pune, business loan provider in pune, Business loan services in Pune, Business loan in Pune")

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb" style="background-image: url(../theme/frontend/img/services.jpg);">
    <div class="container py-5">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Services</h4>
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
                                <img src="{{ asset('theme') }}/frontend/img/Home_Loan.jpg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="{{ url('home-loan') }}" class="d-inline-block h4 mb-4">Home Loan</a>
                                    <p class="mb-4">We understand you're seeking a new home, with low rates & a seamless process, we’re here to help you through this important financial decision.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('home-loan') }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Loan_Against_Property.jpg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="{{ url('loan-against-property')}}" class="d-inline-block h4 mb-4">Loan Against Property</a>
                                    <p class="mb-4">Jfinserv offers Loan Against Property with flexible repayment options, secured by your property. Check your eligibility and enjoy exclusive add-on and tax benefits.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('loan-against-property')}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Project_Loan.jpg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="{{ url('project-loan')}}" class="d-inline-block h4 mb-4">Project Loan</a>
                                    <p class="mb-4">We simplify construction financing with low rates and an easy online application, offering tailored loans that ensure a smooth and timely process.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('project-loan')}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/MSME_Loan.jpg" class="img-fluid rounded-top w-100" alt="">
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="{{ url('msme-loan')}}" class="d-inline-block h4 mb-4">MSME Loan</a>
                                    <p class="mb-4">This service meets the diverse needs of small and medium businesses. Whether you're expanding, investing in equipment, or increasing capital.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('msme-loan')}}">Read More</a>
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
                                    <a href="{{ url('overdraft-facility')}}" class="d-inline-block h4 mb-4">Overdraft Facility</a>
                                    <p class="mb-4">An overdraft facility allows you to withdraw funds from a fixed line of credit as and when you need to.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('overdraft-facility')}}">Read More</a>
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
                                    <a href="{{ url('lease-rental-discounting')}}" class="d-inline-block h4 mb-4">Lease Rental Discounting (LRD)</a>
                                    <p class="mb-4">An overdraft facility allows you to withdraw funds from a fixed line of credit as and when you need to.</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ url('lease-rental-discounting')}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

@endsection