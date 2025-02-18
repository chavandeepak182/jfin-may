@extends('layouts.header')

@section('content')

<div class="container mt-5">
    <!-- Property Taker Details Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Property Taker Details</h3>
        </div>
        <div class="card-body">
            <!-- Property Taker Info Table -->
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="bg-light">Builder Name</th>
                    <td>{{ $propertyTaker->builder_name }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Project Name</th>
                    <td>{{ $propertyTaker->project_name }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Address</th>
                    <td>{{ $propertyTaker->address }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Property Type</th>
                    <td>{{ $propertyTaker->property_type }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Carpet Area</th>
                    <td>{{ $propertyTaker->carpet_area }} m²</td>
                </tr>
                <tr>
                    <th class="bg-light">Built-up Area</th>
                    <td>{{ $propertyTaker->builtup_area }} m²</td>
                </tr>
                <tr>
                    <th class="bg-light">Actual Agreement Cost</th>
                    <td>{{ $propertyTaker->actual_agreement_cost }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">GST</th>
                    <td>{{ $propertyTaker->gst }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">Extra Charges</th>
                    <td>{{ $propertyTaker->extra_charges ?? 'N/A' }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">Stamp Duty</th>
                    <td>{{ $propertyTaker->stamp_duty }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">Registration Fees</th>
                    <td>{{ $propertyTaker->registration_fees }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">Other Charges</th>
                    <td>{{ $propertyTaker->any_other_charges ?? 'N/A' }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">Total Charges</th>
                    <td>{{ $propertyTaker->total_charges }} ₹</td>
                </tr>
                <tr>
                    <th class="bg-light">Source By</th>
                    <td>{{ $propertyTaker->source_by }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Source Name</th>
                    <td>{{ $propertyTaker->source_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Agreement Date</th>
                    <td>{{ $propertyTaker->agreement_date->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th class="bg-light">Registration Number</th>
                    <td>{{ $propertyTaker->registration_number }}</td>
                </tr>
            </table>

            <!-- Action Buttons -->
            <div class="mt-4">
                <a href="{{ route('property_takers.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fa fa-arrow-left"></i> Back to Property Takers
                </a>
                <a href="{{ route('property_takers.edit', $propertyTaker->id) }}" class="btn btn-warning btn-lg">
                    <i class="fa fa-edit"></i> Edit Property Taker
                </a>
                <form action="#" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this property taker?')">
                        <i class="fa fa-trash"></i> Delete Property Taker
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
