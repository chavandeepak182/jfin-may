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
                    <label for="office_contact" class="col-form-label">Office Contact:</label>
                    <input type="text" class="form-control" id="office_contact" name="office_contact" value="{{ $misRecord->office_contact }}" required>
                </div>
                <div class="form-group col-lg-6">
                    <label for="product_type" class="col-form-label">Product Type:</label>
                    <select class="form-control" id="product_type" name="product_type" required>
                        <option value="">Select Product Type</option>
                        <option value="Home Loan" {{ $misRecord->product_type == 'Home Loan' ? 'selected' : '' }}>Home Loan</option>
                        <option value="Personal Loan" {{ $misRecord->product_type == 'Personal Loan' ? 'selected' : '' }}>Personal Loan</option>
                        <option value="MSME" {{ $misRecord->product_type == 'MSME' ? 'selected' : '' }}>MSME</option>
                        <option value="Vehicle Loan" {{ $misRecord->product_type == 'Vehicle Loan' ? 'selected' : '' }}>Vehicle Loan</option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label for="occupation" class="col-form-label">Occupation:</label>
                    <select class="form-control" id="occupation" name="occupation" required>
                        <option value="">Select Occupation</option>
                        <option value="Salaried" {{ $misRecord->occupation == 'Salaried' ? 'selected' : '' }}>Salaried</option>
                        <option value="Self Employed" {{ $misRecord->occupation == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label for="bank_name" class="col-form-label">Bank Name:</label>
                    <select class="form-control" id="bank_name" name="bank_name" required>
                        <option value="">Select Bank Name</option>
                        <option value="IDFC" {{ $misRecord->bank_name == 'IDFC' ? 'selected' : '' }}>IDFC</option>
                        <option value="SBI" {{ $misRecord->bank_name == 'SBI' ? 'selected' : '' }}>SBI</option>
                        <option value="KOTAK" {{ $misRecord->bank_name == 'KOTAK' ? 'selected' : '' }}>KOTAK</option>
                        <option value="HDFC" {{ $misRecord->bank_name == 'HDFC' ? 'selected' : '' }}>HDFC</option>
                        <option value="MAHARASHTRA" {{ $misRecord->bank_name == 'MAHARASHTRA' ? 'selected' : '' }}>MAHARASHTRA</option>
                        <option value="AXIS" {{ $misRecord->bank_name == 'AXIS' ? 'selected' : '' }}>AXIS</option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label for="branch_name" class="col-form-label">Branch Name:</label>
                    <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{ $misRecord->branch_name }}" required>
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
                    <label for="address" class="col-form-label">Residencial Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ $misRecord->address }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="office_address" class="col-form-label">Office Address:</label>
                    <textarea class="form-control" id="office_address" name="office_address" rows="3" required>{{ $misRecord->office_address }}</textarea>
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
