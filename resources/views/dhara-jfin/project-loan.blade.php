@include('dhara-jfin.layout.header')


<main>
        <section class="video-hero">
        <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
        <source src="{{ asset('theme/dhara-jfin/videos/project_loan_banner.mp4') }}" type="video/mp4">
        </video>
    <div class="video-banner-overlay">
        <div class="video-overlay-content">
            <h1>Fuel Your Construction Projects with <span>Jfinserv</span></h1>
            <p>Tailored financial solutions for large-scale construction and infrastructure projects.</p>
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
                        <h2 class="finserv-trusted" style="color:#295cab;">Turn Your Project Vision into Reality with <strong style="color:#00abeb">Smart Financing</strong></h2>
                        <p class="home-section-subtitle">Jfinserv specializes in providing project finance for real estate developers and infrastructure companies. We understand the complex requirements of large-scale projects and offer flexible funding solutions to ensure your project milestones are met on time.</p>
                        
                        <p class="home-overview-intro">Our project loans are designed to cover the entire lifecycle of your development, from land acquisition to completion.</p>
                </div>
                <div class="about-grid">
                    <div class="about-content-left">
                        <ul class="home-checklist">
                            <li class="home-checklist-item"><i class="fas fa-check"></i> High Quantum of Funding based on project viability</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Competitive interest rates with flexible repayment terms</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Funding available for residential, commercial, and industrial projects</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Moratorium periods aligned with construction milestones</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Quick assessment and disbursement process</li>
                            <li class="home-checklist-item"><i class="fas fa-check"></i> Expert advisory on project structuring and compliance</li>
                        </ul>
                    </div>
                    <div class="about-content-right">
                        <div class="about-image-wrapper">
                            <img src="{{ asset('theme/dhara-jfin/img/project_loan_page.jpg') }}" alt="Project Loan">
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
                <h2 class="finserv-trusted" style="color:#295cab;">Why Choose Our <strong style="color:#00abeb">Project</strong> Loan?</h2>
                <p class="home-section-subtitle">
                    Turn Your Project Vision into Reality with Smart Financing
                </p>
            </div>

            <p class="home-overview-intro">
                Your project deserves the right financial support to thrive. With JFinserv Consultant Pvt. Ltd., our Project Loan helps you access the funding needed to kickstart, expand, or complete your project efficiently. Enjoy a seamless borrowing experience with transparent processes, quick approvals, and customer-focused solutions.
            </p>

            <div class="home-feature-cards">
                <div class="home-feature-card">
                    <div class="home-feature-icon">📈</div>
                    <h3 class="home-feature-title">Increase Your Funding Potential</h3>
                </div>

                <div class="home-feature-card">
                    <div class="home-feature-icon">💰</div>
                    <h3 class="home-feature-title">Competitive Interest Rates</h3>
                    
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
                <h2 class="finserv-trusted" style="color:#295cab;">Our Project Loan <strong style="color:#00abeb">Benefits</strong></h2>
                <p class="home-section-subtitle">
                    Everything you need for a seamless Project Loan
                </p>
            </div>

            <div class="home-benefit-grid">
                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">🏠</div> -->
                        <h3 class="home-benefit-title">Flexible Financing Solutions</h3>
                    </div>
                    <p class="home-benefit-description">
                        Tailor your Project Loan to meet your specific requirements with adaptable terms and conditions that suit your project’s unique needs.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">📄</div> -->
                        <h3 class="home-benefit-title">Attractive Interest Rates</h3>
                    </div>
                    <p class="home-benefit-description">
                        Leverage competitive interest rates designed to optimize your project’s financial efficiency and profitability.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">🔄</div> -->
                        <h3 class="home-benefit-title">Extended Repayment Terms</h3>
                    </div>
                    <p class="home-benefit-description">
                        Opt for longer loan tenures to enjoy manageable monthly payments, easing pressure on your cash flow while completing your project smoothly.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">💳</div> -->
                        <h3 class="home-benefit-title">Expert Advisory Services</h3>
                    </div>
                    <p class="home-benefit-description">
                        Access professional guidance on risk management, financial structuring, and project planning to ensure the successful execution of your project.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">🎯</div> -->
                        <h3 class="home-benefit-title">Large Loan Amounts</h3>
                    </div>
                    <p class="home-benefit-description">
                        Secure substantial funding to support large-scale projects or expansions, enabling smooth execution without financial constraints.
                    </p>
                </div>

                <div class="home-benefit-card">
                    <div class="home-benefit-header">
                        <!-- <div class="home-benefit-icon">👨‍💼</div> -->
                        <h3 class="home-benefit-title">Fast Approval Process</h3>
                    </div>
                    <p class="home-benefit-description">
                        Benefit from a quick and streamlined loan approval process, giving you timely access to funds when your project needs them most.
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
                <button class="home-tab" data-tab="company-firm">Company / Firm Documents</button>
                <button class="home-tab" data-tab="financial">Financial Documents</button>
                <button class="home-tab" data-tab="project-specific">Project-Specific Documents</button>
                <button class="home-tab" data-tab="other">Other Supporting Documents</button>
            </div>

            <!-- for all applicants -->
            <div class="home-tab-content active" id="for-all-applicants">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Eligible applicants: Individuals, Partnership Firms, LLPs, Private Limited Companies, and MSMEs</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Business profile: Startups and established businesses with a viable project proposal</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Experience: Minimum 2–3 years in the relevant industry or business segment preferred</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Financial strength: Stable income or projected cash flows sufficient for loan repayment</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Project viability: Strong feasibility, cost structure, and execution plan required</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit profile: Credit score of 700+ generally preferred for approval</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Duly completed and signed Project Loan application form</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Identity proof (Aadhaar Card / PAN Card / Passport)</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>PAN Card of the company / firm</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Passport-size photographs of promoters / directors</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Address proof of promoters and registered business location</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Copies of existing loan sanction letters, if applicable</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Processing fee cheque, as applicable</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- company firm-->
            <div class="home-tab-content" id="company-firm">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Eligible applicants: Individuals, Partnership Firms, LLPs, Private Limited Companies, and MSMEs</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>MBusiness profile: Startups and established businesses with a viable project proposal</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Experience: Minimum 2–3 years in the relevant industry or business segment preferred</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Financial strength: Stable income or projected cash flows sufficient for loan repayment</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Project viability: Strong feasibility, cost structure, and execution plan required</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit profile: Credit score of 700+ generally preferred for approval</span>
                            </li>
                        </ul>
                    </div>


                    <!-- self employed  -->

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Certificate of Incorporation / Registration</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Partnership Deed / LLP Agreement, if applicable</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Memorandum & Articles of Association (MOA & AOA) for companies</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>GST Registration / Trade License</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Other statutory registrations relevant to the business</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            

            <!-- financial -->
            <div class="home-tab-content" id="financial">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Eligible applicants: Individuals, Partnership Firms, LLPs, Private Limited Companies, and MSMEs</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>MBusiness profile: Startups and established businesses with a viable project proposal</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Experience: Minimum 2–3 years in the relevant industry or business segment preferred</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Financial strength: Stable income or projected cash flows sufficient for loan repayment</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Project viability: Strong feasibility, cost structure, and execution plan required</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit profile: Credit score of 700+ generally preferred for approval</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Bank account statements for the last 6–12 months</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Audited financial statements (last 2–3 years), if available</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Projected financial statements for the proposed project</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Income proof of promoters / directors, if required</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="home-tab-content" id="project-specific">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Eligible applicants: Individuals, Partnership Firms, LLPs, Private Limited Companies, and MSMEs</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>MBusiness profile: Startups and established businesses with a viable project proposal</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Experience: Minimum 2–3 years in the relevant industry or business segment preferred</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Financial strength: Stable income or projected cash flows sufficient for loan repayment</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Project viability: Strong feasibility, cost structure, and execution plan required</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit profile: Credit score of 700+ generally preferred for approval</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Detailed Project Report including scope and execution plan</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Projected cash flow statement</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Repayment plan aligned with projected revenues</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Feasibility and risk assessment reports, where applicable</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Cost estimation and funding structure</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="home-tab-content" id="other">
                <div class="home-eligibility-grid">
                    <div class="home-eligibility-section">
                        <h3>✓ Eligibility Criteria</h3>
                        <ul class="home-checklist">
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Eligible applicants: Individuals, Partnership Firms, LLPs, Private Limited Companies, and MSMEs</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Business profile: Startups and established businesses with a viable project proposal</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Experience: Minimum 2–3 years in the relevant industry or business segment preferred</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Financial strength: Stable income or projected cash flows sufficient for loan repayment</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Project viability: Strong feasibility, cost structure, and execution plan required</span>
                            </li>
                            <li class="home-checklist-item">
                                <span class="home-checklist-icon">✓</span>
                                <span>Credit profile: Credit score of 700+ generally preferred for approval</span>
                            </li>
                        </ul>
                    </div>

                    <div class="home-documents-section">
                        <h3>📄 Required Documents</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Detailed Project Report (DPR)s</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Estimated revenue & expense projections</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Land ownership / lease documents (if applicable)</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Cost of project and means of finance statement</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Construction schedule / execution timeline</span>
                            </li>
                            <li class="home-document-item">
                                <span class="home-document-icon">📋</span>
                                <span>Statutory approvals & licenses related to project</span>
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
                    
                    <a href="{{url('/dhara-calculator')}}#eligibility" class="home-btn home-btn-primary home-btn-large">Calculate Detailed EMI →</a>
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
                    Get answers to common queries about our project loan products
                </p>
            </div>

            <div class="home-faq-container">
                <!-- Eligibility Category -->
                <div class="home-faq-category">
                    <!-- <h3 class="home-faq-category-title">Eligibility & Requirements</h3> -->
                    
                    <div class="home-faq-item active">
                        <div class="home-faq-question">
                            <span>What is a project loan or construction loan?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                A project loan, also known as a construction loan, is a type of financing provided to individuals or businesses to fund the construction, renovation, or development of a property or infrastructure project.                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                    What types of projects are eligible for project loans from Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                            Jfinserv offers project loans for a wide range of construction projects, including residential housing developments, commercial buildings, infrastructure projects, industrial facilities, and more.
                            </div>
                        </div>
                    </div>
                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What are the eligibility criteria for availing a project loan from Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                             The eligibility criteria for a project loan may include factors such as the borrower's creditworthiness, project feasibility, repayment capacity, collateral, and compliance with regulatory requirements.                            
                             </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What documents are required to apply for a project loan with Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Common documents required for a project loan application may include project plans and estimates, land ownership documents, project feasibility reports, financial statements, etc.
                            </div>
                        </div>
                    </div>
                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What is the maximum loan amount and tenure offered for project loans by Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                The maximum loan amount and tenure offered for project loans may vary depending on factors such as the nature and scale of the project and the borrower's repayment capacity.
                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>
                                What is the process for applying for a project loan with Jfinserv?
                                </span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                Yes! For floating rate home loans, there are zero prepayment charges. You can make part-payments or foreclose your loan anytime without any penalty. For fixed-rate loans, prepayment charges may apply as per the loan agreement terms.
                            </div>
                        </div>
                    </div>

                    <div class="home-faq-item">
                        <div class="home-faq-question">
                            <span>What is the maximum loan tenure available?</span>
                            <span class="home-faq-icon">▼</span>
                        </div>
                        <div class="home-faq-answer">
                            <div class="home-faq-answer-content">
                                The process for applying for a project loan with Jfinserv involves filling out an application form, submitting the required documents, undergoing project evaluation and appraisal, and loan approval. Our dedicated team of experts will guide you through the process to ensure a smooth experience.
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!-- Application Process Category -->
                <!-- <div class="home-faq-category"> -->
                    <!-- <h3 class="home-faq-category-title">Application Process</h3> -->
                    
                    

                <!-- Interest Rates Category -->
                <!-- <div class="home-faq-category"> -->
                    <!-- <h3 class="home-faq-category-title">Interest Rates & Charges</h3> -->
                    
                    
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
