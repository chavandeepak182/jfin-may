@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
 <style>/* ===== Overlay ===== */
.modal-overlay {
    background: rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}
.personal-details-form input::placeholder {
    color: #9ca3af;
}
input[type="password"]::placeholder {
    color: #6b7280;
    font-size: 13px;
}
.password-wrapper {
    position: relative;
}
.teal{
background: linear-gradient(135deg,#06b6d4,#0e7490);
color:#fff;
}

.teal .overview-icon i{
color:#fff;
font-size:32px;
}

.teal .overview-content h3,
.teal .overview-content p,
.teal .overview-content span{
color:#fff;
}

.password-wrapper input {
    padding-right: 40px;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6c757d;
}

.toggle-password:hover {
    color: #000;
}



/* ===== Container ===== */
.modal-container,
.modal-dialog.modal-container {
    max-width: 900px;
    width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    padding: 24px 28px 30px;
}
.modal-backdrop {
    display: none !important;
}
body.modal-open {
    overflow: auto !important;
    padding-right: 0 !important;
}
.modal-backdrop.show {
    opacity: 0 !important;
}

/* ===== Header ===== */
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: none;
    padding: 0 0 16px;
}

.modal-header h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.modal-header p {
    font-size: 13px;
    color: #6b7280;
    margin: 4px 0 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 14px;
    color: #2563eb;
    cursor: pointer;
}

/* ===== Section Titles ===== */
.personal-details-form h4,
.section-title {
    font-size: 14px;
    font-weight: 600;
    margin: 22px 0 10px;
}

/* ===== Form Layout ===== */
.personal-details-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 20px;
}

.personal-details-form .form-group {
    display: flex;
    flex-direction: column;
}

.personal-details-form .form-row {
    grid-column: span 2;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px 20px;
}

/* ===== Labels ===== */
.personal-details-form label {
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 6px;
    color: #111827;
}

/* ===== Inputs ===== */
.personal-details-form input {
    height: 42px;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    outline: none;
    transition: border 0.2s;
}

.personal-details-form input::placeholder {
    color: #9ca3af;
}

.personal-details-form input:focus {
    border-color: #3b82f6;
}

/* Full width fields */
.personal-details-form .form-group:nth-child(3),
.personal-details-form .form-group:nth-child(4),
.personal-details-form .form-group:nth-child(6),
.personal-details-form .form-group:nth-child(9) {
    grid-column: span 2;
}

