@include('dhara-jfin.layout.header')

<main>
    <section class="video-hero">
        <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
            <source src="{{ asset('theme/dhara-jfin/videos/msme_loan_banner.mp4') }}" type="video/mp4">
        </video>
        <div class="video-banner-overlay">
            <div class="video-overlay-content">
                <h1>Empower Your Business with <span>Jfinserv</span> MSME Loans</h1>
                <p>Flexible financial solutions to support working capital, expansion & growth.</p>
                <a href="{{ route('authv3.login.form') }}" class="btn-primary">
                    Apply Now
                </a>
            </div>
        </div>
    </section>

    <section class="finserv-wrapper">
        <div class="container">
            <div class="finserv-header">
                <h4 class="finserv-eyebrow">Product Overview</h4>
                <h2 class="finserv-trusted" style="color:#295cab;">Fuel Your Business Growth with <strong style="color:#00abeb">MSME Loans</strong></h2>
                <p class="home-section-subtitle">
                    MSME Loans are designed to support Micro, Small & Medium Enterprises by providing working capital, funds for expansion, equipment, and infrastructure financing. These loans come with competitive rates and flexible terms to help your business thrive.
                </p>
            </div>

            <div class="about-grid">
                <div class="about-content-left">
                    <ul class="home-checklist">
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Funds for working capital, expansion & equipment</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Competitive interest rates & flexible repayment options</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Easy and transparent application process</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Minimal documentation and quick processing</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Tailored for MSMEs to grow and scale operations</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Expert support throughout your loan journey</li>
                    </ul>
                </div>
                <div class="about-content-right">
                    <div class="about-image-wrapper">
                        <img src="{{ asset('theme/dhara-jfin/img/msme_loan_page.jpg') }}" alt="MSME Loan">
                    </div>
                </div>
            </div>

            <div class="about-content-button" style="margin-top: 2rem;">
                <a href="{{ url('/dhara-contact') }}" class="btn btn-primary-hero" style="padding:1rem 3rem; font-size:1.5rem;">Enquire Now</a>
            </div>
        </div>
    </section>

    <section class="home-section">
        <div class="container">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">Why Choose Our <strong style="color:#00abeb">MSME</strong> Loan?</h2>
                <p class="home-section-subtitle">
                    Support tailored to your business needs
                </p>
            </div>

            <p class="home-overview-intro">
                Our MSME Loan solutions are crafted to address the unique financial needs of small and medium businesses — whether you need cash flow support, funds for growth, or finance for equipment and operations. Enjoy competitive rates, flexible repayment, and a seamless loan experience.
            </p>

            <div class="home-feature-cards" >
                <div class="home-feature-card">
                    <div class="home-feature-icon">📈</div>
                    <h3 class="home-feature-title">Working Capital Support</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">💰</div>
                    <h3 class="home-feature-title">Competitive Interest Rates</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">📅</div>
                    <h3 class="home-feature-title">Flexible Repayment Terms</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">📄</div>
                    <h3 class="home-feature-title">Minimal Documentation</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">⚡</div>
                    <h3 class="home-feature-title">Swift Approval & Disbursal</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section home-benefits-section">
        <div class="container">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">MSME Loan <strong style="color:#00abeb">Benefits</strong></h2>
                <p class="home-section-subtitle">
                    Delivering business financing that empowers growth
                </p>
            </div>

            <div class="home-benefit-grid">
                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <h3 class="home-benefit-title">Customized Financing</h3>
                    </div>
                    <p class="home-benefit-description">
                        Tailor your MSME Loan to fit your business requirements and growth plans.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <h3 class="home-benefit-title">Affordable Rate Structures</h3>
                    </div>
                    <p class="home-benefit-description">
                        Competitive interest rates designed to keep your business finances manageable.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <h3 class="home-benefit-title">Operational Cash Flow Assistance</h3>
                    </div>
                    <p class="home-benefit-description">
                        Access funds to maintain operations, stock, and commitments without disruption.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <h3 class="home-benefit-title">Support for Expansion</h3>
                    </div>
                    <p class="home-benefit-description">
                        Finance growth initiatives such as new equipment, infrastructure, or services.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <h3 class="home-benefit-title">Quick Loan Processing</h3>
                    </div>
                    <p class="home-benefit-description">
                        Faster assessments and disbursals to meet business timelines.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <h3 class="home-benefit-title">Dedicated Support</h3>
                    </div>
                    <p class="home-benefit-description">
                        Professional guidance throughout your MSME Loan application journey.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- eligibility and docs  -->
     <section class="home-section" id="home-eligibility">
    <div class="container">
        <div class="home-section-header">
            <h2 class="home-section-title">Eligibility & Documents</h2>
            <p class="home-section-subtitle">
                Check MSME Loan eligibility and required documents
            </p>
        </div>

        <div class="home-tabs">
            <button class="home-tab active" data-tab="for-all-applicants">For all Applicants</button>
            <button class="home-tab" data-tab="salaried-property">Salaried Individuals</button>
            <button class="home-tab" data-tab="self-employed-property">Self-Employed Individuals</button>
            <button class="home-tab" data-tab="nri-applicants">NRI Applicants</button>
        </div>

        <!-- COMMON ELIGIBILITY (SAME IN ALL TABS) -->

        <!-- FOR ALL -->
        <div class="home-tab-content active" id="for-all-applicants">
            <div class="home-eligibility-grid">

                <div class="home-eligibility-section">
                    <h3>✓ Eligibility Criteria</h3>
                    <ul class="home-checklist">
                        <li class="home-checklist-item">
                            <span class="home-checklist-icon">✓</span>
                            <span>Eligible Business Type: Micro, Small, and Medium Enterprises registered under applicable government norms.</span>
                        </li>
                        <li class="home-checklist-item">
                            <span class="home-checklist-icon">✓</span>
                            <span>Business Experience: Minimum 1–3 years of operational track record is preferred.</span>
                        </li>
                        <li class="home-checklist-item">
                            <span class="home-checklist-icon">✓</span>
                            <span>Income Stability: Business should generate consistent income to support loan repayment.</span>
                        </li>
                        <li class="home-checklist-item">
                            <span class="home-checklist-icon">✓</span>
                            <span>Credit History: A healthy credit score improves chances of approval.</span>
                        </li>
                        <li class="home-checklist-item">
                            <span class="home-checklist-icon">✓</span>
                            <span>Business Viability: Clear business plan and repayment strategy are evaluated.</span>
                        </li>
                    </ul>
                </div>

                <div class="home-documents-section">
                    <h3>📄 Required Documents</h3>
                    <ul class="home-document-list">
                        <li class="home-document-item">
                            <span class="home-document-icon">📋</span>
                            <span>KYC documents (Identity & Address Proof)</span>
                        </li>
                        <li class="home-document-item">
                            <span class="home-document-icon">📋</span>
                            <span>Business registration proof (GST / MSME / Shop Act)</span>
                        </li>
                        <li class="home-document-item">
                            <span class="home-document-icon">📋</span>
                            <span>Last 6 months bank statements</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- SALARIED -->
        <div class="home-tab-content" id="salaried-property">
            <div class="home-eligibility-grid">

                <div class="home-eligibility-section">
                    <h3>✓ Eligibility Criteria</h3>
                    <ul class="home-checklist">
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Eligible MSME business with stable income.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Minimum 1–3 years of business operations.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Good credit history preferred.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Clear repayment capacity and business continuity.</span></li>
                    </ul>
                </div>

                <div class="home-documents-section">
                    <h3>📄 Required Documents</h3>
                    <ul class="home-document-list">
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Form 16</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Last 3 months salary slips</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Employment proof</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Last 6 months bank statements</span></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- SELF EMPLOYED -->
        <div class="home-tab-content" id="self-employed-property">
            <div class="home-eligibility-grid">

                <div class="home-eligibility-section">
                    <h3>✓ Eligibility Criteria</h3>
                    <ul class="home-checklist">
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Registered MSME business with stable operations.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Consistent business income and cash flow.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Acceptable credit score.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Business viability and repayment capacity.</span></li>
                    </ul>
                </div>

                <div class="home-documents-section">
                    <h3>📄 Required Documents</h3>
                    <ul class="home-document-list">
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Income Tax Returns (Last 2–3 years)</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Audited Financial Statements</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Current account bank statements (6 months)</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Business registration proof</span></li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- NRI -->
        <div class="home-tab-content" id="nri-applicants">
            <div class="home-eligibility-grid">

                <div class="home-eligibility-section">
                    <h3>✓ Eligibility Criteria</h3>
                    <ul class="home-checklist">
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Overseas individual owning or running an MSME in India.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Stable overseas income with repayment capacity.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Good credit profile.</span></li>
                        <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>Valid legal documentation.</span></li>
                    </ul>
                </div>

                <div class="home-documents-section">
                    <h3>📄 Required Documents</h3>
                    <ul class="home-document-list">
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Valid Passport & Visa copy</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Overseas employment contract</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>NRE / NRO bank statements</span></li>
                        <li class="home-document-item"><span class="home-document-icon">📋</span><span>Power of Attorney (if applicable)</span></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>



    <!-- faqs -->
    <section class="home-section">
    <div class="container">
        <div class="home-section-header">
            <h2 class="home-section-title">Frequently Asked Questions</h2>
            <p class="home-section-subtitle">
                Get answers to common queries about our MSME Loan
            </p>
        </div>

        <div class="home-faq-container">
            <div class="home-faq-category">

                <div class="home-faq-item active">
                    <div class="home-faq-question">
                        <span>What is a MSME Loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            A MSME Loan is a loan provided by a financial organisation to help individuals or families purchase a home. It allows borrowers to finance the purchase of a property by borrowing money from the lender and repaying it over a specified period of time, along with interest.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What documents are required for a salaried individual to apply for a MSME Loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Following documents of a salaried person are needed to apply for MSME Loan.
                            <ul>
                                <li>KYC documents (identity and address proof)</li>
                                <li>Income proof (Salary slips)</li>
                                <li>Last 6 months account statements</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What documents are required for a self-employed individual to apply for a MSME Loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Following documents of a salaried person are needed to apply for MSME Loan.
                            <ul>
                                <li>KYC documents (identity and address proof)</li>
                                <li>Income proof (P &amp; L Statement)</li>
                                <li>Last 6 months account statements</li>
                                <li>Business Proof</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What are the interest rates for MSME Loans offered by Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The interest rate for MSME Loans offered by Jfinserv is based on market conditions, the loan amount, tenure, and the applicant's credit profile. Jfinserv strives to offer competitive interest rates to make home ownership affordable for its customers.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the maximum loan amount and tenure offered for MSME Loans by Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The maximum loan amount and tenure offered for MSME Loans may vary depending on factors like applicant's income, repayment capacity, and the value of the property. Jfinserv offers competitive loan amounts and flexible repayment tenures to suit the needs of borrowers.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the process for applying for a MSME Loan with Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The process for applying for a MSME Loan involves, filling out an application form, submitting the required documents, undergoing credit appraisal, property valuation, and loan approval. Our dedicated team of experts will assist you at every step of the application process to ensure a smooth and hassle-free experience.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What are the different types of MSME Loans offered by Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Jfinserv offers various types of MSME Loans to meet the diverse needs of customers, including home purchase loans, home construction loans, home improvement loans, and balance transfer loans. Each type of loan is designed to address specific requirements related to buying, constructing, or renovating a home.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
    <!-- You can reuse your existing Eligibility, EMI Calculator and FAQs sections here, updating the titles as needed -->
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
    

        // Tab functionality
        const tabs = document.querySelectorAll('.home-tab');
        const tabContents = document.querySelectorAll('.home-tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.dataset.tab;
                
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(tc => tc.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(target).classList.add('active');
            });
        });

        // FAQ accordion
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll-triggered animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe feature cards and benefit cards
        document.querySelectorAll('.home-feature-card, .home-benefit-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(card);
        });
    </script>
<script src="{{ asset('theme/dhara-jfin/js/chatbot.js') }}"></script>
