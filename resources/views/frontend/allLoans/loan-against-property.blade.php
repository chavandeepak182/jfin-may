@extends('frontend.layouts.header')
@section('title', "Loan Against Property in Pune | Contract Loan in Pune - Jfinserv")
@section('description', "Explore competitive Contract Loan in Pune and loan against property services in Pune. Secure your dream home with our expert Contractual loan services.")
@section('keywords', "Contract Loan in Pune, Loan against property in Pune, Contractual loan in Pune, Contractual loan services in PCMC")

@section('content')
<!-- Header Start -->
<!-- <div class="details-hero d-flex justify-content-center align-items-center" style="background-image: url({{ asset('theme') }}/frontend/img/loan-background.webp);">
    <div class="container d-flex align-items-center justify-content-between py-5">
        <div class="row">
            <div class="col-md-6 py-5">
                <h2 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Unlock the Value of Your Property with a Loan Against Property</h2>
                <p class="mt-4 text-white"><strong>In need of quick funds? Look no further than Loan Against Property, commonly referred to simply as Contracts.</strong></p>
                <a href="/loan-application" class="btn btn-light rounded py-3 px-5 mt-5 flex-shrink-0">Apply Now</a>
            </div>
            <div class="col-md-6 px-5">
                <img src="{{ asset('theme') }}/frontend/img/personal-loan.png" width="528px">
            </div>
        </div>
    </div>
</div> -->

<!-- HOME EXTENSION HERO -->
<div class="hl-hero-wrapper" style="background-image: url('../theme/frontend/img/lap.webp');">
    <div class="container">
        <div class="row align-items-center hl-hero-height">

            <div class="col-lg-7 col-md-8">
                <h1 class="hl-hero-heading">
                    Loan Against Property: Access the Value of<br>
                    Your Assets Effortlessly
                </h1>

                <ul class="hl-hero-list">
                    <li>Apply online for a mortgage loan and avail funding based on a high percentage of your property’s worth</li>
                    <li>Enjoy attractive interest rates starting from 9.75%*</li>
                    <li>Experience a smooth, fully digital loan application from start to finish</li>
                    <li>Quick and convenient processing with minimal paperwork required**</li>
                </ul>

                <a href="#" class="hl-hero-button">
                    Apply for Loan Against Property
                </a>
            </div>

        </div>
    </div>
</div>

<!-- HOME LOAN OVERVIEW -->
<div class="lap-wrapper" style="margin-top:40px;">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="lap-breadcrumb">
            <a href="#">Home</a> &gt;
            <a href="#">Products</a> &gt;
            <span>Loan Against Property</span>
        </div>

        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-6">
                <h1 class="lap-heading">
                    Turn Your Property into a Powerful Financial Advantage
                </h1>

                <p class="lap-description">
                    Your property can do more than just stand still—it can help you move ahead.
                    With Sammaan Capital’s Loan Against Property, you can unlock substantial
                    funding to support business expansion or personal financial goals. Our
                    transparent processes, quick turnaround, and customer-first approach
                    make borrowing simple, reliable, and stress-free.
                </p>

                <p class="lap-rate-label">Loan Against Property Starting From</p>
                <h2 class="lap-rate">9.75%* Interest Onwards</h2>

                <p class="lap-note">✔ MSMEs eligible under Priority Sector Lending norms</p>

                <p class="lap-disclaimer">
                    *The applicable interest rate is determined based on applicant profile,
                    loan value, repayment tenure, property type, and overall risk evaluation.
                </p>

                <a href="#" class="lap-cta-btn">Get a Loan Against Property</a>
            </div>

            <!-- Right Feature Cards -->
            <div class="col-lg-6">
                <div class="lap-features">

                    <div class="lap-feature-card">
                        <span class="lap-icon">📈</span>
                        <h4>Increase Your Loan Eligibility</h4>
                    </div>

                    <div class="lap-feature-card">
                        <span class="lap-icon">💰</span>
                        <h4>Best-in-Class Interest Rates</h4>
                    </div>

                    <div class="lap-feature-card">
                        <span class="lap-icon">📄</span>
                        <h4>Hassle-Free Documentation</h4>
                    </div>

                    <div class="lap-feature-card">
                        <span class="lap-icon">📅</span>
                        <h4>Flexible Repayment Tenure</h4>
                    </div>

                    <div class="lap-feature-card">
                        <span class="lap-icon">⚡</span>
                        <h4>Fast & Transparent Approvals</h4>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<br>


<!-- Header End -->


  <!-- feature -->

