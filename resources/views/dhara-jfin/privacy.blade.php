@include('dhara-jfin.layout.header')

<main>

<!-- Header Start -->
<div class="bg-breadcrumb" style="margin-top:80px;">
    <div class="breadcrumb-container">
        <h4 class="breadcrumb-title wow fadeInDown" data-wow-delay="0.1s">
            Privacy Policy
        </h4>
    </div>
</div>
<!-- Header End -->

<!-- Service Start -->
<div class="privacy-service-section">
    <div class="privacy-service-container">
        <div class="privacy-service-content wow fadeInUp" data-wow-delay="0.2s">

            <p>The Company respects your privacy and values the trust you place in it. Set out below is the Company’s ‘Privacy Policy’ which details the manner in which information relating to you is collected, used and disclosed.</p>
                        <p>Customer are advised to read and understand our Privacy Policy carefully, as by accessing the website/app you agree to be bound by the terms and conditions of the Privacy Policy and consent to the collection, storage and use of information relating to you as provided herein.</p>
                        <p>If you do not agree with the terms and conditions of our Privacy Policy, including in relation to the manner of collection or use of your information, please do not use or access the website.</p>
                        <p class="mb-large">Our Privacy Policy is incorporated into the Terms and Conditions of Use of the website/app, and is subject to change from time to time without notice. It is strongly recommended that you periodically review our Privacy Policy as posted on the website/app.</p>
                        <h3>The collection, Storage and Use of Information Related to You</h3>
                        <p>We may automatically track certain information about you based upon your behaviour on the website. We use this information to do internal research on our users’ demographics, interests, and behaviour to better understand, protect and serve our users. This information is compiled and analyzed on an aggregated basis. This information may include the URL that you just came from (whether this URL is on the website or not), which URL you next go to (whether this URL is on the website or not), your computer browser information, your IP address, and other information associated with your interaction with the website.</p>
                        <p>We also collect and store personal information provided by you from time to time on the website/app. We only collect and use such information from you that we consider necessary for achieving a seamless, efficient and safe experience, customized to your needs including:</p>
                        <ul>
                            <li>To enable the provision of services opted for by you</li>
                            <li>To communicate necessary product/service related information from time to time</li>
                            <li>To allow you to receive quality customer care services</li>
                            <li>To undertake necessary fraud and money laundering prevention checks, and comply with the highest security standards</li>
                            <li>To comply with applicable laws, rules and regulations</li>
                            <li>To provide you with information and offers on products and services, on updates, on promotions, on related, affiliated or associated service providers and partners, that we believe would be of interest to you.</li>
                        </ul>
                        <p>Where any service requested by you involves a third party, such information as is reasonably necessary by the Company to carry out your service request may be shared with such third party.</p>
                        <p>We also do use your contact information to send you offers based on your interests and prior activity. The Company may also use contact information internally to direct its efforts for product improvement, to contact you as a survey respondent, to notify you if you win any contest; and to send you promotional materials from its contest sponsors or advertisers.</p>
                        <p>Contacts Permissions: If you allow this company to access your contacts (including contact number, email id etc.), it enables this company to subscribe you and your contacts to promotional emails, messages, ongoing offers etc., and through this permission you and your contacts will be able to access a variety of social features such as inviting your friends to try our app, send across referral links to your friends, etc. This information will be synced from your phone/desktop and stored on secure servers.</p>
                        <p>Further, you may from time to time choose to provide payment related financial information (credit card, debit card, bank account details, billing address etc.) on the website <a href="https://jfinserv.com/">www.jfinserv.com</a> We are committed to keeping all such sensitive data/information safe at all times and provide the highest possible degree of care available under the technology presently in use.</p>
                        <p>To the extent possible, we provide you the option of not divulging any specific information that you wish for us not to collect, store or use. You may also choose not to use a particular service or feature on the website/application, and opt out of such communications from the Company.</p>
                        <p>Further, transacting over the internet has inherent risks which can only be avoided by you following security practices yourself, such as not revealing account/login related information to any other person and informing our customer care team about any suspicious activity or where your account has/may have been compromised.</p>
                        <p>Company use data collection devices such as “cookies” on certain pages of the website to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. “Cookies” are small files placed on your hard drive that assist us in providing our services. Company offers certain features that are only available through the use of a “cookie”.</p>
                        <p>The Company also use cookies to allow you to enter your password less frequently during a session. Cookies can also help the Company provide information that is targeted to your interests. Most cookies are “session cookies,” meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline our cookies if your browser permits, although in that case you may not be able to use certain features on the website and you may be required to re-enter your password more frequently during a session.</p>
                        <p>Additionally, you may encounter “cookies” or other similar devices on certain pages of the website that are placed by third parties. The Company does not control the use of cookies by third parties.</p>
                        <p>If you send the Company personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities on the website, the Company may collect such information into a file specific to you.</p>
                        <p>The Company does not retain any information collected for any longer than is reasonably considered necessary by us, or such period as may be required by applicable laws. The Company may be required to disclose any information that is lawfully sought from it by a judicial or other competent body pursuant to applicable laws.</p>
                        <p class="mb-large">The website may contain links to other websites. We are not responsible for the privacy practices of such websites which we do not manage and control.</p>
                        <h3>Choices Available Regarding Collection, Use and Distribution of Information</h3>
                        <p>To protect against the loss, misuse and alteration of the information under its control, the Company has in place appropriate physical, electronic and managerial procedures. For example, the Company servers are accessible only to authorized personnel and your information is shared with employees and authorized personnel on a need to know basis to complete the transaction and to provide the services requested by you.</p>
                        <p>Although the Company endeavours to safeguard the confidentiality of your personally identifiable information, transmissions made by means of the Internet cannot be made absolutely secure. By using the website, you agree that the Company will have no liability for disclosure of your information due to errors in transmission and/or unauthorized acts of third parties.</p>
                        <p>Please note that the Company will not ask you to share any sensitive data or information via email or telephone. If you receive any such request by email or telephone, please do not respond/divulge any sensitive data or information and forward the information relating to the same to us we will take necessary action. For any suggestions, feedbacks or comments, you may write to us at <a href="mailto:contact@jfinserv.com">contact@jfinserv.com</a></p>
        </div>
    </div>
</div>
<!-- Service End -->

</main>
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

@include('dhara-jfin.layout.footer')
