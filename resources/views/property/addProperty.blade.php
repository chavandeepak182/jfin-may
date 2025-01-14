@extends('layouts.header')
@section('title')
    @parent
    JFS | Add Property
@endsection
@section('content')
@parent
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Property</li>
    </ol>
</nav>
 
<!-- Begin Page Content -->
<div class="container-fluid">
    <form id="addNewProperty">
        @csrf
        <div class="container-fluid">
            
                <!-- Title -->
                <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                    <h2 class="h5 mb-3 mb-lg-0 text-white"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a> Add New Property</h2>
                    <div class="hstack gap-3">
                    <button class="btn btn-light btn-sm btn-icon-text"><i class="bi bi-x"></i> <span class="text">Cancel</span></button>
                    {{-- <button type="submit" class="btn btn-primary btn-sm btn-icon-text"><i class="bi bi-save"></i> <span class="text">Save</span></button> --}}
                    <input type="submit" class="btn btn-primary btn-sm btn-icon-text" value="Save">
                    </div>
                </div>


                <input type="hidden" name="creator_id" value=" {{ Session::get('user_id') }}" />
               

                <!-- Main content -->
                <div class="row">
                    <!-- Left side -->
                    <div class="col-lg-8">
                        <!-- Basic information -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="h6 mb-4">Basic information</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Type Property</label>
                                            <select class="form-control" name="property_type">
                                            <?php
                                                foreach($data['category'] as $v) {  
                                                    ?>
                                                    <option value="<?php echo $v->pid; ?>"><?php echo $v->category_name; ?></option>     
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Project Name</label>
                                            <input type="text" name="property_title" class="form-control" placeholder="Property Title" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Builder Name</label>
                                            <input type="text" name="builder_name" class="form-control" placeholder="Builder Name" required />
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Select BHK</label>
                                            <select class="form-control" name="select_bhk">
                                                <option>Select BHK</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select> 

                                        </div>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Land Type</label>
                                            <select class="form-control" name="land_type">
                                                <option>Select Type</option>
                                                <option value="Flat">Flat</option>
                                                <option value="Bunglow">Bunglow</option>
                                                <option value="Villa">Villa</option>
                                                <option value="Plot">Plot</option>
                                            </select> 

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Carpet area</label>
                                            <input type="text" name="area" class="form-control" placeholder="Carpet Area" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Built-up Area</label>
                                            <input type="text" name="builtup_area" class="form-control" placeholder="Built-up Area" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Localities</label>
                                            <input type="text" name="localitie" class="form-control" placeholder="Localities" required />
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="City" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                                <label class="form-label">Select Beds</label>
                                                <select class="form-control" name="beds">
                                                    <option>Select beds</option>
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
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Select Baths</label>
                                            <select class="form-control" name="baths">
                                                <option>Select baths</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>                                                
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Select Balconies</label>
                                            <select class="form-control" name="balconies">
                                                <option>Select balconies</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>                                                
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Select Parking</label>
                                            <select class="form-control" name="parking">
                                                <option>Select parking</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>                                                
                                            </select> 
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label text-white">Property Description</label>
                                    <textarea name="property_description" class="form-control" rows="2" style="resize:none" maxlength="250" placeholder="Property Description" required></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label text-white">Property Address</label>
                                    <textarea name="property_address" class="form-control" rows="2" style="resize:none" maxlength="250" placeholder="Property Address" required></textarea>
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <!-- Location -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label text-white">Location</label>
                                    <input type="text" name="location" class="form-control" placeholder="Location" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Latitude -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label text-white">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" placeholder="Latitude" required>
                                </div>
                            </div>
                            
                            <!-- Longitude -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label text-white">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" placeholder="Longitude" required>
                                </div>
                            </div>
                        </div>                  
                        
                        <div class="card mb-4" style="padding:3%">
                            <div class="row">
                            
                                    <div class="col-lg-6">
                                        <label class="form-label">Email ID</label>
                                        <input type="email" class="form-control jixlink2" name="email_id" placeholder="Email ID">
                                        <span class="text-danger error-text jixlink2_err"></span>
                                    </div>
                                
                                
                                    <div class="col-lg-6">
                                        <label class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control jixlink2" name="contact_number" placeholder="Contact Number">
                                        <span class="text-danger error-text jixlink2_err"></span>
                                    </div>
                              
                               
                            </div>
                        </div>

                    </div>
                    <!-- Right side -->
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="h6">Property Image</h3>
                                <input class="form-control" type="file" accept=".jpg,.jpeg,.png,.webp " name="property_image" required />

                                <h3 class="h6 mt-2">Property Boucher</h3>
                                <input class="form-control" type="file" accept=".pdf" name="property_voucher" />

                            </div>
                        </div>
                        <!-- Notes -->

                        <div class="card mb-4">
                            <div class="card-body">
                                <label class="form-label">Price Range</label>
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
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                            <h3 class="h6">Amenities Description</h3>
                            <label for="amenities">Select Amenities:</label><br>
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
                </div>
            </div>
        
    </form>
        
   
</div>            

            
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


@endsection
