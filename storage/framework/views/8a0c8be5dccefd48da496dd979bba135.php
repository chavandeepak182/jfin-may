<?php $__env->startSection('title', "Properties in Pune| Affordable property in PCMC - Jfinserv"); ?>
<?php $__env->startSection('description', "Looking for the Properties in Pune? Our Affordable property in PCMC  offers competitive offers to help you secure your dream home. Apply now."); ?>
<?php $__env->startSection('keywords', "Properties in Pune, Affordable property in PCMC, Houses for sell in Pune, Buy house in Pune"); ?>

<?php $__env->startSection('scripts', "https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"); ?>
<?php $__env->startSection('scripts2', "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"); ?>


<?php $__env->startSection('content'); ?>
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
                                <button class="nav-link active text-danger fw-bold" data-bs-toggle="tab" data-bs-target="#buyTab" data-tab="buy">Buy</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link text-muted" data-bs-toggle="tab" data-bs-target="#rentTab" data-tab="rent">Rent</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link text-muted" data-bs-toggle="tab" data-bs-target="#commercialTab" data-tab="commercial">Commercial</button>
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
                                            <button id="searchButton" class="btn btn-danger w-100 py-2 rounded-1">
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
                    <a href="<?php echo e(url('property-details/'.$v->properties_id)); ?>" target="_blank">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="<?php echo e($img); ?>" class="img-fluid rounded-top w-100" alt="" style="height: 250px">
                                <div class="blog-categiry py-2 px-4">
                                    <span><?php echo e($category); ?></span>
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <p class="mb-0"><?php echo e($beds); ?> BHK Flat</p>
                                <p class="mb-3 h4 d-inline-block"><strong>₹ <?php echo e($v->from_price); ?><sup>*</sup></strong><span class="px-3">|</span><em><?php echo e($area); ?> sqft</em></p>
                                <!-- <p class="h4 d-inline-block mb-3"><?php echo e($title); ?></p> -->
                                <p class="mb-3">Developed By <?php echo e($builder_name); ?></p>
                                <!-- <p class="mb-3"><?php echo e($description); ?></p> -->
                                <p class="mb-3"><?php echo e($address); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
           <?php 
           }
        ?>
        <div class="float-right"> 
            <?php echo e($data['allProperties']->links()); ?>

        </div>            
        </div>
    </div>
</div>

<div id="search_data"></div>
    


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
$(document).ready(function() {
    $('#searchButton').click(function(event) {
        event.preventDefault(); // ✅ Prevent page reload

        // ✅ Detect active tab correctly
        let activeTab = $('.nav-tabs .nav-link.active').data('tab'); 
        let propertyType = 1; // Default to "Buy"

        if (activeTab === "rent") {
            propertyType = 3; // Rent
        } else if (activeTab === "commercial") {
            propertyType = 2; // Commercial
        }

        let range_id = $('#range_id').val();
        let category_type = $('#category_type').val();
        let location_name = $('#location_name').val();

        $.ajax({
            url: "<?php echo e(url('search_properties')); ?>",
            type: "POST",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                property_type_id: propertyType, // ✅ Send the correct property type
                range_id: range_id,
                category_type: category_type,
                location_name: location_name
            },
            success: function(response) {
                $('#old_data').hide(); // ✅ Hide previous results
                $('#search_data').html(response); // ✅ Show filtered properties
                history.pushState(null, '', window.location.pathname); // ✅ Remove URL query params
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // ✅ Update active tab & ensure correct filtering
    $('.nav-link').click(function() {
        $('.nav-link').removeClass('text-danger fw-bold').addClass('text-muted'); // Reset styles
        $(this).addClass('text-danger fw-bold').removeClass('text-muted'); // Highlight active tab
    });

    // ✅ Prevent form submission when pressing "Enter"
    $('form').submit(function(event) {
        event.preventDefault();
    });
});
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u838013575/domains/jfinserv.com/public_html/resources/views/frontend/properties.blade.php ENDPATH**/ ?>