<footer>
    <div class="container">
        <div class="footer-content">

            <div class="footer-info box1">
                <div class="footer-logo">
                    <img src="{{ asset('theme/dhara-jfin/img/logo.jpg') }}" alt="Jfinserv Logo">
                </div>

                <p>
                    Jfinserv is a leading financial services provider in Pune and PCMC,
                    offering a wide range of loan products with transparency and trust.
                </p>

                <div class="social-icons ">
                    <a href="https://www.linkedin.com/company/jfinserv-consultant-india-private-limited" class="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61563098494542" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/jfinserv_consultant" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/917387465783" class="whatsapp"><i class="fab fa-whatsapp" target="_blank"></i></a>
                </div>
            </div>

            <div class="footer-links box2">
                <h4>Useful Links</h4>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fas fa-chevron-right"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}">
                            <i class="fas fa-chevron-right"></i> About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/eligibility-calculator') }}">
                            <i class="fas fa-chevron-right"></i> Calculator
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}">
                            <i class="fas fa-chevron-right"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer-links box3">
                <h4>Services</h4>
                <ul>
                    <li><a href="{{url('/home-loan')}}"><i class="fas fa-chevron-right"></i> Home Loan</a></li>
                    <li><a href="{{url('/project-loan')}}"><i class="fas fa-chevron-right"></i> Project Loan</a></li>
                    <li><a href="{{url('/loan-against-property')}}"><i class="fas fa-chevron-right"></i> Loan Against Property</a></li>
                    <li><a href="{{url('/msme-loan')}}"><i class="fas fa-chevron-right"></i> Msme Loan</a></li>
                    <li><a href="{{url('/overdraft-facility')}}"><i class="fas fa-chevron-right"></i> Overdraft Facility</a></li>
                    <li><a href="{{url('/lease-rental-discounting')}}"><i class="fas fa-chevron-right"></i> Lease Rental Discounting</a></li>
                </ul>
            </div>

            <div class="footer-contact box4">
                <h4>Reach Us</h4>

                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>
                        Office No. 423, Sterling Centre,
                        MG Road, Camp, Pune,
                        Maharashtra 411001.
                    </p>
                </div>

                <div class="contact-item">
                        <i class="fas fa-envelope"></i> 
                        <a href="mailto:contact@jfinserv.com">
                        <p>contact@jfinserv.com</p></a>
                </div>

                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <p> +91 73874 65783</p>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>&copy; {{ date('Y') }} Jfinserv. All rights reserved.</p>

                <div class="footer-legal">
                    <a href="{{url('/privacy-policy')}}">Privacy Policy</a>
                    <a href="{{url('/terms-and-conditions')}}">Terms & Conditions</a>
                </div>
            </div>
        </div>

    </div>
    <a href="#" class="back-to-top" aria-label="Back to top">
    <i class="fa fa-arrow-up"></i>
</a>
</footer>
<script>
    const backToTop = document.querySelector('.back-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300 && !document.body.classList.contains('menu-open')) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });

    backToTop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

