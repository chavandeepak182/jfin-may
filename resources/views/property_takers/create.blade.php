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
                    <li class="breadcrumb-item active" aria-current="page">Add New Property Taker</li>
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

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('property_takers.store') }}">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="builder_name" class="col-form-label text-md-end">{{ __('Builder Name') }}</label>
                                <input type="text" id="builder_name" class="form-control" name="builder_name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="project_name" class="col-form-label text-md-end">{{ __('Project Name') }}</label>
                                <input type="text" id="project_name" class="form-control" name="project_name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="property_type" class="col-form-label text-md-end">{{ __('Property Type') }}</label>
                                <input type="text" id="property_type" class="form-control" name="property_type" required>
                            </div>
                            <div class="col-md-4">
                                <label for="carpet_area" class="col-form-label text-md-end">{{ __('Carpet Area') }}</label>
                                <input type="number" step="0.01" id="carpet_area" class="form-control" name="carpet_area" required>
                            </div>
                            <div class="col-md-4">
                                <label for="builtup_area" class="col-form-label text-md-end">{{ __('Built-up Area') }}</label>
                                <input type="number" step="0.01" id="builtup_area" class="form-control" name="builtup_area" required>
                            </div>
                            <div class="col-md-4">
                                <label for="registration_number" class="col-form-label text-md-end">{{ __('Registration Number') }}</label>
                                <input type="text" id="registration_number" class="form-control" name="registration_number" required>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="col-form-label text-md-end">{{ __('Address') }}</label>
                                <input type="text" id="address" class="form-control" name="address" required>
                            </div>
                            <div class="col-md-3">
                                <label for="actual_agreement_cost" class="col-form-label text-md-end">{{ __('Actual Agreement Cost') }}</label>
                                <input type="number" step="0.01" id="actual_agreement_cost" class="form-control" name="actual_agreement_cost" required>
                            </div>
                            <div class="col-md-3">
                                <label for="gst" class="col-form-label text-md-end">{{ __('GST %') }}</label>
                                <input type="number" step="0.01" id="gst" class="form-control" name="gst" required>
                            </div>
                            <div class="col-md-3">
                                <label for="after_gst_agreement_cost" class="col-form-label text-md-end">{{ __('After GST Agreement Cost') }}</label>
                                <input type="number" step="0.01" id="after_gst_agreement_cost" class="form-control" name="after_gst_agreement_cost" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="extra_charges" class="col-form-label text-md-end">{{ __('Extra Charges') }}</label>
                                <input type="number" step="0.01" id="extra_charges" class="form-control" name="extra_charges">
                            </div>
                            <div class="col-md-3">
                                <label for="stamp_duty_percentage" class="col-form-label text-md-end">Stamp Duty (%)</label>
                                <input type="number" step="0.01" id="stamp_duty_percentage" class="form-control" name="stamp_duty_percentage" required>
                            </div>

                            <div class="col-md-3">
                                <label for="stamp_duty" class="col-form-label text-md-end">Stamp Duty Amount</label>
                                <input type="number" step="0.01" id="stamp_duty" class="form-control" name="stamp_duty" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="registration_fees" class="col-form-label text-md-end">{{ __('Registration Fees') }}</label>
                                <input type="number" step="0.01" id="registration_fees" class="form-control" name="registration_fees" required>
                            </div>
                            <div class="col-md-3">
                                <label for="any_other_charges" class="col-form-label text-md-end">{{ __('Other Charges') }}</label>
                                <input type="number" step="0.01" id="any_other_charges" class="form-control" name="any_other_charges">
                            </div>
                            <div class="col-md-3">
                                <label for="total_charges" class="col-form-label text-md-end">{{ __('Total Charges') }}</label>
                                <input type="number" step="0.01" id="total_charges" class="form-control" name="total_charges" required>
                            </div>
                            <!-- test -->
                            <div class="col-md-3">
                                <!-- Source By -->
                                <div class="form-group">
                                    <label for="source_by" class="col-form-label text-md-end">Source By</label>
                                    <select class="form-control" id="source_by" name="source_by" required>
                                        <option value="">Select Source</option>
                                        <option value="Agent">Agent</option>
                                        <option value="Builder">Builder</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            <!-- Agent Dropdown -->
                                <div class="form-group" id="agent_list" style="display: none;">
                                    <label for="source_name_agent" class="col-form-label text-md-end">Select Agent</label>
                                    <select class="form-control" id="source_name_agent" name="source_name_agent">
                                        <option value="">Select Agent</option>
                                        @foreach($agents as $agent)
                                            <option value="{{ $agent->name }}">{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Builder Input -->
                                <div class="form-group" id="builder_input" style="display: none;">
                                    <label for="source_name_builder" class="col-form-label text-md-end">Enter Source Name</label>
                                    <input type="text" class="form-control" id="source_name_builder" name="source_name_builder">
                                </div>
                            </div>                            
                            <!-- test -->
                            <div class="col-md-3">
                                <label for="agreement_date" class="col-form-label text-md-end">{{ __('Agreement Date') }}</label>
                                <input type="date" id="agreement_date" class="form-control" name="agreement_date" required>
                            </div>                            
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2 shadow rounded">{{ __('SAVE DETAILS') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    function calculateCharges() {
        let actualCost = parseFloat(document.getElementById('actual_agreement_cost').value) || 0;
        let gst = parseFloat(document.getElementById('gst').value) || 0;
        let stampDutyPercentage = parseFloat(document.getElementById('stamp_duty_percentage').value) || 0;
        let extraCharges = parseFloat(document.getElementById('extra_charges').value) || 0;
        let registrationFees = parseFloat(document.getElementById('registration_fees').value) || 0;
        let otherCharges = parseFloat(document.getElementById('any_other_charges').value) || 0;

        // Calculate GST amount
        let gstAmount = (actualCost * gst) / 100;

        // Calculate after GST agreement cost
        let afterGstAgreementCost = actualCost + gstAmount;
        document.getElementById('after_gst_agreement_cost').value = afterGstAgreementCost.toFixed(2);

        // Calculate Stamp Duty Amount from Percentage
        let stampDutyAmount = (actualCost * stampDutyPercentage) / 100;
        document.getElementById('stamp_duty').value = stampDutyAmount.toFixed(2);

        // Calculate total charges
        let totalCharges = afterGstAgreementCost + stampDutyAmount + registrationFees + extraCharges + otherCharges;
        document.getElementById('total_charges').value = totalCharges.toFixed(2);
    }

    // Attach event listeners
    document.getElementById('actual_agreement_cost').addEventListener('input', calculateCharges);
    document.getElementById('gst').addEventListener('input', calculateCharges);
    document.getElementById('stamp_duty_percentage').addEventListener('input', calculateCharges);
    document.getElementById('extra_charges').addEventListener('input', calculateCharges);
    document.getElementById('registration_fees').addEventListener('input', calculateCharges);
    document.getElementById('any_other_charges').addEventListener('input', calculateCharges);
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("source_by").addEventListener("change", function () {
        let source = this.value;
        if (source === "Agent") {
            document.getElementById("agent_list").style.display = "block";
            document.getElementById("builder_input").style.display = "none";
            document.getElementById("source_name_builder").value = ""; // Clear builder input
        } else if (source === "Builder") {
            document.getElementById("builder_input").style.display = "block";
            document.getElementById("agent_list").style.display = "none";
            document.getElementById("source_name_agent").selectedIndex = 0; // Reset agent dropdown
        } else {
            document.getElementById("agent_list").style.display = "none";
            document.getElementById("builder_input").style.display = "none";
            document.getElementById("source_name_agent").selectedIndex = 0;
            document.getElementById("source_name_builder").value = "";
        }
    });
});
</script>
@endsection
