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
            <div class="container-fluid bg-white">
                <!-- Content Row for Cards -->
                <div class="row pt-5 pb-5">
                    <div class="col-md-4 mb-3 bg-white rounded border shadow pt-4">
                        <div class="row align-items-center justify-content-center">
                        <!-- Card 1: Total Loans -->
                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Total Customers</h6>
                                        <h3 class="">5</h3>
                                    </div>
                                </a>
                            </div>

                            <!-- Card 2: Disbursed Loans -->
                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Total<br>Officers</h6>
                                        <h3 class="">50</h3>
                                    </div>
                                </a>
                            </div>
                            <!-- Card 3: Approved Loans -->
                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Total<br>Loans</h6>
                                        <h3 class="">45</h3>
                                    </div>
                                </a>
                            </div>

                            <!-- Card 4: Rejected Loans -->
                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Disbursed Loans</h6>
                                        <h3 class="">25</h3>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Total<br>Leads</h6>
                                        <h3 class="">40</h3>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Total Enquiries</h6>
                                        <h3 class="">75</h3>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Approved Loans</h6>
                                        <h3 class="">35</h3>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Rejected Loans</h6>
                                        <h3 class="">5</h3>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a href="#" target="_blank" style="text-decoration: none;">
                                    <div class="text-center dash-card">
                                        <h6 class="card-title">Total Properties</h6>
                                        <h3 class="">15</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card-body bg-white rounded border shadow">
                            <h5 class="text-center font-weight-bold text-dark">Loan Status Distribution</h5>
                            <canvas id="loanStatusChart" height="200"></canvas>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3 bg-white rounded border shadow">
                        <div class="card-body">
                            <h5 class="text-center font-weight-bold text-dark">Monthly Disbursed Loans</h5>
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card-body border rounded shadow">
                            <h3 class="text-dark">Recent Loans</h3>
                            <div class="table-responsive">
                                <table class="table my-0">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Start Date</th>
											<th class="d-none d-xl-table-cell">End Date</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Assignee</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Project Apollo</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Vanessa Tucker</td>
										</tr>
										<tr>
											<td>Project Fireball</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">William Harris</td>
										</tr>
										<tr>
											<td>Project Hades</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Sharon Lessman</td>
										</tr>
										<tr>
											<td>Project Nitro</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">Vanessa Tucker</td>
										</tr>
										<tr>
											<td>Project Phoenix</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">William Harris</td>
										</tr>
										<tr>
											<td>Project X</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Sharon Lessman</td>
										</tr>
										<tr>
											<td>Project Romeo</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Christina Mason</td>
										</tr>
										<tr>
											<td>Project Wombat</td>
											<td class="d-none d-xl-table-cell">01/01/2023</td>
											<td class="d-none d-xl-table-cell">31/06/2023</td>
											<td><span class="badge bg-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">William Harris</td>
										</tr>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- To-do tasks -->
                    <div class="col-md-4 bg-white rounded border shadow">
                        <div class="card-body">
                            <h5 class="text-center font-weight-bold text-dark">To-Do Tasks</h5>
                            <!-- Task Input -->
                            <div class="input-group mb-3">
                                <input type="text" id="taskInput" class="form-control" placeholder="Enter a new task" aria-label="New Task">
                                <button class="btn btn-primary" type="button" id="addTaskButton">Add</button>
                            </div>
                            <!-- Task List -->
                            <ul id="taskList" class="list-group">
                                <!-- Tasks will be dynamically added here -->
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <input type="hidden" id="servertime" value="">
    </div>
@endsection