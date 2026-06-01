@extends('layouts.header')

@section('title')
    @parent
    DSA Wallet
@endsection

@section('content')
@parent

<style>

body{
    background:#f4f7fb;
}

/* =======================
    PAGE HEADER
======================= */

.wallet-page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
    gap:15px;
}

.wallet-page-header h2{
    font-size:30px;
    font-weight:700;
    color:#111827;
    margin:0;
}

.wallet-page-header p{
    color:#6b7280;
    margin:5px 0 0;
}

/* =======================
    BALANCE CARD
======================= */

.wallet-card{
    position:relative;
    overflow:hidden;
    border-radius:24px;
    padding:35px;
    background:linear-gradient(135deg,#2563eb,#1e40af,#0f172a);
    color:#fff;
    margin-bottom:30px;
    box-shadow:0 15px 40px rgba(37,99,235,0.25);
}

.wallet-card::before{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    background:rgba(255,255,255,0.08);
    border-radius:50%;
    top:-120px;
    right:-80px;
}

.wallet-card::after{
    content:'';
    position:absolute;
    width:180px;
    height:180px;
    background:rgba(255,255,255,0.05);
    border-radius:50%;
    bottom:-80px;
    left:-60px;
}

.wallet-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:relative;
    z-index:2;
}

.wallet-icon{
    width:70px;
    height:70px;
    border-radius:18px;
    background:rgba(255,255,255,0.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    backdrop-filter:blur(8px);
}

.wallet-title{
    font-size:16px;
    opacity:0.85;
    margin-bottom:10px;
}

.wallet-balance{
    font-size:48px;
    font-weight:800;
    letter-spacing:1px;
    margin-bottom:8px;
}

.wallet-subtitle{
    opacity:0.8;
    font-size:14px;
}

/* =======================
    STATS
======================= */

.wallet-stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.stat-box{
    background:#fff;
    border-radius:18px;
    padding:22px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
    transition:0.3s;
}

.stat-box:hover{
    transform:translateY(-4px);
}

.stat-box h5{
    color:#6b7280;
    font-size:14px;
    margin-bottom:10px;
}

.stat-box h3{
    font-size:28px;
    margin:0;
    font-weight:700;
}

.credit-text{
    color:#16a34a;
}

.debit-text{
    color:#dc2626;
}

/* =======================
    TABLE
======================= */

.wallet-table{
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 5px 25px rgba(0,0,0,0.06);
}

.table-header{
    padding:22px 25px;
    border-bottom:1px solid #eef2f7;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.table-header h4{
    margin:0;
    font-size:22px;
    font-weight:700;
    color:#111827;
}

.table{
    margin-bottom:0;
}

.wallet-table th{
    background:#f8fafc;
    color:#374151;
    font-size:14px;
    font-weight:700;
    padding:18px;
    border:none;
}

.wallet-table td{
    padding:18px;
    vertical-align:middle;
    border-color:#f1f5f9;
}

.wallet-table tr{
    transition:0.3s;
}

.wallet-table tbody tr:hover{
    background:#f8fbff;
}

.credit{
    color:#16a34a;
    font-weight:700;
}

.debit{
    color:#dc2626;
    font-weight:700;
}

.balance{
    font-weight:700;
    color:#111827;
}

/* =======================
    BADGES
======================= */

.badge-credit{
    background:#dcfce7;
    color:#166534;
    padding:8px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
}

.badge-debit{
    background:#fee2e2;
    color:#991b1b;
    padding:8px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
}

/* =======================
    EMPTY STATE
======================= */

.no-data{
    padding:50px !important;
    text-align:center;
}

.no-data i{
    font-size:50px;
    color:#cbd5e1;
    margin-bottom:15px;
}

.no-data h5{
    color:#374151;
    margin-bottom:8px;
}

.no-data p{
    color:#94a3b8;
    margin:0;
}

/* =======================
    RESPONSIVE
======================= */

@media(max-width:768px){

    .wallet-balance{
        font-size:34px;
    }

    .wallet-card{
        padding:25px;
    }

    .wallet-top{
        flex-direction:column;
        align-items:flex-start;
        gap:20px;
    }

}

</style>

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="wallet-page-header">

        <div>
            <h2>DSA Wallet</h2>
            <p>Track your payouts, credits and wallet balance</p>
        </div>

    </div>

    <!-- BALANCE CARD -->
    <div class="wallet-card">

        <div class="wallet-top">

            <div>

                <div class="wallet-title">
                    Available Wallet Balance
                </div>

                <div class="wallet-balance">
                    ₹ {{ number_format($balance,2) }}
                </div>

                <div class="wallet-subtitle">
                    Updated wallet balance
                </div>

            </div>

            <div class="wallet-icon">
                <i class="fas fa-wallet"></i>
            </div>

        </div>

    </div>

    <!-- STATS -->
    <div class="wallet-stats">

        <div class="stat-box">

            <h5>Total Credits</h5>

            <h3 class="credit-text">
                ₹ {{ number_format($wallets->sum('credit'),2) }}
            </h3>

        </div>

        <div class="stat-box">

            <h5>Total Debits</h5>

            <h3 class="debit-text">
                ₹ {{ number_format($wallets->sum('debit'),2) }}
            </h3>

        </div>

        <div class="stat-box">

            <h5>Total Transactions</h5>

            <h3>
                {{ $wallets->count() }}
            </h3>

        </div>

    </div>

    <!-- TRANSACTION TABLE -->
    <div class="wallet-table">

        <div class="table-header">

            <h4>Wallet Transactions</h4>

        </div>

        <table class="table align-middle">

            <thead>

                <tr>
                    <th>Date</th>
                    <th>Remark</th>
                    <th>Type</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <th>Balance</th>
                </tr>

            </thead>

            <tbody>

                @forelse($wallets as $wallet)

                <tr>

                    <td>
                        {{ date('d M Y', strtotime($wallet->created_at)) }}
                    </td>

                    <td>
                        {{ $wallet->remark }}
                    </td>

                    <td>

                        @if($wallet->credit > 0)

                            <span class="badge-credit">
                                Credit
                            </span>

                        @else

                            <span class="badge-debit">
                                Debit
                            </span>

                        @endif

                    </td>

                    <td class="credit">
                        ₹ {{ number_format($wallet->credit,2) }}
                    </td>

                    <td class="debit">
                        ₹ {{ number_format($wallet->debit,2) }}
                    </td>

                    <td class="balance">
                        ₹ {{ number_format($wallet->balance,2) }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="no-data">

                        <i class="fas fa-wallet"></i>

                        <h5>No Wallet History Found</h5>

                        <p>No transactions available yet.</p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection