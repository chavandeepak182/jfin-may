@extends('layouts.header')

@section('content')



<div class="container py-4">

    <div class="card shadow-sm border-0 rounded-4">

        <!-- CARD HEADER -->

        <div class="card-header bg-white border-0 pt-4 pb-0">

            <h4 class="fw-bold mb-0">
                Add Amenities
            </h4>

        </div>

        <!-- CARD BODY -->

        <div class="card-body">

            <!-- ADD FORM -->

            <form action="{{ route('amenities.store') }}" method="POST">

                @csrf

                <div class="row align-items-end">

                    <div class="col-md-10 mb-3">

                        <label class="form-label fw-semibold">
                            Amenity Name
                        </label>

                        <input type="text"
                               name="amenity_name"
                               class="form-control form-control-lg rounded-3"
                               placeholder="Enter Amenity Name"
                               required>

                    </div>

                    <div class="col-md-2 mb-3">

                        <button type="submit"
                                class="btn btn-primary w-100 btn-lg rounded-3">

                            <i class="bi bi-plus-circle"></i>
                            Add

                        </button>

                    </div>

                </div>

            </form>

            <!-- SUCCESS MESSAGE -->
@if(session('success'))
<div class="alert alert-success rounded-3 mt-3">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger rounded-3 mt-3">

    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach

</div>
@endif

            <!-- TABLE -->

            <div class="table-responsive mt-4">

                <table class="table align-middle table-bordered">

                    <thead class="table-light">

                        <tr>

                            <th width="80">ID</th>

                            <th>Amenity Name</th>

                            <th width="250">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($amenities as $amenity)

                        <tr>

                            <td>
                                {{ $amenity->id }}
                            </td>

                            <td>

                                <!-- UPDATE FORM -->

                                <form action="{{ route('amenities.update') }}"
                                      method="POST"
                                      class="d-flex gap-2">

                                    @csrf

                                    <input type="hidden"
                                           name="id"
                                           value="{{ $amenity->id }}">

                                    <input type="text"
                                           name="amenity_name"
                                           value="{{ $amenity->amenity_name }}"
                                           class="form-control rounded-3">

                            </td>

                            <td>

                                    <button class="btn btn-success btn-sm rounded-3">

                                        <i class="bi bi-check-circle"></i>
                                        Update

                                    </button>

                                </form>

                                <!-- DELETE FORM -->

                                <form action="{{ route('amenities.delete') }}"
                                      method="POST"
                                      class="d-inline-block mt-2"
                                      onsubmit="return confirm('Are you sure you want to delete this amenity?')">

                                    @csrf

                                    <input type="hidden"
                                           name="id"
                                           value="{{ $amenity->id }}">

                                    <button class="btn btn-danger btn-sm rounded-3">

                                        <i class="bi bi-trash"></i>
                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3"
                                class="text-center text-muted py-4">

                                No Amenities Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection