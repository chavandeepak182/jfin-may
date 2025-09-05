@extends('layouts.header')

@section('content')
<div class="dashboard-body">
    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-with-buttons mb-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="breadcrumb" style="background-color:#f8f9fc;"
>
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('blog.categories.index') }}">All catrgories</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add catrgories</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary d-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
    <!-- Breadcrumb End -->

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row gy-20">
                <div class="col-md-5 col-sm-5">
                    <form action="{{ route('blog.categories.update', $category->pid) }}" method="POST">
                        @csrf
                        <div class="mb-20">
                            <label class="h5 fw-semibold font-heading mb-0">
                                Edit Category 
                            </label>
                        </div>
                        <div class="position-relative">
                            <input type="text" name="category_name" 
                                   class="form-control" 
                                   value="{{ $category->category_name }}" required>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                           <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold mt-3">
                                Update Category
                            </button>

                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