/* ===== Footer ===== */
.modal-footer {
    grid-column: span 2;
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* ===== Buttons ===== */
.btn-back {
    background: transparent;
    border: none;
    color: #6b7280;
    font-size: 14px;
    cursor: pointer;
}

.btn-submit {
    background: #3b82f6;
    color: #fff;
    border: none;
    padding: 12px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    width: 100%;
}

.btn-submit:hover {
    background: #2563eb;
}

/* Remove underline & blue color from clickable cards */


.overview-link {
  text-decoration: none;
  color: inherit;
  display: block;
}

.overview-link:hover,
.overview-link:focus,
.overview-link:active {
  text-decoration: none;
  color: inherit;
}
</style>  
    
  <div class="page-header">
    <div>
      <h1 id="pageTitle">All Customers</h1>
      <p id="pageSubtitle">Manage and view all customers information.</p>
    </div>
    <div class="header-actions">
      <button class="btn-export" onclick="refreshUsers()">
        <i class="fas fa-sync-alt"></i> Refresh
      </button>
      <button type="button"
        class="btn btn-primary"
        id="openAddModal"
        data-bs-toggle="modal"
        data-bs-target="#addUserView">
    Add Customer
</button>


    </div>
  </div>

  <!-- MESSAGE -->
  <div id="messageBox"></div>
    <div class="card-header py-3">
         <div class="row pt-5 pb-4">
                <div class="col-12">
<div class="customer-overview-grid">

<!-- ================= TOTAL CUSTOMERS ================= -->
<a href="javascript:void(0)"
   class="overview-link load-list active"
   data-type="customer">

  <div class="overview-card blue">

    <div class="overview-icon">
      <i class="fas fa-users"></i>
    </div>

    <div class="overview-content">
      <h3 style="font-size:28px;">Total Customers</h3>
      <p id="totalCustomers">{{ $totalCustomers }}</p>
      <span class="overview-status">Tracked from Records</span>
    </div>

  </div>
</a>

<!-- ================= TOTAL EMPLOYEES ================= -->
<a href="javascript:void(0)"
   class="overview-link load-list"
   data-type="agent">

  <div class="overview-card green">

    <div class="overview-icon">
      <i class="fas fa-user-tie"></i>
    </div>

    <div class="overview-content">
      <h3 style="font-size:28px;">Total Employees</h3>
      <p id="totalEmployees" style="font-size:20px;">
        {{ $totalEmployees}}
      </p>
      <span class="overview-status">System Users</span>
    </div>

  </div>
</a>

<!-- ================= CHANNEL PARTNERS ================= -->
<a href="javascript:void(0)"
   class="overview-link load-list"
   data-type="cp">

  <div class="overview-card purple">

    <div class="overview-icon">
      <i class="fas fa-handshake"></i>
    </div>

    <div class="overview-content">
      <h3 style="font-size:25px;">Channel Partners</h3>
      <p id="totalPartners" style="font-size:20px;">
        {{ $totalChannelPartners }}
      </p>
      <span class="overview-status">Active Partners</span>
    </div>

  </div>
</a>

<!-- ================= ACTIVE USERS (OPTIONAL) ================= -->
<!-- <a href="javascript:void(0)"
   class="overview-link load-list"
   data-type="active">

<div class="overview-card purple">

<div class="overview-icon">
<i class="fas fa-circle"></i>
</div>

<div class="overview-content">
<h3 style="font-size:28px;">Active Customer</h3>

<p style="font-size:20px;">
{{ $activeCustomers }}
</p>

<span class="overview-status">Active Loan Users</span>

</div>
</div>
</a> -->
<a href="javascript:void(0)"
   class="overview-link load-list"
   data-type="active">

<div class="overview-card teal">

<div class="overview-icon">
<i class="fas fa-user-check"></i>
</div>

<div class="overview-content">
<h3 style="font-size:28px;">Active Customer</h3>

<p style="font-size:20px;">
{{ $activeCustomers }}
</p>

<span class="overview-status">Active Loan Users</span>

</div>
</div>
</a>

<!-- ================= OUR CUSTOMERS ================= -->
<!-- <a href="javascript:void(0)"
   class="overview-link load-list"
   data-type="our">

<div class="overview-card blue">

<div class="overview-icon">
<i class="fas fa-user-check"></i>
</div>

<div class="overview-content">
<h3 style="font-size:28px;">Our Customers</h3>

<p style="font-size:20px;">
{{ $ourCustomers }}
</p>

<span class="overview-status">Disbursed Loan Customers</span>

</div>
</div>
</a> -->

</div>

                </div>
            </div>
    </div>

          

    



    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card pt-3">
                <div class="card-body">
                    <!-- 🔍 SEARCH BAR -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text"
                            id="userSearch"
                            class="form-control"
                            placeholder="Search by Name or Mobile">
                    </div>
                </div>
                    <div class="table-responsive" id="user_table_container">
                        <table id="user_table" class="table">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Email ID </th>
                                    <th> Mobile Number </th>
                                    <th> Pan No. </th>
                                    <!-- <th> Status </th> -->
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody id="user_table_body">
                                
                               @foreach ($users as $user)
<tr>
    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                        <td><a href="javascript:void(0);" 
                                        class="user-link" 
                                        data-name="{{ $user->name }}" 
                                        data-email="{{ $user->email_id }}" 
                                        data-mobile="{{ $user->mobile_no ?? '-' }}" 
                                        data-dob="{{ $user->profile->pan_number ?? '-' }}" 
                                        > {{ $user->name }}
                                        </a>

                                        </td>
                                        <td>{{ $user->email_id }}</td>
<td>{{ $user->profile->mobile_no ?? $user->mobile_no ?? '-' }}</td>
                                        <td>{{ $user->profile->pan_number ?? ''}}</td>
                                        <!-- <td>
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
                                        </td> -->
                                        <td>
                                           <button type="button"
                                                    class="btn btn-primary btn-xs edit-user"
                                                    data-id="{{ $user->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>


                                            <button type="button"
                                                class="btn btn-danger btn-xs delete-user"
                                                data-id="{{ $user->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-warning btn-xs reset-password"
                                            data-id="{{ $user->id }}">
                                        <i class="fa fa-key"></i>
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
                              <input type="hidden" id="user_id" name="user_id">

                            <div class="form-group col-lg-4">
    <label class="col-form-label">Password:</label>

    <div class="password-wrapper">
        <input type="password"
               class="form-control"
               id="password"
               name="password"
               placeholder="Leave blank to keep existing password">

        <span class="toggle-password" onclick="togglePassword()">
            <i class="fa fa-eye" id="eyeIcon"></i>
        </span>
    </div>

    <small class="text-muted">
        Leave blank to keep existing password
    </small>
</div>

                        </div>
                        <input type="hidden" id="user_type" name="user_type" value="customer">


                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Mobile Number:</label>
                                <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Date of Birth:</label>
                                <input type="date"
       class="form-control"
       id="dob"
       name="dob"
       max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}">

                            </div>

                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Address:</label>
                                <input type="tel" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label class="col-form-label">State</label>
                                <select class="form-control" id="state" name="state" required>
                                    <option value="">-- Select State --</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="col-form-label">City</label>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="">-- Select City --</option>
                                </select>
                            </div>


                            <div class="form-group col-lg-4">
                                <label for="recipient-name" class="col-form-label">Pincode:</label>
                                <input type="text" class="form-control" id="pincode" name="pincode">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                            <button type="submit"
                                    class="btn btn-primary"
                                    id="submitUserBtn">
                                Save
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  <div class="modal fade" id="resetPasswordModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Reset Password</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="resetPasswordForm">
          @csrf

          <input type="hidden" id="reset_user_id">

          <div class="mb-3">
    <label>New Password</label>

    <div class="input-group">
        <input type="password"
               class="form-control"
               id="new_password"
               placeholder="Enter new password"
               required
               minlength="6">

        <span class="input-group-text"
              style="cursor:pointer"
              id="toggleNewPassword">
            <i class="fa fa-eye"></i>
        </span>
    </div>
</div>


          <button type="submit" class="btn btn-primary">
            Update Password
          </button>
        </form>
      </div>

    </div>
  </div>
</div>



@endsection

@section('script')
    @parent
    


<script>
$(document).on('click', '.edit-user', function () {

    let userId = $(this).data('id');

    $.ajax({
        url: "{{ route('getUserById') }}",
        type: "GET",
        data: { id: userId },
        success: function (res) {

            $('#user_id').val(res.id);
            $('#full_name').val(res.name);
            $('#email_id').val(res.email_id);
            $('#mobile_no').val(res.mobile_no);
             $('#password').val(res.password);
            $('#dob').val(res.dob);
            $('#address').val(res.address);
           // ✅ SET STATE FIRST
    $('#state').val(res.state);

    // ✅ LOAD CITY & SELECT IT
    loadCities(res.state, res.city);
            $('#pincode').val(res.pincode);

            $('#submitUserBtn').text('Update');

            // 🔥 Update modal title based on active card
            if (currentType === 'agent') {
                $('#exampleModalLabel').text('Edit Agent');
            } else if (currentType === 'cp') {
                $('#exampleModalLabel').text('Edit Channel Partner');
            } else {
                $('#exampleModalLabel').text('Edit Customer');
            }

            $('#addUserView').modal('show');
        }
    });
});
</script>

<script>
$(document).off('submit', '#addUser').on('submit', '#addUser', function (e) {
    e.preventDefault();

    if ($('#submitUserBtn').prop('disabled')) return;

    let formData = new FormData(this);
    let userId = $('#user_id').val();
    let url = userId
        ? "{{ route('updateUser') }}"
        : "{{ route('insertUser') }}";

    $('#submitUserBtn').prop('disabled', true);

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        success: function (res) {
            if (res.status === 1) {
                swal("Success", res.msg, "success").then(() => {
                    $('#addUserView').modal('hide');
                    $('#addUser')[0].reset();
                    $('#user_id').val('');
                    $('#submitUserBtn').text('Save').prop('disabled', false);

                    // reload current list
                    $.ajax({
                        url: "{{ route('load.list.by.type') }}",
                        type: "GET",
                        data: { type: currentType },
success: function (res) {
    $('#user_table_body').html(res.html);
    $('.dataTables_paginate nav').html(res.pagination); // refresh pagination
}
                    });
                });
            } else {
                $('#submitUserBtn').prop('disabled', false);
                swal("Error", "Something went wrong", "error");
            }
        },

        error: function (xhr) {
            $('#submitUserBtn').prop('disabled', false);

            if (xhr.status === 422) {
                let msg = '';
                $.each(xhr.responseJSON.errors, function (k, v) {
                    msg += v[0] + '\n';
                });
                swal("Validation Error", msg, "error");
            } else {
                swal("Error", "Server error occurred", "error");
            }
        }
    });
});
</script>


<script>
$(document).on('click', '.delete-user', function () {

    let userId = $(this).data('id');

    swal({
        title: "Are you sure?",
        text: "This user will be deleted permanently.",
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
                    user_id: userId
                },
                dataType: "json",
                success: function (res) {
                    if (res.status === 1) {
                        swal("Deleted!", res.msg, "success")
                            .then(() => location.reload());
                    } else {
                        swal("Error", res.error ?? "Delete failed", "error");
                    }
                },
               error: function (xhr) {

    // clear old errors
    $('.text-danger').text('');

    if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;

        if (errors.dob) {
            $('#dob_error').text(errors.dob[0]);
        }

        if (errors.full_name) {
            $('#full_name').after('<small class="text-danger">'+errors.full_name[0]+'</small>');
        }

        if (errors.email_id) {
            $('#email_id').after('<small class="text-danger">'+errors.email_id[0]+'</small>');
        }

        if (errors.mobile_no) {
            $('#mobile_no').after('<small class="text-danger">'+errors.mobile_no[0]+'</small>');
        }
    }
}

            });
        }

    });
});
</script>
<script>


   $(document).on('click', '.load-list', function () {

    $('.overview-link').removeClass('active');
    $(this).addClass('active');

    let type = $(this).data('type');
    currentType = type;

    $('#user_type').val(type);

    if (type === 'customer') {
        $('#openAddModal').text('Add Customer');
        $('#exampleModalLabel').text('Add New Customer');
    } 
    else if (type === 'agent') {
        $('#openAddModal').text('Add Employee');
        $('#exampleModalLabel').text('Add New Agent');
    } 
    else if (type === 'cp') {
        $('#openAddModal').text('Add Channel Partner');
        $('#exampleModalLabel').text('Add New Channel Partner');
    }
    else if (type === 'active') {
    $('#openAddModal').text('Active Customers');
    $('#exampleModalLabel').text('Active Customers');
}

    $.ajax({
        url: "{{ route('load.list.by.type') }}",
        type: "GET",
        data: { 
            type: type,
            page: 1 // 🔥 reset page when switching list
        },
        success: function (res) {

            $('#user_table_body').html(res.html);

            // 🔥 THIS FIXES THE ISSUE
            $('.dataTables_paginate nav').html(res.pagination);

        }
    });

});
</script>

<script>
let currentType = 'customer'; // default
</script>
<script>
function isAbove18(dob) {
    let today = new Date();
    let birthDate = new Date(dob);

    let age = today.getFullYear() - birthDate.getFullYear();
    let monthDiff = today.getMonth() - birthDate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    return age >= 18;
}

$(document).on('submit', '#addUser', function (e) {

    let dob = $('#dob').val();

    if (dob) {
        if (!isAbove18(dob)) {
            e.preventDefault();
            swal("Validation Error", "User must be at least 18 years old.", "error");
            return false;
        }
    }
});
</script>
<script>
    function updateStatus(userId, status)
{
    $.ajax({
        url: "{{ route('admin.update.employee.status') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            user_id: userId,
            status: status
        },
        success: function(res){

            swal("Success", "Employee status changed successfully", "success")
            .then(() => {

                // reload employee list
                $.ajax({
                    url: "{{ route('load.list.by.type') }}",
                    type: "GET",
                    data: {
                        type: 'agent'
                    },
                    success: function(res){
                        $('#user_table_body').html(res.html);
                        $('.dataTables_paginate nav').html(res.pagination);
                    }
                });

            });

        },
        error: function(){
            swal("Error", "Status update failed", "error");
        }
    });
}
</script>
<script>
    $(document).on('click', '.reset-password', function () {
    let userId = $(this).data('id');

    $('#reset_user_id').val(userId);
    $('#new_password').val('');

    $('#resetPasswordModal').modal('show');
});
$('#resetPasswordForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('admin.reset.password') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            user_id: $('#reset_user_id').val(),
            password: $('#new_password').val()
        },
        success: function (res) {
            swal("Success", res.msg, "success");
            $('#resetPasswordModal').modal('hide');
        },
        error: function () {
            swal("Error", "Password reset failed", "error");
        }
    });
});
$('#toggleNewPassword').on('click', function () {

    let input = $('#new_password');
    let icon  = $(this).find('i');

    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        input.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
});


</script>
<script>$('#state').on('change', function () {

    let stateId = $(this).val();
    $('#city').html('<option value="">Loading...</option>');

    if (!stateId) {
        $('#city').html('<option value="">-- Select City --</option>');
        return;
    }

    $.ajax({
        url: '/get-cities/' + stateId,
        type: 'GET',
        success: function (cities) {

            let options = '<option value="">-- Select City --</option>';

            cities.forEach(function (city) {
                options += `<option value="${city.id}">
                                ${city.city}
                            </option>`;
            });

            $('#city').html(options);
        }
    });
});
</script>
<script>function loadCities(stateId, selectedCity = null) {

    $('#city').html('<option value="">Loading...</option>');

    $.ajax({
        url: '/get-cities/' + stateId,
        type: 'GET',
        success: function (cities) {

            let options = '<option value="">-- Select City --</option>';

            cities.forEach(function (city) {
                options += `<option value="${city.id}">
                                ${city.city}
                            </option>`;
            });

            $('#city').html(options);

            // ✅ Select city on edit
            if (selectedCity) {
                $('#city').val(selectedCity);
            }
        }
    });
}
</script>
<script>
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

  <!-- serach bar -->
   <script>
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();

    let page = new URL($(this).attr('href')).searchParams.get('page');

    $.ajax({
        url: "{{ route('load.list.by.type') }}",
        type: "GET",
        data: {
            type: currentType,
            search: $('#userSearch').val(),
            page: page
        },
        success: function (res) {
            $('#user_table_body').html(res.html);
            $('.dataTables_paginate nav').html(res.pagination);
        }
    });
});
</script>
<script>
let searchTimer = null;

// 🔍 LIVE SEARCH
$(document).on('keyup', '#userSearch', function () {
    clearTimeout(searchTimer);

    searchTimer = setTimeout(function () {
        $.ajax({
            url: "{{ route('load.list.by.type') }}",
            type: "GET",
            data: {
                type: currentType,
                search: $('#userSearch').val()
            },
            success: function (res) {
                $('#user_table_body').html(res.html);
                $('.dataTables_paginate nav').html(res.pagination);
            }
        });
    }, 300); // debounce
});
</script>
<script>

function updateStatus(userId, status)
{
    $.ajax({
        url: "{{ route('admin.update.employee.status') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            user_id: userId,
            status: status
        },
        success: function(res){

            let label = "User";

            if(currentType === 'customer'){
                label = "Customer";
            }
            else if(currentType === 'agent'){
                label = "Employee";
            }
            else if(currentType === 'cp'){
                label = "Channel Partner";
            }

            swal("Success", label + " status updated successfully", "success")
            .then(() => location.reload());

        }
    });
}

</script>

@endsection