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

</style>

             <!-- Header -->
   <div class="page-header">
    <h1>Loan Applications</h1>

    <a href="../loan-application" class="btn-new-application">
        <i class="fas fa-user-plus"></i>
        New Application
    </a>
</div>

<div class="row g-4 pt-4">
    <!-- <a href="../loan-application"><button class="btn btn-primary">Add Loans</button></a> -->

    <!-- All Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <a href="javascript:void(0)" class="card-link loan-filter" data-type="all">
           <div class="loan-card">

                <div class="card-top">
                    <div class="card-icon bg-purple-soft">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <span class="badge-soft badge-green">+12.5%</span>
                </div>

                <div class="loan-title">All Loans</div>
                <div class="loan-value">{{ $totalLoans }}</div>
                <div class="loan-sub">Tracked from records</div>
            </div>
        </a>
    </div>

    <!-- Not Assigned Loans -->
    <!-- <div class="col-xl-3 col-lg-4 col-md-6">
      <a href="javascript:void(0)" class="card-link loan-filter" data-type="pending">

            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-yellow-soft">
                        <i class="fas fa-hourglass-start"></i>
                    </div>
                    <span class="badge-soft badge-red">+8.2%</span>
                </div>

                <div class="loan-title">Pending Assigned Loans</div>
                <div class="loan-value">{{ $pendingLoansCount }}</div>
                <div class="loan-sub">Tracked from records</div>
            </div>
        </a>
    </div> -->
@if(session('role_id') == 4)

<div class="col-xl-3 col-lg-4 col-md-6">
   <a href="javascript:void(0)"
   id="pendingLoanCard"
   class="card-link loan-filter"
   data-type="pending">

        <div class="loan-card">
            <div class="card-top">
                <div class="card-icon bg-yellow-soft">
                    <i class="fas fa-hourglass-start"></i>
                </div>
                <span class="badge-soft badge-red">+8.2%</span>
            </div>

            <div class="loan-title">Pending Assign Loans</div>
            <div class="loan-value">{{ $pendingLoansCount }}</div>
            <div class="loan-sub">Tracked from records</div>
        </div>

    </a>
</div>

@endif
    <!-- Inprocess Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
         <a href="javascript:void(0)"
       class="card-link loan-filter"
       data-type="inprocess">
            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-green-soft">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <span class="badge-soft badge-green">+5.1%</span>
                </div>

                <div class="loan-title">Inprocess Loans</div>
                <div class="loan-value">{{ $inProcessLoans }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Trashed Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
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

                <div class="loan-title">Trashed Loans</div>
                <div class="loan-value">{{ $trashedloans }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Approved Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
       <a href="javascript:void(0)"
   class="card-link loan-filter"
   data-type="approved">

            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-green-soft">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="badge-soft badge-green">+12.5%</span>
                </div>

                <div class="loan-title">Approved Loans</div>
                <div class="loan-value">{{ $approvedLoan }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Disbursed Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
    <a href="javascript:void(0)"
   class="card-link loan-filter"
   data-type="disbursed">

            <div class="loan-card">
                <div class="card-top">
                    <div class="card-icon bg-blue-soft">
                        <i class="fas fa-building-columns"></i>
                    </div>
                    <span class="badge-soft badge-green">+8.2%</span>
                </div>

                <div class="loan-title">Disbursed Loans</div>
                <div class="loan-value">{{ $disbursedLoans }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

    <!-- Rejected Loans -->
    <div class="col-xl-3 col-lg-4 col-md-6">
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
                <div class="loan-value">{{ $rejectedLoans }}</div>
                <div class="loan-sub">Last 24 hours</div>
            </div>
        </a>
    </div>

</div>
<script>
$(document).ready(function () {

    $('.loan-filter').on('click', function () {

        // Remove active class from all cards
        $('.loan-card').removeClass('active');

        // Add active class to clicked card only
        $(this).find('.loan-card').addClass('active');

        // Optional: get filter type
        let type = $(this).data('type');
        console.log('Selected type:', type);

        // Here you can call AJAX if needed
    });

});
</script>

<div class="row mt-4">
    <div class="col-md-4 ms-auto">
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text"
                   id="loanSearch"
                   class="form-control border-start-0"
                   placeholder="Search by applicant name  and loan type...">
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-12">
        <div id="loanListArea">
            <div class="text-muted text-center">
                Click any card to view loan list
            </div>
        </div>
    </div>
</div>
<script>

var currentType = 'all';   // GLOBAL variable

$(document).ready(function () {

    function loadLoans(type = 'all', search = '') {

        currentType = type;

        let url = "{{ route('loan.ajax.list') }}";

        if (type === 'inprocess') url = "{{ route('loan.ajax.inprocess') }}";
        if (type === 'pending')   url = "{{ route('loan.ajax.pending') }}";
        if (type === 'approved')  url = "{{ route('loan.ajax.approved') }}";
        if (type === 'disbursed') url = "{{ route('loan.ajax.disbursed') }}";
        if (type === 'rejected')  url = "{{ route('loan.ajax.rejected') }}";
        if (type === 'trashed')   url = "{{ route('loan.ajax.trashed') }}";

        $('#loanListArea').html('<div class="text-center py-4">Loading...</div>');

        $.ajax({
            url: url,
            type: "GET",
            data: {
                search: search,
                type: type
            },
            success: function (res) {

                $('#loanListArea').html(res);

            },
            error: function () {

                $('#loanListArea').html('<div class="text-danger text-center py-4">Failed to load loans</div>');

            }
        });

    }

    // CARD CLICK FILTER
    $('.loan-filter').on('click', function (e) {

        e.preventDefault();

        $('.loan-card').removeClass('active');
        $(this).find('.loan-card').addClass('active');

        loadLoans($(this).data('type'), $('#loanSearch').val());

    });

    // SEARCH
    $('#loanSearch').on('keyup', function () {

        loadLoans(currentType, $(this).val());

    });

    // LOAD DEFAULT
    loadLoans('all');

});


// PAGINATION CLICK
$(document).on('click', '#loanListArea .pagination a', function (e) {

    e.preventDefault();

    let url = $(this).attr('href');
    let search = $('#loanSearch').val();

    $('#loanListArea').html('<div class="text-center py-4">Loading...</div>');

    $.ajax({
        url: url,
        type: 'GET',
        data: {
            search: search,
            type: currentType
        },
        success: function (res) {

            $('#loanListArea').html(res);

        },
        error: function () {

            $('#loanListArea').html('<div class="text-danger text-center py-4">Pagination failed</div>');

        }
    });

});

</script>


<script>
$(document).on('click', '#loanListArea .pagination a', function (e) {
    e.preventDefault();

    let url = $(this).attr('href');
    let search = $('#loanSearch').val();

    $('#loanListArea').html('<div class="text-center py-4">Loading...</div>');

    $.ajax({
        url: url,
        type: 'GET',
        data: {
           search: search,
             type: currentType
        },
        success: function (res) {
            $('#loanListArea').html(res);
        }
    });
});
</script>

@endsection




