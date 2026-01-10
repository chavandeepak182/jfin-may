@extends('frontend.layouts.header')
@section('title', "Financial Services Companies in Pune - Jfinserv")
@section('description', "Discover top financial services companies in Pune. Explore a comprehensive list of Pune Housing Finance leading financial companies in Pune.")
@section('keywords', "financial services in pune, Home loan services in Pune, business loan provider in pune, Business loan services in Pune, Business loan in Pune")

@section('content')



<section class="page-banner" style="background-image: url('{{ asset('theme') }}/frontend/img/emi.jpg');">
    <div class="page-banner-overlay"></div>

    <div class="page-banner-container">
        <!-- <h1 class="page-banner-title">About Jfinserv</h1> -->
    </div>
</section>


<style>
<<<<<<< HEAD


/* PAGE TITLE */
.page-title{
    text-align:center;
    margin-bottom:30px;
}
.page-title h1{
    font-size:36px;
    color:#2c3e50;
}
.page-title p{
    color:#555;
    margin-top:10px;
}

/* MAIN LAYOUT */
.main-container{
    display:flex;
    gap:30px;
    max-width:1200px;
    margin:auto;
}

/* LEFT COLUMN - BUTTONS */
.sidebar{
    width:260px;
    background:#00abea;
    padding:25px;
    border-radius:12px;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.sidebar button{
    padding:15px;
    border-radius:30px;
    border:2px solid #fff;
    background:transparent;
    color:#fff;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.sidebar button.active,
.sidebar button:hover{
    background:#fff;
    color:#2c3e50;
}

/* RIGHT COLUMN - CALCULATOR */
.calculator-wrapper{
    flex:1;
}

.calculator{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
    display:none;
}

.calculator.active{
    display:block;
}

.calculator h2{
    color:#2c3e50;
    margin-bottom:10px;
}

.calculator p{
    margin-bottom:20px;
    color:#555;
}

/* INPUTS */
.input-group{
    margin-bottom:20px;
}

.input-group label{
    font-weight:600;
    display:block;
    margin-bottom:8px;
}

.input-group input[type="number"],
.input-group input[type="range"]{
    width:100%;
}

.input-group input[type="number"]{
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

.range-labels{
    display:flex;
    justify-content:space-between;
    font-size:13px;
    color:#777;
}

/* RESULTS */
.results{
    background:#eef5ff;
    padding:20px;
    border-radius:10px;
    border-left:5px solid #4a6491;
    margin-top:25px;
}

.value-display{
    font-size:28px;
    font-weight:bold;
    color:#2c3e50;
    margin:10px 0;
}

/* BUTTONS */
.btn-container{
    display:flex;
    gap:15px;
    margin-top:25px;
}

.btn{
    flex:1;
    padding:12px;
    border:none;
    border-radius:8px;
    font-weight:600;
    cursor:pointer;
    color:#fff;
}

.btn.download{background:#27ae60;}
.btn.share{background:#3498db;}
.btn.apply{background:#e74c3c;}

.btn:hover{opacity:0.9}

/* RESPONSIVE */
@media(max-width:900px){
    .main-container{
        flex-direction:column;
    }
    .sidebar{
        width:100%;
        flex-direction:row;
        justify-content:center;
    }
}
</style>

<div class="page-title mt-40">
    <!-- <h1></h1> -->
    <h1 style="font-size:40px;margin-top:40px;"><strong>EMI & Eligibility Calculator</strong></h1>
</div>

<div class="main-container">

    <!-- LEFT BUTTON COLUMN -->
    <div class="sidebar">
        <button class="nav-btn active" onclick="showCalculator('emi')">EMI Calculator</button>
        <button class="nav-btn" onclick="showCalculator('eligibility')">Eligibility Calculator</button>
    </div>

    <!-- RIGHT CALCULATOR COLUMN -->
    <div class="calculator-wrapper">

        <!-- EMI CALCULATOR -->
        <div id="emi-calculator" class="calculator active">
            <h2> EMI Calculator</h2>
            <p>Calculate your monthly EMI easily.</p>

            <div class="input-group">
                <label>Loan Amount (₹)</label>
                <input type="range" id="loanSlider" min="100000" max="45000000" step="100000" value="1000000">
                <div class="range-labels"><span>1L</span><span>45Cr</span></div>
                <input type="number" id="loanInput" value="1000000">
            </div>

            <div class="input-group">
                <label>Tenure (Years)</label>
                <input type="range" id="tenureSlider" min="1" max="30" value="15">
                <div class="range-labels"><span>1</span><span>30</span></div>
                <input type="number" id="tenureInput" value="15">
            </div>

            <div class="input-group">
                <label>Interest Rate (%)</label>
                <input type="range" id="rateSlider" min="6" max="22" step="0.1" value="10">
                <div class="range-labels"><span>6%</span><span>22%</span></div>
                <input type="number" id="rateInput" value="10">
            </div>

            <div class="results">
                <h3>Your EMI</h3>
                <div class="value-display" id="emiResult">₹ 0</div>
                <p>Total Payment: ₹ <span id="totalPay">0</span></p>
                <p>Interest Payable: ₹ <span id="interestPay">0</span></p>
            </div>

            <div class="btn-container">
                <button class="btn download">Download</button>
                <button class="btn share">Share</button>
                <button class="btn apply">Apply Now</button>
            </div>
        </div>

        <!-- ELIGIBILITY CALCULATOR -->
        <div id="eligibility-calculator" class="calculator">
            <h2>Eligibility Calculator</h2>
            <p>Check your maximum loan eligibility.</p>

            <div class="input-group">
                <label>Monthly Income (₹)</label>
                <input type="number" id="income" value="50000">
            </div>

            <div class="input-group">
                <label>Other EMIs (₹)</label>
                <input type="number" id="otherEmi" value="10000">
            </div>

            <div class="input-group">
                <label>Tenure (Years)</label>
                <input type="number" id="eligTenure" value="10">
            </div>

            <div class="input-group">
                <label>Interest Rate (%)</label>
                <input type="number" id="eligRate" value="10">
            </div>

            <div class="results">
                <h3>Eligible Loan Amount</h3>
                <div class="value-display" id="eligAmount">₹ 0</div>
                <p>Monthly EMI: ₹ <span id="eligEmi">0</span></p>
            </div>

            <div class="btn-container">
                <button class="btn download">Download</button>
                <button class="btn share">Share</button>
                <button class="btn apply">Apply Now</button>
            </div>
        </div>

    </div>
</div>
<br><br><br>

<script>
function showCalculator(type){
    document.querySelectorAll('.calculator').forEach(c=>c.classList.remove('active'));
    document.querySelectorAll('.nav-btn').forEach(b=>b.classList.remove('active'));

    if(type==='emi'){
        document.getElementById('emi-calculator').classList.add('active');
        document.querySelectorAll('.nav-btn')[0].classList.add('active');
    }else{
        document.getElementById('eligibility-calculator').classList.add('active');
        document.querySelectorAll('.nav-btn')[1].classList.add('active');
    }
}

/* EMI LOGIC */
const loanI=document.getElementById('loanInput');
const loanS=document.getElementById('loanSlider');
const tenI=document.getElementById('tenureInput');
const tenS=document.getElementById('tenureSlider');
const rateI=document.getElementById('rateInput');
const rateS=document.getElementById('rateSlider');

[loanI,tenI,rateI].forEach((el,i)=>{
    el.oninput=()=>{ [loanS,tenS,rateS][i].value=el.value; calcEMI(); }
});
[loanS,tenS,rateS].forEach((el,i)=>{
    el.oninput=()=>{ [loanI,tenI,rateI][i].value=el.value; calcEMI(); }
});

function calcEMI(){
    let P=+loanI.value;
    let r=+rateI.value/12/100;
    let n=+tenI.value*12;
    let emi=P*r*Math.pow(1+r,n)/(Math.pow(1+r,n)-1);
    let total=emi*n;
    document.getElementById('emiResult').innerText="₹ "+emi.toFixed(0);
    document.getElementById('totalPay').innerText=total.toFixed(0);
    document.getElementById('interestPay').innerText=(total-P).toFixed(0);
}
calcEMI();

/* ELIGIBILITY */
function calcEligibility(){
    let income=+incomeInput.value;
    let other=+otherEmi.value;
    let avail=income*0.5-other;
    document.getElementById('eligEmi').innerText=avail.toFixed(0);
    document.getElementById('eligAmount').innerText="₹ "+(avail*120).toFixed(0);
}
const incomeInput=document.getElementById('income');
const otherEmi=document.getElementById('otherEmi');
[incomeInput,otherEmi].forEach(i=>i.oninput=calcEligibility);
calcEligibility();
</script>

@endsection
=======
    
    

        .loan_calculator_page{

            --primary-deep: #0f172a;
        --primary-accent: #3b82f6;
        --primary-accent-dark: #2563eb;
        --accent-blue: #dbeafe;
        --accent-blue-light: #eff6ff;
        
        --text-muted: #64748b;
        --text-main: #1e293b;

        --bg-card: #ffffff;
        --bg-body: #f8fafc;

        
        --border-elegant: #e2e8f0;
        --shadow-premium: 0 4px 6px -1px rgba(0,0,0,0.05),
                      0 2px 4px -1px rgba(0,0,0,0.03);

        --shadow-hover: 0 20px 25px -5px rgba(0,0,0,0.1),
                    0 10px 10px -5px rgba(0,0,0,0.04);

        --radius-inner: 10px;
    
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.6;
            padding: 40px 20px;
        }

        .loan_calculator_page .container_calc {
            max-width: 1100px;
            margin: 0 auto;
        }

        .loan_calculator_page .header_calc {
            text-align: center;
            margin-bottom: 40px;
        }

        .header_calc h1 {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--primary-deep);
            margin-bottom: 12px;
        }

        .header_calc p {
            font-size: 1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
            font-weight: 450;
        }
        /* ========================================
           TAB NAVIGATION - Premium Segmented Control
        ======================================== */
        .tab-navigation {
            display: flex;
            background-color: #f1f5f9;
            padding: 5px;
            border-radius: 12px;
            margin-bottom: 32px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid var(--border-elegant);
        }

        .tab-button {
            flex: 1;
            padding: 10px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            border-radius: 9px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            border: none;
            background: transparent;
            user-select: none;
        }

        .tab-button:hover {
            color: #0f172a;
        }

        input[type="radio"] {
            display: none;
        }

        #emi-tab:checked ~ .tab-navigation label[for="emi-tab"],
        #eligibility-tab:checked ~ .tab-navigation label[for="eligibility-tab"] {
            background-color: var(--bg-card);
            color: #0f172a;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* ========================================
           CALCULATOR LAYOUT
        ======================================== */
        .emi-flex-container {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 32px;
            align-items: stretch;
        }

        .tab-content {
            display: none;
            animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #emi-tab:checked ~ .emi-calculator,
        #eligibility-tab:checked ~ .eligibility-calculator {
            display: block;
        }

        /* ========================================
           CARD STYLES - Premium Minimalism
        ======================================== */
        .card {
            background-color: var(--bg-card);
            
            border-radius: 14px;
            padding: 28px;
            border: 1px solid var(--border-elegant);
            box-shadow: var(--shadow-premium);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        /* ========================================
           FORM ELEMENTS - Precise & Clean
        ======================================== */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-weight: 600;
            font-size: 1rem;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid var(--border-elegant);
            border-radius: var(--radius-inner);
            font-size: 0.95rem;
            font-family: inherit;
            font-weight: 500;
            color: var(--text-main);
            transition: all 0.2s ease;
            background-color: #fcfcfc;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: var(--bg-card);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .input-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 6px;
            font-weight: 500;
        }

        /* ========================================
           RESULT SECTION - Modern Visualization
        ======================================== */
        .emi-summary-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        }

        .emi-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 10px;
        }

        .emi-amount {
            font-size: 2.75rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.05em;
            margin-bottom: 24px;
            line-height: 1;
        }

        /* ========================================
           DONUT CHART - Colorful & Precise
        ======================================== */
        .donut-container {
            position: relative;
            width: 210px;
            height: 210px;
            margin: 0 auto 24px;
        }

        .donut-chart {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(
                #3b82f6 0deg 65%, 
                #10b981 65% 100%
            );
            transition: background 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: inset 0 0 15px rgba(0,0,0,0.05);
        }

        .donut-center {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            background: var(--bg-card);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }

        .donut-center span {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 3px;
        }

        .donut-center strong {
            font-size: 1.25rem;
            color: #0f172a;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .donut-legend {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-top: 4px;
            width: 100%;
        }

        .legend-item {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .legend-label {
            display: flex;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }

        .color-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            margin-right: 8px;
        }

        .legend-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.01em;
        }

        /* ========================================
           CTA SECTION - Premium Buttons
        ======================================== */
        .cta-section {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            width: 100%;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border-radius: var(--radius-inner);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: -0.01em;
        }

        .btn-primary {
            background-color:#0f172a;
            color: white;
        }

        .btn-primary:hover {
            background-color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.12);
        }

        .btn-secondary {
            background-color: white;
            color: #0f172a;
            border: 2px solid var(--border-elegant);
        }

        .btn-secondary:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        /* ========================================
           ELIGIBILITY SPECIFIC
        ======================================== */
        .eligibility-results {
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: 100%;
        }

        .result-highlight {
            background: linear-gradient(135deg, var(--accent-blue-light) 0%, var(--accent-blue) 100%);            
            color: #0f172a;
            padding: 32px;
            border-radius: 14px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border: none;
        }

        .result-highlight .emi-label {
            color: #94a3b8;
        }

        .result-highlight .emi-amount {
            color: var(--text-main);
            margin-bottom: 0;
            font-size: 2.5rem;
        }

        .eligibility-meta {
            padding: 28px;
        }



        /* ========================================
           AMORTIZATION TABLE
        ======================================== */
        .amortization-table {
            width:100%;
            border-collapse: collapse;
            font-size:0.95rem;
        }
        .amortization-table th, .amortization-table td{
            padding: 12px 14px;
            text-align:right;
            border-bottom:1px solid var(--border-elegant);
        }

        .amortization-table th{
            background-color: var(--accent-blue-light);
            color: var(--text-primary);
            font-weight: 600;
        }
        .amortization-table th:first-child, .amortization-table td:first-child{
            text-align:center;
        }

        .amortization-table tr:last-child td{
            border-bottom:none;
        }

        /* Amortization toggle behavior */
    .table-wrapper {
        overflow-y: auto;
        transition: max-height 0.35s ease;
        border-radius: 10px;
        border: 1px solid var(--border-elegant);
    }

/* Collapsed: only first row visible */
    .table-wrapper.collapsed {
        max-height: 110px;
        overflow:auto;
        /* header + 1 row */
    }

/* Expanded: 12 months visible */
    .table-wrapper.expanded {
        max-height: 420px; /* approx 12 rows */
    }

/* Toggle button spacing */
    .toggle-btn {
        margin-top: 16px;
    }
        

        /* ========================================
           RESPONSIVE DESIGN
        ======================================== */
        @media (max-width: 960px) {
            .emi-flex-container {
                grid-template-columns: 1fr;
            }
            
            body {
                padding: 32px 16px;
            }

            .header h1 {
                font-size: 1.875rem;
            }

            .emi-amount {
                font-size: 2.25rem;
            }
        }

        @media (max-width: 768px) {
            .amortization-table {
            font-size: 0.85rem;
            }
        }


        @media (max-width: 480px) {
            .cta-section {
                flex-direction: column;
            }
            
            .donut-container {
                width: 180px;
                height: 180px;
            }

            .donut-center {
                top: 15px;
                left: 15px;
                right: 15px;
                bottom: 15px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
<div class="loan_calculator_page">
    <div class="container_calc">
        <!-- Header Section -->
        <header class="header_calc">
            <h1>Loan Calculator</h1>
            <p>Empower your financial decisions with our premium, real-time loan estimation tools.</p>
        </header>

        <!-- Tab Radio Buttons -->
        <input type="radio" name="calc-tab" id="emi-tab" checked>
        <input type="radio" name="calc-tab" id="eligibility-tab">

        <!-- Tab Navigation -->
        <nav class="tab-navigation">
            <label for="emi-tab" class="tab-button">EMI Calculator</label>
            <label for="eligibility-tab" class="tab-button">Loan Eligibility</label>
        </nav>

        <!-- EMI Calculator Tab -->
        <div class="emi-calculator tab-content">
            <div class="emi-flex-container">
                <!-- Left: Form -->
                <div class="form-side">
                    <div class="card">
                        <h2 class="card-title">Loan Parameters</h2>
                        
                        <div class="form-group">
                            <label for="emi-loan" class="form-label">Total Loan Amount</label>
                            <div class="input-wrapper">
                                <span class="input-icon">₹</span>
                                <input type="number" id="emi-loan" class="form-input" value="2500000" placeholder="e.g. 25,00,000">
                            </div>
                            <div class="input-hint">Enter the total amount you wish to borrow.</div>
                        </div>

                        <div class="form-group">
                            <label for="emi-tenure" class="form-label">Loan Tenure (Years)</label>
                            <div class="input-wrapper">
                                <span class="input-icon">📅</span>
                                <input type="number" id="emi-tenure" class="form-input" value="10" placeholder="e.g. 10">
                            </div>
                            <div class="input-hint">How many years will you repay the loan?</div>
                        </div>

                        <div class="form-group">
                            <label for="emi-interest" class="form-label">Interest Rate (% P.A.)</label>
                            <div class="input-wrapper">
                                <span class="input-icon">%</span>
                                <input type="number" id="emi-interest" class="form-input" step="0.1" value="8.5" placeholder="e.g. 8.5">
                            </div>
                            <div class="input-hint">Annual interest rate offered by the bank.</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Results -->
                <div class="results-side">
                    <div class="card emi-summary-card">
                        <p class="emi-label">Monthly Installment (EMI)</p>
                        <div class="emi-amount" id="display-emi">₹30,764</div>

                        <div class="donut-container">
                            <div class="donut-chart" id="emi-chart"></div>
                            <div class="donut-center">
                                <span>Total Payable</span>
                                <strong id="display-total-payable">₹36,91,680</strong>
                            </div>
                        </div>

                        <div class="donut-legend">
                            <div class="legend-item">
                                <div class="legend-label">
                                    <span class="color-dot" style="background-color: #3b82f6;"></span>
                                    Principal
                                </div>
                                <div class="legend-value" id="display-principal">₹25,00,000</div>
                            </div>
                            <div class="legend-item">
                                <div class="legend-label">
                                    <span class="color-dot" style="background-color: #10b981;"></span>
                                    Interest
                                </div>
                                <div class="legend-value" id="display-interest">₹11,91,680</div>
                            </div>
                        </div>

                        <div class="cta-section">
                           <button class="btn btn-primary"
        onclick="window.location.href='{{ url('/applyNow') }}'">
    Apply for Loan
</button>
                            <button class="btn btn-secondary" id="download-emi-pdf">Download PDF</button>
                        </div>
                    </div>
                </div>
            </div>
            <section class="card" id="amortization-section">
                <h2 class="card-title">Loan Amortization Schedule</h2>

                <div class="table-wrapper collapsed" id="amortization-wrapper">
                    <table class="amortization-table">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>EMI</th>
                                <th>Principal</th>
                                <th>Interest</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody id="amortization-body">
                            <!-- automated with JS  -->
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-secondary toggle-btn" id="toggle-amortization">
                    View Full Schedule
                </button>
            </section>
            <!-- ===============================
 EMI CALCULATOR INFORMATION SECTION
================================ -->
<section class="card" style="margin-top:48px;">
    <h2 class="card-title">EMI Calculator Overview</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        An EMI (Equated Monthly Installment) calculator helps you estimate the fixed monthly amount payable
        towards a loan over a selected tenure. The calculation is based on standard financial formulas used
        by banks and lending institutions. By adjusting the loan amount, interest rate, and tenure, you can
        understand how each factor impacts your monthly obligation and total repayment.
    </p>
</section>

<section class="card">
    <h2 class="card-title">How EMI Is Calculated</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        EMI is calculated using a standard amortization formula that ensures equal monthly payments throughout
        the loan tenure. Each EMI consists of two components: principal repayment and interest on the outstanding
        loan balance. In the initial months, the interest component is higher, while the principal repayment
        gradually increases over time.
    </p>

    <div style="background: var(--accent-blue-light); padding: 16px; border-radius: var(--radius-sm); margin-top: 16px;">
        <p style="font-weight: 600; color: var(--text-primary); margin-bottom: 8px;">
            EMI Calculation Formula
        </p>
        <p style="font-family: monospace; font-size: 1rem; color: var(--primary-blue-dark);">
            EMI = P × r × (1 + r)<sup>n</sup> ÷ ((1 + r)<sup>n</sup> − 1)
        </p>
    </div>

    <p style="color: var(--text-secondary); font-size: 0.95rem; margin-top: 12px;">
        Where P is the loan amount, r is the monthly interest rate, and n is the total number of monthly
        installments.
    </p>
</section>

<section class="card">
    <h2 class="card-title">Ranges of Variables Used</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        EMI calculations depend on a combination of loan amount, interest rate, and loan tenure. Loan amounts
        can range from smaller values for short-term loans to higher amounts for long-term secured loans.
        Interest rates vary based on lender policies, borrower credit profile, and prevailing market conditions.
        Loan tenure can range from as short as one year to as long as thirty years.
    </p>

    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; margin-top: 12px;">
        Increasing the loan amount or interest rate leads to a higher EMI, while extending the tenure lowers
        the EMI but increases the total interest payable over the loan period. The calculator allows you to
        evaluate different combinations to find a balance between affordability and overall cost.
    </p>
</section>

<section class="card">
    <h2 class="card-title">Understanding Total Interest and Repayment</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        The total repayment amount includes both the principal borrowed and the total interest charged over
        the loan tenure. While a lower EMI may reduce short-term financial strain, it often results in higher
        cumulative interest due to a longer repayment period. Choosing a shorter tenure increases the EMI
        but helps minimize the total interest paid.
    </p>

    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; margin-top: 12px;">
        Using an EMI calculator before applying for a loan enables informed financial planning, better loan
        comparisons, and a repayment strategy aligned with your income and long-term financial goals.
    </p>
</section>

        </div>

        <!-- Eligibility Calculator Tab -->
        <div class="eligibility-calculator tab-content">
            <div class="emi-flex-container">
                <!-- Left: Form -->
                <div class="form-side">
                    <div class="card">
                        <h2 class="card-title">Financial Profile</h2>
                        
                        <div class="form-group">
                            <label for="el-income" class="form-label">Net Monthly Income</label>
                            <div class="input-wrapper">
                                <span class="input-icon">₹</span>
                                <input type="number" id="el-income" class="form-input" value="100000" placeholder="e.g. 1,00,000">
                            </div>
                            <div class="input-hint">Your take-home salary after all taxes.</div>
                        </div>

                        <div class="form-group">
                            <label for="el-emi" class="form-label">Current Monthly EMIs</label>
                            <div class="input-wrapper">
                                <span class="input-icon">₹</span>
                                <input type="number" id="el-emi" class="form-input" value="0" placeholder="e.g. 10,000">
                            </div>
                            <div class="input-hint">Existing monthly loan obligations.</div>
                        </div>

                        <div class="form-group">
                            <label for="el-tenure" class="form-label">Desired Tenure (Years)</label>
                            <div class="input-wrapper">
                                <span class="input-icon">📅</span>
                                <input type="number" id="el-tenure" class="form-input" value="20" placeholder="e.g. 20">
                            </div>
                            <div class="input-hint">Maximum tenure usually up to 30 years.</div>
                        </div>

                        <div class="form-group">
                            <label for="el-interest" class="form-label">Expected Interest Rate (%)</label>
                            <div class="input-wrapper">
                                <span class="input-icon">%</span>
                                <input type="number" id="el-interest" class="form-input" step="0.1" value="9.0" placeholder="e.g. 9.0">
                            </div>
                            <div class="input-hint">Market rates typically vary from 8% to 12%.</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Results -->
                <div class="results-side">
                    <div class="eligibility-results">
                        <div class="card result-highlight">
                            <p class="emi-label">Maximum Loan Amount</p>
                            <div class="emi-amount" id="el-display-amount">₹55,57,248</div>
                        </div>

                        <div class="card eligibility-meta">
                            <h3 class="card-title" style="font-size: 1.125rem; margin-bottom: 20px;">Estimated Monthly EMI</h3>
                            <div class="emi-amount" style="font-size: 2.5rem; margin-bottom: 32px;" id="el-display-emi">₹50,000</div>
                            
                            <div class="cta-section">
                                <button class="btn btn-primary">Check Eligibility</button>
                                <button class="btn btn-secondary" id="download-eligibility-pdf">Detailed Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===============================
 ELIGIBILITY CALCULATOR INFORMATION
================================ -->
<section class="card" style="margin-top:48px;">
    <h2 class="card-title">Eligibility Calculator Overview</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        A loan eligibility calculator helps you estimate the maximum loan amount you may qualify for based
        on your financial profile. It provides an early assessment of borrowing capacity before applying
        for a loan, allowing you to plan realistically and avoid rejection due to overestimation.
    </p>
</section>

<section class="card">
    <h2 class="card-title">Why Checking Loan Eligibility Is Important</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        Checking loan eligibility helps you understand how much loan you can afford without putting stress
        on your monthly finances. It allows you to shortlist suitable loan options, align your expectations
        with lender policies, and reduce the chances of loan application rejection. Since eligibility checks
        are indicative in nature, they do not impact your credit score.
    </p>

    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; margin-top: 12px;">
        Using an eligibility calculator also helps you compare different loan tenures and interest rates to
        identify a borrowing structure that fits comfortably within your income.
    </p>
</section>

<section class="card">
    <h2 class="card-title">How Loan Eligibility Is Calculated</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        Loan eligibility is primarily calculated based on your monthly income and existing financial
        obligations. Lenders assess how much of your income can safely be allocated towards loan repayment
        after accounting for regular expenses and ongoing EMIs. This ensures that the borrower maintains
        sufficient disposable income even after servicing the loan.
    </p>

    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; margin-top: 12px;">
        The eligible EMI amount is then used to determine the maximum loan amount you can borrow, considering
        the selected interest rate and tenure. Longer tenures may increase eligibility by reducing the EMI,
        while higher interest rates may lower the eligible loan amount.
    </p>
</section>

<section class="card">
    <h2 class="card-title">Affordability and Income-Based Checks</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        Lenders follow affordability checks to ensure responsible lending. A common approach is to limit
        the total EMI burden to a fixed percentage of the borrower’s monthly income. This ratio helps ensure
        that loan repayments remain manageable over the long term.
    </p>

    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; margin-top: 12px;">
        Existing EMIs such as personal loans, credit cards, or vehicle loans are deducted first before
        determining the available repayment capacity. Higher existing obligations reduce eligibility,
        while lower liabilities improve borrowing capacity.
    </p>
</section>

<section class="card">
    <h2 class="card-title">Other Factors Affecting Eligibility</h2>
    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7;">
        In addition to income and obligations, lenders may evaluate other profile-related factors while
        processing a loan application. These include age, employment stability, type of employment
        (salaried or self-employed), credit history, and repayment behavior. A strong credit profile and
        stable income source generally improve eligibility and approval chances.
    </p>

    <p style="color: var(--text-secondary); font-size: 1rem; line-height: 1.7; margin-top: 12px;">
        The eligibility calculator provides an indicative estimate based on common lending practices.
        Final approval and loan terms may vary depending on the lender’s internal assessment and policies.
    </p>
</section>

        </div>

         
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- EMI Elements ---
            const emiLoanInput = document.getElementById('emi-loan');
            const emiTenureInput = document.getElementById('emi-tenure');
            const emiInterestInput = document.getElementById('emi-interest');
            const emiDisplay = document.getElementById('display-emi');
            const emiTotalPayable = document.getElementById('display-total-payable');
            const emiPrincipalDisplay = document.getElementById('display-principal');
            const emiInterestDisplay = document.getElementById('display-interest');
            const emiChart = document.getElementById('emi-chart');

            // --- Eligibility Elements ---
            const elIncomeInput = document.getElementById('el-income');
            const elEmiInput = document.getElementById('el-emi');
            const elTenureInput = document.getElementById('el-tenure');
            const elInterestInput = document.getElementById('el-interest');
            const elAmountDisplay = document.getElementById('el-display-amount');
            const elEmiDisplay = document.getElementById('el-display-emi');

            // --- PDF Download Buttons ---
            const downloadEmiBtn = document.getElementById('download-emi-pdf');
            const downloadEligibilityBtn = document.getElementById('download-eligibility-pdf');

            // --- Utility: Format Currency (Indian Style) ---
            function formatCurrency(num) {
                if (!num || isNaN(num)) return '₹0';
                return '₹' + Math.round(num).toLocaleString('en-IN');
            }

            // --- EMI Calculation Logic ---
            function updateEMI() {
                const P = parseFloat(emiLoanInput.value) || 0;
                const annualRate = parseFloat(emiInterestInput.value) || 0;
                const r = (annualRate / 12) / 100;
                const n = (parseFloat(emiTenureInput.value) || 0) * 12;

                if (P > 0 && r > 0 && n > 0) {
                    const emi = (P * r * Math.pow(1 + r, n)) / (Math.pow(1 + r, n) - 1);
                    const totalPayable = emi * n;
                    const totalInterest = totalPayable - P;

                    emiDisplay.textContent = formatCurrency(emi);
                    emiTotalPayable.textContent = formatCurrency(totalPayable);
                    emiPrincipalDisplay.textContent = formatCurrency(P);
                    emiInterestDisplay.textContent = formatCurrency(totalInterest);

                    // Update Colorful Donut Chart (Principal vs Interest)
                    const principalPercent = (P / totalPayable) * 100;
                    emiChart.style.background = `conic-gradient(
                        #3b82f6 0% ${principalPercent}%, 
                        #10b981 ${principalPercent}% 100%
                    )`;
                    generateAmortizationTable(P, annualRate, n/12, emi);
                } else {
                    emiDisplay.textContent = '₹0';
                    emiTotalPayable.textContent = '₹0';
                    emiPrincipalDisplay.textContent = '₹0';
                    emiInterestDisplay.textContent = '₹0';
                    emiChart.style.background = '#e2e8f0';
                }
                
            }

            // --- Eligibility Calculation Logic ---
            function updateEligibility() {
                const income = parseFloat(elIncomeInput.value) || 0;
                const existingEmi = parseFloat(elEmiInput.value) || 0;
                const tenureYears = parseFloat(elTenureInput.value) || 0;
                const annualInterest = parseFloat(elInterestInput.value) || 0;

                // FOIR (Fixed Obligation to Income Ratio) assumed at 50%
                const maxEmiAllowed = (income * 0.5) - existingEmi;
                
                if (maxEmiAllowed > 0 && annualInterest > 0 && tenureYears > 0) {
                    const r = (annualInterest / 12) / 100;
                    const n = tenureYears * 12;
                    
                    // PV = EMI * [1 - (1+r)^-n] / r
                    const maxLoan = (maxEmiAllowed * (Math.pow(1 + r, n) - 1)) / (r * Math.pow(1 + r, n));
                    
                    elAmountDisplay.textContent = formatCurrency(maxLoan);
                    elEmiDisplay.textContent = formatCurrency(maxEmiAllowed);
                } else {
                    elAmountDisplay.textContent = '₹0';
                    elEmiDisplay.textContent = '₹0';
                }
            }

            // --- Event Listeners for Real-time Updates ---
            [emiLoanInput, emiTenureInput, emiInterestInput].forEach(input => {
                input.addEventListener('input', updateEMI);
            });

            [elIncomeInput, elEmiInput, elTenureInput, elInterestInput].forEach(input => {
                input.addEventListener('input', updateEligibility);
            });




            const toggleBtn = document.getElementById('toggle-amortization');
            const wrapper = document.getElementById('amortization-wrapper');

            let expanded = false;

            toggleBtn.addEventListener('click', () => {
            if (!expanded) {
                wrapper.classList.remove('collapsed');
                wrapper.classList.add('expanded');
                toggleBtn.textContent = 'Collapse Schedule';
            } else {
                wrapper.classList.remove('expanded');
                wrapper.classList.add('collapsed');
                toggleBtn.textContent = 'View Full Schedule';
            }
            expanded = !expanded;
});

            // --- Amortization Table Generation Logic ---
            

            function generateAmortizationTable(P, annualRate, years, emi){
            

                const tableBody = document.getElementById('amortization-body');
                tableBody.innerHTML = '';

                const monthlyRate = annualRate/12/100;
                const months = years *12;
                let balance = P;

                for(let month =1 ;month<=months; month++){
                    const interest = balance * monthlyRate;
                    const principal = emi-interest;
                    balance -=principal;
                    if(balance<0) balance=0;
                    const row = document.createElement('tr');
                    row.innerHTML=`
                        <td>${month}</td>
                        <td>${formatCurrency(emi)}</td>
                        <td>${formatCurrency(principal)}</td>
                        <td>${formatCurrency(interest)}</td>
                        <td>${formatCurrency(balance)}</td>
                    `;
                    tableBody.appendChild(row);
                    if(balance<=0)break;
            }
                    expanded=false;
                    wrapper.classList.remove('expanded');
                    wrapper.classList.add('collapsed');
                    toggleBtn.textContent = 'View Full Schedule';
            }


            // --- PDF Generation Logic ---
            function generateEMIPDF() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                const loanAmount = emiLoanInput.value;
                const tenure = emiTenureInput.value;
                const interest = emiInterestInput.value;
                const emi = emiDisplay.textContent;
                const totalPayable = emiTotalPayable.textContent;
                const principal = emiPrincipalDisplay.textContent;
                const totalInterest = emiInterestDisplay.textContent;

                // PDF Design
                doc.setFontSize(22);
                doc.setTextColor(15, 23, 42); // --primary-deep
                doc.text("Loan EMI Calculation Report", 20, 20);
                
                doc.setFontSize(12);
                doc.setTextColor(100, 116, 139); // --text-muted
                doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 30);
                
                doc.autoTable({
                    startY: 40,
                    head: [['Description', 'Value']],
                    body: [
                        ['Loan Amount', `Rs. ${parseFloat(loanAmount).toLocaleString('en-IN')}`],
                        ['Tenure', `${tenure} Years`],
                        ['Interest Rate', `${interest}% P.A.`],
                        ['Monthly EMI', emi],
                        ['Total Principal', principal],
                        ['Total Interest', totalInterest],
                        ['Total Amount Payable', totalPayable]
                    ],
                    theme: 'striped',
                    headStyles: { fillColor: [15, 23, 42], textColor: [255, 255, 255] },
                    alternateRowStyles: { fillColor: [248, 250, 252] }
                });

                doc.save(`EMI_Report_${new Date().getTime()}.pdf`);
            }

            function generateEligibilityPDF() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                const income = elIncomeInput.value;
                const currentEmi = elEmiInput.value;
                const tenure = elTenureInput.value;
                const interest = elInterestInput.value;
                const maxLoan = elAmountDisplay.textContent;
                const estimatedEmi = elEmiDisplay.textContent;

                // PDF Design
                doc.setFontSize(22);
                doc.setTextColor(15, 23, 42);
                doc.text("Loan Eligibility Report", 20, 20);
                
                doc.setFontSize(12);
                doc.setTextColor(100, 116, 139);
                doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 20, 30);
                
                doc.autoTable({
                    startY: 40,
                    head: [['Financial Details', 'Value']],
                    body: [
                        ['Monthly Net Income', `Rs. ${parseFloat(income).toLocaleString('en-IN')}`],
                        ['Current Monthly EMIs', `Rs. ${parseFloat(currentEmi).toLocaleString('en-IN')}`],
                        ['Desired Tenure', `${tenure} Years`],
                        ['Expected Interest Rate', `${interest}%`],
                        ['Maximum Eligible Loan', maxLoan],
                        ['Estimated Monthly EMI', estimatedEmi]
                    ],
                    theme: 'grid',
                    headStyles: { fillColor: [15, 23, 42], textColor: [255, 255, 255] },
                    alternateRowStyles: { fillColor: [248, 250, 252] }
                });

                doc.setFontSize(10);
                doc.text("* This is an automated estimation based on 50% FOIR (Fixed Obligation to Income Ratio).", 20, doc.lastAutoTable.finalY + 10);

                doc.save(`Eligibility_Report_${new Date().getTime()}.pdf`);
            }

            downloadEmiBtn.addEventListener('click', generateEMIPDF);
            downloadEligibilityBtn.addEventListener('click', generateEligibilityPDF);

            // --- Initial Execution ---
            updateEMI();
            updateEligibility();
        });
    </script>

@endsection


>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa
