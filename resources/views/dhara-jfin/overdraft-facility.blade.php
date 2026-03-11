@include('dhara-jfin.layout.header')

<main>
    <!-- HERO -->
    <section class="video-hero">
        <video id="videobcg" preload="auto" autoplay loop muted volume="0">
            <source src="{{ asset('theme/dhara-jfin/videos/overdraft_banner.mp4') }}" type="video/mp4">
        </video>
        <div class="video-banner-overlay">
            <div class="video-overlay-content">
                <h1>Flexible Cash Flow with <span>Jfinserv</span> Overdraft Facility</h1>
                <p>Withdraw funds anytime and pay interest only on what you use.</p>
                <a href="{{ route('authv3.login.form') }}" class="btn-primary">Apply Now</a>
            </div>
        </div>
    </section>

    <!-- PRODUCT OVERVIEW -->
    <section class="finserv-wrapper">
        <div class="container-tab">
            <div class="finserv-header">
                <h4 class="finserv-eyebrow">Product Overview</h4>
                <h2 class="finserv-trusted" style="color:#295cab;">
                    Manage Cash Flow Seamlessly with <strong style="color:#00abeb">Overdraft Facility</strong>
                </h2>
                <p class="home-section-subtitle">
                    Jfinserv’s Overdraft Facility provides instant access to funds for day-to-day business needs, allowing you to withdraw money as required and pay interest only on the amount utilized.
                </p>
            </div>

            <div class="about-grid">
                <div class="about-content-left">
                    <ul class="home-checklist">
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Withdraw funds anytime within approved limit</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Interest charged only on utilized amount</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Ideal for working capital & short-term needs</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Flexible repayment with revolving credit</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Helps manage seasonal cash flow gaps</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Simple documentation & quick approval</li>
                    </ul>
                </div>

                <div class="about-content-right">
                    <div class="about-image-wrapper">
                        <img src="{{ asset('theme/dhara-jfin/img/overdraft_page.jpg') }}" alt="Overdraft Facility">
                    </div>
                </div>
            </div>

            <div class="about-content-button" style="margin-top: 2rem;">
                <a href="{{ url('/contact') }}" class="btn btn-primary-hero"
                   style="padding:1rem 3rem; font-size:1.5rem;">
                    Enquire Now
                </a>
            </div>
        </div>
    </section>

    <!-- WHY OVERDRAFT -->
    <section class="home-section">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">
                    Why Choose Our <strong style="color:#00abeb">Overdraft</strong> Facility?
                </h2>
                <p class="home-section-subtitle">
                    Financial flexibility when you need it the most
                </p>
            </div>

            <p class="home-overview-intro">
                An overdraft facility gives your business instant liquidity to handle operational expenses,
                bridge cash flow gaps, and respond to opportunities without taking a fresh loan each time.
            </p>

            <div class="home-feature-cards" >
                <div class="home-feature-card">
                    <div class="home-feature-icon">🔁</div>
                    <h3 class="home-feature-title">Reusable Credit Limit</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">💸</div>
                    <h3 class="home-feature-title">Pay Interest on Usage</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">⚡</div>
                    <h3 class="home-feature-title">Instant Access to Funds</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">📊</div>
                    <h3 class="home-feature-title">Improved Cash Flow Control</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">📄</div>
                    <h3 class="home-feature-title">Simple Documentation</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFITS -->
    <section class="home-section home-benefits-section">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">
                    Overdraft Facility <strong style="color:#00abeb">Benefits</strong>
                </h2>
                <p class="home-section-subtitle">
                    Smart credit support for smooth business operations
                </p>
            </div>

            <div class="home-benefit-grid">
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">On-Demand Liquidity</h3>
                    <p class="home-benefit-description">
                        Withdraw funds whenever required without reapplying for a loan.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Cost-Effective Borrowing</h3>
                    <p class="home-benefit-description">
                        Interest is charged only on the amount utilized, not the entire limit.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Flexible Repayment</h3>
                    <p class="home-benefit-description">
                        Repay and reuse the credit multiple times within the tenure.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Business Continuity</h3>
                    <p class="home-benefit-description">
                        Maintain uninterrupted operations during cash flow gaps.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Quick Processing</h3>
                    <p class="home-benefit-description">
                        Faster approvals with minimal documentation.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Expert Assistance</h3>
                    <p class="home-benefit-description">
                        Dedicated support throughout the overdraft lifecycle.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ELIGIBILITY & DOCUMENTS -->
    <section class="home-section" id="home-eligibility">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="home-section-title">Eligibility & Documents</h2>
                <p class="home-section-subtitle">
                    Check Overdraft Facility eligibility and documents
                </p>
            </div>

            <div class="home-tabs">
                <button class="home-tab active" data-tab="for-all-applicants">For all Applicants</button>
                <button class="home-tab" data-tab="salaried-overdraft">Salaried Individuals</button>
                <button class="home-tab" data-tab="self-employed-overdraft">Self-Employed / Business</button>
                <button class="home-tab" data-tab="business-docs">Business Documents</button>
                <button class="home-tab" data-tab="other-overdraft">Other Supporting Documents</button>
            </div>

            <!-- SAME ELIGIBILITY IN ALL TABS -->
            @php
                $eligibility = [
                    'Applicant must be an Indian resident or eligible NRI',
                    'Stable income or business cash flow required',
                    'Good credit history preferred',
                    'Clear repayment capacity assessed by lender',
                    'Banking relationship impacts approval'
                ];
            @endphp

            <!-- FOR ALL -->
            <div class="home-tab-content active" id="for-all-applicants">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($eligibility as $item)
                                <li class="home-checklist-item">
                                    <span class="home-checklist-icon">✓</span>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">📋 Duly filled and signed overdraft application form</li>
                            <li class="home-document-item">📋 PAN Card of applicant</li>
                            <li class="home-document-item">📋 Recent passport-size photographs</li>
                            <li class="home-document-item">📋 Identity proof (Aadhaar / Passport / Driving License)</li>
                            <li class="home-document-item">📋 Address proof of residence / office</li>
                            <li class="home-document-item">📋 Bank statements (6-12 months)</li>
                            <li class="home-document-item">📋 Processing fee cheque</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- SALARIED -->
            <div class="home-tab-content" id="salaried-overdraft">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($eligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">📋 Latest salary slips (last 3–6 months)</li>
                            <li class="home-document-item">📋 Form 16 / Form 26AS</li>
                            <li class="home-document-item">📋 Employment ID card or appointment letter</li>
                            <li class="home-document-item">📋 Salary account bank statement</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- SELF EMPLOYED -->
            <div class="home-tab-content" id="self-employed-overdraft">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($eligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">📋 Income Tax Returns for last 2–3 years</li>
                            <li class="home-document-item">📋 Audited balance sheet and P&L statements</li>
                            <li class="home-document-item">📋 Business bank statements for last 12 months</li>
                            <li class="home-document-item">📋 Net worth statement of promoters</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- NRI -->
            <div class="home-tab-content" id="business-docs">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($eligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">📋 GST registration certificate</li>
                            <li class="home-document-item">📋 Shop Act / Udyam / MSME registration</li>
                            <li class="home-document-item">📋 Partnership deed / MOA & AOA (if applicable)</li>
                            <li class="home-document-item">📋 Board resolution for overdraft facility</li>
                            <li class="home-document-item">📋 Business address proof</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-tab-content" id="other-overdraft">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($eligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">📋 Sanction letters of existing loans</li>
                            <li class="home-document-item">📋 Statement of existing overdraft / CC limits</li>
                            <li class="home-document-item">📋 Collateral documents (if overdraft is secured)</li>
                            <li class="home-document-item">📋 Any additional documents as required by lender</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- faqs  -->
     <section class="home-section">
    <div class="container-tab">
        <div class="home-section-header">
            <h2 class="home-section-title">Frequently Asked Questions</h2>
            <p class="home-section-subtitle">
                Get answers to common queries about Home Loans
            </p>
        </div>

        <div class="home-faq-container">
            <div class="home-faq-category">

                <div class="home-faq-item active">
                    <div class="home-faq-question">
                        <span>What is a home loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            A home loan is a loan provided by a financial organisation to help individuals or families purchase a home. It allows borrowers to finance the purchase of a property by borrowing money from the lender and repaying it over a specified period of time, along with interest.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What documents are required for a salaried individual to apply for a home loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Following documents of a salaried person are needed to apply for a home loan.
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
                        <span>What documents are required for a self-employed individual to apply for a home loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Following documents of a self-employed person are needed to apply for a home loan.
                            <ul>
                                <li>KYC documents (identity and address proof)</li>
                                <li>Income proof (P &amp; L Statement)</li>
                                <li>Last 6 months account statements</li>
                                <li>Business proof</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What are the interest rates for home loans offered by Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The interest rate for home loans offered by Jfinserv is based on market conditions, the loan amount, tenure, and the applicant's credit profile. Jfinserv strives to offer competitive interest rates to make home ownership affordable for its customers.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the maximum loan amount and tenure offered for home loans by Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The maximum loan amount and tenure offered for home loans may vary depending on factors like applicant's income, repayment capacity, and the value of the property. Jfinserv offers competitive loan amounts and flexible repayment tenures to suit the needs of borrowers.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the process for applying for a home loan with Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The process for applying for a home loan involves filling out an application form, submitting the required documents, undergoing credit appraisal, property valuation, and loan approval. Our dedicated team of experts will assist you at every step of the application process to ensure a smooth and hassle-free experience.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What are the different types of home loans offered by Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Jfinserv offers various types of home loans to meet the diverse needs of customers, including home purchase loans, home construction loans, home improvement loans, and balance transfer loans. Each type of loan is designed to address specific requirements related to buying, constructing, or renovating a home.
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

