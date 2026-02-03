@extends('frontend.layouts.customer-dash')
@section('title', "My Profile")

@section('content')
<style>
.dashboard-card {
    border-radius: 18px;
    color: #fff;
    padding: 24px;
    height: 187px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.dashboard-card .icon-box {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard-card h6 {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 6px;
}

.dashboard-card h2 {
    font-weight: 700;
    margin: 0;
}

.dashboard-card .badge-change {
    position: absolute;
    top: 18px;
    right: 18px;
    background: rgba(255,255,255,0.25);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
}

/* Gradient colors */
.bg-blue {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}
.bg-purple {
    background: linear-gradient(135deg, #a855f7, #7c3aed);
}
.bg-orange {
    background: linear-gradient(135deg, #fb923c, #f97316);
}
.bg-green {
    background: linear-gradient(135deg, #34d399, #10b981);
}

.application-card {
    background: #fff;
    border-radius: 2rem;
    border: 1px solid #f1f5f9;
    box-shadow: 0 1px 2px rgba(0,0,0,.05);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    min-height: 400px;
}

@media (min-width: 768px) {
    .application-card {
        flex-direction: row;
    }
}

.application-image {
    position: relative;
    min-height: 220px;
}

.application-image img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.application-image::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.8), rgba(0,0,0,.2), transparent);
}

.application-image-content {
    position: absolute;
    bottom: 24px;
    left: 24px;
    right: 24px;
    color: #fff;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(254, 243, 199, .9);
    color: #92400e;
    font-size: 10px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.status-dot {
    width: 6px;
    height: 6px;
    background: #f59e0b;
    border-radius: 50%;
}

.application-content {
    padding: 32px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex: 1;
}

.progress {
    height: 8px;
    border-radius: 999px;
}

.progress-bar {
    border-radius: 999px;
}

.step-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.alert-action {
    background: rgba(255,237,213,.5);
    border: 1px solid #fed7aa;
    border-radius: 1.25rem;
    padding: 16px;
    display: flex;
    gap: 14px;
}
</style>

<div class="container-fluid p-0">

    <h1 class="h3 mb-4 text-black">Dashboard Overview</h1>

		<div class="row g-4">

			<!-- My Loans -->
			<div class="col-md-6 col-xl-3">
    <a href="{{ route('loans.loans-list') }}" class="text-decoration-none">
        <div class="dashboard-card bg-blue">
            <span class="badge-change">+2.5%</span>

            <div class="icon-box mb-3">
                <i data-feather="credit-card"></i>
            </div>

            <h6>My Loans</h6>
            <h2>{{ $loanCount }}</h2>
        </div>
    </a>
</div>

<!-- Disbursed Loans -->
<div class="col-md-6 col-xl-3">
    <a href="{{ route('loans.loans-list') }}" class="text-decoration-none">
        <div class="dashboard-card bg-purple">
            <span class="badge-change">+4.5%</span>

            <div class="icon-box mb-3">
                <i data-feather="users"></i>
            </div>

            <h6>Disbursed Loans</h6>
            <h2>{{ $disbursedLoanCount }}</h2>
        </div>
    </a>
</div>


			<!-- Earnings -->
		<div class="col-md-6 col-xl-3">
    <a href="{{ route('user.walletbalance') }}" class="text-decoration-none">
        <div class="dashboard-card bg-orange">
            <span class="badge-change">+1.2%</span>

            <div class="icon-box mb-3">
                <i data-feather="briefcase"></i>
            </div>

            <h6>Total Earnings</h6>
            <h2>₹{{ number_format($walletBalance, 0) }}</h2>
        </div>
    </a>
</div>


			<!-- Referral Code -->
			<div class="col-md-6 col-xl-3">
				<div class="dashboard-card bg-green">
					<span class="badge-change">-0.5%</span>

					<div class="icon-box mb-3">
						<i data-feather="share-2"></i>
					</div>

					<h6>Referral Code</h6>
					<h2>{{ $referralCode }}</h2>
				</div>
			</div>

		</div>

</div>
<div class="row mt-5">
    <div class="col-12">

        <div class="application-card">

            <!-- LEFT IMAGE -->
            <div class="application-image col-md-5">
                <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&q=80&w=800">

                <div class="application-image-content">
                    <span class="status-badge mb-2">
                        <span class="status-dot"></span>
                        Underwriting Review
                    </span>

                    <h3 class="fw-bold mb-1">₹3,50,000</h3>
                    <small class="opacity-75">Home Mortgage Refinance</small>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="application-content col-md-7">

                <!-- Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Application #4920-X</h4>
                        <small class="text-muted">Submitted on Oct 12, 2023</small>
                    </div>

                    <a href="{{ route('loan.form') }}" class="btn btn-primary rounded-pill px-4 fw-semibold d-flex align-items-center gap-2">
                        Resume Application
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>

                <!-- Progress -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <strong class="small">Step 3 of 5: Document Verification</strong>
                        <strong class="text-primary small">60%</strong>
                    </div>

                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" style="width:60%"></div>
                    </div>

                    <div class="d-flex justify-content-between text-muted step-label">
                        <span>Application</span>
                        <span>Credit Check</span>
                        <span class="text-dark">Docs</span>
                        <span>Approval</span>
                        <span>Closing</span>
                    </div>
                </div>

                <!-- Action Required -->
                <div class="alert-action mt-auto">
                    <div class="bg-warning bg-opacity-25 p-2 rounded">
                        <i data-feather="alert-triangle" class="text-warning"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-warning mb-1">Action Required</h6>
                        <p class="small mb-2 text-warning">
                            Please upload your W-2 form for the year 2022 to proceed.
                        </p>
                        <a href="#" class="fw-bold text-primary small text-uppercase">
                            Upload Documents
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Feather Icons --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        feather.replace();
    });
</script>

@endsection
