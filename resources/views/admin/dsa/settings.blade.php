@extends('layouts.header')

@section('content')

<style>
.card-box {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.section-title {
    font-size: 18px;
    font-weight: 600;
}

/* DOCUMENT */
.doc-card {
    background: #f8f9fb;
    padding: 12px;
    border-radius: 8px;
    margin-top: 10px;
}

.doc-name {
    font-weight: bold;
    font-size: 15px;
    color: #333;
}

/* BANK */
.bank-box {
    background: #f8f9fb;
    padding: 15px;
    border-radius: 8px;
}

.bank-box p {
    margin: 3px 0;
}

/* BUTTON */
.btn-add {
    background: #007bff;
    color: #fff;
    padding: 6px 15px;
    border-radius: 6px;
    border: none;
}

/* MODAL */
.modal-bg {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.5);
    display:none;
    justify-content:center;
    align-items:center;
}

.modal-box {
    background:#fff;
    padding:20px;
    border-radius:10px;
    width:600px;
}

.modal-box h5 {
    margin-bottom: 15px;
}

/* FORM GRID */
.form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.form-row input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
</style>

<div class="container mt-4">

    <!-- 📄 DOCUMENTS -->
    <div class="card-box">
        <div class="section-title">Documents</div>

        <form method="POST" action="{{ route('dsa.documents.upload') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <input type="text" name="doc_name" placeholder="Document name" required>
                <input type="file" name="file" required>
            </div>

            <button class="btn-add mt-2">Upload</button>
        </form>

        <!-- LIST -->
        @if($documents->count() > 0)

            @foreach($documents as $doc)
                <div class="doc-card">
                    <div class="doc-name">
                        {{ $doc->name }}
                    </div>

                    <!-- SIMPLE LINKS (NO BUTTON STYLE) -->
                    @if($doc->file)
                        <small>
                            <a href="{{ asset('storage/'.$doc->file) }}" target="_blank">Preview</a> |
                            <a href="{{ asset('storage/'.$doc->file) }}" download>Download</a>
                        </small>
                    @endif
                </div>
            @endforeach

        @else
            <p>No documents uploaded</p>
        @endif
    </div>


    <!-- 🏦 BANK DETAILS -->
    <div class="card-box">

        <div class="section-header">
            <div class="section-title">Bank Details</div>
            <button class="btn-add" onclick="openModal()">+ Add</button>
        </div>

        @if($bank)
            <div class="bank-box">
                <p><b>Bank:</b> {{ $bank->bank_name }}</p>
                <p><b>Account No:</b> {{ $bank->account_number }}</p>
                <p><b>IFSC:</b> {{ $bank->ifsc_code }}</p>
                <p><b>Holder:</b> {{ $bank->account_holder_name }}</p>
                <p><b>UPI ID:</b> {{ $bank->upi_id ?? '-' }}</p>

                <button class="btn-add mt-2" onclick="openModal()">Edit</button>
            </div>
        @else
            <p>No bank details added</p>
        @endif

    </div>

</div>


<!-- 🔥 MODAL (LIKE YOUR IMAGE) -->
<div class="modal-bg" id="bankModal">
    <div class="modal-box">

        <h5 style="color: #000;">Add Bank Details</h5>

        <form method="POST" action="{{ route('dsa.settings.save') }}">
            @csrf

            <div class="form-row">
                <input type="text"
                name="bank_name"
                value="{{ old('bank_name', $bank->bank_name ?? '') }}"
                placeholder="Bank Name">

            @error('bank_name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
                <input type="text"
                name="account_number"
                value="{{ old('account_number', $bank->account_number ?? '') }}"
                placeholder="Account Number">

            @error('account_number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>

            <div class="form-row">
               <input type="text"
                    name="ifsc_code"
                    value="{{ old('ifsc_code', $bank->ifsc_code ?? '') }}"
                    placeholder="IFSC Code">

                @error('ifsc_code')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                                <input type="text"
       name="branch_name"
       placeholder="Branch Name"
       value="{{ old('branch_name', $bank->branch_name ?? '') }}">

@error('branch_name')
<small class="text-danger">{{ $message }}</small>
@enderror
            </div>

            <div class="form-row">
                <input type="text"
                    name="account_holder_name"
                    value="{{ old('account_holder_name', $bank->account_holder_name ?? '') }}"
                    placeholder="Account Holder">

                @error('account_holder_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <input type="text"
       name="upi_id"
       value="{{ old('upi_id', $bank->upi_id ?? '') }}"
       placeholder="UPI ID">

@error('upi_id')
<small class="text-danger">{{ $message }}</small>
@enderror
            </div>

            <button class="btn-add w-100 mt-2">Save Bank Details</button>
            <button type="button" class="btn-add w-100 mt-2" onclick="closeModal()">Cancel</button>

        </form>

    </div>
</div>


<script>
function openModal(){
    document.getElementById('bankModal').style.display='flex';
}
function closeModal(){
    document.getElementById('bankModal').style.display='none';
}
</script>
@if($errors->any())
<script>
window.onload = function () {
    openModal();
}
</script>
@endif
@endsection