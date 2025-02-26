@extends('frontend.layouts.header')
@section('title', "Properties Details - Jfinserv")
@section('description', "")
@section('keywords', "")

@section('link', "https://cdn.jsdelivr.net/npm/@splidejs/splide@1.2.0/dist/css/splide.min.css")
@section('scripts', "https://cdn.jsdelivr.net/npm/@splidejs/splide@1.2.0/dist/js/splide.min.js")

@section('content')
<?php     
    foreach($data['propertie_details'] as $v) {  
        $price_range = $v->from_price. " to ". $v->to_price;
        $img = env('baseURL'). "/".$v->image; $boucher = env('baseURL'). "/".$v->boucher;  $address = $v->localities.", ".$v->city; $area = $v->area; $rera = $v->rera; $category = $v->category_name;  $latitude = $v->latitude; $longitude = $v->longitude; $s_price = $v->s_price; $category = $v->category_name;  $land_type = $v->land_type; $builder_name = $v->builder_name; $facilities = $v->facilities; $title = $v->title; $created_at = $v->created_at; $beds = $v->beds; $baths = $v->baths; $balconies = $v->balconies; $parking = $v->parking; $builtup_area =$v->builtup_area; $nearby_locations = json_decode($v->nearby_locations, true); $property_details = $v->property_details;
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<!-- Details Start -->
    <div class="container-fluid about">
        <div class="container mb-5 pt-3 pb-5">
            <div class="row text-display" style="font-family: 'DM Sans';">
                <p><a href="{{ url('/') }}">Home</a> > <a href="{{ url('properties')}}">Properties</a> > {{ $v->title }}</p>
                <div class="col-xl-9 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content">
                        <!-- <p><small>Posted On: {{ \Carbon\Carbon::parse($v->created_at)->format('M d, Y') }}<span class="float-end">Rera No. : {{$rera}}</span> </small> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="thumbnail_slider shadow-sm">
                                    <!-- Primary Slider Start-->
                                    <div id="primary_slider">
                                        @if($data['additional_images']->isNotEmpty())
                                            <div class="splide__track">
                                                <ul class="splide__list">
                                                    @foreach($data['additional_images'] as $image)
                                                        <li class="splide__slide">
                                                            <img src="{{ asset($image->image_url) }}" class="img-fluid rounded w-100" alt="Additional Property Image">
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Primary Slider End-->
                                    <!-- Thumbnal Slider Start-->
                                    <div id="thumbnail_slider">
                                        @if($data['additional_images']->isNotEmpty())
                                            <div class="splide__track">
                                                <ul class="splide__list">
                                                    @foreach($data['additional_images'] as $image)
                                                        <li class="splide__slide">
                                                            <img src="{{ asset($image->image_url) }}" class="img-fluid rounded w-100" alt="Additional Property Image">
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Thumbnal Slider End-->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2 bg-white rounded-bottom p-4 shadow-sm">
                                    <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne">
                                        <div class="block-body">
                                            <div class="row mt-3">
                                                <div class="col-md-8">
                                                    <!-- <p><span class="prop-type">{{ $category }}</span></p> -->
                                                    <p class="h5 mb-0 text-capitalize"><i class="far fa-building fa-1x"></i> By {{ $builder_name }} <span class="rera"><i class="far fa-check-circle" style="color: #f74400;"></i> RERA</span></h4>
                                                    <p class="mb-0"><i class="fa-duotone fa-solid fa-location-dot fa-1x"></i> {{ $address }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="float-end mb-1">Last Updated: {{ \Carbon\Carbon::parse($v->created_at)->format('M d, Y') }}</p>
                                                    <h4 class="prt-price-fix float-end">₹{{ number_format($s_price, 0, '.', ',') }}* Onwards</h4> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-4 mt-3 shadow-sm">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div class="property_block_wrap_header">
                                        <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clTwo" aria-controls="clTwo" href="javascript:void(0);" aria-expanded="true">
                                            <h4 class="property_block_title">
                                                Property Details
                                                <span class="float-end">
                                                    <i class="bi bi-chevron-down collapse-icon" data-bs-toggle="collapse-icon" aria-expanded="true"></i>
                                                </span>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="clTwo" class="panel-collapse collapse show" aria-labelledby="clTwo">
                                        <div class="block-body">
                                            <div class="row g-3">  <!-- Added Bootstrap's gutter spacing -->
                                                @if(!empty($area))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Carpet Area:</strong> {{$area}} sqft
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($builtup_area))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Builtup Area:</strong> {{$builtup_area}} sqft
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($floor))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Floor:</strong> {{$floor}}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($beds))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Bedrooms:</strong> {{$beds}}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($baths))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Bathrooms:</strong> {{$baths}}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($balconies))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Balconies:</strong> {{$balconies}}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($parking))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Parking:</strong> {{$parking}}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(!empty($land_type))
                                                    <div class="col-md-4">
                                                        <div class="card p-3 border rounded shadow-sm">
                                                            <strong>Property Type:</strong> {{$land_type}}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-4 mt-3 shadow-sm">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div class="property_block_wrap_header">
                                        <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne2" aria-controls="clOne2" href="javascript:void(0);" aria-expanded="true">
                                            <h4 class="property_block_title">
                                                Description
                                                <span class="float-end">
                                                    <i class="bi bi-chevron-down collapse-icon" data-bs-toggle="collapse-icon" aria-expanded="true"></i>
                                                </span>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="clOne2" class="panel-collapse collapse show" aria-labelledby="clOne2">
                                        <div class="block-body">
                                            <p>{{ $property_details }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-4 mt-3 shadow-sm">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div class="property_block_wrap_header">
                                        <a data-bs-toggle="collapse" data-parent="#amenities" data-bs-target="#clOne5" aria-controls="clOne5" href="javascript:void(0);" aria-expanded="true">
                                            <h4 class="property_block_title">
                                                Amenities of {{ $v->title }}
                                                <span class="float-end">
                                                    <i class="bi bi-chevron-down collapse-icon" data-bs-toggle="collapse-icon" aria-expanded="true"></i>
                                                </span>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="clOne5" class="panel-collapse collapse show" aria-labelledby="clOne5">
                                        <div class="block-body">
                                            @if(isset($facilities) && !empty($facilities))
                                                @php
                                                    $facilitiesArray = explode(',', $facilities); // Convert string to array

                                                    // Define SVG icon paths for each facility
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
                                                        'Spa & Massage' => 'theme/frontend/img/icons/spa.svg'
                                                    ];
                                                @endphp

                                                <div class="row">
                                                    @foreach($facilitiesArray as $facility)
                                                        @php 
                                                            $facility = trim($facility); // Remove extra spaces
                                                            $iconPath = $icons[$facility] ?? 'theme/frontend/img/icons/default.svg'; // Default icon
                                                        @endphp
                                                        <div class="col-md-3 col-sm-6 mb-3">
                                                            <div class="d-flex align-items-center border p-3 rounded">
                                                                <img src="{{ asset($iconPath) }}" alt="{{ $facility }}" class="me-2" width="34" height="34"> 
                                                                <span>{{ $facility }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>No amenities available.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-3 mt-3 shadow-sm">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div class="property_block_wrap_header">
                                        <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne3" aria-controls="clOne3" href="javascript:void(0);" aria-expanded="true">
                                            <h4 class="property_block_title">Location</h4>
                                        </a>
                                    </div>
                                    <div id="clOne3" class="panel-collapse collapse show">
                                        <div class="block-body">
                                            <!-- Map container -->
                                            <div id="map" style="width: 100%; height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    

                    <div class="about-item-content bg-white rounded p-4 mt-3 shadow-sm">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div class="property_block_wrap_header">
                                        <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne4" aria-controls="clOne4" href="javascript:void(0);" aria-expanded="{{ (is_array($nearby_locations) && count($nearby_locations) > 0) ? 'true' : 'false' }}">
                                            <h4 class="property_block_title">
                                                Near By Locations
                                                <span class="float-end">
                                                    <i class="bi bi-chevron-down collapse-icon" data-bs-toggle="collapse-icon" aria-expanded="{{ (is_array($nearby_locations) && count($nearby_locations) > 0) ? 'true' : 'false' }}"></i>
                                                </span>
                                                <i class="fa-sharp fa-solid fa-badge-check"></i>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="clOne4" class="panel-collapse collapse show" aria-labelledby="clOne4">
                                        <div class="block-body">
                                            @if($nearby_locations && count($nearby_locations) > 0)
                                                <div class="row g-3">  <!-- Bootstrap Grid for Proper Spacing -->
                                                    @foreach($nearby_locations as $location)
                                                        @if(!empty($location))
                                                            <div class="col-md-4">
                                                                <i class="fas fa-location text-success me-2"></i>
                                                                <span>{{ $location }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded border p-3 shadow-sm">
                        <div class="row g-4 justify-content-center">
                            <div class="sides-widget">
                                <div class="sides-widget-header">
                                    <div class="agent-photo">
                                        <img src="{{ asset('theme/frontend/img/contact-avatar.png') }}" alt="Jfinmate">
                                        
                                    </div>
                                    <div class="sides-widget-details">
                                        <h4>{{$builder_name}}</h4>
                                        <!-- <a href="tel:+17817548182"><span><i class="lni-phone-handset"></i> +17817548182</span></a> -->
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="sides-widget-body simple-form">
                                    <form method="POST" id="consult-form">
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
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-md rounded full-width" type="submit">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="thank-you-message" style="display: none;" class="alert alert-success mt-3">Thank you! Your message has been submitted.</div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="bg-white rounded p-3 mt-3 shadow-sm">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12 text-center">
                                    <!-- Brochure Box with Image -->
                                    <div class="brochure-box bg-light rounded mb-3">
                                        <img src="{{ asset('theme/frontend/img/broucher-img.png') }}" alt="Brochure Thumbnail" class="img-fluid w-100">
                                    </div>

                                    <!-- Separate Download Button -->
                                    <a href="javascript:void(0);" id="downloadBrochureBtn" class="btn btn-primary mt-2">
                                        <i class="fas fa-download"></i> Download Brochure
                                    </a>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Image Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <img src="{{ $img }}" class="img-fluid w-100" alt="Property Image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal for Enquiry -->
            <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="enquiryForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="enquiryModalLabel">Enter Your Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contact" class="form-label">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" required>
                                </div>
                                <input type="hidden" name="enquiry_type" value="brochure">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit & Download</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?> 
    </div>

    <script type="text/javascript">
    // Primary slider.
        var primarySlider = new Splide('#primary_slider', {
            type: 'fade',
            heightRatio: 0.5,
            pagination: false,
            arrows: false,
            cover: true,
        });

        // Thumbnails slider.
        var thumbnailSlider = new Splide('#thumbnail_slider', {
            rewind: true,
            fixedWidth: 100,
            fixedHeight: 64,
            isNavigation: true,
            gap: 10,
            focus: 'left',
            pagination: false,
            cover: true,
            breakpoints: {
                '600': {
                    fixedWidth: 66,
                    fixedHeight: 40,
                }
            }
        }).mount();

        // sync the thumbnails slider as a target of primary slider.
        primarySlider.sync(thumbnailSlider).mount();
    </script>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Fetch latitude and longitude from PHP variables
        var latitude = {{ $latitude }};
        var longitude = {{ $longitude }};

        // Initialize the Leaflet map with the fetched latitude and longitude
        var map = L.map('map').setView([latitude, longitude], 14);

        // Set the tile layer using OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker at the fetched location
        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Location')
            .openPopup();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#consult-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: "{{ route('enquiry.store') }}", // The route for submission
                    method: "POST",
                    data: $(this).serialize(), // Serialize form data
                    success: function (response) {
                        // Show the thank-you message and clear the form
                        $('#thank-you-message').fadeIn();
                        $('#consult-form')[0].reset();

                        // Hide the thank-you message after 5 seconds (optional)
                        setTimeout(function () {
                            $('#thank-you-message').fadeOut();
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
        document.addEventListener('DOMContentLoaded', function () {
    const brochureUrl = "{{ $boucher }}";

    document.getElementById('downloadBrochureBtn').addEventListener('click', function () {
        const enquiryModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
        enquiryModal.show();
    });

    document.getElementById('enquiryForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = e.target;

        fetch("{{ route('enquiry.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({
                name: form.name.value,
                email: form.email.value,
                contact: form.contact.value,
                enquiry_type: form.enquiry_type.value,
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Thank you! Your enquiry has been submitted.');
                    const enquiryModal = bootstrap.Modal.getInstance(document.getElementById('enquiryModal'));
                    enquiryModal.hide();

                    // Initiate file download
                    const link = document.createElement('a');
                    link.href = brochureUrl;
                    link.download = '';
                    link.click();
                } else {
                    alert('Something went wrong. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    });
});
</script>
    
@endsection