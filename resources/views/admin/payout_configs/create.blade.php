@extends('layouts.header')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="page-header-custom">
        <h2>{{ isset($config) ? 'Edit Payout Config' : 'Add Payout Config' }}</h2>

        <a href="{{ route('payout-configs.index') }}" class="btn-back">
            ← Back
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="card form-card">
        <div class="card-body">

            <form method="POST" action="{{ isset($config) ? route('payout-configs.update', $config->id) : route('payout-configs.store') }}">
                @csrf
                @if(isset($config)) @method('PUT') @endif

                <div class="row align-items-end g-3">

                    <!-- BANK -->
                    <div class="col-md-3">
                        <label>Select Bank</label>
                      <select name="bank_id" class="form-control">

                            <option value="">-- Select Bank --</option>

                            @foreach($banks as $id => $name)
                                <option value="{{ $id }}"
                                    {{ (isset($config) && $config->bank_id == $id) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- CATEGORY -->
                    <div class="col-md-3">
                        <label>Loan Category</label>
                        <select name="loan_category_id" class="form-control">

    <option value="">-- Select Category --</option>

    @foreach($categories as $id => $name)
        <option value="{{ $id }}"
            {{ (isset($config) && $config->loan_category_id == $id) ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach

</select>
                    </div>

                    <!-- PERCENTAGE -->
                    <div class="col-md-3">
    <label>Payout (%)</label>

    <input type="number"
           step="0.01"
           min="0.01"
           name="percentage"
           class="form-control"
           value="{{ $config->percentage ?? '' }}"
           placeholder="Enter %"
           required />

    <small class="text-danger error-percentage"></small>
</div>

                    <!-- SAVE BUTTON -->
                    <div class="col-md-3 text-end">
                        <button type="submit" class="btn-save w-100">
                            Save
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- ✅ CSS -->
<style>
.page-header-custom {
    background: #f1f5f9;
    padding: 18px 22px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.page-header-custom h2 {
    margin: 0;
    font-weight: 600;
    color: #1e293b;
}

/* Back button */
.btn-back {
    background: #e5e7eb;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    color: #111827;
    font-weight: 500;
}

/* Card */
.form-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* Labels */
label {
    font-weight: 500;
    margin-bottom: 5px;
}

/* Inputs */
.form-control {
    height: 42px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.1);
}

/* Save button */
.btn-save {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    height: 42px;
    border-radius: 8px;
    border: none;
    font-weight: 500;
}

.btn-save:hover {
    opacity: 0.9;
}
</style>

@endsection