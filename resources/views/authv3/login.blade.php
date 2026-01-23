<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
/* ================= BASE ================= */
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
  background: #f8fafc;
}

/* ================= PAGE ================= */
.auth-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  margin-top:80px;
}

.auth-wrapper {
  display: grid;
  grid-template-columns: 1fr 1fr;
  max-width: 1200px;
  width: 100%;
  min-height: 90vh;
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 25px rgba(0,0,0,0.1);
}

/* ================= LEFT FORM ================= */
.auth-form-column {
  padding: 60px 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}

.auth-form-content {
  width: 100%;
  max-width: 420px;
}

.auth-logo-top {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 30px;
}

.logo-icon {
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg,#3B82F6,#2563EB);
  border-radius: 10px;
  color: #fff;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-text {
  font-size: 24px;
  font-weight: 700;
}

.auth-heading {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 24px;
}

.login-switch {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.login-switch label {
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
}

.form-field {
  margin-bottom: 18px;
}

.form-field label {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 6px;
  display: block;
}

.form-field input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 8px;
  border: 1px solid #d1d5db;
}

.form-field input:focus {
  outline: none;
  border-color: #3B82F6;
  box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
}

.btn-primary {
  width: 100%;
  padding: 14px;
  background: #3B82F6;
  border: none;
  border-radius: 8px;
  color: #fff;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
}

.btn-primary:hover {
  background: #2563EB;
}

.auth-divider {
  text-align: center;
  margin: 24px 0;
  color: #9ca3af;
  position: relative;
}

.auth-divider::before,
.auth-divider::after {
  content: "";
  position: absolute;
  top: 50%;
  width: 40%;
  height: 1px;
  background: #e5e7eb;
}

.auth-divider::before { left: 0; }
.auth-divider::after { right: 0; }

.auth-footer-link {
  margin-top: 20px;
  text-align: center;
  font-size: 14px;
}

/* ================= RIGHT PROMO ================= */
.auth-promo-column {
  background: linear-gradient(135deg,#1e40af,#3B82F6);
  padding: 60px 50px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.promo-text {
  color: #fff;
  max-width: 460px;
}

.promo-text h2 {
  font-size: 34px;
  font-weight: 700;
  margin-bottom: 20px;
}

.feature-item {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
}

.feature-item i {
  color: #10B981;
}
.auth-form-content {
  position: relative; /* IMPORTANT */
}

/* Back button */
.back-btn {
  position: fixed;
    left: 30px;
    top: 43px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg,#3B82F6,#2563EB); /* bootstrap primary */
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
    z-index: 2000;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;

}

.back-btn:hover {
  background-color: #1565c0;
  transform: translateX(-3px);
}


/* ===== GRAPH CARD ===== */
.analytics-card {
  background: #ffffff;
  border-radius: 16px;
  padding: 22px;
  margin-bottom: 40px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.18);
}

.analytics-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.analytics-header h3 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

.card-subtitle {
  font-size: 12px;
  color: #64748b;
}

.chart-value {
  font-size: 18px;
  font-weight: 700;
  color: #10B981;
}

.line-chart-premium {
  height: 180px;
}

.line-chart-premium svg {
  width: 100%;
  height: 100%;
}
.container {
    max-width: 1140px; /* More standard container width */
    margin: 0 auto;
    padding: 0 1.5rem;
}
header {
    background-color: #fff;;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    transition: all 0.6s ease-in-out;
    padding: 0;
    border-radius: 0;
}

header.scrolled {
    width: 90%;
    max-width: 1200px;
    top: 0px;
    left: 50%;
    
    transform: translateX(-50%);
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    padding: 0 1.5rem;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 66px;
    transition:  all 0.3s ease;
}

.cta-nav{
    display:flex;
    align-items: center;
    gap: 15px;
}
.cta-nav .header-apply{
    background: #1e4fd8;
    padding: 0.6rem 1.5rem;
    font-size: 0.9rem;
    white-space: nowrap;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 20px;
}


.logo img {
    height: 35px; /* Reduced from 50px */
    width: auto;
    display: block;
}

header.scrolled nav {
    height: 70px;
}

header.scrolled .logo img {
    height: 30px; /* Reduced from 40px */
}

.nav-links {
    display: flex;
    list-style: none;
}

.mobile-cta-item {
    display: none;
}

.nav-links li {
    margin-left: 2.5rem;
}


.nav-links a {
    text-decoration: none;
    color: #1a1a1a;
    font-weight: 500;
    transition: all 0.3s ease;
}

.nav-links a:hover {
    color: #3d71c7;
}

/* Needed for dropdown positioning */
.signin-dropdown {
    position: relative;
}

/* Hide dropdown initially */
.signin-menu {
    position: absolute;
    top: 120%;
    right: 0;
    background: #fff;
    min-width: 200px;
    flex-direction: column;
    padding: 10px 0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);

    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

/* Show on hover */
.signin-dropdown:hover .signin-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Reset nav-links flex inside dropdown */
.signin-menu.nav-links {
    display: block;
}

/* Nested menu */
.has-submenu {
    position: relative;
}

/* Second level */
.sub-menu {
    position: absolute;
    top: 100%;
    left: -8px;
    background: #f1f5f9;
    min-width: 250px;
    padding: 10px 0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

/* Show nested menu */
.has-submenu:hover .sub-menu {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
}
.sub-menu li {
    list-style: none;
}
.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #ffffff;
    min-width: 250px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    padding: 10px 0;
    margin-top: 10px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    list-style: none;

}

.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform:translateX(-50%) translateY(0);
}

.dropdown-menu li {
    padding: 0;
    margin-left:0.5rem;
}

.dropdown-menu li a {
    display: block;
    padding: 10px 20px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.dropdown-menu li a:hover {
    background-color: #f5f5f5;
    color: #007bff; /* Adjust to your primary color */
}


/* Mobile responsive - dropdown for mobile *

/* Buttons */
.btn-sign {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0.8rem 1.8rem;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: transition: all 0.3s ease;;
    border: none;
}

.btn-primary-sign {
    background-color:#1e4fd8 ;
    border:2px solid #fff;
    color: #fff;;
}
.btn-primary-hero-sign {
    background: #1e4fd8;
    color: #fff;;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.05rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.btn-primary-sign:hover {
    background-color: #3d71c7;
    transform: translateY(-2px);
}
.btn-sign-in{
    width:70px; 
    display: flex;
    align-items: center;
    justify-content: center;
    height: 20px;
    padding: 0.6rem 2rem;
    border-radius: 30px; /* Increased for rounded effect */
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    background: linear-gradient(to top, #ff0000, #a32727);
    backdrop-filter: blur(40px);
    color: #fff;;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-outline { 
    background: rgb(237 27 36);
    backdrop-filter: blur(40px);
    border: 2px solid #295cab;
    color: #fff;
    border: 2px solid rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
}

.btn-outline:hover {
    background-color: #295cab;
    color: #fff;;
}

/* ================= RESPONSIVE ================= */
@media screen and (max-width:1024px){
  .nav-links {
        display: none ;
    }
    
    .cta-nav {
        display: none;
    }
    
    /* Show mobile menu toggle */
    .menu-toggle {
        display: flex;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        z-index: 1001;
    }
    
    .menu-toggle span {
        display: block;
        width: 28px;
        height: 3px;
        background: #333;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(7px, 7px);
    }
    
    .menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }
    
    .menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }
    
    /* Mobile Menu Container */
    .mobile-menu {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: #fff;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
        padding-top: 70px;
        z-index: 999;
    }

    .mobile-menu.active {
        transform: translateX(0);
    }

    .menu-header {
        padding: 20px;
        background: linear-gradient(135deg, #1e5ef5 0%, #0d47a1 100%);
        color: #fff;
        margin-bottom: 10px;
    }

    .menu-header h3 {
        font-size: 16px;
        font-weight: 500;
        opacity: 0.9;
    }

    /* Mobile Menu CTA Buttons */
    .mobile-cta-item-new {
        padding: 10px 20px;
        border-bottom: none !important;
    }

    .mobile-apply-btn, .mobile-signin-btn {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center;
        gap: 10px;
        padding: 14px 20px !important;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        width: 100%;
        transition: all 0.3s ease;
    }

    /* Override any inherited icons/chevrons in these specific buttons */
    .mobile-apply-btn i, .mobile-signin-btn i {
        margin: 0;
        position: static;
    }

    .mobile-signin-btn .fa-chevron-right {
        margin-left: auto;
        position: absolute;
        right: 20px;
        transition: transform 0.3s ease;
    }

    .mobile-signin-btn.active .fa-chevron-right {
        transform: rotate(90deg);
    }

    .mobile-apply-btn {
        background: linear-gradient(135deg, #1e5ef5 0%, #0d47a1 100%);
        color: #fff !important;
    }

    .mobile-signin-btn {
        background: #dc3545;
        color: #fff !important;
    }

    .mobile-cta-item-new:last-of-type {
        margin-bottom: 10px;
        border-bottom: 1px solid #f0f0f0 !important;
    }

    .nav-menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .nav-menu > li {
        border-bottom: 1px solid #f0f0f0;
    }
    
    .nav-menu a {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: background 0.2s ease;
        justify-content: space-between;
    }
    
    .nav-menu a:active {
        background: #f5f5f5;
    }
    
    .nav-menu .fa-chevron-right {
        font-size: 12px;
        color: #999;
        transition: transform 0.3s ease;
    }
    
    .submenu {
        max-height: 0;
        overflow: hidden;
        background: #f8f9fa;
        transition: max-height 0.3s ease;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .submenu.active {
        max-height: 500px;
    }
    
    .submenu li {
        border-bottom: 1px solid #e9ecef;
    }
    
    .submenu li:last-child {
        border-bottom: none;
    }
    
    .submenu a {
        padding: 14px 20px 14px 40px;
        font-size: 14px;
        font-weight: 400;
    }
    
    .has-submenu > a.active .fa-chevron-right {
        transform: rotate(90deg);
    }
    
    .signin-submenu {
        background: #fff;
    }
    
    .signin-submenu a {
        padding-left: 40px;
    }
    
    .nested-submenu {
        background: #e9ecef;
    }
    
    .nested-submenu a {
        padding-left: 60px;
    }
}
@media screen and (min-width: 1025px) {
    .mobile-menu {
        display: none !important;
    }
    
    .menu-toggle {
        display: none !important;
    }
}
@media (max-wodth:1024px){
  .nav-links li {
        margin-left: 1.2rem;
    }
    .nav-links a {
        font-size: 0.9rem;
    }
    .cta-nav {
        gap: 10px;
    }
    .btn-sign-in {
        width: auto;
        padding: 0 1.2rem;
        font-size: 0.85rem;
    }
    .header-apply {
        padding: 0 1.2rem;
        font-size: 0.85rem;
    }
}
@media (max-width: 968px) {
  .auth-wrapper {
    grid-template-columns: 1fr;
  }
  .auth-promo-column {
    display: none;
  }
}
@media (max-width: 768px) {
  .nav-links {
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: 80px;
        left: 0;
        background-color: #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        padding: 1.5rem 0;
        z-index: 100;
        max-height: calc(100vh - 80px);
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .nav-links.active {
        display: flex;
    }

    .mobile-cta-item {
        display: block !important;
        margin: 0.5rem 2rem !important;
    }

    .mobile-cta-item .btn {
        width: auto;
        min-width: 150px;
        text-align: center;
        padding: 0.6rem 2rem;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .mobile-cta-item.dropdown .btn-sign-in {
        width: 150.82px;
        margin-top: 10px;
    }
    .mobile-cta-item.dropdown.active .dropdown-menu {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        position: static !important;
        transform: none !important;
        box-shadow: none !important;
        padding-left: 20px !important;
    }

    .mobile-cta-item.dropdown .dropdown-menu li {
        margin: 0.5rem 0 !important;
    }

    .has-submenu .sub-menu {
        position: static !important;
        opacity: 1 !important;
        visibility: visible !important;
        display: none;
        transform: none !important;
        box-shadow: none !important;
        padding-left: 20px !important;
        width: 100% !important;
    }

    .has-submenu.active > .sub-menu {
        display: block !important;
    }

    .nav-links li {
        margin: 1rem 2rem;
    }

    .menu-toggle {
        display: block;
    }
    .menu-toggle .bar {
        display: block;
        width: 25px;
        height: 3px;
        margin: 5px auto;
        background-color: #1a1a1a;
        transition: all 0.3s ease;
    }

    .cta-nav {
        display: none;
    }
    .dropdown-menu {
        position: static;
        box-shadow: none;
        opacity: 1;
        visibility: visible;
        transform: none;
        display: none;
        padding-left: 20px;
        min-width:auto;
        grid-template-columns: 1fr;
    }

     .dropdown:hover .dropdown-menu,
    .dropdown.active .dropdown-menu {
        display: grid;
    }

}
</style>

<script>
function toggleLogin(type){
  document.getElementById('emailBox').style.display = type === 'email' ? 'block' : 'none';
  document.getElementById('otpBox').style.display   = type === 'otp'   ? 'block' : 'none';
}
</script>

</head>
<body>

<header>
    <nav class="container">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('theme/dhara-jfin/img/logo.jpg') }}" alt="Jfinserv Logo">
            </a>
        </div>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/about') }}">About Us</a></li>
            <!-- <li><a href="{{ url('/services') }}">Services</a></li>
              -->
            <li class="dropdown">
                <a href="{{ url('/services') }}">Services</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/home-loan') }}">Home Loan</a></li>
                    <li><a href="{{ url('/loan-against-property') }}">Loan Against Property</a></li>
                    <li><a href="{{ url('/project-loan') }}">Project Loan</a></li>
                    <li><a href="{{ url('/overdraft-facility') }}">Overdraft Facility</a></li>
                    <li><a href="{{ url('/msme-loan') }}">MSME Loan</a></li>
                    <li><a href="{{ url('/lease-rental-discounting') }}">Lease Rental Discounting</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/eligibility-calculator') }}">Calculator</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
        </ul>

        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

            <div class="cta-nav">

    <a href="{{ route('authv3.login.form') }}" class="header-apply btn-sign btn-primary-sign">
        Apply Now
    </a>

    <!-- Sign In Dropdown -->
    <div class="dropdown signin-dropdown">
        <a href="javascript:void(0)" class="btn-sign-in">Sign In</a>

        <ul class="nav-links dropdown-menu signin-menu">
            <li class="has-submenu">
                <a href="{{ route('login') }}"><i class="fas fa-user-tie"></i> Employee</a>
            </li>
            <li class="has-submenu">
                <a href="{{ route('login') }}"><i class="fa-regular fa-handshake"></i> Channel Partner</a>
            </li>
            <li class="has-submenu">
                <a href="javascript:void(0)"><i class="fa-solid fa-caret-down"></i> Client</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('authv3.login.form') }}"><i class="fa-solid fa-coins"></i> Finance</a></li>
                    <li><a href="{{ route('property.login') }}"><i class="fa-solid fa-building"></i> Property</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>

            
            
        </div>
    </nav>
</header>
<div class="mobile-menu" id="mobileMenu">
    <div class="menu-header">
        <h3>Trust is our foundation. We guide clients</h3>
    </div>

    <ul class="nav-menu">
        <li class="mobile-cta-item-new">
            <a href="{{ route('authv3.login.form') }}" class="mobile-apply-btn">
                <i class="fas fa-file-alt"></i>
                Apply Now
            </a>
        </li>
        <li class="mobile-cta-item-new">
            <a href="javascript:void(0)" id="signInBtnNew" class="mobile-signin-btn">
                <i class="fas fa-sign-in-alt"></i>
                Sign In
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>

        <li class="has-submenu" id="signInMenu" style="display: none;">
            <ul class="submenu signin-submenu active">
                <li><a href="{{ route('login') }}">Employee</a></li>
                <li><a href="{{ route('login') }}">Channel Partner</a></li>
                <li class="has-submenu">
                    <a href="javascript:void(0)" id="clientToggle">
                        <span>Client</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <ul class="submenu nested-submenu" id="clientSubmenu">
                        <li><a href="{{ route('authv3.login.form') }}">Finance</a></li>
                        <li><a href="{{ route('property.login') }}">Property</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/about') }}">About Us</a></li>
        
        <li class="has-submenu">
            <a href="{{ url('/services') }}" id="servicesToggle">
                <span>Services</span>
                <i class="fas fa-chevron-right"></i>
            </a>
            <ul class="submenu" id="servicesSubmenu">
                <li><a href="{{ url('/home-loan') }}">Home Loan</a></li>
                <li><a href="{{ url('/loan-against-property') }}">Loan Against Property</a></li>
                <li><a href="{{ url('/project-loan') }}">Project Loan</a></li>
                <li><a href="{{ url('/overdraft-facility') }}">Overdraft Facility</a></li>
                <li><a href="{{ url('/msme-loan') }}">MSME Loan</a></li>
                <li><a href="{{ url('/lease-rental-discounting') }}">Lease Rental Discounting</a></li>
            </ul>
        </li>

        <li><a href="{{ url('/eligibility-calculator') }}">Calculator</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
    </ul>
</div>

<div class="auth-page">
<div class="auth-wrapper">

<!-- ================= LEFT FORM ================= -->
<div class="auth-form-column">
<div class="auth-form-content">


<div class="auth-logo-top">
  <div class="logo-icon">JF</div>
  <div class="logo-text">JFINSERV</div>
</div>

<h2 class="auth-heading">Welcome To Jfinmate</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

@if($errors->any())
<p style="color:red">{{ $errors->first() }}</p>
@endif

<div class="login-switch">
<label>
  <input type="radio" name="loginType" checked onclick="toggleLogin('email')">
  Email Login
</label>
<label>
  <input type="radio" name="loginType" onclick="toggleLogin('otp')">
  OTP Login
</label>
</div>

<!-- EMAIL LOGIN -->
<form method="POST" action="{{ route('authv3.login.email') }}" id="emailBox">
@csrf
<div class="form-field">
  <label>Email Address</label>
  <input type="email" name="email_id" required>
</div>

<div class="form-field">
  <label>Password</label>
  <input type="password" name="password" required>
</div>

<button class="btn-primary">Login</button>
</form>

<!-- OTP LOGIN -->
<form method="POST" action="{{ route('authv3.login.otp') }}" id="otpBox" style="display:none">
@csrf
<div class="form-field">
  <label>Mobile Number</label>
  <input type="text" name="mobile_no" maxlength="10" required>
</div>

<button class="btn-primary">Send OTP</button>
</form>

<div class="auth-footer-link">
New user?
<a href="{{ route('authv3.signup.form') }}">Create Account</a>
</div>

</div>
</div>

<!-- ================= RIGHT PROMO ================= -->
<div class="auth-promo-column">
  <div class="promo-content">

    <!-- ===== GRAPH CARD ===== -->
    <div class="analytics-card">
      <div class="analytics-header">
        <div>
          <h3>Portfolio Growth</h3>
          <p class="card-subtitle">Last 6 Months Performance</p>
        </div>
        <div class="chart-value">+28.5%</div>
      </div>

      <div class="line-chart-premium">
        <svg viewBox="0 0 300 180" preserveAspectRatio="none">
          <!-- GRID -->
          <line x1="0" y1="150" x2="300" y2="150" stroke="#e5e7eb"/>
          <line x1="0" y1="110" x2="300" y2="110" stroke="#e5e7eb"/>
          <line x1="0" y1="70" x2="300" y2="70" stroke="#e5e7eb"/>

          <!-- LINE -->
          <polyline
            fill="none"
            stroke="#3B82F6"
            stroke-width="4"
            points="10,140 60,120 110,100 160,75 210,55 260,35"
          />

          <!-- DOTS -->
          <circle cx="10" cy="140" r="4" fill="#3B82F6"/>
          <circle cx="60" cy="120" r="4" fill="#3B82F6"/>
          <circle cx="110" cy="100" r="4" fill="#3B82F6"/>
          <circle cx="160" cy="75" r="4" fill="#3B82F6"/>
          <circle cx="210" cy="55" r="4" fill="#3B82F6"/>
          <circle cx="260" cy="35" r="4" fill="#3B82F6"/>
        </svg>
      </div>
    </div>

    <!-- ===== PROMO TEXT ===== -->
    <div class="promo-text">
      <h2>Secure & Smart Financial Platform</h2>

      <div class="feature-item">
        <i class="fas fa-check-circle"></i> Fast OTP Login
      </div>
      <div class="feature-item">
        <i class="fas fa-check-circle"></i> Secure Authentication
      </div>
      <div class="feature-item">
        <i class="fas fa-check-circle"></i> Trusted Financial Services
      </div>
    </div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Only initialize mobile menu on mobile devices
    if (window.innerWidth <= 1024) {
        initializeMobileMenu();
    }
    
    // Reinitialize on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 1024) {
            initializeMobileMenu();
        }
    });
});

function initializeMobileMenu() {
    const menuToggle = document.getElementById('mobile-menu');
    const mobileMenu = document.getElementById('mobileMenu');
    const signInBtn = document.getElementById('signInBtnNew');
    const signInMenu = document.getElementById('signInMenu');
    const servicesToggle = document.getElementById('servicesToggle');
    const servicesSubmenu = document.getElementById('servicesSubmenu');
    const clientToggle = document.getElementById('clientToggle');
    const clientSubmenu = document.getElementById('clientSubmenu');

    // Return if elements don't exist
    if (!menuToggle || !mobileMenu) return;

    // Toggle mobile menu
    menuToggle.addEventListener('click', function() {
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        document.body.classList.toggle('menu-open');
        // Prevent body scroll when menu is open
        if (mobileMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });

    // Sign In button toggle
    if (signInBtn && signInMenu) {
        signInBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent event from bubbling up to mobileMenu click listener
            
            if (signInMenu.style.display === 'none' || signInMenu.style.display === '') {
                signInMenu.style.display = 'block';
                signInBtn.classList.add('active');
                signInBtn.querySelector('.fa-chevron-right').style.transform = 'rotate(90deg)';
            } else {
                signInMenu.style.display = 'none';
                signInBtn.classList.remove('active');
                signInBtn.querySelector('.fa-chevron-right').style.transform = 'rotate(0deg)';
                if (clientSubmenu) {
                    clientSubmenu.classList.remove('active');
                }
                if (clientToggle) {
                    clientToggle.classList.remove('active');
                }
            }
        });
    }

    // Services toggle
    if (servicesToggle && servicesSubmenu) {
        servicesToggle.addEventListener('click', function(e) {
            e.preventDefault();
            servicesSubmenu.classList.toggle('active');
            servicesToggle.classList.toggle('active');
        });
    }

    // Client toggle
    if (clientToggle && clientSubmenu) {
        clientToggle.addEventListener('click', function(e) {
            e.preventDefault();
            clientSubmenu.classList.toggle('active');
            clientToggle.classList.toggle('active');
        });
    }

    // Close menu when clicking on regular links
    mobileMenu.addEventListener('click', function(e) {
        // Only close if it's a link AND it's not the Sign In button AND not inside a submenu toggle
        if (e.target.tagName === 'A' && 
            e.target.id !== 'signInBtnNew' && 
            !e.target.closest('.has-submenu') &&
            !e.target.classList.contains('mobile-signin-btn')) {
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}
</script>
</body>
</html>
