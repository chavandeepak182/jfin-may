@extends('layouts.header')

@section('content')
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">All Leads</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Lead</li>
            </ol>
        </nav>
        <a href="{{ route('leads.index') }}" class="btn btn-primary float-right rounded"><i class="fa fa-arrow-left"></i> Back</a>
        <!-- Search Bar -->
        <!-- <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchLead()">
        </div> -->
    </div>
</div>
<div class="card-body bg-white shadow-sm p-5">
    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Alternate Phone Number</label>
                    <input type="text" name="alternate_phone" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Lead Source *</label>
                    <select name="lead_source" class="form-control" required>
                        <option value="Website">Website</option>
                        <option value="Referral">Referral</option>
                        <option value="Social Media">Social Media</option>
                        <option value="Walk-in">Walk-in</option>
                        <option value="Call">Call</option>
                        <option value="Agent">Agent</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Builder/Project Name</label>
                    <input type="text" name="campaign_name" class="form-control">
                </div>
            </div><div class="col-md-3">
                <div class="form-group">
                    <label>Interested In *</label>
                    <select name="property_type" class="form-control" required>
                        <option value="Apartment">Apartment</option>
                        <option value="Villa">Villa</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Land">Land</option>
                        <option value="Office">Office</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Budget Range *</label>
                    <div class="d-flex">
                        <input type="number" name="budget_min" class="form-control mr-2" placeholder="Min" required>
                        <input type="number" name="budget_max" class="form-control" placeholder="Max" required>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Location Preference *</label>
                    <input type="text" name="location_preference" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Possession Timeframe *</label>
                    <select name="possession_time" class="form-control" required>
                        <option value="Ready To Move">Ready To Move</option>
                        <option value="3 Months">3 Months</option>
                        <option value="6 Months">6 Months</option>
                        <option value="1 Year">1 Year</option>
                        <option value="Ongoing">Ongoing</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Property Status *</label>
                    <select name="property_status" class="form-control" required>
                        <option value="New">New</option>
                        <option value="Resale">Resale</option>
                        <option value="Under Construction">Under Construction</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Lead Status *</label>
                    <select name="lead_status" class="form-control" required>
                        <option value="New">New</option>
                        <option value="Contacted">Contacted</option>
                        <option value="Interested">Interested</option>
                        <option value="Not Interested">Not Interested</option>
                        <option value="Closed">Closed</option>
                        <option value="Converted">Converted</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Assigned Agent *</label>
                    <select name="assigned_to" class="form-control" required>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Follow-up Date</label>
                    <input type="date" name="follow_up_date" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Expected Closing Date</label>
                    <input type="date" name="closing_date" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Available Units *</label>
                    <input type="number" name="lead_score" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Lead Type *</label>
                    <select name="lead_type" class="form-control" required>
                        <option value="Buyer">Buyer</option>
                        <option value="Seller">Seller</option>
                        <option value="Investor">Investor</option>
                        <option value="Tenant">Tenant</option>
                        <option value="Landlord">Landlord</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Financing Status *</label>
                    <select name="financing_status" class="form-control" required>
                        <option value="Pre-Approved">Pre-Approved</option>
                        <option value="Loan Needed">Loan Needed</option>
                        <option value="Self-Financed">Self-Financed</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Loan Provider</label>
                    <input type="text" name="loan_provider" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success rounded px-3 py-2"><strong>SAVE LEAD</strong></button>
            </div>
        </div>
    </form>
</div>
@endsection
