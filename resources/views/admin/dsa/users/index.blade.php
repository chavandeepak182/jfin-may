@extends('layouts.header')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h4>My Customers</h4>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomer">
            + Add Customer
        </button>
    </div>

    <input type="text" id="search" class="form-control mb-3" placeholder="Search...">

    <div class="card p-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                     <th>State Name</th>
                      <th>City Name</th>
                       <th>Action</th>
                </tr>
            </thead>

            <tbody id="userTable"></tbody>
        </table>
    </div>

</div>

<!-- MODAL -->
<!-- MODAL -->
<div class="modal fade" id="addCustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-4">

            <h5 class="mb-3">Add Customer</h5>

           <form id="addForm" novalidate>
                @csrf

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Email</label>
                       <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile_no" class="form-control" required maxlength="10" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>State</label>
                       <select name="state" id="state" class="form-control">
                            <option value="">Select State</option>

                            @foreach($states as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach

                        </select>
                    </div>
                     <input type="hidden" name="id" id="customer_id">
                    <div class="col-md-4 mb-3">
                        <label>City</label>
                       <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Pincode</label>
                        <input type="text" name="pincode" class="form-control" required maxlength="6">
                    </div>

                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="submitBtn">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
<script>

function loadUsers()
{
    $.get("{{ route('dsa.users.list') }}", {
        search: $('#search').val()
    }, function(res){
        $('#userTable').html(res.html);
    });
}

$(document).ready(function(){
    loadUsers();
});

$('#search').keyup(function(){
    loadUsers();
});


$.get("{{ route('dsa.users.list') }}", {
    search: $('#search').val()
}, function(res){
    console.log(res); // 🔥 ADD THIS
    $('#userTable').html(res.html || '');
});

</script>
<script>
// EDIT CLICK
$(document).on('click', '.editBtn', function () {

    let id = $(this).data('id');

    $('#submitBtn').text('Update'); // button change

    $.ajax({
        url: "/dsa/customer/edit/" + id,
        type: "GET",
        success: function (res) {

            // 🔥 fill data
            $('#customer_id').val(res.id);
            $('input[name="name"]').val(res.name);
            $('input[name="email"]').val(res.email);
            $('input[name="mobile_no"]').val(res.mobile_no);
            $('input[name="pincode"]').val(res.pincode);
            $('input[name="dob"]').val(res.dob);
            $('input[name="address"]').val(res.address);

            $('#state').val(res.state_id).trigger('change');

            // 🔥 load city + select
            $.get("/get-cities?state_id=" + res.state_id, function(cityRes){

                let options = '<option value="">Select City</option>';

                cityRes.forEach(function(city){
                    options += `<option value="${city.id}">${city.city}</option>`;
                });

                $('#city').html(options);

                setTimeout(function(){
                    $('#city').val(res.city_id);
                }, 200);
            });

            // 🔥 THIS WAS MISSING
            $('#addCustomer').modal('show');

        }
    });

});
</script>
<script>$('#state').change(function(){

    let stateId = $(this).val();

    if(!stateId){
        $('#city').html('<option value="">Select City</option>');
        return;
    }

    $.get("/get-cities/" + stateId, function(cityRes){

        let options = '<option value="">Select City</option>';

        cityRes.forEach(function(city){
            options += `<option value="${city.id}">${city.city}</option>`;
        });

        $('#city').html(options);
    });

});

</script>


<script>
  $('#addForm').submit(function(e){
    e.preventDefault();

    let dobVal = $('input[name="dob"]').val();

    if(dobVal){
        let dob = new Date(dobVal);
        let today = new Date();

        let age = today.getFullYear() - dob.getFullYear();
        let m = today.getMonth() - dob.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if(age < 18){
            Swal.fire({
                icon: 'error',
                title: 'Invalid DOB',
                text: 'Age must be 18+'
            });
            return; // 🔥 STOP
        }
    }

    // ✅ AJAX RUN ONLY IF VALID
    $.ajax({
    url: "{{ route('dsa.save.customer') }}",
    type: "POST",
    data: $(this).serialize(),

    success: function(res){
        if(res.status == 1){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'DSA Customer saved successfully!'
            });

            $('#addCustomer').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

            $('#addForm')[0].reset();
            loadUsers();
        }
    },

    error: function(xhr){

        let errors = xhr.responseJSON.errors;

        // remove old errors
        $('.error-text').remove();

        // show errors below fields
        $.each(errors, function(key, value){

            let input = $('[name="'+key+'"]');

            input.after('<span class="text-danger error-text">'+value[0]+'</span>');
        });

    }
});
});
</script>
<!-- validation -->
 <script>
    // 🔥 MOBILE VALIDATION
$('input[name="mobile_no"]').on('input', function(){
    this.value = this.value.replace(/[^0-9]/g, '');

    if(this.value.length != 10){
        this.setCustomValidity("Enter 10 digit mobile number");
    } else {
        this.setCustomValidity("");
    }
});

// 🔥 PINCODE VALIDATION
$('input[name="pincode"]').on('input', function(){
    this.value = this.value.replace(/[^0-9]/g, '');

    if(this.value.length != 6){
        this.setCustomValidity("Enter 6 digit pincode");
    } else {
        this.setCustomValidity("");
    }
});

// 🔥 EMAIL VALIDATION
$('input[name="email"]').on('input', function(){
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!pattern.test(this.value)){
        this.setCustomValidity("Invalid email");
    } else {
        this.setCustomValidity("");
    }
});
 </script>

@endsection