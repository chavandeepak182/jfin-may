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
            <div class="container-fluid">
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
                    <!-- Pie Chart: Loan Status Distribution -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="text-center">Loan Status Distribution</h5>
                                <canvas id="loanStatusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Pie Chart: Loan Status Distribution -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="text-center">Loan Status Distribution</h5>
                                <canvas id="loanStatusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Pie Chart: Loan Status Distribution -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <h5 class="text-center">Loan Status Distribution</h5>
                                <canvas id="loanStatusChart" height="200"></canvas>
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
        // Loan Status Distribution Chart (Pie Chart)
        var ctx1 = document.getElementById('loanStatusChart').getContext('2d');
        var loanStatusChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['In Process', 'Approved', 'Disbursed', 'Rejected'],
                datasets: [{
                    data: [{{$loanStatuses['In Process']}}, {{$loanStatuses['Approved']}}, {{$loanStatuses['Disbursed']}}, {{$loanStatuses['Rejected']}}],
                    backgroundColor: ['#ffd136', '#3ca6e2', '#30c393', '#e86261'], // Colors for each status
                    borderColor: '#ffffff',
                    borderWidth: 1
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
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

</script>

@endsection
