@extends('layouts.header')
@section('title')
    @parent
    JFS | Add Property
@endsection
@section('content')
@parent
<form id="addNewProperty"
      method="POST"
      enctype="multipart/form-data">



    @csrf
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="d-flex align-items-center">
                <ol class="breadcrumb m-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Property</li>
                </ol>
            </nav>

            <div class="hstack gap-3"><button type="button" class="btn btn-light border btn-icon-text"

        onclick="window.location.href='{{ route('allProperties') }}'">
    <i class="bi bi-x"></i>
    <span class="text">Cancel</span>
</button>
{{-- <button type="submit" class="btn btn-primary btn-icon-text"><i class="bi bi-save"></i> <span class="text">Save</span></button> --}}
                <input type="submit" class="btn btn-primary btn-icon-text" value="Save">
            </div>
        </div>
    </div>

    <input type="hidden" name="creator_id" value=" {{ Session::get('user_id') }}" />
    <!-- Main content -->
    <div class="row bg-white">
        <!-- Left side -->
        <div class="col-lg-9 p-5">
            <!-- Basic information -->
            <div class="">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Builder Name</label><span class="text-danger">*</span>
                            <input type="text" name="builder_name" class="form-control" placeholder="Builder Name" required />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Project Name</label><span class="text-danger">*</span>
                            <input type="text" name="property_title" class="form-control" placeholder="Property Title" required />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Property Type</label><span class="text-danger">*</span>
                            <select class="form-control" name="property_type" id="propertyType" required>
                                <option value="">Select Property Type</option>
                                <?php foreach($data['category'] as $v) { ?>
                                    <option value="<?php echo $v->pid; ?>"><?php echo $v->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                   <div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Land Type</label><span class="text-danger">*</span>
        <select class="form-control" name="land_type" id="landType" required>
            <option value="">Select Type</option>
        </select>
    </div>
</div>
                            <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label">Starting Price</label><span class="text-danger">*</span>
                                            <input type="text" 
                                                name="s_price" 
                                                class="form-control" 
                                                placeholder="Starting Price" 
                                                required
                                                inputmode="numeric"
                                                pattern="^[0-9]+$"
                                                title="Please enter numeric values only" />
                                        </div>
                            </div>




                                        <div class="col-lg-3">
                                            <div class="mb-3">
                        <label class="form-label">Carpet area </label>
                        <input 
                            type="text" 
                            name="area" 
                            value="{{ old('area') }}" 
                            class="form-control @error('area') is-invalid @enderror" 
                            placeholder="Carpet Area" 
                            
                        />
                        @error('area')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    </div>

                    <div class="col-lg-3"> 
                                <div class="mb-3">
                                    <label class="form-label">Built-up Area </label>
                                    <input 
                                        type="text" 
                                        name="builtup_area" 
                                        value="{{ old('builtup_area') }}" 
                                        class="form-control @error('builtup_area') is-invalid @enderror" 
                                        placeholder="Enter Built-up Area" 
                                        
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                    />
                                    @error('builtup_area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                    </div>


                    <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Select BHK</label><span class="text-danger">*</span>
                        <select class="form-control" name="select_bhk" required>
                            <option value="">Select BHK</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="2 & 3">2 & 3</option>
                            <option value="2,3 & 4">2,3 & 4</option>
                            <option value="3 & 4">3 & 4</option>
                            <option value="3,4 & 5">3,4 & 5</option>
                        </select>
                    </div>
                </div>


                    <div class="col-lg-3">
                        <div class="mb-3">
                        <label class="form-label">Bedrooms</label>
                        <select class="form-control" name="beds">
                            <option value="">Select beds</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select> 
                    </div>

                    </div>

                   <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Bathrooms</label>
                        <select class="form-control" name="baths">
                            <option value="">Select baths</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>                                                
                        </select> 
                    </div>
                </div>
                  <div class="col-lg-3">
                    <div class="mb-3">
                        <label class="form-label">Balconies</label>
                        <select class="form-control" name="balconies">
                            <option value="">Select balconies</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>                                                
                        </select> 
                    </div>
                </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Parking</label>
                            <select class="form-control" name="parking">
                                <option value="">Select parking</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>                                                
                            </select> 
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="position-relative pb-15 form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="summernote" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Property Address</label>
                            <!-- <input type="text" name="property_address" class="form-control" placeholder="Full Address" required /> -->
                        <input type="text" name="property_address" 
                            id="property_address"
                            class="form-control" 
                            placeholder="Full Address" required />
                                                </div>
                                            </div>

                  
                    <div class="col-lg-6">
                        <div class="mb-3">

                        <label class="form-label">State</label><span class="text-danger">*</span>

                        <select name="state_id" id="state" class="form-control" required>

                        <option value="">Select State</option>

                        @foreach($data['states'] as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach

                        </select>

                        </div>
                        </div>
                  <div class="col-lg-6">
                    <div class="mb-3">

                    <label class="form-label">City</label><span class="text-danger">*</span>

                    <select name="city_id" id="city" class="form-control" required>

                    <option value="">Select City</option>

                    </select>

                    </div>
                    </div>
                     <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Area in City</label>
                            <select name="area_id" id="area" class="form-control" >
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div>

                    <!-- Latitude -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label>Latitude *</label>
                            <input type="text" name="latitude" id="latitude"
                                class="form-control" readonly required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label>Longitude *</label>
                            <input type="text" name="longitude" id="longitude"
                                class="form-control" readonly required>
                        </div>
                    </div>
                    <script>
                    document.getElementById("property_address").addEventListener("blur", function () {

                        let address = this.value;

                        if(address.length < 5) return;

                        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
                            .then(response => response.json())
                            .then(data => {

                                if(data.length > 0){
                                    document.getElementById("latitude").value = data[0].lat;
                                    document.getElementById("longitude").value = data[0].lon;
                                } else {
                                    alert("Location not found. Please enter correct address.");
                                }

                            })
                            .catch(error => {
                                console.log(error);
                            });

                    });
                    </script>

                    

                    <!-- Nearby Location 1 -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Location Advantages</label>
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 1" >
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 2" >
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 3" >
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label text-white invisible">xyz</label>
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 4" >
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 5" >
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 6" >
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label text-white invisible">xyz</label>
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 7" >
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 8" >
                            <input type="text" name="nearby[]" class="form-control mb-2" placeholder="Enter nearby location 9" >
                        </div>
                    </div>

                    <div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Email ID</label>

        <input type="email" 
            class="form-control" 
            name="email_id" 
            id="email"
            placeholder="Email ID">

        <small id="email_error" class="text-danger d-block mt-1"></small>
    </div>
</div>


<div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Contact Number</label>

        <input type="tel" 
            class="form-control" 
            name="contact_number" 
            id="contact"
            placeholder="Contact Number"
            maxlength="10">

        <small id="contact_error" class="text-danger d-block mt-1"></small>
    </div>
</div>
                </div>
            </div>
        </div>
                       <script>
/* ================= CONTACT VALIDATION ================= */
document.getElementById("contact").addEventListener("input", function () {

    let value = this.value.replace(/[^0-9]/g, '');
    this.value = value;

    let error = document.getElementById("contact_error");

    if (value.length < 10) {
        error.innerText = "Contact number must be 10 digits";
    } else {
        error.innerText = "";
    }
});


/* ================= EMAIL VALIDATION ================= */
document.getElementById("email").addEventListener("input", function () {

    let value = this.value;
    let error = document.getElementById("email_error");

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(value)) {
        error.innerText = "Please enter a valid email address";
    } else {
        error.innerText = "";
    }
});
</script>
        <!-- Right side -->
        <div class="col-lg-3 bg-light p-4">
           <div class="mb-4">
    <!-- Multiple Property Images Upload -->
    <h3 class="h6"><strong>Property Images<span class="text-danger">*</span></strong></h3>
    <input class="form-control" type="file" accept=".jpg,.jpeg,.png,.webp" name="property_images[]" id="property_images" multiple required />
    <small class="text-muted">You can upload multiple images (JPG, JPEG, PNG, WEBP).</small>

    <!-- Preview Container -->
    <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-2"></div>

    <!-- Property Brochure Upload -->
    <h3 class="h6 mt-3"><strong>Property Brochure<span class="text-danger">*</span></strong></h3>
    <input class="form-control" type="file" accept=".pdf" name="property_voucher" />
    <small class="text-muted">Upload the property brochure in PDF format.</small>
</div>

<script>
document.getElementById("property_images").addEventListener("change", function(event) {
    let previewContainer = document.getElementById("imagePreview");
    previewContainer.innerHTML = ""; // clear old previews

    Array.from(event.target.files).forEach(file => {
        if (!file.type.startsWith("image/")) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            let img = document.createElement("img");
            img.src = e.target.result;
            img.className = "rounded border";
            img.style.width = "100px";
            img.style.height = "100px";
            img.style.objectFit = "cover";
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>

            <!-- Notes -->

            <div class="mb-4">
                <label class="form-label"><strong>Price Range</strong></label><span class="text-danger">*</span>
                <select name="price_range" class="form-control">
                        <?php
                        foreach($data['range'] as $v) {  
                            $range_amount = $v->from_price. " to ". $v->to_price;
                            ?>
                            <option value="<?php echo $v->range_id; ?>"><?php echo $range_amount; ?></option>     
                        <?php 
                        }
                        ?>
                </select>    
                <span class="text-danger error-text jixname2_err"></span>   
            </div>
            
          <select name="property_status" class="form-control" required>
    <option value="">Select Status</option>
    @foreach($data['property_status'] as $status)
        <option value="{{ $status->id }}">{{ $status->status_name }}</option>
    @endforeach
</select>

            <div class="mb-4">
    <label class="form-label"><strong>Rera No.</strong></label>
    <span class="text-danger">*</span>

    <input type="text"
           name="rera"
           class="form-control"
           placeholder="Ex: P52100012345"
           pattern="^P[0-9]{10,15}$"
           title="RERA number must start with P followed by 10 to 15 digits"
           required />

    <small class="text-danger">
        Please enter proper RERA format (Example: P52100012345)
    </small>
</div>                                

            <div class=" mb-4">
                <label for="amenities"><strong>Select Amenities:</strong></label><br>
                <input type="checkbox" name="amenities[]" value="WiFi"> WiFi<br>
                <input type="checkbox" name="amenities[]" value="Parking"> Parking<br>
                <input type="checkbox" name="amenities[]" value="Swimming Pool"> Swimming Pool<br>
                <input type="checkbox" name="amenities[]" value="Balcony"> Balcony<br>
                <input type="checkbox" name="amenities[]" value="Garden"> Garden<br>
                <input type="checkbox" name="amenities[]" value="Security"> Security<br>
                <input type="checkbox" name="amenities[]" value="Fitness Center"> Fitness Center<br>
                <input type="checkbox" name="amenities[]" value="Air Conditioning"> Air Conditioning<br>
                <input type="checkbox" name="amenities[]" value="Central Heating"> Central Heating<br>
                <input type="checkbox" name="amenities[]" value="Laundry Room"> Laundry Room<br>
                <input type="checkbox" name="amenities[]" value="Pets Allowed"> Pets Allowed<br>
                <input type="checkbox" name="amenities[]" value="Spa & Massage"> Spa & Massage<br>
            </div>                     
        </div>
    </div>        
</form>       
                    
@endsection
@section('script')
@parent


<!-- Summernote JS -->
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>


<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 250,
        placeholder: 'Enter property description...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
});
</script>

<script>   
$('#addNewProperty').on('submit',function(e){
    e.preventDefault();

    console.log("AJAX starting...");   // 👈 add this

    $.ajax({
        url:"{{Route('insertProperty')}}",
        method:"POST",
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
       success:function(data){
    console.log("AJAX Success:", data);

    if(data.status == 1){
        swal({
            title: "Success!",
            text: data.msg,
            icon: "success",
            button: "OK"
        }).then(function(){
            window.location.href = "{{ route('allProperties') }}";
        });
    }
},

      error:function(xhr){
    let errors = xhr.responseJSON?.errors;

    if(errors){
        let allErrors = '';

        Object.keys(errors).forEach(function(key){
            allErrors += errors[key][0] + '\n';
        });

        swal({
            title: "Validation Error",
            text: allErrors,
            icon: "error"
        });
    } else {
        swal("Error", "Something went wrong!", "error");
    }
}
    });
});

function deletePropertie(id)
	{
		$.ajax({
            url:"{{Route('deletePropertie')}}", 
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
                        location.reload();
                    });
                }                           
            }
        });      
	}

</script>
<script>
    document.getElementById('propertyType').addEventListener('change', function() {
        var propertyTypeId = this.value; // Now stores ID instead of category name
        var landTypeDropdown = document.getElementById('landType');
        landTypeDropdown.innerHTML = ''; // Clear existing options

        var defaultOption = document.createElement("option");
        defaultOption.text = "Select Type";
        defaultOption.value = "";
        landTypeDropdown.appendChild(defaultOption);

        // Mapping property category IDs to land type options
        var landTypeOptions = {
            1: ['Plot', 'Flat', 'Bungalow', 'Villa'], // Example: Residential (pid = 1)
            2: ['Office', 'Shop', 'Showroom'], // Example: Commercial (pid = 2)
            3: ['Plot', 'Flat']
        };

        if (landTypeOptions.hasOwnProperty(propertyTypeId)) {
            landTypeOptions[propertyTypeId].forEach(function(type) {
                var option = document.createElement("option");
                option.text = type;
                option.value = type;
                landTypeDropdown.appendChild(option);
            });
        }
    });
</script>


<!-- all points validation -->
 <script>
document.querySelector('input[name="area"]').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9.]/g, '');
});
document.querySelector('input[name="s_price"]').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

$('#state').change(function(){

    var state_id = $(this).val();

    if(state_id){

        $.ajax({
            url: "{{ route('getCitiesproperty') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                state_id: state_id
            },

            success:function(data){

                console.log("DATA:", data);

                $('#city').html('<option value="">Select City</option>');

                $.each(data,function(key,value){

                    $('#city').append(
                        '<option value="'+value.id+'">'+value.city+'</option>' // ✅ FIX
                    );

                });

            }
        });

    }

});
// CITY → AREA
$('#city').change(function(){

    var city_id = $(this).val();

    $('#area').html('<option>Loading...</option>');

    if(city_id){

        $.ajax({
            url: '/get-areas/' + city_id,
            type: 'GET',

            success: function(data){

                $('#area').html('<option value="">Select Area</option>');

                $.each(data, function(key, value){

                    $('#area').append(
                        '<option value="'+value.id+'">'+value.name+'</option>'
                    );

                });

            },

            error:function(err){
                console.log("Area error:", err);
            }

        });

    }

});

</script>


@endsection
