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
                            <div class="col-md-3">
                                <label for="carpet_area" class="col-form-label text-md-end">{{ __('Carpet Area') }}</label>
                                <input type="number" step="0.01" id="carpet_area" class="form-control" name="carpet_area" required>
                            </div>
                            <div class="col-md-3">
                                <label for="builtup_area" class="col-form-label text-md-end">{{ __('Built-up Area') }}</label>
                                <input type="number" step="0.01" id="builtup_area" class="form-control" name="builtup_area" required>
                            </div>
                            <div class="col-md-6">
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
                                <label for="extra_charges" class="col-form-label text-md-end">{{ __('Extra Charges') }}</label>
                                <input type="number" step="0.01" id="extra_charges" class="form-control" name="extra_charges">
                            </div>
                            <div class="col-md-3">
                                <label for="stamp_duty" class="col-form-label text-md-end">{{ __('Stamp Duty') }}</label>
                                <input type="number" step="0.01" id="stamp_duty" class="form-control" name="stamp_duty" required>
                            </div>
                            <div class="col-md-4">
                                <label for="registration_fees" class="col-form-label text-md-end">{{ __('Registration Fees') }}</label>
                                <input type="number" step="0.01" id="registration_fees" class="form-control" name="registration_fees" required>
                            </div>
                            <div class="col-md-4">
                                <label for="any_other_charges" class="col-form-label text-md-end">{{ __('Other Charges') }}</label>
                                <input type="number" step="0.01" id="any_other_charges" class="form-control" name="any_other_charges">
                            </div>
                            <div class="col-md-4">
                                <label for="total_charges" class="col-form-label text-md-end">{{ __('Total Charges') }}</label>
                                <input type="number" step="0.01" id="total_charges" class="form-control" name="total_charges" required>
                            </div>
                            <div class="col-md-3">
                                <label for="source_by" class="col-form-label text-md-end">{{ __('Source By') }}</label>
                                <input type="text" id="source_by" class="form-control" name="source_by" required>
                            </div>
                            <div class="col-md-3">
                                <label for="source_name" class="col-form-label text-md-end">{{ __('Source Name') }}</label>
                                <input type="text" id="source_name" class="form-control" name="source_name">
                            </div>
                            <div class="col-md-3">
                                <label for="agreement_date" class="col-form-label text-md-end">{{ __('Agreement Date') }}</label>
                                <input type="date" id="agreement_date" class="form-control" name="agreement_date" required>
                            </div>
                            <div class="col-md-3">
                                <label for="registration_number" class="col-form-label text-md-end">{{ __('Registration Number') }}</label>
                                <input type="text" id="registration_number" class="form-control" name="registration_number" required>
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
@endsection
