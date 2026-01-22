/**
 * Jfinserv Chatbot Logic
 * Handles loan queries, interest rates, eligibility, and expert escalation.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Onboarding State
    let isStarted = false;
    let userProfile = {
        name: '',
        contact: '',
        email: ''
    };

    // Create Chatbot HTML structure
    const chatbotHTML = `
        <div id="chatbot-container" class="chatbot-container">
            <div id="chatbot-header" class="chatbot-header">
                <div class="chatbot-title">
                    <div class="chatbot-header-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <span>Jfinserv Assistant</span>
                </div>
                <button id="close-chatbot" class="close-chatbot">&times;</button>
            </div>
            
            <!-- Onboarding Form Screen -->
            <div id="chatbot-onboarding" class="chatbot-onboarding">
                <div class="onboarding-content">
                    <div class="onboarding-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h3>Welcome to Jfinserv</h3>
                    <p>Please provide your details to start chatting with our assistant.</p>
                    <form id="onboarding-form-element" class="onboarding-form">
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" id="onboarding-name" placeholder="First Name" required>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="onboarding-contact" placeholder="Contact Number" required pattern="[0-9]{10}">
                        </div>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="onboarding-email" placeholder="Email Address" required>
                        </div>
                        <button type="submit" id="start-chat-btn" class="btn btn-primary start-btn">Let's Start</button>
                    </form>
                </div>
            </div>

            <!-- Chat Interface (Hidden initially) -->
            <div id="chatbot-chat-interface" style="display: none; flex-direction: column; flex: 1; overflow: hidden;">
                <div id="chatbot-messages" class="chatbot-messages">
                    <!-- Messages will be injected here -->
                </div>
                <div class="chatbot-input">
                    <input type="text" id="user-input" placeholder="Type your query here...">
                    <button id="send-message"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        <button id="chatbot-toggle" class="chatbot-toggle">
            <i class="fas fa-comments"></i>
        </button>
    `;

    document.body.insertAdjacentHTML('beforeend', chatbotHTML);

    const container = document.getElementById('chatbot-container');
    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('close-chatbot');
    const sendBtn = document.getElementById('send-message');
    const userInput = document.getElementById('user-input');
    const messagesContainer = document.getElementById('chatbot-messages');
    
    const onboardingScreen = document.getElementById('chatbot-onboarding');
    const chatInterface = document.getElementById('chatbot-chat-interface');
    const onboardingForm = document.getElementById('onboarding-form-element');

    // Handle Onboarding Form Submission
    onboardingForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const nameInput = document.getElementById('onboarding-name');
        const contactInput = document.getElementById('onboarding-contact');
        const emailInput = document.getElementById('onboarding-email');

        if (nameInput.value.trim() && contactInput.value.trim() && emailInput.value.trim()) {
            userProfile.name = nameInput.value.trim();
            userProfile.contact = contactInput.value.trim();
            userProfile.email = emailInput.value.trim();
            
            isStarted = true;
            onboardingScreen.style.display = 'none';
            chatInterface.style.display = 'flex';
            
            // Initial Welcome Message
            addMessage(`Hello **${userProfile.name}**! Welcome to Jfinserv. How can I assist you with your loan requirements today?`, 'bot');
            addMessage(`
                <div class="quick-replies">
                    <button class="quick-reply" data-query="Home Loan">Home Loan</button>
                    <button class="quick-reply" data-query="MSME Loan">MSME Loan</button>
                    <button class="quick-reply" data-query="Interest Rates">Interest Rates</button>
                </div>
            `, 'bot');
        }
    });

    // Toggle Chatbot
    toggleBtn.addEventListener('click', () => {
        container.classList.toggle('active');
        if (container.classList.contains('active') && isStarted) {
            userInput.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });

    // Handle Messages
    function addMessage(text, sender) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${sender}`;
        msgDiv.innerHTML = text;
        messagesContainer.appendChild(msgDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Re-attach listeners if there are quick replies in the new message
        if (sender === 'bot' && text.includes('quick-reply')) {
            attachQuickReplyListeners();
        }
    }

    function handleBotResponse(query) {
        const q = query.toLowerCase();
        let response = "";

        // General Company Info & Services Portfolio
        if (q.includes('who are you') || q.includes('about jfinserv') || q.includes('what is jfinserv') || (q.includes('what') && q.includes('provide'))) {
            response = "Jfinserv is a leading financial services provider based in Pune & PCMC. We specialize in providing customized loan solutions with a focus on transparency, competitive rates, and a seamless digital experience. Our mission is to help individuals and businesses achieve their financial goals through expert guidance.";
        } else if (q.includes('service') || q.includes('what do you do') || q.includes('loan products') || q.includes('list of loans')) {
            response = "We offer a wide range of financial services including:<br>• **Home Loans** (New & Top-up)<br>• **MSME / Business Loans**<br>• **Loan Against Property (LAP)**<br>• **Project Finance**<br>• **Lease Rental Discounting (LRD)**<br>• **Overdraft Facilities**<br>Which of these would you like to know more about?";
        }
        
        // Loan Types
        else if (q.includes('home loan')) {
            response = "Jfinserv offers Home Loans with competitive interest rates starting from **8.5% P.A.** We provide funding for new property purchases, construction, and renovations in Pune & PCMC. Benefits include tenure up to 30 years, quick digital approval, and balance transfer facilities.";
        } else if (q.includes('msme') || q.includes('business loan')) {
            response = "Our MSME loans are designed to fuel your business growth. We offer both secured and unsecured options with disbursement in just **48-72 hours**. Ideal for machinery purchase, working capital, or business expansion.";
        } else if (q.includes('lap') || q.includes('loan against property')) {
            response = "Loan Against Property (LAP) helps you unlock the market value of your residential or commercial asset. We offer high-value loans at lower interest rates (starting ~9.2%*) with tenures up to 20 years.";
        } else if (q.includes('project loan')) {
            response = "We provide specialized Project Finance for real estate developers and infrastructure projects. Our team assists with high-quantum funding based on project viability and technical assessment.";
        } else if (q.includes('lease rental') || q.includes('lrd')) {
            response = "Lease Rental Discounting (LRD) allows you to get a loan against your fixed rental income from long-term leased property. It's a great way to get immediate liquidity at competitive rates.";
        } 
        
        // Financial Details
        else if (q.includes('interest') || q.includes('rate')) {
            response = "Our interest rates are highly competitive: <br>• **Home Loans**: Starting from 8.5% P.A.<br>• **LAP**: Starting from 9.2% P.A.<br>• **MSME Loans**: Tailored based on business profile.<br>*Rates are subject to credit score and eligibility.";
        } else if (q.includes('eligibility')) {
            response = "Eligibility is determined by your income, age, employment type, and CIBIL score. We generally require a score of 700+. We offer digital eligibility checks to give you an answer within minutes.";
        } else if (q.includes('emi') || q.includes('calculate') || q.includes('tenure')) {
            response = "We offer flexible tenures (up to 30 years for Home Loans). You can use our [EMI Calculator](calculator.html) on the website to plan your monthly outgoings perfectly.";
        } else if (q.includes('tax benefit') || q.includes('tax save')) {
            response = "Yes! Home loans offer significant tax benefits under Section 80C (principal) and Section 24(b) (interest) of the Income Tax Act. Our experts can guide you on maximizing these savings.";
        } else if (q.includes('prepayment') || q.includes('foreclose')) {
            response = "We offer flexible prepayment and foreclosure options. For floating-rate home loans, there are typically zero foreclosure charges for individual borrowers.";
        }

        // Process & Support
        else if (q.includes('document')) {
            response = "Standard documents required: <br>1. **KYC**: PAN, Aadhar.<br>2. **Income**: 3 months salary slips / 2 years ITR.<br>3. **Banking**: 6 months bank statements.<br>4. **Property**: Copy of title deeds.";
        } else if (q.includes('digital') || q.includes('approval') || q.includes('fast')) {
            response = "We pride ourselves on our 'Digital First' approach. You can get digital in-principle approval quickly through our website, significantly reducing the turnaround time.";
        } else if (q.includes('pmay') || q.includes('subsidy')) {
            response = "We assist eligible first-time homebuyers in availing interest subsidies under the Pradhan Mantri Awas Yojana (PMAY), subject to government guidelines.";
        } else if (q.includes('apply') || q.includes('online') || q.includes('start')) {
            response = "You can start your application right now by clicking 'Apply Now' in the header or filling out the contact form on our [Home Page](index.html#contact). It's fast and secure.";
        } else if (q.includes('bank') || q.includes('partner')) {
            response = "We partner with leading nationalized and private banks to ensure you get the best possible deal and the widest range of loan products.";
        } else if (q.includes('security') || q.includes('safe') || q.includes('data')) {
            response = "Your data is 100% secure with us. We use industry-standard encryption and maintain strict confidentiality throughout the loan process.";
        } else if (q.includes('area') || q.includes('location') || q.includes('pune') || q.includes('pcmc')) {
            response = "Our primary service areas are **Pune and PCMC**, with our main office in Wakad. We have deep local expertise in these markets.";
        } else if (q.includes('referral') || q.includes('partner with you')) {
            response = "We have an active referral program! If you're a real estate agent or a financial consultant, you can partner with us to help your clients get the best financing.";
        }

        // Expert Escalation (Only when asked)
        else if (q.includes('expert') || q.includes('talk') || q.includes('contact') || q.includes('call') || q.includes('phone') || q.includes('number') || q.includes('person')) {
            response = `I'd be happy to connect you with a loan expert, **${userProfile.name}**. I've already noted your contact number (**${userProfile.contact}**). <br><br>Our team will call you within 30 minutes. You can also reach us directly at our Wakad office.`;
        }

        // Fallback
        else {
            response = "I'm here to help with information on Home Loans, MSME Loans, LAP, interest rates, and more. Could you please specify your query? <br><br>If you'd like to speak with a human, you can click below:";
            response += '<div class="quick-replies"><button class="quick-reply" data-query="Talk to Expert">Talk to Expert</button></div>';
        }

        setTimeout(() => {
            addMessage(response, 'bot');
        }, 500);
    }

    function attachQuickReplyListeners() {
        document.querySelectorAll('.quick-reply').forEach(btn => {
            btn.onclick = () => {
                const query = btn.getAttribute('data-query');
                addMessage(query, 'user');
                handleBotResponse(query);
            };
        });
    }

    function processInput() {
        const text = userInput.value.trim();
        if (text) {
            addMessage(text, 'user');
            userInput.value = '';
            handleBotResponse(text);
        }
    }

    sendBtn.addEventListener('click', processInput);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') processInput();
    });

    attachQuickReplyListeners();
});
