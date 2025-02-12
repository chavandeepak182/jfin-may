@extends('frontend.layouts.header')
@section('title', "Properties in Pune| Affordable property in PCMC - Jfinserv")
@section('description', "Looking for the Properties in Pune? Our Affordable property in PCMC  offers competitive offers to help you secure your dream home. Apply now.")
@section('keywords', "Properties in Pune, Affordable property in PCMC, Houses for sell in Pune, Buy house in Pune")

@section('scripts', "https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js")
@section('scripts2', "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js")


@section('content')
<!-- Header Start -->
<!-- <div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Find Your Dream Home</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active text-primary">Properties</li>
        </ol>    
    </div>
</div> -->

<div class="container-fluid bg-breadcrumb" style="background-image: url(../theme/frontend/img/prop-bnr.jpg);">
    <div class="container py-5">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Find Your Dream Home</h4>
    </div>
</div>

<div class="container-fluid feature pt-5">
    <div class="container pb-5">
        <div class="tab-content bg-light" id="pills-tabContent">
            <div class="tab-pane box fade show active" id="pills-flat" role="tabpanel" aria-labelledby="pills-home-tab">
                <form id="search_form" method="get">    
                    <div class="row g-3">
                        <div class="col-md-4"> 
                            <div class="form-floating">
                                <select class="form-control border-0" id="category_type" name="enquiry_type" >
                                <option>Select Category</option>
                                @foreach($data['category'] as $v)
                                    <option value="{{ $v->pid }}">{{ $v->category_name }}</option>
                                @endforeach     
                                </select>
                                <label for="enquiry_type">Select Category</label>
                            </div>    
                        </div>
                      
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="location_name" name="location_name" value="" placeholder="Location"  >
                                <label for="Location">Location</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-control border-0" id="range_id" name="enquiry_type">
                                    <option>Select Price</option>
                                    @foreach($data['range'] as $v)
                                        <option value="{{ $v->range_id }}">{{ $v->from_price }} to {{ $v->to_price }}</option>
                                    @endforeach    
                                </select>    
                                <label for="keywords">Your Range</label>
                            </div>
                        </div>
                    </div>  

                    <div class="row g-3">
                        <div class="col-md-2 pt-3">
                            <button class="btn btn-danger w-100 py-2 rounded-1 uppercase" type="button" onclick="search()">Search</button>
                        </div>
                        <div class="col-md-2 pt-3">
                            <button class="btn btn-dark w-100 py-2 rounded-1 uppercase">Clear Filter</button>
                        </div>
                    </div>
                </form>
            </div>


          
        </div>
    </div>
</div>

<div class="container-fluid blog py-5" id="old_data">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h2 class="display-4 mb-4">All Properties</h2>
            <p class="mb-0">Properties listed in our website.</p>
        </div>
        <div class="row g-4 justify-content-center">
            
        <?php 
            foreach($data['allProperties'] as $v) {  
                $price_range = $v->from_price. " to ". $v->to_price;
                $img = env('baseURL'). "/".$v->image;
                //$boucher = env('baseURL'). "/".$v->boucher;
                $title = $v->title;
                $category = $v->category_name;
                $description = $v->property_details;
                $bhk = $v->select_bhk;
                $address = $v->localities.", ".$v->city;
                $area = $v->area;

                ?>
                <div class="col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ $img }}" class="img-fluid rounded-top w-100" alt="" style="height: 250px">
                            <div class="blog-categiry py-2 px-4">
                                <span>{{ $category }}</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <p class="mb-0">{{ $bhk }} BHK Flat</p>
                            <p class="mb-3 h4 d-inline-block"><strong>₹ {{ $v->from_price }}<sup>*</sup></strong><span class="px-3">|</span><em>{{ $area }} sqft</em></p>
                            <!-- <p class="h4 d-inline-block mb-3">{{ $title }}</p> -->
                            <p class="mb-3">{{ $description }}</p>
                            <p class="mb-3">{{ $address }}</p>
                            <a href="{{ url('property-details/'.$v->properties_id) }}" class="btn p-0">Read More  <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
           <?php 
           }
        ?>
        <div class="float-right"> 
            {{ $data['allProperties']->links() }}
        </div>            
        </div>
    </div>
</div>

<div id="search_data"></div>
    


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script> 

function search(){
    var category_type = $('#category_type').val();
    var location_name = $('#location_name').val();
    var range_id = $('#range_id').val();
    
    $.ajax({
        type: "POST",
        url: "{{url('search_properties')}}",
        data: {
            "_token": "{{ csrf_token() }}",               
            "category_type": category_type,  
            "location_name": location_name,               
            "range_id": range_id,  
        },
        success: function(data) {
            $('#old_data').hide();
            $('#search_data').html(data);
        }
    });       
}

</script>

@endsection
