@include('dhara-jfin.layout.header')

<main>

<!-- Header Start -->
<div class="bg-breadcrumb" style="margin-top:80px;">
    <div class="breadcrumb-container">
        <h4 class="breadcrumb-title wow fadeInDown" data-wow-delay="0.1s">
            Terms and Conditions 
        </h4>
    </div>
</div>
<!-- Header End -->

<!-- Service Start -->
<div class="privacy-service-section">
    <div class="privacy-service-container">
        <div class="privacy-service-content wow fadeInUp" data-wow-delay="0.2s">
            <p>Jfinserv Consultant India Private Limited operates website <a href="https://jfinserv.com/">https://Jfinserv.com</a> and app under brand names Jfinserv. Jfinserv aims to simplify your financial life by providing great financial products across insurance, loans & investments. We are committed to operating our website/app with proper internal controls and strong ethical standards.</p>
                        <p class="mb-large">Please note that your use or visit to our website <a href="https://jfinserv.com/">https://Jfinserv.com</a> and app (together referred to as “Services”) are subject to the following terms; if you do not agree to all of the following, you may not access or use the Services in any manner.</p>
                        <h3>Terms for usage</h3>
                        <p>Please read on to learn the rules & restrictions that govern your use of our Services. If you have any questions or comments, regarding these terms or the Services, please contact us at contact@jfinserv.com You must agree to and accept all of the Terms, or you don’t have the right to use the Services. Your using the Services in anyway means that you agree to all of these Terms, and these Terms will remain in effect while you use the Services.</p>
                        <p>Other than for your own personal non-commercial use, you agree that you shall not sell, redistribute, publish, copy, reproduce, save in database, show, perform, change, transmit, license, create products from, transfer or in anyway exploit any part of any information, content, materials, services available from or through the application.</p>
                        <p>You agree that you will not use the website/app for any purpose that is unlawful or prohibited by these Terms. You also agree you will not use the website/app in any manner that could disable or damage the website/app or interfere with any other party’s use, legal rights.</p>
                        <p>You accept that not all the products and services offered on this website/app are available in all geographic areas and you may not be eligible for all the products or services offered by Jfinserv on the website/app. Jfinserv reserves the right to determine the eligibility & availability for any service or product offered on the website/app.</p>
                        <p>You accept that Jfinserv is not responsible for the availability of content or other services on third party sites linked from the website/application. You are aware that access of hyperlinks to other internet sites or websites are at your own risk and the content, accuracy, opinions expressed, and other links provided by these sites are not verified, monitored or endorsed by Jfinserv in anyway.</p>
                        <p>Jfinserv does not make any warranties & expressly disclaims all warranties expressed or implied, including without limitation, those of merchantability and fitness for a particular purpose, title or non-infringement with respect to any information or products or services that are available or advertised or sold through these third-party platforms.</p>
                        <p>If performance is prevented, hindered or delayed by a Force Majeure incident (details below), Jfinserv shall not be liable for any failure to perform any of its obligations under these terms & conditions or those applicable to its services, & in such case its obligations shall be suspended for so long as the Force Majeure event continues. </p>
                        <p>“Force Majeure incident” means any event, due to any cause beyond the reasonable control of Jfinserv including without limitations, unavailability of any communication systems, breach, or virus in the digital processes or payment or delivery mechanism, computer hacking, unauthorised access to computer data and storage devices, computer crashes, malfunctioning in the computer terminal or the systems getting affected by any malicious, destructive or corrupting code or program, mechanical or technical errors/failures or power shut down, faults or failures in telecommunication, acts of God, civil commotion, sabotage, fire, flood, explosion, strikes / industrial action of any kind, riots, war, acts of government, lockdown, etc.</p>
                        <p>By using the services or products provided through this website/app, you shall be deemed to have accepted the Terms and Conditions (T&Cs) herein including the modified T&Cs published on the website/app from time to time. You have read & understood the Privacy Policy published on the website/app of Jfinserv. The information you provide when you register for our services or products either for yourself or for referring a friend under referral program, is true & correct.</p>
                        <p class="mb-large">Jfinserv may contact you by and/or E-mail and/or mobile/landline and/or SMS and/or WhatsApp or any other form of electronic communication in connection with your application request, referral program or its services. You can always opt out of such communication and/or request for deletion of user data by writing us on contact@jfinserv.com</p>
                        <h3>Protection of Copyrights and Trademarks</h3>
                        <p class="mb-large">All the trademarks, logos and service marks, information and content provided on our website including its design structure and compilation are privately owned Intellectual Property Rights of Jfinserv Financial Consultants Private Limited. No information or content from the website/app may be copied, republished, reproduced, posted or distributed in anyway without formal written permission from Jfinserv. Your usage of the website/app, is subject to your agreement of these T&Cs.</p>
                        <h3>Warranty, Liability, Indemnity limitation:</h3>
                        <p>In no event shall Jfinserv be liable to you for any damage or loss that may cause or arise from or in relation to these terms and conditions or due to use of this website/application.</p>
                        <p>You agree to indemnify Jfinserv, its directors and employees for all the liabilities (including claims, damages, suits or legal expenses in defending itself in relation to the foregoing) arising due to non-observance of the duties & obligations and/or non-performance under these T&Cs or due to your acts and/or omissions.</p>
                        <p>You accept & warrant that all the information provided by you to Jfinserv while using this website/application shall be correct, accurate and correct.</p>
                        <p class="mb-large">Besides, any investment decision taken by you on the Services is your sole responsibility and Jfinserv in anyway shall not be liable for any damage or loss caused to you or other users of this website/app owing to such an investment decision.</p>
                        <h3>How we stay free/No fees</h3>
                        <p>Jfinserv is and will always be free. The offers we provide via our platform help us remain free for you. When you take an offer through Jfinserv (insurance, loans, or investments), we generally make some money from one of our partners (banks/HFI/insurance firm/Asset Management Company). We are always excited to help you make the most out of our platform and find great deals.</p>
        </div>
    </div>
</div>
<!-- Service End -->

</main>

@include('dhara-jfin.layout.footer')
<script>
    /// Sticky header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>