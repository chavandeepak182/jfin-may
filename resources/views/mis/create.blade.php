@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New MIS Record') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('mis.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-end">{{ __('Email') }}</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="contact" class="col-form-label text-md-end">{{ __('Contact') }}</label>
                                <input type="text" id="contact" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required>

                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="office_contact" class="col-form-label text-md-end">{{ __('Office Contact') }}</label>
                                <input type="text" id="office_contact" class="form-control @error('office_contact') is-invalid @enderror" name="office_contact" value="{{ old('office_contact') }}" required>

                                @error('office_contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="product_type" class="col-form-label text-md-end">{{ __('Product Type') }}</label>
                                <select id="product_type" class="form-control @error('product_type') is-invalid @enderror" name="product_type" required>
                                    <option value="">Select Product Type</option>
                                    @foreach($loanCategories as $category)
                                        <option value="{{ $category->loan_category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>

                                @error('product_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="occupation" class="col-form-label text-md-end">{{ __('Occupation') }}</label>
                                <select id="occupation" class="form-control @error('occupation') is-invalid @enderror" name="occupation" required>
                                    <option value="">Select Occupation</option>
                                    <option value="Salaried" {{ old('occupation', $misRecord->occupation ?? '') == 'Salaried' ? 'selected' : '' }}>Salaried</option>
                                    <option value="Self Employed" {{ old('occupation', $misRecord->occupation ?? '') == 'Self Employed' ? 'selected' : '' }}>Self Employed</option>
                                </select>

                                @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="bank_name" class="col-form-label text-md-end">{{ __('Bank Name') }}</label>
                                <select id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" required>
                                    <option value="">Select Bank Name</option>
                                    @foreach($bankNames as $bank)
                                        <option value="{{ $bank->bank_id }}">{{ $bank->bank_name }}</option>
                                    @endforeach
                                </select>

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="branch_name" class="col-form-label text-md-end">{{ __('Branch Name') }}</label>
                                <input type="text" id="branch_name" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ old('branch_name') }}" required>

                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="amount" class="col-form-label text-md-end">{{ __('Amount') }}</label>
                                <input type="number" id="amount" step="0.01" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="city" class="col-form-label text-md-end">{{ __('City') }}</label>
                                <input type="text" id="city" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="address" class="col-form-label text-md-end">{{ __('Address') }}</label>
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3" required>{{ old('address') }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="office_address" class="col-form-label text-md-end">{{ __('Office Address') }}</label>
                                <textarea id="office_address" class="form-control @error('office_address') is-invalid @enderror" name="office_address" rows="3" required>{{ old('office_address') }}</textarea>

                                @error('office_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Record') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