<style>
   
    .section {
        max-width: 1200px;
        margin: 0 auto;
        padding: 80px 20px;
        text-align: center;
    }
    .section h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 50px;
        color: #333;
    }
    .cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }
    .card {
        background-color: #f3f4ff;
        padding: 30px 20px;
        border-radius: 12px;
        width: 280px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        text-align: left;
        position: relative;
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #2c2c2c;
    }
    .card p {
        font-size: 15px;
        line-height: 1.6;
        color: #666;
    }
    .card::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 80px;
        right: 20px;
        bottom: 20px;
        background: url('data:image/svg+xml;utf8,<svg fill="none" stroke="%23ddd" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 6v6l4 2"/></svg>') no-repeat center center;
        background-size: contain;
        opacity: 0.1;
    }
</style>

<div class="section">
    <h2 style="font-size:40px">Key Features & Benefits</h2>
    <div class="cards">
        <div class="card">
            <h3>Lightning-Fast Approvals</h3>
            <p>Get your loan processed without delays. Our streamlined approval system ensures you receive funds quickly and efficiently.</p>
        </div>
        <div class="card">
            <h3>Simplified Documentation</h3>
            <p>No more tedious paperwork. We have designed a minimal and user-friendly documentation process to save your time and effort.</p>
        </div>
        <div class="card">
            <h3>Flexible Tenure & Repayment</h3>
            <p>Choose repayment schedules that suit your lifestyle. Our flexible tenures and installment options are designed for your convenience.</p>
        </div>
        <div class="card">
            <h3>Competitive Interest Rates</h3>
            <p>Benefit from attractive interest rates that make your home loan more affordable while keeping your finances stress-free.</p>
        </div>
        <div class="card">
            <h3>Transparent Process</h3>
            <p>We believe in full transparency. No hidden charges or surprises—just clear terms and a smooth loan experience.</p>
        </div>
        <div class="card">
            <h3>Expert Support</h3>
            <p>Our team of financial experts is always ready to guide you through every step, ensuring your loan journey is seamless and informed.</p>
        </div>
    </div>
</div>



<!-- eligibilty -->
 <div class="container py-5 eligibility-section">

    <!-- TOP BANNER -->
    <div class="eligibility-banner">
        <div>
            <h4>Eligibility Criteria for Loan Against Property (LAP)</h4>
            <p>Read on to know the criteria required to apply for a Loan Against Property.</p>
        </div>
        <a href="#" class="know-more-btn">Know More</a>
    </div>

    <!-- ELIGIBILITY CONTENT -->
    <h2 class="text-center mb-5" style="font-size:40px">Eligibility Criteria for Loan Against Property</h2>

    <h5>Nationality</h5>
    <ul>
        <li>You need to be a Citizen of India with documents to prove your claim.</li>
    </ul>

    <h5>Occupation and Income</h5>
    <ul>
        <li>Your lender will require you to furnish details regarding your occupation and income to prove your professional and financial stability to determine your creditworthiness.</li>
    </ul>

    <h5>Credit History</h5>
    <ul>
        <li>Your three-digit Credit Score, indicative of your track record in respect of repayment of loans and other forms of credit, will be a deciding factor for LAP eligibility.</li>
    </ul>

    <h5>Banking Relationship</h5>
    <ul>
        <li>Having a healthy relationship with your lender improves approval chances and may offer better loan terms, interest rates, tenure, processing fees, and fewer hidden charges.</li>
    </ul>

    <h5>Market Value of Property</h5>
    <ul>
        <li>Your lender decides the loan amount and terms based on the current market value of your collateral property.</li>
        <li>The market value of the mortgaged property must be higher than the loan amount requested.</li>
    </ul>

    <h5>Title of Property</h5>
    <ul>
        <li>You must be the current owner of the property.</li>
        <li>In case of co-ownership, clear multiple ownership title must be proven.</li>
        <li>The property must not be mortgaged with any other financial institution.</li>
    </ul>

</div>




