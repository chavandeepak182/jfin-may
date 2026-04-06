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
        <h1>All DSA</h1>
        <p>Manage and view all DSA information.</p>
    </div>

    <div class="header-actions">
        <button class="btn-export" onclick="loadDSA()">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>

        <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#addDSA">
            Add DSA
        </button>
    </div>
</div>
<div class="customer-overview-grid">

    <!-- TOTAL DSA -->
    <a href="javascript:void(0)" class="overview-link active">
        <div class="overview-card green">

            <div class="overview-icon">
                <i class="fas fa-user-tie"></i>
            </div>

            <div class="overview-content">
                <h3>Total DSA</h3>
                <p>{{ $totalDSA }}</p>
                <span>System DSAs</span>
            </div>

        </div>
    </a>

</div>

<!-- 🔽 DSA LIST SECTION -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card p-3">

            <!-- SEARCH -->
            <div class="mb-3">
                <input type="text"
                       id="dsaSearch"
                       class="form-control"
                       placeholder="Search by Name or Mobile">
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Pincode</th>
                        </tr>
                    </thead>

                    <tbody id="dsa_table_body"></tbody>

                </table>

                <!-- PAGINATION -->
                <div class="pagination-area mt-3"></div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addDSA">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Add New DSA</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <form id="addDSAForm">
                    @csrf

                    <div class="row">

                        <!-- NAME -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email_id" class="form-control" required>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- MOBILE -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Mobile</label>
                            <input type="text" name="mobile_no" class="form-control" required>
                        </div>

                        <!-- STATE -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>State</label>
                            <select name="state" id="state" class="form-control" required>
                                <option value="">-- Select State --</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- CITY -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>City</label>
                            <select name="city" id="city" class="form-control" required>
                                <option value="">-- Select City --</option>
                            </select>
                        </div>

                        <!-- PINCODE -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Pincode</label>
                            <input type="text" name="pincode" class="form-control" required>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
<script>

// 🔥 STATE → CITY LOAD
$('#state').change(function(){

    let stateId = $(this).val();

    if(!stateId){
        $('#city').html('<option value="">-- Select City --</option>');
        return;
    }

    $.get("/get-cities/" + stateId, function(res){

        let options = '<option value="">-- Select City --</option>';

        res.forEach(function(city){
            options += `<option value="${city.id}">${city.city}</option>`;
        });

        $('#city').html(options);
    });

});

// SAVE DSA
$('#addDSAForm').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "{{ route('admin.dsa.store') }}",
        type: "POST",
        data: $(this).serialize(),

        success: function(res){

            if(res.status == 1){

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.msg,
                    confirmButtonText: 'OK'
                });

                $('#addDSA').modal('hide');
                $('#addDSAForm')[0].reset();

                loadDSA();
            }
        },

        error: function(err){

            let errors = err.responseJSON.errors;
            let msg = "";

            $.each(errors, function(key, value){
                msg += value[0] + "\n";
            });

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: msg
            });
        }
    });
});

</script>
<script>
    $(document).ready(function(){
    loadDSA();
});

function loadDSA(page = 1)
{
    $.get("{{ route('admin.dsa.list') }}", {
        page: page,
        search: $('#dsaSearch').val()
    }, function(res){

        console.log(res);

        $('#dsa_table_body').html(res.html);
        $('.pagination-area').html(res.pagination);
    });
}

// SEARCH
$('#dsaSearch').keyup(function(){
    loadDSA();
});

// PAGINATION
$(document).on('click', '.pagination a', function(e){
    e.preventDefault();
    let page = new URL($(this).attr('href')).searchParams.get('page');
    loadDSA(page);
});
</script>
@endsection