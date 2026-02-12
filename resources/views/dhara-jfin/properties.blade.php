@include('dhara-jfin.layout.header')
<main>
    <style>
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8f9fc;
            color: #1a1a2e;
            line-height: 1.6;
        } */

        /* Header
        header {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: #4c5fd7;
        }

        .logo span {
            color: #1a1a2e;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #4c5fd7;
        } */

        .apply-btn {
            background: #4c5fd7;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .apply-btn:hover {
            background: #3d4ec7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 95, 215, 0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin: 4rem 0 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: #295cab;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .section-header p {
            color: #295cab;
            font-size: 1.1rem;
        }

        /* Properties by Localities */
        .localities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .locality-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s;
            text-align:center;
        }

        .locality-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(76, 95, 215, 0.12);
        }
        .localty-title{
        font-size: 1.6rem;
            color: #1a1a2e;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        .properties-mini-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .mini-property {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .mini-developer {
            font-size: 0.9rem;
            color: #4c5fd7;
            font-weight: 600;
            height: 1.2em;
            
        }

        .mini-property img {
            width: 100%;
            aspect-ratio: 16/10;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .mini-name {
            font-size: 0.95rem;
            color: #4a5568;
            font-weight: 500;
            line-height: 1.3;
            height: 2.6em;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .mini-location {
            font-size: 0.85rem;
            color: #9ca3af;
        }

        /* Enhanced Property Cards */
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2.5rem;
            margin-bottom: 4rem;
        }

        .property-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .property-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 60px rgba(76, 95, 215, 0.2);
        }

        .property-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 260px;
        }

        .property-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .property-card:hover .property-image-wrapper img {
            transform: scale(1.1);
        }

        .property-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(76, 95, 215, 0.95);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            z-index: 2;
        }

        .featured-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .property-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
            padding: 2rem 1.5rem 1rem;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .property-card:hover .property-overlay {
            opacity: 1;
        }

        .quick-stats {
            display: flex;
            gap: 1rem;
            color: white;
            font-size: 0.9rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .property-details {
            padding: 1.75rem;
        }

        .property-title {
            font-size: 1.35rem;
            color: #1a1a2e;
            margin-bottom: 0.75rem;
            font-weight: 700;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .property-developer {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .property-location {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .property-specs {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fc;
            border-radius: 12px;
        }

        .spec-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .spec-label {
            font-size: 0.8rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .spec-value {
            font-size: 1rem;
            color: #1a1a2e;
            font-weight: 600;
        }

        .property-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.25rem;
            border-top: 2px solid #f1f3f9;
        }

        .property-price {
            font-size: 1.75rem;
            color: #4c5fd7;
            font-weight: 700;
        }

        .contact-btn {
            background: linear-gradient(135deg, #4c5fd7 0%, #667eea 100%);
            color: white;
            padding: 0.875rem 1.75rem;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .contact-btn:hover {
            transform: translateX(4px);
            box-shadow: 0 8px 20px rgba(76, 95, 215, 0.3);
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(76, 95, 215, 0.12);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }

        .feature-card h3 {
            color: #1a1a2e;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .feature-card p {
            color: #6b7280;
            line-height: 1.7;
        }

        /* Services Section */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .service-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(76, 95, 215, 0.15);
        }

        .service-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service-content {
            padding: 2rem;
        }

        .service-content h3 {
            color: #4c5fd7;
            margin-bottom: 1rem;
            font-size: 1.35rem;
        }

        .service-content p {
            color: #6b7280;
            line-height: 1.8;
        }

        /* Testimonials */
        .testimonials {
            background: white;
            padding: 4rem 2rem;
            border-radius: 24px;
            margin: 4rem 0;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .testimonial-card {
            background: #f8f9fc;
            padding: 2rem;
            border-radius: 16px;
            border-left: 4px solid #4c5fd7;
        }

        .testimonial-stars {
            color: #fbbf24;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            margin-top: 1.5rem;
            font-weight: 600;
            color: #1a1a2e;
        }

        .testimonial-role {
            color: #9ca3af;
            font-size: 0.9rem;
        }
        /* Search and Filter Section */
        .search-filter-section {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 3rem;
            margin-top:2rem;
        }

        .search-bar-wrapper {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-input-group {
            flex: 1;
            position: relative;
        }

        .search-input-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #f1f3f9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .search-input-group input:focus {
            border-color: #4c5fd7;
            outline: none;
            box-shadow: 0 0 0 4px rgba(76, 95, 215, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .main-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            min-width: 200px;
        }

        .filter-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 2px solid #f1f3f9;
            border-radius: 10px;
            background: white;
            color: #1a1a2e;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-select:hover {
            border-color: #cbd5e0;
        }

        .expand-filters-btn {
            background: #f8f9fc;
            color: #4c5fd7;
            border: none;
            margin-top:1.8rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .expand-filters-btn:hover {
            background: #eef2ff;
        }

        .advanced-filters {
            display: none;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f3f9;
        }

        .advanced-filters.active {
            display: grid;
        }

        .filter-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .filter-chip {
            padding: 0.5rem 1rem;
            background: #f1f3f9;
            border-radius: 20px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
            user-select: none;
        }

        .filter-chip.active {
            background: #4c5fd7;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .properties-grid {
                grid-template-columns: 1fr;
            }

            .property-specs {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .property-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .property-card:nth-child(1) { animation-delay: 0.1s; }
        .property-card:nth-child(2) { animation-delay: 0.2s; }
        .property-card:nth-child(3) { animation-delay: 0.3s; }
        .property-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
    @php
    function formatPrice($price) {
        if ($price >= 10000000) return '₹' . round($price / 10000000, 2) . ' Cr';
        if ($price >= 100000) return '₹' . round($price / 100000, 2) . ' L';
        return '₹' . number_format($price);
    }
@endphp
<body>
    <!-- Header -->
    <!-- <header>
        <nav>
            <div class="logo">
                <span>JCI</span> FINSERV
            </div>
            <ul class="nav-links">
                <li><a href="#about">About Us</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#calculator">Calculator</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#properties">Properties</a></li>
                <li><a href="#resources">Resources</a></li>
            </ul>
            <button class="apply-btn">Apply Now</button>
        </nav>
    </header> -->
    <section class="video-hero">
            <video id="videobcg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
            <source src="{{ asset('theme/dhara-jfin/videos/properties_banner.mp4') }}" type="video/mp4">
            </video>
        <div class="video-banner-overlay">
            <div class="video-overlay-content">
                <h1>Find Your Dream Property with <span>Jfinserv</span></h1>
                <p>Search across prime locations and premium collections</p>
                <a href="{{ url('/apply') }}" class="btn-primary">
                    Apply Now
                </a>
            </div>
        </div>
    </section>
    <section class="container">

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="search-bar-wrapper">
                <div class="search-input-group">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Search by locality, project name or developer...">
                </div>
                <button class="apply-btn">Search</button>
            </div>

            <div class="main-filters">
                <div class="filter-group">
                    <label>Property Type</label>
                    <select class="filter-select">
                        <option>All Types</option>
                        <option>Residential Apartment</option>
                        <option>Villa / Independent House</option>
                        <option>Penthouse</option>
                        <option>Plot / Land</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>BHK Type</label>
                    <select class="filter-select">
                        <option>Any BHK</option>
                        <option>1 BHK</option>
                        <option>2 BHK</option>
                        <option>3 BHK</option>
                        <option>4+ BHK</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Budget Range</label>
                    <select class="filter-select">
                        <option>Any Budget</option>
                        <option>₹40L - ₹60L</option>
                        <option>₹60L - ₹80L</option>
                        <option>₹80L - ₹1Cr</option>
                        <option>₹1Cr - ₹2Cr</option>
                        <option>Above ₹2Cr</option>
                    </select>
                </div>
                
            </div>

            <!-- Advanced Expandable Filters -->
            <div class="advanced-filters" id="advancedFilters">
                <div class="filter-group">
                    <label>Possession Status</label>
                    <div class="filter-checkbox-group">
                        <div class="filter-chip active">Ready to Move</div>
                        <div class="filter-chip">Under Construction</div>
                        <div class="filter-chip">New Launch</div>
                    </div>
                </div>
                <div class="filter-group">
                    <label>Amenities</label>
                    <div class="filter-checkbox-group">
                        <div class="filter-chip">Swimming Pool</div>
                        <div class="filter-chip">Gym</div>
                        <div class="filter-chip">Clubhouse</div>
                        <div class="filter-chip">Parking</div>
                        <div class="filter-chip">Security</div>
                    </div>
                </div>
                <div class="filter-group">
                    <label>Area (Sq. Ft.)</label>
                    <select class="filter-select">
                        <option>Any Area</option>
                        <option>500 - 1000</option>
                        <option>1000 - 1500</option>
                        <option>1500 - 2000</option>
                        <option>Above 2000</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <!-- Properties by Localities -->
    <!-- Properties by Localities -->
<section class="container">
    <div class="section-header">
        <h2>Properties by Localities</h2>
        <p>Explore prime properties based on your location</p>
    </div>

    <div class="localities-grid">
        @foreach($data['selectedLocalities'] as $localityData)
            <div class="locality-card">
                <!-- Locality Title -->
                <h3 class="locality-title">
                    {{ $localityData['locality'] }}
                </h3>

                <!-- Properties Grid -->
                <div class="properties-mini-grid">
                    @foreach($localityData['properties'] as $property)
                        <a href="{{ url($property->slug . '-' . $property->properties_id) }}"
                           target="_blank"
                           class="mini-property">

                            <span class="mini-developer">
                                {{ $property->builder_name }}
                            </span>

                            <img
                                src="{{ asset($property->image) }}"
                                alt="{{ $property->title }}"
                                loading="lazy"
                            >

                            <span class="mini-name">
                                {{ $property->title }}
                            </span>

                            @if(!empty($property->location))
                                <span class="mini-location">
                                    {{ $property->location }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>


    <!-- Curated Collections -->
<!-- <section class="container">
    <div class="section-header">
        <h2>Curated Collections</h2>
        <p>Explore prime properties based on your preferences</p>
    </div>

    <div class="properties-grid">
     <?php 
                    $properties = [
                        [
                            "name" => "Sukhwani Skylines",
                            "developer" => "By Sukhwani",
                            "location" => "Bhumkar Nagar, Wakad, Pune",
                            "bhk" => "2 & 3 BHK",
                            "size" => "756 SQ. FT.",
                            "price" => "₹89.9L*",
                            "img" => "sukhwani-skylines/b1.jpg",
                            "link" => "/sukhwani-skylines",
                            "category" => "Residential"
                        ],
                        [
                            "name" => "Pharande L-Axis",
                            "developer" => "By Pharande Spaces",
                            "location" => "PCNTDA, Sector No. 6, Moshi, PCMC",
                            "bhk" => "2, 3 & 4 BHK",
                            "size" => "819* SQ. FT.",
                            "price" => "₹97L*",
                            "img" => "pharande-laxis/b1.jpg",
                            "link" => "/pharande-l-axis",
                            "category" => "Residential"
                        ],
                        [
                            "name" => "Pharande Puneville",
                            "developer" => "By Pharande Spaces",
                            "location" => "Pune-Bangalore Highway, Punawale",
                            "bhk" => "2 & 2.5 BHK",
                            "size" => "728* SQ. FT.",
                            "price" => "₹80L*",
                            "img" => "pharande-puneville/b1.jpg",
                            "link" => "/pharande-puneville",
                            "category" => "Residential"
                        ],
                        [
                            "name" => "Sukhwani Celaeno",
                            "developer" => "By Sukhwani",
                            "location" => "Vibgyor School Rd, Pimple Saudagar",
                            "bhk" => "3 & 4 BHK",
                            "size" => "1325 SQ. FT.",
                            "price" => "₹1.72Cr*",
                            "img" => "sukhwani-celaeno/b1.jpg",
                            "link" => "/sukhwani-celaeno",
                            "category" => "Residential"
                        ]
                    ]; 

                    $isMobile = isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|touch|webos|iphone|ipad/i', strtolower($_SERVER['HTTP_USER_AGENT']));
                    $chunkSize = $isMobile ? 1 : 4; // 1 card per slide on mobile, 4 per slide on desktop
                    $chunks = array_chunk($properties, $chunkSize);
                    $first = true; 
                ?> 
                
        @foreach($properties as $property)
            <div class="property-card">
                 Image 
                <div class="property-image-wrapper">
                    <img
                        src="{{ asset('theme/frontend/lp/' . $property['img']) }}"
                        alt="{{ $property['name'] }}"
                        loading="lazy"
                    >

                    <div class="property-badge">
                        {{ $property['category'] ?? 'Featured' }}
                    </div>

                    <div class="property-overlay">
                        <div class="quick-stats">
                            <div class="stat-item">🏠 {{ $property['bhk'] }}</div>
                            <div class="stat-item">📐 {{ $property['size'] }}</div>
                        </div>
                    </div>
                </div>

                 Details 
                <div class="property-details">
                    <h3 class="property-title">
                        {{ $property['name'] }}
                    </h3>

                    <div class="property-developer">
                        <i class="fa-solid fa-building"></i> {{ $property['developer'] }}
                    </div>

                    <div class="property-location">
                        <i class="fa-solid fa-location-dot"></i> {{ $property['location'] }}
                    </div>

                    <div class="property-specs">
                        <div class="spec-item">
                            <span class="spec-label">Config</span>
                            <span class="spec-value">{{ $property['bhk'] }}</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Area</span>
                            <span class="spec-value">{{ $property['size'] }}</span>
                        </div>
                    </div>

                    <div class="property-footer">
                        <div class="property-price">
                            {{ $property['price'] }}
                        </div>

                        <a href="{{ $property['link'] }}" target="_blank">
                            <button class="contact-btn">
                                Contact <span>→</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section> -->


    <!-- Featured Properties -->
    <section class="container">
    <div class="section-header">
        <h2>Featured Properties</h2>
        <p>Explore the most exclusive properties</p>
    </div>

    <div class="properties-grid">
        @foreach($data['featuredProperties'] as $v)
            @php
                $img = env('baseURL') . '/' . $v->image;
                $title = $v->title;
                $builder = $v->builder_name;
                $location = $v->localities . ', ' . $v->city;
                $bhk = $v->select_bhk;
                $area = $v->area;
                $price =formatPrice($v->s_price);
            @endphp

            <div class="property-card">
                <!-- Image -->
                <div class="property-image-wrapper">
                    <img
                        src="{{ $img }}"
                        alt="{{ $title }}"
                        loading="lazy"
                    >

                    <div class="property-badge featured-badge">
                        Featured
                    </div>

                    <div class="property-overlay">
                        <div class="quick-stats">
                            <div class="stat-item">🏠 {{ $bhk }} BHK</div>
                            <div class="stat-item">📐 {{ $area }} Sq. Ft.</div>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="property-details">
                    <h3 class="property-title">
                        {{ $title }}
                    </h3>

                    <div class="property-developer">
                        <i class="fa-solid fa-building"></i> By {{ $builder }}
                    </div>

                    <div class="property-location">
                        <i class="fa-solid fa-location-dot"></i> {{ $location }}
                    </div>

                    <div class="property-specs">
                        <div class="spec-item">
                            <span class="spec-label">Config</span>
                            <span class="spec-value">{{ $bhk }} BHK</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Area</span>
                            <span class="spec-value">{{ $area }} SQ.FT</span>
                        </div>
                    </div>

                    <div class="property-footer">
                        <div class="property-price price-format" data-price="{{ $price }}">
                            {{ $price }}
                        </div>

                        <a href="{{ url($v->slug . '-' . $v->properties_id) }}" target="_blank">
                            <button class="contact-btn">
                                Know More <span>→</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


    <!-- All Properties -->
    <section class="container">
    <div class="section-header">
        <h2>All Properties</h2>
        <p>Explore prime properties based on your accommodation</p>
    </div>

    <div class="properties-grid">
        @foreach($data['allProperties'] as $v)
            @php
                $img = env('baseURL') . '/' . $v->image;
                $title = $v->title;
                $category = $v->category_name ?? 'Available';
                $builder = $v->builder_name;
                $location = $v->localities . ', ' . $v->city;
                $bhk = $v->select_bhk;
                $area = $v->area;
                $price = formatPrice($v->s_price);
            @endphp

            <div class="property-card">
                <!-- Image -->
                <div class="property-image-wrapper">
                    <img
                        src="{{ $img }}"
                        alt="{{ $title }}"
                        loading="lazy"
                    >

                    <div class="property-badge">
                        {{ $category }}
                    </div>

                    <div class="property-overlay">
                        <div class="quick-stats">
                            <div class="stat-item">🏠 {{ $bhk }} BHK</div>
                            <div class="stat-item">📐 {{ $area }} Sq. Ft.</div>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="property-details">
                    <h3 class="property-title">
                        {{ $title }}
                    </h3>

                    <div class="property-developer">
                        <i class="fa-solid fa-building"></i> By {{ $builder }}
                    </div>

                    <div class="property-location">
                        <i class="fa-solid fa-location-dot"></i>     {{ $location }}
                    </div>

                    <div class="property-specs">
                        <div class="spec-item">
                            <span class="spec-label">Config</span>
                            <span class="spec-value">{{ $bhk }} BHK</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Area</span>
                            <span class="spec-value">{{ $area }} SQ.FT</span>
                        </div>
                    </div>

                    <div class="property-footer">
                        <div class="property-price price-format" data-price="{{ $price }}">
                            {{ $price }}
                        </div>

                        <a href="{{ url($v->slug . '-' . $v->properties_id) }}" target="_blank">
                            <button class="contact-btn">
                                Contact <span>→</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


    <!-- Features Section -->
    <section class="container">
        <div class="section-header">
            <h2>Why Choose Us?</h2>
            <p>Our Features</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🏆</div>
                <h3>Trusted Company</h3>
                <p>Offering a wealth of knowledge, expertise, integrity, and a strong track record as guide clients toward their real estate goals with personalized support.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🎁</div>
                <h3>Unlimited Rewards</h3>
                <p>Earn rewards by following our automation referral scheme. We offer generous and numerous bonuses and incentives over greater warranty potential.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Fast & Easier Process</h3>
                <p>We always keep buyers and sellers' promises quick approvals, minimal paperwork, competitive rates, and faster to closer within 7 days.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>High Range Loan</h3>
                <p>Our partners are eager to provide offers substantial funding for major investments or purchases with competitive rates and quick processing.</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="container">
        <div class="section-header">
            <h2>We Provide Best Services</h2>
            <p>Our Services</p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <img class="service-image" src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&h=400&fit=crop" alt="NRI Friendly">
                <div class="service-content">
                    <h3>NRI Friendly</h3>
                    <p>We understand you're seeking a new home, and our team quickly gathers details, flexible options, quick approvals, and complete guidance from afar. This important financial decision.</p>
                </div>
            </div>

            <div class="service-card">
                <img class="service-image" src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&h=400&fit=crop" alt="Property Management">
                <div class="service-content">
                    <h3>Property Management</h3>
                    <p>We simplify construction financing with our value add and we only online application, offering tailored financing solutions, streamlined approval and fast funding process.</p>
                </div>
            </div>

            <div class="service-card">
                <img class="service-image" src="https://images.unsplash.com/photo-1633158829585-23ba8f7c8caf?w=600&h=400&fit=crop" alt="Investor Deals">
                <div class="service-content">
                    <h3>Investor Deals</h3>
                    <p>Allows offers Loan Against Property with flexible repayment options, executed by our property team. Check your eligibility and apply accurate add-on is tax benefits.</p>
                </div>
            </div>

            <div class="service-card">
                <img class="service-image" src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=600&h=400&fit=crop" alt="Loan Assistance">
                <div class="service-content">
                    <h3>Loan Assistance</h3>
                    <p>Allows offers Loan Against Property with flexible repayment options, executed by our property team. Check your eligibility and apply accurate add-on is tax benefits.</p>
                </div>
            </div>

            <div class="service-card">
                <img class="service-image" src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&h=400&fit=crop" alt="Group Booking">
                <div class="service-content">
                    <h3>Group Booking</h3>
                    <p>This service meets the diverse needs of short and medium businesses. Whether you're expanding, Investing in equipment, or increasing capital.</p>
                </div>
            </div>

            <div class="service-card">
                <img class="service-image" src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&h=400&fit=crop" alt="Property Visits & Booking">
                <div class="service-content">
                    <h3>Property Visits & Booking</h3>
                    <p>JFinserv offers Loan Against Property with flexible repayment options, executed by our property team. Check your eligibility and apply accurate add-on.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="container">
        <div class="testimonials">
            <div class="section-header">
                <h2>Hear from Our Customers</h2>
                <p>Testimonial</p>
            </div>
            
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p>"Outstanding service and exceptional properties. The team made our home-buying experience seamless and enjoyable. Highly recommended for anyone looking for their dream home!"</p>
                    <div class="testimonial-author">Rahul Sonsawane</div>
                    <div class="testimonial-role">IT Professional</div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <p>"Professional, efficient, and trustworthy. They helped us find the perfect investment property and guided us through every step of the process with expertise and care."</p>
                    <div class="testimonial-author">Vishal Sarraf</div>
                    <div class="testimonial-role">Business Owner</div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
</main>
@include('dhara-jfin.layout.footer')

