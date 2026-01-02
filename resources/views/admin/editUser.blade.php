@include('layouts.header')

<h1 class="text-center mb-4">User Management</h1>

<!-- ================= EDIT USER FORM (CUSTOM UI) ================= -->
<div class="modal-overlay" style="display:block;">
  <div class="modal">

    <!-- Header -->
    <div class="modal-header">
      <h2>Edit Customer</h2>
      <p>Update customer information</p>
      <a href="{{ url('/admin/customers') }}" class="modal-close">&times;</a>
    </div>

    <!-- Body -->
    <div class="modal-body">

      <form id="editUserView" class="personal-details-form" autocomplete="off">
        @csrf

        @foreach($data['user'] as $u)

        <!-- Name -->
        <div class="form-group">
          <label>Name</label>
          <input
            type="text"
            name="full_name"
            value="{{ $u->name }}"
            placeholder="Enter full name"
          />
          <span class="text-danger full_name_error"></span>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label>Email ID</label>
          <input
            type="email"
            name="email_id"
            value="{{ $u->email_id }}"
            placeholder="Enter email ID"
          />
          <span class="text-danger email_id_error"></span>
        </div>

        <!-- Mobile -->
        <div class="form-group">
          <label>Mobile Number</label>
          <input
            type="text"
            name="mobile_no"
            value="{{ $u->mobile_no }}"
            placeholder="Enter mobile number"
          />
          <span class="text-danger mobile_no_error"></span>
        </div>

        <!-- DOB -->
        <div class="form-group">
          <label>Date of Birth</label>
          <input
            type="date"
            name="dob"
            value="{{ $u->dob }}"
            class="form-input date-input"
          />
          <span class="text-danger dob_error"></span>
        </div>

        <!-- Address -->
        <div class="form-group">
          <label>Address</label>
          <input
            type="text"
            name="address"
            value="{{ $u->residence_address }}"
            placeholder="Enter address"
          />
          <span class="text-danger address_error"></span>
        </div>

        <!-- City & State -->
        <div class="form-row">
          <div class="form-group">
            <label>City</label>
            <input
              type="text"
              name="city"
              value="{{ $u->city }}"
              placeholder="Enter city"
            />
            <span class="text-danger city_error"></span>
          </div>

          <div class="form-group">
            <label>State</label>
            <input
              type="text"
              name="state"
              value="{{ $u->state }}"
              placeholder="Enter state"
            />
            <span class="text-danger state_error"></span>
          </div>
        </div>

        <!-- Pincode -->
        <div class="form-group">
          <label>Pincode</label>
          <input
            type="text"
            name="pincode"
            value="{{ $u->pincode }}"
            placeholder="Enter pincode"
          />
          <span class="text-danger pincode_error"></span>
        </div>

        <input type="hidden" name="user_id" value="{{ $u->id }}">

        @endforeach

        <!-- Footer -->
        <div class="modal-footer">
          <a href="{{ url('/admin/customers') }}" class="btn-back">
            Cancel
          </a>

          <button type="submit" class="btn-submit">
            Update Customer
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$('#editUserView').on('submit', function (e) {
    e.preventDefault();

    $('.text-danger').text('');

    $.ajax({
        url: "{{ route('updateUser') }}",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (res) {

            if (res.status === 0) {
                $.each(res.error, function (key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }

            if (res.status === 1) {
                swal({
                    title: res.msg,
                    icon: "success"
                }).then(() => {
                    window.location.href = "/admin/customers";
                });
            }
        },
        error: function () {
            swal("Error", "Something went wrong", "error");
        }
    });
});
</script>