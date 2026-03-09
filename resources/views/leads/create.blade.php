@extends('layouts.header')

@section('content')
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">All Leads</a></li>
                <li class="breadcrumb-item active">Add New Lead</li>
            </ol>
        </nav>
        <a href="{{ route('admin.listlead') }}" class="btn btn-primary rounded">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="card-body bg-white shadow-sm p-5">
<form action="{{ route('leads.store') }}" method="POST">
@csrf

<div class="row">

{{-- FULL NAME --}}
<div class="col-md-3">
    <label>Full Name *</label>
    <input type="text" name="name"
           value="{{ old('name') }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- EMAIL --}}
<div class="col-md-3">
    <label>Email Address *</label>
    <input type="email" name="email"
           value="{{ old('email') }}"
           class="form-control @error('email') is-invalid @enderror" required>
    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- PHONE --}}
<div class="col-md-3">
    <label>Phone Number *</label>
    <input type="text" name="phone"
           maxlength="10"
           value="{{ old('phone') }}"
           class="form-control @error('phone') is-invalid @enderror" required>
    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- ALT PHONE --}}
<div class="col-md-3">
    <label>Alternate Phone Number</label>
    <input type="text" name="alternate_phone"
           maxlength="10"
           value="{{ old('alternate_phone') }}"
           class="form-control @error('alternate_phone') is-invalid @enderror">
    @error('alternate_phone') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- LEAD SOURCE --}}
<div class="col-md-2">
    <label>Lead Source *</label>
    <select name="lead_source"
            class="form-control @error('lead_source') is-invalid @enderror" required>
        <option value="">Select</option>
        @foreach(['Website','Referral','Social Media','Walk-in','Call','Agent'] as $src)
            <option value="{{ $src }}" {{ old('lead_source')==$src?'selected':'' }}>{{ $src }}</option>
        @endforeach
    </select>
    @error('lead_source') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- PROJECT --}}
<div class="col-md-3">
    <label>Builder / Project Name</label>
    <input type="text" name="campaign_name"
           value="{{ old('campaign_name') }}"
           class="form-control">
</div>

{{-- PROPERTY TYPE --}}
<div class="col-md-3">
    <label>Interested In *</label>
    <select name="property_type" class="form-control" required>
        @foreach(['Apartment','Villa','Commercial','Land','Office'] as $type)
            <option value="{{ $type }}" {{ old('property_type')==$type?'selected':'' }}>{{ $type }}</option>
        @endforeach
    </select>
</div>

{{-- BUDGET --}}
<div class="col-md-4">
    <label>Budget Range *</label>
    <div class="d-flex gap-2">
        <input type="number" name="budget_min"
               value="{{ old('budget_min') }}"
               class="form-control" placeholder="Min" required>
        <input type="number" name="budget_max"
               value="{{ old('budget_max') }}"
               class="form-control" placeholder="Max" required>
    </div>
    @error('budget_min') <small class="text-danger d-block">{{ $message }}</small> @enderror
    @error('budget_max') <small class="text-danger d-block">{{ $message }}</small> @enderror
</div>

{{-- LOCATION --}}
<div class="col-md-3">
    <label>Location Preference *</label>
    <input type="text" name="location_preference"
           value="{{ old('location_preference') }}"
           class="form-control" required>
    @error('location_preference') <small class="text-danger">{{ $message }}</small> @enderror
</div>

{{-- POSSESSION --}}
<div class="col-md-3">
    <label>Possession Timeframe *</label>
    <select name="possession_time" class="form-control" required>
        @foreach(['Ready To Move','3 Months','6 Months','1 Year','Ongoing'] as $p)
            <option value="{{ $p }}" {{ old('possession_time')==$p?'selected':'' }}>{{ $p }}</option>
        @endforeach
    </select>
</div>

{{-- PROPERTY STATUS --}}
<div class="col-md-3">
    <label>Property Status *</label>
    <select name="property_status" class="form-control" required>
        @foreach(['New','Resale','Under Construction'] as $ps)
            <option value="{{ $ps }}" {{ old('property_status')==$ps?'selected':'' }}>{{ $ps }}</option>
        @endforeach
    </select>
</div>

{{-- LEAD STATUS --}}
<div class="col-md-3">
    <label>Lead Status *</label>
    <select name="lead_status" class="form-control" required>
        @foreach(['New','Contacted','Interested','Not Interested','Closed','Converted'] as $ls)
            <option value="{{ $ls }}" {{ old('lead_status')==$ls?'selected':'' }}>{{ $ls }}</option>
        @endforeach
    </select>
</div>

{{-- ASSIGNED --}}
<div class="col-md-3">
    <label>Assigned Employee *</label>
    <select name="assigned_to" class="form-control" required>
        @foreach($agents as $agent)
            <option value="{{ $agent->id }}" {{ old('assigned_to')==$agent->id?'selected':'' }}>
                {{ $agent->name }}
            </option>
        @endforeach
    </select>
</div>

{{-- DATES --}}
<div class="col-md-3">
    <label>Follow-up Date</label>
    <input type="date" name="follow_up_date"
           value="{{ old('follow_up_date') }}" class="form-control">
</div>

<div class="col-md-3">
    <label>Expected Closing Date</label>
    <input type="date" name="closing_date"
           value="{{ old('closing_date') }}" class="form-control">
</div>

{{-- SCORE --}}
<div class="col-md-3">
    <label>Available Units *</label>
    <input type="number" name="lead_score"
           value="{{ old('lead_score') }}"
           class="form-control" required>
</div>

{{-- NOTES --}}
<div class="col-md-12">
    <label>Notes</label>
    <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
</div>

{{-- TYPE --}}
<div class="col-md-4">
    <label>Lead Type *</label>
    <select name="lead_type" class="form-control" required>
        @foreach(['Buyer','Seller','Investor','Tenant','Landlord'] as $lt)
            <option value="{{ $lt }}" {{ old('lead_type')==$lt?'selected':'' }}>{{ $lt }}</option>
        @endforeach
    </select>
</div>

{{-- FINANCE --}}
<div class="col-md-4">
    <label>Financing Status *</label>
    <select name="financing_status" class="form-control" required>
        @foreach(['Pre-Approved','Loan Needed','Self-Financed'] as $fs)
            <option value="{{ $fs }}" {{ old('financing_status')==$fs?'selected':'' }}>{{ $fs }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    <label>Loan Provider</label>
    <input type="text" name="loan_provider"
           value="{{ old('loan_provider') }}" class="form-control">
</div>

<div class="col-md-3 mt-3">
    <button type="submit" class="btn btn-success px-4 py-2">
        <strong>SAVE LEAD</strong>
    </button>
</div>

</div>
</form>
</div>

{{-- ONLY DIGITS JS --}}
<script>
document.querySelectorAll('input[name="phone"], input[name="alternate_phone"]').forEach(input => {
    input.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>

@endsection
