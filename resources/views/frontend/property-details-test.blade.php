@extends('frontend.layouts.header')
@section('title', "Properties Details - Jfinserv")
@section('description', "")
@section('keywords', "")

@section('content')
<?php 
    
        foreach($data['propertie_details'] as $v) {  
            $price_range = $v->from_price. " to ". $v->to_price;
            $img = env('baseURL'). "/".$v->image; $boucher = env('baseURL'). "/".$v->boucher;  $address = $v->localities.", ".$v->city; $area = $v->area; $rera = $v->rera; $category = $v->category_name;  $latitude = $v->latitude; $longitude = $v->longitude; $s_price = $v->s_price; $category = $v->category_name;  $land_type = $v->land_type; $builder_name = $v->builder_name; $facilities = $v->facilities; $title = $v->title; $created_at = $v->created_at; $beds = $v->beds; $baths = $v->baths; $balconies = $v->balconies; $parking = $v->parking; $builtup_area =$v->builtup_area; $nearby_locations = json_decode($v->nearby_locations, true);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<div class="container-fluid bg-breadcrumb" style="background: url(../theme/frontend/img/prop-2.jpg);">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{$title}}</h4>

    </div>
</div>
<!-- Details Start -->
    <div class="container-fluid bg-light about">
        <div class="container mt-5 mb-5 pb-5">
            <div class="row g-5 text-display" style="font-family: 'DM Sans';">
                <div class="col-xl-9 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-4 mt-3">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne">
                                        <div class="block-body">
                                            <p><span class="prop-type">{{ $category }}</span></p>
                                            <h2><strong>{{ $v->select_bhk }} BHK Flat for Sale</strong></h2>
                                            <p class="mb-0"><i class="fa-duotone fa-solid fa-location-dot"></i> {{ $address }}</p>
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <h4 class="prt-price-fix">₹{{ number_format($s_price, 0, '.', ',') }}</h4> 
                                                </div>
                                                <div class="col-md-6 mt-5">
                                                    <ul class="d-inline-flex p-0 m-0 text-dark float-end" style="list-style: none;">
                                                        <li class="px-2 border-end border-2 border-dark"><i class="fas fa-bed  text-muted"></i> <strong>{{ $beds}}</strong> Beds</li>
                                                        <li class="px-2 border-end border-2 border-dark"><i class="fas fa-bath  text-muted"></i> <strong>{{ $baths}}</strong> Baths</li>
                                                        <li class="px-2 border-end border-2 border-dark"><i class="fas fa-border-none  text-muted"></i> <strong>{{ $balconies}}</strong> Balconies</li>
                                                        <li class="px-2"><i class="fas fa-car  text-muted"></i> <strong>{{ $parking }}</strong> Parkings</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-item-content bg-white rounded p-3 mt-3">
                        <!-- <p><small>Posted On: {{ \Carbon\Carbon::parse($v->created_at)->format('M d, Y') }}<span class="float-end">Rera No. : {{$rera}}</span> </small> -->
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="rounded">
                                    <img src="{{ $img }}" class="img-fluid rounded" alt="Property Image" style="width: 100%; height: 450px; object-fit: cover; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">
                                </div>
                                <ul class="d-inline-flex p-0 mt-2" style="list-style: none;">
                                    <li><img src="https://housing-images.n7net.in/4f2250e8/bf5048809763fdb490e4c4ad51134884/v0/large/f_premium-tathawade_chinchwad-pune-aishwaryam_group.jpeg" class="img-fluid rounded w-100" alt=""></li>
                                    <li class="px-2"><img src="https://housing-images.n7net.in/4f2250e8/bf5048809763fdb490e4c4ad51134884/v0/large/f_premium-tathawade_chinchwad-pune-aishwaryam_group.jpeg" class="img-fluid rounded w-100" alt=""></li>
                                    <li><img src="https://housing-images.n7net.in/4f2250e8/bf5048809763fdb490e4c4ad51134884/v0/large/f_premium-tathawade_chinchwad-pune-aishwaryam_group.jpeg" class="img-fluid rounded w-100" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-4 mt-3">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="property_block_wrap style-2">
                                    <div class="property_block_wrap_header">
                                        <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne" aria-controls="clOne" href="javascript:void(0);" aria-expanded="true">
                                            <h4 class="property_block_title">
                                                Property Details
                                                <span class="float-end">
                                                    <i class="bi bi-chevron-down collapse-icon" data-bs-toggle="collapse-icon" aria-expanded="true"></i>
                                                </span>
                                            </h4>
                                        </a>
                                    </div>
                                    <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne">
                                        <div class="block-body">
                                            <ul class="detail_features">
                                                <li><strong>Carpet Area:</strong> {{$area}} sqft</li>
                                                <li><strong>Builtup Area:</strong> {{$builtup_area}} /sqft</li>
                                                <li><strong>Floor:</strong> 10/16</li>
                                                <li><strong>Bedrooms:</strong> {{$beds}}</li>
                                                <li><strong>Bathrooms:</strong> {{$baths}}</li>
                                                <li><strong>Parking:</strong> {{$parking}}</li>
                                                <li><strong>Property Type:</strong> {{$land_type}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-4 mt-3">
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
                                            <p>Indulge in a lifestyle of unparalleled sophistication at The Emperor’s Club. With over 30 superlative amenities meticulously curated for your pleasure, revel in the spacious layouts boasting zero space wastage, ensuring every inch of your domain is adorned with magnificence. From the opulent interiors to the expansive windows inviting ample sunlight and refreshing cross ventilation, each residence is crafted to elevate your living experience to celestial heights.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-item-content bg-white rounded p-3 mt-3">
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

                    <div class="about-item-content bg-white rounded p-4 mt-3">
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
                                                <ul class="detail_features">
                                                    @foreach($nearby_locations as $location)
                                                        @if(!empty($location))
                                                            <li>
                                                                <i class="fa-solid fa-square-check text-success me-2"></i> {{ $location }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-3">
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
                    <div class="bg-white rounded p-3 mt-3">
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