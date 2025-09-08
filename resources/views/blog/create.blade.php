@extends('layouts.header')
@section('title', "Add Blog")

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="breadcrumb" style="background-color:#f8f9fc;">
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Add Blog</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <!-- End Breadcrumb -->

    <!-- Add Blog Card -->
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Add Blog</h5>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Left Section -->
                    <div class="col-lg-8">
                       <div class="mb-3">
                            <label class="form-label fw-semibold">Select Blog Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Blog Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->pid }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-semibold">Blog Title</label>
                            <input type="text" name="blog_name" class="form-control" placeholder="Enter blog title" required>
                        </div>

                        <div class="mb-3">
        <label for="summernote" class="form-label">Description</label>
        <textarea id="summernote" name="description"></textarea>
    </div>
                    </div>

                    <!-- Right Section -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Blog Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug URL</label>
                            <input type="text" name="slug" class="form-control" placeholder="unique-blog-url" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Publish Date</label>
                            <input type="date" name="publish_date" class="form-control" required>
                        </div>

                      <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Select Status --</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>


                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tag</label>
                            <input type="text" name="tag" class="form-control" placeholder="e.g. study abroad, career" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Author Name</label>
                            <input type="text" name="author_name" class="form-control" required>
                        </div>

                        <!-- SEO Fields -->

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Schema Markup / Open Graph / Twitter Card</label>
                            <textarea name="schema_markup" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">
                                <i class="fa fa-plus"></i> Add Blog
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Add Blog Card -->
</div>
@endsection

@push('styles')
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      placeholder: 'Write blog content here...',
      height: 250
    });
  });
</script>
@endpush

