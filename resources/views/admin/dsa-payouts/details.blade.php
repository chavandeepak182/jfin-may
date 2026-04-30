@extends('layouts.header')

@section('content')

<style>
body {
    background: #f4f6f9;
}

/* Card Container */
.card-box {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.percent-badge {
    background:#007bff;
    color:#fff;
    padding:4px 10px;
    border-radius:12px;
    font-size:12px;
}

/* Header */
.page-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

/* Table Styling */
.table-custom {
    width: 100%;
    border-collapse: collapse;
}

.table-custom thead {
    background: #1e2a38;
    color: #fff;
}

.table-custom th {
    padding: 12px;
    text-align: center;
    font-size: 14px;
}

.table-custom td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 14px;
}

.table-custom tbody tr:nth-child(even) {
    background: #f9f9f9;
}

.table-custom tbody tr:hover {
    background: #f1f7ff;
}

/* Amount Highlight */
.amount {
    font-weight: bold;
    color: #28a745;
}

/* Empty Row */
.no-data {
    text-align: center;
    padding: 20px;
    color: #888;
}

/* Back Button */
.back-btn {
    margin-bottom: 15px;
}
</style>

<div class="container mt-4">

    <div class="card-box">

       <div class="d-flex justify-content-between align-items-center">
    <div class="page-title">
        📊 Loan Details - {{ $month }}
        <br>
         <span class="dsa-badge">
        DSA: {{ $dsa->name ?? 'N/A' }}
    </span>
    </div>

    <a href="{{ route('dsa.payout.index') }}" class="btn btn-secondary back-btn">
        ← Back
    </a>
</div>
<style>
    .dsa-badge {
    display: inline-block;
    background: linear-gradient(45deg, #007bff, #00c6ff);
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: bold;
    margin-top: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}
</style>

        <table class="table-custom mt-3">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Bank</th>
                    <th>Commission %</th>
                    <th>Category</th>
                    <th>Disbursed Amount</th>
                    <th>Payout Amount</th>
                </tr>
            </thead>
              @php $grandTotal = 0; @endphp

<tbody>
@forelse($loans as $loan)

@php
    $amount = $loan->amount_approved ?? 0;
    $percentage = $loan->percentage ?? 0;
    $payout = ($amount * $percentage) / 100;

    $grandTotal += $payout;
@endphp

<tr>
    <td>{{ $loan->loan_id }}</td>
    <td>{{ $loan->bank_name ?? '-' }}</td>

    <td>
        <span class="percent-badge">
            {{ $percentage }} %
        </span>
    </td>

    <td>{{ $loan->category_name ?? '-' }}</td>

    <td class="amount">
        ₹ {{ number_format($amount,2) }}
    </td>

    <!-- ✅ NEW COLUMN -->
    <td class="amount">
        ₹ {{ number_format($payout,2) }}
    </td>
</tr>

@empty
<tr>
    <td colspan="6" class="no-data">No data found</td>
</tr>
@endforelse
</tbody>
<tfoot>
<tr style="background:#e9f5ff; font-weight:bold;">
    <td colspan="5" style="text-align:right;">Total Payout:</td>
    <td class="amount">
        ₹ {{ number_format($grandTotal,2) }}
    </td>
</tr>
</tfoot>

        </table>

    </div>

</div>

@endsection