@extends('layouts.header')
@section('content')
<div class="container">
    <h2>Edit Price Range</h2>

    <form method="POST" action="{{ url('admin/price-range/update/'.$range->range_id) }}">
        @csrf

        <div class="mb-3">
            <label>From Price</label>
            <input type="number" name="from_price" value="{{ $range->from_price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>To Price</label>
            <input type="number" name="to_price" value="{{ $range->to_price }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection