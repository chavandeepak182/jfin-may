{{-- resources/views/dhara-jfin/index.blade.php --}}
 

@include('dhara-jfin.layout.header')

<main>
        <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fc;
            color: #1a1a2e;
            line-height: 1.6;
        } */

        /* Header
        header {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: #4c5fd7;
        }

        .logo span {
            color: #1a1a2e;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #4c5fd7;
        } */

            /* LOCALITIES SECTION ENHANCED */

.locality-card {
    background: linear-gradient(135deg, #ffffff, #f8f9ff);
    border-radius: 18px;
    padding: 1.8rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    transition: all 0.35s ease;
    position: relative;
    overflow: hidden;
}

/* Hover Glow Effect */
.locality-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(76,95,215,0.2), transparent);
    transition: 0.6s;
}

.locality-card:hover::before {
    left: 100%;
}

.locality-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(76, 95, 215, 0.18);
}

/* LOCALITIES SECTION ENHANCED */

.locality-card {
    background: linear-gradient(135deg, #ffffff, #f8f9ff);
    border-radius: 18px;
    padding: 1.8rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    transition: all 0.35s ease;
    position: relative;
    overflow: hidden;
}

/* Hover Glow Effect */
.locality-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(76,95,215,0.2), transparent);
    transition: 0.6s;
}

.locality-card:hover::before {
    left: 100%;
}

.locality-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(76, 95, 215, 0.18);
}
.mini-property {
    display: block;
    background: #fff;
    border-radius: 12px;
    padding: 10px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.mini-property:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.12);
}
.mini-property img {
    border-radius: 8px;
    transition: transform 0.4s ease;
}

.mini-property:hover img {
    transform: scale(1.08);
}
.mini-name {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1a1a2e;
}

.mini-developer {
    color: #4c5fd7;
    font-size: 0.85rem;
}

.mini-location {
    font-size: 0.8rem;
    color: #888;
}

        .apply-btn {
            background: #4c5fd7;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .apply-btn:hover {
            background: #3d4ec7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 95, 215, 0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin: 4rem 0 3rem;
        }
        .extra-property {
    display: none;
}

        .section-header h2 {
            font-size: 2.5rem;
            color: #295cab;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .section-header p {
            color: #295cab;
            font-size: 1.1rem;
        }

        /* Properties by Localities */
        .localities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .locality-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s;
            text-align:center;
        }

        .locality-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(76, 95, 215, 0.12);
        }
        .localty-title{
        font-size: 1.6rem;
            color: #1a1a2e;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        .properties-mini-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .mini-property {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .mini-developer {
            font-size: 0.9rem;
            color: #4c5fd7;
            font-weight: 600;
            height: 1.2em;
            
        }

        .mini-property img {
            width: 100%;
            aspect-ratio: 16/10;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .mini-name {
            font-size: 0.95rem;
            color: #4a5568;
            font-weight: 500;
            line-height: 1.3;
            height: 2.6em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .mini-location {
            font-size: 0.85rem;
            color: #9ca3af;
        }

        /* Enhanced Property Cards */
.properties-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2.5rem;
}

@media (max-width: 992px) {
    .properties-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .properties-grid {
        grid-template-columns: 1fr;
    }
}

        .property-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .property-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 60px rgba(76, 95, 215, 0.2);
        }

        .property-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 260px;
        }
