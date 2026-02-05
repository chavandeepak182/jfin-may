@extends('layouts.header')

@section('title')
    @parent
    JFS | Monthly P&L List
@endsection

@section('content')
@parent

<!-- ================= HEADER ================= -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Monthly P&L
                </li>
            </ol>
        </nav>

        <a href="{{ route('monthlyPL.index') }}"
           class="btn btn-primary">
            + Create Monthly P&L
        </a>
    </div>
</div>

<!-- ================= TABLE ================= -->
<div class="row bg-white">
    <div class="col-lg-12 p-4">

        <div class="table-responsive">
            <form method="GET" action="{{ route('monthlyPL.list') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search by month or year (e.g. Jan 2025)"
               value="{{ request('search') }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">
            Search
        </button>
    </div>
</form>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Month</th>
                        <th class="text-end">Revenue Total</th>
                        <th class="text-end">Net Profit</th>
                        <th class="text-end">Net To Company</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($pls as $key => $pl)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                            {{ \Carbon\Carbon::createFromDate($pl->year, $pl->month, 1)->format('M Y') }}
                        </td>

                        <td class="text-end">
                            ₹ {{ number_format($pl->revenue_total, 2) }}
                        </td>

                        <td class="text-end">
                            ₹ {{ number_format($pl->net_profit, 2) }}
                        </td>

                        <td class="text-end">
                            ₹ {{ number_format($pl->net_company, 2) }}
                        </td>

                        <td>
                            <a href="{{ route('monthlyPL.show', $pl->id) }}"
                            class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> View
                            </a>

                            {{-- EXPORT EXCEL --}}
                            <!-- <a href="{{ route('monthlyPL.exportFormatted', $pl->id) }}"
                               class="btn btn-sm btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Excel
                            </a> -->
                            <a href="{{ route('monthlyPL.exportWithEstimated', $pl->id) }}"
                                class="btn btn-success btn-sm">
                                Export Excel 
                            </a>
                            <!-- (Estimated + P&L) -->

                            {{-- FUTURE: VIEW / EDIT --}}
                            {{-- <a href="#" class="btn btn-sm btn-primary">View</a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No Monthly P&L records found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
