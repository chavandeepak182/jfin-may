@extends('frontend.layouts.header')
@section('title', "Financial Services Companies in Pune - Jfinserv")
@section('description', "Discover top financial services companies in Pune. Explore a comprehensive list of Pune Housing Finance leading financial companies in Pune.")
@section('keywords', "financial services in pune, Home loan services in Pune, business loan provider in pune, Business loan services in Pune, Business loan in Pune")

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb" style="background-image: url(../theme/frontend/img/about-us.jpg);">
    <div class="container py-5">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Jfinserv</h4>
        <!-- <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a class="text-primary" href="/">Home</a></li>
            <li class="breadcrumb-item active text-primary">About Us</li>
        </ol>     -->
    </div>
</div>

<!-- Header End -->
    <div class="container-fluid bg-light about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <h4 class="text-primary">About Our Company</h4>
                        <h2 class="display-4 mb-4">We Promise To Deliver The Best</h2>
                        <p>Jfinserv Consultant India Private Limited with many finance partners strives to get you the best loan deals and offers online in just a few clicks. You can compare various loan products online with latest interest rates from Nationalized/Government banks and NBFCs in India including Indian Bank, BOM, PNB, RBL, UBI, BOB, Kotak, Axis, ICICI Bank, Aditya Birla Capital and other partners. Our team of financial experts works hard to find and get you the best deal. <a href="https://jfinserv.com/assets/certificate-of-incorporation.pdf" target="_blank" style="text-transform: uppercase; text-decoration: underline; color: #D83733; font-style: italic;">Incorporation Certificate <i class="fa-solid fa-arrow-right"></i></a></p>
                        <p>Jfinserv Can Help With All Your Home Lending Needs.</p>
                        <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Calculate Your Purchasing Power</p>
                        <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Buy Your Home</p>
                        <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Renovate Or Upgrade Your Home</p>
                        <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Use the Equity In Your Home For A Personal Investment</p>
                        <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Expand Your Property Portfolio</p>
                        <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Refinance Your Existing Loan</p>
                        <!-- <a class="btn btn-primary rounded-pill py-3 px-5" href="#">More Information</a> -->
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-5 h-100">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12">
                                <div class="rounded bg-light">
                                    <img src="{{ asset('theme') }}/frontend/img/about-1.jpg" class="img-fluid rounded w-100" alt="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">250</span>
                                        <span class="h2 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Disbursed Loans</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">7</span>
                                        <span class="h2 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Awards Won</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">50</span>
                                        <span class="h2 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Skilled Agents</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">75</span>
                                        <span class="h2 fw-bold text-primary">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Team Members</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- About End -->


    <!-- Feature Start -->
        <div class="container-fluid feature pb-5 bg-light">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Features</h4>
                    <h2 class="display-4 mb-4">Trusted Financial Consultants</h2>
                    <p class="mb-0">We understand that navigating the complexities of the financial landscape can be daunting. That's why our team of experienced professionals is here to guide you every step of the way. With our comprehensive loan services, you can trust us to help you secure the financing you need to achieve your dreams.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="far fa-handshake fa-3x"></i>
                            </div>
                            <h4 class="mb-4">Trusted Company</h4>
                            <p>Trust is our foundation. With experience and a strong track record, we guide clients confidently through their financial journeys.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fas fa-gift fa-3x"></i>
                            </div>
                            <h4 class="mb-4">Unlimited Rewards</h4>
                            <p>Earn income for each successful referral. We offer performance bonuses to unlock more earning potential.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fa fa-bullseye fa-3x"></i>
                            </div>
                            <h4 class="mb-4">Fast & Easier Process</h4>
                            <p>A fast & simple loan process provides quick approvals, minimal paperwork, & access to funds within 7 working days.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="feature-item p-4 pt-0">
                            <div class="feature-icon p-4 mb-4">
                                <i class="fas fa-chart-line fa-3x"></i>
                            </div>
                            <h4 class="mb-4">High Range Loan</h4>
                            <p>A high range loan of up to ₹100Cr. offers substantial funding for major investments or purchases, with flexible terms & competitive rates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Feature End -->

    <!-- Vision Mission Values Start -->
        <div class="container-fluid faq-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 wow fadeInLeft mx-auto" data-wow-delay="0.2s">
                        <img src="{{ asset('theme') }}/frontend/img/target.jpg" class="w-100 rounded shadow" alt="">
                    </div>
                    <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.4s">
                        <div>
                            <div>
                                <h4 class="text-primary">Future Ready</h4>
                                <h2 class="display-4">Mission, Vision & Values</h2>
                                <h3 class="text-primary"><strong>Our Mission</strong></h3>
                                <p>Our mission is to be the leading finance company, offering secured loans at competitive rates. We focus on maximizing shareholder value while delivering exceptional, customer-centered service.</p>
                                <h3 class="text-primary"><strong>Our Values</strong></h3>
                                <p>We are transitioning into a knowledge-driven organization by enhancing operational autonomy and fostering a strong sense of ownership among employees.</p>
                                <h3 class="text-primary"><strong>Our Vision</strong></h3>
                                <p>To be a leading financial consulting firm, delivering innovative, customized solutions for sustainable client growth, while upholding a culture of excellence and integrity.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vision Mission Values End -->

        <!-- Awards Start -->
        <div class="container-fluid feature pb-5 bg-light">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Awards</h4>
                    <h2 class="display-4 mb-4">Top Corporate Recognitions</h2>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-4 text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/pnb.jpg" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">Home Loan Sourcing - Rank 1<sup>st</sup></h4>
                            <p>Year 2023-24</p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-4 text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/arks.jpg" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">Preferred Business Partner</h4>
                            <p>Year 2023-24</p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-2 text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/pnb.jpg" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">Best Performaning in Home Loan Sourcing</h4>
                            <p>Year 2023-24</p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-2 text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/bom.jpg" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">For Mobilizing Mortgage Loan - Rank 1<sup>st</sup></h4>
                            <p>Year 2022-23</p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-4 text-center text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/ar.jpg" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">Best Category in Business</h4>
                            <p>Year 2022-23</p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-2 text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/bom.jpg" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">For Mobilizing Mortgage Loan - Rank 1<sup>st</sup></h4>
                            <p>Year 2021-22</p>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="feature-item p-3 pb-4 text-center">
                            <img src="{{ asset('theme') }}/frontend/img/bnk_logos/indian.png" alt="" class="w-50 rounded mb-4">
                            <h4 style="font-size: 18px;">Top Performing DSA</h4>
                            <p>Year 2021-22</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Awards End -->

        <!-- Team Start -->
        <div class="container-fluid team pb-5 mt-5 pt-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Team</h4>
                    <h2 class="display-4 mb-4">Meet Our Leadership Team</h2>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/dilip-y.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Dilip Kumar</h4>
                                <p class="mb-0">Managing Director</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/nadir.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Nadir Ahmed</h4>
                                <p class="mb-0">Manager - Operation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/sunil.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Sunil Sukhwani</h4>
                                <p class="mb-0">BDM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/ajay.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Ajay Shrivastav</h4>
                                <p class="mb-0">BSM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/parag.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Parag Bhosale</h4>
                                <p class="mb-0">Sales Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/praksh.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Prakash</h4>
                                <p class="mb-0">Sales Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/viraj.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Viraj</h4>
                                <p class="mb-0">Sales Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/lokesh.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Lokesh Bhosale</h4>
                                <p class="mb-0">Sales Manager</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/nidhi.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Nidhi Sonigra</h4>
                                <p class="mb-0">Manager - Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/rushi.png" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Rushikesh Suryavanshi</h4>
                                <p class="mb-0">Accountant</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Sara Shaikh</h4>
                                <p class="mb-0">Executive Officer</p>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        <!-- Team End -->

        <!-- FAQs Start -->
        <div class="container-fluid faq-section py-5 pb-5 mb-4">
            <div class="container pb-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="h-100">
                            <div class="mb-5">
                                <h4 class="text-primary">Some Important FAQ's</h4>
                                <h2 class="display-4 mb-0">Common Frequently Asked Questions</h2>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Q: What is Jfinserv?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body rounded">
                                            A: Jfinserv is your innovative one-stop shop for all financial needs, offering Home Loans, Project Loans, MSME Loans, Overdraft Facility and more.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Q: Why choose Jfinserv?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: At Jfinserv, we are financial experts offering a diverse range of products tailored to meet our customers' needs.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Q: Does Jfinserv charges any commission?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: A: No, We do not charge any commission from customer. Our services are free of cost for all users/customers.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                        <img src="{{ asset('theme') }}/frontend/img/faq-2.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQs End -->

@endsection