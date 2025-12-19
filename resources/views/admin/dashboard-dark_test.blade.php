

@section('title', 'JFS | Dashboard')

@section('content')
<h1>Dashboard Overview</h1>
<p>Welcome back!</p>
<!-- Scripts at end of body -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
@stack('scripts')

@endsection

    <div class="dashboard-container">
      
@include('layouts.header_test') <!-- Include your sidebar here -->
        <!-- Main Content -->
        <main class="main-content">
            <!-- Dashboard View -->
            <div id="dashboard-view" class="page-view">
            <!-- Header -->
            <header class="top-header">
                <div class="header-left">
                    <h1>Dashboard Overview</h1>
                    <p>Welcome back, here's what's happening today.</p>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>
            </header>

            <!-- Metrics Cards -->
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-icon purple">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="metric-content">
                        <h3>Total Loans</h3>
                        <div class="metric-value">$2.4M</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12.5%</span>
                            <span class="metric-subtext">+$180K from last month</span>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon yellow">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="metric-content">
                        <h3>Total Leads</h3>
                        <div class="metric-value">1,248</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8.2%</span>
                            <span class="metric-subtext">+94 from last month</span>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon green">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="metric-content">
                        <h3>Total Employees</h3>
                        <div class="metric-value">6,842</div>
                        <div class="metric-change negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>-5.1%</span>
                            <span class="metric-subtext">23 less than previous month</span>
                        </div>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-icon purple">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="metric-content">
                        <h3>Total Customers</h3>
                        <div class="metric-value">8,456</div>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+15.3%</span>
                            <span class="metric-subtext">+1,124 new this month</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="charts-row">
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <h3>Loan Performance</h3>
                            <p>Monthly disbursement overview</p>
                        </div>
                        <select class="chart-filter">
                            <option>Last 6 Months</option>
                            <option>Last 12 Months</option>
                            <option>Last Year</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="loanPerformanceChart"></canvas>
                    </div>
                </div>

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

            <!-- Bottom Row -->
            <div class="bottom-row">
                <!-- Recent Applications -->
                <div class="table-card">
                    <div class="table-header">
                        <div>
                            <h3>Recent Applications</h3>
                            <p>Latest loan requests requiring review</p>
                        </div>
                        <button class="btn-view-all">View All</button>
                    </div>
                    <div class="table-container">
                        <table class="applications-table">
                            <thead>
                                <tr>
                                    <th>APPLICANT</th>
                                    <th>LOAN TYPE</th>
                                    <th>AMOUNT</th>
                                    <th>CREDIT SCORE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="applicant-cell">
                                            <div class="avatar">SJ</div>
                                            <span>Sarah Johnson</span>
                                        </div>
                                    </td>
                                    <td>Personal Loan</td>
                                    <td>$45,000</td>
                                    <td>
                                        <span class="credit-score excellent">780 Excellent</span>
                                    </td>
                                    <td><span class="status-badge pending">Pending</span></td>
                                    <td><button class="btn-action">Review</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell">
                                            <div class="avatar">MC</div>
                                            <span>Michael Chen</span>
                                        </div>
                                    </td>
                                    <td>Business Loan</td>
                                    <td>$120,000</td>
                                    <td>
                                        <span class="credit-score good">745 Good</span>
                                    </td>
                                    <td><span class="status-badge approved">Approved</span></td>
                                    <td><button class="btn-action">View</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell">
                                            <div class="avatar">ER</div>
                                            <span>Emily Rodriguez</span>
                                        </div>
                                    </td>
                                    <td>Home Loan</td>
                                    <td>$285,000</td>
                                    <td>
                                        <span class="credit-score excellent">820 Excellent</span>
                                    </td>
                                    <td><span class="status-badge pending">Pending</span></td>
                                    <td><button class="btn-action">Review</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell">
                                            <div class="avatar">DT</div>
                                            <span>David Thompson</span>
                                        </div>
                                    </td>
                                    <td>Auto Loan</td>
                                    <td>$32,000</td>
                                    <td>
                                        <span class="credit-score fair">680 Fair</span>
                                    </td>
                                    <td><span class="status-badge under-review">Under Review</span></td>
                                    <td><button class="btn-action">Review</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell">
                                            <div class="avatar">JM</div>
                                            <span>Jessica Martinez</span>
                                        </div>
                                    </td>
                                    <td>Personal Loan</td>
                                    <td>$18,500</td>
                                    <td>
                                        <span class="credit-score excellent">795 Excellent</span>
                                    </td>
                                    <td><span class="status-badge approved">Approved</span></td>
                                    <td><button class="btn-action">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions & Recent Activity -->
                <div class="right-column">
                    <div class="quick-actions-card">
                        <h3>Quick Actions</h3>
                        <div class="actions-grid">
                            <button class="action-btn">
                                <i class="fas fa-plus"></i>
                                <span>New Application</span>
                            </button>
                            <button class="action-btn">
                                <i class="fas fa-file-export"></i>
                                <span>Export Report</span>
                            </button>
                            <button class="action-btn">
                                <i class="fas fa-user-plus"></i>
                                <span>Add Customer</span>
                            </button>
                            <button class="action-btn">
                                <i class="fas fa-envelope"></i>
                                <span>Send Notice</span>
                            </button>
                        </div>
                    </div>

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
            <!-- End Dashboard View -->

            <!-- Loan Applications View -->
            <div id="loan-applications-view" class="page-view" style="display: none;">
                <!-- Header with New Application Button -->
                <div class="page-header">
                    <h1>Loan Applications</h1>
                    <button class="btn-new-application">
                        <i class="fas fa-user-plus"></i>
                        New Application
                    </button>
                </div>

                <!-- Statistics Cards -->
                <div class="loan-stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <h3>All Loans</h3>
                            <div class="stat-value">$2.4M</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12.5%</span>
                                <span class="stat-subtext">+$180K from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon yellow">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Pending Loans</h3>
                            <div class="stat-value">1,248</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8.2%</span>
                                <span class="stat-subtext">+94 from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Inprocess Loans</h3>
                            <div class="stat-value">6,842</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+5.1%</span>
                                <span class="stat-subtext">23 less than previous month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Documents Pending</h3>
                            <div class="stat-value">8,456</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+15.3%</span>
                                <span class="stat-subtext">+1,124 new this month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Approved Loans</h3>
                            <div class="stat-value">4,598</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12.5%</span>
                                <span class="stat-subtext">+$180K from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon teal">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Disbursed loans</h3>
                            <div class="stat-value">1,248</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8.2%</span>
                                <span class="stat-subtext">+94 from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-hand-paper"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Rejected Loans</h3>
                            <div class="stat-value">6,842</div>
                            <div class="stat-change negative">
                                <i class="fas fa-arrow-down"></i>
                                <span>-5.1%</span>
                                <span class="stat-subtext">+18 then previous month</span>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon gray">
                            <i class="fas fa-trash"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Trash</h3>
                            <div class="stat-value">8,456</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+15.3%</span>
                                <span class="stat-subtext">+1,124 new this month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="search-filters-section">
                    <div class="search-box-large">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search customers by name, email, or ID...">
                    </div>
                    <div class="filter-buttons">
                        <button class="filter-btn active">All Status</button>
                        <button class="filter-btn">Credit Score</button>
                        <button class="filter-btn">Sort By</button>
                    </div>
                </div>

                <!-- Loans Table -->
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
                                            <div class="customer-avatar">SJ</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Sarah Johnson</div>
                                                <div class="customer-id">#CUS-2847</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Personal Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">780</span>
                                            <span class="credit-score-label excellent">Excellent</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill excellent" style="width: 95%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$125,000</td>
                                    <td>HDFC Bank</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">MC</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Michael Chen</div>
                                                <div class="customer-id">#CUS-2846</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Home Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">745</span>
                                            <span class="credit-score-label good">Good</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill good" style="width: 85%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$120,000</td>
                                    <td>PNB Bank</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">ER</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Emily Rodriguez</div>
                                                <div class="customer-id">#CUS-2845</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Business Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">820</span>
                                            <span class="credit-score-label excellent">Excellent</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill excellent" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$385,000</td>
                                    <td>ICICI Bank</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">DT</div>
                                            <div class="customer-info">
                                                <div class="customer-name">David Thompson</div>
                                                <div class="customer-id">#CUS-2844</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Home Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">680</span>
                                            <span class="credit-score-label fair">Fair</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill fair" style="width: 60%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$32,000</td>
                                    <td>SBI Bank</td>
                                    <td><span class="status-badge review">Review</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">JM</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Jessica Martinez</div>
                                                <div class="customer-id">#CUS-2843</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Business Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">795</span>
                                            <span class="credit-score-label excellent">Excellent</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill excellent" style="width: 97%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$95,500</td>
                                    <td>Bank of Maharashtra</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">RW</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Robert Wilson</div>
                                                <div class="customer-id">#CUS-2842</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Personal Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">765</span>
                                            <span class="credit-score-label good">Good</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill good" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$0</td>
                                    <td>SBI Bank</td>
                                    <td><span class="status-badge inactive">Inactive</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">AF</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Amanda Foster</div>
                                                <div class="customer-id">#CUS-2841</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Business Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">695</span>
                                            <span class="credit-score-label fair">Fair</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill fair" style="width: 65%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$28,000</td>
                                    <td>IDFC First Bank</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">JP</div>
                                            <div class="customer-info">
                                                <div class="customer-name">James Parker</div>
                                                <div class="customer-id">#CUS-2840</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Home Loan</td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">595</span>
                                            <span class="credit-score-label poor">Poor</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill poor" style="width: 45%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$0</td>
                                    <td>SBI Bank</td>
                                    <td><span class="status-badge suspended">Suspended</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <div class="pagination-info">
                            Showing 1 to 8 of 8,456 customers
                        </div>
                        <div class="pagination-controls">
                            <button class="pagination-btn"><i class="fas fa-chevron-left"></i></button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <span class="pagination-dots">...</span>
                            <button class="pagination-btn">1057</button>
                            <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Loan Applications View -->

            <!-- Users/Customers View -->
            <div id="users-view" class="page-view" style="display: none;">
                <!-- Header with Export and Add Customer Buttons -->
                <div class="page-header">
                    <div>
                        <h1>All Customers</h1>
                        <p>Manage and view all customer information.</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn-export">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                        <button class="btn-new-application">
                            <i class="fas fa-user-plus"></i>
                            Add Customer
                        </button>
                    </div>
                </div>

                <!-- Overview Cards -->
                <div class="customer-overview-grid">
                    <div class="overview-card blue">
                        <div class="overview-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="overview-content">
                            <h3>Total Customers</h3>
                            <div class="overview-value">8,456</div>
                            <div class="overview-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12.5% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="overview-card green">
                        <div class="overview-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="overview-content">
                            <h3>Total Employees</h3>
                            <div class="overview-value">6,842</div>
                            <div class="overview-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8.2% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="overview-card purple">
                        <div class="overview-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="overview-content">
                            <h3>Total Channel Partners</h3>
                            <div class="overview-value">1,248</div>
                            <div class="overview-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+15.3% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="overview-card white">
                        <div class="active-counts">
                            <div class="active-item">
                                <i class="fas fa-users"></i>
                                <div>
                                    <div class="active-label">Active Customers</div>
                                    <div class="active-value">4,567</div>
                                </div>
                            </div>
                            <div class="active-item">
                                <i class="fas fa-user-check"></i>
                                <div>
                                    <div class="active-label">Active Employees</div>
                                    <div class="active-value">6,500</div>
                                </div>
                            </div>
                            <div class="active-item">
                                <i class="fas fa-star"></i>
                                <div>
                                    <div class="active-label">Active Channel Partners</div>
                                    <div class="active-value">1,089</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="search-filters-section">
                    <div class="search-box-large">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search customers by name, email, or ID...">
                    </div>
                    <div class="filter-buttons">
                        <button class="filter-btn active">All Status</button>
                        <button class="filter-btn">Credit Score</button>
                        <button class="filter-btn">Sort By</button>
                    </div>
                </div>

                <!-- Customers Table -->
                <div class="table-card-large">
                    <div class="table-header-large">
                        <h3>All Customers</h3>
                    </div>
                    <div class="table-container-large">
                        <table class="loans-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="table-checkbox"></th>
                                    <th>CUSTOMER</th>
                                    <th>CONTACT</th>
                                    <th>CREDIT SCORE</th>
                                    <th>ACTIVE LOANS</th>
                                    <th>TOTAL BORROWED</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">SJ</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Sarah Johnson</div>
                                                <div class="customer-id">ID: #CUS-2847</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">sarah.j@email.com</div>
                                            <div class="contact-phone">+1 (555) 123-4567</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">780</span>
                                            <span class="credit-score-label excellent">Excellent</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill excellent" style="width: 95%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2</td>
                                    <td>$125,000</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">MC</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Michael Chen</div>
                                                <div class="customer-id">ID: #CUS-2846</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">michael.c@email.com</div>
                                            <div class="contact-phone">+1 (555) 234-5678</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">745</span>
                                            <span class="credit-score-label good">Good</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill good" style="width: 85%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>$120,000</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">ER</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Emily Rodriguez</div>
                                                <div class="customer-id">ID: #CUS-2845</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">emily.r@email.com</div>
                                            <div class="contact-phone">+1 (555) 345-6789</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">820</span>
                                            <span class="credit-score-label excellent">Excellent</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill excellent" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>3</td>
                                    <td>$385,000</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">DT</div>
                                            <div class="customer-info">
                                                <div class="customer-name">David Thompson</div>
                                                <div class="customer-id">ID: #CUS-2844</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">david.t@email.com</div>
                                            <div class="contact-phone">+1 (555) 456-7890</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">680</span>
                                            <span class="credit-score-label fair">Fair</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill fair" style="width: 60%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>$32,000</td>
                                    <td><span class="status-badge review">Review</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">JM</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Jessica Martinez</div>
                                                <div class="customer-id">ID: #CUS-2843</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">jessica.m@email.com</div>
                                            <div class="contact-phone">+1 (555) 567-8901</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">795</span>
                                            <span class="credit-score-label excellent">Excellent</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill excellent" style="width: 97%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2</td>
                                    <td>$95,500</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">RW</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Robert Wilson</div>
                                                <div class="customer-id">ID: #CUS-2842</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">robert.w@email.com</div>
                                            <div class="contact-phone">+1 (555) 678-9012</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">765</span>
                                            <span class="credit-score-label good">Good</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill good" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0</td>
                                    <td>$0</td>
                                    <td><span class="status-badge inactive">Inactive</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">AF</div>
                                            <div class="customer-info">
                                                <div class="customer-name">Amanda Foster</div>
                                                <div class="customer-id">ID: #CUS-2841</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">amanda.f@email.com</div>
                                            <div class="contact-phone">+1 (555) 789-0123</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">695</span>
                                            <span class="credit-score-label fair">Fair</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill fair" style="width: 65%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>$28,000</td>
                                    <td><span class="status-badge active">Active</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="table-checkbox"></td>
                                    <td>
                                        <div class="customer-cell">
                                            <div class="customer-avatar">JP</div>
                                            <div class="customer-info">
                                                <div class="customer-name">James Parker</div>
                                                <div class="customer-id">ID: #CUS-2840</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <div class="contact-email">james.p@email.com</div>
                                            <div class="contact-phone">+1 (555) 890-1234</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="credit-score-cell">
                                            <span class="credit-score-value">620</span>
                                            <span class="credit-score-label poor">Poor</span>
                                            <div class="credit-score-bar">
                                                <div class="credit-score-fill poor" style="width: 50%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0</td>
                                    <td>$0</td>
                                    <td><span class="status-badge suspended">Suspended</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-icon-btn" title="View"><i class="fas fa-eye"></i></button>
                                            <button class="action-icon-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                            <button class="action-icon-btn" title="More"><i class="fas fa-ellipsis-v"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <div class="pagination-info">
                            Showing 1 to 8 of 8,456 customers
                        </div>
                        <div class="pagination-controls">
                            <button class="pagination-btn"><i class="fas fa-chevron-left"></i></button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <span class="pagination-dots">...</span>
                            <button class="pagination-btn">1057</button>
                            <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Users/Customers View -->

            <!-- Analytics View -->
            <div id="analytics-view" class="page-view" style="display: none;">
                <!-- Header with Export and Add Leads Buttons -->
                <div class="page-header">
                    <div>
                        <h1>Analytics</h1>
                        <p>Manage and view all analytics</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn-export">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                        <button class="btn-new-application">
                            <i class="fas fa-user-plus"></i>
                            Add Leads
                        </button>
                    </div>
                </div>

                <!-- Analytics Summary Cards -->
                <div class="analytics-summary-grid">
                    <div class="analytics-card blue-card">
                        <div class="analytics-icon blue-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="analytics-content">
                            <h3>Online Leads</h3>
                            <div class="analytics-value">865</div>
                            <div class="analytics-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12.5% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="analytics-card pink-card">
                        <div class="analytics-icon pink-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="analytics-content">
                            <h3>Manual Leads</h3>
                            <div class="analytics-value">345</div>
                            <div class="analytics-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8.2% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="analytics-card yellow-card">
                        <div class="analytics-icon yellow-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="analytics-content">
                            <h3>All MIS</h3>
                            <div class="analytics-value">1,248</div>
                            <div class="analytics-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+15.3% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="analytics-card green-card">
                        <div class="analytics-icon green-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="analytics-content">
                            <h3>All Loan Banks</h3>
                            <div class="analytics-value">348</div>
                            <div class="analytics-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+22.5% from last month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Online Leads Table -->
                <div class="table-card-large">
                    <div class="table-header-large">
                        <div>
                            <h3>Online Leads</h3>
                            <p>All Online Leads</p>
                        </div>
                        <button class="btn-view-all">View All</button>
                    </div>
                    <div class="table-container-large">
                        <table class="loans-table">
                            <thead>
                                <tr>
                                    <th>APPLICANT</th>
                                    <th>LOAN TYPE</th>
                                    <th>AMOUNT</th>
                                    <th>CREDIT SCORE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="applicant-cell-full">
                                            <div class="customer-avatar">SJ</div>
                                            <div class="applicant-info">
                                                <div class="customer-name">Sarah Johnson</div>
                                                <div class="applicant-email">sarah.j@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Personal Loan</td>
                                    <td>$45,000</td>
                                    <td>
                                        <span class="credit-score excellent">780 Excellent</span>
                                    </td>
                                    <td><span class="status-badge pending">Pending</span></td>
                                    <td><button class="btn-action">Review</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell-full">
                                            <div class="customer-avatar">MC</div>
                                            <div class="applicant-info">
                                                <div class="customer-name">Michael Chen</div>
                                                <div class="applicant-email">m.chen@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Business Loan</td>
                                    <td>$120,000</td>
                                    <td>
                                        <span class="credit-score good">745 Good</span>
                                    </td>
                                    <td><span class="status-badge approved">Approved</span></td>
                                    <td><button class="btn-action">View</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell-full">
                                            <div class="customer-avatar">ER</div>
                                            <div class="applicant-info">
                                                <div class="customer-name">Emily Rodriguez</div>
                                                <div class="applicant-email">emily.r@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Home Loan</td>
                                    <td>$285,000</td>
                                    <td>
                                        <span class="credit-score excellent">820 Excellent</span>
                                    </td>
                                    <td><span class="status-badge pending">Pending</span></td>
                                    <td><button class="btn-action">Review</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell-full">
                                            <div class="customer-avatar">DT</div>
                                            <div class="applicant-info">
                                                <div class="customer-name">David Thompson</div>
                                                <div class="applicant-email">d.thompson@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Auto Loan</td>
                                    <td>$32,000</td>
                                    <td>
                                        <span class="credit-score fair">680 Fair</span>
                                    </td>
                                    <td><span class="status-badge under-review">Under Review</span></td>
                                    <td><button class="btn-action">Review</button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="applicant-cell-full">
                                            <div class="customer-avatar">JM</div>
                                            <div class="applicant-info">
                                                <div class="customer-name">Jessica Martinez</div>
                                                <div class="applicant-email">jessica.m@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Personal Loan</td>
                                    <td>$18,500</td>
                                    <td>
                                        <span class="credit-score excellent">795 Excellent</span>
                                    </td>
                                    <td><span class="status-badge approved">Approved</span></td>
                                    <td><button class="btn-action">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <div class="pagination-info">
                            Showing 1 to 8 of 8,456 customers
                        </div>
                        <div class="pagination-controls">
                            <button class="pagination-btn"><i class="fas fa-chevron-left"></i></button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <span class="pagination-dots">...</span>
                            <button class="pagination-btn">1057</button>
                            <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Analytics View -->

            <!-- Properties View -->
            <div id="properties-view" class="page-view" style="display: none;">
                <!-- Header with Export and Add New Property Buttons -->
                <div class="page-header">
                    <div>
                        <h1>Property Management</h1>
                        <p>Manage all properties and collateral assets</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn-export">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                        <button class="btn-new-application">
                            <i class="fas fa-plus"></i>
                            Add New Property
                        </button>
                    </div>
                </div>

                <!-- Property Statistics Cards -->
                <div class="property-stats-grid">
                    <div class="property-stat-card">
                        <div class="property-stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="property-stat-content">
                            <h3>Total Properties</h3>
                            <div class="property-stat-value">2,847</div>
                            <div class="property-stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+18.2% from last month</span>
                            </div>
                        </div>
                    </div>

                    <div class="property-stat-card">
                        <div class="property-stat-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="property-stat-content">
                            <h3>Pending Properties</h3>
                            <div class="property-stat-value">342</div>
                            <div class="property-stat-status orange">
                                Awaiting verification
                            </div>
                        </div>
                    </div>

                    <div class="property-stat-card">
                        <div class="property-stat-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="property-stat-content">
                            <h3>Property Taken</h3>
                            <div class="property-stat-value">2,156</div>
                            <div class="property-stat-status green">
                                Active collateral
                            </div>
                        </div>
                    </div>

                    <div class="property-stat-card">
                        <div class="property-stat-icon blue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="property-stat-content">
                            <h3>Total Value</h3>
                            <div class="property-stat-value">$842M</div>
                            <div class="property-stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+22.5% from last month</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="property-filters-section">
                    <div class="property-filter-buttons">
                        <button class="property-filter-btn active">All Properties</button>
                        <button class="property-filter-btn">Pending Properties</button>
                        <button class="property-filter-btn">Property Taken</button>
                    </div>
                    <div class="property-search-section">
                        <div class="property-search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search properties...">
                        </div>
                        <select class="property-type-filter">
                            <option>All Types</option>
                            <option>Residential</option>
                            <option>Commercial</option>
                            <option>Industrial</option>
                            <option>Land</option>
                        </select>
                    </div>
                </div>

                <!-- Property Cards Grid -->
                <div class="properties-grid">
                    <div class="property-card">
                        <div class="property-image">
                            <div class="property-tags">
                                <span class="property-type-tag">Residential</span>
                                <span class="property-status-tag verified">Verified</span>
                            </div>
                            <div class="property-image-placeholder">
                                <i class="fas fa-home"></i>
                            </div>
                        </div>
                        <div class="property-card-content">
                            <h3 class="property-title">Modern Villa Estate</h3>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Beverly Hills, CA
                            </p>
                            <div class="property-values">
                                <div class="property-value-item">
                                    <span class="value-label">Property Value</span>
                                    <span class="value-amount">$2,450,000</span>
                                </div>
                                <div class="property-value-item">
                                    <span class="value-label">Loan Amount</span>
                                    <span class="value-amount loan-amount">$1,850,000</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fas fa-bed"></i> 5 Beds</span>
                                <span><i class="fas fa-bath"></i> 4 Baths</span>
                                <span><i class="fas fa-ruler-combined"></i> 4,200 sqft</span>
                            </div>
                            <div class="property-owner">
                                <div class="customer-avatar small">SJ</div>
                                <span>Sarah Johnson</span>
                            </div>
                            <div class="property-actions">
                                <button class="btn-view-details">View Details</button>
                                <button class="property-more-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <div class="property-image">
                            <div class="property-tags">
                                <span class="property-type-tag">Commercial</span>
                                <span class="property-status-tag pending">Pending</span>
                            </div>
                            <div class="property-image-placeholder">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <div class="property-card-content">
                            <h3 class="property-title">Downtown Office Tower</h3>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Manhattan, NY
                            </p>
                            <div class="property-values">
                                <div class="property-value-item">
                                    <span class="value-label">Property Value</span>
                                    <span class="value-amount">$8,900,000</span>
                                </div>
                                <div class="property-value-item">
                                    <span class="value-label">Loan Amount</span>
                                    <span class="value-amount loan-amount">$6,200,000</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fas fa-layer-group"></i> 12 Floors</span>
                                <span><i class="fas fa-ruler-combined"></i> 45,000 sqft</span>
                            </div>
                            <div class="property-owner">
                                <div class="customer-avatar small">MC</div>
                                <span>Michael Chen</span>
                            </div>
                            <div class="property-actions">
                                <button class="btn-view-details">View Details</button>
                                <button class="property-more-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <div class="property-image">
                            <div class="property-tags">
                                <span class="property-type-tag">Residential</span>
                                <span class="property-status-tag verified">Verified</span>
                            </div>
                            <div class="property-image-placeholder">
                                <i class="fas fa-home"></i>
                            </div>
                        </div>
                        <div class="property-card-content">
                            <h3 class="property-title">Luxury Penthouse</h3>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Miami Beach, FL
                            </p>
                            <div class="property-values">
                                <div class="property-value-item">
                                    <span class="value-label">Property Value</span>
                                    <span class="value-amount">$3,200,000</span>
                                </div>
                                <div class="property-value-item">
                                    <span class="value-label">Loan Amount</span>
                                    <span class="value-amount loan-amount">$2,400,000</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fas fa-bed"></i> 4 Beds</span>
                                <span><i class="fas fa-bath"></i> 3 Baths</span>
                                <span><i class="fas fa-ruler-combined"></i> 3,800 sqft</span>
                            </div>
                            <div class="property-owner">
                                <div class="customer-avatar small">ER</div>
                                <span>Emily Rodriguez</span>
                            </div>
                            <div class="property-actions">
                                <button class="btn-view-details">View Details</button>
                                <button class="property-more-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <div class="property-image">
                            <div class="property-tags">
                                <span class="property-type-tag">Land</span>
                                <span class="property-status-tag verified">Verified</span>
                            </div>
                            <div class="property-image-placeholder">
                                <i class="fas fa-map"></i>
                            </div>
                        </div>
                        <div class="property-card-content">
                            <h3 class="property-title">Prime Development Land</h3>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Austin, TX
                            </p>
                            <div class="property-values">
                                <div class="property-value-item">
                                    <span class="value-label">Property Value</span>
                                    <span class="value-amount">$1,850,000</span>
                                </div>
                                <div class="property-value-item">
                                    <span class="value-label">Loan Amount</span>
                                    <span class="value-amount loan-amount">$1,200,000</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fas fa-ruler-combined"></i> 5.2 Acres</span>
                                <span><i class="fas fa-tag"></i> Zoned Commercial</span>
                            </div>
                            <div class="property-owner">
                                <div class="customer-avatar small">DT</div>
                                <span>David Thompson</span>
                            </div>
                            <div class="property-actions">
                                <button class="btn-view-details">View Details</button>
                                <button class="property-more-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <div class="property-image">
                            <div class="property-tags">
                                <span class="property-type-tag">Residential</span>
                                <span class="property-status-tag pending">Pending</span>
                            </div>
                            <div class="property-image-placeholder">
                                <i class="fas fa-home"></i>
                            </div>
                        </div>
                        <div class="property-card-content">
                            <h3 class="property-title">Suburban Family Home</h3>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Seattle, WA
                            </p>
                            <div class="property-values">
                                <div class="property-value-item">
                                    <span class="value-label">Property Value</span>
                                    <span class="value-amount">$875,000</span>
                                </div>
                                <div class="property-value-item">
                                    <span class="value-label">Loan Amount</span>
                                    <span class="value-amount loan-amount">$650,000</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fas fa-bed"></i> 4 Beds</span>
                                <span><i class="fas fa-bath"></i> 3 Baths</span>
                                <span><i class="fas fa-ruler-combined"></i> 2,800 sqft</span>
                            </div>
                            <div class="property-owner">
                                <div class="customer-avatar small">JM</div>
                                <span>Jessica Martinez</span>
                            </div>
                            <div class="property-actions">
                                <button class="btn-view-details">View Details</button>
                                <button class="property-more-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <div class="property-image">
                            <div class="property-tags">
                                <span class="property-type-tag">Industrial</span>
                                <span class="property-status-tag verified">Verified</span>
                            </div>
                            <div class="property-image-placeholder">
                                <i class="fas fa-warehouse"></i>
                            </div>
                        </div>
                        <div class="property-card-content">
                            <h3 class="property-title">Warehouse Complex</h3>
                            <p class="property-location">
                                <i class="fas fa-map-marker-alt"></i>
                                Phoenix, AZ
                            </p>
                            <div class="property-values">
                                <div class="property-value-item">
                                    <span class="value-label">Property Value</span>
                                    <span class="value-amount">$4,500,000</span>
                                </div>
                                <div class="property-value-item">
                                    <span class="value-label">Loan Amount</span>
                                    <span class="value-amount loan-amount">$3,200,000</span>
                                </div>
                            </div>
                            <div class="property-features">
                                <span><i class="fas fa-building"></i> 3 Units</span>
                                <span><i class="fas fa-ruler-combined"></i> 85,000 sqft</span>
                            </div>
                            <div class="property-owner">
                                <div class="customer-avatar small">RW</div>
                                <span>Robert Wilson</span>
                            </div>
                            <div class="property-actions">
                                <button class="btn-view-details">View Details</button>
                                <button class="property-more-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        Showing 1 to 6 of 2,847 properties
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn"><i class="fas fa-chevron-left"></i></button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <span class="pagination-dots">...</span>
                        <button class="pagination-btn">475</button>
                        <button class="pagination-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
            <!-- End Properties View -->

            <!-- Settings View -->
            <div id="settings-view" class="page-view" style="display: none;">
                <!-- Header with Reset and Save Buttons -->
                <div class="page-header">
                    <div>
                        <h1>Settings</h1>
                        <p>Manage your account and system preferences</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn-reset">
                            <i class="fas fa-redo"></i>
                            Reset to Default
                        </button>
                        <button class="btn-save">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="settings-container">
                    <!-- Settings Sub-Navigation -->
                    <div class="settings-sidebar">
                        <div class="settings-nav">
                            <button class="settings-nav-item active" data-settings-tab="account">
                                <i class="fas fa-user"></i>
                                <span>Account</span>
                            </button>
                            <button class="settings-nav-item" data-settings-tab="security">
                                <i class="fas fa-shield-alt"></i>
                                <span>Security</span>
                            </button>
                        </div>
                    </div>

                    <!-- Settings Content Area -->
                    <div class="settings-content">
                        <!-- Account Settings Tab -->
                        <div id="account-settings-tab" class="settings-tab active">
                            <div class="settings-section">
                                <h2>Account Settings</h2>
                                <p class="settings-subtitle">Manage your personal information and account details.</p>

                                <!-- Profile Photo -->
                                <div class="profile-photo-section">
                                    <div class="profile-photo-preview">
                                        <div class="user-avatar large">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="profile-photo-actions">
                                        <button class="btn-upload">
                                            <i class="fas fa-upload"></i>
                                            Upload New
                                        </button>
                                        <button class="btn-remove">
                                            Remove
                                        </button>
                                    </div>
                                </div>

                                <!-- Personal Information Form -->
                                <div class="settings-form">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" value="John" class="form-input">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" value="Anderson" class="form-input">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" value="john.anderson@loanpro.com" class="form-input">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" value="+1 (555) 123-4567" class="form-input">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Job Title</label>
                                            <input type="text" value="Senior Loan Officer" class="form-input">
                                        </div>
                                        <div class="form-group">
                                            <label>Department</label>
                                            <input type="text" value="Administration" class="form-input">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Bio</label>
                                        <textarea class="form-textarea" rows="4">Experienced loan officer with over 10 years in the financial services industry.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings Tab -->
                        <div id="security-settings-tab" class="settings-tab" style="display: none;">
                            <div class="settings-section">
                                <h2>Security Settings</h2>
                                <p class="settings-subtitle">Manage your password and security preferences.</p>

                                <!-- Change Password -->
                                <div class="security-section">
                                    <h3>Change Password</h3>
                                    <div class="settings-form">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input type="password" class="form-input" placeholder="Enter current password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-input" placeholder="Enter new password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" class="form-input" placeholder="Confirm new password">
                                        </div>
                                        <button class="btn-update-password">
                                            Update Password
                                        </button>
                                    </div>
                                </div>

                                <!-- Two-Factor Authentication -->
                                <div class="security-section">
                                    <div class="two-factor-section">
                                        <div>
                                            <h3>Two-Factor Authentication</h3>
                                            <p>Add an extra layer of security to your account.</p>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" checked>
                                            <span class="toggle-slider"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Active Sessions -->
                                <div class="security-section">
                                    <h3>Active Sessions</h3>
                                    <div class="sessions-list">
                                        <div class="session-item">
                                            <div class="session-icon">
                                                <i class="fas fa-desktop"></i>
                                            </div>
                                            <div class="session-info">
                                                <div class="session-device">Windows - Chrome</div>
                                                <div class="session-location">New York, USA</div>
                                                <div class="session-time">Active now</div>
                                            </div>
                                            <button class="btn-current">Current</button>
                                        </div>
                                        <div class="session-item">
                                            <div class="session-icon">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <div class="session-info">
                                                <div class="session-device">iPhone - Safari</div>
                                                <div class="session-location">New York, USA</div>
                                                <div class="session-time">2 hours ago</div>
                                            </div>
                                            <button class="btn-revoke">Revoke</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Settings View -->
        </main>
    </div>

    
</body>
</html>

