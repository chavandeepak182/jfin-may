@extends('layouts.header')
@section('title', "Edit Blog")

@section('content')
<div class="dashboard-body">
    
        <!-- Breadcrumb Start -->
        <div class="d-flex justify-content-between align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 bg-transparent">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
    </nav>

    <a href="{{ route('blog.index') }}" class="btn btn-primary rounded d-flex align-items-center">
        <i class="fa fa-arrow-left me-2"></i> Back
    </a>
</div>

        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        
                
                
       
        <!-- Breadcrumb Right End -->
  

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row gy-20">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="category" class="form-label">Select Blog Category:</label>
                            <select name="pid" id="category" class="form-control" required>
                                <option value="">-- Select Blog Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->pid }}" {{ $blog->category_id == $category->pid ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="blog_name" class="form-label">Blog Name:</label>
                            <input type="text" name="blog_name" class="form-control" value="{{ $blog->blog_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Blog Description:</label>
                            <textarea name="description" id="summernote" class="form-control">{{ $blog->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Blog Image:</label>
                            @if($blog->image)
                                <div class="mb-2">
                                    <img src="{{ asset($blog->image) }}" alt="Blog Image" width="120">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug URL:</label>
                            <input type="text" name="slug" class="form-control" value="{{ $blog->slug }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Publish Date:</label>
                            <input type="date" name="publish_date" class="form-control" value="{{ $blog->publish_date }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $blog->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $blog->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag:</label>
                            <input type="text" name="tag" class="form-control" value="{{ $blog->tag }}">
                        </div>

                        <div class="mb-3">
                            <label for="author_name" class="form-label">Author Name:</label>
                            <input type="text" name="author_name" class="form-control" value="{{ $blog->author_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title:</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ $blog->meta_title }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords:</label>
                            <input type="text" name="meta_keywords" class="form-control" value="{{ $blog->meta_keywords }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description:</label>
                            <textarea name="meta_description" class="form-control">{{ $blog->meta_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="schema_markup" class="form-label">Schema Markup / Open Graph / Twitter Card:</label>
                            <textarea name="schema_markup" class="form-control" style="height:150px;">{{ $blog->schema_markup }}</textarea>
                        </div>

                         <div class="flex-align mt-20">
                            <button type="submit" class="btn btn-success rounded-pill py-9">Update Blog</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
