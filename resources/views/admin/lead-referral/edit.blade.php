@extends('layouts.header')

@section('title','Edit Lead Referral')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header">
            <h4>Edit Lead Referral</h4>
        </div>

        <div class="card-body">

           <form action="{{ route('admin.lead-referral.update',$user->id) }}" method="POST">
    @csrf
  

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name',$user->name) }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email_id"
                               class="form-control"
                               value="{{ old('email_id',$user->email_id) }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Mobile</label>
                        <input type="text"
                               name="mobile_no"
                               class="form-control"
                               value="{{ old('mobile_no',$user->mobile_no) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Referral Code</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $user->referral_code }}"
                               readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan_number"
                               class="form-control"
                               value="{{ old('pan_number',$user->pan_number) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Pincode</label>
                        <input type="text"
                               name="pincode"
                               class="form-control"
                               value="{{ old('pincode',$user->pincode) }}">
                    </div>

                    <div class="col-md-12 mt-3">

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Update
                        </button>

                        <a href="{{ route('admin.lead-referral.index') }}"
                           class="btn btn-secondary">
                            Back
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection