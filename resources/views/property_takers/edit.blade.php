@extends('layouts.header')

@section('content')
<div class="card shadow mb-4">
    <!-- Breadcrumbs -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Property Taker</li>
                </ol>
            </nav>
            <a href="{{ route('property_takers.index') }}" class="btn btn-primary float-right rounded"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('property_takers.update', $propertyTaker->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="builder_name" class="col-form-label text-md-end">{{ __('Builder Name') }}</label>
                                <input type="text" id="builder_name" class="form-control" name="builder_name" value="{{ old('builder_name', $propertyTaker->builder_name) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="project_name" class="col-form-label text-md-end">{{ __('Project Name') }}</label>
                                <input type="text" id="project_name" class="form-control" name="project_name" value="{{ old('project_name', $propertyTaker->project_name) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="property_type" class="col-form-label text-md-end">{{ __('Property Type') }}</label>
                                <input type="text" id="property_type" class="form-control" name="property_type" value="{{ old('property_type', $propertyTaker->property_type) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="carpet_area" class="col-form-label text-md-end">{{ __('Carpet Area') }}</label>
                                <input type="number" step="0.01" id="carpet_area" class="form-control" name="carpet_area" value="{{ old('carpet_area', $propertyTaker->carpet_area) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="builtup_area" class="col-form-label text-md-end">{{ __('Built-up Area') }}</label>
                                <input type="number" step="0.01" id="builtup_area" class="form-control" name="builtup_area" value="{{ old('builtup_area', $propertyTaker->builtup_area) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="registration_number" class="col-form-label text-md-end">{{ __('Registration Number') }}</label>
                                <input type="text" id="registration_number" class="form-control" name="registration_number" value="{{ old('registration_number', $propertyTaker->registration_number) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="col-form-label text-md-end">{{ __('Address') }}</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{ old('address', $propertyTaker->address) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="actual_agreement_cost" class="col-form-label text-md-end">{{ __('Actual Agreement Cost') }}</label>
                                <input type="number" step="0.01" id="actual_agreement_cost" class="form-control" name="actual_agreement_cost" value="{{ old('actual_agreement_cost', $propertyTaker->actual_agreement_cost) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="gst" class="col-form-label text-md-end">{{ __('GST %') }}</label>
                                <input type="number" step="0.01" id="gst" class="form-control" name="gst" value="{{ old('gst', $propertyTaker->gst) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="extra_charges" class="col-form-label text-md-end">{{ __('Extra Charges') }}</label>
                                <input type="number" step="0.01" id="extra_charges" class="form-control" name="extra_charges" value="{{ old('extra_charges', $propertyTaker->extra_charges) }}">
                            </div>
                            <div class="col-md-3">
                                <label for="any_other_charges" class="col-form-label text-md-end">{{ __('Other Charges') }}</label>
                                <input type="number" step="0.01" id="any_other_charges" class="form-control" name="any_other_charges" value="{{ old('any_other_charges', $propertyTaker->any_other_charges) }}">
                            </div>
                            <!-- <div class="col-md-3">
                                <label for="stamp_percentage" class="col-form-label text-md-end">{{ __('Stamp Percentage %') }}</label>
                                <input type="number" step="0.01" id="stamp_percentage" class="form-control" name="stamp_percentage" value="{{ old('stamp_percentage', $propertyTaker->stamp_percentage ?? 0) }}" required>
                            </div> -->
                            <div class="col-md-4">
                                <label for="stamp_duty" class="col-form-label text-md-end">{{ __('Stamp Duty') }}</label>
                                <input type="number" step="0.01" id="stamp_duty" class="form-control" name="stamp_duty" value="{{ old('stamp_duty', $propertyTaker->stamp_duty) }}" required readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="registration_fees" class="col-form-label text-md-end">{{ __('Registration Fees') }}</label>
                                <input type="number" step="0.01" id="registration_fees" class="form-control" name="registration_fees" value="{{ old('registration_fees', $propertyTaker->registration_fees) }}" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="total_charges" class="col-form-label text-md-end">{{ __('Total Charges') }}</label>
                                <input type="number" step="0.01" id="total_charges" class="form-control" name="total_charges" value="{{ old('total_charges', $propertyTaker->total_charges) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="source_by" class="col-form-label text-md-end">{{ __('Source By') }}</label>
                                <input type="text" id="source_by" class="form-control" name="source_by" value="{{ old('source_by', $propertyTaker->source_by) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="source_name" class="col-form-label text-md-end">{{ __('Source Name') }}</label>
                                <input type="text" id="source_name" class="form-control" name="source_name" value="{{ old('source_name', $propertyTaker->source_name) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="agreement_date" class="col-form-label text-md-end">{{ __('Agreement Date') }}</label>
                                <input type="date" id="agreement_date" class="form-control" name="agreement_date" value="{{ old('agreement_date', \Carbon\Carbon::parse($propertyTaker->agreement_date)->format('Y-m-d')) }}" required>
                            </div>
                            
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-warning px-4 py-2 shadow rounded">{{ __('UPDATE DETAILS') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Get input fields
    const agreementCost = document.getElementById("actual_agreement_cost");
    const gstField = document.getElementById("gst");
    const extraCharges = document.getElementById("extra_charges");
    const stampDuty = document.getElementById("stamp_duty");
    const registrationFees = document.getElementById("registration_fees");
    const otherCharges = document.getElementById("any_other_charges");
    const totalCharges = document.getElementById("total_charges");

    function calculateTotal() {
        let agreementCostValue = parseFloat(agreementCost.value) || 0;
        let gstPercentage = parseFloat(gstField.value) || 0;
        let extraChargesValue = parseFloat(extraCharges.value) || 0;
        let stampDutyValue = parseFloat(stampDuty.value) || 0;
        let registrationFeesValue = parseFloat(registrationFees.value) || 0;
        let otherChargesValue = parseFloat(otherCharges.value) || 0;

        // Calculate GST amount
        let gstAmount = (agreementCostValue * gstPercentage) / 100;

        // Calculate total
        let total = agreementCostValue + gstAmount + extraChargesValue + stampDutyValue + registrationFeesValue + otherChargesValue;

        // Update total charges field
        totalCharges.value = total.toFixed(2);
    }

    // Attach event listeners to update calculation on change
    agreementCost.addEventListener("input", calculateTotal);
    gstField.addEventListener("input", calculateTotal);
    extraCharges.addEventListener("input", calculateTotal);
    stampDuty.addEventListener("input", calculateTotal);
    registrationFees.addEventListener("input", calculateTotal);
    otherCharges.addEventListener("input", calculateTotal);

    // Run calculation on page load to show the correct value
    calculateTotal();
});
</script>

@endsection
