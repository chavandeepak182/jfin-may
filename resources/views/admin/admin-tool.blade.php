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
                    <a href="{{ route('loanbanks') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Loan Bank</h6>
                            <h2>{{ $totalloanbank }}</h2>
                            
                                                   
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('mis.index') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All MIS </h6>
                            <h2>{{ $totalmis }}</h2>
                            
                        </div>
                    </a>
                </div>
                <!-- card 4 -->
                 
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