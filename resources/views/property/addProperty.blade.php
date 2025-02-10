@extends('layouts.header')
@section('title')
    @parent
    JFS | Add Property
@endsection
@section('content')
@parent
<form id="addNewProperty">
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

            <div class="hstack gap-3">
                <button class="btn btn-light border btn-icon-text"><i class="bi bi-x"></i> <span class="text">Cancel</span></button>
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
                            <label class="form-label">Land Type</label><span class="text-danger">*</span>
                            <select class="form-control" name="property_type" id="propertyType">
                                <option value="">Select Property Type</option>
                                <?php foreach($data['category'] as $v) { ?>
                                    <option value="<?php echo $v->pid; ?>"><?php echo $v->category_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Property Type</label><span class="text-danger">*</span>
                            <select class="form-control" name="land_type" id="landType">
                                <option value="">Select Type</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Starting Price</label><span class="text-danger">*</span>
                            <input type="text" name="s_price" class="form-control" placeholder="Starting Price" required />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Carpet area</label><span class="text-danger">*</span>
                            <input type="text" name="area" class="form-control" placeholder="Carpet Area" required />
                        </div>
                    </div>

                    <div class="col-lg-4"> 
                        <div class="mb-3">
                            <label class="form-label">Built-up Area</label><span class="text-danger">*</span>
                            <input type="text" name="builtup_area" class="form-control" placeholder="Built-up Area" required />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Bedrooms</label><span class="text-danger">*</span>
                            <select class="form-control" name="beds">
                                <option>Select beds</option>
                                <option value="No">0</option>
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
                            <label class="form-label">Bathrooms</label><span class="text-danger">*</span>
                            <select class="form-control" name="baths">
                                <option>Select baths</option>
                                <option value="No">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>                                                
                            </select> 
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Balconies</label><span class="text-danger">*</span>
                            <select class="form-control" name="balconies">
                                <option>Select balconies</option>
                                <option value="No">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>                                                
                            </select> 
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label class="form-label">Parking</label><span class="text-danger">*</span>
                            <select class="form-control" name="parking">
                                <option>Select parking</option>
                                <option value="No">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>                                                
                            </select> 
                        </div>  
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Property Description</label>
                            <textarea name="property_description" class="form-control" rows="5" placeholder="Property Description" required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Property Address</label>
                            <input type="text" name="property_address" class="form-control" placeholder="Full Address" required />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Area in City</label>
                            <input type="text" name="localitie" class="form-control" placeholder="Localities" required />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">City</label><span class="text-danger">*</span>
                            <input type="text" name="city" class="form-control" placeholder="City" required />
                        </div>
                    </div>

                    <!-- Latitude -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Latitude</label><span class="text-danger">*</span>
                            <input type="text" name="latitude" class="form-control" placeholder="Ex: 1.462260" required>
                            <small><a class="form-hint" href="https://www.latlong.net/" target="_blank" rel="nofollow"> Go here to get Latitude from address.</a></small>
                        </div>
                    </div>
                    
                    <!-- Longitude -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Longitude</label><span class="text-danger">*</span>
                            <input type="text" name="longitude" class="form-control" placeholder="Ex: 1.462260" required>
                            <small><a class="form-hint" href="https://www.latlong.net/" target="_blank" rel="nofollow"> Go here to get Longitude from address.</a></small>
                        </div>
                    </div>

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
                            <input type="email" class="form-control jixlink2" name="email_id" placeholder="Email ID">
                            <span class="text-danger error-text jixlink2_err"></span>
                        </div>
                    </div>
                
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="tel" class="form-control jixlink2" name="contact_number" placeholder="Contact Number">
                            <span class="text-danger error-text jixlink2_err"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side -->
        <div class="col-lg-3 bg-light p-4">
            <div class=" mb-4">
                <!-- Multiple Property Images Upload -->
                <h3 class="h6"><strong>Property Images<span class="text-danger">*</span></strong></h3>
                <input class="form-control" type="file" accept=".jpg,.jpeg,.png,.webp" name="property_images[]" multiple required />
                <small class="text-muted">You can upload multiple images (JPG, JPEG, PNG, WEBP).</small>

                <!-- Property Boucher Upload -->
                <h3 class="h6 mt-2"><strong>Property Brochure<span class="text-danger">*</span></strong></h3>
                <input class="form-control" type="file" accept=".pdf" name="property_voucher" />
                <small class="text-muted">Upload the property brochure in PDF format.</small>
            </div>
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
            <div class="mb-4">
                <label class="form-label"><strong>Rera No.</strong></label><span class="text-danger">*</span>
                <input type="text" name="rera" class="form-control" placeholder="Ex: P5XXXXXXXX14" required />
                <span class="text-danger error-text jixname2_err"></span>   
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>   
$('#addNewProperty').on('submit',function(e){
    e.preventDefault();
    $.ajax({               
        url:"{{Route('insertProperty')}}", 
        method:"POST",                             
        data:new FormData(this) ,
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },
        success:function(data){   
            if(data.status == 0){
                
                $.each(data.error,function(prefix,val){
                    $('span.'+prefix+'_error').text(val[0]);
                    swal("Oh noes!", val[0], "error");
                });                      
            }else if(data.status == 2){
                document.getElementById("skill_title_error["+data.id+"]").innerHTML =data.msg;
                // console.log(data); console.log('skill_title_error['+data.id+']');
                // return false;
            }else{
                $('#addNewProperty').get(0).reset();   
                swal({
                    title: data.msg,
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
            2: ['Office', 'Shop', 'Showroom'] // Example: Commercial (pid = 2)
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
@endsection
