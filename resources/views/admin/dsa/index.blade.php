@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   
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
.select2-container .select2-selection--single {
    height: 38px !important;
    padding: 5px 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

.select2-container .select2-selection__rendered {
    line-height: 28px !important;
}

.select2-container .select2-selection__arrow {
    height: 38px !important;
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
    <div class="overview-card green" onclick="loadDSA()" style="cursor:pointer;">

            <div class="overview-icon">
                <i class="fas fa-user-tie"></i>
            </div>

            <div class="overview-content">
                <h3>Total DSA</h3>
                <p>{{ $totalDSA }}</p>
                <span>System DSAs</span>
            </div>

        </div>
    
   <div class="overview-card teal" onclick="loadCustomers()" style="cursor:pointer;">

        <div class="overview-icon">
            <i class="fas fa-users"></i>
        </div>

        <div class="overview-content">
            <h3>Total Customers</h3>
            <p>{{ $totalCustomers }}</p>
            <span>All DSA Users</span>
        </div>

    </div>
    <div class="overview-card" onclick="loadDsaMIS()" style="cursor:pointer; background:#6366f1; color:#fff;">
    <div class="overview-icon">
        <i class="fas fa-chart-line"></i>
    </div>
    <div class="overview-content">
        <h3>All DSA MIS</h3>
         <p>{{ $total}}</p>

        <span>DSA Leads</span>
    </div>
</div>
<div class="overview-card" onclick="loadDsaCustomerLoans()" style="cursor:pointer; background:#f59e0b; color:#fff;">
    <div class="overview-icon">
        <i class="fas fa-file-invoice"></i>
    </div>

    <div class="overview-content">
        <h3>All DSA Customer Loans</h3>
        <p>{{ $totalCustomerLoans ?? 0 }}</p>
        <span>Loan List</span>
    </div>
</div>

</div>
<!-- 🔽 CUSTOMER LIST SECTION -->
<!-- 🔽 CUSTOMER LIST SECTION -->
<div class="row mt-4" id="customerSection" style="display:none;">
    <div class="col-12">
        <div class="card p-3">

            <h5 class="mb-3">All Customers</h5>

            <!-- 🔍 SEARCH BOX (INSIDE SECTION) -->
           <div class="row mb-3">
<div class="col-md-6">
        <input type="text"
               id="dsaSearchCustomer"
               class="form-control"
               placeholder="Search by DSA Name">
    </div>
    <div class="col-md-6">
        <input type="text"
               id="customerSearch"
               class="form-control"
               placeholder="Search by Name, Email, Mobile">
    </div>

    

</div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table">

                    <thead>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>DSA Name</th>
                        <th>State</th>
                        <th>City</th>
                    </thead>

                    <tbody id="customer_table_body"></tbody>

                </table>
            </div>

        </div>
    </div>
</div>
<!-- MIS -->

<div class="row mt-4" id="dsaMisSection" style="display:none;">
    <div class="col-12">
        <div class="card p-3">

            <h5 class="mb-3">All DSA MIS</h5>

            <div id="dsa_mis_table"></div>

        </div>
    </div>
</div>

<!-- 🔽 DSA LIST SECTION -->
<div class="row mt-4" id="dsaSection">
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
                           <th>Sr No</th>
                            <th>DSA Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Pan Number</th>
                             <th>Action</th>

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

<div class="row mt-4" id="dsaCustomerLoanSection" style="display:none;">
    <div class="col-12">
        <div class="card p-3">

            <h5 class="mb-3">All DSA Customer Loans</h5>

            <!-- ✅ FILTER INSIDE -->
            <div class="row mb-3">
<div class="col-md-3">
    <select id="filterDsa" class="form-control">
        <option value="">All DSA</option>
    </select>
</div>

                <div class="col-md-3">
                    <select id="filterStatus" class="form-control">
                        <option value="">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="in process">In Process</option>
                         <option value="disbursed">Disbursed</option> <!-- ✅ ADD THIS -->
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="date" id="filterDate" class="form-control">
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary w-100" onclick="loadDsaCustomerLoans()">Search</button>
                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Loan Ref ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody id="dsa_customer_loan_body"></tbody>
                </table>
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
                        <input type="hidden" name="id" id="dsa_id">

                        <!-- EMAIL -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Email</label>
                            <input type="email" name="email_id" class="form-control" required>
                           <small class="text-danger error-email_id"></small>
                        </div>

                        <!-- PASSWORD -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <!-- MOBILE -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Mobile</label>
                            <input type="text" name="mobile_no" class="form-control" required>
                             <small class="text-danger error-mobile_no"></small>
                        </div>

                        <!-- DOB -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>Date of Birth</label>
                            <!-- DOB -->
                            <input type="date" name="dob" class="form-control" required>
                            <small class="text-danger error-dob"></small>
                        </div>

                        <!-- PAN -->
                        <div class="form-group col-lg-4 mb-3">
                            <label>PAN No</label>
                            <input type="text" name="pan_no" class="form-control" required>
                           <small class="text-danger error-pan_no"></small>
                        </div>

                        <!-- ADDRESS -->
                        <div class="form-group col-lg-12 mb-3">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
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
                            <!-- PINCODE -->
<input type="text" name="pincode" class="form-control" required>
<small class="text-danger error-pincode"></small>
                        </div>


                   

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
<script>
    let typingTimer;
let doneTypingInterval = 500;

$('input[name="mobile_no"], input[name="email_id"], input[name="pan_no"]').on('keyup', function(){

    clearTimeout(typingTimer);

    let input = $(this);

    typingTimer = setTimeout(function(){

        let field = input.attr('name');
        let value = input.val();
        let id = $('#dsa_id').val();

        // clear old error
        $('.error-' + field).text('');

        if(value.trim() === '') return;

        if(field === 'mobile_no' && value.length !== 10) return;
        
     if(field === 'pan_no'){

    value = value.toUpperCase();
    input.val(value);

    let pattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

    if(value !== '' && !pattern.test(value)){

        $('.error-pan_no').text(
            "Invalid PAN format (ABCDE1234F)"
        );

        input.addClass('is-invalid');

        return;

    } else {

        $('.error-pan_no').text('');
        input.removeClass('is-invalid');
    }
}

if(field === 'email_id'){

    let pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(value !== '' && !pattern.test(value)){

       $('.error-email_id').text(
    "Enter valid email format (example@gmail.com, example@yahoo.in, example@company.in)"
);
        input.addClass('is-invalid');

        return;

    } else {

        $('.error-email_id').text('');
        input.removeClass('is-invalid');
    }
}

        $.ajax({
            url: "/check-duplicate",
            type: "POST",
            data: {
                _token: $('input[name="_token"]').val(),
                field: field,
                value: value,
                id: id
            },
            success: function(res){

                if(res.exists){
                    $('.error-' + field).text(field + " already exists!");
                    input.addClass('is-invalid');
                } else {
                    $('.error-' + field).text('');
                    input.removeClass('is-invalid');
                }

            }
        });

    }, doneTypingInterval);
});

// ✅ PINCODE VALIDATION
$('input[name="pincode"]').on('input', function(){

    let value = this.value.replace(/[^0-9]/g, '');
    this.value = value;

    if(value.length !== 6){
        $(this).addClass('is-invalid');
        $('.error-pincode').text("Pincode must be 6 digits");
    } else {
        $(this).removeClass('is-invalid');
        $('.error-pincode').text("");
    }

});


// ✅ DOB VALIDATION (18+)
$('input[name="dob"]').on('change', function(){

    let dob = new Date(this.value);
    let today = new Date();

    let age = today.getFullYear() - dob.getFullYear();
    let m = today.getMonth() - dob.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
        age--;
    }

    if(age < 18){
        $(this).addClass('is-invalid');
        $('.error-dob').text("DOB must be 18+");
    } else {
        $(this).removeClass('is-invalid');
        $('.error-dob').text("");
    }

});
</script>
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
            $('#submitBtn').text('Save');

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

$('#addDSA').on('show.bs.modal', function () {

    // 👉 ONLY reset when ADD (no id)
    if(!$('#dsa_id').val()){
        $('#submitBtn').text('Save');
        $('#addDSAForm')[0].reset();
    }

});
</script>
<script>
    $(document).on('click', '.editBtn', function () {
        $('#submitBtn').text('Update');

    let id = $(this).data('id');

    $.ajax({
        url: "/admin/dsa/edit/" + id,
        type: "GET",
        success: function (res) {

            // basic fields
            $('#dsa_id').val(res.id);
            $('input[name="full_name"]').val(res.name);
            $('input[name="email_id"]').val(res.email_id);
            $('input[name="mobile_no"]').val(res.mobile_no);
            $('input[name="pan_no"]').val(res.pan_number);
            $('textarea[name="address"]').val(res.residence_address);
            $('input[name="dob"]').val(res.dob);

            // ✅ PINCODE FIX
            $('input[name="pincode"]').val(res.pincode);

            // ✅ STATE
            $('#state').val(res.state);

            // ✅ CITY FIX (NO setTimeout)
            $.get("/get-cities/" + res.state, function(cityRes){

                let options = '<option value="">-- Select City --</option>';

                cityRes.forEach(function(city){
                    options += `<option value="${city.id}">${city.city}</option>`;
                });

                $('#city').html(options);

                $('#city').val(res.city); // select properly
            });

            $('#addDSA').modal('show');
            // ✅ AFTER modal open
            $('#submitBtn').text('Update');
        }
    });

});
</script>
<script>
$(document).ready(function(){
    loadDSA();
});

// ✅ LOAD DSA
function loadDSA(page = 1)
{
    $('#customerSection').hide();   
    $('#dsaMisSection').hide();   
    $('#dsaCustomerLoanSection').hide(); // ✅ ADD
    $('#dsaSection').show();        

    $.get("{{ route('admin.dsa.list') }}", {
        page: page,
        search: $('#dsaSearch').val()
    }, function(res){
        $('#dsa_table_body').html(res.html);
    });
}

// ✅ LOAD CUSTOMERS
function loadCustomers()
{
    $('#dsaSection').hide();        
    $('#dsaMisSection').hide();   
    $('#dsaCustomerLoanSection').hide();
    $('#customerSection').show();   

    $.get("{{ route('admin.customers.list') }}", {
        search: $('#customerSearch').val(),
        dsa_search: $('#dsaSearchCustomer').val()
    }, function(res){
        $('#customer_table_body').html(res.html);
    });
}
// ✅ LOAD DSA MIS
function loadDsaMIS()
{
    $('#dsaSection').hide();
    $('#customerSection').hide();
    $('#dsaCustomerLoanSection').hide(); // ✅ ADD
    $('#dsaMisSection').show();

    $.get("{{ route('admin.dsa.mis.list') }}", function(res){
        $('#dsa_mis_table').html(res.html);
        $('#dsaMisCount').text(res.total);
    });
}

// ✅ LOAD DSA CUSTOMER LOANS (ONLY ONE FUNCTION)
function loadDsaCustomerLoans()
{
    $('#dsaSection').hide();
    $('#customerSection').hide();
    $('#dsaMisSection').hide();
    $('#dsaCustomerLoanSection').show();

    $.get("{{ route('admin.dsa.customer.loans') }}", {
        dsa: $('#filterDsa').val(), // ✅ NEW
        customer: $('#filterCustomer').val(),
        status: $('#filterStatus').val(),
        date: $('#filterDate').val()
    }, function(res){

        $('#dsa_customer_loan_body').html(res.html);

        // ✅ Load DSA dropdown
        if ($('#filterDsa option').length <= 1) {
            let dsaOptions = '<option value="">All DSA</option>';
            res.dsas.forEach(function(d){
                dsaOptions += `<option value="${d.id}">${d.name}</option>`;
            });
            $('#filterDsa').html(dsaOptions);
        }

        // ✅ Load customers (based on DSA)
        let custOptions = '<option value="">All Customers</option>';
        res.customers.forEach(function(c){
            custOptions += `<option value="${c.name}">${c.name}</option>`;
        });
        $('#filterCustomer').html(custOptions);
    });
}
</script>

<script>
    function loadDsaCustomerLoans()
{
    console.log("CLICK WORKING ✅");

    $('#dsaSection').hide();
    $('#customerSection').hide();
    $('#dsaMisSection').hide();
    $('#dsaCustomerLoanSection').show();

    $.get("{{ route('admin.dsa.customer.loans') }}", {
        dsa: $('#filterDsa').val(),
        status: $('#filterStatus').val(),
        date: $('#filterDate').val()
    }, function(res){

        console.log("API RESPONSE:", res);

        $('#dsa_customer_loan_body').html(res.html);

        // DSA dropdown
        if ($('#filterDsa option').length <= 1) {
            let dsaOptions = '<option value="">All DSA</option>';
            res.dsas.forEach(function(d){
                dsaOptions += `<option value="${d.id}">${d.name}</option>`;
            });
            $('#filterDsa').html(dsaOptions);
        }
    });
}
</script>
<!-- validation dsa  -->
 <script>
  
// ✅ MOBILE: only 10 digits allowed
$('input[name="mobile_no"]').on('input', function(){

    // allow numbers only
    this.value = this.value.replace(/\D/g, '');

    // restrict to max 10 digits
    if(this.value.length > 10){
        this.value = this.value.slice(0,10);
    }

    if(this.value.length != 10){
        $('.error-mobile_no').text("Mobile must be 10 digits");
        $(this).addClass('is-invalid');
    } else {
        $('.error-mobile_no').text("");
        $(this).removeClass('is-invalid');
    }

});


// ✅ PINCODE: only 6 digits allowed
$('input[name="pincode"]').on('input', function(){

    // allow numbers only
    this.value = this.value.replace(/\D/g, '');

    // restrict to max 6 digits
    if(this.value.length > 6){
        this.value = this.value.slice(0,6);
    }

    if(this.value.length != 6){
        $('.error-pincode').text("Pincode must be 6 digits");
        $(this).addClass('is-invalid');
    } else {
        $('.error-pincode').text("");
        $(this).removeClass('is-invalid');
    }

});

$(document).ready(function(){

    if ($.fn.select2) {
        $('#filterDsa').select2({
            width: '100%',
            placeholder: "Search DSA...",
            allowClear: true
        });
    }

});
 </script>
 <script>
    $(document).on('keyup', '#dsaSearch', function(){
        loadDSA();
    });
    // 🔍 CUSTOMER SEARCH
$(document).on('keyup', '#customerSearch,#dsaSearchCustomer', function(){
    loadCustomers();
});
</script>
@endsection