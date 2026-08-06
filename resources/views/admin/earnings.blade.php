@extends('layouts.header')
@section('title')
@parent
JFS | Referral 
@endsection
@section('content')

@section('content')
@parent

<style>
    #wrapper #content-wrapper #content{
    background:#f5f7fb;
}

/* Dashboard Cards */

.dashboard-card{
    display:block;
    text-decoration:none;
    background:#fff;
    border-radius:22px;
    padding:30px;
    border:1px solid #edf2f7;
    min-height:220px;
    box-shadow:0 8px 30px rgba(0,0,0,.08);
    transition:.35s;
}

.dashboard-card:hover{
    transform:translateY(-8px);
    box-shadow:0 18px 35px rgba(0,0,0,.12);
    text-decoration:none;
}

.dashboard-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:35px;
}

.dashboard-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:24px;
}

.dashboard-icon i{
    font-size:24px;
}

.purple{
    background:#efe9ff;
    color:#7c3aed;
}

.orange{
    background:#fff2e8;
    color:#ff7a00;
}

.dashboard-badge{
    padding:8px 18px;
    border-radius:25px;
    font-size:14px;
    font-weight:600;
}

.success{
    background:#e8f9ef;
    color:#16a34a;
}

.danger{
    background:#ffecec;
    color:#ef4444;
}

.dashboard-card h5{
    font-size:28px;
    color:#4b5563;
    margin-bottom:15px;
    font-weight:500;
}

.dashboard-card h2{
    font-size:50px;
    color:#111827;
    font-weight:700;
    margin-bottom:10px;
}

.dashboard-card small{
    color:#94a3b8;
    font-size:15px;
}

/* Table */

.card{
    border:none;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.card-header{
    background:#fff;
    border-bottom:1px solid #edf2f7;
    font-size:18px;
    font-weight:600;
}

.table thead th{
    background:#f8fafc;
    color:#475569;
    font-weight:600;
    border:none;
}

.table tbody tr:hover{
    background:#f9fbff;
}

.btn-primary{
    border-radius:8px;
}

@media(max-width:768px){

.dashboard-card{
    margin-bottom:20px;
    min-height:auto;
}

.dashboard-card h5{
    font-size:22px;
}

.dashboard-card h2{
    font-size:38px;
}

}
    
</style>

<!-- Breadcrumbs -->


<div class="container-fluid px-0 mt-4">

    <div class="row g-4">

        <!-- Redeem Request -->
        <div class="col-lg-6 col-md-6">

            <a href="{{ route('admin.withdrawal.requests') }}" class="dashboard-card">

                <div class="dashboard-top">

                    <div class="dashboard-icon purple">
                        <i class="fas fa-wallet"></i>
                    </div>

                    <span class="dashboard-badge success">
                        Redeem
                    </span>

                </div>

                <h5>Redeem Requests</h5>

               <h2>{{ $redeemCount }}</h2>

                <small>View all redeem requests</small>

            </a>

        </div>

        <!-- Transaction -->

        <div class="col-lg-6 col-md-6">

            <a href="{{ route('admin.transactions') }}" class="dashboard-card">

                <div class="dashboard-top">

                    <div class="dashboard-icon orange">
                        <i class="fas fa-history"></i>
                    </div>

                    <span class="dashboard-badge danger">
                        History
                    </span>

                </div>

                <h5>Transaction History</h5>
              <h2>{{ $transactionCount }}</h2>

                <small>View all transaction history</small>

            </a>

        </div>

    </div>

</div><br>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>

<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

       <div class="card custom-table-card">

    <div class="card-header custom-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0">
                    <i class="fas fa-users text-primary me-2"></i>
                    Referral Users
                </h4>

                <small class="text-muted">
                    Total Users : {{ $data['earnings']->count() }}
                </small>

            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table id="example" class="table custom-table align-middle">

                <thead>

                    <tr>

                        <th>Referral Code</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Mobile</th>

                        <th>Wallet</th>

                        <th>DOB</th>

                        <th width="80">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($data['earnings'] as $user)

                    <tr>

                        <td>

                            <span class="badge bg-primary">
                                {{ $user->referral_code }}
                            </span>

                        </td>

                        <td>

                            <strong>{{ $user->name }}</strong>

                        </td>

                        <td>{{ $user->email_id }}</td>

                        <td>{{ $user->mobile_no }}</td>

                        <td>

                            <span class="wallet-price">

                                ₹ {{ number_format($user->wallet_balance,2) }}

                            </span>

                        </td>

                        <td>{{ $user->dob }}</td>

                        <td>

                            <button
                                class="btn btn-sm btn-primary rounded-circle"
                                data-bs-toggle="modal"
                                data-bs-target="#viewUserModal{{ $user->id }}">
                                <i class="fa fa-eye"></i>
                            </button>

                        </td>

                    </tr>
                    <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    User Details
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label><strong>Referral Code</strong></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->referral_code }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Name</strong></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->name }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Email</strong></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->email_id }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Mobile Number</strong></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->mobile_no }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Wallet Balance</strong></label>
                        <input type="text"
                               class="form-control"
                               value="₹ {{ number_format($user->wallet_balance,2) }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label><strong>Date of Birth</strong></label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->dob }}"
                               readonly>
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>

            </div>

        </div>
    </div>
</div>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-3 d-flex justify-content-end">

            {{ $data['earnings']->links() }}

        </div>

    </div>

</div>
<style>
    .custom-table-card{

    border:none;

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 10px 35px rgba(0,0,0,.08);

}

.custom-header{

    background:#fff;

    padding:22px 25px;

    border-bottom:1px solid #edf2f7;

}

.custom-header h4{

    font-weight:700;

    color:#1e293b;

}

.custom-table{

    margin:0;

}

.custom-table thead{

    background:#f8fafc;

}

.custom-table thead th{

    border:none;

    color:#475569;

    font-weight:700;

    padding:16px;

    white-space:nowrap;

}

.custom-table tbody td{

    padding:16px;

    border-top:1px solid #f1f5f9;

    vertical-align:middle;

}

.custom-table tbody tr{

    transition:.3s;

}

.custom-table tbody tr:hover{

    background:#f8fbff;

}

.wallet-price{

    background:#e8fff2;

    color:#16a34a;

    padding:7px 14px;

    border-radius:30px;

    font-weight:600;

}

.badge.bg-primary{

    font-size:13px;

    padding:8px 12px;

}

.btn-primary{

    width:36px;

    height:36px;

    display:flex;

    align-items:center;

    justify-content:center;

}

.dataTables_wrapper .dataTables_filter input{

    border-radius:10px;

    border:1px solid #ddd;

    padding:6px 12px;

}

.dataTables_wrapper .dataTables_length select{

    border-radius:8px;

}
</style>

   


   
   

@endsection

@section('script')
@parent

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>




<!--export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script>

$(document).ready( function () {
    $('#example').DataTable();
} );

</script>




@endsection