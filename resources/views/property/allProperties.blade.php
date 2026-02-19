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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPropertyTakerView">
    + Add Property Taker
</button>

        </div>
    </div>

    <!-- ================= STATS CARDS ================= -->
    <div class="property-stats-grid">

        <div class="property-stat-card card-toggle {{ $status == 'all' ? 'active' : '' }}" 
     data-section="properties">

            <div class="property-stat-icon blue"><i class="fas fa-building"></i></div>
            <div class="property-stat-content">
                <h3>Total Properties</h3>
                <div class="property-stat-value">{{ $properties }}</div>
                <span class="property-stat-status">Tracked from Records</span>
            </div>
        </div>

       <div class="property-stat-card card-toggle {{ $status == 'pending' ? 'active' : '' }}" 
     data-section="pending">

            <div class="property-stat-icon orange"><i class="fas fa-clock"></i></div>
            <div class="property-stat-content">
                <h3>Pending Verification</h3>
                <div class="property-stat-value">{{ $totalPendingProperties }}</div>
                <span class="property-stat-status">Tracked from Records</span>
            </div>
        </div>

        <!-- <div class="property-stat-card card-toggle {{ $status == 'takers' ? 'active' : '' }}" 
     data-section="takers">
            <div class="property-stat-icon green"><i class="fas fa-user"></i></div>
            <div class="property-stat-content">
                <h3>Property Takers</h3>
                <div class="property-stat-value">{{ $totalPropertyTakers }}</div>
                <span class="property-stat-status">Last 24 Hours</span>
            </div>
        </div> -->
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
    <div id="propertiesSection" 
     style="{{ $status == 'takers' ? 'display:none;' : '' }}">


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
<div id="takersSection" 
     style="{{ $status == 'takers' ? '' : 'display:none;' }}">


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


   document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.card-toggle').forEach(card => {
        card.addEventListener('click', function () {

            const section = this.dataset.section;

            if(section === 'takers'){
                window.location.href = "{{ route('allProperties') }}?status=takers";
            }
            else if(section === 'pending'){
                window.location.href = "{{ route('allProperties') }}?status=pending";
            }
            else{
                window.location.href = "{{ route('allProperties') }}?status=all";
            }

        });
    });

});
</script>




<div class="modal fade" id="addPropertyTakerView" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-scrollable">
        <div class="modal-content">

            <!-- MODAL HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Add Property Taker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body">
                <form method="POST" action="{{ route('property_takers.store') }}">
                    @csrf

                    <div class="row g-3">

                        <!-- BASIC DETAILS -->
                        <div class="col-md-4">
                            <label>Builder Name *</label>
                            <input type="text" name="builder_name" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label>Project Name *</label>
                            <input type="text" name="project_name" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label>Property Type *</label>
                            <input type="text" name="property_type" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label>Carpet Area (sqft) *</label>
                            <input type="number" step="0.01" name="carpet_area" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label>Built-up Area (sqft) *</label>
                            <input type="number" step="0.01" name="builtup_area" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label>Registration Number *</label>
                            <input type="text" name="registration_number" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Property Address *</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <!-- COST DETAILS -->
                        <div class="col-md-3">
                            <label>Agreement Cost *</label>
                            <input type="number" step="0.01" name="actual_agreement_cost" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>GST % *</label>
                            <input type="number" step="0.01" name="gst" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Extra Charges</label>
                            <input type="number" step="0.01" name="extra_charges" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Registration Fees *</label>
                            <input type="number" step="0.01" name="registration_fees" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Stamp Duty % *</label>
                            <input type="number" step="0.01" name="stamp_duty_percentage" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Other Charges</label>
                            <input type="number" step="0.01" name="any_other_charges" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Total Charges *</label>
                            <input type="number" step="0.01" name="total_charges" class="form-control" required>
                        </div>

                        <!-- SOURCE DETAILS -->
                        <div class="col-md-3">
                            <label>Source By *</label>
                            <select name="source_by" id="source_by" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Agent">Agent</option>
                                <option value="Builder">Builder</option>
                            </select>
                        </div>

                        <div class="col-md-3" id="agent_list" style="display:none;">
                            <label>Select Agent</label>
                            <select name="source_name_agent" class="form-control">
                                <option value="">Select Agent</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->name }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3" id="builder_input" style="display:none;">
                            <label>Source Name</label>
                            <input type="text" name="source_name_builder" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Agreement Date *</label>
                            <input type="date" name="agreement_date" class="form-control" required>
                        </div>

                    </div>

                    <!-- MODAL FOOTER -->
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            SAVE DETAILS
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
>          
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
document.getElementById('source_by').addEventListener('change', function () {
    document.getElementById('agent_list').style.display =
        this.value === 'Agent' ? 'block' : 'none';

    document.getElementById('builder_input').style.display =
        this.value === 'Builder' ? 'block' : 'none';
});
</script>

@endsection