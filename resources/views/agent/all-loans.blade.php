@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent

    <!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
.loan-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 18px 20px;
    height: 177px;
    border: 1px solid #eef0f4;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    transition: all 0.25s ease;
}

.loan-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

.loan-card.active {
    border: 2px solid #377dff;
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.badge-soft {
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: 600;
}

.loan-title {
    font-size: 18px;
    color: #6b7280;
    margin-top: 14px;
}

.loan-value {
    font-size: 30px;
    font-weight: 700;
    color: #111827;
}

.loan-sub {
    font-size: 12px;
    color: #9ca3af;
}

/* Soft colors */
.bg-blue-soft { background:#eef4ff; color:#377dff; }
.bg-green-soft { background:#ecfdf3; color:#16a34a; }
.bg-yellow-soft { background:#fff7ed; color:#f59e0b; }
.bg-red-soft { background:#fef2f2; color:#dc2626; }
.bg-purple-soft { background:#f5f3ff; color:#7c3aed; }

.badge-green { background:#e7f9ef; color:#16a34a; }
.badge-red { background:#fdecec; color:#dc2626; }

.card-link {
    text-decoration: none;
    color: inherit;
}

.btn-new-application {
    text-decoration: none !important;   /* remove underline */
    color: #ffffff;                     /* normal text color */
    background-color: #0d6efd;          /* button color */
    padding: 10px 18px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

/* Hover */
.btn-new-application:hover {
    text-decoration: none !important;
    color: #ffffff !important;          /* white on hover */
    background-color: #084298;          /* darker blue */
}

/* Visited link fix */
.btn-new-application:visited {
    color: #ffffff;
}

.loan-card.active {
    border-color: #0d6efd;
    color: #000;
    border-radius: 10px;
}

.loan-card.active .loan-title,
.loan-card.active .loan-value,
.loan-card.active .loan-sub {
    color: #000;
}


/* Focus & active fix */
.btn-new-application:focus,
.btn-new-application:active {
    outline: none;
    box-shadow: none;
    text-decoration: none;
    color: #ffffff;
}
#loanSearch {
    height: 42px;
    font-size: 14px;
}

.input-group-text {
    border-radius: 8px 0 0 8px;
}

#loanSearch {
    border-radius: 0 8px 8px 0;
}


</style>

             <!-- Header -->
   <div class="page-header">
    <h1>Loan Applications</h1>
<!-- 
    <a href="../loan-application" class="btn-new-application">
        <i class="fas fa-user-plus"></i>
        New Application
    </a> -->
</div>

<div class="row g-4 pt-4">
    <!-- <a href="../loan-application"><button class="btn btn-primary">Add Loans</button></a> -->

    <!-- All Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
       <a href="javascript:void(0)" id="assignedLoanCard" class="card-link">

           <div class="loan-card">

                <div class="card-top">
                    <div class="card-icon bg-purple-soft">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <span class="badge-soft badge-green">+12.5%</span>
                </div>

                <div class="loan-title">Assigned Loan</div>
                <div class="loan-value">{{ $assignedCount}}</div>
                <div class="loan-sub">Tracked from records</div>
            </div>
        </a>
    </div>

    <!-- Not Assigned Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
     <a href="javascript:void(0)" id="allLoansCard" class="card-link">


            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-yellow-soft">
                        <i class="fas fa-hourglass-start"></i>
                    </div>
                    <span class="badge-soft badge-red">+8.2%</span>
                </div>

                <div class="loan-title">All  Loans</div>
                <div class="loan-value"> {{$totalCount}}</div>
                <div class="loan-sub">Tracked from records</div>
            </div>
        </a>
    </div>

    <!-- Inprocess Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
         <a href="javascript:void(0)" id="inProcessCard" class="card-link">

            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-green-soft">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <span class="badge-soft badge-green">+5.1%</span>
                </div>

                <div class="loan-title">Inprocess Loans</div>
                <div class="loan-value"> {{  $inProcessCount }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Trashed Loans -->
    <!-- <div class="col-xl-3 col-lg-4 col-md-6">
        <a href="javascript:void(0)"
   class="card-link loan-filter"
   data-type="trashed">
            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-red-soft">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <span class="badge-soft badge-red">+15.3%</span>
                </div>

                <div class="loan-title">Dis Loans</div>
                <div class="loan-value">13</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div> -->

    <!-- Approved Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
    <!-- Approved Loans -->
<a href="javascript:void(0)" id="approvedLoanCard" class="card-link">



            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-green-soft">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="badge-soft badge-green">+12.5%</span>
                </div>

                <div class="loan-title">Approved Loans</div>
                <div class="loan-value">{{ $approvedCount }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Disbursed Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
  <a href="javascript:void(0)" id="disbursedLoanCard" class="card-link">



            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-blue-soft">
                        <i class="fas fa-building-columns"></i>
                    </div>
                    <span class="badge-soft badge-green">+8.2%</span>
                </div>

                <div class="loan-title">Disbursed Loans</div>
                <div class="loan-value">{{ $disbursedCount }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Rejected Loans -->
    <!-- <div class="col-xl-3 col-lg-4 col-md-6">
        <a href="javascript:void(0)"
   class="card-link loan-filter"
   data-type="rejected">

            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-red-soft">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <span class="badge-soft badge-red">-5.1%</span>
                </div>

                <div class="loan-title">Rejected Loans</div>
                <div class="loan-value">12</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div> -->

</div>
<div class="row mt-4">
    <div class="col-md-4">
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text"
                   id="loanSearch"
                   class="form-control border-start-0"
                   placeholder="Search Loan ID, User, Category">
        </div>
    </div>
</div>

<div id="assignedLoansContainer" class="mt-3"></div>

<!-- <div id="assignedLoansContainer"></div> -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).on('click', '#assignedLoanCard', function () {

    // highlight card (optional)
    $('.loan-card').removeClass('active');
    $(this).find('.loan-card').addClass('active');

    // show loader
    $('#assignedLoansContainer').html(
        '<div class="text-center mt-4">Loading...</div>'
    );

    $.ajax({
        url: "{{ route('agent.assignedLoans.ajax') }}",
        type: "GET",
        success: function (response) {
            $('#assignedLoansContainer').html(response);
        },
        error: function () {
            $('#assignedLoansContainer').html(
                '<div class="text-danger mt-4">Something went wrong</div>'
            );
        }
    });
});
</script>
<script>
$(document).ready(function () {

    // default → assigned loans
    loadAssignedLoans();

    $('#assignedLoanCard').click(function () {
        loadAssignedLoans();
    });

    $('#allLoansCard').click(function () {
        loadAllLoans();
    });

    function loadAssignedLoans() {
        $('#assignedLoansContainer').html('Loading...');
        $.get("{{ route('agent.assignedLoans.ajax') }}", function (html) {
            $('#assignedLoansContainer').html(html);
           
        });
    }

    function loadAllLoans() {
        $('#assignedLoansContainer').html('Loading...');
        $.get("{{ route('agent.allLoans.ajax') }}", function (html) {
            $('#assignedLoansContainer').html(html);
            
        });
    }
});
</script>

<!-- <script>
function initDataTable() {
    if ($.fn.DataTable.isDataTable('#example')) {
        $('#example').DataTable().destroy();
    }

    $('#example').DataTable({
        paging: true,
        searching: false, // you already have custom search
        ordering: true
    });
}
</script> -->
<script>
$(document).on('click', '#loanTableWrapper .pagination a', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');

    $('#assignedLoansContainer').html(
        '<div class="text-center mt-4">Loading...</div>'
    );

    $.get(url, function (html) {
        $('#assignedLoansContainer').html(html);
    });
});

</script>
<script>
$('#inProcessCard').click(function () {
    $('.loan-card').removeClass('active');
    $(this).find('.loan-card').addClass('active');

    $('#assignedLoansContainer').html('Loading...');

    $.get("{{ route('agent.inprocessLoans.ajax') }}", function (html) {
        $('#assignedLoansContainer').html(html);
    });
});
</script>


<script>
$('#approvedLoanCard').click(function () {

    // active effect
    $('.loan-card').removeClass('active');
    $(this).find('.loan-card').addClass('active');

    // loader
    $('#assignedLoansContainer').html(
        '<div class="text-center mt-4">Loading...</div>'
    );

    // AJAX call
    $.get("{{ route('agent.approvedLoans.ajax') }}", function (html) {
        $('#assignedLoansContainer').html(html);
    });
});
</script>
<script>
$(document).on('click', '#loanTableWrapper .pagination a', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');

    $('#assignedLoansContainer').html('Loading...');

    $.get(url, function (html) {
        $('#assignedLoansContainer').html(html);
    });
});
</script>
<script>
$('#disbursedLoanCard').click(function () {

    $('.loan-card').removeClass('active');
    $(this).find('.loan-card').addClass('active');

    $('#assignedLoansContainer').html(
        '<div class="text-center mt-4">Loading...</div>'
    );

    $.get("{{ route('agent.disbursedLoans.ajax') }}", function (html) {
        $('#assignedLoansContainer').html(html);
    });
});
</script>



@endsection




