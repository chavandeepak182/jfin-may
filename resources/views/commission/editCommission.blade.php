@extends('layouts.header')
@section('title')
    @parent
    JFS | Update Commission Information
@endsection
@section('content')
@parent

<style>
    #img-preview {
  display: none;
  width: 470px;
  margin-bottom: 20px;
  border-radius: 2%;
  padding: 1%;
}
#img-preview img {
  width: 100%;
  height: auto;
  display: block;
}
</style>
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('allCommission') }}">List of Commission</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Update Commission Details</li>
    </ol>
</nav>
 
<!-- Begin Page Content -->
<div class="container-fluid">

    <form id="editCommission">
        @csrf

        <!-- Title -->
        <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
            <h2 class="h5 mb-3 mb-lg-0">Commission Details</h2>

            <div class="hstack gap-3">

                <!-- ✅ Cancel FIX -->
                <a href="{{ route('allCommission') }}" class="btn btn-light btn-sm btn-icon-text">
                    Cancel
                </a>

                <!-- ✅ Update -->
                <button type="submit" class="btn btn-primary btn-sm btn-icon-text">
                    Update
                </button>

            </div>
        </div>

        <!-- ✅ Hidden Inputs -->
        <input type="hidden" name="creator_id" value="{{ Session::get('user_id') }}">
        <input type="hidden" name="com_id" value="{{ $data['commission']->com_id }}">

        <!-- Main content -->
        <div class="card mb-4">
            <div class="card-body">

                <h3 class="h6 mb-4">Commission Information</h3>

                <div class="mb-3">
                    <label class="form-label">Commission Amount</label>
                    <input type="text"
                           name="commission_amount"
                           class="form-control"
                           value="{{ $data['commission']->commission_amount }}">
                </div>

            </div>
        </div>

    </form>

</div>           

            
@endsection
@section('script')
@parent

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>   
   $('#editCommission').on('submit', function(e){
    e.preventDefault();

    $.ajax({
        url: "{{ route('updateCommission') }}",
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: 'json',

        beforeSend: function(){
            $('span.error-text').text('');
        },

        success: function(data){

            // ✅ SUCCESS
            if(data.status == 1){
                swal({
                    title: data.msg,
                    icon: "success"
                }).then(function(){
                    window.location.href = "/admin/allCommission";
                });
            }

            // ❌ VALIDATION / SERVER ERROR
            else{
                swal("Error", data.msg, "error");
            }
        },

        // 🔴 VERY IMPORTANT (to catch 500 error)
        error: function(xhr){

            console.log("Full Error:", xhr);

            let errorMsg = "Something went wrong!";

            // try to get real message
            if(xhr.responseJSON && xhr.responseJSON.msg){
                errorMsg = xhr.responseJSON.msg;
            } else if(xhr.responseText){
                errorMsg = xhr.responseText;
            }

            swal("Error", errorMsg, "error");
        }
    });
});
 </script>

@endsection
