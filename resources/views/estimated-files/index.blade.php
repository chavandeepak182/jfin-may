@extends('layouts.header')

@section('title')
    @parent
    JFS | Estimated Files
@endsection

@section('content')
@parent

<!-- ================= CARD HEADER ================= -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Estimated Files</li>
            </ol>
        </nav>
        <a href="{{ route('monthlyPL.index') }}"
   class="btn btn-success btn-icon-text">
    <i class="bi bi-graph-up"></i>
    Monthly P&L
</a>

        <a href="{{ route('estimatedFile.create') }}"
           class="btn btn-primary btn-icon-text">
            <i class="bi bi-plus-lg"></i>
            <span class="text">Add Estimated File</span>
        </a>
    </div>
</div>

<!-- ================= FILTER BAR ================= -->
<div class="row bg-white">
    <div class="col-lg-12 p-4">

        <form method="GET" action="{{ route('estimatedFile.index') }}">
            <div class="row g-3 align-items-end">

                <!-- Search -->
                <div class="col-lg-4">
                    <label class="form-label">Search</label>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Customer name or mobile"
                           value="{{ request('search') }}">
                </div>

                <!-- Month Filter -->
                <div class="col-lg-3">
                    <label class="form-label">Report Month</label>
                    <input type="month"
                           name="report_month"
                           class="form-control"
                           value="{{ request('report_month') }}">
                </div>

                <!-- Buttons -->
                <div class="col-lg-5 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-calculator"></i> Calculate
                    </button>

                    <a href="{{ route('estimatedFile.index') }}"
                       class="btn btn-light border">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>
@if(request('report_month'))
<div class="row bg-white">
    <div class="col-lg-12 px-4 pb-3">
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <strong>
                Gross Revenue – Loan
                ({{ \Carbon\Carbon::createFromFormat('Y-m', request('report_month'))->format('M Y') }})
            </strong>
            <span class="fs-5 fw-bold">
                ₹ {{ number_format($grossRevenue, 2) }}
            </span>
        </div>
    </div>
</div>
@endif
<!-- ================= TABLE ================= -->
<div class="row bg-white">
    <div class="col-lg-12 p-4">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">Sr. No</th>
                        <th>Customer Name</th>
                        <th>Mobile</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estimatedFiles as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->customer_name }}</td>
                            <td>{{ $row->mobile }}</td>
                            <td>
                                <a href="{{ route('estimatedFile.edit', $row->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('estimatedFile.delete', $row->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
