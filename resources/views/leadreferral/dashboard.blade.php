@extends('layouts.header')

@section('content')

<div class="container-fluid py-4">

    <!-- Welcome -->
    <div class="row mb-4">

        <div class="col-md-12">

            <div class="card border-0 shadow-lg rounded-4 bg-primary text-white">

                <div class="card-body p-4">

                    <h3 class="fw-bold">
                        Welcome, {{ Auth::user()->name }}
                    </h3>

                    <p class="mb-2">
                        Referral Code :
                        <span class="badge bg-warning text-dark fs-6">
                            {{ Auth::user()->referral_code }}
                        </span>
                    </p>

                </div>

            </div>

        </div>

    </div>



    <!-- Cards -->

    <div class="row g-4">

        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total Leads</small>

                            <h2 class="fw-bold mt-2">
                                {{ $totalLeads }}
                            </h2>

                        </div>

                        <div>

                            <i class="fas fa-users fa-2x text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Today's Leads</small>

                            <h2 class="fw-bold mt-2">
                                {{ $todayLeads }}
                            </h2>

                        </div>

                        <div>

                            <i class="fas fa-calendar-day fa-2x text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Closed Leads</small>

                            <h2 class="fw-bold mt-2">
                                {{ $closedLeads }}
                            </h2>

                        </div>

                        <div>

                            <i class="fas fa-check-circle fa-2x text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-lg-3 col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Pending Leads</small>

                            <h2 class="fw-bold mt-2">
                                {{ $pendingLeads }}
                            </h2>

                        </div>

                        <div>

                            <i class="fas fa-clock fa-2x text-danger"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>




    <!-- Chart -->

    <div class="row mt-5">

        <div class="col-lg-12">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">
                        Lead Analytics
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="leadChart" height="90"></canvas>

                </div>

            </div>

        </div>

    </div>




    <!-- Latest Leads -->

    <div class="row mt-5">

        <div class="col-lg-12">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-white">

                    <h5 class="mb-0">

                        Latest Leads

                    </h5>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Mobile</th>

                            <th>Loan</th>

                            <th>Amount</th>

                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($latestLeads as $lead)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $lead->customer_name }}</td>

                                <td>{{ $lead->mobile_no }}</td>

                                <td>{{ $lead->loan_type }}</td>

                                <td>₹ {{ number_format($lead->loan_amount) }}</td>

                                <td>

                                    @if($lead->status=="Closed")

                                        <span class="badge bg-success">

                                            Closed

                                        </span>

                                    @elseif($lead->status=="New")

                                        <span class="badge bg-warning">

                                            New

                                        </span>

                                    @else

                                        <span class="badge bg-info">

                                            {{ $lead->status }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No Leads Found

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


</div>

@endsection


@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('leadChart'),{

type:'bar',

data:{

labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],

datasets:[{

label:'Leads',

data:[5,8,10,15,9,12,18,11,13,15,16,20],

backgroundColor:'#0d6efd',

borderRadius:8

}]

},

options:{

responsive:true,

plugins:{

legend:{display:false}

},

scales:{

y:{beginAtZero:true}

}

}

});

</script>

@endsection