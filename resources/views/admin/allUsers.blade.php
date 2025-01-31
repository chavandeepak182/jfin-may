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

        <!-- Search Bar -->
        <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchUser()">
        </div>

        <!-- Add User Button -->
        <button class="btn btn-primary ms-3" data-bs-toggle="modal" href="#addUserView">
            <i class="fa fa-plus"></i> Add User
        </button>
    </div>
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<link href="{{ asset('theme') }}/dist-assets/css/sb-admin-2.min.css" rel="stylesheet">
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card pt-3">
            <div class="card-body">
                <div class="table-responsive" id="user_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Email ID </th>
                                <th> Mobile Number </th>
                                <th> DOB </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody id="user_table_body">
                            @foreach($data['allUsers'] as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email_id }}</td>
                                <td>{{ $user->mobile_no }}</td>
                                <td>{{ $user->dob }}</td>
                                <td>
                                    <label>
                                        <input type="radio" name="status_{{ $user->id }}" value="1" onclick="updateStatus({{ $user->id }}, 1)" {{ $user->is_email_verify == 1 ? 'checked' : '' }}>
                                        Active
                                    </label>
                                    <label>
                                        <input type="radio" name="status_{{ $user->id }}" value="0" onclick="updateStatus({{ $user->id }}, 0)" {{ $user->is_email_verify == 0 ? 'checked' : '' }}>
                                        Inactive
                                    </label>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-xs edit" title="Edit" href="{{ url('editUser/'.$user->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a> 
                                    <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteUser('{{ $user->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="float-right">
                        {{ $data['allUsers']->links() }}
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
                            <input type="text" class="form-control" id="state" name="state" >
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

@endsection

@section('script')
@parent

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!--export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>

$(document).ready( function () {
    new DataTable('#example', {
        info: false,
        ordering: false,
        paging: false
    });
} );

// Search functionality
function searchUser() {
    let input = document.getElementById('search').value.toLowerCase();
    let rows = document.getElementById('user_table_body').getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        let name = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
        let email = rows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
        let mobile = rows[i].getElementsByTagName('td')[3].textContent.toLowerCase();

        if (name.includes(input) || email.includes(input) || mobile.includes(input)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

</script>
<script>   
    $('#addUser').on('submit',function(e){
        e.preventDefault();
        $.ajax({               
            url:"{{Route('insertUser')}}", 
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
                }else if(data.status == 2){
                    document.getElementById("skill_title_error["+data.id+"]").innerHTML =data.msg;
                }else{
                    $('#addUser').get(0).reset();   
                    swal({
                        title: data.msg,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){
                        location.reload();
                    });
                }
            }
        });
    }); 

    function deleteUser(id) {
        $.ajax({
            url:"{{Route('deleteUser')}}", 
            type: 'post',
            dataType: 'json',
            data: {
                'user_id': id,               
                '_token': '{{ csrf_token() }}',
            },
            success: function (response) {
                if(response.status == 0){
                    swal({
                        title: response.error,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){ 
                        location.reload();
                    });
                }else{
                    swal({
                        title: response.msg,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){ 
                        location.reload();
                    });
                }                           
            }
        });      
    }
</script>
<script>
function updateStatus(userId, status) {
    $.ajax({
        url: '{{ route("updateUserStatus") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            user_id: userId,
            is_email_verify: status
        },
        success: function(response) {
            alert(response.message);
        },
        error: function(error) {
            console.log(error);
            alert('Error updating status');
        }
    });
}
</script>

@endsection
