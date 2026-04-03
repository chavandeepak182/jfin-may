@include('dhara-jfin.layout.header')

<?php
    foreach($data['propertie_details'] as $v) {  
            $price_range = $v->from_price. " to ". $v->to_price;
            $img = env('baseURL'). "/".$v->image; 
            $boucher = env('baseURL'). "/".$v->boucher;   
            $address = $v->localities.", ".$v->city; 
            $area = $v->area; 
            $rera = $v->rera; 
            $category = $v->category_name;  
            $latitude = $v->latitude; 
            $longitude = $v->longitude; 
            $s_price = $v->s_price; 
            $land_type = $v->land_type; 
            $builder_name = $v->builder_name; 
            $facilities = $v->facilities; 
            $title = $v->title; 
            $created_at = $v->created_at;
            $beds = $v->beds; 
            $baths = $v->baths; 
            $balconies = $v->balconies; 
            $parking = $v->parking; 
            $builtup_area =$v->builtup_area; 
            $nearby_locations = is_string($v->nearby_locations) ? json_decode($v->nearby_locations, true) : $v->nearby_locations; 
            $property_details = $v->property_details;
            $short_description = $v->short_description;
            $select_bhk = $v->select_bhk;
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    :root {
        --primary-color: #4c5fd7;
        --secondary-color: #295cab;
        --text-dark: #1a1a2e;
        --text-muted: #6b7280;
        --bg-light: #f8f9fc;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0,0,0,0.05);
        --border-color: #e2e8f0;
    }

    * { box-sizing: border-box; }

    .custom-container {
        max-width: 1440px;
        margin: 8px auto;
        padding: 0 20px;
    }

    .main-wrapper {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .custom-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .content-main {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
        padding: 0 15px;
    }

    .content-sidebar {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        padding: 0 15px;
    }

    @media (max-width: 992px) {
        .content-main, .content-sidebar {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .content-sidebar { margin-top: 2rem; }
    }

    .property-hero {
        background: var(--white);
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .breadcrumb-nav {
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .breadcrumb-nav a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .property-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        flex-wrap: nowrap;
        gap: 2rem;
    }

    .property-main-info {
        flex: 1;
    }

    .property-main-info h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .rera-badge {
        background: #e6fffa;
        color: #2d3748;
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 4px;
        border: 1px solid #cbd5e0;
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 600;
    }

    .developer-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .property-location {
        color: var(--text-muted);
        margin-top: 0.5rem;
        font-size: 1rem;
    }

    .property-price-box {
        text-align: right;
        min-width: 250px;
    }

    .price-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1;
    }

    .emi-info {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 4px;
    }

    .agreement-label {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .btn-contact-top {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 700;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        width: 100%;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
    }

    /* Grid Gallery Layout */
    .grid-gallery {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 10px;
        margin-bottom: 2rem;
        border-radius: 12px;
        overflow: hidden;
    }
    .gallery-wrapper {
    width: 100%;
    margin-bottom: 2rem;
}

    .gallery-main {
        /* position: relative;
        height: 450px; */
        position: relative;
    height: 450px;
    border-radius: 12px;
    overflow: hidden;
    }

    .gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .nav-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.6);
    color: #fff;
    border: none;
    font-size: 2rem;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
}
.nav-arrow.left { left: 15px; }
.nav-arrow.right { right: 15px; }

.thumbnail-bar {
    display: flex;
    gap: 10px;
    margin-top: 12px;
    overflow-x: auto;
    padding-bottom: 5px;
}
.thumbnail-bar::-webkit-scrollbar {
    height: 6px;
}

.thumbnail-bar::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

.thumbnail {
    height: 80px;
    min-width: 120px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    opacity: 0.6;
    border: 2px solid transparent;
    transition: 0.3s ease;
}

.thumbnail:hover,
.thumbnail.active {
    opacity: 1;
    border-color: #000;
}

    .gallery-side {
        display: grid;
        grid-template-rows: 1fr 1fr;
        gap: 10px;
        height: 450px;
    }

    .side-item {
        position: relative;
        overflow: hidden;
    }

    .side-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .overlay-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(0,0,0,0.4);
        color: white;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .gallery-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        gap: 10px;
    }

    .btn-action {
        background: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        cursor: pointer;
        color: var(--text-dark);
        text-transform: uppercase;
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .play-btn {
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--text-dark);
    }

    .more-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .more-overlay span {
        font-size: 1.1rem;
        margin-bottom: -5px;
    }

    @media (max-width: 992px) {
        .grid-gallery { grid-template-columns: 1fr; }
        .gallery-side { display: none; }
        .property-header { flex-direction: column; gap: 1rem; }
        .property-price-box { text-align: left; width: 100%; min-width: auto; }
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: var(--white);
        padding: 1.5rem;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow);
        transition: transform 0.3s;
    }

    .info-card:hover { transform: translateY(-5px); }

    .info-icon {
        width: 50px;
        height: 50px;
        background: #f0f4ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 1.5rem;
    }

    .info-details span { display: block; }
    .info-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; }
    .info-value { font-weight: 700; font-size: 1.1rem; }

    .details-section {
        background: var(--white);
        padding: 2.5rem;
        border-radius: 24px;
        margin-bottom: 2rem;
        box-shadow: var(--shadow);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f1f3f9;
        color: var(--secondary-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .description-content{
        padding-left:1rem;
    }

    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1.5rem;
    }

    .amenity-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem;
        border: 1px solid #f1f3f9;
        border-radius: 16px;
        transition: all 0.3s;
    }

    .amenity-item:hover { border-color: var(--primary-color); background: #f8f9fc; }
    .amenity-item img { width: 40px; height: 40px; }

    .sidebar-card {
        background: var(--white);
        padding: 1.5rem;
        border-radius: 20px;
        box-shadow: var(--shadow);
        position: sticky;
        top: 100px;
        z-index: 10;
    }

    .sidebar-card h3 { font-size: 1.3rem; font-weight: 700; }
    .sidebar-card .form-control, .sidebar-card .form-select {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    .btn-contact {
        width: 100%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border: none;
        padding: 0.8rem;
        border-radius: 10px;
        font-weight: 700;
        margin-top: 0.5rem;
        transition: all 0.3s;
    }

    .nearby-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .nearby-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.3s;
    }

    .nearby-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        flex-shrink: 0;
    }

    .nearby-info h4 { font-size: 0.95rem; font-weight: 500; margin-bottom: 0.2rem; }
    .nearby-info p { font-size: 0.8rem; color: var(--text-muted); margin: 0; }

    .popular-searches { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1.5rem; }
    .search-tag {
        padding: 8px 16px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }
    .search-tag:hover { background: var(--primary-color); color: white; transform: translateY(-2px); }

    /* Utility Classes */
    .mb-1 { margin-bottom: 0.25rem; }
    .mb-2 { margin-bottom: 0.5rem; }
    .mb-3 { margin-bottom: 1rem; }
    .mt-2 { margin-top: 0.5rem; }
    .mt-3 { margin-top: 1rem; }
    .pt-3 { padding-top: 1rem; }
    .border-top { border-top: 1px solid var(--border-color); }
    .d-flex { display: flex; }
    .justify-content-between { justify-content: space-between; }
    .fw-bold { font-weight: 700; }
    .text-muted { color: var(--text-muted); }
    .small { font-size: 0.85rem; }
    .w-100 { width: 100%; }
    
    .btn-brochure {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        background: transparent;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s;
        cursor: pointer;
        width: 100%;
    }
    
    .btn-brochure:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Gallery Modal Styles */
    .gallery-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .gallery-modal.active {
        display: flex;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 2.5rem;
        cursor: pointer;
        z-index: 10001;
    }

    .modal-main-img {
        max-width: 90%;
        max-height: 70vh;
        object-fit: contain;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .modal-thumbnails-wrapper {
        width: 100%;
        display:flex;
        justify-content:center;
        padding: 20px 0;
        background: rgba(255, 255, 255, 0.05);
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: thin;
        scrollbar-color: var(--primary-color) rgba(255,255,255,0.1);
    }

    .modal-thumbnails-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .modal-thumbnails-wrapper::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.1);
    }

    .modal-thumbnails-wrapper::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 10px;
    }

    .modal-thumbnails-container {
        display: inline-flex;
        gap: 15px;
        padding: 0 40px;
    }

    .modal-thumb {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        opacity: 0.6;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .modal-thumb:hover {
        opacity: 1;
    }

    .modal-thumb.active {
        opacity: 1;
        border-color: var(--primary-color);
        transform: scale(1.05);
    }

    .form-group { margin-bottom: 1rem; }
    .form-control, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        outline: none;
        transition: border-color 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
    }

    //thank you pop up
    .popup-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 999;
}   
    .blur{
        filter: blur(6px);
        transition: filter 0.3s ease;
    }

    .pop-up{
        width:500px;
        background: #fff;
        border-radius: 6px;
        position:fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align:center;
        padding:0 30px;
        z-index:1000;
        box-shadow:0 0 15px rgba(0,0,0,0.3);
        visibility: hidden;
    }
    .pop-up i{
        font-size:100px;
        color: #4c5fd7;
        background: #fff;
        margin-top:-50px;
        border-radius:50%;
        box-shadow:0 2px 5px rgba(0,0,0,0.5);
    }
    .pop-up h2{
        font-size:38px;
        font-weight:500;
        margin: 30px 0 10px;
    }

    .pop-up p{
        font-size:16px;
        color:#333;
        margin-bottom:20px;
    }
    .pop-up button{
        width:100%;
        margin-top:20px;
        margin-bottom:20px;
        padding:10px 0;
        background: #4c5fd7;
        color: #fff;
        border:0;
        outline:none;
        font-size:18px;
        border-radius:6px;
        cursor:pointer;
    }

    .modal-backdrop{
        display:none;
        position:fixed;
        inset:0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }
    .modal{
        /* display:none; */
        position:fixed;
        inset:0;
        z-index: 1000;
        display:flex;
        align-items:center;
        justify-content:center;
        visibility: hidden;
    }
    .modal-content-prop{
        background:#000;
        width:500px;
        padding:15px 30px 20px;
        border-radius:6px;
        overflow:hidden;
        color:#fff;
    }
    
    .modal-header-prop{
        display:flex;
        justify-content:space-between;
    }
    .modal-header-title{
        display:grid;
        padding:12px 16px;
        background:#000;
    }
    .modal-header-title h2{
        font-size:25px;
        font-weight:500;
    }
    .modal-close-prop{
        text-align:right;
        margin-top:-7px;

    }
    .close-btn{
        text-align:right;
        background:transparent;
        border:none;
        color:#fff;
        font-size:26px;
        cursor:pointer;
    }
    .modal-body{
        padding:16px;
    }
    .enquiry-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .enquiry-form input{
        padding:10px;
        border-radius:4px;
        border:none;
        outline:none;
    }
    .enquiry-form button{
        margin-top:15px;
        padding:10px;
        border:none;
        border-radius:10px;
        background:#fff;
        color:#295cab;  
        font-size:20px;
        cursor:pointer;
    }

    .form-container-overlay{
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }
    .form-container {
            position: fixed;
            top:18%;
            right:50%;
            transform: translate(50%, -10%);
            z-index: 1000;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 530px;
            width: 100%;
            visibility: hidden;
        }
        .form-header{
            display: flex;
            justify-content: space-between;
        }
        .form-header-title {
            text-align: center;
            margin-bottom: 12px;
        }

        .form-header-title h1 {
            color: #2c3e80;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .form-header-title p {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 1rem;
        }
        .visit-close{
            position:fixed;
            top:3%;
            right:5%;
            text-align:right;
            background:transparent;
            border:none;
            color:#000;
            font-size:26px;
            cursor:pointer;
        }
        label {
            display: block;
            color: #2c3e80;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 15px;
            /* transition: all 0.3s ease; */
            background-color: #f9fafb;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .radio-group {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 12px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            padding: 7px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            /* transition: all 0.3s ease; */
            background-color: #f9fafb;
        }

        .radio-option:hover {
            border-color: #667eea;
            background-color: white;
        }

        .radio-option input[type="radio"] {
            width: 10px;
            height: 10px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            margin-right: 12px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .radio-option input[type="radio"]:checked {
            border-color: #667eea;
            border-width: 6px;
        }

        .radio-option input[type="radio"]:checked ~ .radio-label {
            color: #2c3e80;
            font-weight: 600;
        }

        .radio-option:has(input[type="radio"]:checked) {
            border-color: #667eea;
            background-color: #f0f4ff;
        }

        .radio-label {
            color: #4b5563;
            font-size: 15px;
            cursor: pointer;
            flex-grow: 1;
        }

        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #667eea 0%, #5568d3 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            /* transition: all 0.3s ease; */
            margin-top: 8px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .required {
            color: #ef4444;
            margin-left: 2px;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 28px 20px;
            }

            .form-header h1 {
                font-size: 24px;
            }
        }
