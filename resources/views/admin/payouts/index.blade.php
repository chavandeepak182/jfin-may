@extends('layouts.header')

@section('content')

<div class="container">

    <h3>DSA Payout List</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Loan ID</th>
                <th>DSA Name</th>
                <th>Loan Amount</th>
                <th>Percentage</th>
                <th>Payout Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($payouts as $payout)
                <tr>
                    <td>{{ $payout->loan_id }}</td>

                    <td>{{ $payout->user->name ?? '-' }}</td>

                    <td>₹ {{ number_format($payout->loan_amount, 2) }}</td>

                    <td>{{ $payout->percentage }}%</td>

                    <td>₹ {{ number_format($payout->payout_amount, 2) }}</td>

                    {{-- STATUS --}}
                    <td>
                        @if($payout->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($payout->status == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($payout->status) }}</span>
                        @endif
                    </td>

                    {{-- ACTION --}}
                    <td>
                        @if($payout->status != 'paid')
                            <form action="{{ route('payouts.release', $payout->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Release payout?')">
                                    Release
                                </button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        No payouts found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection