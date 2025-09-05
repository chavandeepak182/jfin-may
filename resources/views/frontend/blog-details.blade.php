@extends('frontend.layouts.header')

@section('title', $blog->blog_name)
@section('description', Str::limit(strip_tags($blog->description), 160))
@section('keywords', $blog->blog_name)

@section('content')

<!-- Hero Section -->
<section class="hero-wrap position-relative">
    <div class="blog-featured-image" style="background-image: url('{{ asset($blog->image) }}'); height: 400px; background-size: cover; background-position: center;"></div>
    <div class="blog-featured-image-overlay position-absolute w-100 h-100" style="top:0; left:0; background-color: rgba(0,0,0,0.4);"></div>

    <div class="container hero-content position-absolute top-50 start-50 translate-middle text-white">
        <div class="row">
            <div class="col-lg-9">
                <!-- Breadcrumb -->
                

                <!-- Title + Short Description -->
                <!-- <h1 class="hero-title display-5 fw-bold">{{ $blog->blog_name }}</h1> -->
                <!-- <p class="hero-sub lead">
                    {{ Str::limit(strip_tags($blog->description), 120, '...') }}
                </p> -->
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<div class="container py-5">
    <div class="row">
        <!-- Main Blog -->
        <div class="col-lg-8">
            <img src="{{ asset($blog->image) }}" alt="{{ $blog->blog_name }}" class="img-fluid rounded mb-4 shadow-sm">

            <h2 class="mb-3 fw-bold">{{ $blog->blog_name }}</h2>

            <!-- Blog Meta -->
            <p class="text-muted small mb-4">
                Published on {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
                <span class="mx-2">|</span>
                Category: <strong>{{ $blog->category_name }}</strong>
            </p>

            <!-- Full Description -->
            <div class="blog-description fs-5 lh-lg">
                {!! $blog->description !!}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="p-3 bg-light rounded shadow-sm">
                <h5 class="mb-3 fw-bold">Latest Blogs</h5>
                @foreach($latestBlogs as $latest)
                    <div class="d-flex mb-3">
                        <a href="{{ route('blogs.show', $latest->id) }}" class="me-2 flex-shrink-0">
                            <img src="{{ asset($latest->image) }}" alt="{{ $latest->blog_name }}" class="rounded" style="width:80px; height:60px; object-fit:cover;">
                        </a>
                        <div class="flex-grow-1">
                            <a href="{{ route('blogs.show', $latest->id) }}" class="text-dark text-decoration-none fw-semibold">
                                {{ Str::limit($latest->blog_name, 50) }}
                            </a>
                            <p class="small text-muted mb-1">
                                {{ Str::limit(strip_tags($latest->description), 60) }}
                            </p>
                            <p class="small text-muted mb-0">
                                {{ \Carbon\Carbon::parse($latest->created_at)->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Related Blogs -->
    <div class="related-blogs mt-5">
        <h4 class="mb-4 fw-bold">Related Blogs</h4>
        <div class="row g-4">
            @foreach($relatedBlogs as $related)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="{{ route('blogs.show', $related->id) }}">
                            <img src="{{ asset($related->image) }}" class="card-img-top" alt="{{ $related->blog_name }}" style="height:180px; object-fit:cover;">
                        </a>
                        <div class="card-body p-3">
                            <a href="{{ route('blogs.show', $related->id) }}" class="text-dark text-decoration-none">
                                <h6 class="card-title fw-bold">{{ Str::limit($related->blog_name, 60) }}</h6>
                            </a>
                            <p class="card-text text-muted small mb-2">{{ Str::limit(strip_tags($related->description), 80) }}</p>
                            <p class="text-muted small mb-0">{{ \Carbon\Carbon::parse($related->created_at)->format('M d, Y') }}</p>
                            <a href="{{ route('blogs.show', $related->id) }}" class="btn btn-sm btn-primary mt-2">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.hero-wrap {
    position: relative;
    overflow: hidden;
}
.hero-title {
    line-height: 1.2;
}
.hero-sub {
    font-size: 1.2rem;
}
.blog-description img {
    max-width: 100%;
    border-radius: 0.25rem;
    margin: 1rem 0;
}
.latest-item img {
    object-fit: cover;
}
.related-blogs .card {
    transition: transform 0.3s;
}
.related-blogs .card:hover {
    transform: translateY(-5px);
}
</style>

@endsection
