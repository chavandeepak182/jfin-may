@extends('frontend.layouts.header')

@section('title', "Blogs")
@section('description', "")
@section('keywords', "")

@section('content')

<!-- ===== Hero Slider ===== -->
<section class="page-banner" style="background-image: url('{{ asset('theme') }}/frontend/img/blog.jpg');">
    <div class="page-banner-overlay"></div>

    <div class="page-banner-container">
        <!-- <h1 class="page-banner-title">About Jfinserv</h1> -->
    </div>
</section>

<style>
  /* Force hero section height */
  .hero-slider {
    max-height: 550px; /* you can adjust (400px, 600px, etc.) */
    overflow: hidden;
  }

  .hero-slider .hero-img {
    height: 550px; /* match max-height above */
    object-fit: cover; /* keeps image aspect ratio and fills area */
  }

  /* Caption styling */
  .hero-slider .carousel-caption {
    bottom: 15%;
    left: 8%;
    text-align: left;
  }

  .hero-slider h2 {
    color: #fff;
    text-shadow: 0 3px 8px rgba(0,0,0,0.6);
  }

  .hero-slider p {
    color: #f1f1f1;
    text-shadow: 0 2px 6px rgba(0,0,0,0.6);
  }
</style>

<!-- ===== /Hero Slider ===== -->

<!-- ===== Search + Category Filter ===== -->
<div class="container py-5">
<<<<<<< HEAD
  <h2 class="section-title mb-4 text-center" style="color:#000;">Explore Blogs</h2>
=======
  <h2 class="section-title mb-4 text-center">Explore Blogs</h2>
>>>>>>> 9eb4201780c7e653167c1cc52a57c17a77722daa

  <form method="GET" action="{{ route('blogs.index') }}">
    <div class="row g-3 align-items-center justify-content-center mb-5">

      <!-- Search -->
      <div class="col-md-5">
        <input type="text" name="search" value="{{ request('search') }}" 
          class="form-control" placeholder="Search blogs...">
      </div>

      <!-- Category -->
      <div class="col-md-4">
        <select id="category" name="category" class="form-select">
          <option value="">-- Select Category --</option>
          @foreach($categories as $category)
            <option value="{{ $category->pid }}" 
              {{ request('category') == $category->pid ? 'selected' : '' }}>
              {{ $category->category_name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Button -->
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-search"></i> Search
        </button>
      </div>

    </div>
  </form>

  <!-- ===== Blog Grid ===== -->
  <div class="row gy-4 gx-4">
    @foreach($allIndustries as $blog)
      <div class="col-md-4">
        <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark">
          <div class="card h-100 shadow-sm border-0 blog-box">
            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->blog_name }}">
            <!-- <img src="{{ asset('images/sample.png') }}" class="card-img-top" alt="Sample Image"> -->

            <div class="card-body">
              <h5 class="card-title">{{ $blog->blog_name }}</h5>
              <p class="card-text text-muted">
                {{ Str::limit(strip_tags($blog->description), 120, '...') }}
              </p>
            </div>
            <div class="card-footer bg-white border-0">
              <small class="text-secondary">
                <i class="bi bi-calendar3"></i>
                {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}
              </small>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <!-- Pagination -->
  <div class="mt-5 d-flex justify-content-center">
    {{ $allIndustries->links() }}
  </div>
</div>

<!-- Bootstrap + Select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#category').select2();
  });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
