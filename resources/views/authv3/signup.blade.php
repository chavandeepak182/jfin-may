<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

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
          <p style="color:red">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('authv3.signup.submit') }}">
          @csrf

          <div class="form-field">
            <label>Full Name</label>
            <input type="text" name="name" required>
          </div>

          <div class="form-field">
            <label>Mobile Number</label>
            <input type="text" name="mobile_no" required>
          </div>

          <div class="form-field">
            <label>Email Address</label>
            <input type="email" name="email_id" required>
          </div>

          <div class="form-field">
            <label>Password</label>
            <input type="password" name="password" required>
          </div>

          <button class="btn-primary">Signup & Get OTP</button>
        </form>

        <div class="auth-divider">OR</div>

        <a href="{{ route('authv3.google.login') }}" class="social-btn">
          <i class="fab fa-google"></i> Sign up with Google
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

        <div class="analytics-card">
          <div class="analytics-header">
            <div>
              <h3>Financial Growth Strategy</h3>
              <p class="card-subtitle">Portfolio Performance</p>
            </div>
          </div>

          <div class="chart-header">
            <span>Portfolio Value Growth</span>
            <span class="chart-value">+28.5%</span>
          </div>

          <div class="line-chart-premium">
            <svg viewBox="0 0 280 180">
              <polyline
                fill="none"
                stroke="#3B82F6"
                stroke-width="3"
                points="30,140 70,120 110,95 150,70 190,55 230,40 270,30"
              />
            </svg>
          </div>
        </div>

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

      </div>
    </div>

  </div>
</div>

</body>
</html>
