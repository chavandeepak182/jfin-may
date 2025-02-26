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

<div class="container-fluid prop-feature">
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane shadow p-3 bg-white rounded fade show active" id="pills-flat" role="tabpanel" aria-labelledby="pills-home-tab">
                        <!-- Bootstrap Tabs -->
                        <ul class="nav nav-tabs border-0" id="propertyTabs">
                            <li class="nav-item">
                                <button class="nav-link active text-danger fw-bold" data-bs-toggle="tab" data-bs-target="#buyTab">Buy</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link text-muted" data-bs-toggle="tab" data-bs-target="#rentTab">Rent</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link text-muted" data-bs-toggle="tab" data-bs-target="#commercialTab">Commercial</button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content p-3 border">
                            <!-- Buy Tab -->
                            <div class="tab-pane fade show active" id="buyTab">
                                <form id="buyForm">
                                    <div class="row align-items-center g-2">
                                        <!-- Location Dropdown -->
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="btn btn-light border w-100 text-start" type="button">
                                                    Pune
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Search Input -->
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border" placeholder="Search up to 3 localities or landmarks">
                                        </div>

                                        <!-- Search Button -->
                                        <div class="col-md-3">
                                            <button class="btn btn-danger w-100 py-2 rounded-1">
                                                <i class="bi bi-search"></i> Search
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filters Row -->
                                    <div class="row align-items-center g-2 pt-3">
                                        <!-- Property Type -->
                                        <div class="col-md-4 d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="property_type_buy" id="full_house_buy" checked>
                                                <label class="form-check-label" for="full_house_buy">Full House</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="property_type_buy" id="land_plot_buy">
                                                <label class="form-check-label" for="land_plot_buy">Land/Plot</label>
                                            </div>
                                        </div>

                                        <!-- BHK Type -->
                                        <div class="col-md-3 bhk-status">
                                            <select class="form-select">
                                                <option>Select BHK</option>
                                                <option>1 BHK</option>
                                                <option>2 BHK</option>
                                                <option>3 BHK</option>
                                            </select>
                                        </div>

                                        <!-- Property Status -->
                                        <div class="col-md-3 bhk-status">
                                            <select class="form-select">
                                                <option>Property Status</option>
                                                <option>Under Construction</option>
                                                <option>Ready to Move</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Rent Tab -->
                            <div class="tab-pane fade" id="rentTab">
                                <form id="rentForm">
                                    <div class="row align-items-center g-2">
                                        <!-- Location Dropdown -->
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="btn btn-light border w-100 text-start" type="button">
                                                    Pune
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Search Input -->
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border" placeholder="Search up to 3 localities or landmarks">
                                        </div>

                                        <!-- Search Button -->
                                        <div class="col-md-3">
                                            <button class="btn btn-danger w-100 py-2 rounded-1">
                                                <i class="bi bi-search"></i> Search
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filters Row -->
                                    <div class="row align-items-center g-2 pt-3">
                                        <!-- Property Type -->
                                        <div class="col-md-4 d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="property_type_buy" id="full_house_buy" checked>
                                                <label class="form-check-label" for="full_house_buy">Full House</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="property_type_buy" id="land_plot_buy">
                                                <label class="form-check-label" for="land_plot_buy">Land/Plot</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Commercial Tab -->
                            <div class="tab-pane fade" id="commercialTab">
                                <form id="commercialForm">
                                    <div class="row align-items-center g-2">
                                        <!-- Location Dropdown -->
                                        <div class="col-md-3">
                                            <div class="dropdown">
                                                <button class="btn btn-light border w-100 text-start" type="button">
                                                    Pune
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Search Input -->
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border" placeholder="Search up to 3 localities or landmarks">
                                        </div>

                                        <!-- Search Button -->
                                        <div class="col-md-3">
                                            <button class="btn btn-danger w-100 py-2 rounded-1">
                                                <i class="bi bi-search"></i> Search
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filters Row -->
                                    <div class="row align-items-center g-2 pt-3">
                                        <!-- Property Type -->
                                        <div class="col-md-3 d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="property_type_buy" id="full_house_buy" checked>
                                                <label class="form-check-label" for="rent">Rent</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="property_type_buy" id="land_plot_buy">
                                                <label class="form-check-label" for="buy">Buy</label>
                                            </div>
                                        </div>
                                        <!-- Property Status -->
                                        <div class="col-md-3">
                                            <select class="form-select">
                                                <option>Property Type</option>
                                                <option>Office Space</option>
                                                <option>Co-Working</option>
                                                <option>Shop</option>
                                                <option>Showroom</option>
                                                <option>Other Business</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid blog mb-5" id="old_data">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            
        <?php 
            foreach($data['allProperties'] as $v) {  
                $price_range = $v->from_price. " to ". $v->to_price;
                $img = env('baseURL'). "/".$v->image;
                //$boucher = env('baseURL'). "/".$v->boucher;
                $title = $v->title;
                $category = $v->category_name;
                $builder_name = $v->builder_name;
                $description = $v->property_details;
                $bhk = $v->select_bhk;
                $beds = $v->beds;
                $address = $v->localities.", ".$v->city;
                $area = $v->area;

                ?>
                <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ url('property-details/'.$v->properties_id) }}" target="_blank">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ $img }}" class="img-fluid rounded-top w-100" alt="" style="height: 250px">
                                <div class="blog-categiry py-2 px-4">
                                    <span>{{ $category }}</span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <p class="mb-0">{{ $beds }} BHK Flat</p>
                                <p class="mb-3 h4 d-inline-block"><strong>₹ {{ $v->from_price }}<sup>*</sup></strong><span class="px-3">|</span><em>{{ $area }} sqft</em></p>
                                <!-- <p class="h4 d-inline-block mb-3">{{ $title }}</p> -->
                                <p class="mb-3">Developed By {{ $builder_name }}</p>
                                <!-- <p class="mb-3">{{ $description }}</p> -->
                                <p class="mb-3">{{ $address }}</p>
                            </div>
                        </div>
                    </a>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const fullHouseRadio = document.getElementById("full_house_buy");
        const landPlotRadio = document.getElementById("land_plot_buy");
        const bhkStatusFields = document.querySelectorAll(".bhk-status");

        function toggleFields() {
            if (landPlotRadio.checked) {
                bhkStatusFields.forEach(field => field.style.display = "none");
            } else {
                bhkStatusFields.forEach(field => field.style.display = "block");
            }
        }

        // Attach event listeners
        fullHouseRadio.addEventListener("change", toggleFields);
        landPlotRadio.addEventListener("change", toggleFields);

        // Initial state check
        toggleFields();
    });
</script>

@endsection
