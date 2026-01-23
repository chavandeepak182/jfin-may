@extends($layout)

@section('content')

<style>
/* ===== Create Ticket Scoped UI ===== */

.ticket-create-wrapper{
    max-width: 800px;
    padding: 20px 10px;
}

.ticket-create-card{
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    padding: 20px;
}

.ticket-create-title{
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 15px;
    color:#1f2937;
}

.ticket-form-group{
    margin-bottom: 15px;
}

.ticket-form-group label{
    display:block;
    font-size:14px;
    font-weight:500;
    color:#374151;
    margin-bottom:5px;
}

.ticket-input,
.ticket-select,
.ticket-textarea{
    width:100%;
    padding:8px 10px;
    border:1px solid #d1d5db;
    border-radius:6px;
    font-size:14px;
    outline:none;
}

.ticket-input:focus,
.ticket-select:focus,
.ticket-textarea:focus{
    border-color:#2563eb;
}

.ticket-textarea{
    resize:vertical;
    min-height:90px;
}

.ticket-submit-btn{
    background:#2563eb;
    color:#fff;
    padding:9px 16px;
    border:none;
    border-radius:6px;
    font-size:14px;
    cursor:pointer;
    transition:0.2s;
}

.ticket-submit-btn:hover{
    background:#1d4ed8;
}

.ticket-row{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.ticket-col{
    flex:1;
    min-width:200px;
}
</style>


<div class="ticket-create-wrapper">

    <div class="ticket-create-card">

        <div class="ticket-create-title">Create Support Ticket</div>

        <form method="POST" action="{{ route('tickets.store') }}">
        @csrf

        {{-- ================= ADMIN UI ================= --}}
        @if(auth()->user()->role_id == config('constants.roles.admin'))

        <div class="ticket-row">

            <div class="ticket-col ticket-form-group">
                <label>Customer</label>
                <select id="user_select" name="user_id" class="ticket-select" required>
                    <option value="">-- Select User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="ticket-col ticket-form-group">
                <label>Loan</label>
                <select id="loan_select" name="loan_id" class="ticket-select">
                    <option value="">-- Select Loan --</option>
                </select>
            </div>

            <div class="ticket-col ticket-form-group">
                <label>Agent</label>
                <select id="agent_select" name="agent_id" class="ticket-select">
                    <option value="">-- No agent assigned --</option>
                </select>
            </div>

        </div>

        @endif


        {{-- ================= CUSTOMER UI ================= --}}
        @if(auth()->user()->role_id == config('constants.roles.customer'))

        <div class="ticket-form-group">
            <label>Select Your Loan</label>
            <select name="loan_id" class="ticket-select" required>
                <option value="">-- Select Loan --</option>
                @foreach(\App\Models\Loan::where('user_id', auth()->id())->get() as $loan)
                    <option value="{{ $loan->loan_id }}">
                        {{ $loan->loan_reference_id }}
                    </option>
                @endforeach
            </select>
        </div>

        @endif

        <!-- for agent -->
         @if(auth()->user()->role_id == config('constants.roles.agent'))

            <div class="ticket-row">

                <div class="ticket-col ticket-form-group">
                    <label>Customer</label>
                    <select id="agent_user_select" name="user_id" class="ticket-select" required>
                        <option value="">-- Select Customer --</option>
                        {{-- Loaded via AJAX --}}
                    </select>
                </div>

                <div class="ticket-col ticket-form-group">
                    <label>Loan</label>
                    <select id="agent_loan_select" name="loan_id" class="ticket-select" required>
                        <option value="">-- Select Loan --</option>
                    </select>
                </div>

            </div>

            @endif


        <div class="ticket-form-group">
            <label>Subject</label>
            <input type="text" name="subject" class="ticket-input" required>
        </div>

        <div class="ticket-form-group">
            <label>Message</label>
            <textarea name="message" class="ticket-textarea" placeholder="Enter ticket message..." required></textarea>
        </div>

        <button type="submit" class="ticket-submit-btn">Submit Ticket</button>

        </form>

    </div>

</div>


{{-- ================= ADMIN JS ================= --}}
<script>
/* ================= ADMIN ================= */

const userSelect  = document.getElementById('user_select');
const loanSelect  = document.getElementById('loan_select');
const agentSelect = document.getElementById('agent_select');

if(userSelect){

    userSelect.addEventListener('change', function(){

        let userId = this.value;

        loanSelect.innerHTML = '<option>Loading...</option>';
        agentSelect.innerHTML = '<option value="">-- No agent assigned --</option>';

        if(!userId){
            loanSelect.innerHTML = '<option value="">-- Select Loan --</option>';
            return;
        }

        fetch(`/admin/user/${userId}/loans`)
            .then(res => res.json())
            .then(data => {

                loanSelect.innerHTML = '<option value="">-- Select Loan --</option>';

                if(data.length === 0){
                    loanSelect.innerHTML += '<option value="">No loans found</option>';
                }

                data.forEach(loan => {
                    loanSelect.innerHTML += `
                        <option value="${loan.loan_id}">
                            ${loan.loan_reference_id ?? 'Loan #' + loan.loan_id}
                        </option>`;
                });
            })
            .catch(err => console.error('Admin loan fetch error:', err));

    });

}


/* ================= AGENT ================= */

const agentUserSelect = document.getElementById('agent_user_select');
const agentLoanSelect = document.getElementById('agent_loan_select');

if(agentUserSelect){

    // Load agent customers
    fetch('/agent/customers')
        .then(res => res.json())
        .then(data => {

            agentUserSelect.innerHTML = '<option value="">-- Select Customer --</option>';

            data.forEach(u => {
                agentUserSelect.innerHTML += `
                    <option value="${u.id}">${u.name}</option>
                `;
            });
        })
        .catch(err => console.error('Agent customer fetch error:', err));


    // Load loans when customer selected
    agentUserSelect.addEventListener('change', function(){

        let userId = this.value;
        agentLoanSelect.innerHTML = '<option>Loading...</option>';

        if(!userId){
            agentLoanSelect.innerHTML = '<option value="">-- Select Loan --</option>';
            return;
        }

        fetch(`/agent/user/${userId}/loans`)
            .then(res => res.json())
            .then(data => {

                agentLoanSelect.innerHTML = '<option value="">-- Select Loan --</option>';

                if(data.length === 0){
                    agentLoanSelect.innerHTML += '<option value="">No loans found</option>';
                }

                data.forEach(l => {
                    agentLoanSelect.innerHTML += `
                        <option value="${l.loan_id}">
                            ${l.loan_reference_id}
                        </option>
                    `;
                });

            })
            .catch(err => console.error('Agent loan fetch error:', err));

    });

}
</script>


<script>
if(document.getElementById('loan_select')){

document.getElementById('loan_select').addEventListener('change', function () {

    let loanId = this.value;

    agentSelect.innerHTML = '<option value="">-- No agent assigned --</option>';

    if (!loanId) return;

    fetch(`/admin/loan/${loanId}/agent`)
        .then(res => res.json())
        .then(data => {

            if (data.agent) {
                agentSelect.innerHTML = `
                    <option value="">-- Auto from Loan --</option>
                    <option value="${data.agent.id}" selected>
                        ${data.agent.name}
                    </option>
                `;
            }
        });
});
}
</script>

@endsection
