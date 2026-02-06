@include('dhara-jfin.layout.header')

<main>
    <!-- HERO -->
    <section class="video-hero">
        <video id="videobcg" preload="auto" autoplay loop muted volume="0">
            <source src="{{ asset('theme/dhara-jfin/videos/lrd_banner.mp4') }}" type="video/mp4">
        </video>
        <div class="video-banner-overlay">
            <div class="video-overlay-content">
                <h1>Unlock Funds with <span>Jfinserv</span> Lease Rental Discounting</h1>
                <p>Leverage your rental income from commercial property to access high-value financing.</p>
                <a href="{{ route('authv3.login.form') }}" class="btn-primary">Apply Now</a>
            </div>
        </div>
    </section>

    <!-- PRODUCT OVERVIEW -->
    <section class="finserv-wrapper">
        <div class="container-tab">
            <div class="finserv-header">
                <h4 class="finserv-eyebrow" >Product Overview</h4>
                <h2 class="finserv-trusted" style="color:#295cab;">
                    Finance Against Rental Income with <strong style="color:#00abeb">Lease Rental Discounting</strong>
                </h2>
                <p class="home-section-subtitle">
                    Lease Rental Discounting (LRD) is a term loan offered against the future rental income of your leased commercial property, enabling you to unlock liquidity without selling your asset.
                </p>
            </div>

            <div class="about-grid">
                <div class="about-content-left">
                    <ul class="home-checklist">
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Loan based on discounted value of future rentals</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> High-value funding without selling property</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Flexible repayment aligned with lease term</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Competitive interest rates</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Simplified eligibility with predictable rent inflows</li>
                        <li class="home-checklist-item"><i class="fas fa-check"></i> Suitable for various commercial and specialised properties</li>
                    </ul>
                </div>
                <div class="about-content-right">
                    <div class="about-image-wrapper">
                        <img src="{{ asset('theme/dhara-jfin/img/lrd_loan.jpg') }}" alt="Lease Rental Discounting Loan">
                    </div>
                </div>
            </div>

            <div class="about-content-button" style="margin-top: 2rem;">
                <a href="{{ url('/dhara-contact') }}" class="btn btn-primary-hero"
                   style="padding:1rem 3rem; font-size:1.5rem;">Enquire Now</a>
            </div>
        </div>
    </section>

    <!-- WHY LRD -->
    <section class="home-section">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">
                    Why Choose <strong style="color:#00abeb">Lease Rental Discounting</strong>?
                </h2>
                <p class="home-section-subtitle">
                    Turn future rental receipts into immediate liquidity
                </p>
            </div>

            <p class="home-overview-intro">
                Lease Rental Discounting (LRD) allows property owners to use expected rental income as collateral to borrow funds. This financing option gives you the ability to unlock capital tied up in commercial assets while continuing to earn rental income.
            </p>

            <div class="home-feature-cards">
                <div class="home-feature-card">
                    <div class="home-feature-icon">📈</div>
                    <h3 class="home-feature-title">High Value Financing</h3>
                </div>
                <div class="home-feature-card">
                    <div class="home-feature-icon">💰</div>
                    <h3 class="home-feature-title">Competitive Interest Rates</h3>
                </div>
                <div class="home-feature-card">
                    <div class="home-feature-icon">📅</div>
                    <h3 class="home-feature-title">Flexible Repayment Options</h3>
                </div>
                <div class="home-feature-card">
                    <div class="home-feature-icon">⚡</div>
                    <h3 class="home-feature-title">Quick Approval & Disbursal</h3>
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
                    Lease Rental Discounting <strong style="color:#00abeb">Benefits</strong>
                </h2>
                <p class="home-section-subtitle">
                    Unlock financial growth without selling your property
                </p>
            </div>

            <div class="home-benefit-grid">
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Leverage Future Rental Income</h3>
                    <p class="home-benefit-description">
                        Use expected rental receipts from your leased commercial property as the basis for loan approval.
                    </p>
                </div>
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Retain Property Ownership</h3>
                    <p class="home-benefit-description">
                        Continue owning and benefiting from your property while using rental income to secure funds.
                    </p>
                </div>
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">High Loan Amount</h3>
                    <p class="home-benefit-description">
                        Lenders typically offer a significant portion of the discounted value of future rentals as loan funds.
                    </p>
                </div>
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Flexible Use of Funds</h3>
                    <p class="home-benefit-description">
                        Use the loan for business expansion, debt consolidation, or personal needs.
                    </p>
                </div>
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Transparent Terms</h3>
                    <p class="home-benefit-description">
                        Clear terms with minimal hidden charges, ensuring a smooth loan experience.
                    </p>
                </div>
                <div class="home-benefit-card">
                    <h3 class="home-benefit-title">Expert Support</h3>
                    <p class="home-benefit-description">
                        Dedicated guidance to help you structure the best deal for your requirements.
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
                    Check LRD Loan eligibility and required documents
                </p>
            </div>

            <div class="home-tabs">
                <button class="home-tab active" data-tab="for-all-applicants">For all Applicants</button>
                <button class="home-tab" data-tab="owner-lrd">Property Owner Documents</button>
                <button class="home-tab" data-tab="tenant-lrd">Tenant & Lease Documents</button>
                <button class="home-tab" data-tab="financial-lrd">Financial Documents</button>
                <button class="home-tab" data-tab="others-lrd">Other Supporting Documents</button>
            </div>

            <!-- COMMON ELIGIBILITY -->
            @php
                $lrdEligibility = [
                    'Indian residents or eligible NRIs can apply',
                    'Property must be income-generating with a registered lease agreement',
                    'Consistent rental income credited to bank account',
                    'Good credit history with score of 700 pr above improves approval chances',
                    'Age between 21 and 65 years depending on profile'
                ];
            @endphp

            <!-- FOR ALL APPLICANTS -->
            <div class="home-tab-content active" id="for-all-applicants">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($lrdEligibility as $item)
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
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Duly filled and signed Lease Rental Discounting application form</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Passport-size photographs of applicant / directors</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Identity proof (Aadhaar Card / PAN Card / Passport)</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Address proof of applicant and registered office</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>PAN Card of individual / company / firm</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Bank statements for last 6–12 months</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Processing fee cheque</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- SALARIED -->
            <div class="home-tab-content" id="owner-lrd">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($lrdEligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>{{ $item }}</span></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Property ownership documents (Sale Deed / Conveyance Deed)</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Latest property tax paid receipts</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Approved building plan and occupancy certificate</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>No Objection Certificate (NOC) from society / authority</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Property insurance copy (if available)</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- SELF EMPLOYED -->
            <div class="home-tab-content" id="tenant-lrd">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($lrdEligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>{{ $item }}</span></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Registered lease agreement with tenant</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Tenant KYC documents</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Tenant profile including company details</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Rent receipt or rental credit proof</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Lease tenure and escalation clause details</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- NRI -->
            <div class="home-tab-content" id="financial-lrd">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($lrdEligibility as $item)
                                <li class="home-checklist-item"><span class="home-checklist-icon">✓</span><span>{{ $item }}</span></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Audited financial statements for last 2–3 years</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Income Tax Returns with computation</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Cash flow statements</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Net worth statement of applicant / promoters</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Details of existing loans and liabilities</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- other  -->
             <div class="home-tab-content" id="others-lrd">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            @foreach($lrdEligibility as $item)
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
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Sanction letters of existing loans (if any)</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Bank account statements reflecting rental income</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Collateral documents (if required)</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>CA certificate confirming rental income</span></li>
                            <li class="home-document-item"><span class="home-document-icon">📋</span><span>Any additional documents requested by lender</span></li>
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
                Get answers to common queries about Lease Rental Discounting
            </p>
        </div>

        <div class="home-faq-container">
            <div class="home-faq-category">

                <div class="home-faq-item active">
                    <div class="home-faq-question">
                        <span>What is Lease Rental Discounting?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            Lease Rental Discounting is categorised as a Term Loan that allows you to secure a loan using rental receipts as collateral.
                            If you own a property with assured long-term rental income, you may be eligible for a Lease Rental Discounting (LRD) loan.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the eligibility criteria for Lease Rental Discounting?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            To apply for a Lease Rental Discounting loan, you must meet the following criteria:
                            <ul>
                                <li>Resident Indians and NRIs are eligible to apply</li>
                                <li>Salaried individuals working in public or private sectors</li>
                                <li>Self-employed professionals such as doctors, CAs, lawyers, architects, consultants</li>
                                <li>Self-employed non-professionals including traders, manufacturers, distributors</li>
                                <li>Companies, partnership firms, and proprietorships are also eligible</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What are the charges for a Lease Rental Discounting loan?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The charges applicable for Lease Rental Discounting loans include:
                            <ul>
                                <li>Processing or renewal fee of 2% plus applicable taxes</li>
                                <li>Administration charges of ₹5,000 or 0.25% of the loan amount (whichever is lower) plus taxes</li>
                                <li>Prepayment charges of 4% plus applicable taxes if prepaid after 6 months</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>Can I avail this loan against rent from a residential property?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            No. Lease Rental Discounting loans are applicable only for commercial or specialised properties
                            such as warehouses, industrial units, schools, hospitals, hotels, banquet halls, and similar assets.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the tenure offered for Lease Rental Discounting loans?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The maximum loan tenure for Lease Rental Discounting is up to 15 years.
                            For specialised properties, the tenure may be up to 10 years.
                        </div>
                    </div>
                </div>

                <div class="home-faq-item">
                    <div class="home-faq-question">
                        <span>What is the process for applying for a Lease Rental Discounting loan with Jfinserv?</span>
                        <span class="home-faq-icon">▼</span>
                    </div>
                    <div class="home-faq-answer">
                        <div class="home-faq-answer-content">
                            The application process includes submitting the application form, providing required documents,
                            credit appraisal, property valuation, and loan approval. Jfinserv’s experts guide you through
                            every step to ensure a smooth and hassle-free experience.
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
        // Sticky header scroll effect
    
        // Sticky header scroll effect
       

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
