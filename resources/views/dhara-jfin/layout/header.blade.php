<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jfinserv | Financial Services in Pune | Lowest Loan Interest</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="{{ asset('theme/dhara-jfin/css/styles.css') }}">

    <!-- Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
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

    <a href="{{ route('authv3.login.form') }}" class="header-apply btn btn-primary">
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
    <a href="javascript:void(0)">
        <i class="fa-solid fa-caret-down"></i> Client
    </a>

    <ul class="sub-menu">

        {{-- IF USER IS LOGGED IN --}}
        @if(Session::has('role_id'))

            <li>
                <a href="/my-profile">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>

         <li>
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="dropdown-link logout-link">
            <i class="fas fa-sign-out-alt" style="margin-left:16px"></i>
            <span style="margin-left:16px;"> <b>Logout</b></span>
        </button>
    </form>
</li>


        {{-- IF USER IS NOT LOGGED IN --}}
        @else

            <li>
                <a href="{{ route('authv3.login.form') }}">
                    <i class="fa-solid fa-coins"></i> Finance
                </a>
            </li>

            <li>
                <a href="{{ route('property.login') }}">
                    <i class="fa-solid fa-building"></i> Property
                </a>
            </li>

        @endif

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
<script>
// document.getElementById('mobile-menu').addEventListener('click', function () {
//     document.querySelector('.nav-links').classList.toggle('active');
// });
// document.querySelectorAll('.dropdown > a').forEach(item => {
//     item.addEventListener('click', function (e) {
//         if (window.innerWidth <= 1024) {
//             e.preventDefault();
//             this.parentElement.classList.toggle('active');
//         }
//     });
// });
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
<style>.logout-form button {
    background: none;
    border: none;
    padding: 0;
    width: 100%;
    text-align: left;
    cursor: pointer;
}
.logout-link {
    width: 100%;
    text-align: left;
}

.logout-link:hover {
    background-color: #f3f4f6; /* same as dropdown hover */
}

</style>
