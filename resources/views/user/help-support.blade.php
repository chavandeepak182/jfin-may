@extends('frontend.layouts.customer-dash')
@section('title', 'Help & Support')

@section('content')
<style>
.help-search {
    background: linear-gradient(180deg,#f8faff,#ffffff);
    border-radius: 16px;
}
.support-card {
    border-radius: 14px;
    transition: all .2s ease;
}
.support-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(0,0,0,.08);
}
.icon-box {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<div class="container-fluid">

    {{-- ================= SEARCH SECTION ================= --}}
    <div class="help-search p-4 mb-5 text-center">
        <h4 class="fw-bold mb-1 text-dark">How can we help you today?</h4>
        <p class="text-muted mb-3">
            Find answers about loan applications, property bookings, or account settings.
        </p>

        <!-- <div class="d-flex justify-content-center">
            <div class="input-group" style="max-width:500px;">
                <input type="text" class="form-control"
                       placeholder="Ask a question...">
                <button class="btn btn-primary px-4">Search</button>
            </div>
        </div> -->

        <small class="text-muted d-block mt-3">
            <strong>Popular:</strong> Repayment · Booking · Profile
        </small>
    </div>

    {{-- ================= CONTACT SUPPORT ================= --}}
    <h5 class="fw-bold mb-3 text-dark">Contact Support</h5>

    <div class="row g-4 mb-5">

        {{-- Call --}}
        <div class="col-md-4">
            <div class="card support-card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h6 class="fw-bold">Call Support</h6>
                    <p class="text-muted small mb-2">
                        Speak directly with an agent
                    </p>
                    <p class="fw-semibold mb-3">+91 738 746 5783</p>
                    <a href="tel:+918001234567" class="btn btn-outline-primary btn-sm">
                        Call Now
                    </a>
                </div>
            </div>
        </div>

        {{-- Email --}}
        <div class="col-md-4">
            <div class="card support-card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="icon-box bg-success bg-opacity-10 text-success mx-auto mb-3">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h6 class="fw-bold">Email Us</h6>
                    <p class="text-muted small mb-2">
                        Send your queries anytime
                    </p>
                    <p class="fw-semibold mb-3">contact@jfinserv.com</p>
                    <a href="mailto:support@jfinserv.com" class="btn btn-outline-success btn-sm">
                        Send Email
                    </a>
                </div>
            </div>
        </div>

        {{-- Live Chat --}}
        <div class="col-md-4">
            <div class="card support-card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning mx-auto mb-3">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h6 class="fw-bold">Live Chat</h6>
                    <p class="text-muted small mb-2">
                        Chat with our support team
                    </p>
                    <p class="text-success fw-semibold mb-3">
                        ● Agents Available
                    </p>
                    <button class="btn btn-primary btn-sm">
                        Start Chat
                    </button>
                </div>
            </div>
        </div>

    </div>

    {{-- ================= FAQ ================= --}}
    <h5 class="fw-bold mb-3 text-dark">Frequently Asked Questions</h5>

    <div class="accordion" id="faqAccordion">

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq1">
                    How do I check the status of my loan application?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Go to <strong>My Loans</strong> section to view real-time application status.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq2">
                    What documents are required for a property loan?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    PAN, Aadhaar, income proof, bank statements, and property documents.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq3">
                    How can I update my profile information?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Navigate to <strong>Settings → Profile</strong> and click Edit.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#faq4">
                    What is the typical response time for support?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Our team usually responds within 24 business hours.
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
