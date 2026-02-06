@include('dhara-jfin.layout.header')


<main>
        <section class="video-hero">
        <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
        <source src="{{ asset('theme/dhara-jfin/videos/loan_against_property.mp4') }}" type="video/mp4">
        </video>
    <div class="video-banner-overlay">
        <div class="video-overlay-content">
            <h1>Maximize Your Asset's Value with <span>Jfinserv</span></h1>
            <p>Loan Against Property: Access the Value of Your Assets Effortlessly</p>
            <a href="{{ route('authv3.login.form') }}" class="btn-primary">
                Apply Now
            </a>
        </div>
    </div>
</section>

        <section class="finserv-wrapper">
            <div class="container-tab">
                <div class="finserv-header">
                        <h4 class="finserv-eyebrow">Product Overview</h4>
                        <h2 class="finserv-trusted" style="color:#295cab;">Unlock the <strong style="color:#00abeb"> True Value </strong> of Your Property</h2>
                        <p class="home-section-subtitle">Jfinserv specializes in providing project finance for real estate developers and infrastructure companies. We understand the complex requirements of large-scale projects and offer flexible funding solutions to ensure your project milestones are met on time.</p>
                        
                        <p class="home-overview-intro">Our project loans are designed to cover the entire lifecycle of your development, from land acquisition to completion.</p>
                </div>
                <div class="about-grid">
                    <div class="about-content-left">
                        <ul class="home-checklist">
                            <li class="home-checklist-item"><i class="fas fa-check"></i> High loan amounts based on market value of the property</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Lower interest rates compared to unsecured loans</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Long repayment tenure up to 15-20 years</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Loans available for both residential and commercial properties</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Flexible end-use of funds for business or personal needs</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Quick processing and transparent documentation</li>
                        </ul>
                    </div>
                    <div class="about-content-right">
                        <div class="about-image-wrapper">
                            <img src="{{ asset('theme/dhara-jfin/img/property_loan_page.jpg') }}" alt="Project Loan">
                        </div>
                    </div>
                </div>
                <div class="about-content-button" style="margin-top: 2rem;">
                            <a href="{{ url('/dhara-contact') }}" class="btn btn-primary-hero" style="padding:1rem 3rem; font-size:1.5rem;">Enquire Now</a>
                        </div>
            </div>
        </section>

        <section class="home-section">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">Why Choose Our <strong style="color:#00abeb">Property</strong> Loan?</h2>
                <p class="home-section-subtitle">
                    A Loan Against Property (LAP) is one of the most cost-effective ways to raise funds for your personal or business needs. By leveraging your existing property as collateral, you can access high-value loans at much lower interest rates compared to personal loans.                </p>
            </div>

            <p class="home-overview-intro">
                Whether it's for business expansion, debt consolidation, or funding a child's education, our LAP solutions provide the liquidity you need while you continue to use your property.        
        </p>

            <div class="home-feature-cards">
                <div class="home-feature-card">
                    <div class="home-feature-icon">📈</div>
                    <h3 class="home-feature-title">Increase Your Loan Eligibility</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">💰</div>
                    <h3 class="home-feature-title">Best-in-Class Interest Rates</h3>
                    
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">📅</div>
                    <h3 class="home-feature-title">Flexible Repayment Tenure</h3>
                    
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">📄</div>
                    <h3 class="home-feature-title">Minimal & Hassle-Free Documentation</h3>
                   
                </div>
                <div class="home-feature-card">
                    <div class="home-feature-icon">⚡</div>
                    <h3 class="home-feature-title">Fast, Transparent, and Reliable Process</h3>
                   
                </div>
            </div>
        </div>
    </section>

    <!-- benefits section  -->
    <section class="home-section home-benefits-section">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="finserv-trusted" style="color:#295cab;">Our Property Loan <strong style="color:#00abeb">Benefits</strong></h2>
                <p class="home-section-subtitle">
                    Everything you need for a seamless Property Loan
                </p>
            </div>

            <div class="home-benefit-grid">
                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">🏠</div> -->
                        <h3 class="home-benefit-title">Lightning-Fast Approvals</h3>
                    </div>
                    <p class="home-benefit-description">
                        Get your loan processed without delays. Our streamlined approval system ensures you receive funds quickly and efficiently.                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">📄</div> -->
                        <h3 class="home-benefit-title">Simplified Documentation</h3>
                    </div>
                    <p class="home-benefit-description">
                    No more tedious paperwork. We have designed a minimal and user-friendly documentation process to save your time and effort.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">🔄</div> -->
                        <h3 class="home-benefit-title">Flexible Tenure & Repayment</h3>
                    </div>
                    <p class="home-benefit-description">
                        Choose repayment schedules that suit your lifestyle. Our flexible tenures and installment options are designed for your convenience.                    
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">💳</div> -->
                        <h3 class="home-benefit-title">Competitive Interest Rates</h3>
                    </div>
                    <p class="home-benefit-description">
                        Benefit from attractive interest rates that make your home loan more affordable while keeping your finances stress-free.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">🎯</div> -->
                        <h3 class="home-benefit-title">Transparent Process</h3>
                    </div>
                    <p class="home-benefit-description">
                        We believe in full transparency. No hidden charges or surprises—just clear terms and a smooth loan experience.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">👨‍💼</div> -->
                        <h3 class="home-benefit-title">Expert Support</h3>
                    </div>
                    <p class="home-benefit-description">
                        Our team of financial experts is always ready to guide you through every step, ensuring your loan journey is seamless and informed.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- eligibiity and docs  -->

    <section class="home-section" id="home-eligibility">
        <div class="container-tab">
            <div class="home-section-header">
                <h2 class="home-section-title">Eligibility & Documents</h2>
                <p class="home-section-subtitle">
                    Check if you qualify and what documents you'll need
                </p>
            </div>

            <div class="home-tabs">
                <button class="home-tab active" data-tab="for-all-applicants">For all Applicants</button>
                <button class="home-tab" data-tab="salaried-property">Salaried Applicants</button>
                <button class="home-tab" data-tab="self-employed-property">Self-Employed Professional</button>
                <button class="home-tab" data-tab="self-employed-np">Self-Employed Non-Professional</button>
                <button class="home-tab" data-tab="other-property">Other Related Documents</button>
            </div>

            <!-- for all applicants -->
            <div class="home-tab-content active" id="for-all-applicants">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Indian Citizenship: Applicant must be an Indian citizen with valid identity proof.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Occupation & Income Stability: Stable profession and verifiable income are required to assess repayment capacity.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit Score: A healthy credit history and acceptable credit score improve eligibility.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Banking Relationship: Strong relationship with the lender may result in better loan terms.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Property Market Value: Property value should be higher than the loan amount requested.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Clear Property Ownership: Applicant must be the legal owner; property should be free from existing mortgages.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Current Passport size photograph of all Applicants</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Duly filled & signed Application Form</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Proof of Identity: Aadhaar card/Passport/Driving License/Voter ID/PAN Card Copy</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Aadhar Card or other OVDs containing identity & address</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Processing fee cheque</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Property documents: True Copies</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>A Sale Deed, Khata, Transfer of Ownership</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>No Objection Certificate (NOC) from the builder / Housing Society (Original Copy)</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Land Tax Paid Receipt</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Possession Certificate</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- company firm-->
            <div class="home-tab-content" id="salaried-property">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Indian Citizenship: Applicant must be an Indian citizen with valid identity proof.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Occupation & Income Stability: Stable profession and verifiable income are required to assess repayment capacity.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit Score: A healthy credit history and acceptable credit score improve eligibility.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Banking Relationship: Strong relationship with the lender may result in better loan terms.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Property Market Value: Property value should be higher than the loan amount requested.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Clear Property Ownership: Applicant must be the legal owner; property should be free from existing mortgages.</span>
                            </li>
                        </ul>
                    </div>


                    <!-- self employed  -->

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Income Documents: Duly attested</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Form 16</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Form 26AS</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Bank statement of last 6 months</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Offer letter</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            

            <!-- financial -->
            <div class="home-tab-content" id="self-employed-property">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Indian Citizenship: Applicant must be an Indian citizen with valid identity proof.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Occupation & Income Stability: Stable profession and verifiable income are required to assess repayment capacity.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit Score: A healthy credit history and acceptable credit score improve eligibility.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Banking Relationship: Strong relationship with the lender may result in better loan terms.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Property Market Value: Property value should be higher than the loan amount requested.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Clear Property Ownership: Applicant must be the legal owner; property should be free from existing mortgages.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>2 years IT return with computation</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Balance sheet of last 2 years</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Profit and loss of last 2 years</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Bank statement of last 12 months</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="home-tab-content" id="self-employed-np">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Indian Citizenship: Applicant must be an Indian citizen with valid identity proof.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Occupation & Income Stability: Stable profession and verifiable income are required to assess repayment capacity.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit Score: A healthy credit history and acceptable credit score improve eligibility.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Banking Relationship: Strong relationship with the lender may result in better loan terms.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Property Market Value: Property value should be higher than the loan amount requested.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Clear Property Ownership: Applicant must be the legal owner; property should be free from existing mortgages.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>2 years IT Return with computation</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Profit and loss of last 2 years</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Qualification proof</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Balance sheet of last 2 years</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Bank statement of last 12 months</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Gumasta license</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="home-tab-content" id="other-property">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Indian Citizenship: Applicant must be an Indian citizen with valid identity proof.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Occupation & Income Stability: Stable profession and verifiable income are required to assess repayment capacity.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit Score: A healthy credit history and acceptable credit score improve eligibility.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Banking Relationship: Strong relationship with the lender may result in better loan terms.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Property Market Value: Property value should be higher than the loan amount requested.</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Clear Property Ownership: Applicant must be the legal owner; property should be free from existing mortgages.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Sanction Letter / Account Statement of running loans and bank statements reflecting loan repayments</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Bank statement for payment made to the builder (Own Contribution)</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>In case of recent employment, submit Form 16</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>If the property is decided then submit a photocopy of property title documents</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- emi  -->
    <section class="home-section home-emi-preview-section" id="emi">
        <div class="container-tab">
            <div class="home-emi-preview-container">
                <div class="home-emi-preview-content">
                    <h2 class="home-section-title">Calculate Your Home Loan EMI</h2>
                    <p class="home-section-subtitle">
                        Get an instant estimate of your monthly payments and plan your finances better
                    </p>
                    
                    <a href="{{url('/eligibility-calculator')}}#eligibility" class="home-btn home-btn-primary home-btn-large">Calculate Detailed EMI →</a>
                </div>

                <div class="home-emi-preview-card">
                    <div class="home-emi-preview-title">Sample EMI Breakdown</div>
                    <div class="home-emi-preview-amount">₹45,500<span style="font-size: 1.5rem; font-weight: 500;">/month</span></div>
                    <div class="home-emi-preview-details">
                        Loan Amount: ₹50,00,000 | Tenure: 20 years | Rate: 8.25% p.a.
                    </div>

                    <div class="home-emi-stats">
                        <div class="home-emi-stat">
                            <div class="home-emi-stat-value">₹50L</div>
                            <div class="home-emi-stat-label">Principal</div>
                        </div>
                        <div class="home-emi-stat">
                            <div class="home-emi-stat-value">₹59L</div>
                            <div class="home-emi-stat-label">Interest</div>
                        </div>
                        <div class="home-emi-stat">
                            <div class="home-emi-stat-value">₹109L</div>
                            <div class="home-emi-stat-label">Total</div>
                        </div>
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
                    Get answers to common queries about our property loan products
                </p>
            </div>

            <div class="home-faq-container">
                <!-- Eligibility Category -->
                <div class="home-faq-category">
                    <!-- <h3 class="home-faq-category-title">Eligibility & Requirements</h3> -->
                    
                    <div class="home-faq-item active">
                        <div class="home-faq-question">
                            <span>What is a Loan Against Property?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Loan Against Property is a type of secured loan where borrowers pledge their property as collateral to obtain funds from a lender. This loan is typically used to purchase a home or refinance an existing Contract.
                            </div>
                            </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                    What types of properties can be Contractd with Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Jfinserv offers Contract loans against various types of properties, including residential properties (apartments, houses), commercial properties (office spaces, shops), and land plots.
                            </div>
                        </div>
                    </div>
                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What are the eligibility criteria for availing a Loan Against Property from Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                            The eligibility criteria for a Loan Against Property may include factors such as the value of the property, the borrower's income, credit score, employment status, and repayment capacity.
                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What documents are required to apply for a Loan Against Property with Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Common documents required for a Loan Against Property application include proof of identity, proof of address, income documents (such as salary slips, income tax returns), property documents, and bank statements.
                            </div>
                        </div>
                    </div>
                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What is the maximum loan amount and tenure offered for Loan Against Property by Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                The maximum loan amount and tenure offered for project loans may vary depending on factors like value of the property and the borrower's repayment capacity.
                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What is the process for applying for a Loan Against Property with Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                The process for applying for a Loan Against Property with Jfinserv involves filling out an application form, submitting the required documents, undergoing property valuation and legal verification, and loan approval. Our dedicated team of experts will guide you through the process to ensure a smooth experience.
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
