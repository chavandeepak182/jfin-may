@extends('frontend.layouts.customer-dash')
@section('title', "All Documents")

@section('content')
<div class="container-fluid p-0">
	<h2 class="mb-3 text-center">Documents' Information</h2>
	<div class="row">
		<div class="col-md-10 mx-auto d-flex">
			<div class="w-100">
				@if ($documents && count($documents) > 0)
					<div class="row">
						@foreach ($documents as $document)
							<div class="col-md-2 pt-2 me-3 bg-white">
								<h5>{{ucfirst($document->document_name) }}:</h5 >
								<p><a href="{{ Storage::url($document->file_path) }}" target="_blank">View</a> <span class="px-2">|</span> <a href="#" class="text-dark text-end" target="_blank">Replace</a></p>
							</div>
						@endforeach
					</div>
				@else
					<p>No documents available.</p>
				@endif

				<form action="{{ route('loan.update_documents') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div id="document-fields">
						<!-- Initially hidden document fields -->
					</div>
					<br>
					<div class="form-group mb-3">
						<button type="button" id="add-document" class="btn btn-primary">Add Missing Documents</button>
						<button type="submit" class="btn btn-success">Save Documents</button>
					</div>
				</form>
			</div>
		</div>						
	</div>
</div>
@endsection

@section('custom-script')
<script>
	document.getElementById('add-document').addEventListener('click', function() {
		var index = document.querySelectorAll('#document-fields .document-field').length;
		var newField = `
			<div class="document-field mb-3">
				<input type="text" name="documents[${index}][document_name]" class="form-control mb-2" placeholder="Document Name" required>
				<input type="file" name="documents[${index}][file]" class="form-control mb-2" required>
				<button type="button" class="btn btn-danger remove-document">Remove</button>
			</div>
		`;
		document.getElementById('document-fields').insertAdjacentHTML('beforeend', newField);
	});

	// Event delegation to handle removal of dynamically added fields
	document.getElementById('document-fields').addEventListener('click', function(e) {
		if (e.target.classList.contains('remove-document')) {
			e.target.parentElement.remove();
		}
	});
</script>
@endsection