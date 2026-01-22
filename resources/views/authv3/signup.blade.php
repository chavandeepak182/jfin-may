<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
/* ================= BASE ================= */
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
  background: #f8fafc;
}

/* ================= PAGE ================= */
.auth-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.auth-wrapper {
  display: grid;
  grid-template-columns: 1fr 1fr;
  max-width: 1200px;
  width: 100%;
  min-height: 90vh;
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 25px rgba(0,0,0,0.1);
}

/* ================= LEFT FORM ================= */
.auth-form-column {
  padding: 60px 50px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.auth-form-content {
  width: 100%;
  max-width: 420px;
}

.auth-logo-top {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 30px;
}

.logo-icon {
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg,#3B82F6,#2563EB);
  border-radius: 10px;
  color: #fff;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-text {
  font-size: 24px;
  font-weight: 700;
}

.auth-heading {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 24px;
}

.form-field {
  margin-bottom: 18px;
}

.form-field label {
  font-size: 14px;
  font-weight: 500;
  display: block;
  margin-bottom: 6px;
}

.form-field input {
  width: 100%;
  padding: 12px 14px;
  border-radius: 8px;
  border: 1px solid #d1d5db;
}

.form-field input:focus {
  outline: none;
  border-color: #3B82F6;
  box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
}

.btn-primary {
  width: 100%;
  padding: 14px;
  background: #3B82F6;
  border: none;
  border-radius: 8px;
  color: #fff;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
}

.btn-primary:hover {
  background: #2563EB;
}

.auth-divider {
  text-align: center;
  margin: 24px 0;
  color: #9ca3af;
  position: relative;
}

.auth-divider::before,
.auth-divider::after {
  content: "";
  position: absolute;
  top: 50%;
  width: 40%;
  height: 1px;
  background: #e5e7eb;
}

.auth-divider::before { left: 0; }
.auth-divider::after { right: 0; }

.social-btn {
  width: 100%;
  padding: 12px;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
  background: #fff;
  font-weight: 600;
  cursor: pointer;
}

.social-btn i {
  margin-right: 8px;
}

.auth-footer-link {
  margin-top: 20px;
  text-align: center;
  font-size: 14px;
}

.promo-text {
  color: #fff;
  margin-bottom: 40px;
}

.promo-features {
  margin-top: 20px;
}

.analytics-card {
  background: #fff;
  border-radius: 16px;
  padding: 22px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.18);
}

.analytics-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.chart-value {
  font-size: 18px;
  font-weight: 700;
  color: #10B981;
}

.line-chart-premium {
  height: 180px;
}

.line-chart-premium svg {
  width: 100%;
  height: 100%;
}


/* ================= RIGHT PROMO ================= */
.auth-promo-column {
  background: linear-gradient(135deg,#1e40af,#3B82F6);
  padding: 60px 50px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.promo-content {
  max-width: 460px;
  width: 100%;
}
/* ===== SOCIAL LOGIN BUTTON ===== */
.social-btn {
  width: 100%;
  height: 48px;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
  background: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  font-size: 15px;
  font-weight: 600;
  color: #374151;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.social-btn i {
  font-size: 18px;
}

/* GOOGLE BRAND COLOR */
.google-btn i {
  color: #DB4437;
}

.social-btn:hover {
  background: #f9fafb;
  border-color: #d1d5db;
  transform: translateY(-1px);
}


/* ===== ANALYTICS CARD ===== */
.analytics-card {
  background: #fff;
  border-radius: 16px;
  padding: 24px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  margin-bottom: 40px;
}

.analytics-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
}

.card-subtitle {
  font-size: 12px;
  color: #64748b;
}

.chart-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 12px;
}

.chart-value {
  font-weight: 700;
  color: #10B981;
}

.line-chart-premium {
  height: 180px;
}

.line-chart-premium svg {
  width: 100%;
  height: 100%;
}

/* ===== PROMO TEXT ===== */
.promo-text {
  color: #fff;
}

.promo-text h2 {
  font-size: 34px;
  font-weight: 700;
  margin-bottom: 20px;
}

.promo-features {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.feature-item i {
  color: #10B981;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 968px) {
  .auth-wrapper {
    grid-template-columns: 1fr;
  }
  .auth-promo-column {
    display: none;
  }
}
.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 18px;
    font-size: 14px;
}

.alert-danger {
    background-color: #FEE2E2;
    border: 1px solid #FCA5A5;
    color: #B91C1C;
}

