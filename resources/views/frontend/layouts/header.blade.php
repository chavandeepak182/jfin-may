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
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>



        <!-- Cutomized Scripts and CSS -->
        <script src="@yield('scripts')"></script>
        <script src="@yield('scripts2')"></script>
        <link rel="stylesheet" href="{{ asset('theme') }}/frontend/prop/@yield('links')"/>
        <link rel="stylesheet" href="{{ asset('theme') }}/frontend/prop/@yield('links2')"/>
        <link rel="stylesheet" type="text/css" href="@yield('link')"/>

        <link rel="icon" type="image/png" href="{{ asset('theme') }}/frontend/img/favicon.png">
        <style>

</style>

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
<style>/* ================= NOTICE BAR ================= */
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

/* SCROLLING TEXT (DESKTOP) */
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
    margin-left: 240px; /* desktop spacing */
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

/* TEXT ANIMATION */
@keyframes scrollText {
    from { transform: translateX(100%); }
    to   { transform: translateX(-100%); }
}

/* ================= HEADER ================= */
.main-header {
    position: fixed;
    top: 44px; /* below notice bar */
    left: 0;
    width: 100%;
    height: 66px;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    z-index: 9999;
}

/* PUSH CONTENT */
body {
    padding-top: 110px; /* notice + header */
}

