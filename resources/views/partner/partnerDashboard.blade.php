
@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
    <style>

        .topbar {
    height: 4.375rem;
    background-color:#f7f7f7;
    }

    #wrapper #content-wrapper #content {
    flex: 1 0 auto;
    background-color: #fff;
}
    </style>







    <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid bg-white">

            <!-- ================= ROW 1 : METRICS ================= -->
            <div class="row pt-5 pb-4">
                <div class="col-12">
                    <div class="metrics-grid">
                        <!-- Total Loans -->
                     <a href="{{ route('allProperties') }}" class="metric-link">
                            <div class="metric-card">
                                <div class="metric-icon purple">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="metric-content">
                                    <h3>Total Property</h3>
                                    <div class="metric-value">{{ $totalProperties ?? 0 }}</div>
                                    <div class="metric-change positive">
                                        <i class="fas fa-arrow-up"></i>
                                        <span>+12.5%</span>
                                        <span class="metric-subtext">+$180K from last month</span>
                                    </div>
                                </div>
                            </div>
                        </a>


                        <!-- Total Leads -->
                        <a href="{{ route('allProperties') }}" class="metric-link">
                            <div class="metric-card">
                                <div class="metric-icon yellow">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <div class="metric-content">
                                    <h3>Pending Property</h3>
                                    <div class="metric-value">{{ $pendingProperties ?? 0 }}</div>
                                    <div class="metric-change positive">
                                        <i class="fas fa-arrow-up"></i>
                                        <span>+8.2%</span>
                                        <span class="metric-subtext">+94 from last month</span>
                                    </div>
                                </div>
                            </div>
                        </a>


                        <!-- Total Employees -->
                       <a href="{{ route('partner.pending.leads') }}" class="metric-link">
    <div class="metric-card">
        <div class="metric-icon green">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="metric-content">
            <h3>Pending Application</h3>
            <div class="metric-value">{{ $pendingApplications }}</div>
            <div class="metric-change negative">
                <i class="fas fa-arrow-down"></i>
                <span>-5.1%</span>
                <span class="metric-subtext">23 less than previous month</span>
            </div>
        </div>
    </div>
</a>


                        <!-- Total Customers -->
                        
                    </div>
                </div>
            </div>

            <!-- ================= ROW 2 : CHARTS ================= -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h3>Loan Performance</h3>
                                <p>Monthly disbursement overview</p>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="loanPerformanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h3>Loan Status</h3>
                                <p>Current distribution</p>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="loanStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

          <!-- ================= ROW 3 : ALL LOANS + QUICK ACTIONS ================= -->
<div class="row mb-4">
    
    <!-- All Loans -->
    <div class="col-md-8">
        <div class="table-card-large">
            <div class="table-header-large">
                <h3>All Loans</h3>
            </div>

            <div class="table-container-large">
                <table class="loans-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="table-checkbox"></th>
                            <th>CUSTOMER</th>
                            <th>LOAN TYPE</th>
                            <th>CREDIT SCORE</th>
                            <th>AMOUNT</th>
                            <th>BANKS</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="table-checkbox"></td>
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">RA</div>
                                    <div class="customer-info">
                                        <div class="customer-name">Rahul Sharma</div>
                                        <div class="customer-id">#LN00125</div>
                                    </div>
                                </div>
                            </td>
                            <td>Home Loan</td>
                            <td>
                                <div class="credit-score-cell">
                                    <span class="credit-score-value">750</span>
                                    <span class="credit-score-label good">Good</span>
                                    <div class="credit-score-bar">
                                        <div class="credit-score-fill good" style="width:80%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>₹5,00,000</td>
                            <td>HDFC Bank</td>
                            <td>
                                <span class="status-badge approved">Approved</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <i class="fas fa-eye"></i>
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="table-checkbox"></td>
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">PS</div>
                                    <div class="customer-info">
                                        <div class="customer-name">Priya Singh</div>
                                        <div class="customer-id">#LN00126</div>
                                    </div>
                                </div>
                            </td>
                            <td>Personal Loan</td>
                            <td>
                                <div class="credit-score-cell">
                                    <span class="credit-score-value">690</span>
                                    <span class="credit-score-label good">Good</span>
                                    <div class="credit-score-bar">
                                        <div class="credit-score-fill good" style="width:70%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>₹2,50,000</td>
                            <td>ICICI Bank</td>
                            <td>
                                <span class="status-badge pending">Pending</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <i class="fas fa-eye"></i>
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" class="table-checkbox"></td>
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">AM</div>
                                    <div class="customer-info">
                                        <div class="customer-name">Amit Mehta</div>
                                        <div class="customer-id">#LN00127</div>
                                    </div>
                                </div>
                            </td>
                            <td>Car Loan</td>
                            <td>
                                <div class="credit-score-cell">
                                    <span class="credit-score-value">620</span>
                                    <span class="credit-score-label good">Average</span>
                                    <div class="credit-score-bar">
                                        <div class="credit-score-fill good" style="width:60%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>₹8,00,000</td>
                            <td>SBI Bank</td>
                            <td>
                                <span class="status-badge rejected">Rejected</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <i class="fas fa-eye"></i>
                                    <i class="fas fa-edit"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-4">
        <div class="quick-actions-card">
            <h3>Quick Actions</h3>
            <div class="actions-grid">
                <button class="action-btn"><i class="fas fa-plus"></i> New Application</button>
                <button class="action-btn"><i class="fas fa-file-export"></i> Export Report</button>
                <button class="action-btn"><i class="fas fa-user-plus"></i> Add Customer</button>
                <button class="action-btn"><i class="fas fa-envelope"></i> Send Notice</button>
            </div>
        </div>
    </div>

