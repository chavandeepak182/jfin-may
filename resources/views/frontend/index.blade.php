@extends('frontend.layouts.header')
@section('title', "Financial Services in Pune | Lowest Loan Interest in PCMC - Jfinserv")
@section('description', "Jfinserv provides financial services in Pune engaged in business, personal and MSME financing with lowest loan interest rates in Pune and PCMC and no hidden charges.")
@section('keywords', "financial services in pune, lowest loan interest in PCMC, business loan with low roi, financial consultants in Pune, Loan services in PCMC, Loan in Pune")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

@section('content')
        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel">
            <div class="header-carousel-item hero-bg" style="background-image: url('{{ asset('theme') }}/frontend/img/home-bannner.jpg');">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-6 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class=" text-uppercase fw-bold mb-2" style="color:#000;">Welcome To Jfinserv</h4>
                                    <h1 class="display-4  mb-4" style="color:#000;">Unique Reward & Earning Opportunity</h1>
                                    <p class="mb-5 fs-5" style="color:#000;">We offer a unique earning opportunity through our referral program, rewarding both your referrals and those made by your friends.</p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                        <a class="btn-search btn  rounded-1 py-3 px-4 px-md-5 me-2 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal" href="#" style="background-color:#295cab;color:#fff">ENQUIRE NOW</a>
                                        <a class="btn-search btn btn-danger rounded-1 py-3 px-4 px-md-5 ms-2" href="{{ url('/applyNow') }}">APPLY NOW</a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item hero-bg" style="background-image:url('{{ asset('theme') }}/frontend/img/home-banner-2.jpg');">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-6 animated fadeInLeft">
                                <div class="text-sm-center text-md-start">
                                    <h4 class=" text-uppercase fw-bold mb-2" style="color:#000;">Welcome To Jfinserv</h4>
                                    <h1 class="display-4  mb-4" style="color:#000;">Fastest, Secure & Easy Loan Process</h1>
                                    <p class="mb-5 fs-5" style="color:#000;">Experience fast, secure loans with competitive rates and personalized support in Pune. Enjoy seamless service and exceptional rewards.</p>
                                    <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                    <a class="btn-search btn btn-light rounded-1 py-3 px-4 px-md-5 me-2 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal" href="#" style="background-color: #295cab;color:#fff">ENQUIRE NOW</a>
                                    <a class="btn-search btn btn-danger rounded-1 py-3 px-4 px-md-5 ms-2" href="{{ url('/applyNow') }}">APPLY NOW</a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="header-carousel-item bg-primary">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row gy-4 gy-lg-0 gx-0 gx-lg-5 align-items-center">
                            <div class="col-lg-6 animated fadeInLeft">
                                <div class="calrousel-img">
                                    <img src="{{ asset('theme') }}/frontend/img/fast-process.png" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 animated fadeInRight">
                                <div class="text-sm-center text-md-end">
                                    <h4 class="text-white text-uppercase fw-bold mb-4">Welcome To Jfinserv</h4>
                                    <h1 class="display-3 text-white mb-4">Fastest, Secure & Easy Loan Process</h1>
                                    <p class="mb-5 fs-5">Experience fast, secure loans with competitive rates and personalized support in Pune. Enjoy seamless service and exceptional rewards.</p>
                                    <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4">
                                        <a class="btn-search btn btn-light rounded-pill py-3 px-4 px-md-5 me-2 flex-shrink-0" data-bs-toggle="modal" data-bs-target="#searchModal" href="#"><i class="fas fa-info-circle me-2" style="font-size: 20px"></i> Enquire Now</a>
                                        <a class="btn-search btn btn-light rounded-pill py-3 px-4 px-md-5 ms-2" href="{{ url('/applyNow') }}"><i class="far fa-hand-point-right me-2" style="font-size: 20px"></i> Apply Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
  
<!-- CUSTOM DOT PAGINATION -->

<style>.hero-pagination {
    position: absolute;
        bottom:-1px;

    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
}

.hero-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: none;
    background: #ccc;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hero-dot:hover {
    background: #295cab;
}

.hero-dot.active {
    background: #295cab;
    transform: scale(1.2);
}

/* ================= HERO BANNER MOBILE FIX ================= */
@media (max-width: 991px) {

    .header-carousel-item {
        min-height: 380px;            /* IMPORTANT */
        background-size: cover !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
    }

    .carousel-caption {
        position: relative;
        padding-top: 60px;
        padding-bottom: 40px;
    }
}

</style>



        <!-- css -->
         <script>
