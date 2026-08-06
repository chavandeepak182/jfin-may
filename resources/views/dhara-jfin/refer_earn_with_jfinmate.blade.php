@section('title', 'About Us')
@section('content')
@include('dhara-jfin.layout.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JFinMate · One Platform. Multiple Benefits.</title>
  <!-- Font Awesome 6 (free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    body {
      background: #fafcff;
      color: #1a2639;
      line-height: 1.5;
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* Buttons */
    .btn-primary, .btn-outline {
      display: inline-block;
      padding: 12px 32px;
      border-radius: 60px;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none;
      transition: 0.2s ease;
      border: 2px solid transparent;
      cursor: default;
      letter-spacing: 0.3px;
    }

    .btn-primary {
      background: #0b2b4a;
      color: white;
      border-color: #0b2b4a;
    }

    .btn-primary i {
      margin-right: 8px;
    }

    .btn-primary:hover {
      background: #1d3f5e;
      border-color: #1d3f5e;
    }

    .btn-outline {
      background: transparent;
      color: #0b2b4a;
      border-color: #0b2b4a;
    }

    .btn-outline i {
      margin-right: 8px;
    }

    .btn-outline:hover {
      background: #eef3f9;
    }

    .btn-group {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      margin-top: 20px;
    }

    /* Hero */
    .hero {
      background: linear-gradient(145deg, #f0f5fe 0%, #ffffff 100%);
      padding: 60px 0 48px;
      border-bottom: 1px solid rgba(11, 43, 74, 0.06);
    }

    .hero h1 {
      font-size: 2.8rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      line-height: 1.2;
      max-width: 700px;
    }

    .hero h1 span {
      color: #0b2b4a;
      background: linear-gradient(135deg, #0b2b4a, #2b5a7a);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero .subhead {
      font-size: 1.4rem;
      font-weight: 500;
      color: #1a3a57;
      margin: 12px 0 6px;
    }

    .hero .tagline {
      font-size: 1.1rem;
      color: #2c405a;
      max-width: 680px;
      margin-bottom: 8px;
    }

    .hero .badge-list {
      display: flex;
      flex-wrap: wrap;
      gap: 18px 32px;
      margin: 18px 0 10px;
      color: #1f3b57;
      font-weight: 500;
    }

    .hero .badge-list i {
      margin-right: 8px;
      color: #0b2b4a;
    }

    /* section header */
    .section-title {
      font-size: 2.2rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      margin-bottom: 12px;
    }

    .section-sub {
      font-size: 1.1rem;
      color: #2d405b;
      max-width: 700px;
    }

    /* Why choose */
    .why-section {
      padding: 60px 0 40px;
      background: white;
    }

    .why-grid {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 40px;
      margin-top: 30px;
    }

    .why-text {
      flex: 1 1 320px;
    }

    .why-text p {
      font-size: 1.05rem;
      color: #1e334d;
      margin-bottom: 16px;
    }

    .why-highlight {
      background: #e9f0fa;
      padding: 18px 24px;
      border-radius: 40px;
      display: inline-block;
      font-weight: 600;
      color: #0b2b4a;
    }

    .why-highlight i {
      margin-right: 10px;
    }

    /* journey cards */
    .journey-section {
      background: #f2f7ff;
      padding: 60px 0;
    }

    .journey-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 32px;
      margin-top: 32px;
    }

    @media (max-width: 780px) {
      .journey-grid {
        grid-template-columns: 1fr;
      }
    }

    .journey-card {
      background: white;
      border-radius: 28px;
      padding: 32px 30px;
      box-shadow: 0 8px 24px rgba(0,20,40,0.04);
      border: 1px solid rgba(11,43,74,0.06);
      transition: 0.2s;
    }

    .journey-card h3 {
      font-size: 1.7rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .journey-card .icon-big {
      font-size: 2.4rem;
      color: #0b2b4a;
      margin-bottom: 14px;
    }

    .journey-card ul {
      list-style: none;
      margin: 18px 0 24px;
    }

    .journey-card ul li {
      padding: 6px 0;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #1f3753;
    }

    .journey-card ul li i {
      color: #0b2b4a;
      width: 20px;
      font-size: 1rem;
    }

    .journey-card .btn-outline, .journey-card .btn-primary {
      margin-top: 6px;
    }

    /* rewards & how it works */
    .rewards-section {
      background: white;
      padding: 60px 0;
    }

    .rewards-highlight {
      background: #e7eff9;
      border-radius: 40px;
      padding: 30px 32px;
      margin: 24px 0 12px;
    }

    .rewards-highlight p {
      font-size: 1.08rem;
      color: #15304b;
    }

    .steps {
      display: flex;
      flex-wrap: wrap;
      gap: 18px 28px;
      margin: 32px 0 12px;
      counter-reset: step;
    }

    .step-item {
      flex: 1 1 180px;
      background: #f5f9ff;
      border-radius: 24px;
      padding: 22px 20px;
      border-left: 4px solid #0b2b4a;
      counter-increment: step;
    }

    .step-item::before {
      content: "0" counter(step);
      font-weight: 700;
      font-size: 1.3rem;
      color: #0b2b4a;
      display: block;
      margin-bottom: 6px;
    }

    .step-item strong {
      display: block;
      font-size: 1.1rem;
      margin: 6px 0 4px;
    }

    .step-item p {
      color: #1f3753;
      font-size: 0.95rem;
    }

    /* why customers prefer */
    .prefer-section {
      background: #f2f7ff;
      padding: 50px 0;
    }

    .prefer-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
      gap: 16px 20px;
      margin-top: 28px;
    }

    .prefer-item {
      background: white;
      padding: 18px 18px;
      border-radius: 60px;
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 500;
      box-shadow: 0 2px 8px rgba(0,0,0,0.02);
      border: 1px solid rgba(0,0,0,0.02);
    }

    .prefer-item i {
      color: #0b2b4a;
      font-size: 1.2rem;
      width: 24px;
    }

    /* FAQ */
    .faq-section {
      background: white;
      padding: 56px 0 48px;
    }

    .faq-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 28px 40px;
      margin-top: 28px;
    }

    @media (max-width: 700px) {
      .faq-grid {
        grid-template-columns: 1fr;
      }
    }

    .faq-item h4 {
      font-size: 1.1rem;
      font-weight: 700;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .faq-item h4 i {
      color: #0b2b4a;
      font-size: 1rem;
    }

    .faq-item p {
      color: #1f3753;
      padding-left: 32px;
    }

    /* final CTA */
    .final-cta {
      background: linear-gradient(135deg, #0b2b4a 0%, #1e4a6e 100%);
      color: white;
      padding: 56px 0 48px;
      text-align: center;
    }

    .final-cta h2 {
      font-size: 2.5rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      max-width: 700px;
      margin: 0 auto 8px;
    }

    .final-cta .sub {
      font-size: 1.2rem;
      opacity: 0.9;
      margin-bottom: 24px;
    }

    .final-cta .btn-group .btn-primary {
      background: white;
      color: #0b2b4a;
      border-color: white;
    }

    .final-cta .btn-group .btn-primary:hover {
      background: #e7edf5;
    }

    .final-cta .btn-group .btn-outline {
      color: white;
      border-color: white;
    }

    .final-cta .btn-group .btn-outline:hover {
      background: rgba(255,255,255,0.12);
    }

    /* small */
    .footnote {
      font-size: 0.85rem;
      color: #4b627c;
      margin-top: 12px;
    }

    hr {
      border: none;
      border-top: 1px solid rgba(11,43,74,0.08);
      margin: 12px 0 0;
    }

    .mt-2 { margin-top: 8px; }
    .mt-3 { margin-top: 16px; }
    .mb-1 { margin-bottom: 4px; }

    .text-center { text-align: center; }

    /* responsive */
    @media (max-width: 600px) {
      .hero h1 { font-size: 2rem; }
      .hero .subhead { font-size: 1.1rem; }
      .section-title { font-size: 1.8rem; }
    }
  </style>
</head>
<body>
  <!-- Hero Banner -->
 {{-- HERO SECTION --}}
    <section id="home" class="hero">
        <div class="hero-slider">
            <div class="slide" style="background-image:  url('{{asset('theme/dhara-jfin/img/loan_banner_new.jpg')}}')">
                <div class="container-tab hero-content">
                    <div class="hero-intro">WELCOME TO JFINSERV</div>
                    <h1>Fastest,Secure and <span style="color:#295cab">Easy Loan Process</span></h1>
                    <p>Experience fast,secure loans with competitive rates and personalized support in Pune.Enjoy seamless service and exceptional rewards.</p>

                   <div class="hero-btns">
                        <a href="{{ route('authv3.login.form') }}" class="btn btn-primary-hero"> Explore Properties</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline"> Explore Finance Solutions</a>
                    </div>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{asset('theme/dhara-jfin/img/reward_banner.jpg')}}'); background-position:right 10% top 5%;" >
                <div class="container-tab hero-content">
                    <div class="hero-intro">TRUSTED FINANCIAL PARTNERS</div>
                    <h1>Unique Reward & <span style="color:#295cab">Earning Opportunity</span></h1>
                    <p>We offer a unique earning opportunity through our referral program, rewarding both your referrals and those made by your friends.</p>

                    <div class="hero-btns">
                        <a href="{{ route('authv3.login.form') }}" class="btn btn-primary-hero"> Explore Properties</a>
                        <a href="{{ url('/login') }}" class="btn btn-outline"> Explore Finance Solutions</a>
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

  <!-- Why Choose JFinMate? -->
  <section class="why-section">
    <div class="container">
      <div class="why-grid">
        <div class="why-text">
          <h2 class="section-title">Why Choose JFinMate?</h2>
          <p>Buying a home or arranging finance shouldn't be complicated. At JFinMate, we bring everything together in one place—from verified properties and financial solutions to exclusive customer benefits and referral rewards.</p>
          <p>Whether you're purchasing your first home, investing in property, or looking for the right financing, we're here to make the journey simple, transparent, and rewarding.</p>
          <div class="why-highlight"><i class="fas fa-gift"></i> Turn Every Successful Referral Into Extra Rewards</div>
        </div>
        <div style="flex:0 0 220px; background: #e5eff9; border-radius: 60px; padding: 20px; text-align: center; min-height: 120px; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #0b2b4a;">
          <i class="fas fa-people-arrows" style="font-size: 3rem; margin-right: 12px;"></i> Refer & earn
        </div>
      </div>
    </div>
  </section>

  <!-- Choose Your Journey -->
  <section class="journey-section">
    <div class="container">
      <h2 class="section-title">Choose Your Journey</h2>
      <div class="journey-grid">
        <!-- Looking for a Property -->
        <div class="journey-card">
          <div class="icon-big"><i class="fas fa-home"></i></div>
          <h3>Looking for a Property?</h3>
          <p>Find verified residential and commercial properties that match your budget and lifestyle. With JFinMate, you also get:</p>
          <ul>
            <li><i class="fas fa-check-circle"></i> Expert property guidance</li>
            <li><i class="fas fa-check-circle"></i> Assistance throughout the buying process</li>
            <li><i class="fas fa-check-circle"></i> Exclusive customer offers*</li>
            <li><i class="fas fa-check-circle"></i> Access to referral rewards after becoming a customer</li>
          </ul>
          <a href="#" class="btn-primary"><i class="fas fa-building"></i> Explore Properties</a>
        </div>
        <!-- Looking for Finance -->
        <div class="journey-card">
          <div class="icon-big"><i class="fas fa-coins"></i></div>
          <h3>Looking for Finance?</h3>
          <p>Need financial support for your goals? Our experts help you choose the right solution with a smooth and transparent process. Benefits include:</p>
          <ul>
            <li><i class="fas fa-check-circle"></i> Expert financial guidance</li>
            <li><i class="fas fa-check-circle"></i> Dedicated relationship support</li>
            <li><i class="fas fa-check-circle"></i> Hassle-free documentation</li>
            <li><i class="fas fa-check-circle"></i> No Processing Fee on eligible offers*</li>
            <li><i class="fas fa-check-circle"></i> Referral rewards after becoming a customer</li>
          </ul>
          <a href="#" class="btn-outline"><i class="fas fa-hand-holding-usd"></i> Explore Finance</a>
        </div>
      </div>
      <p class="footnote mt-3">*Terms & conditions apply. Offers vary by project and eligibility.</p>
    </div>
  </section>

  <!-- How JFinMate Rewards You + How It Works -->
  <section class="rewards-section">
    <div class="container">
      <h2 class="section-title">How JFinMate Rewards You</h2>
      <div class="rewards-highlight">
        <p><i class="fas fa-quote-left" style="opacity:0.6; margin-right:8px;"></i> Unlike traditional platforms, your relationship with JFinMate doesn't end after your purchase or finance journey. Once you become a JFinMate customer, you can recommend us to friends and family who are looking for a property or financial solution. When their eligible transaction is successfully completed through JFinMate, you become eligible for referral rewards. It's our way of thanking you for sharing your experience.</p>
      </div>

      <h3 class="section-title" style="font-size: 1.8rem; margin-top: 32px;">How It Works</h3>
      <div class="steps">
        <div class="step-item"><strong>Choose a Property or Finance Solution</strong><p>Browse verified properties or connect with our finance experts.</p></div>
        <div class="step-item"><strong>Complete Your Journey with JFinMate</strong><p>We'll guide you from enquiry to successful completion.</p></div>
        <div class="step-item"><strong>Unlock Customer Benefits</strong><p>Enjoy exclusive offers, cashback, or project-specific benefits where applicable.*</p></div>
        <div class="step-item"><strong>Refer Friends & Family</strong><p>Share JFinMate with people you know who are looking for property or finance.</p></div>
        <div class="step-item"><strong>Earn Referral Rewards</strong><p>Receive referral rewards when eligible transactions are successfully completed.</p></div>
      </div>
      <p class="footnote">*Subject to project & offer terms.</p>
    </div>
  </section>

  <!-- Why Customers Prefer JFinMate -->
  <section class="prefer-section">
    <div class="container">
      <h2 class="section-title">Why Customers Prefer JFinMate</h2>
      <div class="prefer-grid">
        <div class="prefer-item"><i class="fas fa-check-circle"></i> Verified Property Options</div>
        <div class="prefer-item"><i class="fas fa-check-circle"></i> Expert Finance Assistance</div>
        <div class="prefer-item"><i class="fas fa-check-circle"></i> Dedicated Relationship Managers</div>
        <div class="prefer-item"><i class="fas fa-check-circle"></i> Transparent Process</div>
        <div class="prefer-item"><i class="fas fa-check-circle"></i> Exclusive Customer Benefits*</div>
        <div class="prefer-item"><i class="fas fa-check-circle"></i> Referral Rewards</div>
        <div class="prefer-item"><i class="fas fa-check-circle"></i> One Trusted Platform</div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq-section">
    <div class="container">
      <h2 class="section-title">Frequently Asked Questions</h2>
      <div class="faq-grid">
        <div class="faq-item">
          <h4><i class="fas fa-circle-question"></i> Who can earn referral rewards?</h4>
          <p>Any customer who has successfully purchased a property or availed a financial solution through JFinMate may become eligible for referral rewards, subject to the program terms.</p>
        </div>
        <div class="faq-item">
          <h4><i class="fas fa-circle-question"></i> Do I need to become a customer first?</h4>
          <p>Yes. The referral rewards program is available after you complete an eligible property purchase or finance journey with JFinMate.</p>
        </div>
        <div class="faq-item">
          <h4><i class="fas fa-circle-question"></i> What can I refer?</h4>
          <p>You can refer people looking to: Buy a property · Explore financing solutions</p>
        </div>
        <div class="faq-item">
          <h4><i class="fas fa-circle-question"></i> How do I receive referral rewards?</h4>
          <p>Referral rewards are processed after your referred customer completes an eligible transaction through JFinMate, as per the program terms.</p>
        </div>
        <div class="faq-item">
          <h4><i class="fas fa-circle-question"></i> Are there any customer benefits?</h4>
          <p>Yes. Depending on the project or offer, eligible customers may receive benefits such as cashback, purchase offers, or other promotional rewards.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Final CTA -->
  <section class="final-cta">
    <div class="container">
      <h2>Your Journey Doesn't End After You Buy. <br>It Gets Even More Rewarding.</h2>
      <p class="sub">Find your dream property, secure the right financial solution, and enjoy benefits that continue even after your journey is complete.</p>
      <div class="btn-group" style="justify-content: center;">
        <a href="#" class="btn-primary"><i class="fas fa-building"></i> Explore Properties</a>
        <a href="#" class="btn-outline"><i class="fas fa-hand-holding-usd"></i> Explore Finance Solutions</a>
      </div>
      <p style="margin-top: 32px; opacity: 0.6; font-size: 0.9rem;">JFinMate · One Platform. Multiple Benefits.</p>
    </div>
  </section>
</body>
</html>