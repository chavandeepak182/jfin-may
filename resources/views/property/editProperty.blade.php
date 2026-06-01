@extends('layouts.header')
@section('title')
    @parent
    JFS | Update Property
@endsection
@section('content')
@parent

<style>
    #img-preview {
  display: none;
  width: 470px;
  margin-bottom: 20px;
  border-radius: 2%;
  padding: 1%;
}
#img-preview img {
  width: 100%;
  height: auto;
  display: block;
}
</style>

<?php 
    
    foreach($data['propertie_details'] as $v) {  
        $price_range = $v->from_price. " to ". $v->to_price;
        $img = env('baseURL'). "/".$v->image;
        $boucher = env('baseURL'). "/".$v->boucher;
        
?>
<form id="editProperty" enctype="multipart/form-data">
    @csrf
    <!-- Breadcrumbs -->
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('allProperties') }}">List of Property</a></li> 
                    <li class="breadcrumb-item active" aria-current="page">Update Property Details</li>
                </ol>
            </nav>
            
            <div class="hstack gap-3">
                <button type="button" class="btn btn-light border btn-icon-text"
                onclick="window.location.href='/partner/allProperties'">
                    <i class="bi bi-x"></i> <span class="text">Cancel</span>
                </button>
                <!-- <button type="submit" class="btn btn-primary btn-icon-text"><i class="bi bi-save"></i> <span class="text">Update</span></button> -->
                <input type="submit" class="btn btn-primary btn-icon-text" value="Update">
            </div>
        </div>
    </div>
    
    <!-- Begin Page Content -->     
    <div class="container-fluid bg-white">
        <input type="hidden" name="creator_id" value=" {{ Session::get('user_id') }}" />
<input type="hidden" name="propertie_id" value="{{ $v->properties_id }}" />

        <!-- Main content -->
        <div class="row">
            <!-- Left side -->
            <div class="col-lg-8">
                <!-- Basic information -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Builder Name</label>
                                <input type="text" name="builder_name" class="form-control" placeholder="Builder Name"  value="{{ $v->builder_name }}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Project Name</label>
                                <input type="text" name="property_title" class="form-control" placeholder="Property Title" value="{{ $v->title }}"  />
                            </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Property Type</label>
                                <select name="property_type_id"
        class="form-control"
        id="propertyType">
                                    <?php
                                        foreach($data['category'] as $r){
                                            $sel = $v->property_type_id;
                                            $option = $r->pid;

                                            $isSelected =""; 
                                            if($option == $sel){
                                                $isSelected = "selected";
                                            }
                                            echo '<option value="'.$option.'"'.$isSelected.'>'.$r->category_name.'</option>';
                                    ?>                                                   

                                    <?php    
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Land Type</label>
                                <select class="form-control" name="land_type">
                                    <option>Select Type</option>
                                    <option value="Flat" {{ old('land_type', $v->land_type) == 'Flat' ? 'selected' : '' }}>Flat</option>
                                    <option value="Bunglow" {{ old('land_type', $v->land_type) == 'Bunglow' ? 'selected' : '' }}>Bunglow</option>
                                    <option value="Villa" {{ old('land_type', $v->land_type) == 'Villa' ? 'selected' : '' }}>Villa</option>
                                    <option value="Plot" {{ old('land_type', $v->land_type) == 'Plot' ? 'selected' : '' }}>Plot</option>
                                </select>
                            </div>
                        </div>
                       
 <div class="row">

    <!-- Starting Price -->
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">Starting Price</label>
            <input type="text"
                   name="s_price"
                   class="form-control"
                   placeholder="Starting price"
                   value="{{ $v->s_price }}" />
        </div>
    </div>

    <!-- BHK -->
<div class="col-lg-3" id="bhkWrapper">

    <div class="mb-3">

        <label class="form-label">
            Select BHK
        </label>

        <select class="form-control"
                name="select_bhk">

            <option value="">
                Select
            </option>

            @foreach($data['bhks'] as $bhk)

                <option value="{{ $bhk->bhk_name }}"
                    {{ $v->select_bhk == $bhk->bhk_name ? 'selected' : '' }}>

                    {{ $bhk->bhk_name }}

                </option>

            @endforeach

        </select>

    </div>

</div>
<div class="col-lg-3"
     id="sqftWrapper"
     style="{{ strtolower($v->land_type) == 'office' || strtolower($v->land_type) == 'shop' || strtolower($v->land_type) == 'showroom' ? '' : 'display:none;' }}">

    <div class="mb-3">

        <label class="form-label">
            Sq Ft
        </label>

        <input type="text"
               name="commercial_sqft"
               class="form-control"
               placeholder="Enter Sq Ft"
               value="{{ $v->commercial_sqft ?? '' }}">

    </div>

</div>
<script>

$(document).ready(function(){

    toggleCommercialFields();

    $('#propertyType').change(function(){

        toggleCommercialFields();

    });

});

function toggleCommercialFields(){

    let selectedText = $('#propertyType option:selected')
                        .text()
                        .toLowerCase();

    if(selectedText.includes('commercial')){

        $('#bhkWrapper').hide();

        $('#sqftWrapper').show();

    }
    else{

        $('#bhkWrapper').show();

        $('#sqftWrapper').hide();

    }

}

</script>
    <!-- Carpet Area -->
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">Carpet Area</label>
            <input type="text"
                   name="area"
                   class="form-control"
                   placeholder="Carpet Area"
                   value="{{ $v->area }}" />
        </div>
    </div>

    <!-- Built-up Area -->
    <div class="col-lg-3">
        <div class="mb-3">
            <label class="form-label">Built-up Area</label>
            <input type="text"
                   name="builtup_area"
                   class="form-control"
                   placeholder="Built-up Area"
                   value="{{ $v->builtup_area }}" />
        </div>
    </div>

</div>
                        <!-- 🔥 NEW ROW: 4 FIELDS IN ONE LINE -->
                            <div class="row">

                                <!-- BHK -->
                                

                                <!-- Bedrooms -->
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bedrooms</label>
                                        <select class="form-control" name="beds">
                                            <option value="">Select</option>
                                            @for($i=0;$i<=7;$i++)
                                                <option value="{{ $i }}" {{ $v->beds == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- Bathrooms -->
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bathrooms</label>
                                        <select class="form-control" name="baths">
                                            <option value="">Select</option>
                                            @for($i=0;$i<=4;$i++)
                                                <option value="{{ $i }}" {{ $v->baths == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- Balconies -->
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Balconies</label>
                                        <select class="form-control" name="balconies">
                                            <option value="">Select</option>
                                            @for($i=0;$i<=4;$i++)
                                                <option value="{{ $i }}" {{ $v->balconies == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Parking</label>
                                        <select class="form-control" name="parking">
                                            <option value="">Select</option>
                                            @for($i=0;$i<=4;$i++)
                                                <option value="{{ $i }}" {{ $v->parking == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>


                            </div>
                        <div class="col-lg-12">
                            <div class="position-relative pb-15 form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="summernote" class="form-control"></textarea>
                                                        </div>
                                                        </div>
                                                        <script>
                                                       $(document).ready(function () {

                                                        $('#summernote').summernote({
                                                            height: 200
                                                        });

                                                        // ✅ SET VALUE AFTER INIT
                                                    $('#summernote').summernote('code', {!! json_encode(base64_decode($v->property_details)) !!});

                                                    });</script>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Property Address</label>
                                <textarea name="property_address" class="form-control" rows="1" style="resize:none" maxlength="250" value="" >{{ $v->address }}</textarea>
                            </div>
                        </div>
                        <!-- STATE -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">State</label>
                                <select name="state_id" id="state" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($data['states'] as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $state->id == ($v->state_id ?? '') ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- CITY -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                <select name="city_id" id="city" class="form-control">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                        </div>

                        <!-- AREA -->
                      <div class="mb-3">
                            <label class="form-label">Area in City</label>
                        <select name="area_id" id="area" class="form-control">
                            <option value="">Select Area</option>
                        </select>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" class="form-control" value="{{ $data['propertie_details'][0]->latitude ?? '' }}" placeholder="Latitude" required>
                            </div>
                        </div>

                        <!-- Longitude -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control" value="{{ $data['propertie_details'][0]->longitude ?? '' }}" placeholder="Longitude" required>
                            </div>
                        </div>
                        @php
$nearby = !empty($v->nearby_locations) ? json_decode($v->nearby_locations, true) : [];
@endphp
<div class="col-lg-12">
    <div class="mb-3">
        <label class="form-label"><strong>Location Advantages</strong></label>

        <div class="row">
            @for($i = 0; $i < 9; $i++)
                <div class="col-lg-4">
                    <input type="text"
                           name="nearby[]"
                           class="form-control mb-2"
                           placeholder="Nearby location {{ $i+1 }}"
                           value="{{ $nearby[$i] ?? '' }}">
                </div>
            @endfor
        </div>
    </div>
</div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Email ID</label>
                                <input type="email" class="form-control jixlink2" name="email_id" value="{{ $v->email }}" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" class="form-control jixlink2" name="contact_number" value="{{ $v->contact }}" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right side -->
            <div class="col-lg-4 pb-3 bg-light">
                <div class="card-body">
                    <label class="form-label">Rera No.</label>
                    <input type="text" name="rera" class="form-control" placeholder="Rera No." value="{{ $v->rera }}" />
                </div>
                <div class="card-body">
    <h3 class="h6">Add Multiple Images</h3>
    <input type="file" name="additional_images[]" multiple class="form-control">
</div>
                <div class="card-body">
                    <h3 class="h6">Property Boucher</h3>
                    <a href = "{{ $boucher }}">Boucher URL </a>
                    <input class="form-control" type="file" accept=".pdf" name="property_voucher"  />
                </div>

                <!-- 🔥 SEO FIELDS -->
<div class="mb-4">

    <!-- Slug -->
    <div class="form-group">
        <label for="slug">Slug (URL)</label>
        <input type="text"
               class="form-control"
               name="slug"
               id="slug"
               value="{{ $v->slug ?? '' }}"
               placeholder="Enter Slug"
               maxlength="100">
    </div>

    <!-- Meta Title -->
    <div class="form-group">
        <label for="meta_title"><strong>Meta Title</strong></label>
        <input type="text"
               class="form-control"
               name="meta_title"
               id="meta_title"
               value="{{ $v->meta_title ?? '' }}"
               placeholder="Enter Meta Title">
    </div>

    <!-- Meta Description -->
    <div class="form-group">
        <label for="meta_description"><strong>Meta Description</strong></label>
        <textarea class="form-control"
                  name="meta_description"
                  id="meta_description"
                  placeholder="Enter Meta Description">{{ $v->meta_description ?? '' }}</textarea>
    </div>

    <!-- Meta Keywords -->
    <div class="form-group">
        <label for="meta_keywords"><strong>Meta Keywords</strong></label>
        <textarea class="form-control"
                  name="meta_keywords"
                  id="meta_keywords"
                  placeholder="Enter Meta Keywords (comma separated)">{{ $v->meta_keywords ?? '' }}</textarea>
    </div>

</div>

<div class="mb-4">
    <label class="form-label"><strong>Property Status</strong></label>
    <span class="text-danger">*</span>

    <select name="property_status" class="form-control" required>
        <option value="">Select Status</option>

        @foreach($data['property_status'] as $status)
            <option value="{{ $status->id }}"
                {{ $status->id == $v->property_status ? 'selected' : '' }}>
                {{ $status->status_name }}
            </option>
        @endforeach

    </select>
</div>
                <!-- Notes -->
                <div class="card-body">
                    <label class="form-label">Price Range</label>
                    <select name="price_range" class="form-control">
                        <?php
                            foreach($data['range'] as $r){
                                
                                $range = $r->from_price." to ".$r->to_price;
                                $sel = $v->price_range_id;
                                $option = $r->range_id;

                                $isSelected =""; 
                                if($option == $sel){
                                    $isSelected = "selected";
                                }
                                echo '<option value="'.$option.'"'.$isSelected.'>'.$range.'</option>';
                        ?>
                        <?php } ?>
                    </select>
                </div>  
              
 @php

$selectedAmenities = !empty($v->facilities)
    ? array_map('trim', explode(',', $v->facilities))
    : [];

@endphp

<div class="card-body">

    <label>
        <strong>Select Amenities:</strong>
    </label>

    <br>

    @foreach($data['amenities'] as $amenity)

        <div class="form-check mb-2">

            <input type="checkbox"
                   class="form-check-input"
                   name="amenities[]"
                   value="{{ $amenity->amenity_name }}"

                   {{ in_array($amenity->amenity_name, $selectedAmenities) ? 'checked' : '' }}>

            <label class="form-check-label">

                {{ $amenity->amenity_name }}

            </label>

        </div>

    @endforeach

</div>
            </div>
        </div>         
    </div> 
</form>   
<?php } ?>
     
@endsection
@section('script')
<script>
$(document).ready(function () {

    let stateId = "{{ $v->state_id }}";
    let cityId  = "{{ $v->city_id }}";
    let areaId  = "{{ $v->locality_id }}";

    console.log("STATE:", stateId);
    console.log("CITY:", cityId);
    console.log("AREA:", areaId);

});
</script>
@parent

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>
   let chooseFile = document.getElementById("choose-file");
    const imgPreview = document.getElementById("img-preview");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
      document.getElementById('old_image').style.display = "none";

    });    
  }
}
</script>

<script>   
$('#editProperty').on('submit', function(e){
    e.preventDefault();

    $('textarea[name=description]').val($('#summernote').summernote('code'));

    let formData = new FormData(this);

    // 🔥 FILE manually add (safe)
   let multiFiles = $('input[name="additional_images[]"]')[0].files;

for (let i = 0; i < multiFiles.length; i++) {
    formData.append('additional_images[]', multiFiles[i]);
}
    $.ajax({
        url:"{{Route('updatePropertie')}}",
        method:"POST",
        data: formData,
        processData:false,
        contentType:false,
        cache:false,

        beforeSend:function(){
            console.log("FORM SUBMIT");
        },

        success:function(data){
            console.log(data);

            if(data.status == 0){
                alert(data.msg);
            }else{
                swal({
                    title: data.msg,
                    icon: "success"
                }).then(function(){
                    window.location.href = "/partner/allProperties";
                });
            }
        }
    });
});

 </script>
<script>
$(document).ready(function () {

    let stateId = "{{ $v->state_id }}";
    let cityId  = "{{ $v->city_id }}";
    let areaId  = "{{ $v->locality_id }}";

    if (stateId) {
        loadCities(stateId, cityId, areaId);
    }

    $('#state').change(function () {
        let stateId = $(this).val();
        if (stateId) loadCities(stateId);
    });

    $('#city').change(function () {
        let cityId = $(this).val();
        if (cityId) loadAreas(cityId);
    });

});

function loadCities(stateId, selectedCity = null, selectedArea = null) {

    $.ajax({
        url: '/get-cities-property',
        type: 'POST',
        data: {
            state_id: stateId,
            _token: '{{ csrf_token() }}'
        },
        success: function(cities){

            let options = '<option value="">Select City</option>';

            $.each(cities, function (i, city) {
                let selected = (parseInt(city.id) === parseInt(selectedCity)) ? 'selected' : '';
                options += `<option value="${city.id}" ${selected}>${city.city}</option>`;
            });

            $('#city').html(options);

            if (selectedCity) {
                loadAreas(selectedCity, selectedArea);
            }
        }
    });
} // ✅ CLOSE FUNCTION

// ================= AREA =================
function loadAreas(cityId, selectedArea = null) {

    $.get('/get-areas/' + cityId, function (areas) {

        let options = '<option value="">Select Area</option>';

        $.each(areas, function (i, area) {
            let selected = (parseInt(area.id) === parseInt(selectedArea)) ? 'selected' : '';
            options += `<option value="${area.id}" ${selected}>${area.name}</option>`;
        });

        $('#area').html(options);
    });
}
</script>

@endsection
