@include('dhara-jfin.layout.header')


<main class="calculator-wrapper">
        <div class="container-calc">
            <!-- Tab Radio Buttons -->
            <input type="radio" name="calc-tab" id="emi-tab" checked>
            <input type="radio" name="calc-tab" id="eligibility-tab">

            <!-- Tab Navigation -->
            <nav class="tab-navigation">
                <label for="emi-tab" class="tab-button">EMI Calculator</label>
                <label for="eligibility-tab" class="tab-button">Loan Eligibility</label>
            </nav>

            <!-- EMI Calculator Tab -->
            <div class="emi-calculator tab-content">
                <div class="emi-flex-container">
                    <!-- Left: Form -->
                    <div class="form-side">
                        <div class="card">
                            <h2 class="card-title">Loan Parameters</h2>
                            
                            <div class="form-group">
                                <label for="emi-loan" class="form-label">Total Loan Amount</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">₹</span>
                                    <input type="number" id="emi-loan" class="form-input" value="2500000" placeholder="e.g. 25,00,000">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="emi-tenure" class="form-label">Loan Tenure (Years)</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">📅</span>
                                    <input type="number" id="emi-tenure" class="form-input" value="10" placeholder="e.g. 10">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="emi-interest" class="form-label">Interest Rate (% P.A.)</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">%</span>
                                    <input type="number" id="emi-interest" class="form-input" step="0.1" value="8.5" placeholder="e.g. 8.5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Results -->
                    <div class="results-side">
                        <div class="card emi-summary-card">
                            <p class="emi-label">Monthly Installment (EMI)</p>
                            <div class="emi-amount" id="display-emi">₹30,764</div>

                            <div class="donut-container">
                                <div class="donut-chart" id="emi-chart"></div>
                                <div class="donut-center">
                                    <span>Total Payable</span>
                                    <strong id="display-total-payable">₹36,91,680</strong>
                                </div>
                            </div>

                            <div class="donut-legend">
                                <div class="legend-item">
                                    <div class="legend-label">
                                        <span class="color-dot" style="background-color: #3b82f6;"></span>
                                        Principal
                                    </div>
                                    <div class="legend-value" id="display-principal">₹25,00,000</div>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-label">
                                        <span class="color-dot" style="background-color: #10b981;"></span>
                                        Interest
                                    </div>
                                    <div class="legend-value" id="display-interest">₹11,91,680</div>
                                </div>
                            </div>

                            <div class="cta-section-calc">
                                <a href="{{ route('authv3.login.form') }}" class="btn-calc btn-calc-primary">
                                    Apply Now
                                </a>
                                <button class="btn-calc btn-calc-secondary" id="download-emi-pdf">Download PDF</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amortization Schedule Section -->
                <div class="amortization-section">
                    <div class="amortization-card">
                        <div class="amortization-header">
                            <h3 class="amortization-title">Loan Amortization Schedule</h3>
                        </div>
                        <div class="table-container">
                            <table class="amortization-table" id="amortization-preview-table">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>EMI</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody id="amortization-preview-body">
                                    <!-- Dynamic rows will be added here -->
                                </tbody>
                            </table>
                        </div>
                        <button class="btn-view-full" id="btn-open-modal">
                            <i class="fas fa-list-ol"></i> View Full Schedule
                        </button>
                    </div>
                </div>
            </div>

            <!-- Full Schedule Modal -->
            <div class="full-schedule-modal" id="schedule-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Complete Amortization Schedule</h3>
                        <button class="close-modal" id="btn-close-modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="amortization-table">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>EMI</th>
                                    <th>Principal</th>
                                    <th>Interest</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody id="amortization-full-body">
                                <!-- Full dynamic rows will be added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Eligibility Calculator Tab -->
            <div class="eligibility-calculator tab-content" id="eligibility">
                <div class="emi-flex-container">
                    <!-- Left: Form -->
                    <div class="form-side">
                        <div class="card">
                            <h2 class="card-title">Eligibility Parameters</h2>
                            
                            <div class="form-group">
                                <label for="elig-income" class="form-label">Gross Monthly Income</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">₹</span>
                                    <input type="number" id="elig-income" class="form-input" value="75000" placeholder="e.g. 75,000">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="elig-emi" class="form-label">Existing Monthly EMIs</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">₹</span>
                                    <input type="number" id="elig-emi" class="form-input" value="0" placeholder="e.g. 10,000">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="elig-tenure" class="form-label">Desired Tenure (Years)</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">📅</span>
                                    <input type="number" id="elig-tenure" class="form-input" value="20" placeholder="e.g. 20">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="elig-interest" class="form-label">Interest Rate (% P.A.)</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">%</span>
                                    <input type="number" id="elig-interest" class="form-input" step="0.1" value="8.5" placeholder="e.g. 8.5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Results -->
                    <div class="results-side">
                        <div class="card emi-summary-card">
                            <p class="emi-label">Maximum Loan Eligibility</p>
                            <div class="emi-amount" id="display-eligibility">₹0</div>

                            <div class="eligibility-info" style="width: 100%; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border-elegant);">
                                <div class="legend-item" style="margin-bottom: 15px; align-items: center;">
                                    <div class="legend-label">Suggested Max EMI</div>
                                    <div class="legend-value" id="display-max-emi" style="font-size: 1.5rem; color: var(--success);">₹0</div>
                                </div>
                                <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.4;">
                                    Based on the FOIR (Fixed Obligation to Income Ratio) of 50%, which is commonly used by banks to determine your repayment capacity.
                                </p>
                            </div>

                            <div class="cta-section-calc">
                                <a href="{{ url('/dhara') }}#dharacontact" class="btn-calc btn-calc-primary">
                                    Check Detailed Eligibility
                                </a>
                        
                                <button class="btn-calc btn-calc-secondary" id="download-elig-pdf">Download Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section">
                <div class="faq-card">
                    <h3>EMI Calculator Overview</h3>
                    <p>An EMI (Equated Monthly Installment) calculator helps you estimate the fixed monthly amount payable towards a loan over a selected tenure. The calculation is based on standard financial formulas used by banks and lending institutions. By adjusting the loan amount, interest rate, and tenure, you can understand how each factor impacts your monthly obligation and total repayment.</p>
                </div>

                <div class="faq-card">
                    <h3>How EMI Is Calculated</h3>
                    <p>EMI is calculated using a standard amortization formula that ensures equal monthly payments throughout the loan tenure. Each EMI consists of two components: principal repayment and interest on the outstanding loan balance. In the initial months, the interest component is higher, while the principal repayment gradually increases over time.</p>
                    <div class="formula-box">
                        <span class="formula-title">EMI Calculation Formula</span>
                        <span class="formula-content">EMI = P &times; r &times; (1 + r)ⁿ &divide; ((1 + r)ⁿ - 1)</span>
                        <span class="formula-note">Where P is the loan amount, r is the monthly interest rate, and n is the total number of monthly installments.</span>
                    </div>
                </div>

                <div class="faq-card">
                    <h3>Ranges of Variables Used</h3>
                    <p>EMI calculations depend on a combination of loan amount, interest rate, and loan tenure. Loan amounts can range from smaller values for short-term loans to higher amounts for long-term secured loans. Interest rates vary based on lender policies, borrower credit profile, and prevailing market conditions. Loan tenure can range from as short as one year to as long as thirty years.</p>
                    <p style="margin-top: 12px;">Increasing the loan amount or interest rate leads to a higher EMI, while extending the tenure lowers the EMI but increases the total interest payable over the loan period. The calculator allows you to evaluate different combinations to find a balance between affordability and overall cost.</p>
                </div>

                <div class="faq-card">
                    <h3>Understanding Total Interest and Repayment</h3>
                    <p>The total repayment amount includes both the principal borrowed and the total interest charged over the loan tenure. While a lower EMI may reduce short-term financial strain, it often results in higher cumulative interest due to a longer repayment period. Choosing a shorter tenure increases the EMI but helps minimize the total interest paid.</p>
                    <p style="margin-top: 12px;">Using an EMI calculator before applying for a loan enables informed financial planning, better loan comparisons, and a repayment strategy aligned with your income and long-term financial goals.</p>
                </div>
            </div>
        </div>
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

        // EMI Calculator Logic
        function calculateEMI() {
            const loanAmount = parseFloat(document.getElementById('emi-loan').value);
            const tenureYears = parseFloat(document.getElementById('emi-tenure').value);
            const interestRate = parseFloat(document.getElementById('emi-interest').value);

            if (isNaN(loanAmount) || isNaN(tenureYears) || isNaN(interestRate)) return;

            const monthlyRate = interestRate / 12 / 100;
            const tenureMonths = tenureYears * 12;

            const emi = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, tenureMonths)) / (Math.pow(1 + monthlyRate, tenureMonths) - 1);
            const totalPayable = emi * tenureMonths;
            const totalInterest = totalPayable - loanAmount;

            document.getElementById('display-emi').innerText = '₹' + Math.round(emi).toLocaleString('en-IN');
            document.getElementById('display-total-payable').innerText = '₹' + Math.round(totalPayable).toLocaleString('en-IN');
            document.getElementById('display-principal').innerText = '₹' + loanAmount.toLocaleString('en-IN');
            document.getElementById('display-interest').innerText = '₹' + Math.round(totalInterest).toLocaleString('en-IN');

            // Update Chart
            const interestPercent = (totalInterest / totalPayable) * 360;
            document.getElementById('emi-chart').style.background = `conic-gradient(#3b82f6 0deg ${360 - interestPercent}deg, #10b981 ${360 - interestPercent}deg 360deg)`;

            updateAmortizationSchedule(loanAmount, monthlyRate, tenureMonths, emi);
        }

        function updateAmortizationSchedule(principal, monthlyRate, months, emi) {
            const previewBody = document.getElementById('amortization-preview-body');
            const fullBody = document.getElementById('amortization-full-body');
            
            previewBody.innerHTML = '';
            fullBody.innerHTML = '';

            let remainingBalance = principal;
            const rows = [];

            for (let i = 1; i <= months; i++) {
                const interestPayment = remainingBalance * monthlyRate;
                const principalPayment = emi - interestPayment;
                remainingBalance -= principalPayment;

                // Ensure balance doesn't show negative due to precision
                const displayBalance = Math.max(0, remainingBalance);

                const fullRowHtml = `
                    <tr>
                        <td>${i}</td>
                        <td>₹${Math.round(emi).toLocaleString('en-IN')}</td>
                        <td>₹${Math.round(principalPayment).toLocaleString('en-IN')}</td>
                        <td>₹${Math.round(interestPayment).toLocaleString('en-IN')}</td>
                        <td>₹${Math.round(displayBalance).toLocaleString('en-IN')}</td>
                    </tr>
                `;

                const previewRowHtml = `
                    <tr>
                        <td>${i}</td>
                        <td>₹${Math.round(emi).toLocaleString('en-IN')}</td>
                        <td>₹${Math.round(displayBalance).toLocaleString('en-IN')}</td>
                    </tr>
                `;

                if (i <= 3) {
                    previewBody.innerHTML += previewRowHtml;
                }
                fullBody.innerHTML += fullRowHtml;
            }
        }

        // Modal Controls
        const modal = document.getElementById('schedule-modal');
        const openBtn = document.getElementById('btn-open-modal');
        const closeBtn = document.getElementById('btn-close-modal');

        if (openBtn) {
            openBtn.onclick = () => modal.style.display = 'flex';
        }
        if (closeBtn) {
            closeBtn.onclick = () => modal.style.display = 'none';
        }
        window.onclick = (event) => {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Add listeners
        ['emi-loan', 'emi-tenure', 'emi-interest'].forEach(id => {
            document.getElementById(id).addEventListener('input', calculateEMI);
        });

        // Initial calculation
        calculateEMI();

        // Loan Eligibility Logic
        function calculateEligibility() {
            const income = parseFloat(document.getElementById('elig-income').value) || 0;
            const existingEmi = parseFloat(document.getElementById('elig-emi').value) || 0;
            const interestRate = parseFloat(document.getElementById('elig-interest').value) || 0;
            const tenureYears = parseFloat(document.getElementById('elig-tenure').value) || 0;

            // Standard bank rule: Max EMI = 50% of (Monthly Income - Existing EMIs)
            const foire = 0.5; 
            const maxEmi = (income * foire) - existingEmi;

            if (maxEmi <= 0) {
                document.getElementById('display-eligibility').innerText = "₹0";
                document.getElementById('display-max-emi').innerText = "₹0";
                return;
            }

            const monthlyRate = interestRate / 12 / 100;
            const tenureMonths = tenureYears * 12;

            // Loan Amount = EMI / [ (r * (1+r)^n) / ((1+r)^n - 1) ]
            const maxLoan = maxEmi / ((monthlyRate * Math.pow(1 + monthlyRate, tenureMonths)) / (Math.pow(1 + monthlyRate, tenureMonths) - 1));

            document.getElementById('display-eligibility').innerText = '₹' + Math.round(maxLoan).toLocaleString('en-IN');
            document.getElementById('display-max-emi').innerText = '₹' + Math.round(maxEmi).toLocaleString('en-IN');
        }

        // Add listeners for eligibility
        ['elig-income', 'elig-emi', 'elig-interest', 'elig-tenure'].forEach(id => {
            document.getElementById(id).addEventListener('input', calculateEligibility);
        });

        // Initial calculation for eligibility
        calculateEligibility();

        // PDF Generation Logic
        function generatePDF(type) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Header
            doc.setFontSize(22);
            doc.setTextColor(15, 23, 42); // primary-deep
            doc.text("Jfinserv Financial Report", 105, 20, { align: "center" });
            
            doc.setFontSize(12);
            doc.setTextColor(100, 116, 139); // text-muted
            doc.text("Personalized Loan Analysis", 105, 28, { align: "center" });
            
            doc.setDrawColor(226, 232, 240); // border-elegant
            doc.line(20, 35, 190, 35);

            if (type === 'emi') {
                const loan = document.getElementById('emi-loan').value;
                const tenure = document.getElementById('emi-tenure').value;
                const interest = document.getElementById('emi-interest').value;
                const emi = document.getElementById('display-emi').innerText;
                const totalInterest = document.getElementById('display-interest').innerText;
                const totalPayable = document.getElementById('display-total-payable').innerText;

                doc.setFontSize(16);
                doc.setTextColor(15, 23, 42);
                doc.text("EMI Calculator Summary", 20, 50);

                const data = [
                    ["Loan Amount", `INR ${parseInt(loan).toLocaleString('en-IN')}`],
                    ["Tenure", `${tenure} Years`],
                    ["Interest Rate", `${interest}% P.A.`],
                    ["Monthly EMI", emi],
                    ["Total Interest Payable", totalInterest],
                    ["Total Amount Payable", totalPayable]
                ];

                doc.autoTable({
                    startY: 60,
                    head: [['Parameter', 'Value']],
                    body: data,
                    theme: 'striped',
                    headStyles: { fillColor: [15, 23, 42] }
                });

                doc.setFontSize(10);
                doc.setTextColor(100, 116, 139);
                doc.text("Note: This is an indicative calculation. Actual rates and terms may vary based on credit assessment.", 20, doc.lastAutoTable.finalY + 20);
            } else {
                const income = document.getElementById('elig-income').value;
                const emi = document.getElementById('elig-emi').value;
                const tenure = document.getElementById('elig-tenure').value;
                const interest = document.getElementById('elig-interest').value;
                const maxLoan = document.getElementById('display-eligibility').innerText;
                const maxEmi = document.getElementById('display-max-emi').innerText;

                doc.setFontSize(16);
                doc.setTextColor(15, 23, 42);
                doc.text("Loan Eligibility Report", 20, 50);

                const data = [
                    ["Monthly Income", `INR ${parseInt(income).toLocaleString('en-IN')}`],
                    ["Existing EMIs", `INR ${parseInt(emi).toLocaleString('en-IN')}`],
                    ["Desired Tenure", `${tenure} Years`],
                    ["Interest Rate", `${interest}% P.A.`],
                    ["Max Loan Eligibility", maxLoan],
                    ["Suggested Max EMI", maxEmi]
                ];

                doc.autoTable({
                    startY: 60,
                    head: [['Parameter', 'Value']],
                    body: data,
                    theme: 'striped',
                    headStyles: { fillColor: [16, 185, 129] } // Success color
                });

                doc.setFontSize(10);
                doc.setTextColor(100, 116, 139);
                doc.text("Note: Eligibility is subject to verification of documents and bank's credit policy.", 20, doc.lastAutoTable.finalY + 20);
            }

            // Footer
            const pageCount = doc.internal.getNumberOfPages();
            for (let i = 1; i <= pageCount; i++) {
                doc.setPage(i);
                doc.setFontSize(10);
                doc.text("© 2026 Jfinserv Financial Services. All rights reserved.", 105, 285, { align: "center" });
            }

            doc.save(`Jfinserv_${type}_Report.pdf`);
        }

        document.getElementById('download-emi-pdf').addEventListener('click', () => generatePDF('emi'));
        document.getElementById('download-elig-pdf').addEventListener('click', () => generatePDF('eligibility'));
    </script>
<script src="{{ asset('theme/dhara-jfin/js/chatbot.js') }}"></script>
