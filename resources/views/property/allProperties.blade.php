
@extends('layouts.header')

@section('title')
@parent
JFS | Add Property
@endsection

@section('content')






<style>

    .search-row{
    display:flex;
    gap:15px;
    width:100%;
}

.search-box,
.type-box{
    flex:1;   /* both same width */
}

.search-box{
    position:relative;
}

.search-box i{
    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:#6c757d;
}

.search-box input,
.type-box select{
    width:100%;
    height:45px;
    padding:10px 15px 10px 40px;
    border-radius:8px;
    border:1px solid #ddd;
    outline:none;
    transition:0.3s;
}

.type-box select{
    padding-left:15px; /* icon padding remove */
}

.search-box input:focus,
.type-box select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 2px rgba(37,99,235,0.1);
}
</style>

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
     data-section="all">

            <div class="property-stat-icon blue"><i class="fas fa-building"></i></div>
            <div class="property-stat-content">
                <h3>Total Properties</h3>
                <div class="property-stat-value">{{ $properties }}</div>
                <span class="property-stat-status">Tracked from Records</span>
            </div>
        </div>
 <div class="property-stat-card card-toggle {{ $status == 'verified' ? 'active' : '' }}" 
     data-section="verified">

    <div class="property-stat-icon green">
        <i class="fas fa-check-circle"></i>
    </div>

    <div class="property-stat-content">
        <h3>Verified Properties</h3>
        <div class="property-stat-value">
            {{ $totalVerifiedProperties }}
        </div>
        <span class="property-stat-status">
            Active Listings
        </span>
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

       
            
         
        

    </div>

    <!-- ================= FILTERS ================= -->
<div class="search-wrapper">
    <form id="searchForm" method="GET" action="{{ route('allProperties') }}">
        <input type="hidden" name="status" value="{{ $status }}">

        <div class="search-row">

            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text"
                       name="search"
                       id="searchInput"
                       value="{{ request('search') }}"
                       placeholder="Search by title, builder or address...">
            </div>

            <div class="type-box">
                <select name="type" id="typeFilter">
                    <option value="all">All Types</option>
                    <option value="Residential" {{ request('type')=='Residential'?'selected':'' }}>Residential</option>
                    <option value="Commercial" {{ request('type')=='Commercial'?'selected':'' }}>Commercial</option>
                    <option value="Industrial" {{ request('type')=='Industrial'?'selected':'' }}>Industrial</option>
                </select>
            </div>

        </div>
    </form>
</div>
<br><br>
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
    <div class="d-flex gap-2">

        <a class="btn btn-info btn-sm"
           href="{{ url('viewDetails/'.$p->properties_id) }}">
            <i class="fa fa-eye"></i>
        </a>

        <a class="btn btn-warning btn-sm"
           href="{{ url('editProperty/'.$p->properties_id) }}">
            <i class="fa fa-edit"></i>
        </a>

        <button class="btn btn-danger btn-sm"
            onclick="deletePropertie('{{ $p->properties_id }}')">
            <i class="fa fa-trash"></i>
        </button>

    </div>
</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
   {{ $data['allProperties']->withQueryString()->links('pagination::bootstrap-5') }}
</div>

            </div>
        </div>

    </div>

    <!-- ================= PROPERTY TAKERS SECTION ================= -->
  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        {{-- SAME PAGE – ORIGINAL TAKER LIST --}}
        <!-- ================= PROPERTY TAKERS TABLE ================= -->

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

            let url = new URL("{{ route('allProperties') }}");
            url.searchParams.set('status', section);

            window.location.href = url.toString();

        });

    });

});
</script>




        
@endsection

@section('script')
@parent
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 



<script>
document.getElementById('source_by').addEventListener('change', function () {
    document.getElementById('agent_list').style.display =
        this.value === 'Agent' ? 'block' : 'none';

    document.getElementById('builder_input').style.display =
        this.value === 'Builder' ? 'block' : 'none';
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function(){

    const searchInput = document.getElementById("searchInput");
    const typeFilter = document.getElementById("typeFilter");
    const form = document.getElementById("searchForm");

    let timer;

    searchInput.addEventListener("keyup", function(){
        clearTimeout(timer);
        timer = setTimeout(() => {
            form.submit();
        }, 600); // 600ms delay
    });

    typeFilter.addEventListener("change", function(){
        form.submit();
    });

});
</script>
<script>
function deletePropertie(id){

    swal({
        title: "Are you sure?",
        text: "Delete this property?",
        icon: "warning",
        buttons: ["Cancel","Delete Property"],
        dangerMode: true,
    }).then((willDelete) => {

        if (willDelete) {

            $.ajax({
                url: "{{ route('deletePropertie') }}",
                type: "POST",
                data: {
                    propertie_id: id,   // ✅ important
                    _token: "{{ csrf_token() }}"
                },

                success:function(data){

                    swal(data.msg, "", "success")
                    .then(()=>{
                        location.reload();
                    });

                }

            });

        }

    });
}
</script>

@endsection