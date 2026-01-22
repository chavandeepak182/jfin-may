@include('dhara-jfin.layout.header')
<main>
<section>
    <div class="container">
        <div class="apply-grid">
            <div class="apply-left-grid">
                <div class="apply-left-content">
                    <span><i class="fa fa-star star-checked"></i><i class="fa fa-star star-checked"></i><i class="fa fa-star star-checked"></i><i class="fa fa-star star-checked"></i><i class="fa fa-star star-checked"></i> Trusted by 50,000+ Customers</span>
                    <h2 class="finserv-trusted" style="color:#295cab;">Instant Loan with Minimal Documnetation</h2>
                    <p>
                        Get approved in minutes with our streamlined digital process. No paperwork hassle, no hidden charges. Just fast, transparent lending that puts you first.
                    </p>
                    <a href="#" class=" btn btn-primary-hero">Apply Now
                    </a>
                    <div class="apply-trust-indicators">
                        <div class="trust-item">
                            <i class="fa-regular fa-clock"></i>  Takes less than 3 minutes
                        </div>
                        <div class="trust-item">
                            <i class="fa-solid fa-fingerprint"></i>  Secure Application
                        </div> 
                        <div class="trust-item">
                            <i class="fa-regular fa-handshake"></i></i>  Trusted Financial Partner
                        </div>  
                    </div>
                </div>
            </div>
            <div class="apply-right-grid">
                <div class="apply-right-img">
                    <img src="{{asset('theme/dhara-jfin/img/firstloan.jpg')}}"></img>
                </div>
            </div>

        </div>  
    </div>
</section>

<section>
    <!-- steps part  -->
</section>

<section class="home-section">
    <!-- Required docs  -->
     <div class="container">
            <div class="home-section-header">
                    <h2 class="finserv-trusted" style="color:#295cab;">Required Documents</h2>
                    <p>Keep these documents handy for quick approval</p>
            </div>
            <div class="home-tabs">
                <button class="home-tab active" data-tab="salaried">
                    Salaried Individuals
                </button>
                <button class="home-tab" data-tab="self-employeed">
                    Self-Employeed
                </button>
            </div>
            <div class="home-tab-content active" id="salaried">
                <div class="apply-eligibility-grid">
                    <div class="home-documents-section">
                        <h3><i class="fa-solid fa-circle-check"></i> Identity Proof <br>(Any one of the following)</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">Aadhaar Card</li>
                            <li class="home-document-item">PAN Card</li>
                            <li class="home-document-item">Passport</li>
                            <li class="home-document-item">Driving License</li>
                        </ul>
                    </div>
                    <div class="home-documents-section">
                        <h3><i class="fa-solid fa-circle-check"></i> Address Proof <br>(Any one of the following)</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">Aadhaar Card</li>
                            <li class="home-document-item">Passport</li>
                            <li class="home-document-item">Utility Bill (Electricity, Water, or Gas – last 3 months)</li>
                            <li class="home-document-item">Rent Agreement</li>
                        </ul>
                    </div>
                    <div class="home-documents-section">
                        <h3><i class="fa-solid fa-circle-check"></i> Income Proof</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">Salary Slips (Last 3-6 months)</li>
                            <li class="home-document-item">Bank Statement (Last 6 months)</li>
                            <li class="home-document-item">ITR & Form 16 (Last 2 years)</li>
                        </ul>
                    </div>
                    <div class="home-documents-section">
                        <h3><i class="fa-solid fa-circle-check"></i> Employment Proof</h3>
                        <ul class="home-document-list">
                            <li class="home-document-item">Employment Offer Letter</li>
                            <li class="home-document-item">HR Verification Letter</li>
                        </ul>
                    </div>
                </div>
            </div>

     </div>
</section>
</main>