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
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: transform 0.2s ease;
        width: 260px;
        height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 10px auto;
         border: 2px solid #ccc;
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

    .card-row .col-md-4:nth-of-type(1) {
    margin-top: 20px;
}

.card-row .col-md-3,
.card-row .col-md-4 {
    margin-bottom: 20px; /* row मधील vertical gap */
}

    
#content-wrapper,
#content {
    background-color: white !important;
}

.topbar {
    height: 4.375rem;
    background-color: black;
}


    /* Colors */
    .blue-bg { background-color: #1DA1F2; }
    .pink-bg { background-color: #e91e63; }
    .green-bg { background-color: #4caf50; }
    .orange-bg { background-color: #ff9800; }
    .yellow-bg { background-color: #fbc02d;}
.   .red-bg { background-color: #bc2222ff; }
    

    </style>
 

<div class="row pt-5 pb-5 justify-content-center card-row">
    <!-- Card 1 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('loans.index') }}" style="text-decoration: none;">
            <div class="stat-card">
                <div class="stat-header blue-bg">
                   <i class="fas fa-file-invoice-dollar"></i> 
                </div>
                <div class="stat-body">
                    <h6>All Loans</h6>
                    <h4>{{ $totalLoans }}</h4>
                </div>
                <div class="stat-footer">Tracked from Records</div>
            </div>
        </a>
    </div>

    <!-- Card 2 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('pendingLoans') }}" style="text-decoration: none;">
            <div class="stat-card">
                <div class="stat-header pink-bg">
                    <i class="fas fa-hourglass-start"></i> 
                </div>
                <div class="stat-body">
                    <h6>Not Assigned Loans</h6>
                    <h4>{{ $inProcessLoans }}</h4>
                </div>
                <div class="stat-footer">Tracked from Records</div>
            </div>
        </a>
    </div>

    <!-- Card 3 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('inprocess.loans') }}" style="text-decoration: none;">
            <div class="stat-card">
                <div class="stat-header green-bg">
                    <i class="fas fa-sync-alt"></i>  
                </div>
                <div class="stat-body">
                    <h6>Inprocess Loans</h6>
                    <h4>{{ $inProcessLoans }}</h4>
                </div>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </a>
    </div>

    <!-- Card 4 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('trashed.loans') }}" style="text-decoration: none;">  
            <div class="stat-card">
                <div class="stat-header orange-bg">
                    <i class="fas fa-trash-alt"></i> 
                </div>
                <div class="stat-body">
                    <h6>Trashed Loans</h6>
                    <h4>{{ $trashedloans }}</h4>
                </div>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </a>    
    </div>

    <!-- Card 5 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('agent.approved.loans')}}" style="text-decoration: none;">  
            <div class="stat-card">
                <div class="stat-header green-bg">
                    <i class="fas fa-file-invoice-dollar"></i> <i class="fas fa-check text-success"></i>
                </div>
                <div class="stat-body">
                    <h6>Approved Loans</h6>
                    <h4>{{ $approvedLoan }}</h4>
                </div>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </a>    
    </div>

    <!-- Card 6 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('disbursed.loans')}}" style="text-decoration: none;">  
            <div class="stat-card">
                <div class="stat-header blue-bg">
                    <i class="fas fa-building-columns text-primary"></i> <i class="fas fa-arrow-right text-primary"></i>
                </div>
                <div class="stat-body">
                    <h6>Disbursed Loans</h6>
                    <h4>{{ $disbursedLoans }}</h4>
                </div>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </a>    
    </div>

    <!-- Card 7 -->
    <div class="col-md-3 col-sm-6 mb-4">
        <a href="{{ route('agent.rejected.loans')}}" style="text-decoration: none;">  
            <div class="stat-card">
                <div class="stat-header yellow-bg">
                    <i class="fas fa-building-columns text-danger"></i> <i class="fas fa-times-circle text-danger"></i>
                </div>
                <div class="stat-body">
                    <h6>Rejected Loans</h6>
                    <h4>{{ $rejectedLoans }}</h4>
                </div>
                <div class="stat-footer">Last 24 Hours</div>
            </div>
        </a>    
    </div>
</div>



@endsection