/* ================================================= */
/* ================= MOBILE VIEW =================== */
/* ================================================= */
@media (max-width: 991px) {

    /* NOTICE BAR */
    .notice-bar {
        position: relative;
        height: auto;
        padding: 8px 12px;
        flex-direction: column;
        text-align: center;
    }

    .notice-track {
        animation: none;          /* stop scrolling */
        white-space: normal;      /* allow wrap */
    }

    .notice-text {
        margin-left: 0 !important;
        padding-right: 0;
        font-size: 13px;
        line-height: 1.4;
    }

    .notice-btn {
        margin-top: 6px;
        font-size: 13px;
    }

    /* HEADER */
    .main-header {
        position: sticky;
        top: 0;
    }

    body {
        padding-top: 0;
    }
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






<header class="main-header">
    <div class="container">
        <div class="header-inner">

            <!-- LOGO -->
            <a href="/" class="logo">
                <img src="{{ asset('theme/frontend/img/icons/logo_jfinserv.jpg') }}" alt="JFINSERV">
            </a>

            <!-- MOBILE TOGGLE -->
            <div class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </div>

            <!-- NAV -->
          <nav class="main-nav">

    <ul class="nav-list">

        <li><a href="{{ url('about') }}">About Us</a></li>

         <li class="mega-dropdown">
                        <a href="javascript:void(0)" id="productsToggle">Products</a>

                        <div class="mega-menu" id="productsMenu">

                            <!-- LEFT -->
                            <div class="mega-left">
                                <a href="{{ url('home-loan') }}" class="mega-item">
                                    <i class="bi bi-house-door icon"></i>
                                    <div><h4>Home Loan</h4></div>
                                </a>

                                <a href="{{ url('loan-against-property') }}" class="mega-item">
                                    <i class="bi bi-building icon"></i>
                                    <div><h4>Loan Against Property</h4></div>
                                </a>

                                <a href="{{ url('project-loan') }}" class="mega-item">
                                    <i class="bi bi-diagram-3 icon"></i>
                                    <div><h4>Project Loan</h4></div>
                                </a>

                                <a href="{{ url('overdraft-facility') }}" class="mega-item">
                                    <i class="bi bi-credit-card-2-front icon"></i>
                                    <div><h4>Overdraft Facility</h4></div>
                                </a>

                                <a href="{{ url('lease-rental-discounting') }}" class="mega-item">
                                    <i class="bi bi-receipt icon"></i>
                                    <div><h4>Lease Rental Discounting</h4></div>
                                </a>

                                <a href="{{ url('msme-loan') }}" class="mega-item">
                                    <i class="bi bi-shop icon"></i>
                                    <div><h4>MSME Loan</h4></div>
                                </a>
                            </div>

                            <!-- RIGHT -->
                            <div class="mega-right">
                                <h3>Find the Right Loan</h3>
                                <p>Smart financial solutions for your needs.</p>
                                <a href="{{ url('/applyNow') }}" class="cta-primary">Apply Now</a>
                            </div>
                        </div>
                    </li>


        <li><a href="{{ route('eligibility.calculator') }}">Calculator</a></li>
        <li><a href="{{ url('services') }}">Services</a></li>
        <li><a href="{{ url('properties') }}">Properties</a></li>

        <li class="mega-dropdown calculator-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Resources</a>

                        <div class="mega-menu" style="width:320px;">
                            <div class="mega-left">
                                <a href="{{ route('blogs') }}" class="mega-item">
                                    <i class="bi bi-journal-text icon"></i>
                                    <div><h4>Blog</h4></div>
                                </a>

                                <a href="{{ url('referral-program') }}" class="mega-item">
                                    <i class="bi bi-graph-up-arrow icon"></i>
                                    <div><h4>Referral</h4></div>
                                </a>
                            </div>
                        </div>
                    </li>


      <!-- ✅ MOBILE ACTIONS (ONLY MOBILE VIEW) -->
<li class="mobile-actions">

    {{-- APPLY NOW --}}
    @if(Session::has('role_id'))
        <a href="{{ route('loans.loans-list') }}" class="btn-primary-cta">
            Apply Now
        </a>
    @else
        <a href="{{ route('applyNow') }}" class="btn-primary-cta">
            Apply Now
        </a>
    @endif

    {{-- USER DROPDOWN (MOBILE) --}}
    <div class="user-menu mobile-user-menu dropdown">

        <a href="javascript:void(0)"
           class="user-avatar dropdown-toggle"
           data-bs-toggle="dropdown">
            <i class="fas fa-user"></i>
        </a>

        <div class="dropdown-menu user-dropdown">

            {{-- FINANCE --}}
            @if(Session::has('role_id'))
                <a href="{{ route('loans.loans-list') }}" class="dropdown-link">
                    <i class="fas fa-wallet"></i>
                    <span>Finance</span>
                </a>
            @else
                <a href="{{ route('authv3.login.form') }}" class="dropdown-link">
                    <i class="fas fa-wallet"></i>
                    <span>Finance</span>
                </a>
            @endif

            {{-- PROPERTY --}}
            <a href="{{ route('property.login') }}" class="dropdown-link">
                <i class="fas fa-building"></i>
                <span>Property</span>
            </a>

            {{-- LOGGED IN OPTIONS --}}
            @if(Session::has('role_id'))
                <div class="dropdown-divider"></div>

                <a href="/my-profile" class="dropdown-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/logout" class="dropdown-link logout-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            @endif

        </div>
    </div>

</li>

    </ul>

</nav>


            <!-- DESKTOP ACTIONS -->
        <div class="header-actions d-flex align-items-center gap-3">

    {{-- APPLY NOW --}}
    @if(Session::has('role_id'))
        <a href="{{ route('loans.loans-list') }}" class="btn-primary-cta">
            Apply Now
        </a>
    @else
        <a href="{{ route('applyNow') }}" class="btn-primary-cta">
            Apply Now
        </a>
    @endif


    {{-- USER DROPDOWN --}}
    <div class="user-menu dropdown">
        <a href="#" class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fas fa-user"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-end user-dropdown">

            {{-- FINANCE --}}
            @if(Session::has('role_id'))
                {{-- logged in → loans list --}}
                <a href="{{ route('loans.loans-list') }}" class="dropdown-link">
                    <i class="fas fa-wallet"></i>
                    <span>Finance</span>
                </a>
            @else
                {{-- not logged in → finance signup/login --}}
                <a href="{{ route('authv3.login.form') }}" class="dropdown-link">
                    <i class="fas fa-wallet"></i>
                    <span>Finance</span>
                </a>
            @endif

            {{-- PROPERTY (same for all) --}}
            <a href="{{ route('property.login') }}" class="dropdown-link">
                <i class="fas fa-building"></i>
                <span>Property</span>
            </a>

            {{-- LOGGED IN OPTIONS --}}
            @if(Session::has('role_id'))
                <div class="dropdown-divider"></div>

                <a href="/my-profile" class="dropdown-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/logout" class="dropdown-link logout-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            @endif

        </div>
    </div>

</div>




        </div>


        </div>
    </div>
</header>

<style>

    .mobile-actions {
    display: none;
    padding: 15px;
    border-top: 1px solid #eee;
}

@media (max-width: 991px) {
    .mobile-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
}

    /* Desktop */
.mobile-actions {
    display: none;
}

/* Mobile only */
@media (max-width: 991px) {

    /* Hide desktop buttons */
    .header-actions {
        display: none !important;
    }
/* ================= MOBILE ACTIONS ================= */
.mobile-actions {
    display: none;
}

@media (max-width: 991px) {

    .mobile-actions {
        display: flex;
        flex-direction: column;
        gap: 14px;
        padding: 16px;
        border-top: 1px solid #eee;
        align-items: center;
    }

    .mobile-actions .btn-primary-cta {
        width: 100%;
        text-align: center;
    }

    .mobile-user-menu {
        width: 100%;
        text-align: center;
    }

    .mobile-user-menu .dropdown-menu {
        position: static !important;
        transform: none !important;
        width: 100%;
        margin-top: 10px;
        box-shadow: none;
        border: 1px solid #eee;
        border-radius: 8px;
    }
}

}

/* HEADER ACTIONS */
.header-actions {
    display: flex;
    align-items: center;
}

/* APPLY NOW BUTTON */
.btn-primary-cta {
    background: linear-gradient(135deg, #295cab, #1d4ed8);
    color: #fff;
    padding: 10px 22px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary-cta:hover {
    background: linear-gradient(135deg, #1e40af, #1d4ed8);
    transform: translateY(-1px);
    color: #fff;
}

/* USER ICON */
.user-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #295cab;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-avatar:hover {
    background: #e0e7ff;
}

/* DROPDOWN */
.user-dropdown {
    min-width: 220px;
    border-radius: 12px;
    padding: 8px 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: none;
}

/* DROPDOWN LINKS */
.dropdown-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 500;
    color: #334155;
    text-decoration: none;
    transition: all 0.25s ease;
}

.dropdown-link i {
    font-size: 15px;
    color: #295cab;
}

.dropdown-link:hover {
    background: #f1f5ff;
    color: #1e3a8a;
}

/* LOGOUT */
.logout-link {
    color: #dc2626;
}

.logout-link i {
    color: #dc2626;
}

.logout-link:hover {
    background: #fee2e2;
}

/* MOBILE */
@media (max-width: 576px) {
    .btn-primary-cta {
        padding: 8px 16px;
        font-size: 13px;
    }
}

    /* Wrapper to push icon slightly right */
.user-icon-wrapper {
    margin-left: 10px;
    display: flex;
    align-items: center;
}

/* Bigger user icon */
.user-icon {
    font-size: 45px;   /* 👈 icon size */
    color: #295cab;
    cursor: pointer;
    transition: 0.3s ease;
}

/* Hover effect */
.user-icon:hover {
    color: #295cab;
}

/* Ensure header right spacing */
.header-cta {
    margin-left: auto;
}


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



/* ================= MOBILE TOGGLE ================= */
.mobile-toggle {
    display: none; /* hidden on desktop */
}

/* ================= MOBILE VIEW ================= */
@media (max-width: 991px) {

    /* SHOW TOGGLE */
    .mobile-toggle {
        display: block !important;
        font-size: 26px;
        cursor: pointer;
        margin-left: auto;
        z-index: 99999;
    }

    /* HIDE DESKTOP ACTIONS */
    .header-actions {
        display: none !important;
    }

    /* MOBILE MENU */
    .main-nav ul {
        display: none;
        position: fixed;
        top: 110px; /* notice bar + header */
        left: 0;
        width: 100%;
        background: #fff;
        border-top: 1px solid #eee;
        z-index: 99998;
    }

    .main-nav ul.show {
        display: block;
    }

    .main-nav li {
        border-bottom: 1px solid #eee;
    }

    .main-nav a {
        padding: 14px 16px;
        display: block;
        font-size: 16px;
        line-height: normal;
    }

    /* MOBILE DROPDOWNS */
    .mega-menu {
        position: static !important;
        width: 100% !important;
        display: none;
        box-shadow: none;
        padding: 10px;
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;
    }

    .mega-menu.show {
        display: block;
    }

    .mega-left {
        grid-template-columns: 1fr;
    }

    .mega-right {
        width: 100%;
        margin-top: 10px;
        text-align: center;
    }
}
.mobile-actions {
    display: none;
}

.mobile-actions.show {
    display: flex;
    flex-direction: column;
    gap: 12px;
}




</style>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const productsToggle = document.getElementById("productsToggle");
    const productsMenu   = document.getElementById("productsMenu");

    if (!productsToggle || !productsMenu) return;

    productsToggle.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();

        productsMenu.classList.toggle("show");
    });

    /* Close when clicking outside */
    document.addEventListener("click", function (e) {
        if (!productsMenu.contains(e.target) && !productsToggle.contains(e.target)) {
            productsMenu.classList.remove("show");
        }
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const mobileToggle  = document.getElementById("mobileToggle");
    const navMenu       = document.querySelector(".main-nav ul");
    const mobileActions = document.querySelector(".mobile-actions");

    const productToggle = document.getElementById("productsToggle");
    const productMenu   = document.getElementById("productsMenu");

    const resourceToggle = document.querySelector(".calculator-dropdown .dropdown-toggle");
    const resourceMenu   = document.querySelector(".calculator-dropdown .mega-menu");

    /* SAFETY CHECK */
    if (!mobileToggle || !navMenu) return;

    /* MAIN MENU TOGGLE */
    mobileToggle.addEventListener("click", function (e) {
        e.stopPropagation();
        navMenu.classList.toggle("show");

        /* ✅ SHOW APPLY NOW + PROFILE IN MOBILE */
        if (mobileActions) {
            mobileActions.classList.toggle("show");
        }
    });

    /* PRODUCTS DROPDOWN */
    if (productToggle && productMenu) {
        productToggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            productMenu.classList.toggle("show");
        });
    }

    /* RESOURCES DROPDOWN */
    if (resourceToggle && resourceMenu) {
        resourceToggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            resourceMenu.classList.toggle("show");
        });
    }

    /* CLOSE ON OUTSIDE CLICK */
    document.addEventListener("click", function (e) {

        if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
            navMenu.classList.remove("show");

            if (mobileActions) {
                mobileActions.classList.remove("show");
            }
        }

        if (productMenu && !productMenu.contains(e.target)) {
            productMenu.classList.remove("show");
        }

        if (resourceMenu && !resourceMenu.contains(e.target)) {
            resourceMenu.classList.remove("show");
        }
    });

});
</script>








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
                                    <a class="btn-search btn btn-dark mt-3 px-md-5 ms-2" href="{{ url('/login-mobile') }}"> For Finance</a>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{ asset('theme') }}/frontend/img/housing.png" alt="Logo" class="w-50">
                                    <a class="btn-search btn btn-dark mt-3 px-md-5 ms-2" href="{{ url('/login-mobile') }}"> For Property</a>
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
        <!--End of Tawk.to Script-->
    </body>
    
</html>