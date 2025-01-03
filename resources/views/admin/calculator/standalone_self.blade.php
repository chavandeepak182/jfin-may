@extends('layouts.header')
@section('content')

<style>
    body{
        color: #fff !important;
    }
</style>

<div class="container">
    <h2>Eligibility Calculator Self</h2>
<!-- kdkkd -->
    <form id="eligibilityForm" action="{{ route('calculateEligibilitystandalone') }}" method="POST">
        @csrf
        <!-- Salary input (Fixed) -->
        <div class="form-group">
            <label for="salary">Income from Business (Yearly)</label>
            <input type="number" name="salary" id="salary" class="form-control" placeholder="Enter your salary" 
                value="{{ $data['userDetails']->netsalary ?? '' }}" required oninput="calculateTotalIncome()">
        </div>

        <!-- Average Monthly Salary -->
        <div class="form-group">
            <label>Average Monthly Salary</label>
            <input type="text" id="avg_salary" class="form-control" placeholder="Average Monthly Salary" readonly>
        </div>
        <div class="form-group">
            <label>Remuneration Income (Yearly)</label>
            <div id="remunerationIncomeContainer">
                <!-- Default empty data -->
                <div class="row remuneration-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="remunration_income_json[]" class="form-control" placeholder="Enter remuneration income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="remunration_income_amount[]" class="form-control remuneration-income" placeholder="Enter remuneration income amount (Yearly)" oninput="calculateAvgMonthlyIncome(this)">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-remuneration-income" placeholder="Avg Monthly Remuneration" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-remuneration-income-icon" style="cursor: pointer;" onclick="addRemunerationIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rental Income Section -->
        <div class="form-group">
            <label>Rental Income (Yearly)</label>
            <div id="rentIncomeContainer">
                <!-- Default empty data -->
                <div class="row rent-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="rent_income_name[]" class="form-control" placeholder="Enter rental income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="rent_income_amount[]" class="form-control rent-income" placeholder="Enter rent income amount (Yearly)" oninput="calculateTotalIncome()">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-rent-income" placeholder="Avg Monthly Rent" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addRentIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit Share Income Section -->
        <div class="form-group">
            <label>Profit Share Income (Yearly)</label>
            <div id="profitShareIncomeContainer">
                <!-- Default empty data -->
                <div class="row profit-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="firm_share_profit_json[]" class="form-control" placeholder="Enter Profit share income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="firm_share_profit_amount[]" class="form-control profit-income" placeholder="Enter Profit share income amount (Yearly)" oninput="calculateTotalIncome(this)">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-profit-income" placeholder="Avg Monthly Profit" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addProfitShareIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Income Section -->
        <div class="form-group">
            <label>Agriculture Income (Yearly)</label>
            <div id="agricultureIncomeContainer">
                <!-- Default empty data -->
                <div class="row agriculture-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="agriculture_income_json[]" class="form-control" placeholder="Enter agriculture income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="agriculture_income_amount[]" class="form-control agriculture-income" placeholder="Enter agriculture income amount (Yearly)" oninput="calculateTotalIncome()">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-agriculture-income" placeholder="Avg Monthly Income" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addAgricultureIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Monthly Income Display -->
        <div class="form-group">
            <label>Total Monthly Income</label>
            <input type="text" id="total_income" class="form-control" placeholder="Total Monthly Income" readonly>
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


        <!-- Deduction Section -->
        <div class="form-group">
            <label>Deductions (monthly)</label>
            <div id="deductionContainer">
                <!-- Default empty data -->
                <div class="row deduction-row">
                    <div class="col-md-6 mt-2">
                        <input type="text" name="deduction_json[]" class="form-control" placeholder="Enter deduction name">
                    </div>
                    <div class="col-md-5 mt-2">
                        <input type="number" name="deduction_amount[]" class="form-control" placeholder="Enter deduction amount">
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addDeductionRow()"></i>
                    </div>
                </div>
            </div>
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

        <!-- Co-applicant Remuneration Income -->
        <div class="form-group">
            <label>Co-applicant Remuneration Income (Yearly)</label>
            <div id="coapplicantRemunerationIncomeContainer">
                <!-- Default empty data -->
                <div class="row coapplicant-remuneration-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="coapplicant_remunration_income_json[]" class="form-control" placeholder="Enter remuneration income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="coapplicant_remunration_income_amount[]" class="form-control coapplicant-remuneration-income" placeholder="Enter remuneration income amount (Yearly)" oninput="calculateAvgMonthlyIncome(this)">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-coapplicant-remuneration-income" placeholder="Avg Monthly Remuneration" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-coapplicant-remuneration-income-icon" style="cursor: pointer;" onclick="addCoapplicantRemunerationIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>
<!-- Co-Applicant Rental Income Section -->
        <div class="form-group">
            <label>Co-Applicant Rental Income (Yearly)</label>
            <div id="coapplicantRentIncomeContainer">
                <!-- Default empty data -->
                <div class="row rent-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="coapplicant_rent_income_name[]" class="form-control" placeholder="Enter co-applicant rental income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="coapplicant_rent_income_amount[]" class="form-control rent-income" placeholder="Enter co-applicant rent income amount (Yearly)" oninput="calculateTotalIncome()">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-coapplicant-rent-income" placeholder="Avg Monthly Rent" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoapplicantRentIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>
<!-- Co-Applicant Profit Share Income Section -->
        <div class="form-group">
            <label>Co-Applicant Profit Share Income (Yearly)</label>
            <div id="coApplicantProfitShareIncomeContainer">
                <!-- Default empty data -->
                <div class="row profit-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="co_firm_share_profit_json[]" class="form-control" placeholder="Enter Profit share income name">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="co_firm_share_profit_amount[]" class="form-control profit-income" placeholder="Enter Profit share income amount (Yearly)" oninput="calculateTotalIncome()">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-profit-income" placeholder="Avg Monthly Profit" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoProfitShareIncomeRow()"></i>
                    </div>
                </div>
            </div>
        </div>
