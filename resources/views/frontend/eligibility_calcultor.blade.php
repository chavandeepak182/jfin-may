@extends('frontend.layouts.header')
@section('title', "Financial Services Companies in Pune - Jfinserv")
@section('description', "Discover top financial services companies in Pune. Explore a comprehensive list of Pune Housing Finance leading financial companies in Pune.")
@section('keywords', "financial services in pune, Home loan services in Pune, business loan provider in pune, Business loan services in Pune, Business loan in Pune")

@section('content')



<section class="page-banner" style="background-image: url('../theme/frontend/img/emi.webp');">
    <div class="page-banner-overlay"></div>

    <div class="page-banner-container">
        <!-- <h1 class="page-banner-title">About Jfinserv</h1> -->
    </div>
</section>


<style>


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