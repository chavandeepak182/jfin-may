@extends('layouts.header')
@section('content')
<div class="container">
    <h2>Add Price Range</h2>

    <form method="POST" action="{{ url('admin/price-range/store') }}">
        @csrf

        <div class="mb-3">
            <label>From Price</label>
            <input type="number" name="from_price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>To Price</label>
            <input type="number" name="to_price" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection