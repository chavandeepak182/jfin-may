@extends('layouts.header')

@section('content')
<div class="dashboard-body">
    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="breadcrumb" style="background-color:#f8f9fc;">
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Category</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row gy-20">
                <div class="col-md-5 col-sm-5">
                    <form action="{{ route('blog.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-20">
                            <label class="h5 fw-semibold font-heading mb-0">Add Category <span class="text-13 text-gray-400 fw-medium"></span> </label>
                        </div>
                        <div class="position-relative">
                            <input type="text" name="category_name" class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Enter Category Name:">
                        </div>
                       <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold mt-3">
                            Add Category
                        </button>


                    </form>
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="mb-20">
                        <label class="h5 fw-semibold font-heading mb-0">Existing Categories</label>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->pid }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <a href="{{ route('blog.categories.edit', $category->pid) }}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <form action="{{ route('blog.categories.delete', $category->pid) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
