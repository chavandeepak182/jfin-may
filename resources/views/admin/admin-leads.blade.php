@extends('layouts.header')
@section('title')
    @parent
    JFS | Dashboard
@endsection
@section('content')
    @parent


<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid bg-white">
            <!-- Content Row for Cards -->
            <div class="row pt-5 pb-5 justify-content-center card-row">
                <!-- Card 1 -->
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('enquiries.enquiryLead') }}" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Enquiry Leads</h6>
                            <h2>{{ $enquiries }}</h2>
                        </div>
                    </a>
                </div>


                <!-- Card 2 -->
                <div class="col-md-3 col-sm-6">
                    <a href="/admin/leads" style="text-decoration: none;">
                        <div class="text-center dash-card">
                            <h6>All Leads</h6>
                            <h2>{{ $leads }}</h2>
                            
                                                   
                        </div>
                    </a>
                </div>

                <!-- Card 3 -->
                
                <!-- card 4 -->
                 
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @parent
    <!-- Page level plugins -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
@endsection