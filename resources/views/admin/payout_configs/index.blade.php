@extends('layouts.header')

@section('content')

<div class="container">

    <h3>DSA Payout Config List</h3>

    <a href="{{ route('payout-configs.create') }}" class="btn btn-primary mb-3">
        Add Payout Config
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bank Name</th>
                <th>Loan Category</th>
                <th>Percentage (%)</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($configs as $config)
                <tr>
                    {{-- ✅ FIXED COLUMN NAMES --}}
                    <td>{{ $config->bank->bank_name ?? '-' }}</td>
                    <td>{{ $config->category->category_name ?? '-' }}</td>
                    <td>{{ $config->percentage }}%</td>

                    <td>
                        <a href="{{ route('payout-configs.edit', $config->id) }}" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <form method="POST" 
                              action="{{ route('payout-configs.destroy', $config->id) }}" 
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        No payout config found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection