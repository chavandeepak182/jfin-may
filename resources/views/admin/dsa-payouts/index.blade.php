@extends('layouts.header')

@section('title')
    @parent
    DSA Payout
@endsection

@section('content')
@parent

<style>
.container-box {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.badge {
    padding:5px 10px;
    border-radius:20px;
    color:#fff;
    font-size:12px;
}

.pending { background:orange; }
.released { background:green; }
</style>

<div class="page-header">
    <h1>DSA Monthly Payout</h1>
</div>

<div class="container-box">

    {{-- SUCCESS / ERROR --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('dsa.payout.calculate') }}">
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label>DSA</label>
                <select name="dsa_id" class="form-control" required>
                    <option value="">Select DSA</option>
                    @foreach($dsas as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Month</label>
                <input type="month" name="month" class="form-control" required>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">Calculate</button>
            </div>
        </div>
    </form>
    <style>
.filter-box {
    background: #f8fbff;
    border: 1px solid #dce7f3;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.filter-title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
}

.filter-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-row select,
.filter-row input {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    min-width: 180px;
}

.filter-btn {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 6px 15px;
    border-radius: 6px;
}

.reset-btn {
    background: #6c757d;
    color: #fff;
    padding: 6px 15px;
    border-radius: 6px;
    text-decoration: none;
}
</style>

<div class="filter-box">
    <div class="filter-title">🔍 Filter Payout</div>

    <form method="GET" action="{{ route('dsa.payout.index') }}">
        <div class="filter-row">

            {{-- DSA --}}
            <select name="dsa_id">
                <option value="">All DSA</option>
                @foreach($dsas as $id => $name)
                    <option value="{{ $id }}" {{ request('dsa_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            {{-- MONTH --}}
            <input type="month" name="month" value="{{ request('month') }}">

            {{-- BUTTONS --}}
            <button type="submit" class="filter-btn">Search</button>

            <a href="{{ route('dsa.payout.index') }}" class="reset-btn">Reset</a>

        </div>
    </form>
</div>

    {{-- TABLE --}}
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>DSA</th>
                <th>Month</th>
                <th>Total Loans</th>
                <th>Total Amount</th>
                <th>Total Payout</th>
               
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($payouts as $p)
            <tr>
                <td>{{ $p->dsa->name ?? '' }}</td>
                <td>{{ $p->month }}</td>
                <td>
    <a href="{{ route('dsa.payout.details', [$p->dsa_id, $p->month]) }}" 
       class="btn btn-sm btn-outline-primary">
        {{ $p->total_loans }} Loans
    </a>
</td>
                <td>₹ {{ number_format($p->total_amount,2) }}</td>
                <td>₹ {{ number_format($p->total_payout,2) }}</td>

                <td>
                    <span class="badge {{ $p->status == 'pending' ? 'pending' : 'released' }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
   

                <td>
                 
                   @php
$remaining =
$p->total_payout - $p->released_amount;
@endphp

@if($remaining > 0)

<form method="POST"
      action="{{ route('dsa.payout.release',$p->id) }}"
      class="releaseForm">

    @csrf

    <button class="btn btn-success btn-sm">
        Release
    </button>

</form>

@else

<span class="text-success">
    ✔ Fully Released
</span>

@endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

document.querySelectorAll('.releaseForm').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to release this payout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Release',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});

</script>
@endsection