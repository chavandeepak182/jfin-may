@extends('frontend.layouts.header')
@section('title', "Financial Services Companies in Pune - Jfinserv")
@section('description', "Discover top financial services companies in Pune. Explore a comprehensive list of Pune Housing Finance leading financial companies in Pune.")
@section('keywords', "financial services in pune, Home loan services in Pune, business loan provider in pune, Business loan services in Pune, Business loan in Pune")

@section('content')
<!-- Header Start -->
<!-- Page Banner Section -->
<section class="page-banner" style="background-image: url('{{ asset('theme') }}/frontend/img/aboutus.jpg');
">
    <div class="page-banner-overlay"></div>

    <div class="page-banner-container">
        <!-- <h1 class="page-banner-title">About Jfinserv</h1> -->
    </div>
</section>
<style>/* ================= DESKTOP (UNCHANGED) ================= */
.page-banner {
    position: relative;
    width: 100%;
    height: 420px;
    background-size: cover;       /* desktop crop allowed */
    background-position: center;
    background-repeat: no-repeat;
}

/* Overlay */
.page-banner-overlay {
    position: absolute;
    inset: 0;
    /* background: rgba(0,0,0,0.35); */
}

/* ================= MOBILE ONLY FIX ================= */
@media (max-width: 767px) {
    .page-banner {
        height: 280px;        /* ⬅ increase height */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
}
</style>
<!-- Header End -->
    <div class="container-fluid bg-light about py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100">
                        <h4 class="text-primary" style="color:#295cab">About Our Company</h4>
                        <h2 class="display-4 mb-4" style="color:#295cab">We Promise To <strong style="color:#00abeb">Deliver</strong> The Best</h2>
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
                                        <span class=" fs-2 fw-bold" data-toggle="counter-up" style="color:#295cab">250</span>
                                        <span class="h2 fw-bold" style="color:#295cab">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Disbursed Loans</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="fs-2 fw-bold " data-toggle="counter-up" style="color:#295cab">7</span>
                                        <span class="h2 fw-bold " style="color:#295cab">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Awards Won</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class=" fs-2 fw-bold" data-toggle="counter-up" style="color:#295cab">50</span>
                                        <span class="h2 fw-bold" style="color:#295cab">+</span>
                                    </div>
                                    <h4 class="mb-0 text-dark">Skilled Agents</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="counter-item bg-light rounded p-3 h-100">
                                    <div class="counter-counting">
                                        <span class="fs-2 fw-bold" data-toggle="counter-up" style="color:#295cab">75</span>
                                        <span class="h2 fw-bold" style="color:#295cab">+</span>
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
        <!-- <div class="container-fluid feature pb-5 bg-light">
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
        </div> -->
       <section class="finserv-wrapper">
    <div class="financial-services">

        <!-- Background Decorations -->
        <div class="bg-decoration bg-1"></div>
        <div class="bg-decoration bg-2"></div>

        <!-- Section Title -->
          <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 style="color: #295cab;">Our Features</h4>
                    <h1 class="display-4 mb-4" style="color:#295cab;">Trusted <strong style="color:#00abeb">Financial</strong> Consultants</h1>
                    <p class="mb-0">We understand that navigating the complexities of the financial landscape can be daunting. That's why our team of experienced professionals is here to guide you every step of the way. With our comprehensive loan services, you can trust us to help you secure the financing you need to achieve your dreams.</p>
                </div>

        <!-- Services Grid -->
        <div class="services-grid">

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="service-content">
                    <h3>Trusted Company</h3>
                    <p>
                        Trust is our foundation. We guide clients confidently through
                        their financial journey with transparency.
                    </p>
                    <a href="#" class="service-btn">Learn More</a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="service-content">
                    <h3>Unlimited Rewards</h3>
                    <p>
                        Earn rewards and referral income with performance-based bonuses
                        that grow with your success.
                    </p>
                    <a href="#" class="service-btn">Learn More</a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="service-content">
                    <h3>Fast & Easy Process</h3>
                    <p>
                        Minimal paperwork, quick approvals, and funds disbursed within
                        7 working days.
                    </p>
                    <a href="#" class="service-btn">Learn More</a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="service-content">
                    <h3>High Range Loan</h3>
                    <p>
                        Get loans up to ₹100 Cr with flexible terms, competitive rates,
                        and expert guidance.
                    </p>
                    <a href="#" class="service-btn">Learn More</a>
                </div>
            </div>

        </div>
    </div>
</section>


   <style>/* OUTER WRAPPER */
.finserv-wrapper {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 60px 20px;
}

/* MAIN SECTION */
.financial-services {
    background: #ffffff;
    border-radius: 20px;
    padding: 80px 60px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
}

/* SECTION TITLE */
.section-title {
    text-align: center;
    margin-bottom: 70px;
}

.section-title h2 {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(90deg, #295cab, #295cab);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.section-title p {
    font-size: 1.2rem;
    color: #555;
    max-width: 700px;
    margin: 15px auto 0;
}

/* GRID */
.services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

/* CARD */
.service-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: all 0.4s ease;
    text-align: center;
    padding-bottom: 40px;
    border: 1px solid rgba(0,0,0,0.05);
}

.service-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* ICON */
.service-icon {
    width: 90px;
    height: 90px;
    margin: 40px auto 30px;
    background: linear-gradient(135deg, #295cab, #295cab);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 2.4rem;
    transform: rotate(45deg);
    transition: 0.4s;
}

.service-icon i {
    transform: rotate(-45deg);
}

.service-card:hover .service-icon {
    transform: rotate(0deg) scale(1.1);
    background: linear-gradient(135deg, #00abeb, #00abeb);
}

/* CONTENT */
.service-content h3 {
    font-size: 1.5rem;
    color: #1a3c8b;
    margin-bottom: 15px;
}

.service-content p {
    color: #666;
    padding: 0 25px;
    line-height: 1.7;
}

/* BUTTON */
.service-btn {
    display: inline-block;
    margin-top: 25px;
    padding: 14px 32px;
    border-radius: 50px;
    background: linear-gradient(to right, #295cab, #295cab);
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.service-btn:hover {
    /* background: linear-gradient(to right, #ee1c25, #ffb74d); */
    color:#fff;
}

/* BACKGROUND CIRCLES */
.bg-decoration {
    position: absolute;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(26,60,139,0.05), rgba(255,152,0,0.05));
}

.bg-1 {
    top: -300px;
    right: -300px;
}

.bg-2 {
    bottom: -300px;
    left: -300px;
}

/* RESPONSIVE */
@media (max-width: 1200px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
    }

    .financial-services {
        padding: 60px 30px;
    }
}
</style>
   <script>
document.querySelectorAll('.service-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();
        console.log(btn.closest('.service-card').querySelector('h3').innerText);
    });
});
</script>
    
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
                                <h4  style="color:#295cab" >Future Ready</h4>
                                <h2 class="display-4" style="color:#295cab"><strong style="color:#00abeb">Mission, Vision </strong>& Values</h2>
                                <h3 class="" style="color:#295cab"><strong>Our Mission</strong></h3>
                                <p>Our mission is to be the leading finance company, offering secured loans at competitive rates. We focus on maximizing shareholder value while delivering exceptional, customer-centered service.</p>
                                <h3 class="" style="color:#295cab"><strong>Our Values</strong></h3>
                                <p>We are transitioning into a knowledge-driven organization by enhancing operational autonomy and fostering a strong sense of ownership among employees.</p>
                                <h3 class="" style="color:#295cab"><strong>Our Vision</strong></h3>
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
                    <h4 class="text-primary" style="color:#295cab">Our Awards</h4>
                    <h2 class="display-4 mb-4"style="color:#295cab">Top<strong style="color:#00abeb"> Corporate </strong>Recognitions</h2>
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
        <!-- <div class="container-fluid team pb-5 mt-5 pt-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="" style="color:#295cab">Our Team</h4>
                    <h2 class="display-4 mb-4" style="color:#295cab">Meet Our<strong style="color:#00abeb"> Leadership Team </strong></h2>
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
                                <img src="{{ asset('theme') }}/frontend/img/team/rushi-2.png" class="img-fluid rounded-top w-100" alt="">
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
                    <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="team-icon">
                                    <a class="btn btn-primary btn-sm-square rounded-pill" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="team-title p-3">
                                <h4 class="mb-0">Sonali Bhosale</h4>
                                <p class="mb-0">Executive Officer</p>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div> -->
       
       <div class="team-area pt-80 pb-70" id="team">
    <div class="container">
        <div class="section-title text-center w-75 mx-auto">
            <!-- <span class="sp-color2">Our Team</span> -->
            <h4 style="color: #295cab;margin-top:40px">Our Team</h4>
                    <h1 class="display-4 mb-4" style="color:#295cab;">Meet Our <strong style="color:#00abeb">Leadership</strong> Team</h1>
           <!-- Meet Our Leadership Team -->
            <p>
                Our team at JFS Technologies comprises seasoned professionals, passionate innovators,
                and industry experts delivering real results.
            </p>
        </div>

        <div class="row pt-45 justify-content-center">

            <!-- Dilip Kumar -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dilip-y.jpg" alt="Dilip Kumar">
                    <ul class="social-link">
                        <li>
                            <a href="#" target="_blank">
                                <i class="bx bxl-linkedin-square"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="content">
                        <h3>Dilip Kumar</h3>
                        <span>Managing Director</span>
                    </div>
                </div>
            </div>

            <!-- Parag Bhosale -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/parag.png" alt="Parag Bhosale">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Parag Bhosale</h3>
                         <span>Sales Manager</span>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
