@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
  


    
 <style>/* ===== Overlay ===== */
.modal-overlay {
    background: rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== Container ===== */
.modal-container,
.modal-dialog.modal-container {
    max-width: 900px;
    width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    padding: 24px 28px 30px;
}

/* ===== Header ===== */
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: none;
    padding: 0 0 16px;
}

.modal-header h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.modal-header p {
    font-size: 13px;
    color: #6b7280;
    margin: 4px 0 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 14px;
    color: #2563eb;
    cursor: pointer;
}

/* ===== Section Titles ===== */
.personal-details-form h4,
.section-title {
    font-size: 14px;
    font-weight: 600;
    margin: 22px 0 10px;
}

/* ===== Form Layout ===== */
.personal-details-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 20px;
}

.personal-details-form .form-group {
    display: flex;
    flex-direction: column;
}

.personal-details-form .form-row {
    grid-column: span 2;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 20px;
}

/* ===== Labels ===== */
.personal-details-form label {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 6px;
    color: #111827;
}

/* ===== Inputs ===== */
.personal-details-form input {
    height: 42px;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    outline: none;
    transition: border 0.2s;
}

.personal-details-form input::placeholder {
    color: #9ca3af;
}

.personal-details-form input:focus {
    border-color: #3b82f6;
}

/* Full width fields */
.personal-details-form .form-group:nth-child(3),
.personal-details-form .form-group:nth-child(4),
.personal-details-form .form-group:nth-child(6),
.personal-details-form .form-group:nth-child(9) {
    grid-column: span 2;
}

/* ===== Footer ===== */
.modal-footer {
    grid-column: span 2;
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* ===== Buttons ===== */
.btn-back {
    background: transparent;
    border: none;
    color: #6b7280;
    font-size: 14px;
    cursor: pointer;
}

.btn-submit {
    background: #3b82f6;
    color: #fff;
    border: none;
    padding: 12px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    width: 100%;
}

.btn-submit:hover {
    background: #2563eb;
}

/* Remove underline & blue color from clickable cards */


.overview-link {
  text-decoration: none;
  color: inherit;
  display: block;
}

.overview-link:hover,
.overview-link:focus,
.overview-link:active {
  text-decoration: none;
  color: inherit;
}
</style>
 
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid bg-white">

            <div class="customer-overview-grid">

                <!-- ================= ALL LOAN BANK ================= -->
                <a href="{{ route('loanbanks') }}" class="overview-link">
                    <div class="overview-card green">

                        <div class="overview-icon">
                            <i class="fas fa-landmark"></i>
                        </div>

                        <div class="overview-content">
                            <h3>All Loan Bank</h3>
                            <p>{{ $totalloanbank }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

                <!-- ================= ALL MIS ================= -->
                <a href="{{ route('mis.index') }}" class="overview-link">
                    <div class="overview-card yellow">

                        <div class="overview-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>

                        <div class="overview-content">
                            <h3>All MIS</h3>
                            <p>{{ $totalmis }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

                <!-- ================= MONTHLY P&L ================= -->
                <a href="{{ route('monthlyPL.list') }}" class="overview-link">
                    <div class="overview-card blue">

                        <div class="overview-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>

                        <div class="overview-content">
                            <h3>Monthly P&amp;L</h3>
                            <p>{{ $totalMonthlyPL }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

                <!-- ================= ESTIMATED FILE ================= -->
                <a href="{{ route('estimatedFile.index') }}" class="overview-link">
                    <div class="overview-card purple">

                        <div class="overview-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>

                        <div class="overview-content">
                            <h3>Estimated File</h3>
                            <p>{{ $totalEstimatedFiles }}</p>
                            <span class="overview-status">Tracked from Records</span>
                        </div>

                    </div>
                </a>

            </div>

        </div>
    </div>
</div>


@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection