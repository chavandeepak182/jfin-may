@extends('frontend.layouts.customer-dash')

@section('title','Documents')

@section('content')
<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold text-dark">Documents</h2>
        <p class="text-muted">Manage and upload your documents for verification.</p>
    </div>

    {{-- UPLOAD FORM --}}
    <form action="{{ route('loan.update_documents') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <div class="row g-3 align-items-end document-row">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Add Document Name</label>
                        <input type="text"
                               name="documents[0][document_name]"
                               class="form-control"
                               placeholder="Type document name..."
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Document Upload</label>
                        <input type="file"
                               name="documents[0][file]"
                               class="form-control"
                               required>
                    </div>
                </div>

                <!-- <div class="mt-3">
                    <button type="button" id="addMoreDocs" class="btn btn-light">
                        + Add More Documents
                    </button>
                </div> -->

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-5">
                        Upload Documents
                    </button>
                </div>

            </div>
        </div>
    </form>

    {{-- DOCUMENTS DETAILS --}}
    <div class="mb-3">
        <span class="badge bg-primary px-3 py-2">Documents Details</span>
    </div>

    <div class="row g-4">

        @forelse($documents as $doc)
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-file-alt fa-2x text-primary"></i>
                        </div>

                        <div class="flex-grow-1">
                            <h6 class="fw-semibold mb-1 text-dark">
                                {{ $doc->document_name }}
                            </h6>
                           <small class="text-muted">
    @if(Storage::disk('public')->exists($doc->file_path))
        {{ round(Storage::disk('public')->size($doc->file_path) / 1024 / 1024, 2) }} MB
    @else
        <span class="text-danger">File missing</span>
    @endif
</small>

                            

                            <div class="progress mt-2" style="height:6px;">
                                <div class="progress-bar bg-primary" style="width:100%"></div>
                            </div>

                            <small class="text-success fw-semibold d-block mt-1">
                                Upload Complete
                            </small>
                        </div>

                        <div class="ms-3 text-end">

                            <a href="{{ asset('storage/'.$doc->file_path) }}"
                            target="_blank"
                            class="d-block text-decoration-none text-muted mb-1">
                                <i class="fas fa-eye me-1"></i> Preview
                            </a>

                            <a href="{{ asset('storage/'.$doc->file_path) }}"
                            download
                            class="d-block text-decoration-none text-muted mb-1">
                                <i class="fas fa-download me-1"></i> Download
                            </a>

                            <!-- <form action="{{ route('loan.deletedocument', $doc->document_id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Remove this document?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-link text-danger p-0 text-decoration-none">
                                    <i class="fas fa-trash me-1"></i> Remove
                                </button>
                            </form> -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center">
                    No documents uploaded yet.
                </div>
            </div>
        @endforelse

    </div>
</div>
@endsection

@push('scripts')
<script>
let docIndex = 1;

document.getElementById('addMoreDocs').addEventListener('click', function () {

    let html = `
    <div class="row g-3 align-items-end document-row mt-3">
        <div class="col-md-6">
            <input type="text"
                   name="documents[${docIndex}][document_name]"
                   class="form-control"
                   placeholder="Type document name..."
                   required>
        </div>
        <div class="col-md-6">
            <input type="file"
                   name="documents[${docIndex}][file]"
                   class="form-control"
                   required>
        </div>
    </div>`;

    document.querySelector('.document-row').insertAdjacentHTML('afterend', html);
    docIndex++;
});
</script>
@endpush