=======
            <!-- Nidhi Sonigra -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/nidhi.png" alt="Nidhi Sonigra">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Nidhi Sonigra</h3>
                        <span>Manager - Admin</span>
                    </div>
                </div>
            </div>

            <!-- Lokesh Bhosale -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/lokesh.png" alt="Lokesh Bhosale">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Lokesh Bhosale</h3>
                        <span>Sales Manager</span>
                    </div>
                </div>
            </div>

>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
            <!-- Prakash -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/praksh.png" alt="Prakash">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Prakash</h3>
                         <span>Sales Manager</span>
                    </div>
                </div>
            </div>

            <!-- Viraj -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/viraj.png" alt="Viraj">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Viraj</h3>
                         <span>Sales Manager</span>
                    </div>
                </div>
            </div>
<<<<<<< HEAD

            <!-- Lokesh Bhosale -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/lokesh.png" alt="Lokesh Bhosale">
=======
            
            <!-- Kevin Sunny -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" alt="Kevin Sunny">
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
<<<<<<< HEAD
                        <h3>Lokesh Bhosale</h3>
                        <span>Sales Manager</span>
=======
                        <h3>Kevin Sunny</h3>
                        <span>Sales Executive</span>
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            <!-- Nidhi Sonigra -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/nidhi.png" alt="Nidhi Sonigra">
=======
            <!-- Avinash Bodke -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" alt="Avinash Bodke">
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
<<<<<<< HEAD
                        <h3>Nidhi Sonigra</h3>
                        <span>Manager - Admin</span>
                    </div>
                </div>
            </div>

