@extends('layouts.header')
@section('title')
    @parent
    JFS | Details Property
@endsection
@section('content')
@parent

<?php 
    foreach($data['propertie_details'] as $v) {  
        $price_range = $v->from_price. " to ". $v->to_price;
        $img = env('baseURL'). "/".$v->image;
        $boucher = env('baseURL'). "/".$v->boucher;
?>

    <!-- Breadcrumbs -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('allProperties') }}">List of Property</a></li> 
                    <li class="breadcrumb-item active" aria-current="page">Property Details</li>
                </ol>
            </nav>
            <?php
                if($v->is_active == 0){ ?>
                <div class="hstack gap-3">
                    <button class="btn btn-light btn-icon-text border"><i class="bi bi-x"></i> <span class="text">Cancel</span></button>
                    <button type="submit" class="btn btn-primary btn-icon-text" onclick="activateProperty('{{$v->properties_id}}')"><i class="bi bi-save"></i> <span class="text">Activate</span></button> 
                </div>
            <?php } ?>
        </div>
    </div>
    
    <!-- Begin Page Content -->
    <div class="bg-white">      
        <div class="container-fluid">
            <input type="hidden" name="creator_id" value=" {{ Session::get('user_id') }}" />
            <!-- Main content -->
            <div class="row">
                <!-- Left side -->
                <div class="col-lg-8 pb-5">
                    <!-- Basic information -->
                    <div class="card-body">
                        <h3 class="h5 mb-4"><strong>Basic information</strong></h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Type Property</label>
                                    <input type="text"  class="form-control" placeholder="Property Title" value="{{ $v->category_name }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Property Title</label>
                                    <input type="text" name="property_title" class="form-control" placeholder="Property Title" value="{{ $v->title }}" readonly />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Builder Name</label>
                                    <input type="text" name="builder_name" class="form-control" placeholder="Builder Name" readonly value="{{ $v->builder_name }}" />
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Select BHK</label>
                                    <input type="text"  class="form-control" placeholder="Property Title" value="{{ $v->select_bhk }}" readonly />

                                </div>
                            </div> -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Land Type</label>
                                    <input type="text" name="land_type" class="form-control" placeholder="Land Type" readonly value="{{ $v->land_type }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Beds</label>
                                    <input type="text" name="beds" class="form-control" placeholder="Total beds" readonly value="{{ $v->beds }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Balconies</label>
                                    <input type="text"  class="form-control" placeholder="Total Balcony" value="{{ $v->balconies }}" readonly />

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Parking</label>
                                    <input type="text" name="parking" class="form-control" placeholder="Total Parking" readonly value="{{ $v->parking }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Baths</label>
                                    <input type="text" name="baths" class="form-control" placeholder="Total Baths" readonly value="{{ $v->baths }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Starting Price</label>
                                    <input type="text" name="s_price" class="form-control" placeholder="Starting Price" readonly value="{{ $v->s_price }}" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Property Description</label>
                                    <textarea name="property_description" class="form-control" rows="2" style="resize:none" maxlength="250" value="" readonly>{{ $v->property_details }} </textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Property Address</label>
                                    <textarea name="property_address" class="form-control" rows="2" maxlength="250" value="" readonly>{{ $v->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <textarea name="property_location" class="form-control" rows="2" style="resize:none" maxlength="250" readonly>{{ $v->location }}</textarea>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Latitude</label>
                                    <textarea name="property_latitude" class="form-control" rows="2" style="resize:none" maxlength="250" readonly>{{ $v->latitude }}</textarea>
                                </div>
                            </div>

                            <!-- Longitude -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Longitude</label>
                                    <textarea name="property_longitude" class="form-control" rows="2" style="resize:none" maxlength="250" readonly>{{ $v->longitude }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Email ID</label>
                                <input type="email" class="form-control jixlink2" name="email_id" value="{{ $v->email }}" readonly> 
                            </div>                   
                        
                            <div class="col-lg-6">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" class="form-control jixlink2" name="contact_number" value="{{ $v->contact }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right side -->
                <div class="col-lg-4 bg-light">
                    <div class="card-body">
                        <h3 class="h6">Property Images</h3>
                        <div class="row">
                            @foreach($data['property_images'] as $image)
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <img src="{{ env('baseURL') . '/' . $image->image_url }}" class="img-thumbnail" alt="Property Image" style="max-width: 100%; height: auto;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- <h3 class="h6">Property Image</h3>
                        <img src="{{ $img }}" class="img-thumbnail" /> -->
                        <h3 class="h6 mt-2">Property Boucher</h3>
                        <a href = "{{ $boucher }}">Boucher URL </a>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Price Range</label>
                        <input type="text" class="form-control jixlink2" value="{{ $price_range }}" readonly>
                    </div>
                    <div class="card-body">
                        <h3 class="h6">Amenities Description</h3>
                        <textarea class="form-control" rows="6" style="resize:none" name="amenities" readonly > {{ $v->facilities }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>            

            
@endsection
@section('script')
@parent

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script>   
    function activateProperty(id)
	{
		$.ajax({
            url:"{{Route('activate')}}", 
            type: 'post',
            dataType: 'json',
            data: {
                'propertie_id': id,               
                '_token': '{{ csrf_token() }}',
                },
            success: function (response) {
                // console.log(response);
                if(response.status == 0){
                    swal({
                        title: response.error,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){ 
                        location.reload();
                    });
                }else{
                    swal({
                        title: response.msg,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){ 
                        window.location.href = "/partner/pendingProperties";
                    });
                }                           
            }
        });      
	}

</script>

@endsection
