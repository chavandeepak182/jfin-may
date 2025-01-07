@extends('frontend.layouts.header')
@section('scripts', "https://cdn.jsdelivr.net/npm/chart.js")

@section('content')

<style>
    .calculator-container, .result-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        /* max-width: 400px; */
        box-sizing: border-box;
    }

    .calculator-container h1 {
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .input-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .default-values {
        display: flex;
        gap: 10px;
        margin-top: 5px;
    }

    .default-values span {
        background-color: #f0f0f0;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .default-values span:hover {
        background-color: #e0e0e0;
    }

    .result h2 {
        color: #333;
    }

    #emiChart {
        margin-top: 20px;
    }

    #emi-details {
        margin-top: 20px;
        text-align: left;
        color: #555;
    }

    /* Responsive design */
    @media (min-width: 768px) {
        .container {
            flex-wrap: nowrap;
            justify-content: center;
            align-items: flex-start;
        }
        
        /* .calculator-container, .result-container {
            width: 45%;
        } */
    }

    @media (max-width: 480px) {
        .calculator-container h1 {
            font-size: 24px;
        }
        
        .result h2 {
            font-size: 16px;
        }
        
        #emi-details {
            font-size: 14px;
        }
    }
</style>

    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">EMI Calculator</h4>
            <!-- <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a class="text-primary" href="/">Home</a></li>
                <li class="breadcrumb-item active text-primary">About Us</li>
            </ol>     -->
        </div>
    </div>

    <div class="container py-5">
        <div class="row mt-2 pb-5 mb-5 g-5">
            <div class="col-md-5 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="calculator-container">
                    <h2>EMI Calculator</h2>
                    <div class="input-group">
                        <label for="loan-amount">Loan Amount (₹):</label>
                        <input type="number" id="loan-amount" value="500000" required>
                        <div class="default-values">
                            <span onclick="setDefaultValue('loan-amount', 5000000)">₹50,00,000</span>
                            <span onclick="setDefaultValue('loan-amount', 10000000)">₹1,00,00,000</span>
                            <span onclick="setDefaultValue('loan-amount', 50000000)">₹5,00,00,000</span>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="annual-rate">Annual Interest Rate (%):</label>
                        <input type="number" id="annual-rate" value="7.5" required>
                    </div>
                    <div class="input-group">
                        <label for="loan-tenure">Loan Tenure (Years):</label>
                        <input type="number" id="loan-tenure" value="20" required>
                    </div>
                    <button class="btn btn-primary py-2 px-4 w-40" onclick="calculateEMI()">Calculate</button>
                </div>
            </div>
            <div class="col-md-7 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="result-container">
                    <div class="result">
                        <h2>Monthly EMI: ₹<span id="emi-amount">0.00</span></h2>
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="emiChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <div id="emi-details"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let emiChart; // Declare the chart variable globally

        function calculateEMI() {
            let loanAmount = document.getElementById('loan-amount').value;
            let annualRate = document.getElementById('annual-rate').value;
            let loanTenure = document.getElementById('loan-tenure').value;

            if (loanAmount && annualRate && loanTenure) {
                let monthlyRate = annualRate / 12 / 100;
                let totalMonths = loanTenure * 12;

                let emi = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, totalMonths)) / (Math.pow(1 + monthlyRate, totalMonths) - 1);
                document.getElementById('emi-amount').innerText = formatRupee(emi);

                let totalPayment = emi * totalMonths;
                let totalInterest = totalPayment - loanAmount;

                let emiDetails = `
                    <p><strong>Loan Amount:</strong> ₹${formatRupee(loanAmount)}</p>
                    <p><strong>Annual Interest Rate:</strong> ${annualRate}%</p>
                    <p><strong>Loan Tenure:</strong> ${loanTenure} years</p>
                    <p><strong>Total Payment:</strong> ₹${formatRupee(totalPayment)}</p>
                    <p><strong>Total Interest:</strong> ₹${formatRupee(totalInterest)}</p>
                `;
                document.getElementById('emi-details').innerHTML = emiDetails;

                let ctx = document.getElementById('emiChart').getContext('2d');
                
                // Check if the chart already exists and destroy it
                if (emiChart) {
                    emiChart.destroy();
                }

                // Create a new chart
                emiChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Principal Loan Amount', 'Total Interest'],
                        datasets: [{
                            data: [loanAmount, totalInterest],
                            backgroundColor: ['#007BFF', '#FF5733'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            label += `₹${formatRupee(context.parsed)}`;
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                alert('Please fill in all fields.');
            }
        }

        function setDefaultValue(id, value) {
            document.getElementById(id).value = value;
            calculateEMI();
        }

        function formatRupee(amount) {
            return new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'INR',
                minimumFractionDigits: 2
            }).format(amount).replace('₹', '');
        }

        // Add event listener for Enter key press
        document.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                calculateEMI();
            }
        });
    </script>
@endsection