=======
                        <h3>Avinash Bodke</h3>
                        <span>Senior Accountant</span>
                    </div>
                </div>
            </div>
            
    
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
            <!-- Rushikesh Suryavanshi -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/rushi-2.png" alt="Rushikesh Suryavanshi">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Rushikesh Suryavanshi</h3>
                        <span>Accountant</span>
                    </div>
                </div>
            </div>

            <!-- Sara Shaikh -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" alt="Sara Shaikh">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Sara Shaikh</h3>
                          <span>Executive Officer</span>
                    </div>
                </div>
            </div>

            <!-- Sonali Bhosale -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" alt="Sonali Bhosale">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Sonali Bhosale</h3>
                        <span>Executive Officer</span>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
=======
            <!-- Aasta Rokade -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" alt="Aasta Rokade">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Aasta Rokade</h3>
                        <span>Executive Telecaller</span>
                    </div>
                </div>
            </div>

            <!-- Nikita Sanap -->
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="team-card">
                    <img src="{{ asset('theme') }}/frontend/img/team/dumy.jpg" alt="Nikita Sanap">
                    <ul class="social-link">
                        <li><a href="#"><i class="bx bxl-linkedin-square"></i></a></li>
                    </ul>
                    <div class="content">
                        <h3>Nikita Sanap</h3>
                        <span>Executive Telecaller</span>
                    </div>
                </div>
            </div>

