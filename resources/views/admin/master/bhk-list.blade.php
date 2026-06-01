

@extends('layouts.header')

@section('content')

<div class="container">

    <h3 style="color:#000;">Add BHK</h3>

   <form action="{{ route('bhk.store') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <input type="text"
                   name="bhk_name"
                   class="form-control"
                   placeholder="Enter BHK">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary">
                Add
            </button>
        </div>
    </div>
</form>

    <hr>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>BHK</th>
            <th>Action</th>
        </tr>

        @foreach($bhks as $bhk)

        <tr>

            <td>{{ $bhk->id }}</td>

            <td>{{ $bhk->bhk_name }}</td>

            <td>

                <!-- EDIT -->

                <form action="{{ route('bhk.update') }}"
                      method="POST"
                      style="display:inline-block;">

                    @csrf

                    <input type="hidden"
                           name="id"
                           value="{{ $bhk->id }}">

                    <input type="text"
                           name="bhk_name"
                           value="{{ $bhk->bhk_name }}">

                    <button class="btn btn-success btn-sm">
                        Update
                    </button>

                </form>

                <!-- DELETE -->

                <form action="{{ route('bhk.delete') }}"
                      method="POST"
                      style="display:inline-block;">

                    @csrf

                    <input type="hidden"
                           name="id"
                           value="{{ $bhk->id }}">

                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</div>

@endsection