.featured-extra {
    display: none;
}
        .property-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .property-card:hover .property-image-wrapper img {
            transform: scale(1.1);
        }

        .property-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(76, 95, 215, 0.95);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            z-index: 2;
        }

        .featured-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .property-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
            padding: 2rem 1.5rem 1rem;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .property-card:hover .property-overlay {
            opacity: 1;
        }

        .quick-stats {
            display: flex;
            gap: 1rem;
            color: white;
            font-size: 0.9rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .property-details {
            padding: 1.75rem;
        }

        .property-title {
            font-size: 1.35rem;
            color: #1a1a2e;
            margin-bottom: 0.75rem;
            font-weight: 700;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .property-developer {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .property-location {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .property-specs {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fc;
            border-radius: 12px;
        }

        .spec-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .spec-label {
            font-size: 0.8rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .spec-value {
            font-size: 1rem;
            color: #1a1a2e;
            font-weight: 600;
        }

        .property-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.25rem;
            border-top: 2px solid #f1f3f9;
        }

        .property-price {
            font-size: 1.75rem;
            color: #4c5fd7;
            font-weight: 700;
        }

        .contact-btn {
            background: linear-gradient(135deg, #4c5fd7 0%, #667eea 100%);
            color: white;
            padding: 0.875rem 1.75rem;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .contact-btn:hover {
            transform: translateX(4px);
            box-shadow: 0 8px 20px rgba(76, 95, 215, 0.3);
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(76, 95, 215, 0.12);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }

        .feature-card h3 {
            color: #1a1a2e;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.7;
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .service-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(76, 95, 215, 0.15);
        }

        .service-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service-content {
            padding: 2rem;
        }

        .service-content h3 {
            color: #4c5fd7;
            margin-bottom: 1rem;
            font-size: 1.35rem;
        }

        .service-content p {
            color: #6b7280;
            line-height: 1.8;
        }

        /* Testimonials */
        .testimonials {
            background: white;
            padding: 4rem 2rem;
            border-radius: 24px;
            margin: 4rem 0;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .testimonial-card {
            background: #f8f9fc;
            padding: 2rem;
            border-radius: 16px;
            border-left: 4px solid #4c5fd7;
        }

        .testimonial-stars {
            color: #fbbf24;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            margin-top: 1.5rem;
            font-weight: 600;
            color: #1a1a2e;
        }

        .testimonial-role {
            color: #9ca3af;
            font-size: 0.9rem;
        }
        /* Search and Filter Section */
        .search-filter-section {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 3rem;
            margin-top:2rem;
        }

        .search-bar-wrapper {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-input-group {
            flex: 1;
            position: relative;
        }

        .search-input-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #f1f3f9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .search-input-group input:focus {
            border-color: #4c5fd7;
            outline: none;
            box-shadow: 0 0 0 4px rgba(76, 95, 215, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .main-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            min-width: 200px;
        }

        .filter-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 2px solid #f1f3f9;
            border-radius: 10px;
            background: white;
            color: #1a1a2e;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-select:hover {
            border-color: #cbd5e0;
        }

        .expand-filters-btn {
            background: #f8f9fc;
            color: #4c5fd7;
            border: none;
            margin-top:1.8rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .expand-filters-btn:hover {
            background: #eef2ff;
        }

        .advanced-filters {
            display: none;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f3f9;
        }

        .advanced-filters.active {
            display: grid;
        }

        .filter-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .filter-chip {
            padding: 0.5rem 1rem;
            background: #f1f3f9;
            border-radius: 20px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
            user-select: none;
        }

        .filter-chip.active {
            background: #4c5fd7;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .section-header h2 {
                font-size: 2rem;
            }

         

            .property-specs {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .property-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .property-card:nth-child(1) { animation-delay: 0.1s; }
        .property-card:nth-child(2) { animation-delay: 0.2s; }
        .property-card:nth-child(3) { animation-delay: 0.3s; }
        .property-card:nth-child(4) { animation-delay: 0.4s; }
        
    </style>
          <style>
/* HERO SEARCH BOX DESIGN */

.hero-search-wrapper {
    margin-top: -60px;
    position: relative;
    z-index: 5;
}

.hero-search-box {
    background: linear-gradient(135deg, #8fb0e8, #7aa0dd);
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.hero-search-top {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.hero-search-top input {
    flex: 1;
    padding: 12px 15px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
}

.hero-search-top button {
    background: #4c5fd7;
    color: white;
    border: none;
    padding: 0 25px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.hero-search-top button:hover {
    background: #3649c5;
}

.hero-search-filters {
    display: flex;
    gap: 15px;
}

.hero-search-filters select {
    flex: 1;
    padding: 10px 12px;
    border-radius: 6px;
    border: none;
    font-size: 13px;
}

@media (max-width:768px){
    .hero-search-top,
    .hero-search-filters{
        flex-direction: column;
    }
}
</style>

    {{-- HERO SECTION --}}
    <section id="home" class="hero">
        <div class="hero-slider">
            <div class="slide" style="background-image:  url('{{asset('theme/dhara-jfin/img/loan_banner_new.jpg')}}')">
                <div class="container-tab hero-content">
                    <div class="hero-intro">WELCOME TO JFINSERV</div>
                    <h1>Fastest,Secure and <span style="color:#295cab">Easy Loan Process</span></h1>
                    <p>Experience fast,secure loans with competitive rates and personalized support in Pune.Enjoy seamless service and exceptional rewards.</p>

                    <div class="hero-btns">
                        <a href="{{ route('authv3.login.form') }}" class="btn btn-primary-hero">Apply Now</a>
                        <a href="{{ route('authv3.login.form') }}" class="btn btn-outline">Login Now</a>
                    </div>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{asset('theme/dhara-jfin/img/reward_banner.jpg')}}'); background-position:right 10% top 5%;" >
                <div class="container-tab hero-content">
                    <div class="hero-intro">TRUSTED FINANCIAL PARTNERS</div>
                    <h1>Unique Reward & <span style="color:#295cab">Earning Opportunity</span></h1>
                    <p>We offer a unique earning opportunity through our referral program, rewarding both your referrals and those made by your friends.</p>

                    <div class="hero-btns">
                        <a href="{{ route('authv3.login.form') }}" class="btn btn-primary-hero">Apply Now</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline">Login Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="slider-nav">
            <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
            <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    {{-- FEATURES --}}
    
<!-- Feature section -->
    <section class="finserv-wrapper">
    <div class="financial-services">

        <!-- Background Decorations -->
        <div class="bg-decoration bg-1"></div>
        <div class="bg-decoration bg-2"></div>

        <!-- Section Title -->
          <div class="finserv-header fade-up">
                    <h4 class="finserv-eyebrow">Our Features</h4>
                    <h1 class="finserv-trusted" style="color:#295cab;">Trusted <strong style="color:#00abeb">Financial</strong> Consultants</h1>
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
                    <a href="{{ url('/about') }}" class="service-btn">Learn More</a>
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
                    <a href="{{ url('/about') }}" class="service-btn">Learn More</a>
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
                    <a href="{{ url('/about') }}" class="service-btn">Learn More</a>
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
                    <a href="{{ url('/about') }}" class="service-btn">Learn More</a>
                </div>
            </div>

        </div>
    </div>
</section>
    

    {{-- VIDEO SECTION --}}
    <section class="video-section">
        <div class="video-container">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('theme/dhara-jfin/videos/video_new.mp4') }}" type="video/mp4">
                <source src="https://vjs.zencdn.net/v/oceans.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="video-overlay"></div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="about">
        <div class="container-tab flex">
            <div class="about-text">
                <h2 class="finserv-trusted" style="color:#295cab;">Your <strong style="color:#00abeb">Trusted</strong> Financial Partner</h2>
                <p>At Jfinserv, we believe that transparency and trust are the pillars of a successful financial relationship.</p>
                <p>Whether you're looking for personal growth or business expansion, our expert team is here to guide you every step of the way.</p>
                <a href="{{ url('/about') }}" class="btn btn-primary-hero">Our Story</a>
            </div>

            <div class="about-image">
                <img src="{{asset('theme/dhara-jfin/img/f_partner.png')}}" alt="Financial Planning">
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
                @php
$services = [
    [
        'title' => 'Home Loan',
        'desc' => 'We understand you are seeking a new home, with low rates & a seamless process, we are here to help you through this important financial decision.',
        'link' => 'home-loan',
        'img'  => 'theme/dhara-jfin/img/home_loan.jpg'
    ],
    [
        'title' => 'Project Loan',
        'desc' => 'JFinserv offers Loans Against Property with flexible repayment options and exclusive tax benefits. Check your eligibility today.',
        'link' => 'project-loan',
        'img'  => 'theme/dhara-jfin/img/project_loan.jpg'
    ],
    [
        'title' => 'MSME Loan',
        'desc' => '
We simplify construction financing with low rates and an easy online application, offering tailored loans that ensure a smooth and timely process.',
        'link' => 'msme-loan',
        'img'  => 'theme/dhara-jfin/img/msme_loan.jpg'
    ],
    [
        'title' => 'Loan Against Property',
        'desc' => 'JFinserv offers Loans Against Property with flexible repayment options and exclusive tax benefits. Check your eligibility today.',
        'link' => 'loan-against-property',
        'img'  => 'theme/dhara-jfin/img/loan_against_property.jpg'
    ],
    [
        'title' => 'Overdraft Facility',
        'desc' => 'An overdraft facility allows you to withdraw funds beyond your account balance, up to a predetermined limit.',
        'link' => 'overdraft-facility',
        'img'  => 'theme/dhara-jfin/img/overdraft_loan.jpg'
    ],
    [
        'title' => 'Lease Rental Discounting',
        'desc' => 'Lease Rental Discounting (LRD) allows property owners to obtain loans by using future rental income as collateral.',
        'link' => 'lease-rental-discounting',
        'img'  => 'theme/dhara-jfin/img/lrd_loan.jpg'
    ],
];
@endphp

    {{-- SERVICES --}}
<section id="dharaservices" class="services">
    <div class="container-tab">

        <div class="section-header text-center">
            <h2 class="finserv-trusted" style="color:#295cab;">Our Loan <strong style="color:#00abeb">Products</strong></h2>
            <p>Comprehensive financial solutions tailored to your needs</p>
        </div>

        <div class="services-row">
            @foreach(array_slice($services, 0, 4) as $service)
            <a href="{{ $service['link'] }}" class="service-link">
                <div class="service-item">
                    <div class="service-img">
                        <img src="{{ $service['img'] }}?auto=format&fit=crop&w=600&q=80"
                             alt="{{ $service['title'] }}">
                    </div>

                    <div class="service-content">
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ Str::limit($service['desc'], 110) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- SINGLE CTA --}}
        <div class="services-cta text-center">
            <a href="{{ url('/services') }}" class="btn btn-primary-hero">
                View All Services
            </a>
        </div>

    </div>
</section>


<!-- properrty -->
     <!-- All Properties -->
<section class="container">

    <div class="section-header">
        <h2>All Properties</h2>
        <p>Explore prime properties based on your accommodation</p>
    </div>

    {{-- ✅ CHECK IF DATA EXISTS --}}
    @if(count($data['allProperties']) > 0)

    <div class="properties-grid">

        @foreach($data['allProperties'] as $index => $v)

            @php
                $img = $v->image ? env('baseURL') . '/' . $v->image : asset('default.jpg');
                $title = $v->title;
                $category = $v->category_name ?? 'Available';
                $builder = $v->builder_name;
                $location = ($v->localities ?? '') . ', ' . ($v->city ?? '');
                $bhk = $v->select_bhk;
                $area = $v->area;

                // ✅ PRICE FIX (DYNAMIC RANGE)
                if (!empty($v->from_price) && !empty($v->to_price)) {
                    $price = "" . formatPrice($v->from_price) . " - " . formatPrice($v->to_price);
                } else {
                    $price = "Price on Request";
                }
            @endphp

            {{-- ❌ REMOVE HIDE WHEN FILTER ACTIVE --}}
            <div class="property-card property-item {{ (!request()->hasAny(['search','bhk','budget','type']) && $index >= 3) ? 'extra-property' : '' }}">

                <!-- Image -->
                <div class="property-image-wrapper">
                    <img src="{{ $img }}" alt="{{ $title }}" loading="lazy">

                    <div class="property-badge">
                        {{ $category }}
                    </div>

                    <div class="property-overlay">
                        <div class="quick-stats">
                            <div class="stat-item">🏠 {{ $bhk }} BHK</div>
                            <div class="stat-item">📐 {{ $area }} Sq. Ft.</div>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="property-details">

                    <h3 class="property-title">
                        {{ $title }}
                    </h3>

                    <div class="property-developer">
                        <i class="fa-solid fa-building"></i> By {{ $builder }}
                    </div>

                    <div class="property-location">
                        <i class="fa-solid fa-location-dot"></i> {{ $location }}
                    </div>

                    <div class="property-specs">
                        <div class="spec-item">
                            <span class="spec-label">Config</span>
                            <span class="spec-value">{{ $bhk }} BHK</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Area</span>
                            <span class="spec-value">{{ $area }} SQ.FT</span>
                        </div>
                    </div>

                    <div class="property-footer">
                      <div class="property-price">

                            {{ $price }}

                            <!--<span class="onwards-text">-->
                            <!--    Onwards-->
                            <!--</span>-->

                        </div>

                        <a href="{{ url('property/' . $v->slug) }}">
                            <button class="contact-btn">
                                Contact <span>→</span>
                            </button>
                        </a>
                    </div>

                </div>

            </div>

        @endforeach

    </div>

    {{-- ✅ LOAD MORE ONLY WHEN NO FILTER --}}
  @if(!request()->hasAny(['search','bhk','budget','type']))
<div class="text-center mt-9" style="margin-top:40px;">
    <a href="{{ url('/properties') }}" class="btn btn-primary px-4 py-2">
        View All Properties →
    </a>
</div>
@endif

    @else

    {{-- ❌ NO DATA CASE --}}
    <div class="text-center mt-5">
        <h3>No Properties Found 😔</h3>
        <p>Try changing filters</p>
    </div>

    @endif

</section>
<script>
document.addEventListener("DOMContentLoaded", function(){

    document.getElementById("loadMoreBtn").addEventListener("click", function(){

        let hiddenItems = document.querySelectorAll(".extra-property");

        hiddenItems.forEach(function(item){
            item.style.display = "block";
        });

        this.style.display = "none";
    });

});
</script>


    {{-- TESTIMONIALS --}}
<section id="testimonials" class="testimonials section-padding">
    <div class="container-tab">
        <div class="section-header text-center">
            <h4 style="color:#295cb3">Testimonials</h4>
            <h2 class="finserv-trusted" style="color:#295cab;">What Our <strong style="color:#00abeb">Clients</strong> Say</h2>
            <p>Trust from over 1000+ happy customers across Pune & PCMC.</p>
        </div>

        <div class="testimonials-grid">

            <div class="testimonial-card">
                <div class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p>
                    "Jfinserv helped me get my home loan approved in just 5 days.
                    The process was completely transparent and the team was very professional."
                </p>
                <div class="client-info">
                    <div class="client-details">
                        <h3>Rahul Sharma</h3>
                        <span>Home Loan Customer</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p>
                    "Highly recommend their MSME loan services.
                    They understood my business requirements and offered the best interest rates."
                </p>
                <div class="client-info">
                    <div class="client-details">
                        <h3>Priya Patil</h3>
                        <span>Business Owner</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p>
                    "Excellent experience with their Loan Against Property service.
                    Minimal documentation and very fast disbursement."
                </p>
                <div class="client-info">
                    <div class="client-details">
                        <h3>Amit Deshpande</h3>
                        <span>Real Estate Developer</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


    {{-- CONTACT --}}
    <section class="final-cta" id="apply">
        <div class="final-cta-content">
            <h2>Ready to Get the Best Loan Offer?</h2>
            <p>Apply in minutes and get expert assistance at every step. Join 10,000+ satisfied customers who trusted JFINSERV for their financial needs.</p>
            <a href="{{ route('authv3.login.form') }}" class="btn-primary-hero btn-outline">Apply Now</a>
        </div>
    </section>

    <section class="home-section">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="home-section-title">Frequently Asked Questions</h2>
                <p class="home-section-subtitle">
                    Get answers to common queries about our home loan products
                </p>
            </div>

            <div class="home-faq-container">
                <!-- Eligibility Category -->
                <div class="home-faq-category">
                    <!-- <h3 class="home-faq-category-title">Eligibility & Requirements</h3> -->
                    
                    <div class="home-faq-item active">
                        <div class="home-faq-question">
                            <span>What financial services does Jfinserv offer?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Jfinserv offers a wide range of financial solutions including Home Loans, MSME Loans, Loan Against Property (LAP), Lease Rental Discounting (LRD), and Project Finance tailored to individual and business needs.
                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>Who can apply for a loan with Jfinserv?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Salaried individuals, self-employed professionals, business owners, and companies can apply, subject to eligibility criteria such as income stability, credit history, and property details (if applicable).
                            </div>
                        </div>
                    </div>
                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>How long does it take to get loan approval?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Loan approval timelines depend on document completeness and credit assessment. In most cases, approvals are processed quickly with support from our dedicated relationship managers.
                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>What documents are required to apply for a loan??</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Basic documents include identity proof, address proof, income documents, bank statements, and property-related documents where applicable. Exact requirements vary by loan type.
                            </div>
                        </div>
                    </div>
                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>Why choose Jfinserv for your financial needs?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Jfinserv offers competitive interest rates, transparent processes, personalized assistance, and end-to-end support to make borrowing simple and stress-free.
                            </div>
                        </div>
                    </div>

                </div>
                </div>
                </div>
            </div>
        </div>
    </section>

</main>



@include('dhara-jfin.layout.footer')

<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    //features section
    document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(".fade-up");

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target); // animate once
                }
            });
        },
        {
            threshold: 0.2
        }
    );

    elements.forEach(el => observer.observe(el));
});
    document.querySelectorAll('.service-btn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.preventDefault();
        console.log(btn.closest('.service-card').querySelector('h3').innerText);
    });
});

    
    // Hero Background Carousel
    const heroSlider = document.querySelector('.hero-slider');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');
    const heroSection = document.querySelector('.hero');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoSlideInterval;
    let isTransitioning = false;

    if (heroSlider && totalSlides > 0) {
        function updateSlide(index) {
            if (isTransitioning) return;
            isTransitioning = true;

            // Handle wrap around
            if (index >= totalSlides) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = totalSlides - 1;
            } else {
                currentSlide = index;
            }

            const offset = currentSlide * -100;
            heroSlider.style.transform = `translateX(${offset}%)`;

            // Reset transitioning flag after animation
            setTimeout(() => {
                isTransitioning = false;
            }, 1000);

            // Animate content of current slide
            const activeSlide = slides[currentSlide];
            const contentElements = activeSlide.querySelectorAll('.hero-intro, h1, p, .hero-btns');
            
            contentElements.forEach((el, i) => {
                el.style.animation = 'none';
                el.offsetHeight; // trigger reflow
                el.style.animation = `fadeInUp 0.8s ease ${0.1 + (i * 0.1)}s backwards`;
            });
        }

        function nextSlide() {
            updateSlide(currentSlide + 1);
        }

        function prevSlide() {
            updateSlide(currentSlide - 1);
        }

        function startAutoSlide() {
            stopAutoSlide();
            autoSlideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // Button Listeners
        if (nextBtn) nextBtn.addEventListener('click', () => {
            nextSlide();
            startAutoSlide();
        });
        
        if (prevBtn) prevBtn.addEventListener('click', () => {
            prevSlide();
            startAutoSlide();
        });

        // Mouse Wheel / Touchpad Scroll Support
        let lastScrollTime = 0;
        const scrollCooldown = 1500; // ms

        heroSection.addEventListener('wheel', (e) => {
            const currentTime = new Date().getTime();
            if (currentTime - lastScrollTime < scrollCooldown) return;

            if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
                // Horizontal scroll (typical for touchpads)
                e.preventDefault();
                if (e.deltaX > 50) {
                    nextSlide();
                    lastScrollTime = currentTime;
                    startAutoSlide();
                } else if (e.deltaX < -50) {
                    prevSlide();
                    lastScrollTime = currentTime;
                    startAutoSlide();
                }
            } else if (Math.abs(e.deltaY) > 50) {
                // Vertical scroll on hero section can also trigger slide
                // Only if the user is hovering and deliberately scrolling
                // e.preventDefault(); // Uncomment if you want to block page scroll
                // if (e.deltaY > 50) nextSlide();
                // else prevSlide();
                // lastScrollTime = currentTime;
                // startAutoSlide();
            }
        }, { passive: false });

        // Touch Swipe Support
        let touchStartX = 0;
        let touchEndX = 0;

        heroSection.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        heroSection.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                nextSlide();
                startAutoSlide();
            } else if (touchEndX > touchStartX + swipeThreshold) {
                prevSlide();
                startAutoSlide();
            }
        }

        // Initialize
        startAutoSlide();
    }
    const faqItems = document.querySelectorAll('.home-faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.home-faq-question');
            
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(i => i.classList.remove('active'));
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
</script>
<script src="{{ asset('theme/dhara-jfin/js/chatbot.js') }}"></script>

