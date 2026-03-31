@extends('layouts.header')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .page-header h2 {
        margin: 0;
        font-weight: 600;
        color: #333;
    }

    .btn-back {
        background: #6c757d;
        color: #fff;
        border-radius: 6px;
        padding: 8px 16px;
        transition: 0.3s;
    }

    .btn-back:hover {
        background: #545b62;
        color: #fff;
    }

    .form-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

    .btn-save {
        background: #007bff;
        color: #fff;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 500;
    }

    .btn-save:hover {
        background:#007bff;
        color: #fff;
    }
</style>

<div class="container">

    {{-- HEADER --}}
    <div class="page-header">
        <h2>Add Price Range</h2>

        <a href="{{ url('admin/price-range') }}" class="btn btn-back">
            ← Back
        </a>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">

        <form method="POST" action="{{ url('admin/price-range/store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">From Price</label>
                <input type="number" name="from_price" class="form-control" placeholder="Enter minimum price" required>
            </div>

            <div class="mb-3">
                <label class="form-label">To Price</label>
                <input type="number" name="to_price" class="form-control" placeholder="Enter maximum price" required>
            </div>

            <button type="submit" class="btn btn-save">
                 Save
            </button>

        </form>

    </div>

</div>

@endsection