<!-- coapplicant aggricultrue income -->
<div class="form-group">
    <label>Co-Applicant Agriculture Income (Yearly)</label>
    <div id="coApplicantAgricultureIncomeContainer">
        @php
            $coApplicantAgricultureIncomeData = isset($data['coApplicantCriteria']) && !empty($data['coApplicantCriteria']->agriculture_income_json)
                ? json_decode($data['coApplicantCriteria']->agriculture_income_json, true)
                : [];
        @endphp

        @if(!empty($coApplicantAgricultureIncomeData))
            @foreach($coApplicantAgricultureIncomeData as $income)
                <div class="row agriculture-income-row">
                    <div class="col-md-5 mt-2">
                        <input type="text" name="co_agriculture_income_json[]" class="form-control" placeholder="Enter agriculture income name" value="{{ $income['source'] ?? '' }}">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="number" name="co_agriculture_income_amount[]" class="form-control agriculture-income" placeholder="Enter agriculture income amount (Yearly)" value="{{ $income['amount'] ?? '' }}" oninput="calculateTotalIncome()">
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="text" class="form-control avg-agriculture-income" placeholder="Avg Monthly Income" readonly>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoAgricultureIncomeRow()"></i>
                        <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeIncomeRow(this)" style="display: none;"></i>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row agriculture-income-row">
                <div class="col-md-5 mt-2">
                    <input type="text" name="co_agriculture_income_json[]" class="form-control" placeholder="Enter agriculture income name">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="number" name="co_agriculture_income_amount[]" class="form-control agriculture-income" placeholder="Enter agriculture income amount (Yearly)" oninput="calculateTotalIncome()">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control avg-agriculture-income" placeholder="Avg Monthly Income" readonly>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoAgricultureIncomeRow()"></i>
                    <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeIncomeRow(this)" style="display: none;"></i>
                </div>
            </div>
        @endif
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
    // Function to calculate total income from all sources and update monthly average
    function calculateTotalIncome() {
    const salary = parseFloat(document.getElementById('salary').value) || 0;
    const coapplicantSalary = parseFloat(document.getElementById('coapplicant_salary').value) || 0;
    const avgSalary = (salary / 12).toFixed(2);
    document.getElementById('avg_salary').value = avgSalary;

    // Calculate total incomes from different sources
    const rentalIncomes = Array.from(document.querySelectorAll('.rent-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);
    const coapplicantRentalIncomes = Array.from(document.querySelectorAll('.coapplicant-rent-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);
    const coapplicantProfitShares = Array.from(document.querySelectorAll('.coapplicant-profit-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0); // Co-applicant profit shares
    const profitShares = Array.from(document.querySelectorAll('.profit-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);
    const otherIncomes = Array.from(document.querySelectorAll('.other-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);
    const remunerationIncomes = Array.from(document.querySelectorAll('.remuneration-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);
    const agricultureIncomes = Array.from(document.querySelectorAll('.agriculture-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);

    // Co-applicant remuneration income
    const coapplicantRemunerationIncomes = Array.from(document.querySelectorAll('.coapplicant-remuneration-income')).reduce((total, input) => total + (parseFloat(input.value) || 0), 0);

    // Calculate total yearly income including co-applicant's income
    const totalYearlyIncome = salary + coapplicantSalary + rentalIncomes + coapplicantRentalIncomes + profitShares + otherIncomes + remunerationIncomes + agricultureIncomes + coapplicantRemunerationIncomes;

    // Calculate total monthly income
    const totalMonthlyIncome = (totalYearlyIncome / 12).toFixed(2);
    document.getElementById('total_income').value = totalMonthlyIncome;

    // Call the function to update monthly averages
    updateMonthlyAverages();

}

    function updateMonthlyAverages() {
        // Update monthly averages for rental income
        document.querySelectorAll('.avg-rent-income').forEach(input => {
            const yearlyRent = parseFloat(input.closest('.rent-income-row').querySelector('.rent-income').value) || 0;
            input.value = (yearlyRent / 12).toFixed(2);
        });
       // Update monthly averages for co-applicant rental income
    document.querySelectorAll('.avg-coapplicant-rent-income').forEach(input => {
        const yearlyRent = parseFloat(input.closest('.rent-income-row').querySelector('.rent-income').value) || 0;
        input.value = (yearlyRent / 12).toFixed(2);
    });

        // Update monthly averages for profit income
        document.querySelectorAll('.avg-profit-income').forEach(input => {
            const yearlyProfit = parseFloat(input.closest('.profit-income-row').querySelector('.profit-income').value) || 0;
            input.value = (yearlyProfit / 12).toFixed(2);
        });

        // Update monthly averages for co-applicant profit income
        document.querySelectorAll('.avg-coapplicant-profit-income').forEach(input => {
            const yearlyProfit = parseFloat(input.closest('.profit-income-row').querySelector('.coapplicant-profit-income').value) || 0; // Update to correct class
            input.value = (yearlyProfit / 12).toFixed(2);
        });

        // Update monthly averages for agriculture income
        document.querySelectorAll('.avg-agriculture-income').forEach(input => {
            const yearlyAgriculture = parseFloat(input.closest('.agriculture-income-row').querySelector('.agriculture-income').value) || 0;
            input.value = (yearlyAgriculture / 12).toFixed(2);
        });

        // Update monthly averages for remuneration income
        document.querySelectorAll('.avg-remuneration-income').forEach(input => {
            const yearlyRemuneration = parseFloat(input.closest('.remuneration-income-row').querySelector('.remuneration-income').value) || 0;
            input.value = (yearlyRemuneration / 12).toFixed(2);
        });
    }

    // Handle dynamic rows and event listeners
    function addIncomeRow(containerId, incomeClass) {
    const container = document.getElementById(containerId);
    const row = container.querySelector('.row').cloneNode(true);

    row.querySelectorAll('input').forEach(input => input.value = ''); // Clear inputs

    row.querySelector(incomeClass).addEventListener('input', calculateTotalIncome); // Add input event

    const removeIcon = document.createElement('i');
        removeIcon.classList.add('fas', 'fa-minus', 'remove-income-icon');
        removeIcon.style.cursor = 'pointer';
        row.querySelector('.add-income-icon').replaceWith(removeIcon);

    removeIcon.addEventListener('click', function () {
        row.remove();
        calculateTotalIncome(); // Recalculate after row removal
    });

    container.appendChild(row);
}


    // Event listeners for adding new rows dynamically
    document.querySelectorAll('.add-income-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const containerId = this.dataset.containerId; // Use dataset to identify container
            const incomeClass = this.dataset.incomeClass; // Class of input to listen for

            addIncomeRow(containerId, incomeClass);
        });
    });

    // Set up event listeners for initial inputs
    document.querySelectorAll('.rent-income, .coapplicant-rent-income, .profit-income,.coapplicant-profit-income, .other-income, .remuneration-income, .agriculture-income, .coapplicant-remuneration-income').forEach(input => {
    input.addEventListener('input', calculateTotalIncome);
});

    // Recalculate total income on page load
    window.addEventListener('load', calculateTotalIncome);
</script>

<script>
    function calculateAvgMonthlyIncome(element) {
        const yearlyAmount = parseFloat(element.value);
        const row = element.closest('.remuneration-income-row');
        const avgMonthlyInput = row.querySelector('.avg-remuneration-income');
        
        // Calculate average monthly remuneration
        if (!isNaN(yearlyAmount)) {
            const avgMonthlyIncome = (yearlyAmount / 12).toFixed(2);
            avgMonthlyInput.value = avgMonthlyIncome;
        } else {
            avgMonthlyInput.value = ''; // Clear if input is invalid
        }
    }

    function addRemunerationIncomeRow() {
    const container = document.getElementById('remunerationIncomeContainer');
    const newRow = document.createElement('div');
    newRow.className = 'row remuneration-income-row';
    newRow.innerHTML = `
        <div class="col-md-5 mt-2">
            <input type="text" name="remunration_income_json[]" class="form-control" placeholder="Enter remuneration income name">
        </div>
        <div class="col-md-3 mt-2">
            <input type="number" name="remunration_income_amount[]" class="form-control remuneration-income" placeholder="Enter remuneration income amount (Yearly)" oninput="calculateAvgMonthlyIncome(this)">
        </div>
        <div class="col-md-3 mt-2">
            <input type="text" class="form-control avg-remuneration-income" placeholder="Avg Monthly Remuneration" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-plus add-remuneration-income-icon" style="cursor: pointer;" onclick="addRemunerationIncomeRow()"></i>
            <i class="fas fa-minus remove-income-icon" style="cursor: pointer;" onclick="removeIncomeRow(this)" style="margin-left: 5px;"></i>
        </div>`;
    
    container.appendChild(newRow);
}

function removeIncomeRow(icon) {
    const row = icon.closest('.row');
    row.remove();
}
function addCoapplicantRemunerationIncomeRow() {
    const container = document.getElementById('coapplicantRemunerationIncomeContainer');
    const newRow = document.createElement('div');
    newRow.className = 'row remuneration-income-row';
    newRow.innerHTML = `
        <div class="col-md-5 mt-2">
            <input type="text" name="coapplicant_remunration_income_json[]" class="form-control" placeholder="Enter remuneration income name">
        </div>
        <div class="col-md-3 mt-2">
            <input type="number" name="coapplicant_remunration_income_amount[]" class="form-control coapplicant-remuneration-income" placeholder="Enter remuneration income amount (Yearly)" oninput="calculateAvgMonthlyIncome(this)">
        </div>
        <div class="col-md-3 mt-2">
            <input type="text" class="form-control avg-coapplicant-remuneration-income" placeholder="Avg Monthly Remuneration" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-plus add-remuneration-income-icon" style="cursor: pointer;" onclick="addCoapplicantRemunerationIncomeRow()"></i>
            <i class="fas fa-minus remove-income-icon" style="cursor: pointer;" onclick="removeIncomeRow(this)" style="margin-left: 5px;"></i>
        </div>`;
    
    container.appendChild(newRow);
}

function calculateAvgMonthlyIncome(element) {
    const yearlyAmount = parseFloat(element.value);
    const row = element.closest('.row');
    const avgMonthlyInput = row.querySelector('.avg-remuneration-income, .avg-coapplicant-remuneration-income');
    
    // Calculate average monthly remuneration
    if (!isNaN(yearlyAmount)) {
        const avgMonthlyIncome = (yearlyAmount / 12).toFixed(2);
        avgMonthlyInput.value = avgMonthlyIncome;
    } else {
        avgMonthlyInput.value = ''; // Clear if input is invalid
    }
}
</script>
<script>
function addRentIncomeRow() {
    const container = document.getElementById('rentIncomeContainer');
    const newRow = document.createElement('div');
    newRow.className = 'row rent-income-row';
    newRow.innerHTML = `
        <div class="col-md-5 mt-2">
            <input type="text" name="rent_income_name[]" class="form-control" placeholder="Enter rental income name">
        </div>
        <div class="col-md-3 mt-2">
            <input type="number" name="rent_income_amount[]" class="form-control rent-income" placeholder="Enter rent income amount (Yearly)" oninput="calculateTotalIncome()">
        </div>
        <div class="col-md-3 mt-2">
            <input type="text" class="form-control avg-rent-income" placeholder="Avg Monthly Rent" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addRentIncomeRow()"></i>
            <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeRentIncomeRow(this)"></i>
        </div>
    `;
    container.appendChild(newRow);
}

function addCoapplicantRentIncomeRow() {
    const container = document.getElementById('coapplicantRentIncomeContainer');
    const newRow = document.createElement('div');
    newRow.className = 'row rent-income-row';
    newRow.innerHTML = `
        <div class="col-md-5 mt-2">
            <input type="text" name="coapplicant_rent_income_name[]" class="form-control" placeholder="Enter co-applicant rental income name">
        </div>
        <div class="col-md-3 mt-2">
            <input type="number" name="coapplicant_rent_income_amount[]" class="form-control rent-income" placeholder="Enter co-applicant rent income amount (Yearly)" oninput="calculateTotalIncome()">
        </div>
        <div class="col-md-3 mt-2">
            <input type="text" class="form-control avg-rent-income" placeholder="Avg Monthly Rent" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoapplicantRentIncomeRow()"></i>
            <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeRentIncomeRow(this)"></i>
        </div>
    `;
    container.appendChild(newRow);
}

function removeRentIncomeRow(icon) {
    const row = icon.closest('.rent-income-row');
    row.remove();
    calculateTotalIncome(); // Recalculate totals after removing the row
}

function calculateTotalIncome() {
    let totalRentIncome = 0;

    // Calculate for main applicant
    const userRentRows = document.querySelectorAll('#rentIncomeContainer .rent-income-row');
    userRentRows.forEach(row => {
        const yearlyIncome = parseFloat(row.querySelector('input[name="rent_income_amount[]"]').value) || 0;
        const avgMonthlyRent = (yearlyIncome / 12).toFixed(2);
        row.querySelector('.avg-rent-income').value = avgMonthlyRent;
        totalRentIncome += yearlyIncome;
    });

    // Calculate for co-applicant
    const coapplicantRentRows = document.querySelectorAll('#coapplicantRentIncomeContainer .rent-income-row');
    coapplicantRentRows.forEach(row => {
        const yearlyIncome = parseFloat(row.querySelector('input[name="coapplicant_rent_income_amount[]"]').value) || 0;
        const avgMonthlyRent = (yearlyIncome / 12).toFixed(2);
        row.querySelector('.avg-rent-income').value = avgMonthlyRent;
        totalRentIncome += yearlyIncome;
    });

    // Update total rent income display (optional)
    document.getElementById('totalRentIncomeDisplay').textContent = 'Total Yearly Rent Income: ' + totalRentIncome;
}
</script>
<script>
    function addProfitShareIncomeRow() {
    const container = document.getElementById('profitShareIncomeContainer');
    const newRow = document.createElement('div');
    newRow.className = 'row profit-income-row';
    newRow.innerHTML = `
        <div class="col-md-5 mt-2">
            <input type="text" name="firm_share_profit_json[]" class="form-control" placeholder="Enter Profit share income name">
        </div>
        <div class="col-md-3 mt-2">
            <input type="number" name="firm_share_profit_amount[]" class="form-control profit-income" placeholder="Enter Profit share income amount (Yearly)" oninput="calculateTotalIncome(this)">
        </div>
        <div class="col-md-3 mt-2">
            <input type="text" class="form-control avg-profit-income" placeholder="Avg Monthly Profit" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addProfitShareIncomeRow()"></i>
            <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeIncomeRow(this)"></i>
        </div>`;
    container.appendChild(newRow);

    // Show the minus icon for all rows
    const allRows = container.getElementsByClassName('profit-income-row');
    if (allRows.length > 1) {
        Array.from(allRows).forEach((row) => {
            const minusIcon = row.querySelector('.remove-income-icon');
            minusIcon.style.display = 'inline'; // Show for all rows
        });
    }
}

function removeIncomeRow(icon) {
    const row = icon.closest('.row');
    row.remove();
    calculateTotalIncome(); // Recalculate total income after removing

    // Ensure the minus icon is hidden for the first remaining row if only one row is left
    const allRows = document.getElementById('profitShareIncomeContainer').getElementsByClassName('profit-income-row');
    if (allRows.length === 1) {
        const lastRowMinusIcon = allRows[0].querySelector('.remove-income-icon');
        lastRowMinusIcon.style.display = 'none'; // Hide for the last row
    }
}

function calculateTotalIncome(input) {
    const row = input.closest('.profit-income-row');
    const amount = parseFloat(input.value) || 0;
    const avgMonthlyIncomeField = row.querySelector('.avg-profit-income');
    
    // Calculate average monthly profit
    const avgMonthlyIncome = (amount / 12).toFixed(2);
    avgMonthlyIncomeField.value = avgMonthlyIncome;
}
// Function to add a new profit share income row for the co-applicant
function addCoProfitShareIncomeRow() {
    const container = document.getElementById('coApplicantProfitShareIncomeContainer');
    const row = document.createElement('div');
    row.classList.add('row', 'profit-income-row');
    row.innerHTML = `
        <div class="col-md-5 mt-2">
            <input type="text" name="co_firm_share_profit_json[]" class="form-control" placeholder="Enter Profit share income name">
        </div>
        <div class="col-md-3 mt-2">
            <input type="number" name="co_firm_share_profit_amount[]" class="form-control profit-income" placeholder="Enter Profit share income amount (Yearly)" oninput="calculateTotalIncome()">
        </div>
        <div class="col-md-3 mt-2">
            <input type="text" class="form-control avg-profit-income" placeholder="Avg Monthly Profit" readonly>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoProfitShareIncomeRow()"></i>
            <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeIncomeRow(this)"></i>
        </div>
    `;
    container.appendChild(row);
}

function removeIncomeRow(icon) {
    const row = icon.closest('.profit-income-row');
    if (row) {
        row.remove();
        calculateTotalIncome(); // Recalculate total income after row removal
    }
}
</script>
<script>
    function addDeductionRow() {
        const container = document.getElementById('deductionContainer');
        const newRow = document.createElement('div');
        newRow.className = 'row deduction-row';
        newRow.innerHTML = `
            <div class="col-md-5 mt-2">
                <input type="text" name="deduction_json[]" class="form-control" placeholder="Enter deduction name">
            </div>
            <div class="col-md-5 mt-2">
                <input type="number" name="deduction_amount[]" class="form-control" placeholder="Enter deduction amount">
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addDeductionRow()"></i>
                <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeDeductionRow(this)"></i>
            </div>`;

        container.appendChild(newRow);
        updateRemoveIconsVisibility();
    }

    function removeDeductionRow(icon) {
        const row = icon.closest('.row');
        row.remove();
        updateRemoveIconsVisibility();
    }

    function addCoApplicantDeductionRow() {
        const container = document.getElementById('coApplicantDeductionContainer');
        const newRow = document.createElement('div');
        newRow.className = 'row deduction-row';
        newRow.innerHTML = `
            <div class="col-md-5 mt-2">
                <input type="text" name="coapplicant_deduction_json[]" class="form-control" placeholder="Enter deduction name">
            </div>
            <div class="col-md-5 mt-2">
                <input type="number" name="coapplicant_deduction_amount[]" class="form-control" placeholder="Enter deduction amount">
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoApplicantDeductionRow()"></i>
                <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeDeductionRow(this)"></i>
            </div>`;

        container.appendChild(newRow);
        updateRemoveIconsVisibility();
    }

    function updateRemoveIconsVisibility() {
        const allRows = document.getElementById('deductionContainer').getElementsByClassName('deduction-row');
        Array.from(allRows).forEach((row) => {
            const minusIcon = row.querySelector('.remove-income-icon');
            minusIcon.style.display = allRows.length > 1 ? 'inline' : 'none';
        });

        const coApplicantRows = document.getElementById('coApplicantDeductionContainer').getElementsByClassName('deduction-row');
        Array.from(coApplicantRows).forEach((row) => {
            const minusIcon = row.querySelector('.remove-income-icon');
            minusIcon.style.display = coApplicantRows.length > 1 ? 'inline' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateRemoveIconsVisibility();
    });
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
    function addCoAgricultureIncomeRow() {
    const container = document.getElementById('coApplicantAgricultureIncomeContainer');
    const newRow = `
        <div class="row agriculture-income-row">
            <div class="col-md-5 mt-2">
                <input type="text" name="co_agriculture_income_json[]" class="form-control" placeholder="Enter agriculture income name">
            </div>
            <div class="col-md-3 mt-2">
                <input type="number" name="co_agriculture_income_amount[]" class="form-control agriculture-income" placeholder="Enter agriculture income amount (Yearly)" oninput="calculateTotalIncome()">
            </div>
            <div class="col-md-3 mt-2">
                <input type="text" class="form-control avg-agriculture-income" placeholder="Avg Monthly Income" readonly>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addCoAgricultureIncomeRow()"></i>
                <i class="fas fa-minus remove-income-icon" style="cursor: pointer; margin-left: 5px;" onclick="removeIncomeRow(this)"></i>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newRow);
}
function calculateAverageMonthlyIncome() {
    const incomeRows = document.querySelectorAll('.agriculture-income-row');
    incomeRows.forEach(row => {
        const amountInput = row.querySelector('input[name="co_agriculture_income_amount[]"]');
        const avgMonthlyInput = row.querySelector('.avg-agriculture-income');
        const yearlyIncome = parseFloat(amountInput.value) || 0;
        avgMonthlyInput.value = (yearlyIncome / 12).toFixed(2); // Calculate average monthly income
    });
}
</script>
<script>
    function calculateTotalIncome() {
        // Get the co-applicant's yearly income value
        let yearlySalary = document.getElementById('coapplicant_salary').value;
        
        // Calculate the monthly average salary (divide by 12 months)
        let monthlyAvgSalary = (yearlySalary / 12).toFixed(2);
        
        // Update the read-only monthly average field
        document.getElementById('coapplicant_monthly_avg').value = monthlyAvgSalary;
    }
</script>
@endsection
