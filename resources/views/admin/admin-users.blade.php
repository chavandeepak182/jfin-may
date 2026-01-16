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
<a href="javascript:void(0)" class="overview-link">

  <div class="overview-card purple">

    <div class="overview-icon">
      <i class="fas fa-circle"></i>
    </div>

    <div class="overview-content">
      <h3 style="font-size:28px;">Active Customer</h3>
      <p style="font-size:20px;">10</p>
      <span class="overview-status">Live Users</span>
    </div>

  </div>
</a>

</div>

                </div>
            </div>
    </div>

          

    



    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card pt-3">
                <div class="card-body">
         <style>
/* ===== Top Filter Bar ===== */
.filter-bar {
    display: flex;
    gap: 12px;
    align-items: center;
    background: #fff;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
}

.filter-bar .search-box {
    flex: 1;
    position: relative;
}

.filter-bar .search-box input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 14px;
}

.filter-bar .search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

.filter-bar select {
    min-width: 160px;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    background: #f3f4f6;
    font-size: 14px;
}

.filter-bar button {
    padding: 10px 16px;
    border-radius: 8px;
}
/* FIX RADIO VISIBILITY */
input[type="radio"] {
    height: auto !important;
    width: auto !important;
    padding: 0 !important;
    margin-right: 6px;
    accent-color: #2563eb;
}

</style>

<div class="filter-bar mb-3">
    <!-- Search -->
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text"
               id="searchInput"
               placeholder="Search customers by name, email, or ID">
    </div>

    <!-- Status -->
    <select id="statusFilter">
        <option value="">All Status</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <!-- Reset -->
    <button class="btn btn-outline-secondary" id="resetFilter">
        Reset
    </button>
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
                                                        <input type="radio"
                                                            name="status_'.$user->id.'"
                                                            value="1"
                                                            onclick="updateStatus('.$user->id.', 1)"
                                                            '.($user->otp_verify == 1 ? 'checked' : '').'>
                                                        Active
                                                    </label>

                                                    <label style="margin-left:10px;">
                                                        <input type="radio"
                                                            name="status_'.$user->id.'"
                                                            value="0"
                                                            onclick="updateStatus('.$user->id.', 0)"
                                                            '.($user->otp_verify == 0 ? 'checked' : '').'>
                                                        Inactive
                                                    </label>
                                                </td>

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
                                <label for="recipient-name" class="col-form-label">Password:</label>
                               <input type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Leave blank to keep current password">
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
            $('#dob').val(res.dob);
            $('#address').val(res.address);
            $('#city').val(res.city);
            $('#state').val(res.state);
            $('#pincode').val(res.pincode);
            $('#password').val('');


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
                    console.log(xhr.responseText);
                    swal("Error", "Server error occurred", "error");
                }
            });
        }

    });
});
</script>




<script>
var currentType = 'customer';
let typingTimer = null;

/* ================= LOAD USERS ================= */
function loadUsers(page = 1) {
    $.ajax({
        url: "{{ route('load.list.by.type') }}",
        type: "GET",
        data: {
            type: currentType,
            search: $('#searchInput').val(),
            status: $('#statusFilter').val(),
            page: page
        },
        success: function (res) {
            $('#user_table_body').html(res.html);
            $('.dataTables_paginate').html(res.pagination || '');
        },
        error: function (err) {
            console.error('Load error:', err);
        }
    });
}

/* ================= SEARCH ================= */
$(document).on('keyup', '#searchInput', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => loadUsers(), 400);
});

/* ================= STATUS FILTER ================= */
$(document).on('change', '#statusFilter', function () {
    loadUsers();
});

/* ================= RESET ================= */
$(document).on('click', '#resetFilter', function () {
    $('#searchInput').val('');
    $('#statusFilter').val('');
    loadUsers();
});

/* ================= PAGINATION ================= */
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    loadUsers(page);
});

/* ================= CARD SWITCH ================= */
$(document).on('click', '.load-list', function () {
    $('.overview-link').removeClass('active');
    $(this).addClass('active');

    currentType = $(this).data('type');
    $('#user_type').val(currentType);

    $('#searchInput').val('');
    $('#statusFilter').val('');

    loadUsers();
});

/* ================= INITIAL LOAD ================= */
$(document).ready(function () {
    loadUsers();
});
</script>
<script>function updateStatus(userId, status) {
    $.ajax({
        url: "{{ route('update.user.status') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            user_id: userId,
            status: status
        },
        success: function (res) {
            if (res.status === 1) {
                swal("Success", "Status is " + (status == 1 ? "Active" : "Inactive"), "success");
            }
        }
    });
}
</script>


@endsection