<!-- document  -->
 <div class="container my-5">

    <h2 class="text-center mb-5" style="font-size:40px">
        <strong>Documents Required for  Loan Against Property</strong>
    </h2>

    <!-- Tabs -->
    <div class="doc-tabs">
        <button class="tab-btn active" data-tab="all">For All Applicants</button>
        <button class="tab-btn" data-tab="salaried">Salaried Applicants</button>
        <button class="tab-btn" data-tab="self-professional">Self-Employed Professional</button>
        <button class="tab-btn" data-tab="self-non">Self-Employed Non-Professional</button>
        <button class="tab-btn" data-tab="other">Other Related Documents</button>
    </div>

    <!-- Content -->
    <div class="tab-content">

        <!-- For All Applicants -->
        <div class="tab-pane active" id="all">
            <ul class="two-column-list">
                <li>Current Passport size photograph of all Applicants</li>
                <li>Property documents: True Copies</li>
                <li>Duly filled & signed Application Form</li>
                <li>A Sale Deed, Khata, Transfer of Ownership</li>
                <li>Proof of Identity: Aadhaar card/Passport/Driving License/Voter ID/PAN Card Copy</li>
                <li>No Objection Certificate (NOC) from the builder / Housing Society (Original Copy)</li>
                <li>Aadhar Card or other OVDs containing identity & address</li>
                <li>Land Tax Paid Receipt</li>
                <li>Processing fee cheque</li>
                <li>Possession Certificate</li>
            </ul>
        </div>

        <!-- Salaried Applicants -->
        <div class="tab-pane" id="salaried">
            <ul class="two-column-list">
                <li>Income Documents: Duly attested</li>
                <li>Form 16</li>
                <li>Form 26AS</li>
                <li>Bank statement of last 6 months</li>
                <li>Offer letter</li>
            </ul>
        </div>

        <!-- Self-Employed Professional -->
        <div class="tab-pane" id="self-professional">
            <ul class="two-column-list">
                <li>2 years IT return with computation</li>
                <li>Balance sheet of last 2 years</li>
                <li>Profit and loss of last 2 years</li>
                <li>Bank statement of last 12 months</li>
            </ul>
        </div>

        <!-- Self-Employed Non-Professional -->
        <div class="tab-pane" id="self-non">
            <ul class="two-column-list">
                <li>2 years IT Return with computation</li>
                <li>Balance sheet of last 2 years</li>
                <li>Profit and loss of last 2 years</li>
                <li>Bank statement of last 12 months</li>
                <li>Qualification proof</li>
                <li>Gumasta license</li>
            </ul>
        </div>

        <!-- Other Related Documents -->
        <div class="tab-pane" id="other">
            <ul class="two-column-list">
                <li>Sanction Letter / Account Statement of running loans and bank statements reflecting loan repayments</li>
                <li>In case of recent employment, submit Form 16</li>
                <li>Bank statement for payment made to the builder (Own Contribution)</li>
                <li>If the property is decided then submit a photocopy of property title documents</li>
            </ul>
        </div>

    </div>
</div>



<script>
const tabs = document.querySelectorAll('.tab-btn');
const panes = document.querySelectorAll('.tab-pane');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        panes.forEach(p => p.classList.remove('active'));

        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});
</script>

<!-- calculator start -->


<style>

.calc-wrapper{
    max-width:1100px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:12px;
}
.calc-tabs{
    display:flex;
    gap:12px;
    margin-bottom:25px;
}
.calc-tabs button{
    padding:10px 24px;
    border-radius:10px;
    border:none;
    background:#295cab;
    font-weight:600;
    cursor:pointer;
    color: #fff;
}
.calc-tabs button.active{
    background:#295cab;
    color:#fff;
}
.calc-content{display:none;}
.calc-content.active{display:block;}
.calc-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
}
.calc-left label{
    display:block;
    margin-top:15px;
    font-weight:600;
}
.calc-left input{
    width:100%;
    padding:10px;
    margin-top:6px;
}
.calc-right{
    background:#f3f6ff;
    padding:30px;
    border-radius:12px;
}
.calc-right h1{
    font-size:36px;
    color:#295cab;
}
.lap-heading{
    font-size: 40px;
    text-align: center;
    font-weight: 700;
    line-height: 1.3;
}

