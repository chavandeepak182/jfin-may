@extends('frontend.layouts.customer-dash')
@section('title', 'My Wallet')

@section('content')
<div class="container-fluid p-0">

    <div class="mb-4">
        <h3 class="fw-bold text-dark">My Wallet</h3>
        <p class="text-muted">Manage your earnings and withdrawals</p>
    </div>

    <div class="row g-4">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            {{-- WALLET BALANCE --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center py-5">
                    <p class="text-uppercase text-muted fw-bold small mb-1">Current Balance</p>
                    <h1 class="fw-bold text-primary mb-4">
                        ₹{{ number_format($walletBalance, 2) }}
                    </h1>

                    {{-- Withdraw --}}
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('user.withdraw.request') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text">₹</span>
                                <input type="number"
                                       name="amount"
                                       class="form-control"
                                       placeholder="Enter amount"
                                       required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-pill">
                                Withdraw
                            </button>
                        </form>
                    </div>

                    @if(session('message'))
                        <div class="alert alert-success mt-4">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- TRANSACTION HISTORY --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Transaction History</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="transactionHistory" class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($combinedData as $data)
                                    <tr>
                                        <td>{{ $data->transaction_id ?? $data->id }}</td>
                                        <td>₹{{ number_format($data->amount, 2) }}</td>
                                        <td>
                                            <span class="badge
                                                {{ $data->status === 'pending' ? 'bg-warning' :
                                                   ($data->status === 'completed' ? 'bg-success' : 'bg-secondary') }}">
                                                {{ ucfirst($data->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y, h:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            {{-- STATUS CARD --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <p class="text-uppercase text-muted fw-bold small mb-2">Status</p>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold">Last Withdrawal</span>
                        <span class="badge bg-warning">Pending</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Last Payout</span>
                        <span class="text-success fw-bold">₹450.00</span>
                    </div>

                    <small class="text-muted d-block mt-2">Oct 24, 2023</small>
                </div>
            </div>

            {{-- PROMO CARD --}}
            <div class="card border-0 text-white"
                 style="background: linear-gradient(135deg, #4f46e5, #4338ca);">
                <div class="card-body py-4">
                    <h5 class="fw-bold mb-2">Earn More With Us</h5>
                    <p class="small mb-0">
                        Unlock exclusive rewards by referring friends to our platform.
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
