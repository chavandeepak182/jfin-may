@extends('layouts.header')

@section('content')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="page-header-custom">
        <h2 style="color:#000;">{{ isset($config) ? 'Edit Payout Config' : 'Add Payout Config' }}</h2>

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

                <div class="form-row">

                    <!-- BANK -->
                    <div class="form-group">
                        <label>Select Bank</label>
                        <select name="bank_id">
                            @foreach($banks as $id => $name)
                                <option value="{{ $id }}" {{ (isset($config) && $config->bank_id == $id) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- CATEGORY -->
                    <div class="form-group">
                        <label>Loan Category</label>
                        <select name="loan_category_id">
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ (isset($config) && $config->loan_category_id == $id) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PERCENTAGE -->
                    <div class="form-group">
                        <label>Payout (%)</label>
                        <input type="number" step="0.01" min="0.01" name="percentage"
    value="{{ $config->percentage ?? '' }}"
    placeholder="Enter %" />
                    </div>

                    <!-- BUTTON -->
                    <div class="form-group btn-group">
                        <button type="submit">Update</button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- ✅ CSS ONLY -->
<style>
/* Header */
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
}

/* Back button */
.btn-back {
    background: #e5e7eb;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    color: #111;
}

/* Card */
.form-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* ONE ROW LAYOUT */
.form-row {
    display: flex;
    gap: 15px;
    align-items: end;
}

/* Fields */
.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 5px;
}

/* Inputs */
.form-group select,
.form-group input {
    height: 42px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 8px 12px;
}

/* Button */
.btn-group {
    flex: 0.5;
}

.btn-group button {
    height: 42px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    font-weight: 500;
    width: 100%;
}

/* Responsive */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
    }
}
</style>

@endsection