$(document).ready(function () {

    var heroCarousel = $('.header-carousel');

    heroCarousel.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 800,
        dots: false,   // ❌ disable owl dots
        nav: false
    });

    // DOT CLICK
    $('.hero-dot').on('click', function () {
        let index = $(this).data('slide');
        heroCarousel.trigger('to.owl.carousel', [index, 800]);
    });

    // UPDATE ACTIVE DOT ON SLIDE CHANGE
    heroCarousel.on('changed.owl.carousel', function (event) {
        let currentIndex = event.item.index - event.relatedTarget._clones.length / 2;
        let slideCount = event.item.count;

        currentIndex = ((currentIndex % slideCount) + slideCount) % slideCount;

        $('.hero-dot').removeClass('active');
        $('.hero-dot').eq(currentIndex).addClass('active');
    });

});
</script>

 

        <!-- Carousel End -->

        <!-- Feature Start -->
        <!-- <div class="container-fluid feature bg-light py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Features</h4>
                    <h1 class="display-4 mb-4">Trusted Financial Consultants</h1>
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
    background: linear-gradient(135deg, #1a3c8b, #2a56c9);
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
    background: linear-gradient(to right, #1a3c8b, #2a56c9);
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

<<<<<<< HEAD

    .d-inline-block{

        color:#000;
    }
>

=======
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
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



        <!-- Video Section Start -->
        <section class="video aos-init aos-animate" data-aos="zoom-in-right" data-aos-duration="700">
            <div class="container-fluid p-0">
                <video class="w-100" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
                    <source src="../theme/frontend/img/intro-video.mp4" type="video/mp4">
                    <source src="movie.webm" type="video/webm">Sorry, your browser does not support HTML5 video.
                </video>
            </div>
        </section>
        <!-- Feature End -->

        <!-- About Start -->
        <div class="container-fluid bg-light about py-5 pt-5">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="about-item-content bg-white rounded p-5 h-100">
                            <h4 class="text-primary" style="color:#295cab">About Our Company</h4>
                            <h2 class="display-4 mb-4"  style="color:#295cab">Your <strong  style="color:#00abeb">Security</strong>. Our Priority.</h2>
                            <p>JFinserv Consultant India Private Limited offers a range of financial services in Pune, including Home Loans, Project Loans, and MSME Loans, through multiple bank partnerships. We ensure low interest rates, minimal documentation, and flexible terms for a smooth loan process. Our experienced team is dedicated to guiding you through every step to help you achieve your financial goals.</p>
                            <h3 class="text-primary">Why Choose Us?</h3>
                            <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>No limit of loan amount</p>
                            <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Fast Disbursal Procedure</p>
                            <p class="text-dark"><i class="fas fa-check text-primary me-3 fa-lg"></i>Lowest rate of Interest</p>
                            <p class="text-dark mb-4"><i class="fas fa-check text-primary me-3 fa-lg"></i>Endless earning potential through referrals</p>
                            <a class="btn btn-primary rounded-1 py-2 px-4 uppercase" href="/about" target="_blank"  style="background-color:#295cab">Know More</a>
                        </div>
                    </div>
                    <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.1s">
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
                                            <span class="h1 fw-bold text-primary">+</span>
                                        </div>
                                        <h4 class="mb-0 text-dark">Disbursed Loans</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="counter-item bg-light rounded p-3 h-100">
                                        <div class="counter-counting">
                                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">7</span>
                                            <span class="h1 fw-bold text-primary">+</span>
                                        </div>
                                        <h4 class="mb-0 text-dark">Awards Won</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="counter-item bg-light rounded p-3 h-100">
                                        <div class="counter-counting">
                                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">50</span>
                                            <span class="h1 fw-bold text-primary">+</span>
                                        </div>
                                        <h4 class="mb-0 text-dark">Skilled Agents</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="counter-item bg-light rounded p-3 h-100">
                                        <div class="counter-counting">
                                            <span class="text-primary fs-2 fw-bold" data-toggle="counter-up">75</span>
                                            <span class="h1 fw-bold text-primary">+</span>
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

        <!-- Service Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary" style="color:#295cab">Our Services</h4>
                    <h1 class="display-4 mb-4"  style="color:#295cab">We Provide Best <strong style="color:#00abeb">Services</strong></h1>
                    <p class="mb-0">Choose your loan amount, answer a few questions, and receive an instant loan offer. Share the necessary documents with our representative effortlessly, and select the final loan offer with terms that suit you best.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Home_Loan.jpg" class="img-fluid rounded-top w-100" alt="">
                                <!-- <div class="service-icon p-3">
                                    <i class="fa-solid fa-house-chimney fa-2x"></i>
                                </div> -->
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Home Loan</a>
                                    <p class="mb-4">We understand you're seeking a new home, with low rates & a seamless process, we’re here to help you through this important financial decision.</p>
                                    <a class="btn btn-primary rounded-1 uppercase py-2 px-4" href="/home-loan" target="_blank">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Project_Loan.jpg" class="img-fluid rounded-top w-100" alt="">
                                <!-- <div class="service-icon p-3">
                                    <i class="fa-solid fa-building-shield fa-2x"></i>
                                </div> -->
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Project Loan</a>
                                    <p class="mb-4">We simplify construction financing with low rates and an easy online application, offering tailored loans that ensure a smooth and timely process.</p>
                                    <a class="btn btn-primary rounded-1 uppercase py-2 px-4" href="/project-loan" target="_blank">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <div class="service-img">
<<<<<<< HEAD
                                <img src="{{ asset('theme') }}/frontend/img/msme_loan_1.jpg" class="img-fluid rounded-top w-100" alt="">
=======
                                <img src="{{ asset('theme') }}/frontend/img/MSME_Loan.jpg" class="img-fluid rounded-top w-100" alt="">
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
                                <!-- <div class="service-icon p-3">
                                    <i class="fa-solid fa-business-time fa-2x"></i>
                                </div> -->s
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">MSME Loan</a>
                                    <p class="mb-4">This service meets the diverse needs of small and medium businesses. Whether you're expanding, investing in equipment, or increasing capital.</p>
                                    <a class="btn btn-primary rounded-1 uppercase py-2 px-4" href="/msme-loan" target="_blank">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('theme') }}/frontend/img/Loan_Against_Property.jpg" class="img-fluid rounded-top w-100" alt="">
                                <!-- <div class="service-icon p-3">
                                    <i class="fa-solid fa-house-laptop fa-2x"></i>
                                </div> -->
                            </div>
                            <div class="service-content p-4">
                                <div class="service-content-inner">
                                    <a href="#" class="d-inline-block h4 mb-4">Loan Against Property</a>
                                    <p class="mb-4">Jfinserv offers Loan Against Property with flexible repayment options, secured by your property. Check your eligibility and enjoy exclusive add-on and tax benefits.</p>
                                    <a class="btn btn-primary uppercase rounded-1 py-2 px-4" href="/loan-against-property">Know More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center wow fadeInUp mt-5" data-wow-delay="0.2s">
                        <a class="btn btn-dark uppercase rounded-1 py-3 px-5" href="/services" style="background-color:#295cab">More Services</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Testimonial Start -->
        <div class="container-fluid testimonial bg-light py-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary" style="color:#295cab">Testimonial</h4>
                    <h2 class="display-4 mb-4" style="color:#295cab">Hear from Our <strong style="color:#00abeb">Customers</strong></h2>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
                    <div class="testimonial-item bg-white rounded">
                        <div class="row g-0">
                            <div class="col-12 col-lg-12 col-xl-12">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Vishal Sarraf</h4>
                                    <p class="mb-3">Businessman</p>
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p class="mb-0">JFinserv made my home loan process stress-free and quick. Their expert team guided me at every step, ensuring minimal paperwork and a competitive interest rate. Highly recommended for anyone seeking financial assistance!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-white rounded">
                        <div class="row g-0">
                            <div class="col-12 col-lg-12 col-xl-12">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Dr. Neha Pawar</h4>
                                    <p class="mb-3">Doctor</p>
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                    <p class="mb-0">Thanks to JFinserv, I secured a project loan effortlessly. Their dedicated support and transparent process made a complex procedure seem simple. I appreciate their commitment to helping clients achieve their financial goals.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-white rounded">
                        <div class="row g-0">
                            <div class="col-12 col-lg-12 col-xl-12">
                                <div class="d-flex flex-column my-auto text-start p-4">
                                    <h4 class="text-dark mb-0">Rahul Sonawane</h4>
                                    <p class="mb-3">IT Professional</p>
                                    <div class="d-flex text-primary mb-3">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star text-body"></i>
                                    </div>
                                    <p class="mb-0">JFinserv exceeded my expectations with their quick approvals & low-interest rates. The team's professionalism & expertise gave me confidence throughout the loan process. I would highly recommend them!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
         
        <!-- Bank Partner Start -->
        <div class="container-fluid testimonial py-5">
            <div class="text-center mx-auto pb-3 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary"style="color:#295cab">Partnered Banks</h4>
                <h1 class="display-4 mb-4" style="color:#295cab">Our <strong style="color:#00abeb">Bank </strong>Network</h1>
                <!-- <p class="mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur adipisci facilis cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint dolorem autem obcaecati, ipsam mollitia hic.</p> -->
            </div>

            <div class="slider pb-5 mb-5">
                <div class="slide-track">
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/ab.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/ar.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/arks.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/bom.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/cbi.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/chola.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/hdb.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/ib.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/indian.png" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/kotak.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/pnb.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/rbl.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/sc.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/ujjivan.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/union.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/yb.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/boi.png" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('theme') }}/frontend/img/bnk_logos/uco.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Bank Partner End --> 
    </div>
@endsection