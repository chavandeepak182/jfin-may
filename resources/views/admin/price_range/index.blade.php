@extends('layouts.header')
@section('content')
<div class="container">
    <h2>Price Range List</h2>

    <a href="{{ url('admin/price-range/create') }}" class="btn btn-primary mb-3">Add New</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>From Price</th>
            <th>To Price</th>
            <th>Action</th>
        </tr>

        @foreach($ranges as $row)
        <tr>
            <td>{{ $row->range_id }}</td>
            <td>{{ $row->from_price }}</td>
            <td>{{ $row->to_price }}</td>
            <td>
                <a href="{{ url('admin/price-range/edit/'.$row->range_id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ url('admin/price-range/delete/'.$row->range_id) }}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection