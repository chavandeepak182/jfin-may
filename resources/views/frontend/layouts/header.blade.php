<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')" />
        <meta name="Keywords" content="@yield('keywords')">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{ asset('theme') }}/frontend/lib/animate/animate.min.css"/>
        <link href="{{ asset('theme') }}/frontend/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="{{ asset('theme') }}/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('theme') }}/frontend/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('theme') }}/frontend/css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



        <!-- Cutomized Scripts and CSS -->
        <script src="@yield('scripts')"></script>
        <script src="@yield('scripts2')"></script>
        <link rel="stylesheet" href="{{ asset('theme') }}/frontend/prop/@yield('links')"/>
        <link rel="stylesheet" href="{{ asset('theme') }}/frontend/prop/@yield('links2')"/>
        <link rel="stylesheet" type="text/css" href="@yield('link')"/>

        <link rel="icon" type="image/png" href="{{ asset('theme') }}/frontend/img/favicon.png">
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        
        <!-- Topbar Start -->
<style>/* ===== NOTICE BAR (RED BAR) ===== */
.notice-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 44px;
    background: linear-gradient(90deg, #295cab, #295cab);
    display: flex;
    align-items: center;
    overflow: hidden;
    z-index: 10000;
}

/* Moving text */
.notice-track {
    display: flex;
    align-items: center;
    white-space: nowrap;
    animation: scrollText 14s linear infinite;
}

.notice-text {
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    padding-right: 40px;
    margin-left: 241px;
}

.notice-btn {
    background: #ed1c25;
    color: #fff;
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 4px;
    text-decoration: none;
    white-space: nowrap;
}

.notice-btn:hover {
    color: #fff;
}

/* Animation */
@keyframes scrollText {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}

/* ===== MAIN HEADER ===== */
.main-header {
    position: fixed;
    top: 44px;              /* SAME as notice bar height */
    left: 0;
    width: 100%;
    height: 66px;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    z-index: 9999;
}

/* ===== PUSH PAGE CONTENT ===== */
body {
    padding-top: 110px;     /* 44px notice + 66px header */
}
</style>

<!-- Sticky Notice Bar -->
<div class="notice-bar">
    <div class="notice-content">
        <span class="notice-text">
            JFinserv Consultant Pvt. Ltd. is strengthening its services to serve you better with a renewed focus on financial excellence.
        </span>

        <a href="{{ url('contact')}}" class="notice-btn">
           Contact Us
        </a>
    </div>
</div>





        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <!-- <div class="container-fluid nav-bar px-0 px-lg-4 py-lg-0">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light"> 
                    <a href="{{ asset('') }}" class="navbar-brand p-0">
                        <img src="{{ asset('theme') }}/frontend/img/logo-white.svg" alt="Logo" class="w-100">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-0 mx-lg-auto">
                            <a href="{{ url('/') }}" class="nav-item {{ Request::is('/') ? 'active' : '' }}">HOME</a>
                            <a href="{{ url('about') }}" class="nav-item {{ Request::is('about') ? 'active' : '' }}">ABOUT</a>
                            <div class="nav-item dropdown">
                                <a href="{{ url('services') }}" class="nav-link nav-item">
                                    <span class="dropdown-toggle">SERVICES</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ url('home-loan') }}" class="dropdown-item {{ Request::is('home-loan') ? 'active' : '' }}">HOME LOAN</a>
                                    <a href="{{ url('loan-against-property')}}" class="dropdown-item {{ Request::is('loan-against-property') ? 'active' : '' }}">LOAN AGAINST PROPERTY</a>
                                    <a href="{{ url('project-loan')}}" class="dropdown-item {{ Request::is('project-loan') ? 'active' : '' }}">PROJECT LOAN</a>
                                    <a href="{{ url('overdraft-facility')}}" class="dropdown-item {{ Request::is('overdraft-facility') ? 'active' : '' }}">OVERDRAFT FACILITY</a>
                                    <a href="{{ url('lease-rental-discounting')}}" class="dropdown-item {{ Request::is('lease-rental-discounting') ? 'active' : '' }}">LEASE RENTAL DISCOUNTING</a>
                                    <a href="{{ url('msme-loan')}}" class="dropdown-item {{ Request::is('msme-loan') ? 'active' : '' }}">MSME LOAN</a>
                                </div>
                            </div>
                            <a href="{{ url('properties')}}" class="nav-item {{ Request::is('properties') ? 'active' : '' }}">PROPERTIES</a>
                            <a href="{{ url('referral-program')}}" class="nav-item {{ Request::is('referral-program') ? 'active' : '' }}">REFERRALS</a>
                           <a href="{{ route('blogs') }}" class="nav-item {{ Request::is('blogs') ? 'active' : '' }}">Blogs</a>
>



                            <div class="nav-btn px-3">
                                <a href="{{ url('contact')}}" class="btn btn-primary rounded-1 py-2 px-4 ms-3 flex-shrink-0 nav-item {{ Request::is('contact') ? 'active' : '' }}">CONTACT</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div> -->
<!-- ===== TOP BAR ===== -->

<!-- ===== HEADER ===== -->
<header class="main-header">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <a href="/" class="logo">
                <img src="{{ asset('theme/frontend/img/icons/logo_jfinserv.jpg') }}" alt="JFINSERV">
            </a>

            <!-- Navigation -->
            <nav class="main-nav">
                <ul>
<li><a href="{{ url('about') }}" class="nav-item {{ Request::is('about') ? 'active' : '' }}">About Us</a></li>
                    <!-- PRODUCTS -->
                    <li class="mega-dropdown">
                        <a href="javascript:void(0)" id="productsToggle">
                            Products 
                        </a>

                        <!-- MEGA MENU -->
                        <div class="mega-menu" id="productsMenu">

                            <!-- LEFT CONTENT -->
                            <div class="mega-left">

                                <a href="{{ url('home-loan') }}" class="mega-item">
                                    <i class="bi bi-house-door icon"></i>
                                    <div>
                                        <h4> Home Loan</h4>
                                        <!-- <p>Begin your home ownership journey with us.</p> -->
                                    </div>
                                </a>

                                <a href="{{ url('loan-against-property')}}" class="mega-item">
                                   <i class="bi bi-building icon"></i>
                                    <div>
                                        <h4>Loan Against Property</h4>
                                        <!-- <p>Leverage your property’s value for financial flexibility.</p> -->
                                    </div>
                                </a>

                                <a href="{{ url('project-loan')}}" class="mega-item">
                                   <i class="bi bi-diagram-3 icon"></i>

                                    <div>
                                        <h4>Project Loan</h4>
                                        <!-- <p>Amplify your home’s space with easy financing.</p> -->
                                    </div>
                                </a>

                                <a href="{{ url('overdraft-facility')}}" class="mega-item">
                                      <i class="bi bi-credit-card-2-front icon"></i>
                                    <div>
                                        <h4>Overdraft Facility</h4>
                                        <!-- <p>Reinvent your home’s ambience with ease.</p> -->
                                    </div>
                                </a>
                                 <a href="{{ url('lease-rental-discounting')}}" class="mega-item">
                                      <i class="bi bi-receipt icon"></i>
                                    <div>
                                        <h4>Lease Rental Discounting</h4>
                                        <!-- <p>Reinvent your home’s ambience with ease.</p> -->
                                    </div>
                                </a>
                                 <a href="{{ url('msme-loan')}}" class="mega-item">
                                       <i class="bi bi-shop icon"></i>
                                    <div>
                                        <h4>MSME Loan</h4>
                                        <!-- <p>Reinvent your home’s ambience with ease.</p> -->
                                    </div>
                                </a>
                                
                                

                            </div>

                            <!-- RIGHT BANNER -->
                            <div class="mega-right">
                                <h3 style="color:#fff">Find the Right Loan</h3>
                                <p>Smart financial solutions for your personal and business needs.</p>
                                <a href="{{ url('/applyNow') }}" class="cta-primary">Apply Now</a>

                            </div>

                        </div>
                    </li>
                    <!-- <li class="mega-dropdown calculator-dropdown">
    <a href="javascript:void(0)" class="dropdown-toggle">
        Calculators 
    </a>

    <div class="mega-menu">
        
        <div class="mega-left">
            <a href="{{ route('eligibility.calculator') }}" class="mega-item">
                <i class="bi bi-calculator icon"></i>
                <div>
                    <h4>EMI Calculator</h4>
                  
                </div>
            </a>

            <a href="{{ route('eligibility.calculator') }}" class="mega-item">
                <i class="bi bi-graph-up-arrow icon"></i>
                <div>
                    <h4>Eligibility Calculator</h4>
                   
                </div>
            </a>
        </div>

       
        <div class="mega-right">
            <h3 >Loan Calculators</h3>
            <p>Plan better before applying for a loan</p>
            <a href="#" class="cta-primary">Start Now</a>
        </div>
    </div>
</li> -->
<li>
    <a href="{{ route('eligibility.calculator') }}" class="nav-item">
        Calculator
    </a>
</li>


                    <!-- <li><a href="#">Calculator</a></li> -->
                     
                
                                    <li><a href="{{ url('services') }}" class="nav-item {{ Request::is('properties') ? 'active' : '' }}">Services</a></li>
                                </a>
                    <li><a href="{{ url('properties')}}" class="nav-item {{ Request::is('properties') ? 'active' : '' }}">Properties</a></li>
                    
                    <li class="mega-dropdown calculator-dropdown">
    <a href="javascript:void(0)" class="dropdown-toggle">
        Resources 
    </a>

    <div class="mega-menu" style=" width: 320px;">
        <!-- LEFT -->
        <div class="mega-left">
            <a href="{{ route('blogs') }}" class="mega-item">
                <i class="bi bi-calculator icon"></i>
                <div>
                    <h4>Blog</h4>
                    <!-- <p>Calculate monthly EMI easily</p> -->
                </div>
            </a>

            <a href="{{ url('referral-program')}}" class="mega-item">
                <i class="bi bi-graph-up-arrow icon"></i>
                <div>
                    <h4>Referral</h4>
                    <!-- <p>Check loan eligibility</p> -->
                </div>
            </a>
        </div>

      
        
    </div>
</li>
                  

                </ul>
            </nav>

            <div class="header-cta">
                <a href="{{ url('/applyNow') }}" class="btn-apply">Apply Now</a>
            </div>

        </div>
    </div>
</header>
<style>

.cta-primary {
    display: inline-block;
    background:#295cab;        /* professional blue */
    color: #fff;
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 15px
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

/* .cta-primary:hover {
    background: #153cb5;
    color: #ffffff;
    box-shadow: 0 6px 16px rgba(29, 78, 216, 0.35);
    transform: translateY(-2px);
} */

.header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
}

.logo img {
    height: 40px;
}

.main-nav ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.main-nav li {
    position: relative;
}

.main-nav a {
    padding: 0 18px;
    line-height: 80px;
    font-weight: 500;
    color: #000;
    text-decoration: none;
    font-size: 18px;
}

/* MEGA MENU */
.mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    width: 900px;
    background: #fff;
    display: none;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

.mega-menu.show {
    display: flex;
}

/* LEFT */
.mega-left {
    /* width: 40%; */
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.mega-item {
    display: flex;
    gap: 14px;
    padding: 14px;
    border-radius: 10px;
    text-decoration: none;
    border: 1px solid #eee;
    transition: 0.3s;
    height: 92px;
    
}

.mega-item:hover {
    background: #f4f7ff;
    border-color:#295cab;
}

.mega-item h4 {
    margin: 0;
    font-size: 15px;
    color: #000;
    margin-left: 19px;
    margin-top: 30px;
}

.mega-item p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #000;
}

.icon {
    font-size: 26px;
}

/* RIGHT */
.mega-right {
    width: 40%;
    background: #f5f7fb;
    padding: 30px;
    border-radius: 12px;
}

.mega-right h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

.apply-btn,
.btn-apply {
    display: inline-block;
    background: #295cab;
    color: #fff;
    padding: 10px 22px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
}


.apply-btn,
.btn-apply:hover {
    color: #fff;
}

/* ===== MEGA DROPDOWN BASE ===== */
.mega-dropdown {
    position: relative;
    list-style: none;
}

.mega-dropdown > a {
    display: flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
}

/* ===== MEGA MENU ===== */
.mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    width: 600px;
    background: #fff;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    border-radius: 12px;
    display: flex;
    padding: 25px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px);
    transition: all 0.3s ease;
    z-index: 999;
}

/* SHOW MENU */
.mega-dropdown:hover .mega-menu,
.mega-dropdown.active .mega-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* LEFT SIDE */
.mega-left {
    width: 65%;
}

.mega-item {
    display: flex;
    gap: 15px;
    padding: 14px;
    border-radius: 10px;
    text-decoration: none;
    color: #333;
    transition: 0.3s;
}

.mega-item:hover {
    background: #f4f7ff;
}

.mega-item i {
    font-size: 22px;
    color: #295cab;
}

.mega-item h4 {
    margin: 0;
    font-size: 18px;
    margin-top: 25px;
}

.mega-item p {
    margin: 2px 0 0;
    font-size: 13px;
    color: #777;
}

/* RIGHT SIDE */
.mega-right {
    width: 35%;
    background: #295cab;
    color: #fff;
    padding: 25px;
    border-radius: 10px;
}

.mega-right h3 {
    margin-top: 0;
}

.cta-primary {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background: #fff;
    /* color: #2f5bea; */
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
}

/* sticky */



/* MOBILE */
@media (max-width: 991px) {
    .mega-menu {
        position: static;
        width: 100%;
        flex-direction: column;
        transform: none;
        box-shadow: none;
        padding: 15px;
    }

    .mega-right {
        width: 100%;
        margin-top: 15px;
    }
}

</style>
<script>
const toggle = document.getElementById("productsToggle");
const menu = document.getElementById("productsMenu");

toggle.addEventListener("click", function (e) {
    e.stopPropagation();
    menu.classList.toggle("show");
});

document.addEventListener("click", function (e) {
    if (!menu.contains(e.target) && !toggle.contains(e.target)) {
        menu.classList.remove("show");
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector(".calculator-dropdown");
    const toggle = dropdown.querySelector(".dropdown-toggle");

    toggle.addEventListener("click", function (e) {
        e.preventDefault();
        dropdown.classList.toggle("active");
    });

    // Close when clicking outside
    document.addEventListener("click", function (e) {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove("active");
        }
    });
});
</script>






        <!-- Navbar & Hero End -->

        <!-- dempo -->
<!-- <header>
    <div class="header-container">
        <div class="logo">
    <a href="{{ url('/') }}">
    <img src="{{ asset('theme/frontend/img/icons/logo_jfinserv.jpg') }}" alt="JFINSERV Logo" style="height:39px;margin-left:-64px">

</a>

</div>

        <div class="menu-toggle" id="menuToggle">
            <i class="fa-solid fa-bars"></i>
        </div>

        <nav id="navMenu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Loans</a></li>
                <li><a href="#">Investments</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <a href="#" class="cta-btn">Apply Now</a>
    </div>
</header>

<script>
const menuToggle = document.getElementById("menuToggle");
const navMenu = document.getElementById("navMenu");

menuToggle.addEventListener("click", ()=>{
    navMenu.classList.toggle("active");
});
</script> -->
        <!-- Modal Search Start -->
        <!-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #000;">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Enquire Now</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center" style="background-color: #000;">
                        <div class="input-group w-100 mx-auto d-flex">
                            
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
                                            <input type="email" class="form-control border-0" id="email" name="email" value="{{ old('email') }}" placeholder="Your Email" required>
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Phone" required>
                                            <label for="contact">Your Phone</label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="amount" name="amount"  value="{{ old('amount') }}" placeholder="Amount" required>
                                            <label for="amount">Amount</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control border-0" id="message" name="message" placeholder="Leave a message here" style="height: 120px" required>{{ old('message') }}</textarea>
                                            <label for="message">Message</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-light w-50 py-2" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        

        <!-- Enquiry Modal -->
<div class="modal fade enquiry-modal" id="searchModal" tabindex="-1">
   <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">

        <div class="modal-content enquiry-ui">

            <div class="enquiry-title">
                <h2 style="color:#295cab;font-size:35px"><strong>Connect With Us</strong></h2>
                <button type="button" class="close-btn" data-bs-dismiss="modal">&times;</button>
            </div>

            <div class="enquiry-body">
                <form action="{{ route('enquiry.store') }}" method="POST">
                    @csrf

                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Full Name" class="ui-input" required>

                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="Email ID" class="ui-input" required>

                    <input type="text" name="contact" value="{{ old('contact') }}"
                           placeholder="Phone Number" class="ui-input" required>

                    <input type="text" name="amount" value="{{ old('amount') }}"
                           placeholder="Required Amount" class="ui-input" required>

                    <input type="text" name="address" value="{{ old('address') }}"
                           placeholder="Address" class="ui-input" required>

                    <textarea name="message" placeholder="Your Message"
                              class="ui-input ui-textarea" required>{{ old('message') }}</textarea>

                    <button type="submit" class="ui-submit">
                        Submit Details
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>
<style>.enquiry-ui {
    border-radius: 16px;
    padding: 25px;
    background: #ffffff;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    border: none;
}

/* Fix modal height cutting issue */
.enquiry-modal .modal-dialog {
    max-height: 95vh;
}

.enquiry-modal .modal-content {
       overflow: hidden;
    height: 500px;
    margin-top: 42px;
    width: 531px;
    margin-left: 128px;
    /* margin-bottom:200px; */
}

.enquiry-modal .enquiry-body {
    max-height: calc(95vh - 120px);
    overflow-y: auto;
    padding-right: 10px;
}

/* Smooth scrollbar */
.enquiry-modal .enquiry-body::-webkit-scrollbar {
    width: 6px;
}

.enquiry-modal .enquiry-body::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}


/* Title */
.enquiry-title {
    text-align: center;
    position: relative;
    margin-bottom: 25px;
}

.enquiry-title h2 {
    font-size: 26px;
    font-weight: 700;
    color: #1c1c1c;
}

.close-btn {
    position: absolute;
    right: 0;
    top: 0;
    background: transparent;
    border: none;
    font-size: 26px;
    cursor: pointer;
}

/* Body */
.enquiry-body {
    padding: 0 10px;
}

/* Inputs */
.ui-input {
    width: 100%;
    padding: 14px 16px;
    margin-bottom: 16px;
    border-radius: 10px;
    border: none;
    background: #f5f5f5;
    font-size: 15px;
    outline: none;
    box-shadow: inset 0 0 0 1px #e6e6e6;
}

.ui-input::placeholder {
    color: #666;
}

/* Textarea */
.ui-textarea {
    height: 110px;
    resize: none;
}

/* Button */
.ui-submit {
    width: 100%;
    background: #3c3c3c;
    color: #fff;
    padding: 14px;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.ui-submit:hover {
    background: #2a2a2a;
}
</style>
        <!-- Login Modal Start -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0 pb-5">
                    <div class="modal-header">
                        <h4 class="modal-title" id="loginModal">LOGIN</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-100 mx-auto d-flex">
                            <div class="row text-center pt-3">
                                <div class="col-lg-6 border-end">
                                    <img src="{{ asset('theme') }}/frontend/img/loan.png" alt="Logo" class="w-50">
                                    <a class="btn-search btn btn-dark mt-3 px-md-5 ms-2" href="{{ url('/login') }}"> For Finance</a>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{ asset('theme') }}/frontend/img/housing.png" alt="Logo" class="w-50">
                                    <a class="btn-search btn btn-dark mt-3 px-md-5 ms-2" href="{{ url('/login') }}"> For Property</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- main content --}}
            <div class="main-content">
                @yield('content')
            </div>
        {{-- end main content --}}

        @include('frontend.layouts.footer') 
        
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/674454c34304e3196ae835c0/1idhem7ek';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
    
</html>