.apply-btn{
    margin-top:20px;
    width:100%;
    padding:14px;
    background:#295cab;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}
@media(max-width:768px){
    .calc-grid{grid-template-columns:1fr;}
}
</style>
<h1 class="lap-heading">
                   Loan Planning Made Simple with Our Calculators
                </h1>

<div class="calc-wrapper">

    <div class="calc-tabs">
        <button id="emiTab" class="active">EMI</button>
        <button id="eligTab">Eligibility</button>
    </div>

    <!-- EMI -->
    <div id="emi" class="calc-content active">
        <h3>Estimate monthly payments easily for your planned loan amount.</h3>

        <div class="calc-grid">
            <div class="calc-left">
                <label>Loan Amount (₹)</label>
                <input type="number" id="loanAmount" value="1000000">

                <label>Tenure (Years)</label>
                <input type="number" id="tenure" value="15">

                <label>Interest Rate (%)</label>
                <input type="number" id="rate" value="9.75" step="0.1">
            </div>

            <div class="calc-right">
                <h4>Your EMI</h4>
                <h1 id="emiResult">₹ 0</h1>
                <p>Total Payment: <strong id="totalPayment">₹ 0</strong></p>
                <p>Interest Payable: <strong id="totalInterest">₹ 0</strong></p>
                <button class="apply-btn">Apply Now</button>
            </div>
        </div>
    </div>

    <!-- ELIGIBILITY -->
    <div id="eligibility" class="calc-content">
        <h3>Check how much loan you are eligible for.</h3>

        <div class="calc-grid">
            <div class="calc-left">
                <label>Monthly Income (₹)</label>
                <input type="number" id="income" value="50000">

                <label>Existing EMI (₹)</label>
                <input type="number" id="existingEmi" value="5000">

                <label>Interest Rate (%)</label>
                <input type="number" id="eligRate" value="9.75">

                <label>Tenure (Years)</label>
                <input type="number" id="eligTenure" value="20">

                <button class="apply-btn" id="calcEligibility">Calculate Eligibility</button>
            </div>

            <div class="calc-right">
                <h4>Eligible Loan Amount</h4>
                <h1 id="eligResult">₹ 0</h1>
            </div>
        </div>
    </div>

</div>

<script>
/* TAB SWITCH */
document.getElementById("emiTab").onclick = function(){
    document.getElementById("emi").classList.add("active");
    document.getElementById("eligibility").classList.remove("active");
    this.classList.add("active");
    document.getElementById("eligTab").classList.remove("active");
};
document.getElementById("eligTab").onclick = function(){
    document.getElementById("eligibility").classList.add("active");
    document.getElementById("emi").classList.remove("active");
    this.classList.add("active");
    document.getElementById("emiTab").classList.remove("active");
};

/* EMI CALCULATION */
function calculateEMI(){
    let P = Number(document.getElementById("loanAmount").value);
    let R = Number(document.getElementById("rate").value) / 12 / 100;
    let N = Number(document.getElementById("tenure").value) * 12;

    let emi = (P * R * Math.pow(1+R, N)) / (Math.pow(1+R, N) - 1);
    let total = emi * N;
    let interest = total - P;

    document.getElementById("emiResult").innerText = "₹ " + Math.round(emi).toLocaleString();
    document.getElementById("totalPayment").innerText = "₹ " + Math.round(total).toLocaleString();
    document.getElementById("totalInterest").innerText = "₹ " + Math.round(interest).toLocaleString();
}
document.querySelectorAll("#emi input").forEach(i=>{
    i.addEventListener("input", calculateEMI);
});
calculateEMI();

/* ELIGIBILITY CALCULATION */
document.getElementById("calcEligibility").onclick = function(){
    let income = Number(document.getElementById("income").value);
    let existing = Number(document.getElementById("existingEmi").value);
    let rate = Number(document.getElementById("eligRate").value) / 12 / 100;
    let tenure = Number(document.getElementById("eligTenure").value) * 12;

    let maxEmi = (income * 0.6) - existing;
    if(maxEmi <= 0){
        document.getElementById("eligResult").innerText = "₹ 0";
        return;
    }

    let loan = (maxEmi * (Math.pow(1+rate, tenure) - 1)) / (rate * Math.pow(1+rate, tenure));
    document.getElementById("eligResult").innerText = "₹ " + Math.round(loan).toLocaleString();
};
</script>



 <!-- calcultor end -->

<!-- Service Start -->

<!-- Service End -->

<!-- FAQs Start -->
<div class="container-fluid faq-section bg-light py-5 mb-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-8 mx-auto wow fadeInLeft" data-wow-delay="0.2s">
                <div class="h-100">
                    <div class="mb-4 text-center">
                        <h2 class="display-4 mb-0">Loan ​​​​​​​Against Property FAQ's</h2>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Q: What is a Loan Against Property?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body rounded">
                                    A: Loan Against Property is a type of secured loan where borrowers pledge their property as collateral to obtain funds from a lender. This loan is typically used to purchase a home or refinance an existing Contract.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Q: What types of properties can be Contractd with Jfinserv?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A: Jfinserv offers Contract loans against various types of properties, including residential properties (apartments, houses), commercial properties (office spaces, shops), and land plots.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Q: What are the eligibility criteria for availing a Loan Against Property from Jfinserv?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A: The eligibility criteria for a Loan Against Property may include factors such as the value of the property, the borrower's income, credit score, employment status, and repayment capacity.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Q: What documents are required to apply for a Loan Against Property with Jfinserv?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A: Common documents required for a Loan Against Property application include proof of identity, proof of address, income documents (such as salary slips, income tax returns), property documents, and bank statements.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Q: What is the maximum loan amount and tenure offered for Loan Against Property by Jfinserv?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A: The maximum loan amount and tenure offered for Loan Against Property depends on factors like value of the property and the borrower's repayment capacity.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Q: What is the process for applying for a Loan Against Property with Jfinserv?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A: The process for applying for a Loan Against Property with Jfinserv involves filling out an application form, submitting the required documents, undergoing property valuation and legal verification, and loan approval. Our dedicated team of experts will guide you through the process to ensure a smooth experience.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQs End -->

@endsection