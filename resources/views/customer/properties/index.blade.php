@extends('frontend.layouts.customer-dash')

@section('content')
@php
    function formatPrice($price) {
        if ($price >= 10000000) return '₹' . round($price / 10000000, 2) . ' Cr';
        if ($price >= 100000) return '₹' . round($price / 100000, 2) . ' L';
        return '₹' . number_format($price);
    }
@endphp
<style>
   .properties-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 20px;
}
        .property-card {
            display:flex;
            flex-direction: column;
            height: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }
        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(21, 101, 192, 0.25);
        }
        .property-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: transform 0.4s ease;
            position: relative;
        }
        .property-card:hover .property-image {
            transform: scale(1.08);
        }
        .image-container {
            overflow: hidden;
            position: relative;
            background: #f0f0f0;
        }
        .property-details {
            padding: 24px;
            display: flex;
    flex-direction: column;
    flex: 1;
        }
        .property-name-grid{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

        }
        .builder-name {
            color: #0e4ca7;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        /* .builder-icon {
            width: 30px;
            height: 30px;
            background: #E3F2FD;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            
        } */

        .location {
            color: #666;
            font-size: 13px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .property-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-top: 1px solid #E3F2FD;
            border-bottom: 1px solid #E3F2FD;
            margin-bottom: 20px;
        }

        .property-title{
            display: flex;
            align-items: center;
            gap:8px;
            color:#1565C0;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: auto;
        }

        .info-item {
            text-align: center;
            flex: 1;
        }

        .info-label {
            color: #999;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .price-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .price {
            white-space: nowrap;
            color: #0e4ca7;
            font-size: 26px;
            font-weight: 800;
            background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        }

        .emi-info {
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        .emi-amount {
            color: #43A047;
            font-weight: 600;
            font-size: 14px;
            display: block;
        }

        .book-button {
            margin-top: auto;
            text-align:center;
            width: 100%;
            background: linear-gradient(135deg, #1565C0 0%, #0D47A1 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(21, 101, 192, 0.3);
        }
        
        .book-button:hover {
            color: white;
            text-decoration: none;
            background: linear-gradient(135deg, #0D47A1 0%, #1565C0 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(21, 101, 192, 0.4);
        }

        .property-card:hover .book-button {
            animation: pulse 1.5s infinite;
        }

        /* Search and Filter Section */
        .search-filter-section {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-bottom: 3rem;
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
        .apply-btn {
            background: linear-gradient(135deg, #1565C0 0%, #0D47A1 100%);
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
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 15px rgba(21, 101, 192, 0.3);
            }
            50% {
                box-shadow: 0 6px 25px rgba(21, 101, 192, 0.5);
            }
        }
        @media (max-width: 480px) {
            .properties-grid {
                grid-template-columns: 1fr;
            }
}
</style>

<h2 style="color:#1565C0; padding-left:10px;">Available Properties</h2>

@if(session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif
       <div class="search-filter-section">

    <!-- SEARCH -->
    <div class="search-bar-wrapper">
        <div class="search-input-group">
            <span class="search-icon">🔍</span>
            <input 
                type="text"
                id="propertySearch"
                class="form-control"
                placeholder="Search by locality, project name or developer..."
            >
        </div>
    </div>

    <!-- FILTERS -->
    <div class="main-filters">
        <!-- PROPERTY TYPE -->
<div class="filter-group">
    <label>Property Type</label>
    <select id="typeFilter" class="filter-select">
        <option value="">All Types</option>
        <option value="residential apartment">Residential Apartment</option>
        <option value="villa">Villa / Independent House</option>
        <option value="penthouse">Penthouse</option>
        <option value="plot">Plot / Land</option>
    </select>
</div>


        <!-- BHK FILTER -->
        <div class="filter-group">
            <label>BHK Type</label>
           <select id="bhkFilter" class="filter-select">
    <option value="">Any BHK</option>
    <option value="1">1 BHK</option>
    <option value="2">2 BHK</option>
    <option value="3">3 BHK</option>
    <option value="4">4 BHK</option>
    <option value="5">5 BHK</option>
    <option value="6">6 BHK</option>
</select>

        </div>
        

        <!-- BUDGET FILTER -->
        <div class="filter-group">
            <label>Budget Range</label>
            <select id="budgetFilter" class="filter-select">
                <option value="">Any Budget</option>
                <option value="0-4000000">Below ₹40L</option>
                <option value="4000000-6000000">₹40L - ₹60L</option>
                <option value="6000000-8000000">₹60L - ₹80L</option>
                <option value="8000000-10000000">₹80L - ₹1Cr</option>
                <option value="10000000-999999999">Above ₹1Cr</option>
            </select>
        </div>

    </div>
</div>

    

<div class="properties-grid">

@foreach($properties as $property)

   <div class="property-card"
    data-search="{{ strtolower($property->builder_name.' '.$property->title.' '.$property->address) }}"
    data-bhk="{{ $property->select_bhk }}"
    data-price="{{ $property->s_price }}"
    data-type="{{ strtolower($property->land_type) }}"
>

        <div class="image-container">
                   <img src="{{ $property->image ? asset($property->image) : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6' }}" 
     class="property-image">


        </div>
        <div class="property-details">
                <div class="property-name-grid">
                    <div class="builder-name">
                        <span class="builder-icon"><i class="fa fa-building"></i></span>
                        {{ $property->builder_name }}
                    </div>
                    <div class="price-section">
                        <div class="price"> {{ formatPrice($property->s_price) }}</div>
                    </div>
                </div>
                <div class="property-title">
                        <span class="builder-icon"><i class="fa fa-map-pin"></i></span>
                        {{ $property->title }}
                    </div>
                <div class="location">
                        {{ $property->address }}
                </div>
                <div>
                    <div class="property-info">
                        <div class="info-item">
                            <div class="info-label">BHK</div>
                            <div class="info-value">{{ $property->select_bhk ?? 'NA' }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Area</div>
                            <div class="info-value">{{ $property->area }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">Type</div>
                            <div class="info-value">{{ $property->land_type }}</div>
                        </div>
                    </div>
                    
                </div>
                    <a href="{{ route('customer.property.book.form', $property->properties_id) }}" class="book-button">
                        Book Property
                    </a>
                </div>
            </div>
@endforeach
        </div>
</div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput  = document.getElementById('propertySearch');
    const bhkFilter    = document.getElementById('bhkFilter');
    const budgetFilter = document.getElementById('budgetFilter');
    const typeFilter   = document.getElementById('typeFilter');
    const cards        = document.querySelectorAll('.property-card');

    function applyFilters() {

        let searchVal = searchInput.value.toLowerCase();
        let bhkVal    = bhkFilter.value;
        let typeVal   = typeFilter.value;
        let budgetVal = budgetFilter.value;

        let minPrice = 0, maxPrice = Infinity;
        if (budgetVal) {
            [minPrice, maxPrice] = budgetVal.split('-').map(Number);
        }

        cards.forEach(card => {

            let text  = card.dataset.search;
            let bhk   = card.dataset.bhk;
            let price = parseInt(card.dataset.price);
            let type  = card.dataset.type;

            let matchSearch = text.includes(searchVal);
           let matchBhk = !bhkVal || parseInt(bhk) === parseInt(bhkVal);
            let matchBudget = price >= minPrice && price <= maxPrice;
            let matchType   = !typeVal || type.includes(typeVal);

            card.style.display =
                matchSearch && matchBhk && matchBudget && matchType
                ? 'flex'
                : 'none';
        });
    }

    searchInput.addEventListener('keyup', applyFilters);
    bhkFilter.addEventListener('change', applyFilters);
    budgetFilter.addEventListener('change', applyFilters);
    typeFilter.addEventListener('change', applyFilters);
});
</script>



@endsection
