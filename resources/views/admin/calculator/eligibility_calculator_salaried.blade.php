@extends('layouts.header')
@section('content')
<style>
    @media print {
        /* General body styling for printing */
        body {
            overflow: hidden; /* Hides the scrollbar */
            margin: 0; /* Adjust margins */
            padding: 0;
        }

        /* Optional: Limit printed area to a specific section */
        #export-area {
            margin: auto;
            width: 100%; /* Full width of printable area */
        }

        /* Hide scrollbar */
        ::-webkit-scrollbar {
            display: none;
        }
        body {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }

        /* Hide unnecessary UI elements */
        .no-print {
            display: none;
        }
    }
</style>
<div id="export-area">
<div class="container">
    <h2>Eligibility Calculator Salaried</h2>
    <form id="eligibilityForm" action="{{ route('calculate.eligibility.salaried') }}" method="POST">
        @csrf

        <!-- Customer Name -->
        <h2>Customer Name: {{ $data['userDetails']->name }}</h2>
        <div class="text-right mb-3">
            <a href="{{ route('export.eligibility') }}" class="btn btn-success">
                Export to Excel
            </a>
            <button onclick="exportToPdf()" class="btn btn-primary">Export as PDF</button>
        </div>
        <!-- Salary input (Fixed) -->
        <div class="form-group">
            <label for="salary">Salary (Monthly)</label>
            <input type="number" name="salary" id="salary" class="form-control" placeholder="Enter your salary" 
                value="{{ $data['userDetails']->netsalary ?? '' }}" required oninput="calculateTotalIncome()">
        </div>

        <!-- Tax Input -->
        <div class="row">
            <!-- Yearly Tax Amount -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tax_amount">Income Tax Amount (Yearly)</label>
                    <input type="number" name="tax_amount" id="tax_amount" class="form-control" placeholder="Enter Tax Amount" required value="{{ $taxAmount ?? '' }}" oninput="calculateMonthlyTax()">
                </div>
            </div>

            <!-- Average Monthly Tax -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="avg_monthly_tax">Average Monthly Tax</label>
                    <input type="text" id="avg_monthly_tax" class="form-control" placeholder="Avg Monthly Tax" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Provisional Fund (monthly)</label>
            <div id="provisionalFundContainer">
                <div class="row provisional-fund-row">
                    <div class="col-md-6 mt-2">
                    <input type="text" name="provisional_fund_name[]" class="form-control" value="Provisional Fund PF" readonly>
                    </div>
                    <div class="col-md-5 mt-2">
                        <input type="number" name="provisional_fund_amount[]" class="form-control" placeholder="Enter fund amount">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Professional Tax (monthly)</label>
            <div id="professionalTaxContainer">
                <div class="row professional-tax-row">
                    <div class="col-md-6 mt-2">
                        <input type="text" name="professional_tax_name[]" class="form-control" value="Professional Tax" readonly>
                    </div>
                    <div class="col-md-5 mt-2">
                        <input type="number" name="professional_tax_amount[]" class="form-control" placeholder="Enter tax amount" oninput="calculateTotalDeductions()">
                    </div>
                </div>
            </div>
        </div>

        <!-- Deduction Section -->
        <div class="form-group">
    <label>Deductions (monthly)</label>
    <div id="deductionContainer">
        <div class="row deduction-row">
            <div class="col-md-6 mt-2">
                <input type="text" name="deduction_name[]" class="form-control" placeholder="Enter deduction name">
            </div>
            <div class="col-md-5 mt-2">
                <input type="number" name="deduction_amount[]" class="form-control" placeholder="Enter deduction amount" oninput="calculateTotalDeductions()">
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addDeductionRow()"></i>
                <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeDeductionRow(this)"></i>
            </div>
        </div>
    </div>
    <input type="hidden" id="total_deductions" value="0">
