@extends('layouts.header')
@section('title')
@parent
JFS | Commission
@endsection
@section('content')

@section('content')
@parent
<!-- Breadcrumbs -->
<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Commissions</li>
            </ol>
        </nav>

        <!-- Search Bar -->
        <!-- <div class="d-flex ms-auto">
            <input type="text" id="search" class="form-control" placeholder="Search..." onkeyup="searchUser()">
        </div> -->
    </div>
</div>

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/>

<!-- export button -->
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<div style="padding: 1%"> 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive" id="user_table">
                <table id="example" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Commission Amount</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['allCommissions'] as $p)
                        <tr>
                            <td>{{$p->com_id}}</td>   
                            <td>{{ $p->commission_amount }}</td>  
                            <td>
                                <a class="btn btn-primary btn-xs edit" title="Edit"href="{{ url('editCommission/'.$p->com_id) }}"><i class="fa fa-edit"></i></a> 
                                <button class="btn btn-danger btn-xs delete" title="Delete" data-userid="" onclick="deleteCommission('{{$p->com_id}}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                                  
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Commission Amount</th>
                            <th>Action</th> 
                        </tr>
                    </tfoot>
                </table>
                <div class="float-right"> 
                    {{ $data['allCommissions']->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="modal fade" id="addCommissionView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="user" id="addBank" method="post">
                    @csrf   
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Bank Name:</label>
                            <input type="text" class="form-control" name="bank_name" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">IFSC Code:</label>
                            <input type="text" class="form-control" name="ifsc_code" required>
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Bank Name:</label>
                            <input type="text" class="form-control"  name="bank_name" required>
                        </div>
                    </div>    

                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Branch Name:</label>
                            <input type="text" class="form-control"  name="branch_name" required>
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Manager Name:</label>
                            <input type="text" class="form-control"  name="manager_name">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Bank Address:</label>
                            <input type="text" class="form-control" id="address" name="bank_address">
                        </div>

                       
                    </div>

                    
                    
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="recipient-name" class="col-form-label">Manager Number:</label>
                            <input type="text" class="form-control" id="address" name="manager_number">
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
            


   
   

@endsection

@section('script')
@parent

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>




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
    $('#example').DataTable();
} );

</script>
<script>   
    $('#addBank').on('submit',function(e){
        e.preventDefault();
        $.ajax({               
            url:"{{Route('insertBank')}}", 
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
                        swal("Oh noes!", val[0], "error");
                    });                      
                }else if(data.status == 2){
                    document.getElementById("skill_title_error["+data.id+"]").innerHTML =data.msg;
                    // console.log(data); console.log('skill_title_error['+data.id+']');
                    // return false;
                }else{
                    $('#addBank').get(0).reset();   
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

    function deleteCommission(id)
	{
		$.ajax({
            url:"{{Route('deleteCommission')}}", 
            type: 'post',
            dataType: 'json',
            data: {
                'com_id': id,               
                '_token': '{{ csrf_token() }}',
                },
            success: function (response) {
                // console.log(response);
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



@endsection