>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
        </div>
    </div>
</div>
<style>.team-card {
    margin-bottom: 30px;
    position: relative;
    background: #252525;
}

.team-card img {
    width: 100%;
    filter: grayscale(1);
}

.team-card:hover img {
    filter: grayscale(0);
}

.team-card:hover .social-link {
    opacity: 1;
}

.team-card:hover .social-link li a {
    transform: scaleY(1);
}

.team-card:hover .content {
    border-radius: 0;
}

.team-card .social-link {
    position: absolute;
    top: 17%;
    right: 30px;
    padding: 0;
    list-style: none;
    opacity: 0;
    transition: 0.4s;
}

.team-card .social-link li {
    margin-bottom: 10px;
}

.team-card .social-link li a {
    width: 30px;
    height: 30px;
    line-height: 32px;
    text-align: center;
    color: #fff;
    border-radius: 50px;
    background-color: #295cab;
    display: inline-block;
    transform: scaleY(0);
    transition: 0.4s;
}

.team-card .social-link li a:hover {
    background-color: #fff;
    color: #295cab;
}

.team-card .content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #295cab;
    padding: 8px 25px;
    border-top-left-radius: 100px;
    text-align: center;
    transition: 0.9s;
}

.team-card .content h3 {
    margin-bottom: 0;
    color: #fff;
    font-size: 18px;
}

.team-card .content span {
    color: #fff;
    font-size: 13px;
}
</style>
    
        <!-- Team End -->

       <!-- FAQs Start -->
        <div class="container-fluid faq-section py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="h-100">
                            <div class="mb-5">
                                <h4 class="text-primary" style="color:#295cab">Some Important FAQ's</h4>
                                <h1 class="display-4 mb-0" style="color:#295cab">Common Frequently Asked <strong style="color:#00abeb">Questions</strong></h1>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Q: What all documents are required to apply for any Loan?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body rounded">
                                            A: To apply for a home loan, Contract loan, loan against property etc you need to submit documents such as a proof of identity, a proof of address, a loan application form that has been duly filled and your financial documents.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Q: How do you decide the eligibility for a loan against required amount?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: We determine your eligibility after considering various factors, including your monthly income, your monthly financial obligations, your current age and your retirement age, among other things.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Q: How is the Equated Monthly Interest (EMI) calculated?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: The EMI is calculated on the basis of specific factors like the amount of the loan, its tenure and the rate of interest.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Q: Is there any tax benefits available on EMI?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: Yes, you can claim the amount paid towards the repayment of the principal and the interest components as deductions in your income tax return. The limits on the amount deductible are governed by the applicable income tax laws.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Q: Is collateral required for obtaining a loan?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: Loan qualification depends on the financial viability of your project. Partial security may be required depending on the nature and size of the loan amount.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Q: Does Jfinserv charges any commission?
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            A: No, We do not charge any commission from customer. Our services are free of cost for all users/customers.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                        <img src="{{ asset('theme') }}/frontend/img/faq_img.jpg" class="img-fluid w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQs End --> 

@endsection