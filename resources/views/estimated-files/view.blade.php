@extends('layouts.header')

@section('title')
    @parent
    JFS | Monthly P&L View
@endsection

@section('content')
@parent

@php
    $readonly = 'readonly';
@endphp

<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('monthlyPL.list') }}">Monthly P&L</a>
                </li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>

        <a href="{{ route('monthlyPL.list') }}" class="btn btn-light border">
            Back
        </a>
    </div>
</div>

<div class="row bg-white">
<div class="col-lg-12 p-4">

{{-- MONTH / YEAR --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <label>Month</label>
        <input class="form-control"
               value="{{ \Carbon\Carbon::createFromDate($pl->year,$pl->month,1)->format('F') }}"
               readonly>
    </div>

    <div class="col-md-3">
        <label>Year</label>
        <input class="form-control"
               value="{{ $pl->year }}"
               readonly>
    </div>
</div>

{{-- REVENUE --}}
<h6>Revenue</h6>
<div class="row g-3">
    <div class="col-md-3">
        <label>Gross Revenue – Loan</label>
        <input class="form-control" value="{{ $pl->gross_revenue }}" readonly>
    </div>
    <div class="col-md-3">
        <label>Insurance</label>
        <input class="form-control" value="{{ $pl->insurance }}" readonly>
    </div>
    <div class="col-md-3">
        <label>Revenue Total</label>
        <input class="form-control" value="{{ $pl->revenue_total }}" readonly>
    </div>
</div>

<hr>

{{-- SALARY --}}
<h6>Salary / Incentive / Broker</h6>
<div class="row g-3">
    <div class="col-md-3">
        <label>Staff Cost</label>
        <input class="form-control" value="{{ $pl->staff_cost }}" readonly>
    </div>
    <div class="col-md-3">
        <label>Staff Incentive</label>
        <input class="form-control" value="{{ $pl->staff_incentive }}" readonly>
    </div>
    <div class="col-md-3">
        <label>Broker Commission</label>
        <input class="form-control" value="{{ $pl->broker_commission }}" readonly>
    </div>
    <div class="col-md-3">
        <label>Total</label>
        <input class="form-control" value="{{ $pl->salary_total }}" readonly>
    </div>
</div>

<hr>

{{-- ADMIN --}}
<h6>Administration / Overheads</h6>
<div class="row g-3">
    <div class="col">
        <label>Office Rental</label>
        <input class="form-control" value="{{ $pl->rental }}" readonly>
    </div>
    <div class="col">
        <label>Operation Expense</label>
        <input class="form-control" value="{{ $pl->opex }}" readonly>
    </div>
    <div class="col">
        <label>Total</label>
        <input class="form-control" value="{{ $pl->admin_overheads }}" readonly>
    </div>
</div>

<hr>

{{-- COST --}}
<h6>Cost</h6>
<div class="row g-3">
    <div class="col">
        <label>CSO Cost</label>
        <input class="form-control" value="{{ $pl->cso_cost }}" readonly>
    </div>
    <div class="col">
        <label>Admin Cost</label>
        <input class="form-control" value="{{ $pl->admin_fixed_cost }}" readonly>
    </div>
    <div class="col">
        <label>Travel</label>
        <input class="form-control" value="{{ $pl->travel_cost }}" readonly>
    </div>
    <div class="col">
        <label>TDS (5%)</label>
        <input class="form-control" value="{{ $pl->tds }}" readonly>
    </div>
    <div class="col">
        <label>Total Cost</label>
        <input class="form-control" value="{{ $pl->cost_total }}" readonly>
    </div>
</div>

<div class="row g-3 mt-3">
    <div class="col-md-3">
        <label>Total Cost (Final)</label>
        <input class="form-control" value="{{ $pl->total_cost }}" readonly>
    </div>
</div>

<hr>

{{-- FINAL --}}
<h6>Final</h6>
<div class="row g-3">
    <div class="col">
        <label>Net Profit</label>
        <input class="form-control" value="{{ $pl->net_profit }}" readonly>
    </div>
    <div class="col">
        <label>Manager P&amp;L</label>
        <input class="form-control" value="{{ $pl->manager_pl }}" readonly>
    </div>
    <div class="col">
        <label>Net To Company</label>
        <input class="form-control" value="{{ $pl->net_company }}" readonly>
    </div>
</div>

</div>
</div>

@endsection
