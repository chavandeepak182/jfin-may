@extends('frontend.layouts.customer-dash')
@section('title', 'My Wallet')

@section('content')
<div class="container-fluid p-0">

    {{-- PAGE HEADING --}}
    <div class="mb-4">
        <h3 class="fw-bold text-dark">My Wallet</h3>
        <p class="text-muted">Manage your earnings and withdrawals</p>
    </div>

    {{-- TABS --}}
    <!-- <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item">
            <button class="nav-link active fw-bold"
                    data-bs-toggle="pill"
                    data-bs-target="#walletTab">
                Wallet
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold"
                    data-bs-toggle="pill"
                    data-bs-target="#legDownTab">
                Leg Down
            </button>
        </li>
        <li class="nav-item">
    <button class="nav-link fw-bold"
            data-bs-toggle="pill"
            data-bs-target="#inviteReferralTab">
        Invite Referral
    </button>
</li>

    </ul> -->
<ul class="nav nav-pills mb-4" role="tablist">

    <li class="nav-item">
        <button class="nav-link fw-bold {{ request('tab') !== 'invite' ? 'active' : '' }}"
                data-bs-toggle="pill"
                data-bs-target="#walletTab">
            Wallet
        </button>
    </li>

    <li class="nav-item">
        <button class="nav-link fw-bold"
                data-bs-toggle="pill"
                data-bs-target="#legDownTab">
            Leg Down
        </button>
    </li>

    <li class="nav-item">
        <button class="nav-link fw-bold {{ request('tab') === 'invite' ? 'active' : '' }}"
                data-bs-toggle="pill"
                data-bs-target="#inviteReferralTab">
            Invite Referral
        </button>
    </li>

</ul>

    {{-- TAB CONTENT --}}
    <div class="tab-content">

        {{-- ================= WALLET TAB ================= --}}
        <div class="tab-pane fade {{ request('tab') !== 'invite' ? 'show active' : '' }}" id="walletTab">


            <div class="row g-4">

                {{-- LEFT SIDE --}}
                <div class="col-lg-8">

                    {{-- WALLET BALANCE --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body text-center py-5">
                            <p class="text-uppercase text-muted fw-bold small mb-1">
                                Current Balance
                            </p>

                            <h1 class="fw-bold text-primary mb-4">
                                ₹{{ number_format($walletBalance, 2) }}
                            </h1>

                            <div class="col-md-6 mx-auto">
                                <form action="{{ route('user.withdraw.request') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">₹</span>
                                        <input type="number"
                                               name="amount"
                                               class="form-control"
                                               placeholder="Enter amount"
                                               min="0"
                                               step="1"
                                               required>
                                    </div>

                                    <button class="btn btn-primary w-100 rounded-pill fw-bold">
                                        Withdraw
                                    </button>
                                </form>
                            </div>

                            <!-- @if(session('message'))
                                <div class="alert alert-success mt-4">
                                    {{ session('message') }}
                                </div>
                            @endif -->
                        </div>
                    </div>

                    {{-- TRANSACTION HISTORY --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">Transaction History</h5>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle">
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

                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <p class="text-uppercase text-muted fw-bold small mb-2">Status</p>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Last Withdrawal</span>
                                <span class="badge bg-warning">Pending</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Last Payout</span>
                                <span class="fw-bold text-success">₹450.00</span>
                            </div>

                            <small class="text-muted d-block mt-2">
                                Oct 24, 2023
                            </small>
                        </div>
                    </div>

                    <div class="card text-white border-0"
                         style="background: linear-gradient(135deg,#4f46e5,#4338ca);">
                        <div class="card-body">
                            <h5 class="fw-bold">Earn More With Us</h5>
                            <p class="small mb-0">
                                Unlock exclusive rewards by referring friends.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- ================= LEG DOWN TAB ================= --}}
        <div class="tab-pane fade" id="legDownTab">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0">Leg Down (My Team)</h5>
                </div>

                <div class="card-body">

                    @if($descendants->isEmpty())
                        <p class="text-center text-muted">
                            No child nodes found.
                        </p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Referral Code</th>
                                        <th>Parent</th>
                                        <th>Loans</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($descendants as $i => $d)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->referral_code }}</td>
                                            <td>{{ $d->parent_name }}</td>
                                            <td>
                                               <select class="form-select child-loans-dropdown"
                                                        data-user-id="{{ $d->user_id }}">
                                                    <option selected disabled>View</option>
                                                    <option value="view">View Loans</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div id="loan-details" class="mt-4" style="display:none;">
                        <h6 class="fw-bold">Loans</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loan Ref</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
        
<div class="tab-pane fade {{ request('tab') === 'invite' ? 'show active' : '' }}"
     id="inviteReferralTab">

        @if(session('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <!-- ✅ Invite Form Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">Invite Referral</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('invite.referral.submit') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Friend Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" maxlength="10" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email (Optional)</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Type</label>
                    <select name="product_type" id="productType" class="form-select" required>
                        <option value="">Select Product</option>
                        @foreach($loanCategories as $category)
                            <option value="{{ $category->loan_category_id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="mb-3 d-none" id="otherRemarkBox">
                    <label class="form-label">Please Specify</label>
                    <input type="text" name="other_remark" class="form-control">
                </div>

                <button class="btn btn-primary fw-bold">Send Invite</button>
            </form>
        </div>
    </div>

    <!-- ✅ Referral List Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h6 class="fw-bold mb-0">My Referral Invites</h6>
        </div>

        <div class="card-body">
            @if($myReferralLeads->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($myReferralLeads as $i => $lead)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->mobile }}</td>
                                    <td>{{ $lead->email ?? '-' }}</td>
                                    <td>{{ $lead->product_name ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-warning">
                                            {{ ucfirst($lead->status) }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center mb-0">
                    No referral invites sent yet.
                </p>
            @endif
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const productType = document.getElementById('productType');
    const remarkBox = document.getElementById('otherRemarkBox');

    productType.addEventListener('change', function () {
        if (this.value === 'other') {
            remarkBox.classList.remove('d-none');
        } else {
            remarkBox.classList.add('d-none');
        }
    });
});
</script>




    </div>
</div>
@endsection


@section('custom-script')
<script>
document.addEventListener('change', async function (e) {

    if (!e.target.classList.contains('child-loans-dropdown')) return;

    const dropdown = e.target;
    const userId = dropdown.dataset.userId;

    const loanBox = document.getElementById('loan-details');
    const loanBody = loanBox.querySelector('tbody');

    loanBox.style.display = 'block';
    loanBody.innerHTML =
        '<tr><td colspan="6" class="text-center">Loading...</td></tr>';

    try {
        const res = await fetch(`/loans-by-child?user_id=${userId}`);
        if (!res.ok) throw new Error('Request failed');

        const loans = await res.json();
        loanBody.innerHTML = '';

        if (!loans.length) {
            loanBody.innerHTML =
                '<tr><td colspan="6" class="text-center">No loans found</td></tr>';
            return;
        }

        loans.forEach((loan, i) => {
            loanBody.innerHTML += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${loan.loan_reference_id}</td>
                    <td>₹${loan.amount}</td>
                    <td>${loan.status}</td>
                    <td>${loan.category_name}</td>
                    <td>${loan.created_at}</td>
                </tr>`;
        });

    } catch (err) {
        loanBody.innerHTML =
            '<tr><td colspan="6" class="text-danger text-center">Failed to load loans</td></tr>';
        console.error(err);
    }

    dropdown.selectedIndex = 0;
});
</script>
@endsection







