@extends('layouts.header')
@section('title')
    @parent
    All Users
@endsection
@section('content')
    @parent

   
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
</style>  
    <!-- <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
           
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
                </ol>
            </nav>
      <div class="row no-gutters" style="gap:10px;"> 
 
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







          


           
            <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addUserView">
                <i class="fa fa-plus"></i> Add User
            </button>
        </div>
    </div> -->
     <!-- <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addUserView">
                <i class="fa fa-plus"></i> Add User
    </button> -->
    <div class="page-header">
    <div>
      <h1 id="pageTitle">All Customers</h1>
      <p id="pageSubtitle">Manage and view all customers information.</p>
    </div>
    <div class="header-actions">
      <button class="btn-export" onclick="refreshUsers()">
        <i class="fas fa-sync-alt"></i> Refresh
      </button>
      <button class="btn-new-application">
        <i class="fas fa-user-plus"></i>
        <span id="addButtonText" data-bs-toggle="modal" href="#addUserView">Add Customer</span>
      </button>
    </div>
  </div>

  <!-- MESSAGE -->
  <div id="messageBox"></div>
    <div class="card-header py-3">
         <div class="row pt-5 pb-4">
                <div class="col-12">
                    <div class="customer-overview-grid">

 <!-- Total Customers -->
<a href="{{ route('allUsers') }}" class="overview-link">
  <div class="overview-card blue active">

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

<!-- Total Employees -->
<a href="{{ route('allAgents') }}" class="overview-link">
  <div class="overview-card green">

    <div class="overview-icon">
      <i class="fas fa-user-tie"></i>
    </div>

    <div class="overview-content">
      <h3 style="font-size:28px;">Total Employees</h3>
      <p id="totalEmployees" style="font-size:20px;">
        {{ $totalOfficers }}
      </p>
      <span class="overview-status">System Users</span>
    </div>

  </div>
</a>


<!-- Channel Partners -->
<a href="{{ route('allPartners') }}" class="overview-link">
  <div class="overview-card purple">

    <div class="overview-icon">
      <i class="fas fa-handshake"></i>
    </div>

    <div class="overview-content">
      <h3 style="font-size:25px;">Channel Partners</h3>
      <p id="totalPartners" style="font-size:20px;">
        {{ $totalCp }}
      </p>
      <span class="overview-status">Active Partners</span>
    </div>

  </div>
</a>


<!-- Active Now -->


<a href="#" class="overview-link">
  <div class="overview-card purple">

    <div class="overview-icon">
      <i class="fas fa-circle"></i>
    </div>

    <div class="overview-content">
      <h3  style="font-size:28px;">Active  customer</h3>
      <p id="totalPartners" style="font-size:20px;">10</p>
      <span class="overview-status">Live Users</span>
    </div>

  </div>
</a>


</div>

                </div>
            </div>
    </div>
    
<style>
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
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- export button -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="{{ asset('theme') }}/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <div class="row">
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
    </div> -->

<body>

<div class="users-page">

 
 

  <!-- MESSAGE -->
  <div id="messageBox"></div>

  

  <!-- SEARCH & FILTER -->
  <div class="search-filters-section">
    <div class="search-box-large">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Search users..." onkeyup="searchUsers(this.value)">
    </div>
    <div class="filter-buttons">
      <button onclick="setStatus('all')" class="filter-btn active">All</button>
      <button onclick="setStatus('active')" class="filter-btn">Active</button>
      <button onclick="setStatus('inactive')" class="filter-btn">Inactive</button>
    </div>
  </div>

