@extends('frontend.layouts.header')
@section('title', "Refer for loan with low ROI | Financial Consultants in Pune - Jfinserv")
@section('description', "Explore the best Financial Consultants in Pune with refer for secure loans with low ROI. Apply now for the more financial benefits.")
@section('keywords', "Financial Consultants in Pune, Home finance in pune, Refer for loan with low ROI")

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb" style="background-image: url(../theme/frontend/img/ref-bnr.jpg);">
    <div class="container py-5">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Jfinserv Referral Program</h4>
    </div>
</div>

<!-- Header End -->
    <div class="container-fluid bg-light about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <!-- <h2 class="display-4 mb-4">Invite Friends & Help Them Achieve Their Dreams.</h2> -->
                        <p>There’s no limit to your earning potential when you refer our service. Earn for each successful referral and unlock more with performance bonuses. Our referral process is quick and easy—share your code with friends and colleagues in under a minute.</p>
                        <h4 class="text-primary"><strong>How Does It Work?</strong></h4>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>Go to ‘Refer Your Friend’ section.</p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>Share your and friend’s basic contact details.</p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>Referee applies for the product via a unique link.</p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>Friends application for any loans, gets approved.</p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>We communicate to you for bank account details.</p>
                        <p class="text-dark"><i class="fa fa-check text-primary me-3"></i>You get your Referral Bonus.</p>
                        <!-- <a class="btn btn-primary rounded-pill py-3 px-5" href="#">More Information</a> -->
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-5 h-100">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12">
                                <div class="rounded">
                                    <img src="{{ asset('theme') }}/frontend/img/referral_inner.jpg" class="img-fluid rounded w-100" alt="">
                                </div>
                            </div>
                            <!-- <div class="col-sm-12">
                                <div class="bg-light rounded p-3 h-100">
                                    <h3 class="text-primary mb-4 text-center">Refer Your Friend Now!</h3>
                                    <form action="{{ route('enquiry.store') }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-0" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                                    <label for="name">Your Name</label>
                                                </div>  
                                            </div>
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-0" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Phone" required>
                                                    <label for="contact">Your Phone</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-5">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control border-0" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                                    <label for="email">Your Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-0" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name" required>
                                                    <label for="name">Friend Name</label>
                                                </div>  
                                            </div>
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-0" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Phone" required>
                                                    <label for="contact">Friend Phone</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="form-floating">
                                                    <input type="email" class="form-control border-0" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                                    <label for="email">Friend Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-0" name="referal_code" id="referal_code" value="{{ old('email') }}" placeholder="Your Email" required>
                                                    <label for="referal_code">Referal Code</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-floating">
                                                    <select class="form-control border-0" id="service_type" name="service_type" required>
                                                        <option value="" selected disabled hidden>Select Service</option>
                                                        <option value="loan" {{ old('enquiry_type') == 'loan' ? 'selected' : '' }}>Loan</option>
                                                        <option value="property" {{ old('enquiry_type') == 'property' ? 'selected' : '' }}>Property</option>
                                                    </select>
                                                    <label for="service_type">Service Type</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-floating">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label p-0 px-4" for="flexCheckDefault">
                                                        <small>I accept the Terms, Official Rules, and Referral Program Terms.</small>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-5">
                                                <button class="btn btn-primary w-50 py-3" type="submit">Refer Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- About End -->

<!-- FAQs Start -->
    <div class="container-fluid faq-section bg-white py-5 pb-5 mb-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="h-100">
                        <div class="mb-5">
                            <h4 class="text-primary">Some Important FAQ's</h4>
                            <h1 class="display-4 mb-0">Common Frequently Asked Questions</h1>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Q: When I can expect the payout after referring to someone?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body rounded">
                                        A: Once the loan has been disbursed and confirmed by the bank/NBFC, your payout will be processed and the details can be seen through your dashboard.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Q: When my payout will be credited to my bank account?
                                    </button>
                                </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: The payout will be credited to your bank account upon requesting from your dashboard. We have option for automatic weekly and monthly release of payouts.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Q: Is there any additional bonus or incentive apart from regular payouts?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: Based on your performance, you can get Additional Bonus and Special Incentives and gift vouchers.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Q: Whom do I connect if I have any concern related to payout?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: You can connect to our Relationship Manager at contact@jfinserv.com regarding any query related to any service/s from Jfinserv.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                        <img src="{{ asset('theme') }}/frontend/img/carousel-2.png" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    <!-- FAQs End -->
@endsection