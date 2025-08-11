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
                


                <!-- Card 2 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.withdrawal.requests') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Reddem Requests</h6>
                            
                            
                                                   
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('referral_earnings') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Referral Earnings</h6>
                            
                            
                        </div>
                    </a>
                </div>
                <!-- card 4 -->
                 <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.transactions') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Transaction History</h6>
                           
                            
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