<!-- TABLE -->
<div class="row mb-4">

    <div class="col-12 ">
        <div class="table-card-large">

            <!-- HEADER -->
            <div class="table-header-large d-flex align-items-center justify-content-between">
                <h3 class="mb-0">All Users</h3>
            </div>

            <!-- TABLE -->
            <div class="table-responsive table-container-large">
                <table class="table loans-table mb-0">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" class="table-checkbox">
                            </th>
                            <th>USER</th>
                            <th>Email</th>
                            <th>CONTACT</th>
                            <th>PAN NO.</th>
                            <th>STATUS</th>
                            <th width="120">ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody id="usersTable">
                        @forelse ($users as $user)
                        <tr>

                            <!-- CHECKBOX -->
                            <td>
                                <input type="checkbox" class="table-checkbox">
                            </td>

                            <!-- USER -->
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>

                                    <div class="customer-info">
                                        <div class="customer-name">
                                            <a href="javascript:void(0);"
                                               class="user-link"
                                               data-name="{{ $user->name }}"
                                               data-email="{{ $user->email_id }}"
                                               data-mobile="{{ $user->profile->mobile_no ?? '-' }}"
                                               data-pan="{{ $user->profile->pan_number ?? '-' }}"
                                               data-status="{{ $user->is_email_verify ? 'Active' : 'Inactive' }}">
                                                {{ $user->name }}
                                            </a>
                                        </div>
                                        <div class="customer-id">
                                            #{{ $user->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- EMAIL -->
                            <td>{{ $user->email_id }}</td>

                            <!-- CONTACT -->
                            <td>{{ $user->profile->mobile_no ?? '-' }}</td>

                            <!-- PAN -->
                            <td>{{ $user->profile->pan_number ?? '-' }}</td>

                            <!-- STATUS -->
                            <td>
                                <span class="status-badge {{ $user->is_email_verify ? 'active' : 'inactive' }}">
                                    {{ $user->is_email_verify ? 'Active' : 'Inactive' }}
                                </span>

                                <div class="status-radio mt-1">
                                    <label class="me-2">
                                        <input type="radio"
                                            name="status_{{ $user->id }}"
                                            {{ $user->is_email_verify ? 'checked' : '' }}
                                            onclick="updateStatus({{ $user->id }},1)">
                                        Active
                                    </label>

                                    <label>
                                        <input type="radio"
                                            name="status_{{ $user->id }}"
                                            {{ !$user->is_email_verify ? 'checked' : '' }}
                                            onclick="updateStatus({{ $user->id }},0)">
                                        Inactive
                                    </label>
                                </div>
                            </td>

                            <!-- ACTIONS -->
                            <td>
                                <div class="action-buttons d-flex align-items-center gap-2">
                                    <a href="javascript:void(0);"
   class="action-icon text-primary edit-user-btn"
   data-id="{{ $user->id }}"
   data-name="{{ $user->name }}"
   data-email="{{ $user->email_id }}"
   data-mobile="{{ $user->profile->mobile_no ?? '' }}"
   data-dob="{{ $user->profile->dob ?? '' }}"
   data-address="{{ $user->profile->address ?? '' }}"
   data-city="{{ $user->profile->city ?? '' }}"
   data-state="{{ $user->profile->state ?? '' }}"
   data-pincode="{{ $user->profile->pincode ?? '' }}"
   title="Edit">
   <i class="fas fa-edit"></i>
</a>


                                    <a href="javascript:void(0);"
                                       class="action-icon text-danger"
                                       title="Delete"
                                       onclick="deleteUser({{ $user->id }})">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <span class="action-icon text-muted">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                No users available
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

</div>
<!-- search js -->
 <script>
let currentStatus = 'all';

/* ================= SEARCH ================= */
function searchUsers(keyword) {
    keyword = keyword.toLowerCase();
    const rows = document.querySelectorAll('#usersTable tr');

    rows.forEach(row => {
        const name = row.querySelector('.customer-name')?.innerText.toLowerCase() || '';
        const email = row.children[2]?.innerText.toLowerCase() || '';

        const matchSearch = name.includes(keyword) || email.includes(keyword);
        const matchStatus = checkStatus(row);

        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
    });
}

/* ================= STATUS FILTER ================= */
function setStatus(status) {
    currentStatus = status;

    // active button highlight
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    const rows = document.querySelectorAll('#usersTable tr');

    rows.forEach(row => {
        const matchStatus = checkStatus(row);
        row.style.display = matchStatus ? '' : 'none';
    });
}

/* ================= HELPER ================= */
function checkStatus(row) {
    if (currentStatus === 'all') return true;

    const badge = row.querySelector('.status-badge');
    if (!badge) return true;

    return badge.classList.contains(currentStatus);
}
</script>

<!-- ADD / EDIT MODAL -->
<div id="userModal" class="modal">
  <div class="modal-content">
    <h3 id="modalTitle">Add User</h3>
    <input type="text" id="name" placeholder="Full Name">
    <input type="email" id="email" placeholder="Email">
    <input type="text" id="phone" placeholder="Phone">
    <select id="status">
      <option value="active">Active</option>
      <option value="inactive">Inactive</option>
    </select>
    <button onclick="saveUser()">Save</button>
    <button onclick="closeModal()">Cancel</button>
  </div>
</div>

<script src="users.js"></script>
</body>
</html>

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
                            <input type="hidden" name="user_id" id="user_id">

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
                            <button type="submit" class="btn btn-primary" id="submitBtn"> Add Customer</button>
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
           $('#addUser').on('submit', function (e) {
    e.preventDefault();

    let userId = $('#user_id').val();
    let url = userId 
        ? "{{ route('updateUser') }}" 
        : "{{ route('insertUser') }}";

    $.ajax({
        url: url,
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (res) {
            swal({
                title: res.msg,
                icon: "success"
            }).then(() => location.reload());
        },
        error: function (xhr) {
            swal("Error", "Something went wrong", "error");
        }
    });
});


// edit
$(document).on('click', '.edit-user-btn', function () {

    // modal title change (optional)
    $('.modal-header h2').text('Edit Customer');

    // 🔴 IMPORTANT: button text change
    $('#submitBtn').text('Update Customer');

    // hidden user id
    $('#user_id').val($(this).data('id'));

    // form fill (already working)
    $('#full_name').val($(this).data('name'));
    $('#email_id').val($(this).data('email'));
    $('#mobile_no').val($(this).data('mobile'));
    $('#dob').val($(this).data('dob'));
    $('#address').val($(this).data('address'));
    $('#city').val($(this).data('city'));
    $('#state').val($(this).data('state'));
    $('#pincode').val($(this).data('pincode'));

    // open modal
    $('#addUserView').modal('show');
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
