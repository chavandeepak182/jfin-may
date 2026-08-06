@extends('layouts.header')

@section('content')

<div class="container mt-5">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fa fa-home"></i> BHK Master
            </h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('bhk.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-8">

                        <input type="text"
                               name="bhk_name"
                               class="form-control"
                               placeholder="Enter BHK Name">

                    </div>

                    <div class="col-md-4">

                        <button class="btn btn-primary w-100">
                            <i class="fa fa-plus"></i> Add BHK
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">BHK List</h5>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-primary">

                <tr>

                    <th width="70">ID</th>

                    <th>BHK Name</th>

                    <th width="250">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($bhks as $bhk)

                    <tr>

                        <td>{{ $bhk->id }}</td>

                        <td>

                            <form action="{{ route('bhk.update') }}"
                                  method="POST"
                                  class="d-flex">

                                @csrf

                                <input type="hidden"
                                       name="id"
                                       value="{{ $bhk->id }}">

                                <input type="text"
                                       name="bhk_name"
                                       value="{{ $bhk->bhk_name }}"
                                       class="form-control me-2">

                                <button class="btn btn-success">

                                    <i class="fa fa-edit"></i>

                                </button>

                            </form>

                        </td>

                        <td>

                            <form action="{{ route('bhk.delete') }}"
                                  method="POST"
                                  class="delete-form">

                                @csrf

                                <input type="hidden"
                                       name="id"
                                       value="{{ $bhk->id }}">

                                <button type="submit"
                                        class="btn btn-danger">

                                    <i class="fa fa-trash"></i> Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" class="text-center">

                            No Record Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@if(session('success'))
<script>
Swal.fire({
    icon:'success',
    title:'Success',
    text:'{{ session("success") }}',
    timer:2000,
    showConfirmButton:false
});
</script>
@endif

<script>

document.querySelectorAll('.delete-form').forEach(function(form){

    form.addEventListener('submit',function(e){

        e.preventDefault();

        Swal.fire({

            title:'Delete BHK?',

            text:'This record will be permanently deleted.',

            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#d33',

            cancelButtonColor:'#3085d6',

            confirmButtonText:'Yes, Delete'

        }).then((result)=>{

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>
<style>
    .card{
    border-radius:12px;
}

.card-header{
    border-radius:12px 12px 0 0 !important;
}

.table td,
.table th{
    vertical-align:middle;
}

.btn{
    border-radius:8px;
}

.form-control{
    border-radius:8px;
}
</style>

@endsection