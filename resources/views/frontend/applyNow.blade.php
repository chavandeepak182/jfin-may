@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')

<!-- Professional Details -->
<div class="container-fluid contact bg-breadcrumb pt-5 mb-5" style="background: url(../theme/frontend/img/login.jpg);">
    <div class="container">
        <div class="row text-center justify-content-center wow fadeInUp" data-wow-delay="0.2s">
            <div class="col-md-6 mb-5 bg-white rounded">
                <div class="row align-items-center">
                    <div class="col-md-6 p-0">
                        <img src="{{ asset('theme') }}/frontend/img/apply-now.jpg" class="img-fluid w-100" style="border-radius: 10px 0px 0px 10px;" alt="Image">
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

                    <div class="col-md-6">
                        <a href="/start_loan/1" class="btn btn-dark rounded-0 py-2 px-4 ms-3 flex-shrink-0">Start New Application</a> 
                        @if(Session::get('username'))
                            <a href="/start_loan/2" class="btn btn-light rounded-0 py-2 px-4 ms-3 mt-3 flex-shrink-0">Exiting Loans</a> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection