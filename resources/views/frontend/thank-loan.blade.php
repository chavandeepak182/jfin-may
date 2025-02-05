@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
    <div class="container-fluid contact bg-light py-5">
        <div class="container mb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <div class="d-flex justify-content-center" >
                    <div class="contact-img-inner">
                        <img src="{{ asset('theme') }}/frontend/img/thank-you.png" class="img-fluid w-50"  alt="Image">
                    </div>
                </div>
                <p class="mb-0 mt-5">We have received your inquiry and will be in touch soon. We typically respond within 24 hours. If you wish to contact us sooner, feel free to contact us at: <a href="tel:918421216367">+91 84212 16367</a>.</p>
                <a class="btn-search btn btn-dark rounded-0 mt-4 py-3 px-4 px-md-5 me-2 flex-shrink-0" href="{{ url('/') }}">Back to Home</a>
            </div>
        </div>
    </div>               
            
@endsection