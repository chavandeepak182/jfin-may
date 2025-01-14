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
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('allProperties') }}">List of Property</a></li> 
        <li class="breadcrumb-item active" aria-current="page">Update Property Details</li>
    </ol>
</nav>
 
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php 
    
        foreach($data['propertie_details'] as $v) {  

            $price_range = $v->from_price. " to ". $v->to_price;
            $img = env('baseURL'). "/".$v->image;
            $boucher = env('baseURL'). "/".$v->boucher;
           
    ?>
      
        <div class="container-fluid">
            <form id="editProperty">
            @csrf
                <!-- Title -->
                <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                    <h2 class="h5 mb-3 mb-lg-0"><a href="../../pages/admin/customers.html" class="text-muted"><i class="bi bi-arrow-left-square me-2"></i></a> Property Details</h2>
                    <div class="hstack gap-3">
                    <button class="btn btn-light btn-sm btn-icon-text"><i class="bi bi-x"></i> <span class="text">Cancel</span></button>
                    <button type="submit" class="btn btn-primary btn-sm btn-icon-text"><i class="bi bi-save"></i> <span class="text">Update</span></button> 
                 
                    </div>
                </div>


                <input type="hidden" name="creator_id" value=" {{ Session::get('user_id') }}" />
                <input type="hidden" name="propertie_id" value=" {{ $v->properties_id }}" />
               

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
                                            <select name="property_type_id" class="form-control">

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
                                            <label class="form-label">Property Title</label>
                                            <input type="text" name="property_title" class="form-control" placeholder="Property Title" value="{{ $v->title }}"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Builder Name</label>
                                            <input type="text" name="builder_name" class="form-control" placeholder="Builder Name"  value="{{ $v->builder_name }}" />
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Select BHK</label>
                                            <input type="text" name="select_bhk" class="form-control" placeholder="BHK" value="{{ $v->select_bhk }}"  />

                                        </div>
                                    </div> -->
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

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Carpet area</label>
                                            <input type="text" name="area" class="form-control" placeholder="Carpet Area" value="{{ $v->area }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Built Up area</label>
                                            <input type="text" name="builtup_area" class="form-control" placeholder="Builtup Area" value="{{ $v->builtup_area }}" />
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Localities</label>
                                            <input type="text" name="localities" class="form-control" placeholder="Localities" value="{{ $v->localities }}" />
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="City" value="{{ $v->city }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Property Description</label>
                                    <textarea name="property_description" class="form-control" rows="2" style="resize:none" maxlength="250" value="" >{{ $v->property_details }} </textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Property Address</label>
                                    <textarea name="property_address" class="form-control" rows="2" style="resize:none" maxlength="250" value="" >{{ $v->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Location -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" value="{{ $data['propertie_details'][0]->location ?? '' }}" placeholder="Location" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Latitude -->
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
                        </div>
                       
                        
                        <div class="card mb-4" style="padding:3%">
                            <div class="row">
                            
                                    <div class="col-lg-6">
                                        <label class="form-label">Email ID</label>
                                        <input type="email" class="form-control jixlink2" name="email_id" value="{{ $v->email }}" >
                                       
                                    </div>
                                
                                
                                    <div class="col-lg-6">
                                        <label class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control jixlink2" name="contact_number" value="{{ $v->contact }}" >
                                       
                                    </div>
                              
                               
                            </div>
                        </div>

                    </div>
                    <!-- Right side -->
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="h6">Property Image</h3>
                                <img src="{{ $img }}" class="img-thumbnail" id="old_image"/>
                                <div id="img-preview" class="img-thumbnail"></div>
                                <input class="form-control" type="file" accept=".jpg,.jpeg,.png,.webp " name="property_image"  id="choose-file"/>

                                <h3 class="h6 mt-2">Property Boucher</h3>
                                <a href = "{{ $boucher }}">Boucher URL </a>
                                <input class="form-control" type="file" accept=".pdf" name="property_voucher"  />

                            </div>
                        </div>
                        <!-- Notes -->

                        <div class="card mb-4">
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
                                        
                                        

                                    <?php    
                                    }
                                    ?>
                                </select>
                            </div>    
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                            <h3 class="h6">Amenities Description</h3>
                            <textarea class="form-control" rows="6" style="resize:none" name="amenities"  > {{ $v->facilities }}</textarea>
                            </div>
                        </div>
                       
                      

                    </div>
                </div>
            </div>
  
   <?php } ?>
   </form>
</div>            

            
@endsection
@section('script')
@parent

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>
    const chooseFile = document.getElementById("choose-file");
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
    $('#editProperty').on('submit',function(e){
        e.preventDefault();
        $.ajax({               
            url:"{{Route('updatePropertie')}}", 
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
                    });                      
                }else{
                    swal({
                        title: data.msg,
                        text: "",
                        type: "success",
                        icon: "success",
                        showConfirmButton: true
                    }).then(function(){
                        window.location.href = "/partner/allProperties";
                    });
                        
                }
            }
        });
    }); 
 </script>

@endsection
