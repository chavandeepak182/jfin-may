@extends('layouts.header')

@section('title','Analytics')

@section('content')

<div class="analytics-page">

    <!-- HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1>Analytics</h1>
            <p>Comprehensive analytics and reporting</p>
        </div>

        <div class="header-actions">
            <button class="btn btn-secondary">Export</button>

  <button class="btn btn-primary" onclick="openAddLeadModal()">
    Add Lead
</button>



            <button id="btnAddMIS" class="btn btn-primary d-none"
                    data-bs-toggle="modal" data-bs-target="#addMISView">
                + Add MIS
            </button>

            <a href="{{ route('loanbanks') }}" id="btnAddBank"
               class="btn btn-primary d-none">
                + Add Loan Bank
            </a>
        </div>
    </div>

    <!-- CARDS -->
    <div class="analytics-summary-grid">

        <div class="analytics-card blue-card active"
             onclick="showSection('online', this)">
            <h3>Online Leads</h3>
            <h2>{{ count($enquiries) }}</h2>
        </div>

        <div class="analytics-card green-card"
             onclick="showSection('all', this)">
            <h3>All Leads</h3><br>
            <h2>{{ $allLeads->total() }}</h2>
        </div>

        <div class="analytics-card yellow-card"
             onclick="showSection('mis', this)">
            <h3>All MIS</h3>
            <h2>{{ $totalMIS }}</h2>
        </div>

        <div class="analytics-card green-card"
             onclick="showSection('banks', this)">
            <h3>Loan Banks</h3>
            <h2>{{ $totalLoanBanks }}</h2>
        </div>

    </div>

    <!-- TABLE WRAPPER -->
    <div class="table-card-large mt-4">

        <h3 id="tableTitle">Online Leads</h3>
        <p id="tableSubTitle">Website enquiries</p>

        <!-- ONLINE -->
        <div id="section-online">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Message</th>
                </tr>
                </thead>
                <tbody>
                @foreach($enquiries as $e)
                    <tr>
                        <td>{{ $e->enquiry_id }}</td>
                        <td>{{ $e->name }}</td>
                        <td>{{ $e->email }}</td>
                        <td>{{ $e->contact }}</td>
                        <td>{{ $e->message }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- ALL LEADS -->
        <div id="section-all" class="d-none">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Email</th><th>Phone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allLeads as $i => $lead)
                    <tr>
                        <td>{{ $allLeads->firstItem() + $i }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $allLeads->links() }}
        </div>

        <!-- MIS -->
        <div id="section-mis" class="d-none">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th><th>Amount</th><th>City</th>
                </tr>
                </thead>
                <tbody>
                @foreach($misRecords as $mis)
                    <tr>
                        <td>{{ $mis->name }}</td>
                        <td>{{ $mis->amount }}</td>
                        <td>{{ $mis->city }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $misRecords->links() }}
        </div>

        <!-- BANKS -->
        <div id="section-banks" class="d-none">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Bank</th><th>IFSC</th><th>Branch</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loanBanks as $b)
                    <tr>
                        <td>{{ $b->bank_name }}</td>
                        <td>{{ $b->ifsc_code }}</td>
                        <td>{{ $b->branch_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $loanBanks->links() }}
        </div>

    </div>
</div>

<!-- ADD / EDIT LEAD MODAL -->
<div class="modal fade" id="leadModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <form id="leadForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="leadFormMethod">
                <input type="hidden" name="lead_id" id="lead_id">

                <!-- HEADER -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="leadModalTitle">Add Lead</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body bg-white p-4">
                    <div class="row g-3">

                        <div class="col-md-3">
                            <label>Full Name *</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Email *</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Phone *</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label>Alternate Phone</label>
                            <input type="text" name="alternate_phone" id="alternate_phone" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Lead Source *</label>
                            <select name="lead_source" id="lead_source" class="form-control" required>
                                <option value="Website">Website</option>
                                <option value="Referral">Referral</option>
                                <option value="Social Media">Social Media</option>
                                <option value="Walk-in">Walk-in</option>
                                <option value="Call">Call</option>
                                <option value="Agent">Agent</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Builder / Project</label>
                            <input type="text" name="campaign_name" id="campaign_name" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Interested In *</label>
                            <select name="property_type" id="property_type" class="form-control" required>
                                <option value="Apartment">Apartment</option>
                                <option value="Villa">Villa</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Land">Land</option>
                                <option value="Office">Office</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Assigned Agent *</label>
                            <select name="assigned_to" id="assigned_to" class="form-control" required>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Budget *</label>
                            <div class="d-flex gap-2">
                                <input type="number" name="budget_min" id="budget_min" class="form-control" placeholder="Min">
                                <input type="number" name="budget_max" id="budget_max" class="form-control" placeholder="Max">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>Location *</label>
                            <input type="text" name="location_preference" id="location_preference" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Possession *</label>
                            <select name="possession_time" id="possession_time" class="form-control">
                                <option value="Ready To Move">Ready To Move</option>
                                <option value="3 Months">3 Months</option>
                                <option value="6 Months">6 Months</option>
                                <option value="1 Year">1 Year</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Lead Status *</label>
                            <select name="lead_status" id="lead_status" class="form-control">
                                <option value="New">New</option>
                                <option value="Contacted">Contacted</option>
                                <option value="Interested">Interested</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Follow-up Date</label>
                            <input type="date" name="follow_up_date" id="follow_up_date" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label>Notes</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>

                    </div>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="leadSubmitBtn">
                        SAVE LEAD
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>



@endsection

@section('script')
<script>
function showSection(type, el) {

    // Active card
    document.querySelectorAll('.analytics-card')
        .forEach(c => c.classList.remove('active'));
    el.classList.add('active');

    // Hide all sections safely
    ['online','all','mis','banks'].forEach(s => {
        const sec = document.getElementById('section-'+s);
        if(sec) sec.classList.add('d-none');
    });

    // Hide buttons safely
    ['btnAddLead','btnAddMIS','btnAddBank'].forEach(id => {
        const btn = document.getElementById(id);
        if(btn) btn.classList.add('d-none');
    });

    // Show section
    document.getElementById('section-'+type).classList.remove('d-none');

    // Titles
    const map = {
        online:['Online Leads','Website enquiries'],
        all:['All Leads','All available leads'],
        mis:['All MIS','MIS records'],
        banks:['Loan Banks','Available banks']
    };

    tableTitle.innerText = map[type][0];
    tableSubTitle.innerText = map[type][1];

    // Buttons
    if(type === 'all') btnAddLead.classList.remove('d-none');
    if(type === 'mis') btnAddMIS.classList.remove('d-none');
    if(type === 'banks') btnAddBank.classList.remove('d-none');
}
</script>

<script>
function openAddLeadModal() {
    document.getElementById('leadForm').reset();

    document.getElementById('leadModalTitle').innerText = 'Add Lead';
    document.getElementById('leadSubmitBtn').innerText = 'SAVE LEAD';

    document.getElementById('leadForm').action = "{{ route('leads.store') }}";
    document.getElementById('leadFormMethod').value = '';

    new bootstrap.Modal(document.getElementById('leadModal')).show();
}

function openEditLeadModal(lead) {

    document.getElementById('leadModalTitle').innerText = 'Edit Lead';
    document.getElementById('leadSubmitBtn').innerText = 'UPDATE LEAD';

    document.getElementById('leadForm').action = "/admin/leads/" + lead.id;
    document.getElementById('leadFormMethod').value = 'PUT';

    document.getElementById('name').value = lead.name ?? '';
    document.getElementById('email').value = lead.email ?? '';
    document.getElementById('phone').value = lead.phone ?? '';
    document.getElementById('alternate_phone').value = lead.alternate_phone ?? '';
    document.getElementById('lead_source').value = lead.lead_source ?? '';
    document.getElementById('property_type').value = lead.property_type ?? '';
    document.getElementById('assigned_to').value = lead.assigned_to ?? '';
    document.getElementById('follow_up_date').value = lead.follow_up_date ?? '';
    document.getElementById('notes').value = lead.notes ?? '';

    new bootstrap.Modal(document.getElementById('leadModal')).show();
}
</script>


@endsection
