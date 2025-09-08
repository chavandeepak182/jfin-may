@extends('layouts.header')

@section('title')
    @parent
    JFS | Dashboard
@endsection

@section('content')
    @parent

    <style>
        .stat-card {
            background: #fff;
            border-radius: 16px;
            border: 2px solid #ccc;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            transition: transform 0.2s ease;
            width: 260px;
            height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 10px auto;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }
        .stat-header {
            padding: 8px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            height: 50px;
        }
        .stat-body {
            flex: 1;
            padding: 5px;
            text-align: center;
        }
        .stat-body h4 {
            margin: 0;
            font-weight: bold;
            font-size: 28px;
            color: #333;
        }
        .stat-body h6 {
            margin: 0;
            font-size: 18px;
            color: #555;
        }
        .stat-footer {
            font-size: 11px;
            color: #999;
            padding: 4px;
            border-top: 1px solid #f0f0f0;
            text-align: center;
        }
        #content-wrapper,
        #content {
            background-color: white !important;
        }

        /* Colors */
        .blue-bg { background-color: #1DA1F2; }
        .pink-bg { background-color: #e91e63; }
        .green-bg { background-color: #4caf50; }
        .orange-bg { background-color: #ff9800; }
        .yellow-bg { background-color: #fbc02d; }
    </style>

    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid bg-white">
                <!-- Content Row for Cards -->
                <div class="row pt-5 pb-5 justify-content-center card-row">

                    <!-- Card 1: Customers -->
                    <div class="col-md-3 col-sm-6">
    <a href="{{ route('blogs.index') }}" style="text-decoration: none;">
        <div class="stat-card">
            <div class="stat-header blue-bg">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-body">
                <h6>All Blog</h6>
                <h4>{{ $blogCount ?? DB::table('blog')->count() }}</h4>
            </div>
            <div class="stat-footer">Tracked from Records</div>
        </div>
    </a>
</div>


                    <!-- Card 2: Employees -->
                    <div class="col-md-3 col-sm-6">
    <a href="{{ route('blog.categories.index') }}" style="text-decoration: none;">
        <div class="stat-card">
            <div class="stat-header pink-bg">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="stat-body">
                <h6>All Category</h6>
                <h4>{{ $blogCount ?? DB::table('blog_category')->count() }}</h4>
            </div>
            <div class="stat-footer">Tracked from Records</div>
        </div>
    </a>
</div>


                    <!-- Card 3: Channel Partners -->
                   

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
