@extends('frontend.layouts.header')

@section('title', 'Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv')

@section('content')

<div class="container-fluid contact bg-light py-5">
    <div class="container mb-5">

        <div class="text-center mx-auto pb-5 wow fadeInUp" 
             data-wow-delay="0.2s" 
             style="max-width: 800px;">

            {{-- Image --}}
            <div class="d-flex justify-content-center">
                <div class="contact-img-inner">
                    <img src="{{ asset('theme/frontend/img/thank-you.png') }}" 
                         class="img-fluid w-50" 
                         alt="Thank You">
                </div>
            </div>

            {{-- Message --}}
            <p class="mb-0 mt-5">
                We have received your inquiry and will be in touch soon. 
                We typically respond within 24 hours.
                <br><br>
                If you wish to contact us sooner, feel free to contact us at:
                <a href="tel:+918421216367">+91 84212 16367</a>
            </p>

            {{-- Optional Date --}}
            <p class="mt-3 text-muted">
                Submitted on: {{ \Carbon\Carbon::now()->format('d-m-Y h:i A') }}
            </p>

            {{-- Buttons --}}
            <div class="mt-4">

                {{-- Back to Home --}}
                <a href="{{ url('/') }}" 
                   class="btn btn-dark rounded-0 py-3 px-4 me-2">
                    Back to Home
                </a>

                {{-- Role Wise Dashboard --}}
                @if(session()->has('role_id'))
                    @php $role = session('role_id'); @endphp

                    @if($role == 1)
                        <a href="{{ route('loan.profile') }}" class="btn btn-primary py-3 px-4">
            Go to Dashboard
        </a>
                    @elseif($role == 2)
                        <a href="{{ route('agentDashboard') }}" class="btn btn-primary py-3 px-4">
                            Go to Dashboard
                        </a>

                    @elseif($role == 6)
                        <a href="/dsa/dashboard" class="btn btn-primary py-3 px-4">
                            Go to Dashboard
                        </a>

                    @elseif($role == 3)
                        <a href="/partner/dashboard" class="btn btn-primary py-3 px-4">
                            Go to Dashboard
                        </a>

                    @elseif($role == 4)
                        <a href="/admin/dashboard" class="btn btn-primary py-3 px-4">
                            Go to Dashboard
                        </a>
                    @endif

                @endif

            </div>

        </div>
    </div>
</div>

@endsection