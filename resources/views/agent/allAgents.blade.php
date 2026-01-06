@extends('layouts.header')
@section('title')
@parent
JFS | Agents
@endsection
@section('content')

@section('content')
@parent
<style>
    #wrapper #content-wrapper #content{

        background-color: #f8f9fc;
        
    }
    .topbar {
    height: 4.375rem;
    background-color:#000;
}

.dataTables_filter {
    margin-right: 60px;
    text-align: right;
}


</style>
<!-- Breadcrumbs and Search Bar -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Agents</li>
            </ol>
        </nav>
<div class="row no-gutters" style="gap:10px;margin-left:200px;"> 
    <!-- All Customer -->
    <div class="col-auto">
        <a href="{{ route('allUsers') }}"  style="text-decoration: none;">
            <div style="height:50px; width:150px; 
                        background: linear-gradient(135deg, #6a11cb, #2575fc); 
                        border-radius:12px; 
                        display:flex; align-items:center; justify-content:center;
                        color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                <span>All Customer</span>
            </div>
        </a>
    </div>

    <!-- All Channel Partner -->
    <div class="col-auto">
        <a href="{{ route('allPartners') }}" style="text-decoration: none;">
            <div style="height:50px; width:160px; 
                        background: linear-gradient(135deg, #ff512f, #dd2476); 
                        border-radius:12px; 
                        display:flex; align-items:center; justify-content:center;
                        color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                <span>All Channel Partner</span>
            </div>
        </a>
    </div>
</div>


<!-- Hover Effect -->
<style>
    a div:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
</style>

        <!-- Search Bar -->
        
        <!-- Add User Button -->
        <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addAgentView">
            <i class="fa fa-plus"></i> Add Agent
        </button>
    </div>
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="{{ asset('theme') }}/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">