</div>


            <!-- ================= ROW 4 : RECENT ACTIVITY ================= -->
            <div class="row mb-5" style="margin-top: -333px;">
                <div class="col-md-4 offset-md-8">
                     <div class="activity-card">
                        <h3>Recent Activity</h3>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon approved">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Loan approved for Michael Chen</div>
                                    <div class="activity-desc">Business loan of $120,000 approved</div>
                                    <div class="activity-time">2 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon payment">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Payment received from Sarah Johnson</div>
                                    <div class="activity-desc">Monthly installment of $1,250</div>
                                    <div class="activity-time">5 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon application">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New application submitted</div>
                                    <div class="activity-desc">Emily Rodriguez applied for home loan</div>
                                    <div class="activity-time">8 hours ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon customer">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">New customer registered</div>
                                    <div class="activity-desc">David Thompson completed profile</div>
                                    <div class="activity-time">1 day ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
    @parent
   
    
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('monthlyDisbursedChart').getContext('2d');

    // ===== Static Data =====
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const totalLoans = [12, 19, 8, 15, 22, 10];
    const totalAmount = [500000, 750000, 300000, 620000, 880000, 450000];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Total Loans',
                    data: totalLoans,
                    backgroundColor: '#C74B50',
                    borderRadius: 10,
                    borderWidth: 1,
                },
                {
                    label: 'Total Amount',
                    data: totalAmount,
                    backgroundColor: '#1E3E62',
                    borderRadius: 10,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const taskInput = document.getElementById('taskInput');
        const addTaskButton = document.getElementById('addTaskButton');
        const taskList = document.getElementById('taskList');

        // Add Task
        addTaskButton.addEventListener('click', function () {
            const taskValue = taskInput.value.trim();

            if (taskValue) {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                listItem.textContent = taskValue;

                // Add cross mark to task
                const removeButton = document.createElement('span');
                removeButton.className = 'text-danger ms-2';
                removeButton.style.cursor = 'pointer';
                removeButton.innerHTML = '&times;';
                removeButton.addEventListener('click', function () {
                    taskList.removeChild(listItem);
                });

                listItem.appendChild(removeButton);
                taskList.appendChild(listItem);

                // Clear input after adding task
                taskInput.value = '';
            } else {
                alert('Please enter a task.');
            }
        });

        // Optional: Allow pressing Enter to add tasks
        taskInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                addTaskButton.click();
            }
        });
    });
</script>
@endsection
<style>* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-color: #3B82F6;
    --secondary-color: #3B82F6;
    --sidebar-bg: #ffffff;
    --sidebar-hover: #f1f5f9;
    --card-bg: #ffffff;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --border-color: #e2e8f0;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --purple-accent: #8b5cf6;
    --yellow-accent: #fbbf24;
    --green-accent: #34d399;
}

