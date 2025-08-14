@extends('layouts.header')
@section('title')
@parent
JFS | Company tied up bank details
@endsection
@section('content')

@section('content')
@parent
<style>
    #wrapper #content-wrapper #content{

        background-color: #f8f9fc;
        
    }
    .topbar {
    height: 4.375rem;
    background-color:#000;
}
</style>

<!-- Breadcrumbs -->
<div class="card shadow mb-4">
    <!-- Header with Breadcrumb + Button -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('partnerDashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Loan tied up Banks</li>
                </ol>
            </nav>

            <!-- Right side buttons -->
            <div class="d-flex" style="gap: 500px;">
                <a href="{{ route('mis.index') }}"class="text-decoration-none">
                    <div class="custom-btn" style="height:50px; width:150px; 
                        background: linear-gradient(135deg, #6a11cb, #2575fc); 
                        border-radius:12px; display:flex; align-items:center; 
                        justify-content:center; color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                        <span>All MIS</span>
                    </div>
                </a>
                    <a class="btn btn-primary" data-bs-toggle="modal" href="#addBankView">
                <i class="fa fa-plus"></i> Add Bank
            </a>
        </div>
            </div>
        </div>
    </div>

    <!-- Title -->
    

    <!-- Table Section -->
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
        

        <div class="table-responsive" id="user_table">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Bank Name</th>
                        <th>IFSC</th>
                        <th>Branch Name</th>
                        <th>Manager Name</th>
                        <th>Manager Number</th>
                        <th>Bank Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['loanbanks'] as $p)
                    <tr>
                        <td>{{ $p->bank_name }}</td>
                        <td>{{ $p->ifsc_code }}</td>
                        <td>{{ $p->branch_name }}</td>
                        <td>{{ $p->manager_name }}</td>
                        <td>{{ $p->manager_number }}</td>
                        <td>{{ $p->bank_address }}</td>
                        <td>
                            <a class="btn btn-primary btn-xs edit" title="Edit" href="{{ url('editBank/'.$p->bank_id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-xs delete" title="Delete" onclick="deleteBank('{{ $p->bank_id }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Bank Name</th>
                        <th>IFSC</th>
                        <th>Branch Name</th>
                        <th>Manager Name</th>
                        <th>Manager Number</th>
                        <th>Bank Address</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

            <div class="float-right">
                {{ $data['loanbanks']->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Add Bank Modal -->
<div class="modal fade" id="addBankView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addBank" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Bank Name:</label>
                            <input type="text" class="form-control" name="bank_name" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>IFSC Code:</label>
                            <input type="text" class="form-control" name="ifsc_code" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Branch Name:</label>
                            <input type="text" class="form-control" name="branch_name" required>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-lg-4">
                            <label>Manager Name:</label>
                            <input type="text" class="form-control" name="manager_name">
                        </div>
                        <div class="for

            


   
   

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
            url:"{{Route('insertLoanBank')}}", 
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

 function deleteBank(id)
{
    $.ajax({
        url: "{{ route('deleteLoanBank') }}", // ✅ Corrected route name
        type: 'post',
        dataType: 'json',
        data: {
            'bank_id': id,
            '_token': '{{ csrf_token() }}',
        },
        success: function (response) {
            if(response.status == 0){
                swal({
                    title: response.error,
                    text: "",
                    icon: "error",
                    showConfirmButton: true
                }).then(function(){ 
                    location.reload();
                });
            } else {
                swal({
                    title: response.msg,
                    text: "",
                    icon: "success",
                    showConfirmButton: true
                }).then(function(){ 
                    location.reload();
                });
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            swal("Error!", "Something went wrong.", "error");
        }
    });      
}


</script>



@endsection