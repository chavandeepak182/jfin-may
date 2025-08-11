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
            <div class="row pt-5 pb-5 justify-content-center card-row">
                <!-- Card 1 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('allUsers') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Customers</h6>
                            <h4>{{ $totalCustomers }}</h4>
                        </div>
                    </a>
                </div>


                <!-- Card 2 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('allAgents') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Employee</h6>
                            <h4>{{ $totalOfficers }} </h4>                        
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('allPartners') }}"style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Channel Partner</h6>
                            <h4>{{$totalCp}} </h4> 
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection