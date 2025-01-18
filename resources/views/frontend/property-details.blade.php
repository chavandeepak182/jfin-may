@extends('frontend.layouts.header')
@section('title', "Properties Details - Jfinserv")
@section('description', "")
@section('keywords', "")

@section('content')
<?php 
    
        foreach($data['propertie_details'] as $v) {  
            $price_range = $v->from_price. " to ". $v->to_price;
            $img = env('baseURL'). "/".$v->image; $boucher = env('baseURL'). "/".$v->boucher;  $address = $v->localities.", ".$v->city; $area = $v->area; $category = $v->category_name;  $builder_name = $v->builder_name; $facilities = $v->facilities; $title = $v->title; $created_at = $v->created_at; $beds = $v->beds; $baths = $v->baths; $balconies = $v->balconies; $parking = $v->parking;
       
?>
<div class="container-fluid bg-breadcrumb" style="background: url(../theme/frontend/img/prop-2.jpg);">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{$title}}</h4>
            <!-- <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a class="text-primary" href="/">Home</a></li>
                <li class="breadcrumb-item active text-primary">About Us</li>
            </ol>     -->
        </div>
    </div>
<!-- Details Start -->
    <div class="container-fluid bg-light about">
    
        <div class="container mt-5 mb-5 pb-5">
            <div class="row g-5 text-display" style="font-family: 'DM Sans';">
                <div class="col-xl-9 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5">
                        <p><small>Posted On: {{ \Carbon\Carbon::parse($v->created_at)->format('M d, Y') }} <span class="float-end">Property ID: 74438353</span></small>
                        <h5><span class="text-primary">₹ {{ $v->from_price }}</span><span class="px-2"></span><a class="text-muted" href="/emi-calculator" target="_blank"><small><u>EMI - ₹ 85k</u><span class="px-3">|</span><a class="text-muted" data-bs-toggle="modal" data-bs-target="#searchModal" href="#"><u>For more enquiry</u></small></a></h5>
                        <h4 class="mb-4">{{ $v->select_bhk }} BHK Flat for Sale in {{ $v->title }}, {{ $address }}</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                            <div class="rounded bg-light">
                                <img src="{{ $img }}" 
                                    class="img-fluid rounded" 
                                    alt="Property Image" 
                                    style="width: 450px; height: 250px; object-fit: cover; cursor: pointer;" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#imageModal">
                            </div>
                                <ul class="d-inline-flex p-0 mt-2" style="list-style: none;">
                                    <li><img src="https://housing-images.n7net.in/4f2250e8/bf5048809763fdb490e4c4ad51134884/v0/large/f_premium-tathawade_chinchwad-pune-aishwaryam_group.jpeg" class="img-fluid rounded w-100" alt=""></li>
                                    <li class="px-2"><img src="https://housing-images.n7net.in/4f2250e8/bf5048809763fdb490e4c4ad51134884/v0/large/f_premium-tathawade_chinchwad-pune-aishwaryam_group.jpeg" class="img-fluid rounded w-100" alt=""></li>
                                    <li><img src="https://housing-images.n7net.in/4f2250e8/bf5048809763fdb490e4c4ad51134884/v0/large/f_premium-tathawade_chinchwad-pune-aishwaryam_group.jpeg" class="img-fluid rounded w-100" alt=""></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 rounded bg-light py-3 align-items-center">
                                        <ul class="d-inline-flex p-0 m-0 text-dark" style="list-style: none;">
                                            <li class="px-2 border-end border-2 border-dark"><i class="fas fa-bed  text-muted"></i> <strong>{{ $beds}}</strong> Beds</li>
                                            <li class="px-2 border-end border-2 border-dark"><i class="fas fa-bath  text-muted"></i> <strong>{{ $baths}}</strong> Baths</li>
                                            <li class="px-2 border-end border-2 border-dark"><i class="fas fa-border-none  text-muted"></i> <strong>{{ $balconies}}</strong> Balconies</li>
                                            <li class="px-2"><i class="fas fa-car  text-muted"></i> <strong>{{ $parking }}</strong> Parkings</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <ul class="p-0 m-0 text-dark body-list" style="list-style: none;">
                                            
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Developer</p>
                                                <p><strong>{{$builder_name}}</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Project</p>
                                                <p><strong>{{ $v->title }}</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Carpet Area</p>
                                                <p><strong>{{ $area }} sqft</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Floor</p>
                                                <p><strong>10/16</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Lifts</p>
                                                <p><strong>4</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Furnished Type</p>
                                                <p><strong>Semi-Furnished</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Status</p>
                                                <p><strong>Ready to Move</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Transaction type</p>
                                                <p><strong>{{ $category }}</strong></p>
                                            </li>
                                            <li class="body-list--item">
                                                <p class="m-0 text-muted">Lifts</p>
                                                <p><strong>4</strong></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="text-dark"><strong><i class="fas fa-cloud-sun fa-2x text-primary"></i> East Facing Property</strong></h5>
                                    </div>
                                </div>
                            </div><hr>
                            <div class="col-md-12 prop-details">
                                <h2>More Details</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Price Breakup</th>
                                                <td>₹ 1 Cr | ₹ 55000</td>
                                            </tr>
                                            <tr>
                                                <th>Booking Amount</th>
                                                <td>₹3.0 Lac</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>Flat No 1002 Floor No 10 Wing A Unique legacy grand Keshav Nagar Mundhwa Pune., Keshav Nagar, Pune - East, Maharashtra</td>
                                            </tr>
                                            <tr>
                                                <th>Landmarks</th>
                                                <td>Renuka mata mandir</td>
                                            </tr>
                                            <tr>
                                                <th>Amenities</th>
                                                <td>{{ $facilities }}</td>
                                            </tr>
                                            <tr>
                                                <th>Furnishing</th>
                                                <td>Semi-Furnished</td>
                                            </tr>
                                            <tr>
                                                <th>Flooring</th>
                                                <td>Vitrified, Wooden, Marble</td>
                                            </tr>
                                            <tr>
                                                <th>Loan Offered</th>
                                                <td>
                                                    <p class="m-0">
                                                        <strong>Estimated EMI: ₹55024</strong><br>
                                                        <a class="text-dark" href="#" data-bs-toggle="modal" data-bs-target="#searchModal"><u>Apply for Loan</u></small></a><br>
                                                        BANKS LIST
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-dark mt-3"><strong>Description: </strong> This property is very good location and good 3 BHK flat available for more details please contact.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-white rounded p-3">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12">
                                <div class="rounded bg-light">
                                    <img src="{{ $img }}" class="img-fluid rounded w-100" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#">
                                    <div class="counter-item bg-light rounded p-3 h-100 justify-content-center">
                                        <h5 class="mb-0 text-dark"><i class="fas fa-download text-primary"></i> Download Brochure</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded p-3 mt-3">
                        <div class="row g-4 justify-content-center">
                            <div class="col-12">
                                <div>
                                    <h5 class="mb-0"><strong>Reach Us</strong></h5>
                                    <h6 class="mb-0 text-dark">+91 96358 456712</h6>
                                    <a href="tel:9196358456712" class="btn btn-primary rounded-pill py-2 w-100 mt-3"><i class="fa fa-phone-alt"></i> Call Now</a>
                                </div>
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
        <?php } ?> 
    </div>
<!-- Details End -->
    
@endsection