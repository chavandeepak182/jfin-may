<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

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

.login-switch {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.login-switch label {
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
}

.form-field {
  margin-bottom: 18px;
}

.form-field label {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 6px;
  display: block;
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

.promo-text {
  color: #fff;
  max-width: 460px;
}

.promo-text h2 {
  font-size: 34px;
  font-weight: 700;
  margin-bottom: 20px;
}

.feature-item {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
}

.feature-item i {
  color: #10B981;
}


/* ===== GRAPH CARD ===== */
.analytics-card {
  background: #ffffff;
  border-radius: 16px;
  padding: 22px;
  margin-bottom: 40px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.18);
}

.analytics-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.analytics-header h3 {
  font-size: 18px;
  font-weight: 600;
  margin: 0;
}

.card-subtitle {
  font-size: 12px;
  color: #64748b;
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


/* ================= RESPONSIVE ================= */
@media (max-width: 968px) {
  .auth-wrapper {
    grid-template-columns: 1fr;
  }
  .auth-promo-column {
    display: none;
  }
}

.password-wrapper {
  position: relative;
}

.password-wrapper input {
  /* padding-right: 45px; */
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

<script>
function toggleLogin(type){
  document.getElementById('emailBox').style.display = type === 'email' ? 'block' : 'none';
  document.getElementById('otpBox').style.display   = type === 'otp'   ? 'block' : 'none';
}
</script>

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

<h2 class="auth-heading">Welcome To Jfinmate</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

@if($errors->any())
<p style="color:red">{{ $errors->first() }}</p>
@endif

<div class="login-switch">
<label>
  <input type="radio" name="loginType" checked onclick="toggleLogin('email')">
  Email Login
</label>
<label>
  <input type="radio" name="loginType" onclick="toggleLogin('otp')">
  OTP Login
</label>
</div>

<!-- EMAIL LOGIN -->
<form method="POST" action="{{ route('authv3.login.email') }}" id="emailBox">
@csrf
<div class="form-field">
  <label>Email Address</label>
  <input type="email" name="email_id" required>
</div>

<div class="form-field password-field">
  <label>Password</label>

  <div class="password-wrapper">
    <input type="password" name="password" id="passwordInput" required>
    <i class="fa-solid fa-eye" id="togglePassword"></i>
  </div>
</div>


<button class="btn-primary">Login</button>
</form>

<!-- OTP LOGIN -->
<form method="POST" action="{{ route('authv3.login.otp') }}" id="otpBox" style="display:none">
@csrf
<div class="form-field">
  <label>Mobile Number</label>
  <input type="text" name="mobile_no" maxlength="10" required>
</div>

<button class="btn-primary">Send OTP</button>
</form>

<div class="auth-footer-link">
New user?
<a href="{{ route('authv3.signup.form') }}">Create Account</a>
</div>

</div>
</div>

<!-- ================= RIGHT PROMO ================= -->
<div class="auth-promo-column">
  <div class="promo-content">

    <!-- ===== GRAPH CARD ===== -->
    <div class="analytics-card">
      <div class="analytics-header">
        <div>
          <h3>Portfolio Growth</h3>
          <p class="card-subtitle">Last 6 Months Performance</p>
        </div>
        <div class="chart-value">+28.5%</div>
      </div>

      <div class="line-chart-premium">
        <svg viewBox="0 0 300 180" preserveAspectRatio="none">
          <!-- GRID -->
          <line x1="0" y1="150" x2="300" y2="150" stroke="#e5e7eb"/>
          <line x1="0" y1="110" x2="300" y2="110" stroke="#e5e7eb"/>
          <line x1="0" y1="70" x2="300" y2="70" stroke="#e5e7eb"/>

          <!-- LINE -->
          <polyline
            fill="none"
            stroke="#3B82F6"
            stroke-width="4"
            points="10,140 60,120 110,100 160,75 210,55 260,35"
          />

          <!-- DOTS -->
          <circle cx="10" cy="140" r="4" fill="#3B82F6"/>
          <circle cx="60" cy="120" r="4" fill="#3B82F6"/>
          <circle cx="110" cy="100" r="4" fill="#3B82F6"/>
          <circle cx="160" cy="75" r="4" fill="#3B82F6"/>
          <circle cx="210" cy="55" r="4" fill="#3B82F6"/>
          <circle cx="260" cy="35" r="4" fill="#3B82F6"/>
        </svg>
      </div>
    </div>

    <!-- ===== PROMO TEXT ===== -->
    <div class="promo-text">
      <h2>Secure & Smart Financial Platform</h2>

      <div class="feature-item">
        <i class="fas fa-check-circle"></i> Fast OTP Login
      </div>
      <div class="feature-item">
        <i class="fas fa-check-circle"></i> Secure Authentication
      </div>
      <div class="feature-item">
        <i class="fas fa-check-circle"></i> Trusted Financial Services
      </div>
    </div>

  </div>
</div>
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


</body>
</html>