html {
    width: 100%;
    height: 100%;
    overflow: hidden;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f1f5f9;
    color: var(--text-primary);
    line-height: 1.6;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.dashboard-container {
    display: flex;
    width: 100%;
    height: 100vh;
    margin: 0;
    padding: 0;
    position: relative;
    overflow: hidden;
}

/* Sidebar Styles */
.sidebar {
    width: 280px;
    background-color: var(--sidebar-bg);
    color: var(--text-primary);
    display: flex;
    flex-direction: column;
    position: relative;
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
    border-right: 1px solid var(--border-color);
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
    z-index: 100;
    flex-shrink: 0;
}

.dashboard-container {
    display: flex;
    height: 100vh;
}


.sidebar-header {
    padding: 24px 20px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}

.logo {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #ffffff;
}

.sidebar-header h2 {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-primary);
}

.sidebar-nav {
    flex: 1;
    padding: 20px 0;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.nav-item:hover {
    background-color: var(--sidebar-hover);
    color: var(--primary-color);
}

.nav-item.active {
    background-color: var(--sidebar-hover);
    color: var(--primary-color);
    border-left-color: var(--primary-color);
    font-weight: 600;
}

.nav-item i {
    width: 20px;
    text-align: center;
    color: inherit;
}

.sidebar-footer {
    padding: 20px;
    border-top: 1px solid var(--border-color);
    flex-shrink: 0;
    margin-top: auto;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background-color: var(--sidebar-hover);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
}

.user-info {
    flex: 1;
}

.user-name {
    font-weight: 600;
    font-size: 14px;
    color: var(--text-primary);
}

.user-role {
    font-size: 12px;
    color: var(--text-secondary);
}

.user-menu-container {
    position: relative;
}

.user-menu-btn {
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 4px 8px;
    transition: color 0.3s ease;
    border-radius: 4px;
}

.user-menu-btn:hover {
    color: var(--text-primary);
    background-color: rgba(0, 0, 0, 0.05);
}

.user-menu-dropdown {
    position: absolute;
    bottom: 100%;
    right: 0;
    margin-bottom: 8px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 1px solid var(--border-color);
    min-width: 160px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    padding: 8px 0;
}

.user-menu-container:hover .user-menu-dropdown,
.user-menu-container.active .user-menu-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.user-menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
    color: var(--text-primary);
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.2s ease;
}

.user-menu-item:hover {
    background-color: #f1f5f9;
    color: var(--primary-color);
}

.user-menu-item i {
    width: 18px;
    text-align: center;
    color: var(--text-secondary);
    font-size: 14px;
}

.user-menu-item:hover i {
    color: var(--primary-color);
}

/* Main Content */
.main-content {
    flex: 1;
    padding: 32px;
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
    background-color: #f4f6f8;
    position: relative;
    min-width: 0;
    box-sizing: border-box;
}

/* Header */
.top-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    padding: 20px 32px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
    width: 100%;
}

.header-left h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 4px;
    color: var(--text-primary);
}

.header-left p {
    color: var(--text-secondary);
    font-size: 14px;
    margin: 0;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 16px;
    align-self: center;
}

.search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.search-box i {
    position: absolute;
    left: 12px;
    color: var(--text-secondary);
}

.search-box input {
    padding: 10px 12px 10px 40px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    width: 300px;
    font-size: 14px;
    background-color: var(--card-bg);
}

.notification-btn {
    position: relative;
    width: 44px;
    height: 44px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: var(--card-bg);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    transition: all 0.3s ease;
}

.notification-btn:hover {
    background-color: #f8fafc;
    color: var(--primary-color);
}

.notification-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 18px;
    height: 18px;
    background-color: var(--danger-color);
    color: white;
    border-radius: 50%;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

/* Metrics Grid */
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 32px;
}