.alert ul {
    margin: 0;
    padding-left: 18px;
}


.password-wrapper {
    position: relative;
}

.password-wrapper input {
    /* padding-right: 45px; space for eye icon */
}

.password-wrapper i {
    position: absolute;
    top: 50%;
    right: 14px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6b7280;
    font-size: 16px;
}

.password-wrapper i:hover {
    color: #3B82F6;
}

    </style>
</head>

<body>

<div class="auth-page">
  <div class="auth-wrapper">

    <!-- ================= LEFT FORM ================= -->
    <div class="auth-form-column">
      <div class="auth-form-content">

        <div class="auth-logo-top">
          <div class="logo-icon">JF</div>
          <div class="logo-text">JFINSERV</div>
        </div>

        <h2 class="auth-heading">Create Account</h2>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        <form method="POST" action="{{ route('authv3.signup.submit') }}">
          @csrf

          <div class="form-field">
              <label>Full Name</label>
              <input type="text" name="name" value="{{ old('name') }}">
              @error('name')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <div class="form-field">
              <label>Mobile Number</label>
              <input type="text" name="mobile_no" value="{{ old('mobile_no') }}">
              @error('mobile_no')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <div class="form-field">
              <label>Email Address</label>
              <input type="email" name="email_id" value="{{ old('email_id') }}">
              @error('email_id')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>

          <!-- <div class="form-field">
              <label>Password</label>
              <input type="password" name="password">
              @error('password')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div> -->
          <div class="form-field">
              <label>Password</label>

              <div class="password-wrapper">
                  <input type="password" name="password" id="passwordInput">
                  <i class="fa-solid fa-eye" id="togglePassword"></i>
              </div>

              @error('password')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
          </div>


          <button class="btn-primary">Signup & Get OTP</button>
        </form>

        <div class="auth-divider">OR</div>

        <a href="{{ route('authv3.google.login') }}" class="social-btn google-btn">
          <i class="fab fa-google"></i>
          <span>Sign up with Google</span>
        </a>


        <div class="auth-footer-link">
          Already have an account?
          <a href="{{ route('authv3.login.form') }}">Login</a>
        </div>

      </div>
    </div>
    <!-- ================= RIGHT PROMO ================= -->
    <div class="auth-promo-column">
      <div class="promo-content">

        <!-- ===== PROMO TEXT (TOP) ===== -->
        <div class="promo-text">
          <h2>Smart Financial Strategies for Wealth Creation</h2>

          <div class="promo-features">
            <div class="feature-item">
              <i class="fas fa-check-circle"></i>
              Diversified Investment Portfolio
            </div>
            <div class="feature-item">
              <i class="fas fa-check-circle"></i>
              Real-time Market Analytics
            </div>
            <div class="feature-item">
              <i class="fas fa-check-circle"></i>
              Expert Financial Advisory
            </div>
          </div>
        </div>

        <!-- ===== GRAPH CARD (BOTTOM) ===== -->
        <div class="analytics-card">
          <div class="analytics-header">
            <div>
              <h3>Financial Growth Strategy</h3>
              <p class="card-subtitle">Portfolio Performance</p>
            </div>
            <div class="chart-value">+28.5%</div>
          </div>

          <div class="line-chart-premium">
            <svg viewBox="0 0 280 180" preserveAspectRatio="none">
              <!-- GRID -->
              <line x1="0" y1="150" x2="280" y2="150" stroke="#e5e7eb"/>
              <line x1="0" y1="110" x2="280" y2="110" stroke="#e5e7eb"/>
              <line x1="0" y1="70"  x2="280" y2="70"  stroke="#e5e7eb"/>

              <!-- LINE -->
              <polyline
                fill="none"
                stroke="#3B82F6"
                stroke-width="4"
                points="20,140 60,120 100,95 140,70 180,55 220,40 260,30"
              />

              <!-- DOTS -->
              <circle cx="20"  cy="140" r="4" fill="#3B82F6"/>
              <circle cx="60"  cy="120" r="4" fill="#3B82F6"/>
              <circle cx="100" cy="95"  r="4" fill="#3B82F6"/>
              <circle cx="140" cy="70"  r="4" fill="#3B82F6"/>
              <circle cx="180" cy="55"  r="4" fill="#3B82F6"/>
              <circle cx="220" cy="40"  r="4" fill="#3B82F6"/>
              <circle cx="260" cy="30"  r="4" fill="#3B82F6"/>
            </svg>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

</body>
</html>
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('passwordInput');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
});
</script>
