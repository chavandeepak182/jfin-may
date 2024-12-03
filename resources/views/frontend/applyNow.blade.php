@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')

<!-- Professional Details -->
<div class="container-fluid contact bg-breadcrumb ptb-100 mb-5">
    <div class="container">
        <div class="row g-5 mt-3 mb-5 align-items-center">
            <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="contact-img d-flex justify-content-center">
                    <div class="contact-img-inner text-center">
                        <img src="{{ asset('theme') }}/frontend/img/docs.png" class="img-fluid w-75" alt="Image">
                    </div>
                </div>
            </div>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="col-md-6 wow fadeInRight" data-wow-delay="0.4s">
                <a href="/start_loan/1" class="btn btn-primary rounded-pill py-2 px-4 ms-3 flex-shrink-0">New Loan</a> 
                @if(Session::get('username'))
                    <a href="/start_loan/2" class="btn btn-primary rounded-pill py-2 px-4 ms-3 flex-shrink-0">Exiting Loans</a> 
                @endif
            </div>
        </div>
    </div>
</div>


@endsection