@extends('layouts.header')
@section('title')
    @parent
    All Users
@endsection
@section('content')
    @parent

   
    <!-- Breadcrumbs and Search Bar -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
                </ol>
            </nav>
      <div class="row no-gutters" style="gap:10px;"> 
    <!-- All Employee -->
    <div class="col-auto">
        <a href="{{ route('allAgents') }}"  style="text-decoration: none;">
            <div class="custom-btn" style="height:50px; width:150px; 
                        background: linear-gradient(135deg, #6a11cb, #2575fc); 
                        border-radius:12px; 
                        display:flex; align-items:center; justify-content:center;
                        color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                <span>All Employee</span>
            </div>
        </a>
    </div>

    <!-- All Channel Partner -->
    <div class="col-auto">
        <a href="{{ route('allPartners') }}"  style="text-decoration: none;">
            <div class="custom-btn" style="height:50px; width:160px; 
                        background: linear-gradient(135deg, #ff512f, #dd2476); 
                        border-radius:12px; 
                        display:flex; align-items:center; justify-content:center;
                        color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                <span>All Channel Partner</span>
            </div>
        </a>
    </div>
</div>

<!-- Hover Effect -->





          


            <!-- Add User Button -->
            <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addUserView">
                <i class="fa fa-plus"></i> Add User
            </button>
        </div>
    </div>

    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- export button -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="{{ asset('theme') }}/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card pt-3">
                <div class="card-body">
                    <div class="table-responsive" id="user_table_container">
                        <table id="user_table" class="table">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Email ID </th>
                                    <th> Mobile Number </th>
                                    <th> Pan No. </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="user_table_body">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><a href="javascript:void(0);" 
                                        class="user-link" 
                                        data-name="{{ $user->name }}" 
                                        data-email="{{ $user->email_id }}" 
                                        data-mobile="{{ $user->profile->mobile_no ?? '-' }}" 
                                        data-dob="{{ $user->profile->pan_number ?? '-' }}" 
                                        data-status="{{ $user->is_email_verify == 1 ? 'Active' : 'Inactive' }}"> {{ $user->name }}
                                        </a>

                                        </td>
                                        <td>{{ $user->email_id }}</td>
                                        <td>{{ $user->profile->mobile_no ?? '-' }}</td>
                                        <td>{{ $user->profile->pan_number ?? ''}}</td>
                                        <td>
                                            <label>
                                                <input type="radio" name="status_{{ $user->id }}" value="1"
                                                    onclick="updateStatus({{ $user->id }}, 1)"
                                                    {{ $user->is_email_verify == 1 ? 'checked' : '' }}>
                                                Active
                                            </label>
                                            <label>
                                                <input type="radio" name="status_{{ $user->id }}" value="0"
                                                    onclick="updateStatus({{ $user->id }}, 0)"
                                                    {{ $user->is_email_verify == 0 ? 'checked' : '' }}>
                                                Inactive
                                            </label>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-xs edit" title="Edit"
                                                href="{{ url('editUser/' . $user->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-xs delete" title="Delete"
                                                onclick="deleteUser('{{ $user->id }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="dataTables_info">
                                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
                                entries
                            </div>
                            <div class="dataTables_paginate paging_simple_numbers">
                                <nav>
                                    {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="user" id="addUser" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Email ID:</label>
                                <input type="email" class="form-control" id="email_id" name="email_id" required>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Mobile Number:</label>
                                <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Address:</label>
                                <input type="tel" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">City:</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">State:</label>
                                <input type="text" class="form-control" id="state" name="state">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Pincode:</label>
                                <input type="text" class="form-control" id="pincode" name="pincode">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">User Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Name:</strong> <span id="detail_name">-</span></p>
        <p><strong>Email:</strong> <span id="detail_email">-</span></p>
        <p><strong>Mobile:</strong> <span id="detail_mobile">-</span></p>
        <p><strong>Pan Number</strong> <span id="detail_dob">-</span></p>
        <p><strong>Status:</strong> <span id="detail_status">-</span></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
    @parent

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons Extension -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#user_table').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                info: false,
                ordering: true,
                paging: false,
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });

            // Search functionality
            $('#search').on('keyup', function() {
                let input = this.value.toLowerCase();
                $('#user_table_body tr').each(function() {
                    let name = $(this).find('td:nth-child(2)').text().toLowerCase();
                    let email = $(this).find('td:nth-child(3)').text().toLowerCase();
                    let mobile = $(this).find('td:nth-child(4)').text().toLowerCase();
                    $(this).toggle(name.includes(input) || email.includes(input) || mobile.includes(
                        input));
                });
            });

            // Add User Form Submission
            $('#addUser').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('insertUser') }}",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        } else if (data.status == 2) {
                            $("#skill_title_error[" + data.id + "]").text(data.msg);
                        } else {
                            $('#addUser')[0].reset();
                            swal({
                                title: data.msg,
                                icon: "success",
                            }).then(() => location.reload());
                        }
                    }
                });
            });

            // Delete User Function
            window.deleteUser = function(id) {
                swal({
                    title: "Are you sure?",
                    text: "Do you really want to delete this user? This action cannot be undone.",
                    icon: "warning",
                    buttons: ["Cancel", "Yes, Delete"],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('deleteUser') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                user_id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                swal({
                                    title: response.msg,
                                    icon: response.status == 0 ? "error" :
                                        "success",
                                }).then(() => location.reload());
                            },
                            error: function() {
                                swal("Error", "Something went wrong! Please try again.",
                                    "error");
                            }
                        });
                    }
                });
            };

            // Update User Status
            window.updateStatus = function(userId, status) {
                $.ajax({
                    url: "{{ route('updateUserStatus') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: userId,
                        is_email_verify: status
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Error updating status");
                    }
                });
            };
        });
    </script>
    <script>
document.querySelectorAll('.user-link').forEach(link => {
    link.addEventListener('click', function() {
        document.getElementById('detail_name').innerText   = this.dataset.name || '-';
        document.getElementById('detail_email').innerText  = this.dataset.email || '-';
        document.getElementById('detail_mobile').innerText = this.dataset.mobile || '-';
        document.getElementById('detail_dob').innerText    = this.dataset.pan_number || '-';
        document.getElementById('detail_status').innerText = this.dataset.status || '-';

        var modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
        modal.show();
    });
});

</script>

@endsection
