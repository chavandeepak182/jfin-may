@extends('layouts.header')

@section('content')
<div class="card shadow mb-4">
    <!-- Breadcrumbs -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Property Taker</li>
                </ol>
            </nav>
            <a href="{{ route('property_takers.index') }}" class="btn btn-primary float-right rounded">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('property_takers.update', $propertyTaker->id) }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="builder_name">Builder Name</label>
                    <input type="text" id="builder_name" class="form-control" name="builder_name"
                           value="{{ old('builder_name', $propertyTaker->builder_name) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="project_name">Project Name</label>
                    <input type="text" id="project_name" class="form-control" name="project_name"
                           value="{{ old('project_name', $propertyTaker->project_name) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="property_type">Property Type</label>
                    <input type="text" id="property_type" class="form-control" name="property_type"
                           value="{{ old('property_type', $propertyTaker->property_type) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="carpet_area">Carpet Area</label>
                    <input type="number" step="0.01" id="carpet_area" class="form-control" name="carpet_area"
                           value="{{ old('carpet_area', $propertyTaker->carpet_area) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="builtup_area">Built-up Area</label>
                    <input type="number" step="0.01" id="builtup_area" class="form-control" name="builtup_area"
                           value="{{ old('builtup_area', $propertyTaker->builtup_area) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="registration_number">Registration Number</label>
                    <input type="text" id="registration_number" class="form-control" name="registration_number"
                           value="{{ old('registration_number', $propertyTaker->registration_number) }}" required>
                </div>
                <div class="col-md-12">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" name="address"
                           value="{{ old('address', $propertyTaker->address) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="actual_agreement_cost">Actual Agreement Cost</label>
                    <input type="number" step="0.01" id="actual_agreement_cost" class="form-control"
                           name="actual_agreement_cost"
                           value="{{ old('actual_agreement_cost', $propertyTaker->actual_agreement_cost) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="gst">GST %</label>
                    <input type="number" step="0.01" id="gst" class="form-control" name="gst"
                           value="{{ old('gst', $propertyTaker->gst) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="extra_charges">Extra Charges</label>
                    <input type="number" step="0.01" id="extra_charges" class="form-control" name="extra_charges"
                           value="{{ old('extra_charges', $propertyTaker->extra_charges) }}">
                </div>
                <div class="col-md-3">
                    <label for="any_other_charges">Other Charges</label>
                    <input type="number" step="0.01" id="any_other_charges" class="form-control" name="any_other_charges"
                           value="{{ old('any_other_charges', $propertyTaker->any_other_charges) }}">
                </div>

                <!-- Stamp Duty % -->
                <div class="col-md-3">
                    <label for="stamp_duty_percentage">Stamp Duty (%)</label>
                    <input type="number" step="0.01" name="stamp_duty_percentage" id="stamp_duty_percentage" 
                           class="form-control" 
                           value="{{ old('stamp_duty_percentage', $propertyTaker->stamp_duty_percentage) }}" required>
                </div>

                <div class="col-md-3">
                    <label for="stamp_duty">Stamp Duty Amount</label>
                    <input type="number" step="0.01" id="stamp_duty" class="form-control"
                           name="stamp_duty"
                           value="{{ old('stamp_duty', $propertyTaker->stamp_duty) }}" readonly>
                </div>
                <div class="col-md-3">
                    <label for="registration_fees">Registration Fees</label>
                    <input type="number" step="0.01" id="registration_fees" class="form-control" name="registration_fees"
                           value="{{ old('registration_fees', $propertyTaker->registration_fees) }}" required>
                </div>
                <div class="col-md-3">
                    <label for="total_charges">Total Charges</label>
                    <input type="number" step="0.01" id="total_charges" class="form-control" name="total_charges"
                           value="{{ old('total_charges', $propertyTaker->total_charges) }}" required>
                </div>

                <div class="col-md-4">
                    <label for="source_by">Source By</label>
                    <input type="text" id="source_by" class="form-control" name="source_by"
                           value="{{ old('source_by', $propertyTaker->source_by) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="source_name">Source Name</label>
                    <input type="text" id="source_name" class="form-control" name="source_name"
                           value="{{ old('source_name', $propertyTaker->source_name) }}">
                </div>
                <div class="col-md-4">
                    <label for="agreement_date">Agreement Date</label>
                    <input type="date" id="agreement_date" class="form-control" name="agreement_date"
                           value="{{ old('agreement_date', \Carbon\Carbon::parse($propertyTaker->agreement_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="col-md-4 mt-4">
                    <button type="submit" class="btn btn-warning px-4 py-2 shadow rounded">
                        UPDATE DETAILS
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const agreementCost = document.getElementById("actual_agreement_cost");
    const gstField = document.getElementById("gst");
    const extraCharges = document.getElementById("extra_charges");
    const stampPerc = document.getElementById("stamp_duty_percentage");
    const stampDuty = document.getElementById("stamp_duty");
    const registrationFees = document.getElementById("registration_fees");
    const otherCharges = document.getElementById("any_other_charges");
    const totalCharges = document.getElementById("total_charges");

    function calculateTotal() {
        let agreementCostValue = parseFloat(agreementCost.value) || 0;
        let gstPercentage = parseFloat(gstField.value) || 0;
        let extraChargesValue = parseFloat(extraCharges.value) || 0;
        let registrationFeesValue = parseFloat(registrationFees.value) || 0;
        let otherChargesValue = parseFloat(otherCharges.value) || 0;
        let stampDutyPercentage = parseFloat(stampPerc.value) || 0;

        // GST
        let gstAmount = (agreementCostValue * gstPercentage) / 100;

        // Stamp Duty
        let stampDutyAmount = (agreementCostValue * stampDutyPercentage) / 100;
        stampDuty.value = stampDutyAmount.toFixed(2);

        // Total
        let total = agreementCostValue + gstAmount + stampDutyAmount +
                    extraChargesValue + registrationFeesValue + otherChargesValue;

        totalCharges.value = total.toFixed(2);
    }

    [agreementCost, gstField, extraCharges, stampPerc, registrationFees, otherCharges]
        .forEach(field => field.addEventListener("input", calculateTotal));

    calculateTotal(); // initial calculation
});
</script>
@endsection
