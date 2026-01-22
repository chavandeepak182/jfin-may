@section('title', 'About Us')
@section('content')
@include('dhara-jfin.layout.header')
<main>
        <section class="video-hero">
        <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
        <source src="{{ asset('theme/dhara-jfin/videos/about_us_banner.mp4') }}" type="video/mp4">
        </video>
    <div class="video-banner-overlay">
        <div class="video-overlay-content">
            <h1>Empowering your<span> Financial </span>Journey</h1>
            <!-- <p>Tailored financial solutions for large-scale construction and infrastructure projects.</p>
            <a href="{{ url('/apply') }}" class="btn-primary">
                Apply Now
            </a> -->
        </div>
    </div>
</section>

        <section class="about-section-main">
            <div class="container">
                <div class="about-grid">
                    <div class="about-content-left">
                        <h4>About Our Company</h4>
                        <h2 class="finserv-trusted" style="color:#295cab;">We Promise To <br><strong style="color:#00abeb">Deliver</strong> The Best</h2>
                        <p>Jfinserv Consultant India Private Limited with many finance partners strives to get you the best loan deals and offers online in just a few clicks. You can compare various loan products online with latest interest rates from Nationalized/Government banks and NBFCs in India including Indian Bank, BOM, PNB, RBL, UBI, BOB, Kotak, Axis, ICICI Bank, Aditya Birla Capital and other partners. Our team of financial experts works hard to find and get you the best deal. 
                            <a href="#" class="incorp-cert">INCORPORATION CERTIFICATE <i class="fas fa-arrow-right"></i></a></p>
                        
                        <p>Jfinserv Can Help With All Your Home Lending Needs.</p>
                        
                        <ul class="about-features-list">
                            <li><i class="fas fa-check"></i> Calculate Your Purchasing Power</li>
                            <li><i class="fas fa-check"></i> Buy Your Home</li>
                            <li><i class="fas fa-check"></i> Renovate Or Upgrade Your Home</li>
                            <li><i class="fas fa-check"></i> Use the Equity In Your Home For A Personal Investment</li>
                            <li><i class="fas fa-check"></i> Expand Your Property Portfolio</li>
                            <li><i class="fas fa-check"></i> Refinance Your Existing Loan</li>
                        </ul>
                    </div>
                    <div class="about-content-right">
                        <div class="about-image-wrapper">
                            <!-- Placeholder image based on reference -->
                            <img src="{{asset('theme/dhara-jfin/img/about-1.jpg')}}" alt="Jfinserv Team">
                        </div>
                        <div class="stats-grid">
                            <div class="stat-box">
                                <h3>250 +</h3>
                                <p>Disbursed Loans</p>
                            </div>
                            <div class="stat-box">
                                <h3>7 +</h3>
                                <p>Awards Won</p>
                            </div>
                            <div class="stat-box">
                                <h3>50 +</h3>
                                <p>Skilled Agents</p>
                            </div>
                            <div class="stat-box">
                                <h3>75 +</h3>
                                <p>Team Members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mission-vision-section">
            <div class="container">
                <div class="mission-vision-grid">
                    <div class="mission-vision-image">
                        <img src="{{asset('theme/dhara-jfin/img/mision.jpg')}}" alt="Mission Vision Values">
                    </div>
                    <div class="mission-vision-content">
                        <h4>Future Ready</h4>
                        <h2 class="finserv-trusted" style="color:#295cab;">Mission, Vision <strong style="color:#00abeb">& Values</strong></h2>
                        
                        <div class="mission-box">
                            <h3>Our Mission</h3>
                            <p>Our mission is to be the leading finance company, offering secured loans at competitive rates. We focus on maximizing shareholder value while delivering exceptional, customer-centered service.</p>
                        </div>
                        
                        <div class="mission-box">
                            <h3>Our Values</h3>
                            <p>We are transitioning into a knowledge-driven organization by enhancing operational autonomy and fostering a strong sense of ownership among employees.</p>
                        </div>
                        
                        <div class="mission-box">
                            <h3>Our Vision</h3>
                            <p>To be a leading financial consulting firm, delivering innovative, customized solutions for sustainable client growth, while upholding a culture of excellence and integrity.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="awards-section">
            <div class="container">
                <div class="section-header">
                    <h4 class="finserv-eyebrow" style="color:#295cab;">Our Awards</h4>
                    <h2 class="finserv-trusted" style="color:#295cab;">Top Corporate <strong style="color:#00abeb">Recognitions</strong></h2>
                </div>
                
                <div class="awards-grid">
                    <div class="award-card">
                        <div class="award-logo">
                            <i class="fas fa-university" style="color: #ed1c24;"></i>
                        </div>
                        <h3>Home Loan Sourcing - Rank 1<sup>st</sup></h3>
                        <p>Year 2023-24</p>
                    </div>
                    
                    <div class="award-card">
                        <div class="award-logo">
                            <span style="font-weight: 800; font-size: 1.5rem; color: #000;">ARKA</span>
                        </div>
                        <h3>Preferred Business Partner</h3>
                        <p>Year 2023-24</p>
                    </div>
                    
                    <div class="award-card">
                        <div class="award-logo">
                            <i class="fas fa-university" style="color: #ed1c24;"></i>
                        </div>
                        <h3>Best Performing in Home Loan Sourcing</h3>
                        <p>Year 2023-24</p>
                    </div>
                    
                    <div class="award-card">
                        <div class="award-logo">
                            <i class="fas fa-university" style="color: #0054a6;"></i>
                        </div>
                        <h3>For Mobilizing Mortgage Loan - Rank 1<sup>st</sup></h3>
                        <p>Year 2022-23</p>
                    </div>
                    
                    <div class="award-card">
                        <div class="award-logo">
                            <span style="font-weight: 700; color: #1e3a8a;">ANANDRATHI</span>
                        </div>
                        <h3>Best Category in Business</h3>
                        <p>Year 2022-23</p>
                    </div>
                    
                    <div class="award-card">
                        <div class="award-logo">
                            <i class="fas fa-university" style="color: #0054a6;"></i>
                        </div>
                        <h3>For Mobilizing Mortgage Loan - Rank 1<sup>st</sup></h3>
                        <p>Year 2021-22</p>
                    </div>
                    
                    <div class="award-card">
                        <div class="award-logo">
                            <i class="fas fa-landmark" style="color: #1e40af;"></i>
                        </div>
                        <h3>Top Performing DSA</h3>
                        <p>Year 2021-22</p>
                    </div>
                </div>
            </div>
        </section>


        <section class="about-page-page-hero">
        <div class="about-page-hero-content">
            <div class="about-page-hero-label">About JFINSERV</div>
            <h1 class="about-page-hero-title">Meet the People Behind Your Financial Success</h1>
            <p class="about-page-hero-description">Our dedicated team of financial experts brings years of experience and commitment to helping you achieve your financial goals with personalized guidance and support.</p>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="about-page-team-section">
        <div class="about-page-section-container">
            <div class="about-page-section-header">
                <div class="about-page-section-label">Our Team</div>
                <!-- <h2 class="about-page-section-title">Expert Financial Advisors</h2>
                <p class="about-page-section-subtitle">Dedicated professionals committed to helping you make smart financial decisions and achieve your dreams.</p> -->
            </div>
            
            <div class="about-page-team-grid">
                <!-- Team Member 1 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/dilip-y.jpg" alt="Dilip Kumar">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Dilip Kumar</h3>
                        <span class="about-page-team-designation">Managing Director</span>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/parag.png" alt="Parag Bhosale">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Parag Bhosale</h3>
                        <span class="about-page-team-designation">Sales Manager</span>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/nidhi.png" alt="Nidhi Sonigra">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Nidhi Sonigra</h3>
                        <span class="about-page-team-designation">Manager Admin</span>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/lokesh.png" alt="Lokesh Bhosale">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Lokesh Bhosale</h3>
                        <span class="about-page-team-designation">Sales Manager</span>
                    </div>
                </div>

                <!-- Team Member 5 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/praksh.png" alt="Prakash Malage">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Prakash Malage</h3>
                        <span class="about-page-team-designation">Home Loan Specialist</span>
                    </div>
                </div>

                <!-- Team Member 6 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/dummy.jpg" alt="Kevin Sunny">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Kevin Sunny</h3>
                        <span class="about-page-team-designation">Sales Executive</span>
                    </div>
                </div>

                <!-- Team Member 7 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/avinash.png" alt="Avinash Bodke">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Avinash Bodke</h3>
                        <span class="about-page-team-designation">Senior Accountant</span>
                    </div>
                </div>

                <!-- Team Member 8 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/rushi.png" alt="Rushikesh Suryavanshi">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Rushikesh Suryavanshi</h3>
                        <span class="about-page-team-designation">Accountant</span>
                    </div>
                </div>

                <!-- Team Member 9 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/dummy.jpg" alt="Sara Shaikh">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Sara Shaikh</h3>
                        <span class="about-page-team-designation">Executive Officer</span>
                    </div>
                </div>

                <!-- Team Member 10 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/dummy.jpg" alt="Sonali Bhosale">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Sonali Bhosale</h3>
                        <span class="about-page-team-designation">Executive Officer</span>
                    </div>
                </div>

                <!-- Team Member 11 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/astha.png" alt="Aasta Rokade">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Aasta Rokade</h3>
                        <span class="about-page-team-designation">Executive Telecaller</span>
                    </div>
                </div>

                <!-- Team Member 12 -->
                <div class="about-page-team-card">
                    <div class="about-page-team-image">
                        <img src="{{ asset('theme') }}/dhara-jfin/img/team_new/nikita.png" alt="Nikita Sanap">
                    </div>
                    <div class="about-page-team-overlay">
                        <ul class="about-page-team-social">
                            <li><a href="#" class="about-page-social-icon"></a></li>
                        </ul>
                    </div>
                    <div class="about-page-team-info">
                        <h3 class="about-page-team-name">Nikita Sanap</h3>
                        <span class="about-page-team-designation">Executive Telecaller</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    </main>

    @include('dhara-jfin.layout.footer')
    <script>
        // Sticky header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>
<script src="{{ asset('theme/dhara-jfin/js/chatbot.js') }}"></script>
