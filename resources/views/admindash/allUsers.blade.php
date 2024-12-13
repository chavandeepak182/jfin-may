@extends('admindash.header')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Users</h4>
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" href="#addUserView">
                                <i class="fa fa-plus"></i> Add User
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped align-middle" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['allUsers'] as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email_id }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ $user->dob }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary edit" title="Edit" href="{{ url('editUser/'.$user->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger delete" title="Delete" onclick="deleteUser('{{ $user->id }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile Number</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mt-3">
                        {{ $data['allUsers']->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserView" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insertUser') }}" method="POST" id="addUserForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_id" name="email_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_no" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Notifications -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
    });
</script>
@endif

@endsection
