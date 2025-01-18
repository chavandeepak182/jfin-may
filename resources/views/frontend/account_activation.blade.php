@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")

@section('content')
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Welcome to Jfinserv</h4>         
    </div>
</div>

<div class="container mb-5">
    <div class="text-center pt-5 pb-5">       
        @if($result['status'] == 'failed')
            <img src="{{ asset('theme') }}/frontend/img/red-tick.png" alt="">
            <h4 class="text-danger mt-3"><?php echo $result['message']?></h4>
        @else
            <img src="{{ asset('theme') }}/frontend/img/green-tick.png" alt="">
            <h4 class="text-success mt-3"><?php echo $result['message']?></h4>
            <a href="{{ route('login') }}" class="btn btn-dark mt-4 rounded-pill py-3 px-4 px-md-5 ms-2">Let's Start</a>
            <br>
        @endif
        <br>
    </div>
</div>
@endsection