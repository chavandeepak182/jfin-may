@include('dhara-jfin.layout.header')
<main>
<section class="video-hero">
        <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
        <source src="{{ asset('theme/dhara-jfin/videos/jfinserv_banner_services.mp4') }}" type="video/mp4">
        </video>
    <div class="video-banner-overlay">
        <div class="video-overlay-content">
            <h1>We Handle All Your <span>Lending Needs</span></h1>
        </div>
    </div>
</section>

    <!-- Services Section -->
    <section class="service-page-services-section">
        <div class="service-page-services-grid">
            <!-- Home Loan -->
            <div class="service-page-service-card">
                <div class="service-page-shine"></div>
                <div class="service-page-service-image">
                    <div class="service-page-service-illustration">
                        <img src="{{asset('theme/dhara-jfin/img/home_loan.jpg')}}">
                    </div>
                    <div class="service-page-service-badge">Popular</div>
                </div>
                <div class="service-page-service-content">
                    <h3 class="service-page-service-title">Home Loan</h3>
                    <p class="service-page-service-description">We understand you're seeking a new home, with low rates & a seamless process, we're here to help you achieve it.</p>
                    <ul class="service-page-service-features">
                        <li>Competitive interest rates starting at 8.5%</li>
                        <li>Loan amounts up to ₹5 Crore</li>
                        <li>Flexible repayment tenure up to 30 years</li>
                        <li>Quick approval within 48 hours</li>
                    </ul>
                    <div class="service-page-service-footer">
                        <div class="service-page-service-rate">
                            <span class="service-page-rate-label">Starting From</span>
                            <span class="service-page-rate-value">8.5%*</span>
                        </div>
                        <a href="{{url('/home-loan')}}" class="service-page-btn-service">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Loan Against Property -->
            <div class="service-page-service-card">
                <div class="service-page-shine"></div>
                <div class="service-page-service-image">
                    <div class="service-page-service-illustration">
                        <img src="{{asset('theme/dhara-jfin/img/loan_against_property.jpg')}}">
                    </div>
                    <div class="service-page-service-badge">Featured</div>
                </div>
                <div class="service-page-service-content">
                    <h3 class="service-page-service-title">Loan Against Property</h3>
                    <p class="service-page-service-description">JFinserv offers Loans Against Property with flexible repayment options and swift loan benefits.</p>
                    <ul class="service-page-service-features">
                        <li>Unlock up to 70% of your property value</li>
                        <li>Attractive interest rates from 9.0%</li>
                        <li>Loan amounts up to ₹10 Crore</li>
                        <li>Minimal documentation required</li>
                    </ul>
                    <div class="service-page-service-footer">
                        <div class="service-page-service-rate">
                            <span class="service-page-rate-label">Starting From</span>
                            <span class="service-page-rate-value">9.0%*</span>
                        </div>
                        <a href="{{url('/loan-against-property')}}" class="service-page-btn-service">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Project Loan -->
            <div class="service-page-service-card">
                <div class="service-page-shine"></div>
                <div class="service-page-service-image">
                    <div class="service-page-service-illustration">
                        <img src="{{asset('theme/dhara-jfin/img/project_loan.jpg')}}">
                    </div>
                </div>
                <div class="service-page-service-content">
                    <h3 class="service-page-service-title">Project Loan</h3>
                    <p class="service-page-service-description">We simplify construction financing with low rates and an easy BNAO lending application, offering tailored solutions for your project needs.</p>
                    <ul class="service-page-service-features">
                        <li>Specialized construction financing</li>
                        <li>Flexible disbursement as per project stages</li>
                        <li>Competitive rates from 9.5%</li>
                        <li>Expert guidance throughout the project</li>
                    </ul>
                    <div class="service-page-service-footer">
                        <div class="service-page-service-rate">
                            <span class="service-page-rate-label">Starting From</span>
                            <span class="service-page-rate-value">9.5%*</span>
                        </div>
                        <a href="{{url('/project-loan')}}" class="service-page-btn-service">Read More</a>
                    </div>
                </div>
            </div>

            <!-- MSME Loan -->
            <div class="service-page-service-card">
                <div class="service-page-shine"></div>
                <div class="service-page-service-image">
                    <div class="service-page-service-illustration">
                        <img src="{{asset('theme/dhara-jfin/img/msme_loan.jpg')}}">
                    </div>
                    <div class="service-page-service-badge">New</div>
                </div>
                <div class="service-page-service-content">
                    <h3 class="service-page-service-title">MSME Loan</h3>
                    <p class="service-page-service-description">This service meets the diverse needs of small and medium businesses. Whether it is expanding, investing in equipment, or increasing capital.</p>
                    <ul class="service-page-service-features">
                        <li>Tailored solutions for SMEs</li>
                        <li>Quick processing and approval</li>
                        <li>Collateral-free loans available</li>
                        <li>Working capital support</li>
                    </ul>
                    <div class="service-page-service-footer">
                        <div class="service-page-service-rate">
                            <span class="service-page-rate-label">Starting From</span>
                            <span class="service-page-rate-value">10.0%*</span>
                        </div>
                        <a href="{{url('/msme-loan')}}" class="service-page-btn-service">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Overdraft Facility -->
            <div class="service-page-service-card">
                <div class="service-page-shine"></div>
                <div class="service-page-service-image">
                    <div class="service-page-service-illustration">
                        <img src="{{asset('theme/dhara-jfin/img/overdraft_loan.jpg')}}">
                    </div>
                </div>
                <div class="service-page-service-content">
                    <h3 class="service-page-service-title">Overdraft Facility</h3>
                    <p class="service-page-service-description">An overdraft facility allows you to withdraw funds beyond your account balance, up to a predetermined limit.</p>
                    <ul class="service-page-service-features">
                        <li>Flexible credit line when you need it</li>
                        <li>Pay interest only on utilized amount</li>
                        <li>Instant access to funds</li>
                        <li>No prepayment penalties</li>
                    </ul>
                    <div class="service-page-service-footer">
                        <div class="service-page-service-rate">
                            <span class="service-page-rate-label">Starting From</span>
                            <span class="service-page-rate-value">11.5%*</span>
                        </div>
                        <a href="{{url('/overdraft-facility')}}" class="service-page-btn-service">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Lease Rental Discounting -->
            <div class="service-page-service-card">
                <div class="service-page-shine"></div>
                <div class="service-page-service-image">
                    <div class="service-page-service-illustration">
                        <img src="{{asset('theme/dhara-jfin/img/lrd_loan.jpg')}}">
                    </div>
                </div>
                <div class="service-page-service-content">
                    <h3 class="service-page-service-title">Lease Rental Discounting (LRD)</h3>
                    <p class="service-page-service-description">Lease Rental Discounting (LRD) allows property owners to obtain loans by using future rental income as collateral.</p>
                    <ul class="service-page-service-features">
                        <li>Leverage your rental income</li>
                        <li>High loan-to-value ratio</li>
                        <li>Attractive interest rates</li>
                        <li>Suitable for commercial properties</li>
                    </ul>
                    <div class="service-page-service-footer">
                        <div class="service-page-service-rate">
                            <span class="service-page-rate-label">Starting From</span>
                            <span class="service-page-rate-value">9.5%*</span>
                        </div>
                        <a href="{{url('/lease-rental-discounting')}}" class="service-page-btn-service">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="service-page-cta-section" id="apply">
        <div class="service-page-cta-content">
            <h2>Ready to Get Started?</h2>
            <p>Choose the loan that fits your needs and apply now. Our experts are here to guide you through every step of the process.</p>
            <a href="{{ route('authv3.login.form') }}" class="service-page-btn-cta">Apply for a Loan</a>
        </div>
    </section>
@include('dhara-jfin.layout.footer')


<script src="{{ asset('theme/dhara-jfin/js/chatbot.js') }}"></script>


