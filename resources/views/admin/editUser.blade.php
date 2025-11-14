@extends('layouts.header')
@section('title')
@parent
JFS | User Management
@endsection
@section('content')
@parent
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('allUsers') }}">All Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>

 <!-- Custom styles for this page -->
 <link href="{{ asset('theme') }}/dist-assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 <h1><center>User Management</center></h1>    
            <div class="col-xl-12 col-lg-12">

    <div class="d-flex justify-content-center flex-nowrap card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>

        <div class="card-body mb-12">
            <form class="user" id="editUserView" method="post">
                @csrf 

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('error') }}
                    </div>
                @endif

                @foreach($data['user'] as $u)
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="{{ $u->name }}" class="form-control" required/>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Email ID</label>
                        <input type="text" name="email_id" value="{{ $u->email_id }}" class="form-control" required/>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_no" value="{{ $u->mobile_no }}" class="form-control" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="{{ $u->dob }}" class="form-control" required/>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $u->residence_address }}" class="form-control" required/>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>City</label>
                        <input type="text" name="city" value="{{ $u->city }}" class="form-control" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>State</label>
                        <input type="text" name="state" value="{{ $u->state }}" class="form-control" required/>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Pin Code</label>
                        <input type="text" name="pincode" value="{{ $u->pincode }}" class="form-control" required/>
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{ $u->id }}"/>
                @endforeach

                <div class="modal-footer">
                    <a class="btn btn-secondary" href="/admin/allUsers">Cancel</a>
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>

</div>



@endsection

@section('script')
@parent

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>   
    $('#editUserView').on('submit',function(e){
        e.preventDefault();
        $.ajax({               
            url:"{{Route('updateUser')}}", 
            method:"POST",                             
            data:new FormData(this) ,
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){              
                if(data.status == 0){
                    $.each(data.error,function(prefix,val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });                      
                }else{
                    swal({
                        title: data.msg,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){
                        window.location.href = "/admin/allUsers";
                    });
                        
                }
            }
        });
    }); 
 </script>


<!-- Page level plugins -->
<script src="{{ asset('theme') }}/dist-assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('theme') }}/dist-assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('theme') }}/dist-assets/js/demo/datatables-demo.js"></script>


@endsection