{{-- resources/views/dhara-jfin/index.blade.php --}}
 

@include('dhara-jfin.layout.header')

<main>

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

    // Sticky header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
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

