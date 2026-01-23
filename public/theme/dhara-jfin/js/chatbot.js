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

    // Check for existing user in localStorage
    const savedUser = localStorage.getItem('jfinserv_user');
    if (savedUser) {
        try {
            const parsedUser = JSON.parse(savedUser);
            if (parsedUser.name && parsedUser.email && parsedUser.contact) {
                userProfile = parsedUser;
                isStarted = true;
                onboardingScreen.style.display = 'none';
                chatInterface.style.display = 'flex';
                
                // Welcome back message
                addMessage(`Welcome back, <b>${userProfile.name}</b>! How can I help you further?`, 'bot');
                addMessage(`
                    <div class="quick-replies">
                        <button class="quick-reply" data-query="Home Loan">Home Loan</button>
                        <button class="quick-reply" data-query="Project Loan">Project Loan</button>
                        <button class="quick-reply" data-query="MSME Loan">MSME Loan</button>                    
                        <button class="quick-reply" data-query="Loan Against Property">Loan Against Property</button>
                        <button class="quick-reply" data-query="Overdraft facility">Overdraft Facility</button>
                        <button class="quick-reply" data-query="Lease Rental Discounting">Lease Rental Discounting</button>
                        <button class="quick-reply" data-query="Interest Rates">Interest Rates</button>
                    </div>
                `, 'bot');
            }
        } catch (e) {
            console.error('Error parsing saved user:', e);
            localStorage.removeItem('jfinserv_user');
        }
    }

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
            
            // Save to localStorage
            localStorage.setItem('jfinserv_user', JSON.stringify(userProfile));
            
            isStarted = true;
            onboardingScreen.style.display = 'none';
            chatInterface.style.display = 'flex';
            
            // Save lead to database
            saveLeadToDatabase(userProfile);
            
            // Initial Welcome Message
            addMessage(`Hello <b>${userProfile.name}</b>! Welcome to Jfinserv. How can I assist you with your loan requirements today?`, 'bot');
            addMessage(`
                <div class="quick-replies">
                    <button class="quick-reply" data-query="Home Loan">Home Loan</button>
                    <button class="quick-reply" data-query="Project Loan">Project Loan</button>
                    <button class="quick-reply" data-query="MSME Loan">MSME Loan</button>                    
                    <button class="quick-reply" data-query="Loan Against Property">Loan Against Property</button>
                    <button class="quick-reply" data-query="Overdraft facility">Overdraft Facility</button>
                    <button class="quick-reply" data-query="Lease Rental Discounting">Lease Rental Discounting</button>
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

        // General Company Info & About Us
        if (q.includes('who are you') || q.includes('about jfinserv') || q.includes('what is jfinserv') || q.includes('company')) {
            response = "Jfinserv Consultant India Private Limited is a premier financial services provider based in Pune. We specialize in providing customized loan solutions with transparency and competitive interest rates. With over 250+ disbursed loans and a team of 75+ experts, we are dedicated to empowering your financial journey.";
        } else if (q.includes('mission') || q.includes('vision') || q.includes('values')) {
            response = "Our <b>Mission</b> is to be a leading finance company offering secured loans at competitive rates. Our <b>Vision</b> is to deliver innovative, customized solutions for sustainable client growth while upholding excellence and integrity.";
        } else if (q.includes('partners') || q.includes('banks') || q.includes('nbfc')) {
            response = "We partner with top nationalized banks and NBFCs including Indian Bank, BOM, PNB, RBL, UBI, BOB, Kotak, Axis, ICICI Bank, and Aditya Birla Capital to get you the best deals.";
        } else if (q.includes('location') || q.includes('office') || q.includes('where')) {
            response = "Our head office is located in Pune. We primarily serve clients in the <b>Pune & PCMC</b> region. You can find our exact location on the <a href=\"/contact\" class=\"chat-link\" style=\"color: #00abeb; text-decoration: underline; font-weight: 600;\">Contact Page</a>.";
        }
        
        // Services & Loan Products
        else if (q.includes('service') || q.includes('what do you do') || q.includes('loan products') || q.includes('list of loans')) {
            response = "We offer a comprehensive range of financial services:<br>• <b>Home Loans</b> (New, Top-up, Balance Transfer)<br>• <b>MSME / Business Loans</b><br>• <b>Loan Against Property (LAP)</b><br>• <b>Project Finance</b> (Real Estate & Infrastructure)<br>• <b>Lease Rental Discounting (LRD)</b><br>• <b>Overdraft (OD) Facilities</b><br>Which one can I help you with today?";
        }
        
        // Loan Types
        else if (q.includes('home loan')) {
            response = "Our Home Loans start at competitive interest rates from <b>8.25% - 8.5% P.A.</b> We offer flexible tenures up to <b>30 years</b>, balance transfer facilities, and expert guidance through the technical and legal process. Perfect for new purchases or renovations!";
            response += `<br><a href="/home-loan" class="quick-reply" style="display: inline-block; margin-top: 10px; background: #295cab; color: white; padding: 5px 15px; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">View Home Loan Page</a>`;
        } else if (q.includes('msme') || q.includes('business loan')) {
            response = "Our MSME loans support your business growth, working capital, and equipment needs. We offer swift processing with disbursal typically in <b>48-72 hours</b> and minimal documentation.";
            response += `<br><a href="/msme-loan" class="quick-reply" style="display: inline-block; margin-top: 10px; background: #295cab; color: white; padding: 5px 15px; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">View MSME Loan Page</a>`;
        } else if (q.includes('property') || q.includes('lap')) {
            response = "A <b>Loan Against Property (LAP)</b> lets you unlock the value of your residential or commercial asset. We offer high-value loans at lower rates than personal loans, with tenures up to <b>15-20 years</b>.";
            response += `<br><a href="/loan-against-property" class="quick-reply" style="display: inline-block; margin-top: 10px; background: #295cab; color: white; padding: 5px 15px; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">View LAP Page</a>`;
        } else if (q.includes('project loan') || q.includes('construction')) {
            response = "We specialize in <b>Project Finance</b> for developers and infrastructure companies. We provide funding from land acquisition to completion, with moratorium periods aligned to your construction milestones.";
            response += `<br><a href="/project-loan" class="quick-reply" style="display: inline-block; margin-top: 10px; background: #295cab; color: white; padding: 5px 15px; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">View Project Loan Page</a>`;
        } else if (q.includes('lease rental') || q.includes('lrd')) {
            response = "Lease Rental Discounting (LRD) allows you to get immediate liquidity against your fixed rental income from long-term leased properties at very competitive rates.";
            response += `<br><a href="/lease-rental-discounting" class="quick-reply" style="display: inline-block; margin-top: 10px; background: #295cab; color: white; padding: 5px 15px; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">View LRD Page</a>`;
        } else if (q.includes('overdraft') || q.includes('od facility')) {
            response = "We provide Overdraft (OD) facilities to help businesses manage their cash flow efficiently, allowing you to pay interest only on the amount you use.";
            response += `<br><a href="/overdraft-facility" class="quick-reply" style="display: inline-block; margin-top: 10px; background: #295cab; color: white; padding: 5px 15px; border-radius: 20px; text-decoration: none; font-size: 0.8rem;">View Overdraft Page</a>`;
        }
        
        // FAQ - Eligibility & Requirements
        else if (q.includes('who can apply') || q.includes('eligibility criteria')) {
            response = "Salaried individuals, self-employed professionals, business owners, and companies can apply, subject to eligibility criteria such as income stability, credit history, and property details.";
        } else if (q.includes('minimum income') || q.includes('how much salary')) {
            response = "For salaried individuals, the minimum monthly income is ₹25,000. For self-employed applicants, we require a minimum annual income of ₹3 lakhs. Actual loan amounts depend on your overall profile and credit score.";
        } else if (q.includes('self-employed') || q.includes('business owner')) {
            response = "Yes, we welcome applications from self-employed professionals! You'll need to provide ITR for the last 2 years, business proof, and audited financial statements.";
        } else if (q.includes('tenure') || q.includes('how many years')) {
            response = "We offer flexible repayment tenures from <b>5 to 30 years</b>. The maximum tenure depends on your age at application and must conclude before you turn 65.";
        }
        
                // FAQ - Documents
        else if (q.includes('document') || q.includes('what do i need')) {
            response = "Basic documents include:<br>• <b>KYC</b>: PAN, Aadhaar, address proof.<br>• <b>Income</b>: Salary slips (salaried) or P&L statements/ITR (self-employed).<br>• <b>Banking</b>: Last 6 months bank statements.<br>• <b>Property</b>: Related legal and technical documents.";
        }
        
        // FAQ - Process & Fees
        else if (q.includes('how long') || q.includes('approval time') || q.includes('process')) {
            response = "In-principle approval can be received within <b>48 hours</b> of submitting documents. Final approval and disbursal typically take <b>7-10 working days</b>, subject to verification.";
        } else if (q.includes('fee') || q.includes('charge') || q.includes('cost')) {
            response = "We maintain complete transparency. Processing fees are typically around <b>0.50%</b> of the loan amount. All other charges like legal or technical fees are disclosed upfront.";
        } else if (q.includes('prepay') || q.includes('part-payment') || q.includes('foreclose')) {
            response = "For floating rate home loans, there are <b>zero prepayment charges</b>. You can make part-payments or foreclose anytime without penalty. Fixed-rate loans may have different terms.";
        }
        // Financial Details
        else if (q.includes('interest') || q.includes('rate')) {
                       response = "Our interest rates are industry-leading:<br>• <b>Home Loans</b>: From 8.25% P.A.<br>• <b>LAP</b>: Typically 9.2% - 9.5% P.A.<br>• <b>MSME</b>: Competitive rates based on profile.<br>*Rates depend on your credit score and eligibility.";
        } else if (q.includes('eligibility') || q.includes('score') || q.includes('cibil')) {
            response = "Eligibility depends on your income, age, and employment. A CIBIL score of <b>700+</b> is generally preferred. You can use our digital application for a quick eligibility check!";
        } else if (q.includes('apply') || q.includes('how to')) {
            response = "Applying is easy! You can apply directly through our <a href=\"/authv3/login\" class=\"chat-link\" style=\"color: #00abeb; text-decoration: underline; font-weight: 600;\">Online Application Portal</a> or visit our <a href=\"/contact\" class=\"chat-link\" style=\"color: #00abeb; text-decoration: underline; font-weight: 600;\">Contact Page</a> to speak with an expert.";
        } else if (q.includes('contact') || q.includes('phone') || q.includes('call')) {
            response = "You can reach us by filling out the form on our <a href=\"/contact\" class=\"chat-link\" style=\"color: #00abeb; text-decoration: underline; font-weight: 600;\">Contact Page</a>. Our team will get back to you shortly to assist with your requirements.";
        } else if (q.includes('why choose') || q.includes('benefit')) {
            response = "Jfinserv offers competitive interest rates, transparent processes, personalized assistance, and end-to-end support to make your borrowing experience simple and stress-free.";
        } else if (q.includes('thank') || q.includes('bye')) {
            response = "You're welcome! Feel free to ask if you have more questions. Have a great day!";
        } else {
            response = "I'm not sure I understand that specific query. Would you like to know about our <b>Home Loans</b>, <b>Business Loans</b>, <b>Interest Rates</b>, or <b>About Jfinserv</b>?";
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

    async function saveLeadToDatabase(profile) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const response = await fetch('/chatbot-leads', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    name: profile.name,
                    email: profile.email,
                    contact: profile.contact
                })
            });

            const result = await response.json();
            console.log('Lead saved:', result);
        } catch (error) {
            console.error('Error saving lead:', error);
        }
    }
});
