<!-- coapplicant.blade.php -->
<div class="coapplicant-section">
    <h3>Co-applicant Details</h3>

    <!-- Co-applicant Income from Business -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="coapplicant_salary">Co-applicant Income from Business (Yearly)</label>
            <input type="number" name="coapplicant_salary[]" class="form-control" 
                   placeholder="Enter co-applicant's salary" 
                   oninput="calculateTotalIncome()">
        </div>

        <div class="form-group col-md-6">
            <label for="coapplicant_monthly_avg">Co-applicant Monthly Average Salary</label>
            <input type="text" class="form-control" placeholder="Monthly average" readonly>
        </div>
    </div>

    <!-- Co-applicant Remuneration Income -->
    <div class="form-group">
        <label>Co-applicant Remuneration Income (Yearly)</label>
        <div class="remuneration-income-container">
            <div class="row remuneration-income-row">
                <div class="col-md-5 mt-2">
                    <input type="text" name="coapplicant_remunration_income_json[]" class="form-control" placeholder="Enter remuneration income name">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="number" name="coapplicant_remunration_income_amount[]" class="form-control remuneration-income" placeholder="Enter remuneration income amount (Yearly)" oninput="calculateAvgMonthlyIncome(this)">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control avg-remuneration-income" placeholder="Avg Monthly Remuneration" readonly>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addIncomeRow('remuneration-income')"></i>
                    <i class="fas fa-minus remove-income-icon" style="cursor: pointer; display: none;" onclick="removeIncomeRow(this)"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Co-Applicant Rental Income -->
    <div class="form-group">
        <label>Co-Applicant Rental Income (Yearly)</label>
        <div class="rental-income-container">
            <div class="row rental-income-row">
                <div class="col-md-5 mt-2">
                    <input type="text" name="coapplicant_rent_income_name[]" class="form-control" placeholder="Enter co-applicant rental income name">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="number" name="coapplicant_rent_income_amount[]" class="form-control rent-income" placeholder="Enter rental income amount (Yearly)" oninput="calculateTotalIncome()">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control avg-rent-income" placeholder="Avg Monthly Rent" readonly>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addIncomeRow('rental-income')"></i>
                    <i class="fas fa-minus remove-income-icon" style="cursor: pointer; display: none;" onclick="removeIncomeRow(this)"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Co-Applicant Profit Share Income -->
    <div class="form-group">
        <label>Co-Applicant Profit Share Income (Yearly)</label>
        <div class="profit-share-income-container">
            <div class="row profit-income-row">
                <div class="col-md-5 mt-2">
                    <input type="text" name="co_firm_share_profit_json[]" class="form-control" placeholder="Enter Profit share income name">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="number" name="co_firm_share_profit_amount[]" class="form-control profit-income" placeholder="Enter profit share income amount (Yearly)" oninput="calculateTotalIncome()">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control avg-profit-income" placeholder="Avg Monthly Profit" readonly>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addIncomeRow('profit-income')"></i>
                    <i class="fas fa-minus remove-income-icon" style="cursor: pointer; display: none;" onclick="removeIncomeRow(this)"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Co-Applicant Agriculture Income -->
    <div class="form-group">
        <label>Co-Applicant Agriculture Income (Yearly)</label>
        <div class="agriculture-income-container">
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
                    <i class="fas fa-plus add-income-icon" style="cursor: pointer;" onclick="addIncomeRow('agriculture-income')"></i>
                    <i class="fas fa-minus remove-income-icon" style="cursor: pointer; display: none;" onclick="removeIncomeRow(this)"></i>
                </div>
            </div>
        </div>
    </div>
</div>