.metric-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.metric-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.metric-icon.purple {
    background: linear-gradient(135deg, #8b5cf6, #a78bfa);
}

.metric-icon.yellow {
    background: linear-gradient(135deg, #fbbf24, #fcd34d);
}

.metric-icon.green {
    background: linear-gradient(135deg, #34d399, #6ee7b7);
}

.metric-content {
    flex: 1;
}

.metric-content h3 {
    font-size: 14px;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 8px;
}

.metric-value {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.metric-change {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
}

.metric-change.positive {
    color: var(--success-color);
}

.metric-change.negative {
    color: var(--danger-color);
}

.metric-subtext {
    color: var(--text-secondary);
    font-weight: 400;
    margin-left: 4px;
}

/* Charts Row */
.charts-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
}

.chart-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 24px;
}

.chart-header h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
}

.chart-header p {
    font-size: 14px;
    color: var(--text-secondary);
}

.chart-filter {
    padding: 8px 12px;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    background-color: var(--card-bg);
    font-size: 14px;
    color: var(--text-primary);
    cursor: pointer;
}

.chart-container {
    height: 300px;
    position: relative;
}

.metric-link {
    text-decoration: none !important;
    color: inherit !important;
    display: block;
}

.metric-link:hover,
.metric-link:focus,
.metric-link:active {
    text-decoration: none !important;
    color: inherit !important;
    outline: none !important;
}

/* Bottom Row */
.bottom-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
}

.table-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.table-header h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
}

.table-header p {
    font-size: 14px;
    color: var(--text-secondary);
}

.btn-view-all {
    padding: 8px 16px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-view-all:hover {
    background-color: var(--secondary-color);
}

.table-container {
    overflow-x: auto;
}

.applications-table {
    width: 100%;
    border-collapse: collapse;
}

.applications-table thead {
    background-color: #f8fafc;
}

.applications-table th {
    padding: 12px 16px;
    text-align: left;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.applications-table td {
    padding: 16px;
    border-top: 1px solid var(--border-color);
    font-size: 14px;
}

.applicant-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 12px;
}

.credit-score {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.credit-score.excellent {
    background-color: #d1fae5;
    color: #065f46;
}

.credit-score.good {
    background-color: #dbeafe;
    color: #1e40af;
}

.credit-score.fair {
    background-color: #fef3c7;
    color: #92400e;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.pending {
    background-color: #fef3c7;
    color: #92400e;
}

.status-badge.approved {
    background-color: #d1fae5;
    color: #065f46;
}

.status-badge.under-review {
    background-color: #dbeafe;
    color: #1e40af;
}

.btn-action {
    padding: 6px 12px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-action:hover {
    background-color: var(--secondary-color);
}

/* Right Column */
.right-column {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.quick-actions-card,
.activity-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.quick-actions-card h3,
.activity-card h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.action-btn {
    padding: 20px;
    background-color: #f8fafc;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-primary);
}

.action-btn i {
    font-size: 24px;
    color: var(--primary-color);
}

.action-btn:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-2px);
}

.action-btn:hover i {
    color: white;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.activity-item {
    display: flex;
    gap: 12px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border-color);
}

.activity-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.activity-icon.approved {
    background-color: #d1fae5;
    color: #065f46;
}

.activity-icon.payment {
    background-color: #dbeafe;
    color: #1e40af;
}

.activity-icon.application {
    background-color: #fef3c7;
    color: #92400e;
}

.activity-icon.customer {
    background-color: #e9d5ff;
    color: #6b21a8;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
    color: var(--text-primary);
}

.activity-desc {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 4px;
}

.activity-time {
    font-size: 12px;
    color: var(--text-secondary);
}

/* Ensure content is visible */
.page-view {
    display: block;
    width: 100%;
    min-height: 100%;
}

#dashboard-view {
    display: block;
}

/* Responsive Design */
@media (max-width: 1400px) {
    .metrics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 1024px) {
    .sidebar {
        width: 240px;
    }
    
    .main-content {
        margin-left: 240px;
    }
    
    .charts-row {
        grid-template-columns: 1fr;
    }
    
    .bottom-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .metrics-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
}

/* Loan Applications Page Styles */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    padding: 20px 32px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
}

.page-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.btn-new-application {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-new-application:hover {
    background-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
}

/* Loan Stats Grid */
.loan-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.stat-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid var(--border-color);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    flex-shrink: 0;
}

