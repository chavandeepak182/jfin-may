@extends('layouts.header')
@section('title')
@parent
JFS | Add Property
@endsection
@section('content')

@section('content')
@parent
<!-- <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/> -->
<!-- <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/> -->
<!-- <link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet"/> -->
<!-- <div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">
      
        <nav aria-label="breadcrumb" class="d-flex align-items-center">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('partnerDashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Properties</li>
            </ol>
        </nav>
        <div class="row no-gutters" style="gap:10px;"> 
   
    <div class="col-auto">
        <a href="{{ route('pendingProperties') }}" style="text-decoration: none;">
            <div class="custom-btn" style="height:50px; width:150px; 
                        background: linear-gradient(135deg, #6a11cb, #2575fc); 
                        border-radius:12px; 
                        display:flex; align-items:center; justify-content:center;
                        color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                <span>Pending Property</span>
            </div>
        </a>
    </div>

    
    <div class="col-auto">
        <a href="{{ route('property_takers.index') }}" style="text-decoration: none;">
            <div class="custom-btn" style="height:50px; width:160px; 
                        background: linear-gradient(135deg, #ff512f, #dd2476); 
                        border-radius:12px; 
                        display:flex; align-items:center; justify-content:center;
                        color:white; font-weight:bold; 
                        box-shadow:0 4px 15px rgba(0,0,0,0.2);
                        transition:transform 0.2s ease, box-shadow 0.2s ease;">
                <span>All Property Taker</span>
            </div>
        </a>
    </div>
</div>


<style>
    .custom-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
</style>

        >
        <a class="btn btn-primary"  href="{{ route('addProperty') }}" ><i class="fa fa-plus"></i>  Add Propertie</a>
    </div>
</div> -->

@php
    $status = request('status', 'all'); // all | pending
@endphp

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"/>

<div class="properties-page">

    <!-- ================= PAGE HEADER ================= -->
    <div class="page-header">
        <div>
            <h1 id="pageTitle">Properties</h1>
            <p id="pageSubtitle">Manage and track all property listings</p>
        </div>

        <div class="header-actions" id="propertyAddBtn">
            <a href="{{ route('addProperty') }}"
               class="btn-new-application"
               style="text-decoration:none;">
                <i class="fas fa-plus"></i> Add Property
            </a>
        </div>

        <div class="header-actions" id="takerAddBtn" style="display:none">
            <button class="btn-new-application" data-bs-toggle="modal" data-bs-target="#addPartnerView">
                <i class="fas fa-plus"></i> Add Taker
            </button>
        </div>
    </div>

    <!-- ================= STATS CARDS ================= -->
    <div class="property-stats-grid">

        <div class="property-stat-card card-toggle active" data-section="properties">
            <div class="property-stat-icon blue"><i class="fas fa-building"></i></div>
            <div class="property-stat-content">
                <h3>Total Properties</h3>
                <div class="property-stat-value">{{ $properties }}</div>
                <span class="property-stat-status">Tracked from Records</span>
            </div>
        </div>

        <div class="property-stat-card card-toggle" data-section="pending">
            <div class="property-stat-icon orange"><i class="fas fa-clock"></i></div>
            <div class="property-stat-content">
                <h3>Pending Verification</h3>
                <div class="property-stat-value">{{ $totalPendingProperties }}</div>
                <span class="property-stat-status">Tracked from Records</span>
            </div>
        </div>

        <div class="property-stat-card card-toggle" data-section="takers">
            <div class="property-stat-icon green"><i class="fas fa-user"></i></div>
            <div class="property-stat-content">
                <h3>Property Takers</h3>
                <div class="property-stat-value">{{ $totalPropertyTakers }}</div>
                <span class="property-stat-status">Last 24 Hours</span>
            </div>
        </div>
        <div class="property-stat-card card-toggle" data-section="takers">
            <div class="property-stat-icon blue">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="property-stat-content">
                <h3>Total Value</h3>
                <div class="property-stat-value">45.2</div>
                <span class="property-stat-status">+7.1M increase</span>
            </div>
        </div>
         
        

    </div>

    <!-- ================= FILTERS ================= -->
    <div class="property-filters-section" id="propertyFilters">

        <div class="property-filter-buttons">
            <button class="property-filter-btn active" data-status="all">All Properties</button>
            <button class="property-filter-btn" data-status="verified">Verified</button>
            <button class="property-filter-btn" data-status="pending">Pending</button>
        </div>

        <div class="property-search-section">
            <div class="property-search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="propertySearch" placeholder="Search properties...">
            </div>

            <select id="propertyType" class="property-type-filter">
                <option value="all">All Types</option>
                <option value="Residential">Residential</option>
                <option value="Commercial">Commercial</option>
                <option value="Industrial">Industrial</option>
            </select>
        </div>

    </div>

    <!-- ================= PROPERTIES TABLE ================= -->
    <div id="propertiesSection">

        <div class="card shadow mb-4">
            <div class="card-body table-responsive">

                <table id="propertiesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Builder</th>
                            <th>BHK</th>
                            <th>Address</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($data['allProperties'] as $p)
                        <tr
                            data-status="{{ ($p->is_active ?? 0) == 1 ? 'verified' : 'pending' }}"
                            data-type="{{ $p->category_name }}"
                        >
                            <td>{{ $p->title }}</td>
                            <td>{{ $p->category_name }}</td>
                            <td>{{ $p->builder_name }}</td>
                            <td>{{ $p->select_bhk }} BHK</td>
                            <td>{{ $p->address }}</td>
                            <td>{{ $p->from_price }} to {{ $p->to_price }}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ url('viewDetails/'.$p->properties_id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-primary btn-xs" href="{{ url('editProperty/'.$p->properties_id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-xs"
                                    onclick="deletePropertie('{{ $p->properties_id }}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
    {{ $data['allProperties']->links('pagination::bootstrap-5') }}
</div>

            </div>
        </div>

    </div>

    <!-- ================= PROPERTY TAKERS SECTION ================= -->
  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        {{-- SAME PAGE – ORIGINAL TAKER LIST --}}
        <!-- ================= PROPERTY TAKERS TABLE ================= -->
<div id="takersSection" style="display:none">

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive" id="property_takers_table">

                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Builder Name</th>
                            <th>Project Name</th>
                            <th>Property Type</th>
                            <th>Carpet Area</th>
                            <th>Built-up Area</th>
                            <th>Total Charges</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($propertyTakers as $index => $propertyTaker)
                        <tr>
                            <td>{{ $propertyTakers->firstItem() + $index }}</td>
                            <td>{{ $propertyTaker->builder_name }}</td>
                            <td>{{ $propertyTaker->project_name }}</td>
                            <td>{{ $propertyTaker->property_type }}</td>
                            <td>{{ $propertyTaker->carpet_area }}</td>
                            <td>{{ $propertyTaker->builtup_area }}</td>
                            <td>{{ $propertyTaker->total_charges }}</td>
                            <td>
                                <a class="btn btn-info btn-xs"
                                   href="{{ route('property_takers.view', $propertyTaker->id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-warning btn-xs"
                                   href="{{ route('property_takers.edit', $propertyTaker->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('property_takers.destroy', $propertyTaker->id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-xs"
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Property Takers Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="float-right">
                    {{ $propertyTakers->links() }}
                </div>

            </div>
        </div>
    </div>

</div>


    </div>

</div>

<!-- ================= CSS ================= -->
<style>
.card-toggle{ cursor:pointer }
.card-toggle.active{ outline:2px solid #2563eb }
.property-filter-btn.active{ background:#2563eb;color:#fff }
</style>

<!-- ================= JS ================= -->
<script>
let currentStatus = 'all';

const propertiesSection = document.getElementById('propertiesSection');
const takersSection = document.getElementById('takersSection');
const propertyAddBtn = document.getElementById('propertyAddBtn');
const takerAddBtn = document.getElementById('takerAddBtn');
const filterBox = document.getElementById('propertyFilters');

const rows = document.querySelectorAll('#propertiesTable tbody tr');
const searchInput = document.getElementById('propertySearch');
const typeSelect = document.getElementById('propertyType');
const filterBtns = document.querySelectorAll('.property-filter-btn');

/* CARD CLICK */
document.querySelectorAll('.card-toggle').forEach(card=>{
    card.onclick=()=>{
        document.querySelectorAll('.card-toggle').forEach(c=>c.classList.remove('active'));
        card.classList.add('active');

        const section = card.dataset.section;

        if(section === 'takers'){
            propertiesSection.style.display='none';
            takersSection.style.display='block';
            propertyAddBtn.style.display='none';
            takerAddBtn.style.display='block';
            filterBox.style.display='none';
        }else{
            takersSection.style.display='none';
            propertiesSection.style.display='block';
            propertyAddBtn.style.display='block';
            takerAddBtn.style.display='none';
            filterBox.style.display='flex';
            currentStatus = section === 'pending' ? 'pending' : 'all';
            applyFilters();
        }
    }
});

/* FILTERS */
filterBtns.forEach(btn=>{
    btn.onclick=()=>{
        filterBtns.forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        currentStatus = btn.dataset.status;
        applyFilters();
    }
});
searchInput.onkeyup=applyFilters;
typeSelect.onchange=applyFilters;

function applyFilters(){
    const q=searchInput.value.toLowerCase();
    const type=typeSelect.value;
    rows.forEach(row=>{
        const okStatus=currentStatus==='all'||row.dataset.status===currentStatus;
        const okType=type==='all'||row.dataset.type===type;
        const okSearch=row.innerText.toLowerCase().includes(q);
        row.style.display=(okStatus&&okType&&okSearch)?'':'none';
    });
}
</script>

<div class="modal fade" id="addPartnerView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Channel Partner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="user" id="addPartner" method="post">
                @csrf   
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Email ID:</label>
                        <input type="email" class="form-control" id="email_id" name="email_id" required>
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>    
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Mobile Number:</label>
                        <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required>
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Address:</label>
                        <input type="tel" class="form-control" id="address" name="address">
                    </div>
                </div>            
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">State:</label>
                        <input type="text" class="form-control" id="state" name="state" >
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="recipient-name" class="col-form-label">Pincode:</label>
                        <input type="text" class="form-control" id="pincode" name="pincode">
                    </div>
                </div>    
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>          
@endsection

@section('script')
@parent
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>


<!--export button -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 



<script>   
    $('#addPartner').on('submit',function(e){
        e.preventDefault();
        $.ajax({               
            url:"{{Route('insertPartner')}}", 
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
                    $('#addPartner').get(0).reset();   
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