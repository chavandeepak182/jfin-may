@extends('layouts.header')
@section('title', "Manage Insights")

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb + Add Blog -->
    <div class="card-header py-3 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Manage Blog
                    </li>
                </ol>
            </nav>

            <!-- Add Blog Button -->
            <a href="{{ route('blog.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Blog
            </a>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Main Card -->
    <div class="card shadow-sm">
        <div class="card-body overflow-x-auto">

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Blog Count -->
            <p><strong>Total Blogs: {{ $blogCount }}</strong></p>

            <!-- Blog Table -->
            <table id="blogTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Blog Title</th>
                        <th>Author</th>
                        <th>Publish Date</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit(strip_tags($blog->blog_name), 70) }}</td>
                        <td>{{ $blog->author_name }}</td>
                        <td>{{ $blog->publish_date }}</td>
                        <td>
                            @if($blog->status === 'Active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Edit Button -->
                            <a href="{{ route('blog.edit', $blog->id) }}" 
                               class="btn btn-warning btn-sm me-1">
                                <i class="far fa-edit"></i>
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('blog.delete', $blog->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this blog?');">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Blog Table -->
        </div>
    </div>
</div>
@endsection
