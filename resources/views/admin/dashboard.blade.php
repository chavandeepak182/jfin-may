@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid mt-4">
                <!-- Content Row for Cards -->
                <div class="row">
                    <!-- Card 1: Total Loans -->
                    <div class="col-md-2 mb-4">
                        <div class="card classy-card total-loans">
                            <div class="card-body-admin text-center">
                                <h6 class="card-title">Total Loans</h6>
                                <h3 class="card-count">{{ $totalLoans }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Disbursed Loans -->
                    <div class="col-md-2 mb-4">
                        <div class="card classy-card disbursed-loans">
                            <div class="card-body-admin text-center">
                                <h6 class="card-title">Disbursed Loans</h6>
                                <h3 class="card-count">{{ $disbursedLoans }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3: Approved Loans -->
                    <div class="col-md-2 mb-4">
                        <div class="card classy-card approved-loans">
                            <div class="card-body-admin text-center">
                                <h6 class="card-title">Approved Loans</h6>
                                <h3 class="card-count">{{ $approvedLoans }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Rejected Loans -->
                    <div class="col-md-2 mb-4">
                        <div class="card classy-card rejected-loans">
                            <div class="card-body-admin text-center">
                                <h6 class="card-title">Rejected Loans</h6>
                                <h3 class="card-count">{{ $rejectedLoans }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-4">
                        <div class="card classy-card total-users">
                            <div class="card-body-admin text-center">
                                <h6 class="card-title">Total Loans</h6>
                                <h3 class="card-count">{{ $totalLoans }}</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Disbursed Loans -->
                    <div class="col-md-2 mb-4">
                        <div class="card classy-card total-agents">
                            <div class="card-body-admin text-center">
                                <h6 class="card-title">Disbursed Loans</h6>
                                <h3 class="card-count">{{ $disbursedLoans }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content Row with three charts in a single row -->
                <div class="row">
                    <!-- donut chart -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="text-center font-weight-bold">Loan Status Distribution</h5>
                                <canvas id="loanStatusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- graph Loan Status Distribution -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="text-center font-weight-bold">Monthly Disbursed Loans</h5>
                                <canvas id="monthlyDisbursedChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- To-do tasks -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="text-center font-weight-bold">To-Do Tasks</h5>
                                <!-- Task Input -->
                                <div class="input-group mb-3">
                                    <input 
                                        type="text" 
                                        id="taskInput" 
                                        class="form-control" 
                                        placeholder="Enter a new task" 
                                        aria-label="New Task"
                                    >
                                    <button 
                                        class="btn btn-primary" 
                                        type="button" 
                                        id="addTaskButton"
                                    >
                                        Add
                                    </button>
                                </div>
                                <!-- Task List -->
                                <ul id="taskList" class="list-group">
                                    <!-- Tasks will be dynamically added here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Section: Recent Loans -->
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-dark">Recent Loans</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                        </label>
                                                    </div>
                                                </th>
                                                <th> Reference ID </th>
                                                <th> Name </th>
                                                <th> Amount </th>
                                                <th> Category </th>
                                                <th> Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentLoans as $loan)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>{{ $loan->loan_reference_id }}</td>
                                                    <td>{{ $loan->user_name }}</td>
                                                    <td>{{ $loan->amount }}</td>
                                                    <td>{{ $loan->loan_category_name }}</td>
                                                    <td>
                                                        <div class="status-box {{ strtolower(str_replace(' ', '-', $loan->status)) }}">
                                                            {{ ucfirst($loan->status) }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No recent loans available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="servertime" value="">
    </div>
@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Loan Status Distribution Chart (3D-Like Donut Chart)
    var ctx1 = document.getElementById('loanStatusChart').getContext('2d');
    var loanStatusChart = new Chart(ctx1, {
        type: 'doughnut', // Change to doughnut for donut chart
        data: {
            labels: ['In Process', 'Approved', 'Disbursed', 'Rejected'],
            datasets: [{
                data: [{{$loanStatuses['In Process']}}, {{$loanStatuses['Approved']}}, {{$loanStatuses['Disbursed']}}, {{$loanStatuses['Rejected']}}],
                backgroundColor: ['#D49B54', '#1E5128', '#1E3E62', '#C74B50'], // Colors for each status
                borderColor: '#333333',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            return label + ': ' + value;
                        }
                    }
                }
            },
            cutout: '70%', // Inner cutout for donut chart
            animation: {
                animateScale: true, // Animate scaling for 3D effect
                animateRotate: true // Animate rotation for 3D effect
            }
        },
        plugins: [{
            id: '3dEffect',
            beforeDraw: function(chart) {
                const ctx = chart.ctx;
                const chartArea = chart.chartArea;
                const centerX = (chartArea.left + chartArea.right) / 2;
                const centerY = (chartArea.top + chartArea.bottom) / 2;

                // Draw 3D base shadow
                ctx.save();
                ctx.fillStyle = '#aaa';
                ctx.translate(centerX, centerY);
                ctx.rotate((Math.PI / 180) * 20);
                ctx.scale(1, 0.8);
                ctx.fillRect(-chartArea.width / 2, -chartArea.height / 2, chartArea.width, chartArea.height / 2);
                ctx.restore();
            }
        }]
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('monthlyDisbursedChart').getContext('2d');
        const monthlyData = @json($monthlyDisbursedData);

        const months = monthlyData.map(item => item.month);
        const totalLoans = monthlyData.map(item => item.total_loans);
        const totalAmount = monthlyData.map(item => item.total_amount);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Total Loans',
                        data: totalLoans,
                        backgroundColor: '#D49B54',
                        borderWidth: 1,
                    },
                    {
                        label: 'Total Amount',
                        data: totalAmount,
                        backgroundColor: '#1E3E62',
                        borderWidth: 1,
                    },
                ],
            },
            options: {
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
