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

    .btn-add {
        background: #007bff;
        color: #fff;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-add:hover {
        background: #0056b3;
        color: #fff;
    }

    .custom-table {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .custom-table th {
        background: #007bff;
        color: #fff;
        text-align: center;
    }

    .custom-table td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-warning {
        border-radius: 6px;
        padding: 5px 10px;
    }

    .btn-danger {
        border-radius: 6px;
        padding: 5px 10px;
    }
</style>

<div class="container">

    {{-- HEADER ROW --}}
    <div class="page-header">
        <h2>Price Range List</h2>

        <a href="{{ url('admin/price-range/create') }}" class="btn btn-add">
            + Add New
        </a>
    </div>

    {{-- TABLE --}}
    <table class="table table-bordered custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>From Price</th>
                <th>To Price</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ranges as $row)
            <tr>
                <td>{{ $row->range_id }}</td>
                <td>₹ {{ number_format($row->from_price) }}</td>
                <td>₹ {{ number_format($row->to_price) }}</td>
                <td>
                    <a href="{{ url('admin/price-range/edit/'.$row->range_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ url('admin/price-range/delete/'.$row->range_id) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection