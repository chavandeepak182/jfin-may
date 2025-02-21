@extends('layouts.header')

@section('content')
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">All Leads</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Details</li>
            </ol>
        </nav>
        <a href="{{ route('leads.index') }}" class="btn btn-primary float-right rounded"><i class="fa fa-arrow-left"></i> Back</a>
        <!-- Search Bar -->
        <!-- <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchLead()">
        </div> -->
    </div>
</div>
<div class="card-body bg-white shadow-sm p-4">
    <form action="{{ route('leads.update', $lead->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Full Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $lead->name) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>Email Address *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $lead->email) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>Phone Number *</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $lead->phone) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>Alternate Phone Number</label>
                <input type="text" name="alternate_phone" class="form-control" value="{{ old('alternate_phone', $lead->alternate_phone) }}">
            </div>
            <div class="form-group col-md-2">
                <label>Lead Source *</label>
                <select name="lead_source" class="form-control" required>
                    <option value="Website" {{ $lead->lead_source == 'Website' ? 'selected' : '' }}>Website</option>
                    <option value="Referral" {{ $lead->lead_source == 'Referral' ? 'selected' : '' }}>Referral</option>
                    <option value="Social Media" {{ $lead->lead_source == 'Social Media' ? 'selected' : '' }}>Social Media</option>
                    <option value="Walk-in" {{ $lead->lead_source == 'Walk-in' ? 'selected' : '' }}>Walk-in</option>
                    <option value="Call" {{ $lead->lead_source == 'Call' ? 'selected' : '' }}>Call</option>
                    <option value="Agent" {{ $lead->lead_source == 'Agent' ? 'selected' : '' }}>Agent</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Builder/Project Name</label>
                <input type="text" name="campaign_name" class="form-control" value="{{ old('campaign_name', $lead->campaign_name) }}">
            </div>
            <div class="form-group col-md-3">
                <label>Interested In *</label>
                <select name="property_type" class="form-control" required>
                    <option value="Apartment" {{ $lead->property_type == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Villa" {{ $lead->property_type == 'Villa' ? 'selected' : '' }}>Villa</option>
                    <option value="Commercial" {{ $lead->property_type == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                    <option value="Land" {{ $lead->property_type == 'Land' ? 'selected' : '' }}>Land</option>
                    <option value="Office" {{ $lead->property_type == 'Office' ? 'selected' : '' }}>Office</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Budget Range *</label>
                <div class="d-flex">
                    <input type="number" name="budget_min" class="form-control mr-2" placeholder="Min" value="{{ old('budget_min', $lead->budget_min) }}" required>
                    <input type="number" name="budget_max" class="form-control" placeholder="Max" value="{{ old('budget_max', $lead->budget_max) }}" required>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>Location Preference *</label>
                <input type="text" name="location_preference" class="form-control" value="{{ old('location_preference', $lead->location_preference) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>Possession Timeframe *</label>
                <select name="possession_time" class="form-control" required>
                    <option value="Ready To Move" {{ $lead->possession_time == 'Ready To Move' ? 'selected' : '' }}>Ready To Move</option>
                    <option value="3 Months" {{ $lead->possession_time == '3 Months' ? 'selected' : '' }}>3 Months</option>
                    <option value="6 Months" {{ $lead->possession_time == '6 Months' ? 'selected' : '' }}>6 Months</option>
                    <option value="1 Year" {{ $lead->possession_time == '1 Year' ? 'selected' : '' }}>1 Year</option>
                    <option value="Ongoing" {{ $lead->possession_time == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Property Status *</label>
                <select name="property_status" class="form-control" required>
                    <option value="New" {{ $lead->property_status == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Resale" {{ $lead->property_status == 'Resale' ? 'selected' : '' }}>Resale</option>
                    <option value="Under Construction" {{ $lead->property_status == 'Under Construction' ? 'selected' : '' }}>Under Construction</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Lead Status *</label>
                <select name="lead_status" class="form-control" required>
                    <option value="New" {{ $lead->lead_status == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Contacted" {{ $lead->lead_status == 'Contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="Interested" {{ $lead->lead_status == 'Interested' ? 'selected' : '' }}>Interested</option>
                    <option value="Not Interested" {{ $lead->lead_status == 'Not Interested' ? 'selected' : '' }}>Not Interested</option>
                    <option value="Closed" {{ $lead->lead_status == 'Closed' ? 'selected' : '' }}>Closed</option>
                    <option value="Converted" {{ $lead->lead_status == 'Converted' ? 'selected' : '' }}>Converted</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Follow-up Date</label>
                <input type="date" name="follow_up_date" class="form-control" value="{{ old('follow_up_date', $lead->follow_up_date) }}">
            </div>
            <div class="form-group col-md-3">
                <label>Available Units *</label>
                <input type="number" name="lead_score" class="form-control" value="{{ old('lead_score', $lead->lead_score) }}" required>
            </div>
            <div class="form-group col-md-3">
                <label>Assigned Agent *</label>
                <select name="assigned_to" class="form-control" required>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" {{ $lead->assigned_to == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Notes</label>
                <textarea name="notes" class="form-control">{{ old('notes', $lead->notes) }}</textarea>
            </div>
            <div class="form-group col-md-3">
                <label>Lead Type *</label>
                <select name="lead_type" class="form-control" required>
                    <option value="Buyer" {{ $lead->lead_type == 'Buyer' ? 'selected' : '' }}>Buyer</option>
                    <option value="Seller" {{ $lead->lead_type == 'Seller' ? 'selected' : '' }}>Seller</option>
                    <option value="Investor" {{ $lead->lead_type == 'Investor' ? 'selected' : '' }}>Investor</option>
                    <option value="Tenant" {{ $lead->lead_type == 'Tenant' ? 'selected' : '' }}>Tenant</option>
                    <option value="Landlord" {{ $lead->lead_type == 'Landlord' ? 'selected' : '' }}>Landlord</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Financing Status *</label>
                <select name="financing_status" class="form-control" required>
                    <option value="Pre-Approved" {{ $lead->financing_status == 'Pre-Approved' ? 'selected' : '' }}>Pre-Approved</option>
                    <option value="Loan Needed" {{ $lead->financing_status == 'Loan Needed' ? 'selected' : '' }}>Loan Needed</option>
                    <option value="Self-Financed" {{ $lead->financing_status == 'Self-Financed' ? 'selected' : '' }}>Self-Financed</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Loan Provider</label>
                <input type="text" name="loan_provider" class="form-control" value="{{ old('loan_provider', $lead->loan_provider) }}">
            </div>
            <div class="form-group col-md-3">
                <label>Expected Closing Date</label>
                <input type="date" name="closing_date" class="form-control" value="{{ old('closing_date', $lead->closing_date) }}">
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-warning rounded px-3 py-2"><strong>UPDATE LEAD</strong></button>
            </div>
        </div>        
    </form>
</div>
@endsection