.stat-icon.purple {
    background: linear-gradient(135deg, #8b5cf6, #a78bfa);
}

.stat-icon.yellow {
    background: linear-gradient(135deg, #fbbf24, #fcd34d);
}

.stat-icon.blue {
    background: linear-gradient(135deg, #3b82f6, #60a5fa);
}

.stat-icon.orange {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
}

.stat-icon.green {
    background: linear-gradient(135deg, #10b981, #34d399);
}

.stat-icon.teal {
    background: linear-gradient(135deg, #14b8a6, #5eead4);
}

.stat-icon.red {
    background: linear-gradient(135deg, #ef4444, #f87171);
}

.stat-icon.gray {
    background: linear-gradient(135deg, #6b7280, #9ca3af);
}

.stat-content {
    flex: 1;
}

.stat-content h3 {
    font-size: 13px;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 24px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
}

.stat-change.positive {
    color: var(--success-color);
}

.stat-change.negative {
    color: var(--danger-color);
}

.stat-subtext {
    color: var(--text-secondary);
    font-weight: 400;
    margin-left: 4px;
}

/* Search and Filters */
.search-filters-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
}

.search-box-large {
    flex: 1;
    position: relative;
    display: flex;
    align-items: center;
}

.search-box-large i {
    position: absolute;
    left: 16px;
    color: var(--text-secondary);
    font-size: 16px;
}

.search-box-large input {
    width: 100%;
    padding: 12px 16px 12px 48px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    background-color: #f8fafc;
    transition: all 0.3s ease;
}

.search-box-large input:focus {
    outline: none;
    border-color: var(--primary-color);
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-buttons {
    display: flex;
    gap: 12px;
}

.filter-btn {
    padding: 10px 20px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: #ffffff;
    color: var(--text-secondary);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.filter-btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Large Table Card */
.table-card-large {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
}

.table-header-large {
    margin-bottom: 20px;
}

.table-header-large h3 {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.table-container-large {
    overflow-x: auto;
}

.loans-table {
    width: 100%;
    border-collapse: collapse;
}

.loans-table thead {
    background-color: #f8fafc;
}

.loans-table th {
    padding: 16px 12px;
    text-align: left;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid var(--border-color);
}

.loans-table td {
    padding: 16px 12px;
    border-bottom: 1px solid var(--border-color);
    font-size: 14px;
}

.loans-table tbody tr:hover {
    background-color: #f8fafc;
}

.table-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--primary-color);
}

.customer-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 13px;
    flex-shrink: 0;
}

.customer-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.customer-name {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 14px;
}

.customer-id {
    font-size: 12px;
    color: var(--text-secondary);
}

.credit-score-cell {
    display: flex;
    flex-direction: column;
    gap: 6px;
    min-width: 140px;
}

.credit-score-value {
    font-weight: 600;
    font-size: 14px;
    color: var(--text-primary);
}

.credit-score-label {
    font-size: 11px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 4px;
    display: inline-block;
    width: fit-content;
}

.credit-score-label.excellent {
    background-color: #d1fae5;
    color: #065f46;
}

.credit-score-label.good {
    background-color: #dbeafe;
    color: #1e40af;
}

.credit-score-label.fair {
    background-color: #fef3c7;
    color: #92400e;
}

.credit-score-label.poor {
    background-color: #fee2e2;
    color: #991b1b;
}

.credit-score-bar {
    width: 100%;
    height: 6px;
    background-color: #e2e8f0;
    border-radius: 3px;
    overflow: hidden;
}

.credit-score-fill {
    height: 100%;
    border-radius: 3px;
    transition: width 0.3s ease;
}

.credit-score-fill.excellent {
    background-color: #10b981;
}

.credit-score-fill.good {
    background-color: #3b82f6;
}

.credit-score-fill.fair {
    background-color: #f59e0b;
}

.credit-score-fill.poor {
    background-color: #ef4444;
}

.status-badge.active {
    background-color: #d1fae5;
    color: #065f46;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.review {
    background-color: #dbeafe;
    color: #1e40af;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.inactive {
    background-color: #f3f4f6;
    color: #6b7280;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status-badge.suspended {
    background-color: #fee2e2;
    color: #991b1b;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}

.action-icon-btn {
    width: 32px;
    height: 32px;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    background-color: #ffffff;
    color: var(--text-secondary);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 14px;
}

.action-icon-btn:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-2px);
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
}

.pagination-info {
    font-size: 14px;
    color: var(--text-secondary);
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 8px;
}

.pagination-btn {
    min-width: 36px;
    height: 36px;
    padding: 0 12px;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    background-color: #ffffff;
    color: var(--text-primary);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pagination-btn:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.pagination-btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.pagination-dots {
    padding: 0 4px;
    color: var(--text-secondary);
}

/* Page View Container */
.page-view {
    width: 100%;
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Users/Customers Page Styles */
.header-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-export {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background-color: #ffffff;
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-export:hover {
    background-color: #f8fafc;
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.page-header > div:first-child p {
    color: var(--text-secondary);
    font-size: 14px;
    margin: 4px 0 0 0;
}

/* Customer Overview Grid */
.customer-overview-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.overview-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.overview-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.overview-card.blue {
    background: linear-gradient(135deg, #3B82F6, #60a5fa);
    color: white;
    border: none;
}

.overview-card.green {
    background: linear-gradient(135deg, #10b981, #34d399);
    color: white;
    border: none;
}

.overview-card.purple {
    background: linear-gradient(135deg, #8b5cf6, #a78bfa);
    color: white;
    border: none;
}

.overview-card.white {
    background-color: #ffffff;
}

.overview-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
    background-color: rgba(255, 255, 255, 0.2);
}

.overview-card.white .overview-icon {
    background-color: #f1f5f9;
    color: var(--text-primary);
}

.overview-content {
    flex: 1;
}

.overview-content h3 {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 8px;
    opacity: 0.9;
}

.overview-card.white .overview-content h3 {
    color: var(--text-secondary);
    opacity: 1;
}

.overview-value {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 8px;
}

.overview-change {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    opacity: 0.9;
}

.overview-card.white .overview-change {
    color: var(--text-secondary);
}

.overview-change.positive {
    color: rgba(255, 255, 255, 0.9);
}

.overview-card.white .overview-change.positive {
    color: var(--success-color);
}

/* Active Counts Card */
.active-counts {
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: 100%;
}

.active-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.active-item i {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background-color: #f1f5f9;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.active-label {
    font-size: 12px;
    color: var(--text-secondary);
    margin-bottom: 2px;
}

.active-value {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
}

/* Contact Cell */
.contact-cell {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.contact-email {
    font-size: 14px;
    color: var(--text-primary);
    font-weight: 500;
}

.contact-phone {
    font-size: 12px;
    color: var(--text-secondary);
}

/* Responsive for Users Page */
@media (max-width: 1400px) {
    .customer-overview-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 1024px) {
    .customer-overview-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .header-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-export,
    .btn-new-application {
        width: 100%;
    }
}

/* Analytics Page Styles */
.analytics-summary-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.analytics-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.analytics-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.analytics-card.blue-card {
    background: linear-gradient(135deg, #3B82F6, #60a5fa);
    color: white;
    border: none;
}

.analytics-card.pink-card {
    background: linear-gradient(135deg, #ec4899, #f472b6);
    color: white;
    border: none;
}

.analytics-card.yellow-card {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: white;
    border: none;
}

.analytics-card.green-card {
    background: linear-gradient(135deg, #10b981, #34d399);
    color: white;
    border: none;
}

.analytics-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
    background-color: rgba(255, 255, 255, 0.2);
}

.analytics-content {
    flex: 1;
}

.analytics-content h3 {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 8px;
    opacity: 0.9;
}

.analytics-value {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 8px;
}

.analytics-change {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    opacity: 0.9;
}

.analytics-change.positive {
    color: rgba(255, 255, 255, 0.9);
}

/* Applicant Cell with Email */
.applicant-cell-full {
    display: flex;
    align-items: center;
    gap: 12px;
}

.applicant-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.applicant-email {
    font-size: 12px;
    color: var(--text-secondary);
}

.table-header-large > div:first-child p {
    font-size: 13px;
    color: var(--text-secondary);
    margin: 4px 0 0 0;
    font-weight: 400;
}

/* Status Badge - Under Review */
.status-badge.under-review {
    background-color: #fee2e2;
    color: #991b1b;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

/* Responsive for Analytics */
@media (max-width: 1400px) {
    .analytics-summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 1024px) {
    .analytics-summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Properties Page Styles */
.property-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 32px;
}

.property-stat-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.property-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.property-stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    background-color: #f1f5f9;
    color: var(--primary-color);
    flex-shrink: 0;
}

.property-stat-icon.orange {
    background-color: #fef3c7;
    color: #f59e0b;
}

.property-stat-icon.green {
    background-color: #d1fae5;
    color: #10b981;
}

.property-stat-icon.blue {
    background-color: #dbeafe;
    color: #3B82F6;
}

.property-stat-content {
    flex: 1;
}

.property-stat-content h3 {
    font-size: 13px;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 8px;
}

.property-stat-value {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.property-stat-change {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
}

.property-stat-change.positive {
    color: var(--success-color);
}

.property-stat-status {
    font-size: 12px;
    font-weight: 500;
}

.property-stat-status.orange {
    color: #f59e0b;
}

.property-stat-status.green {
    color: #10b981;
}

/* Property Filters Section */
.property-filters-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
}

.property-filter-buttons {
    display: flex;
    gap: 12px;
}

.property-filter-btn {
    padding: 10px 20px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: #ffffff;
    color: var(--text-secondary);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.property-filter-btn:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.property-filter-btn.active {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.property-search-section {
    display: flex;
    gap: 12px;
    align-items: center;
}

.property-search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.property-search-box i {
    position: absolute;
    left: 16px;
    color: var(--text-secondary);
    font-size: 16px;
}

.property-search-box input {
    padding: 10px 16px 10px 44px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    background-color: #f8fafc;
    width: 300px;
    transition: all 0.3s ease;
}

.property-search-box input:focus {
    outline: none;
    border-color: var(--primary-color);
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.property-type-filter {
    padding: 10px 16px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: #ffffff;
    font-size: 14px;
    color: var(--text-primary);
    cursor: pointer;
    min-width: 150px;
}

/* Properties Grid */
.properties-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 32px;
}

.property-card {
    background-color: var(--card-bg);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.property-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.property-image {
    position: relative;
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    overflow: hidden;
}

.property-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
    color: rgba(59, 130, 246, 0.3);
}

.property-tags {
    position: absolute;
    top: 12px;
    left: 12px;
    right: 12px;
    display: flex;
    justify-content: space-between;
    z-index: 10;
}

.property-type-tag {
    padding: 6px 12px;
    background-color: rgba(30, 41, 59, 0.8);
    color: white;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.property-status-tag {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.property-status-tag.verified {
    background-color: #10b981;
    color: white;
}

.property-status-tag.pending {
    background-color: #f59e0b;
    color: white;
}

.property-card-content {
    padding: 20px;
}

.property-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.property-location {
    font-size: 13px;
    color: var(--text-secondary);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.property-location i {
    font-size: 12px;
}

.property-values {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border-color);
}

.property-value-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.value-label {
    font-size: 12px;
    color: var(--text-secondary);
}

.value-amount {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-primary);
}

.value-amount.loan-amount {
    color: var(--primary-color);
}

.property-features {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
    font-size: 13px;
    color: var(--text-secondary);
}

.property-features span {
    display: flex;
    align-items: center;
    gap: 6px;
}

.property-features i {
    color: var(--primary-color);
    font-size: 12px;
}

.property-owner {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 13px;
    color: var(--text-secondary);
}

.customer-avatar.small {
    width: 28px;
    height: 28px;
    font-size: 11px;
}

.property-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-view-details {
    flex: 1;
    padding: 10px 16px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-view-details:hover {
    background-color: #2563eb;
    transform: translateY(-2px);
}

.property-more-btn {
    width: 40px;
    height: 40px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: #ffffff;
    color: var(--text-secondary);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.property-more-btn:hover {
    background-color: #f8fafc;
    border-color: var(--primary-color);
    color: var(--primary-color);
}

/* Responsive for Properties */
@media (max-width: 1400px) {
    .property-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .properties-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 1024px) {
    .property-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .properties-grid {
        grid-template-columns: 1fr;
    }
    
    .property-filters-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .property-filter-buttons {
        width: 100%;
        justify-content: flex-start;
    }
    
    .property-search-section {
        width: 100%;
        flex-direction: column;
    }
    
    .property-search-box input {
        width: 100%;
    }
    
    .property-type-filter {
        width: 100%;
    }
}

/* Settings Page Styles */
.btn-reset {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background-color: #ffffff;
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-reset:hover {
    background-color: #f8fafc;
    border-color: var(--text-secondary);
}

.btn-save {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-save:hover {
    background-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
}

.settings-container {
    display: flex;
    gap: 24px;
    margin-top: 24px;
}

.settings-sidebar {
    width: 240px;
    flex-shrink: 0;
}

.settings-nav {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
}

.settings-nav-item {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: none;
    border: none;
    border-radius: 8px;
    color: var(--text-secondary);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: left;
}

.settings-nav-item:hover {
    background-color: #f8fafc;
    color: var(--text-primary);
}

.settings-nav-item.active {
    background-color: var(--primary-color);
    color: white;
}

.settings-nav-item i {
    width: 18px;
    text-align: center;
}

.settings-content {
    flex: 1;
    background-color: #ffffff;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border-color);
}

.settings-tab {
    display: none;
}

.settings-tab.active {
    display: block;
}

.settings-section {
    margin-bottom: 40px;
}

.settings-section h2 {
    font-size: 24px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.settings-subtitle {
    font-size: 14px;
    color: var(--text-secondary);
    margin-bottom: 32px;
}

/* Profile Photo Section */
.profile-photo-section {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 40px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--border-color);
}

.user-avatar.large {
    width: 100px;
    height: 100px;
    font-size: 40px;
}

.profile-photo-actions {
    display: flex;
    gap: 12px;
}

.btn-upload {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-upload:hover {
    background-color: #2563eb;
}

.btn-remove {
    padding: 10px 20px;
    background-color: #ffffff;
    color: var(--text-primary);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background-color: #f8fafc;
    border-color: var(--text-secondary);
}

/* Settings Form */
.settings-form {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
}

.form-input,
.form-textarea {
    padding: 12px 16px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    color: var(--text-primary);
    background-color: #ffffff;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

/* Security Settings */
.security-section {
    margin-bottom: 40px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--border-color);
}

.security-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.security-section h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
}

.two-factor-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.two-factor-section p {
    font-size: 14px;
    color: var(--text-secondary);
    margin-top: 4px;
}

/* Toggle Switch */
.toggle-switch {
    position: relative;
    display: inline-block;
    width: 52px;
    height: 28px;
    cursor: pointer;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #cbd5e1;
    transition: 0.3s;
    border-radius: 28px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 22px;
    width: 22px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
}

.toggle-switch input:checked + .toggle-slider {
    background-color: var(--primary-color);
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(24px);
}

.btn-update-password {
    padding: 12px 24px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: fit-content;
}

.btn-update-password:hover {
    background-color: #2563eb;
}

/* Active Sessions */
.sessions-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.session-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background-color: #f8fafc;
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.session-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background-color: #e0e7ff;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.session-info {
    flex: 1;
}

.session-device {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 4px;
}

.session-location {
    font-size: 12px;
    color: var(--text-secondary);
    margin-bottom: 2px;
}

.session-time {
    font-size: 12px;
    color: var(--text-secondary);
}

.btn-current {
    padding: 6px 16px;
    background-color: #d1fae5;
    color: #065f46;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}

.btn-revoke {
    padding: 6px 16px;
    background-color: #fee2e2;
    color: #991b1b;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-revoke:hover {
    background-color: #fecaca;
}

/* Responsive for Settings */
@media (max-width: 1024px) {
    .settings-container {
        flex-direction: column;
    }
    
    .settings-sidebar {
        width: 100%;
    }
    
    .settings-nav {
        display: flex;
        gap: 8px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .two-factor-section {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* Responsive for Loan Applications */
@media (max-width: 1400px) {
    .loan-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 1024px) {
    .loan-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .search-filters-section {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-buttons {
        width: 100%;
        justify-content: flex-start;
    }
}

</style>