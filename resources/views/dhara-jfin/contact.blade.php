@include('dhara-jfin.layout.header')

<main>
<!-- Page Banner -->
<section class="video-hero">
        <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
        <source src="{{ asset('theme/dhara-jfin/videos/jfinserv_contact_banner.mp4') }}" type="video/mp4">
        </video>
    <div class="video-banner-overlay">
        <div class="video-overlay-content">
            <h1>We are here to help you Move<span> Forward </span></h1>
        </div>
    </div>
</section>
<!-- Contact Section -->
<section class="contact-section">
    <div class="container">

        <div class="section-header-contact-page">
            <h1>For Loan Details, Assistance Or Any Queries.</h1>
        </div>

        <div class="contact-grid">

            <!-- Left Image -->
            <div class="contact-image">
                <img src="{{ asset('theme') }}/frontend/img/contact-img.png" alt="Contact">
            </div>

            <!-- Right Form -->
            <div class="contact-form">
                <h4 class="text-primary">Get In Touch With Us.</h4>
                <p>Want to get in touch? We'd love to hear from you. Here's how you can reach us...</p>

                <form action="{{ route('enquiry.store') }}" method="POST">
                    @csrf

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Your Phone</label>
                            <input type="text" name="contact" value="{{ old('contact') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Enquiry Type</label>
                            <select name="enquiry_type" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="loan">Loan</option>
                                <option value="property">Property</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" required>
                        </div>

                        <div class="form-group full-width">
                            <label>Message</label>
                            <textarea name="message" rows="4" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="form-group full-width">
                            <button type="submit" class="btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Map -->
        <div class="map-wrapper">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3783.239325295986!2d73.87668237465209!3d18.518084069251273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c04fa53aaaab%3A0xe41ec8638ad1532e!2sJfinserv!5e0!3m2!1sen!2sin!4v1723443378612!5m2!1sen!2sin"
                loading="lazy"
                height="400">
            </iframe>
        </div>

    </div>
</section>

</main>

@include('dhara-jfin.layout.footer')
<script>
        // Sticky header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>
<script src="{{ asset('theme/dhara-jfin/js/chatbot.js') }}"></script>

