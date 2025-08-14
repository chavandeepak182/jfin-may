@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
  


 <style>
          .stat-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 9px rgba(0,0,0,0.08);
        border: 2px solid #ccc;
        transition: transform 0.2s ease;
        width: 260px;
        height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 10px auto;
    }
    .stat-card:hover {
        transform: translateY(-3px);
    }
    .stat-header {
        padding: 8px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        height: 50px;
    }
    .stat-body {
        flex: 1;
        padding: 5px;
        text-align: center;
    }
    .stat-body h4 {
        margin: 0;
        font-weight: bold;
        font-size: 28px;
        color: #333;
    }
    .stat-body h6 {
        margin: 0;
        font-size: 18px;
        color: #555;
    }
    .stat-footer {
        font-size: 11px;
        color: #999;
        padding: 4px;
        border-top: 1px solid #f0f0f0;
        text-align: center;
    }
    #content-wrapper,
#content {
    background-color: white !important;
}

.topbar {
    height: 4.375rem;
    background-color: black;
}

footer {
    background-color: black; /* तुझा footer black राहील */
}
    /* Colors */
    .blue-bg { background-color: #1DA1F2; }
    .pink-bg { background-color: #e91e63; }
    .green-bg { background-color: #4caf50; }
    .orange-bg { background-color: #ff9800; }
    .yellow-bg { background-color: #fbc02d; }
    </style>
 

<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid bg-white">
            <!-- Content Row for Cards -->
            <div class="row pt-5 pb-5 justify-content-center card-row">
                <!-- Card 1 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('loanbanks') }}" style="text-decoration: none;">
                        <div class=" stat-card">
                            <div class="stat-header green-bg">
                       <i class="fas fa-landmark"></i>
                    </div>
                    <div class="stat-body">
                       <h6>All Loan Bank</h6>
                        <h4>{{ $totalloanbank }}</h4>
                    </div>
                    <div class="stat-footer">Tracked from Records</div>
                        </div>
                    </a>
                </div>


                <!-- Card 2 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('mis.index') }}" style="text-decoration: none;">
                        <div class="stat-card">
                            <div class="stat-header yellow-bg">
                        <i class="fas fa-chart-line"></i> 
                    </div>

                            <div class="stat-body">
                                <h6>All MIS </h6>
                                <h4>{{ $totalmis }}</h4>
                            </div>
                    <div class="stat-footer">Tracked from Records</div>                       
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
               
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