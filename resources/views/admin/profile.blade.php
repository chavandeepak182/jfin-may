@extends('layouts.header')

@section('title')
    @parent
    JFS | User Profile
@endsection

@section('content')
    @parent
    <div class="container py-5">
        <div class="row g-3 py-5">
            <div class="col-md-7 mx-auto bg-white pb-3 px-5 rounded">
                <!-- Display current avatar or default image -->
                <div class="text-center mb-5 profile-pic">
                    @if(isset($profile->avatar) && $profile->avatar)
                        <img src="{{ asset('storage/avatars/' . $profile->avatar) }}" alt="Avatar" class="img-thumbnail rounded-circle shadow-lg" style="width: 150px; height: 150px;">
                    @else
                        <img src="{{ asset('theme/frontend/img/avatar.jpg') }}" alt="Default Avatar" class="img-thumbnail rounded-circle shadow-lg" style="width: 150px; height: 150px;">
                    @endif
                </div>
                <div class="profile-txt text-center">
                    <h4 class="m-0 text-primary"><strong>{{ $user->name }}</strong></h4>
                    <p>{{ $user->email_id }}</p>
                    <p class="m-0">Mobile No.: <strong>{{ $profile->mobile_no }}</strong></p>
                    <p>Gender: <strong>{{ $profile->gender }}</strong> <span class="px-2">|</span> DOB: <strong>{{ $profile->dob }}</strong></p>
                    <p>City: <strong>{{ $profile->city }}</strong> <span class="px-2">|</span> State: <strong>{{ $profile->state }}</strong> <span class="px-2">|</span> Pincode: <strong>{{ $profile->pincode }}</strong></p>
                    <p class="mt-5"><a class="btn btn-primary rounded-pill py-2 px-2 px-md-4" data-bs-toggle="modal" data-bs-target="#editProfile"><i class="far fa-edit me-2"></i> Update</a></p>
                </div>
                <!-- <table class="table px-5">
                    <tr>
                        <th scope="row">Name:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ $user->email_id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Mobile No.:</th>
                        <td>{{ $profile->mobile_no }}</td>
                    </tr>
                    <tr>
                        <th scope="row">DOB:</th>
                        <td>{{ $profile->dob }}</td>
                    </tr>                    
                </table> -->
            </div>
            <div class="col-md-6">
                
            </div>
        </div>

        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email_id" id="email" class="form-control" value="{{ old('email_id', $user->email_id) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="mobile_no">Mobile No.</label>
                            <input type="tel" name="mobile_no" id="mobile_no" class="form-control" value="{{ old('mobile_no', $profile->mobile_no) }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="dob">DOB</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $profile->dob) }}" required />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal End -->
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        @if (session('status'))
            swal({
                title: "Success!",
                text: "{{ session('status') }}",
                icon: "success",
                button: "OK",
            });
        @endif

        $('form').on('submit', function(e) {
            var form = $(this);
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to update your profile?",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willUpdate) => {
                if (willUpdate) {
                    form.off('submit').submit(); // Submit the form
                }
            });
            e.preventDefault();
        });
    });
</script>
@endsection