</style>

<main class="main-wrapper">
    <div class="custom-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-nav">
            <a href="{{ url('/') }}">Home</a> &nbsp;/&nbsp; 
            <a href="{{ url('/properties') }}">Properties</a> &nbsp;/&nbsp; 
            <span>{{ $title }}</span>
        </div>
        <div class="custom-row" id="mainwrapper">
            
            <div class="content-main">
                <!-- Hero Header -->
                <div class="property-header">
                    <div class="property-main-info">
                        <h1>{{ $title }} @if($rera)<span class="rera-badge"><i class="fas fa-check-circle"></i> RERA</span>@endif</h1>
                        <div class="developer-info">
                            By <span class="developer-link">{{ $builder_name }}</span>
                        </div>
                        <div class="property-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $address }}
                        </div>
                    </div>
                    <div class="property-price-box">
                        <div class="price-value">₹{{ number_format($s_price, 0, '.', ',') }}*</div>
                        <div class="agreement-label">Starting Price</div>
                        <button  class="btn-contact-top" onclick="openFormOverlay()">
                            <i class="fas fa-phone-alt"></i> Book your Visit
                        </button>
                    </div>
                </div>

                <!-- Gallery -->
                <!-- <div class="grid-gallery">
                    <div class="gallery-main">
                        <span class="overlay-badge">Main Image</span>
                        <img src="{{ asset($data['additional_images'][0]->image_url) }}" alt="{{ $title }}">
                        
                    </div>
                    <div class="gallery-side">
                        @if(isset($data['additional_images'][1]))
                        <div class="side-item">
                            <img src="{{ asset($data['additional_images'][1]->image_url) }}" alt="Gallery Image 1">
                        </div>
                        @endif
                        @if(isset($data['additional_images'][2]))
                        <div class="side-item" style="cursor: pointer;" onclick="openGallery(0)">
                            <img src="{{ asset($data['additional_images'][2]->image_url) }}" alt="Gallery Image 2">
                            <div class="more-overlay">
                                <span>+</span>
                                {{ count($data['additional_images'])-2 }} more
                            </div>
                        </div>
                        @endif
                    </div>
                </div> -->

                <div class="gallery-wrapper">
                    <div class="gallery-main">
                        <button class="nav-arrow left" onclick="prevImage()">‹</button>

                       <img id="mainImage"
     src="{{ asset($data['main_image']) }}"
     alt="{{ $title }}">
                             

                        <button class="nav-arrow right" onclick="nextImage()">›</button>
                    </div>

                  <div class="thumbnail-bar">

    <!-- 🔥 MAIN IMAGE FIRST (properties table) -->
    <img
        src="{{ asset($data['main_image']) }}"
        class="thumbnail active"
        onclick="setImage(0)"
    >

    
  @foreach($data['additional_images'] as $index => $img)

    @if($img->image_url != $data['main_image']) {{-- 🔥 IMPORTANT --}}
    
        <img
            src="{{ asset($img->image_url) }}"
            class="thumbnail"
            onclick="setImage({{ $index + 1 }})"
        >

    @endif

@endforeach

</div>
                </div>

                <div id="galleryModal" class="gallery-modal">
                    <span class="modal-close" onclick="closeGallery()">&times;</span>
                    <img id="modalMainImg" src="" class="modal-main-img">
                    <div class="modal-thumbnails-wrapper">
                        <div class="modal-thumbnails-container">
                            @foreach($data['additional_images'] as $index => $image)
                                <img src="{{ asset($image->image_url) }}" 
                                     class="modal-thumb" 
                                     onclick="updateModalImg('{{ asset($image->image_url) }}', this)"
                                     data-index="{{ $index }}">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Info Cards -->
                <div class="info-grid">
                    @if($select_bhk)
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-home"></i></div>
                        <div class="info-details">
                            <span class="info-label">Configuration</span>
                            <span class="info-value">{{ $select_bhk }} BHK</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($area)
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-vector-square"></i></div>
                        <div class="info-details">
                            <span class="info-label">Carpet Area</span>
                            <span class="info-value">{{ $area }} Sq. Ft.</span>
                        </div>
                    </div>
                    @endif

                    @if($land_type)
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-building"></i></div>
                        <div class="info-details">
                            <span class="info-label">Property Type</span>
                            <span class="info-value">{{ $land_type }}</span>
                        </div>
                    </div>
                    @endif

                    @if($builder_name)
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                        <div class="info-details">
                            <span class="info-label">Developer</span>
                            <span class="info-value">{{ $builder_name }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Description -->
               <div class="details-section">
                <h2 class="section-title">
                    <i class="fas fa-align-left"></i> About Project
                </h2>
                <div class="description-content">
                    {!! base64_decode($property_details) !!}
                </div>
            </div>

                <!-- Amenities -->
                <div class="details-section">
                    <h2 class="section-title"><i class="fas fa-swimming-pool"></i> Amenities</h2>
                    @if(isset($facilities) && !empty($facilities))
                        @php
                            if (is_string($facilities)) {
                                $decoded = json_decode($facilities, true);
                                $facilitiesArray = is_array($decoded) ? $decoded : explode(',', $facilities);
                            } else {
                                $facilitiesArray = (array)$facilities;
                            }
                            $facilitiesArray = array_filter(array_map('trim', (array)$facilitiesArray));

                            $icons = [
                                'WiFi' => 'theme/frontend/img/icons/wifi.svg',
                                'Parking' => 'theme/frontend/img/icons/parking.svg',
                                'Swimming Pool' => 'theme/frontend/img/icons/pool.svg',
                                'Balcony' => 'theme/frontend/img/icons/balcony.svg',
                                'Garden' => 'theme/frontend/img/icons/garden.svg',
                                'Security' => 'theme/frontend/img/icons/security.svg',
                                'Fitness Center' => 'theme/frontend/img/icons/gym.svg',
                                'Air Conditioning' => 'theme/frontend/img/icons/ac.svg',
                                'Central Heating' => 'theme/frontend/img/icons/central-heating.svg',
                                'Laundry Room' => 'theme/frontend/img/icons/laundry.svg',
                                'Pets Allowed' => 'theme/frontend/img/icons/pet.svg',
                                'Spa & Massage' => 'theme/frontend/img/icons/spa.svg',
                                'Gym' => 'theme/frontend/img/icons/gym.svg',
                                'Clubhouse' => 'theme/frontend/img/icons/clubhouse.svg',
                                'Play Area' => 'theme/frontend/img/icons/play-area.svg'
                            ];
                        @endphp

                        <div class="amenities-grid">
                            @foreach($facilitiesArray as $facility)
                                @php 
                                    $facility = trim($facility, '"');
                                    $iconPath = $icons[$facility] ?? 'theme/frontend/img/icons/default.svg';
                                @endphp
                                <div class="amenity-item">
                                    <img src="{{ asset($iconPath) }}" alt="{{ $facility }}">
                                    <span class="small fw-bold">{{ $facility }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No amenities listed.</p>
                    @endif
                </div>

                <!-- Location Map -->
                <div class="details-section">
                    <h2 class="section-title"><i class="fas fa-map-marked-alt"></i> Location Advantages</h2>
                    <div id="map" style="height: 400px; border-radius: 16px;"></div>
                </div>

                <!-- Nearby Locations -->
                <div class="details-section">
                    <h2 class="section-title"><i class="fas fa-route"></i> Nearby Locations</h2>
                    <div class="nearby-grid">
    @if($nearby_locations && is_array($nearby_locations))

        @foreach($nearby_locations as $category => $locations)

            @if(!empty($locations)) {{-- 🔥 IMPORTANT CHECK --}}

                @if(is_array($locations))
                    @foreach($locations as $loc)

                        @if(!empty($loc)) {{-- 🔥 EMPTY VALUE SKIP --}}
                            <div class="nearby-item">
                                <div class="nearby-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="nearby-info">
                                    <h4>{{ $loc }}</h4>
                                </div>
                            </div>
                        @endif

                    @endforeach
                @else

                    <div class="nearby-item">
                        <div class="nearby-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="nearby-info">
                            <h4>{{ $locations }}</h4>
                        </div>
                    </div>

                @endif

            @endif

        @endforeach

    @else
        <p class="text-muted">No nearby locations specified.</p>
    @endif
</div>
                </div>

                <!-- Popular Searches -->
                <div class="details-section">
                    <h2 class="section-title"><i class="fas fa-search"></i> Popular Searches</h2>
                    <div class="popular-searches">
                        <a href="#" class="search-tag">Flats for sale in {{ $v->city }}</a>
                        <a href="#" class="search-tag">{{ $select_bhk }} BHK in {{ $v->city }}</a>
                        <a href="#" class="search-tag">Residential Projects in {{ $v->localities }}</a>
                        <a href="#" class="search-tag">{{ $title }} Price</a>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="content-sidebar">
                <div id="enquire" class="sidebar-card">
                    <h3 class="mb-3">Express Interest</h3>
                    <form method="POST" id="consult-form" action="{{ route('enquiry.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group">
                                            <input class="form-control" name="name" id="name" type="text" placeholder="Name *" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="contact" class="form-control" placeholder="Phone *" required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="email" id="email" type="email" placeholder="Email *" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" rows="5" placeholder="Message *" required></textarea>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary btn-md rounded full-width" type="submit">Send Message</button>
                                        </div>
                                        
                                    </div>
                                </form>
                    <div id="thank-you-message" style="display: none;" class="alert alert-success mt-3">Thank you! Your message has been submitted.</div>

                    <div class="mt-3 pt-3 border-top"> 
                        <h4 class="mb-2">Project Status</h4>
                        <div class="d-flex justify-content-between mb-1" style="font-size: 0.85rem;">
                            <span>Posted On:</span>
                            <span class="fw-bold">{{ \Carbon\Carbon::parse($v->created_at)->format('M d, Y') }}</span>
                        </div>

                        <button class="btn-brochure mt-2" id="downloadBrochureBtn" onclick="openEnquiryModal()">
                            <i class="fas fa-download"></i> Download Brochure
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- //thank you popup -->
        <div class="popup-overlay" id="popupOverlay"></div>
        <div class="pop-up" id="popup">
            <i class="fa-solid fa-circle-check"></i>
            <h2>Thank You!</h2>
            <p>Our Team will reach out to you shortly.</p>
            <button type="button" onclick="closePopup()">OK</button>
        </div>

        <!-- //brouchure modal -->
        <div id="modalBackdrop" class="modal-backdrop" onclick="closeEnquiryModal()"></div>
        <div class="modal" id="enquiryModal">
            <div class="modal-content-prop">
                <div class="modal-header-prop">
                <div class="modal-header-title">
                    <h2>Download Brochure</h2>
                    <p>Please enter your details to download the brochure.</p>
                </div>
                <div class="modal-close-prop">
                    <span class="close-btn" onclick="closeEnquiryModal()">X</span>
                </div>
                </div>
                <div class="modal-body">
                    <form id="enquiryForm" class="enquiry-form">
                        <!-- Laravel CSRF -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="text" name="contact" placeholder="Phone" required>
                        <input type="email" name="email" placeholder="Your Email" required>
                        <input type="hidden" name="enquiry_type" value="brochure">
                        <button type="submit">Download Now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- //visit form -->
        <div class="form-container">
            <!-- <div class="form-header"> -->
                <div class="form-header-title">
                    <h1>Book a Visit</h1>
                    <p>Fill out the form below to schedule your visit</p>
                </div>
                <button class="close-btn visit-close" onclick="closeFormOverlay()">X</button>
            <!-- </div> -->
            <form id="visitForm" method="POST" action="{{ route('visit.enquiry.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="name">
                        Name <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required 
                        placeholder="Enter your full name"
                    >
                </div>
    
                <div class="form-group">
                    <label for="email">
                        Email 
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="your.email@example.com"
                    >
                </div>
    
                <div class="form-group">
    <label for="phone">
        Phone Number <span class="required">*</span>
    </label>
    <input 
        type="tel" 
        id="phone" 
        name="phone" 
        required 
        placeholder="Enter 10 digit mobile number"
        pattern="[0-9]{10}" 
        maxlength="10"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    >
</div>
    
                <div class="form-group">
                    <label>
                        Visit Date <span class="required">*</span>
                    </label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input 
                                type="radio" 
                                name="visitedate" 
                                value="this week" 
                                required
                            >
                            <span class="radio-label">This Week</span>
                        </label>
                        <label class="radio-option">
                            <input 
                                type="radio" 
                                name="visitedate" 
                                value="this weekend" 
                                required
                            >
                            <span class="radio-label">This Weekend</span>
                        </label>
                        <label class="radio-option">
                            <input 
                                type="radio" 
                                name="visitedate" 
                                value="this month" 
                                required
                            >
                            <span class="radio-label">This Month</span>
                        </label>
                    </div>
                </div>
    
                <button type="submit" class="submit-btn" onclick="closeFormOverlay()">
                    Book Visit
                </button>
            </form>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var lat = {{ !empty($latitude) ? $latitude : 18.5204 }};
        var lng = {{ !empty($longitude) ? $longitude : 73.8567 }};
        
        if (typeof L !== 'undefined') {
            var map = L.map('map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup('{{ addslashes($title) }}').openPopup();
            
            // Fix for map not rendering correctly in some containers
            setTimeout(function() {
                map.invalidateSize();
            }, 500);
        }
    });
</script> -->
<script>document.addEventListener('DOMContentLoaded', function () {

    const images = [
        "{{ asset($data['main_image']) }}",
        ...@json(
            collect($data['additional_images'])
                ->pluck('image_url')
                ->map(fn($img) => asset($img))
        )
    ];

    let currentIndex = 0;

    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail');

    function updateGallery(index) {
        currentIndex = index;
        mainImage.src = images[currentIndex];

        thumbnails.forEach((thumb, i) => {
            thumb.classList.toggle('active', i === currentIndex);
        });
    }

    // 👇 GLOBAL FUNCTIONS (IMPORTANT)
    window.nextImage = function () {
        updateGallery((currentIndex + 1) % images.length);
    };

    window.prevImage = function () {
        updateGallery((currentIndex - 1 + images.length) % images.length);
    };

    window.setImage = function (index) {
        updateGallery(index);
    };

});</script>
<script>
 const images = [
    "{{ asset($data['main_image']) }}",
    ...@json(
        collect($data['additional_images'])
            ->pluck('image_url')
            ->map(fn($img) => asset($img))
    )
];

    let currentIndex = 0;

    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail');

    function updateGallery(index) {
        currentIndex = index;
        mainImage.src = images[currentIndex];

        thumbnails.forEach((thumb, i) => {
            thumb.classList.toggle('active', i === currentIndex);
        });
    }

    function nextImage() {
        updateGallery((currentIndex + 1) % images.length);
    }

    function prevImage() {
        updateGallery(
            (currentIndex - 1 + images.length) % images.length
        );
    }

    function setImage(index) {
        updateGallery(index);
    }
</script>


<script>
    $(document).ready(function () {
        $('#consult-form').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: "{{ route('enquiry.store') }}", // The route for submission
                method: "POST",
                data: $(this).serialize(), // Serialize form data
                success: function (response) {
                    if(response.status){
                        $('#popup').css('visibility', 'visible');
                        $('#popupOverlay').fadeIn();
                        document.getElementById("mainwrapper").classList.add("blur");

                    }
                    // Show the thank-you message and clear the form
                    // $('#thank-you-message').fadeIn();
                    $('#consult-form')[0].reset();

                    // Hide the thank-you message after 5 seconds (optional)
                    setTimeout(function () {
                        // $('#thank-you-message').fadeOut();
                    }, 5000);
                },
                error: function (xhr) {
                    // Handle errors (optional)
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
</script>
<script>


$(document).ready(function () {

const brochureUrl = "{{ $boucher }}";

        $('#enquiryForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: "{{ route('enquiry.store') }}", // The route for submission
                method: "POST",
                data: $(this).serialize(), // Serialize form data
                success: function (response) {
                    if(response.status){
                        /* $('#popup').css('visibility', 'visible');
                        $('#popupOverlay').fadeIn();
                        document.getElementById("mainwrapper").classList.add("blur"); */
                        console.log('Brochure download initiated.');
                        document.getElementById('enquiryModal').style.visibility = 'hidden';
                        document.getElementById('modalBackdrop').style.display = 'none';
                        const link = document.createElement('a');
                        link.href = brochureUrl;
                        link.download = '';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                    // Show the thank-you message and clear the form
                    /* // $('#thank-you-message').fadeIn(); */
                    $('#enquiryForm')[0].reset();

                    // Hide the thank-you message after 5 seconds (optional)
                    /* setTimeout(function () {
                        // $('#thank-you-message').fadeOut();
                    }, 5000); */
                },
                error: function (xhr) {
                    // Handle errors (optional)
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
</script>

<script>
$(document).ready(function () {

    $('#visitForm').on('submit', function (e) {
        e.preventDefault();

        // $('#submitBtn').prop('disabled', true);
        // $('#formError').hide().html('');
        // $('#formSuccess').hide().html('');

        $.ajax({
            url: "{{ route('visit.enquiry.submit') }}",
            type: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.status){
                        $('#popup').css('visibility', 'visible');
                        $('#popupOverlay').fadeIn();
                        document.getElementById("mainwrapper").classList.add("blur");
                    }
                // $('#formSuccess')
                //     .show()
                //     .html('Visit enquiry submitted successfully!');

                $('#visitForm')[0].reset();
            },
            error: function (xhr) {
                $('#submitBtn').prop('disabled', false);

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';

                    $.each(errors, function (key, value) {
                        errorMsg += value[0] + '<br>';
                    });

                    $('#formError').show().html(errorMsg);
                } else {
                    $('#formError').show().html('Something went wrong. Please try again.');
                }
            }
        });
    });

});
</script>


<script>
    function closePopup(){
        document.getElementById("popup").style.visibility = "hidden";
        document.getElementById("popupOverlay").style.display = "none";
        document.getElementById("mainwrapper").classList.remove("blur");
    }
    function openEnquiryModal() {
        document.getElementById('enquiryModal').style.visibility = 'visible';
        document.getElementById('modalBackdrop').style.display = 'block';
    }
    function closeEnquiryModal() {
        document.getElementById('enquiryModal').style.visibility = 'hidden';
        document.getElementById('modalBackdrop').style.display = 'none';
    }   
    function openFormOverlay() {
        document.querySelector('.form-container').style.visibility = 'visible';
        // document.querySelector('.form-container-overlay').style.display = 'block';
        document.getElementById("mainwrapper").classList.add("blur");
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
    function closeFormOverlay() {
        document.querySelector('.form-container').style.visibility = 'hidden';
        document.body.style.overflow = ''; // Restore background scrolling
        document.getElementById("mainwrapper").classList.remove("blur");

    }
</script>


<?php } ?>
@include('dhara-jfin.layout.footer')
