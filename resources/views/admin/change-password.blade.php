@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">
                        <i class="fas fa-key me-2"></i> Change Password
                    </h5>
                </div>

                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.update.password') }}">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-lock text-primary"></i> Current Password
                            </label>
                            <div class="input-group">
                                <input type="password" id="current_password" name="current_password" class="form-control">
                                <span class="input-group-text toggle-password" data-target="current_password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-key text-primary"></i> New Password
                            </label>
                            <div class="input-group">
                                <input type="password" id="new_password" name="new_password" class="form-control">
                                <span class="input-group-text toggle-password" data-target="new_password">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-check-circle text-primary"></i> Confirm Password
                            </label>
                            <div class="input-group">
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                                <span class="input-group-text toggle-password" data-target="new_password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('new_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary rounded-pill">
                                <i class="fas fa-save me-1"></i> Update Password
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- 👁️ Show / Hide Password Script --}}
<script>
    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endsection