</div>
             <!-- Co-applicant Checkbox -->
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="coApplicantCheckbox" name="co_applicant" value="1" onclick="toggleCoApplicantSection()">
                <input type="hidden" name="has_coapplicant" value="0"> 
                <label class="form-check-label" for="coApplicantCheckbox">Include Co-applicant</label>
            </div>

            <!-- Co-applicant section (hidden by default) -->
            <div id="coApplicantSection" style="display: none;">
            <h3>Co-applicant Details</h3>

            <div class="form-row">
            <!-- Co-applicant Salary input -->
            <div class="form-group col-md-6">
                <label for="coapplicant_salary">Co-applicant Income from Business (Yearly)</label>
                <input type="number" name="coapplicant_salary" id="coapplicant_salary" class="form-control" 
                    placeholder="Enter co-applicant's salary" 
                    value="{{ old('coapplicant_salary', $eligibilityCriteria->income_from_business_amount ?? '') }}" 
                    oninput="calculateTotalIncome()">
            </div>

            <!-- Monthly Average Salary (read-only) -->
            <div class="form-group col-md-6">
                <label for="coapplicant_monthly_avg">Co-applicant Monthly Average Salary</label>
                <input type="text" id="coapplicant_monthly_avg" class="form-control" 
                    placeholder="Monthly average" 
                    value="{{ old('coapplicant_monthly_avg', number_format(($eligibilityCriteria->income_from_business_amount ?? 0) / 12, 2)) }}" 
                    readonly>
                </div>
            </div>

        
        <!-- Co-applicant Tax Input -->
        <div class="row">
            <!-- Yearly Tax Amount for Co-applicant -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="coapplicant_tax_amount">Co-applicant Income Tax Amount (Yearly)</label>
                    <input type="number" name="coapplicant_tax_amount" id="coapplicant_tax_amount" class="form-control" placeholder="Enter Co-applicant Tax Amount"  value="{{ $coapplicantTaxAmount ?? '' }}" oninput="calculateCoapplicantMonthlyTax()">
                </div>
            </div>

            <!-- Average Monthly Tax for Co-applicant -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="coapplicant_avg_monthly_tax">Co-applicant Average Monthly Tax</label>
                    <input type="text" id="coapplicant_avg_monthly_tax" class="form-control" placeholder="Avg Monthly Tax" readonly>
                </div>
            </div>
        </div>
    <!-- Co-Applicant Deductions Section -->
    <div class="form-group">
        <label>Co-Applicant Deductions (monthly)</label>
        <div id="coApplicantDeductionContainer">
            <div class="row deduction-row">
                <div class="col-md-5">
                    <input type="text" name="coapplicant_deduction_json[]" class="form-control" placeholder="Enter deduction name">
                </div>
                <div class="col-md-5">
                    <input type="number" name="coapplicant_deduction_amount[]" class="form-control" placeholder="Enter deduction amount">
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoApplicantDeductionRow()"></i>
                </div>
            </div>
        </div>
    </div>
        </div>

        <!-- FOIR Bank Dropdown -->
        <div class="form-group">
            <label for="bank_id">Select Bank</label>
            <select name="bank_id" id="bank_id" class="form-control" required>
                <option value="">--Select Bank--</option>
                @foreach($data['foirBanks'] as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->bank_name }} (FOIR: {{ $bank->foir_percentage }}%)</option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Calculate Eligibility</button>
    </form>
    <br>
    <div id="results" class="container mt-3">
            <h3>Eligibility Results</h3>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="totalIncome">Total Income:</label>
                    <input type="text" id="totalIncome" class="form-control" value="0" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label for="taxAmount">Tax Amount:</label>
                    <input type="text" id="taxAmount" class="form-control" value="0" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="remainingIncomeAfterTax">Remaining Income After Tax:</label>
                    <input type="text" id="remainingIncomeAfterTax" class="form-control" value="0" readonly>
                </div>
                <div class="col-md-6 form-group">
                    <label for="proposedEmi">Proposed EMI:</label>
                    <input type="text" id="proposedEmi" class="form-control" value="0" readonly>
                </div>
            </div>
        </div>
       <!-- EMI Calculator Section -->
        <h2>EMI Calculator</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="loan_amount">Loan Amount</label>
                    <input type="number" id="loan_amount" class="form-control" placeholder="Enter Loan Amount" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="interest_rate">Interest Rate (%)</label>
                    <input type="number" id="interest_rate" class="form-control" placeholder="Enter Interest Rate" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="tenure">Tenure (Months)</label>
                    <input type="number" id="tenure" class="form-control" placeholder="Enter Tenure in Months" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Monthly EMI</label>
                    <input type="text" id="monthly_emi" class="form-control" placeholder="Calculated EMI" readonly>
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="calculateEMI()">Calculate EMI</button>
        </div>
        <!-- Reverse EMI Calculator Section -->
<h2>Reverse EMI Calculator</h2>
<div class="container">
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="desired_emi">Desired EMI</label>
            <input type="number" id="desired_emi" class="form-control" placeholder="Enter Desired EMI" required>
        </div>
        <div class="col-md-6 form-group">
            <label for="reverse_interest_rate">Interest Rate (%)</label>
            <input type="number" id="reverse_interest_rate" class="form-control" placeholder="Enter Interest Rate" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="reverse_tenure">Tenure (Months)</label>
            <input type="number" id="reverse_tenure" class="form-control" placeholder="Enter Tenure in Months" required>
        </div>
        <div class="col-md-6 form-group">
            <label>Maximum Loan Amount</label>
            <input type="text" id="max_loan_amount" class="form-control" placeholder="Calculated Loan Amount" readonly>
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="calculateMaxLoanAmount()">Calculate Max Loan Amount</button>
</div>
</div>
</div>
<script>
    // emi calculator
    function calculateEMI() {
        const loanAmount = parseFloat(document.getElementById('loan_amount').value) || 0;
        const interestRate = parseFloat(document.getElementById('interest_rate').value) || 0;
        const tenure = parseFloat(document.getElementById('tenure').value) || 0;

        if (loanAmount > 0 && interestRate > 0 && tenure > 0) {
            const monthlyInterestRate = interestRate / 100 / 12;
            const emi = (loanAmount * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, tenure)) / (Math.pow(1 + monthlyInterestRate, tenure) - 1);
            
            // Round off to the nearest whole number
            const roundedEMI = Math.round(emi);
            
            // Display the rounded EMI
            document.getElementById('monthly_emi').value = roundedEMI.toLocaleString(); // Format with commas
        } else {
            document.getElementById('monthly_emi').value = '';
        }
    }
</script>
<script>
    function calculateMaxLoanAmount() {
        const desiredEMI = parseFloat(document.getElementById('desired_emi').value) || 0;
        const interestRate = parseFloat(document.getElementById('reverse_interest_rate').value) || 0;
        const tenure = parseFloat(document.getElementById('reverse_tenure').value) || 0;

        if (desiredEMI > 0 && interestRate > 0 && tenure > 0) {
            const monthlyInterestRate = interestRate / 100 / 12;
            
            // Calculate the maximum loan amount using the formula for EMI
            const maxLoanAmount = (desiredEMI * (Math.pow(1 + monthlyInterestRate, tenure) - 1)) / (monthlyInterestRate * Math.pow(1 + monthlyInterestRate, tenure));
            
            // Round off to the nearest whole number
            const roundedMaxLoanAmount = Math.round(maxLoanAmount);
            
            // Display the rounded maximum loan amount
            document.getElementById('max_loan_amount').value = roundedMaxLoanAmount.toLocaleString(); // Format with commas
        } else {
            document.getElementById('max_loan_amount').value = '';
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Assuming you're using jQuery to handle the form submission
    $('#eligibilityForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: $(this).attr('action'), // Use the action attribute of the form
            method: 'POST',
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                // Update the results in the result div
                $('#totalIncome').val(response.totalIncome); // Use .val() for input fields
                $('#taxAmount').val(response.taxAmount);
                $('#remainingIncomeAfterTax').val(response.remainingIncomeAfterTax);
                $('#proposedEmi').val(response.proposedEmi);
                $('#bankName').text(response.bankName); // Assuming bankName is still displayed elsewhere
            },
            error: function(xhr) {
                // Handle error (optional)
                alert('An error occurred while calculating eligibility.');
            }
        });
    });
</script>
<!-- Script to calculate the average salary -->
<script>
    function calculateMonthlyTax() {
        const taxAmount = parseFloat(document.getElementById('tax_amount').value) || 0; // User Tax
        const avgMonthlyTax = (taxAmount / 12).toFixed(2); // Calculate average monthly tax for user
        document.getElementById('avg_monthly_tax').value = avgMonthlyTax; // Update user avg monthly tax field
    }

    function calculateCoapplicantMonthlyTax() {
        const coapplicantTaxAmount = parseFloat(document.getElementById('coapplicant_tax_amount').value) || 0; // Co-applicant Tax
        const avgCoapplicantMonthlyTax = (coapplicantTaxAmount / 12).toFixed(2); // Calculate average monthly tax for co-applicant
        document.getElementById('coapplicant_avg_monthly_tax').value = avgCoapplicantMonthlyTax; // Update co-applicant avg monthly tax field
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Calculate initial values on page load
        calculateMonthlyTax();
        calculateCoapplicantMonthlyTax();

        // Attach event listeners to tax amount input fields
        document.getElementById('tax_amount').addEventListener('input', calculateMonthlyTax);
        document.getElementById('coapplicant_tax_amount').addEventListener('input', calculateCoapplicantMonthlyTax);
    });
</script>
<script>
    function addDeductionRow() {
        const container = document.getElementById('deductionContainer');
        const newRow = document.createElement('div');
        newRow.className = 'row deduction-row';
        newRow.innerHTML = `
            <div class="col-md-6 mt-2">
                <input type="text" name="deduction_name[]" class="form-control" placeholder="Enter deduction name">
            </div>
            <div class="col-md-5 mt-2">
                <input type="number" name="deduction_amount[]" class="form-control" placeholder="Enter deduction amount" oninput="calculateTotalDeductions()">
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addDeductionRow()"></i>
                <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeDeductionRow(this)"></i>
            </div>`;
        container.appendChild(newRow);
        updateRemoveIconsVisibility();
        calculateTotalDeductions();
    }

    function removeDeductionRow(icon) {
        const row = icon.closest('.row');
        row.remove();
        updateRemoveIconsVisibility();
        calculateTotalDeductions();
    }

    function calculateTotalDeductions() {
    const deductionRows = document.querySelectorAll('input[name="deduction_amount[]"]');
    const provisionalFundRows = document.querySelectorAll('input[name="provisional_fund_amount[]"]');
    const professionalTaxRows = document.querySelectorAll('input[name="professional_tax_amount[]"]');
    let totalDeductions = 0;

    // Sum up deduction amounts
    deductionRows.forEach(input => {
        const amount = parseFloat(input.value) || 0;
        totalDeductions += amount;
    });

    // Sum up provisional fund amounts
    provisionalFundRows.forEach(input => {
        const amount = parseFloat(input.value) || 0;
        totalDeductions += amount;
    });

    // Sum up professional tax amounts
    professionalTaxRows.forEach(input => {
        const amount = parseFloat(input.value) || 0;
        totalDeductions += amount;
    });

    document.getElementById('total_deductions').value = totalDeductions;
    calculateNetIncome();
}

    function calculateNetIncome() {
        const totalIncome = parseFloat(document.getElementById('total_income').value) || 0;
        const totalDeductions = parseFloat(document.getElementById('total_deductions').value) || 0;
        const netIncome = totalIncome - totalDeductions;
        document.getElementById('net_income').value = netIncome;
        console.log(`Total Income: ${totalIncome}, Total Deductions: ${totalDeductions}, Net Income: ${netIncome}`);
    }

    // Additional event listeners and setup
    document.addEventListener('DOMContentLoaded', function () {
        const deductionRows = document.querySelectorAll('input[name="deduction_amount[]"]');
        deductionRows.forEach(input => {
            input.addEventListener('input', calculateTotalDeductions);
        });
        calculateTotalIncome();
    });

    function updateRemoveIconsVisibility() {
        const deductionRows = document.querySelectorAll('.deduction-row');
        deductionRows.forEach((row, index) => {
            const removeIcon = row.querySelector('.remove-income-icon');
            removeIcon.style.display = deductionRows.length > 1 ? 'inline' : 'none';
        });
    }
</script>
<script>
    // Toggle the visibility of co-applicant section based on checkbox status
    function toggleCoApplicantSection() {
    var coApplicantSection = document.getElementById('coApplicantSection');
    var coApplicantCheckbox = document.getElementById('coApplicantCheckbox');
    var coApplicantFields = document.querySelectorAll('.coapplicant-field');

    if (coApplicantCheckbox.checked) {
        coApplicantSection.style.display = 'block';
        // Enable co-applicant fields
        coApplicantFields.forEach(field => field.disabled = false);
    } else {
        coApplicantSection.style.display = 'none';
        // Disable co-applicant fields
        coApplicantFields.forEach(field => field.disabled = true);
    }
}
</script>
<script>
    function exportToPdf() {
        const originalContents = document.body.innerHTML; // Save original content
        const exportArea = document.getElementById('export-area').innerHTML; // Get printable content

        // Set body to only include printable content
        document.body.innerHTML = exportArea;

        // Trigger the print dialog
        window.print();

        // Restore the original content after printing
        document.body.innerHTML = originalContents;

        location.reload(); // Reload the page to reset any dynamic functionality
    }
</script>

@endsection
