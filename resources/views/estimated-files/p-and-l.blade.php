@extends('layouts.header')

@section('title')
    @parent
    JFS | Monthly P&L
@endsection

@section('content')
@parent

<div class="card-header py-3">
    <div class="d-flex justify-content-between align-items-center">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Monthly P&L</li>
            </ol>
        </nav>

        <a href="{{ route('estimatedFile.index') }}" class="btn btn-light border">
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
        <div class="row g-3">
            <input class="form-control calc col" id="staff_cost" placeholder="Staff Cost">
            <input class="form-control calc col" id="staff_incentive" placeholder="Staff Incentive">
            <input class="form-control calc col" id="broker_commission" placeholder="Broker Commission">
            <input class="form-control col" id="salary_total" placeholder="Total" readonly>
        </div>

        <hr>

        {{-- ADMIN --}}
        <h6>Administration / Overheads</h6>
        <div class="row g-3">
            <input class="form-control calc col" id="rental" placeholder="Rental">
            <input class="form-control calc col" id="opex" placeholder="OPEX">
            <input class="form-control col" id="admin_overheads" placeholder="Total" readonly>
        </div>

        <hr>

        {{-- COST --}}
        <h6>Cost</h6>
        <div class="row g-3">
            <input class="form-control calc col" id="cso_cost" placeholder="CSO Cost">
            <input class="form-control calc col" id="admin_fixed_cost" placeholder="Admin Cost">
            <input class="form-control calc col" id="travel_cost" placeholder="Travel">
            <input class="form-control col" id="tds" placeholder="TDS (5%)" readonly>
            <input class="form-control col" id="cost_total" placeholder="Total Cost" readonly>
        </div>
        <div class="row g-3 mt-3">
    <div class="col-md-3">
        <label>Total Cost</label>
        <input type="number" id="total_cost" class="form-control" readonly>
    </div>
</div>

        <hr>

        {{-- FINAL --}}
        <div class="row g-3">
            <input class="form-control col" id="net_profit" placeholder="Net Profit" readonly>
            <input class="form-control calc col" id="manager_pl" placeholder="Manager P&L">
            <input class="form-control col" id="net_company" placeholder="Net To Company" readonly>
        </div>

    </div>
    <button class="btn btn-primary" id="savePL">
    Save Monthly P&L
</button>
</div>
@push('scripts')
<script>
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
</script>
@endpush

@endsection
