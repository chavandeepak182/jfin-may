@extends('layouts.header')
@section('title')
@parent
Edit MIS Record
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit MIS Record</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('mis.update', $misRecord->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- PUT method for updating the record -->

            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="name" class="col-form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $misRecord->name }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label for="email" class="col-form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $misRecord->email }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="contact" class="col-form-label">Contact:</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $misRecord->contact }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label for="product_type" class="col-form-label">Product Type:</label>
                    <input type="text" class="form-control" id="product_type" name="product_type" value="{{ $misRecord->product_type }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="amount" class="col-form-label">Amount:</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $misRecord->amount }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label for="city" class="col-form-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $misRecord->city }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="address" class="col-form-label">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ $misRecord->address }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('mis.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
