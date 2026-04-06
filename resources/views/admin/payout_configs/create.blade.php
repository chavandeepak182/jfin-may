@extends('layouts.header')

@section('content')
<form method="POST" action="{{ isset($config) ? route('payout-configs.update', $config->id) : route('payout-configs.store') }}">
    @csrf
    @if(isset($config)) @method('PUT') @endif

    <select name="bank_id">
        @foreach($banks as $id => $name)
            <option value="{{ $id }}" {{ (isset($config) && $config->bank_id == $id) ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    <select name="loan_category_id">
        @foreach($categories as $id => $name)
            <option value="{{ $id }}" {{ (isset($config) && $config->loan_category_id == $id) ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    <input type="number" step="0.01" name="percentage"
        value="{{ $config->percentage ?? '' }}" placeholder="Enter %" />

    <button type="submit">Save</button>
</form>
@endsection