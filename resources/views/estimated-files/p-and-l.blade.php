@extends('layouts.header')

@section('title')
    @parent
    JFS | Monthly P&L
@endsection

@section('content')
@parent
<style>
    .abbr {
    position: relative;
    cursor: pointer;
}


/* Tooltip Box */
.abbr::after {
    content: attr(data-title);
    position: absolute;
    bottom: 130%;
    left: 50%;
    transform: translateX(-50%) translateY(10px);
    
    background: #1e293b;
    color: #fff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 13px;
    white-space: nowrap;
    
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10;
}

/* Small Arrow */
.abbr::before {
    content: "";
    position: absolute;
    bottom: 120%;
    left: 50%;
    transform: translateX(-50%);
    
    border-width: 6px;
    border-style: solid;
    border-color: #1e293b transparent transparent transparent;
    
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

/* Hover Effect */
.abbr:hover::after,
.abbr:hover::before {
    opacity: 1;
    visibility: visible;
    transform: translateX(-15%) translateY(0);
}
</style>

<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Monthly P&L</li>
            </ol>
        </nav>

        <a href="{{ route('monthlyPL.list') }}" class="btn btn-light border">
            Back
        </a>
    </div>
</div>

<div class="row bg-white">
    <div class="col-lg-12 p-4">

        {{-- STEP 1 --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <label>Month</label>
                <select id="pl_month" class="form-control">
                    @for($m=1;$m<=12;$m++)
                        <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label>Year</label>
                <select id="pl_year" class="form-control">
                    @for($y=date('Y');$y>=2020;$y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3 align-self-end">
                <button type="button" id="fetchPL" class="btn btn-primary">
                    Fetch Data
                </button>
            </div>
        </div>

        {{-- REVENUE --}}
        <h6>Revenue</h6>
        <div class="row g-3">
            <div class="col-md-3">
                <label>Gross Revenue – Loan</label>
                <input id="gross_revenue" class="form-control" readonly>
            </div>
            <div class="col-md-3">
                <label>Insurance</label>
                <input id="insurance" class="form-control calc">
            </div>
            <div class="col-md-3">
                <label>Revenue Total</label>
                <input id="revenue_total" class="form-control" readonly>
            </div>
        </div>

        <hr>

        {{-- SALARY --}}
        <h6>Salary / Incentive / Broker</h6>
        <!-- <div class="row g-3">
            <label>Staff Cost</label>
            <input class="form-control calc col" id="staff_cost" placeholder="Staff Cost">
            <label>Staff Incentive</label>
            <input class="form-control calc col" id="staff_incentive" placeholder="Staff Incentive">
            <label>Broker Commission</label>
            <input class="form-control calc col" id="broker_commission" placeholder="Broker Commission">
            <label> Total</label>
            <input class="form-control col" id="salary_total" placeholder="Total" readonly>
        </div> -->
        <div class="row g-3 align-items-end">

    <div class="col-md-3">
        <label class="form-label">Staff Cost</label>
        <input class="form-control calc" id="staff_cost" placeholder="Staff Cost">
    </div>

    <div class="col-md-3">
        <label class="form-label">Staff Incentive</label>
        <input class="form-control calc" id="staff_incentive" placeholder="Staff Incentive">
    </div>

    <div class="col-md-3">
        <label class="form-label">Broker Commission</label>
        <input class="form-control calc" id="broker_commission" placeholder="Broker Commission">
    </div>

    <div class="col-md-3">
        <label class="form-label">Total</label>
        <input class="form-control" id="salary_total" placeholder="Total" readonly>
    </div>

</div>


        <hr>

        {{-- ADMIN --}}
        <h6>Administration / Overheads</h6>
        <!-- <div class="row g-3">
            <input class="form-control calc col" id="rental" placeholder="Rental">
            <input class="form-control calc col" id="opex" placeholder="OPEX">
            <input class="form-control col" id="admin_overheads" placeholder="Total" readonly>
        </div> -->
        <div class="row g-3">

    <div class="col">
        <label class="form-label">Office Rental</label>
        <input class="form-control calc" id="rental" placeholder="Rental">
    </div>

    <div class="col">
        <label class="form-label">Operation Expense</label>
        <input class="form-control calc" id="opex" placeholder="OPEX">
    </div>

    <div class="col">
        <label class="form-label">Total</label>
        <input class="form-control" id="admin_overheads" placeholder="Total" readonly>
    </div>

</div>


        <hr>

        {{-- COST --}}
        <h6>Cost</h6>
        <!-- <div class="row g-3">
            <input class="form-control calc col" id="cso_cost" placeholder="CSO Cost">
            <input class="form-control calc col" id="admin_fixed_cost" placeholder="Admin Cost">
            <input class="form-control calc col" id="travel_cost" placeholder="Travel">
            <input class="form-control col" id="tds" placeholder="TDS (5%)" readonly>
            <input class="form-control col" id="cost_total" placeholder="Total Cost" readonly>
        </div> -->
        <div class="row g-3">

    <div class="col">
        <label class="form-label"><span class="abbr" data-title="Customer Service Operations Cost">CSO Cost</span></label>
        <input class="form-control calc" id="cso_cost" placeholder="CSO Cost">
    </div>

    <div class="col">
        <label class="form-label">Admin Cost</label>
        <input class="form-control calc" id="admin_fixed_cost" placeholder="Admin Cost">
    </div>

    <div class="col">
        <label class="form-label">Travel</label>
        <input class="form-control calc" id="travel_cost" placeholder="Travel">
    </div>

    <div class="col">
        <label class="form-label"><span class="abbr" data-title=" Tax Deducted at Source">TDS (5%)</span></label>
        <input class="form-control" id="tds" placeholder="TDS (5%)" readonly>
    </div>

    <div class="col">
        <label class="form-label">Total Cost</label>
        <input class="form-control" id="cost_total" placeholder="Total Cost" readonly>
    </div>

</div>

        <div class="row g-3 mt-3">
    <div class="col-md-3">
        <label>Total Cost</label>
        <input type="number" id="total_cost" class="form-control" readonly>
    </div>
</div>

        <hr>

        {{-- FINAL --}}
        <!-- <div class="row g-3">
            <input class="form-control col" id="net_profit" placeholder="Net Profit" readonly>
            <input class="form-control calc col" id="manager_pl" placeholder="Manager P&L">
            <input class="form-control col" id="net_company" placeholder="Net To Company" readonly>
        </div> -->
        <div class="row g-3">

    <div class="col">
        <label class="form-label">Net Profit</label>
        <input class="form-control" id="net_profit" placeholder="Net Profit" readonly>
    </div>

    <div class="col">
        <label class="form-label">Manager P&amp;L</label>
        <input class="form-control calc" id="manager_pl" placeholder="Manager P&L">
    </div>

    <div class="col">
        <label class="form-label">Net To Company</label>
        <input class="form-control" id="net_company" placeholder="Net To Company" readonly>
    </div>

</div>


    </div>
    <button class="btn btn-primary" id="savePL">
    Save Monthly P&L
</button>
</div>
@push('scripts')
<!-- <script>
/* ================= GLOBAL HELPERS ================= */
function v(id){
    return parseFloat(document.getElementById(id)?.value) || 0;
}

/* ================= DOM READY ================= */
document.addEventListener('DOMContentLoaded', function(){

    function calculatePL(){

        // STEP 2: REVENUE
        const revenueTotal = v('gross_revenue') + v('insurance');
        revenue_total.value = revenueTotal.toFixed(2);

        // STEP 3: SALARY
        const salaryTotal = v('staff_cost') + v('staff_incentive') + v('broker_commission');
        salary_total.value = salaryTotal.toFixed(2);

        // STEP 4: ADMIN
        const adminOverheads = v('rental') + v('opex');
        admin_overheads.value = adminOverheads.toFixed(2);

        // STEP 5: COST
        const tds = v('gross_revenue') * 0.05;
        document.getElementById('tds').value = tds.toFixed(2);

        const cost = v('cso_cost') + v('admin_fixed_cost') + v('travel_cost') + tds;
        cost_total.value = cost.toFixed(2);

        // STEP 6: TOTAL COST
        const totalCost = salaryTotal + adminOverheads + cost;
        document.getElementById('total_cost').value = totalCost.toFixed(2);

        // STEP 7: NET PROFIT
        const netProfit = revenueTotal - totalCost;
        net_profit.value = netProfit.toFixed(2);

        // STEP 9: NET TO COMPANY
        net_company.value = (netProfit - v('manager_pl')).toFixed(2);
    }

    /* FETCH GROSS REVENUE */
    fetchPL.addEventListener('click', function(){
        fetch(`{{ route('monthlyPL.grossRevenue') }}?month=${pl_month.value}&year=${pl_year.value}`)
            .then(res => res.json())
            .then(d => {
                gross_revenue.value = d.gross;
                calculatePL();
            });
    });

    /* AUTO CALC */
    document.querySelectorAll('.calc').forEach(el =>
        el.addEventListener('input', calculatePL)
    );

    /* SAVE BUTTON */
    document.getElementById('savePL').addEventListener('click', function(){

        const payload = {
            _token: '{{ csrf_token() }}',
            month: pl_month.value,
            year: pl_year.value,

            gross_revenue: v('gross_revenue'),
            insurance: v('insurance'),
            revenue_total: v('revenue_total'),

            staff_cost: v('staff_cost'),
            staff_incentive: v('staff_incentive'),
            broker_commission: v('broker_commission'),
            salary_total: v('salary_total'),

            rental: v('rental'),
            opex: v('opex'),
            admin_overheads: v('admin_overheads'),

            cso_cost: v('cso_cost'),
            admin_fixed_cost: v('admin_fixed_cost'),
            travel_cost: v('travel_cost'),
            tds: v('tds'),
            cost_total: v('cost_total'),

            total_cost: v('total_cost'),
            net_profit: v('net_profit'),
            manager_pl: v('manager_pl'),
            net_company: v('net_company')
        };

        fetch('{{ route('monthlyPL.store') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(d => alert(d.message))
        .catch(() => alert('Save failed'));
    });

});
</script> -->
<script>
/* ================= GLOBAL HELPERS ================= */
function v(id) {
    return parseFloat(document.getElementById(id)?.value) || 0;
}

/* ================= DOM READY ================= */
document.addEventListener('DOMContentLoaded', function () {

    let isSaving = false; // 🔒 prevent duplicate save

    function calculatePL() {

        const revenueTotal = v('gross_revenue') + v('insurance');
        revenue_total.value = revenueTotal.toFixed(2);

        const salaryTotal = v('staff_cost') + v('staff_incentive') + v('broker_commission');
        salary_total.value = salaryTotal.toFixed(2);

        const adminOverheads = v('rental') + v('opex');
        admin_overheads.value = adminOverheads.toFixed(2);

        const tds = v('gross_revenue') * 0.05;
        document.getElementById('tds').value = tds.toFixed(2);

        const cost = v('cso_cost') + v('admin_fixed_cost') + v('travel_cost') + tds;
        cost_total.value = cost.toFixed(2);

        const totalCost = salaryTotal + adminOverheads + cost;
        document.getElementById('total_cost').value = totalCost.toFixed(2);

        const netProfit = revenueTotal - totalCost;
        net_profit.value = netProfit.toFixed(2);

        net_company.value = (netProfit - v('manager_pl')).toFixed(2);
    }

    /* FETCH GROSS REVENUE */
    fetchPL.addEventListener('click', function () {
        fetch(`{{ route('monthlyPL.grossRevenue') }}?month=${pl_month.value}&year=${pl_year.value}`)
            .then(res => res.json())
            .then(d => {
                gross_revenue.value = d.gross;
                calculatePL();
            });
    });

    /* AUTO CALC */
    document.querySelectorAll('.calc').forEach(el =>
        el.addEventListener('input', calculatePL)
    );

    /* SAVE BUTTON */
    const saveBtn = document.getElementById('savePL');

    saveBtn.onclick = function () {

        if (isSaving) return;
        isSaving = true;
        saveBtn.disabled = true; // 🔒 hard lock button

        const payload = {
            _token: '{{ csrf_token() }}',
            month: pl_month.value,
            year: pl_year.value,

            gross_revenue: v('gross_revenue'),
            insurance: v('insurance'),
            revenue_total: v('revenue_total'),

            staff_cost: v('staff_cost'),
            staff_incentive: v('staff_incentive'),
            broker_commission: v('broker_commission'),
            salary_total: v('salary_total'),

            rental: v('rental'),
            opex: v('opex'),
            admin_overheads: v('admin_overheads'),

            cso_cost: v('cso_cost'),
            admin_fixed_cost: v('admin_fixed_cost'),
            travel_cost: v('travel_cost'),
            tds: v('tds'),
            cost_total: v('cost_total'),

            total_cost: v('total_cost'),
            net_profit: v('net_profit'),
            manager_pl: v('manager_pl'),
            net_company: v('net_company')
        };

        fetch('{{ route('monthlyPL.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Monthly P&L added successfully',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('monthlyPL.list') }}";
            });
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong'
            });
            saveBtn.disabled = false;
            isSaving = false;
        });
    };

});
</script>



@endpush

@endsection
