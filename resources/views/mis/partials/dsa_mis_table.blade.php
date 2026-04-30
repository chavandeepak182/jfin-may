<div class="card p-3 mb-3">

    <div class="row g-2 align-items-center">

        <!-- FROM DATE -->
        <div class="col-md-2">
            <input type="date" class="form-control" id="from_date">
        </div>

        <!-- TO DATE -->
        <div class="col-md-2">
            <input type="date" class="form-control" id="to_date">
        </div>

        <!-- SEARCH -->
        <div class="col-md-3">
            <input type="text" class="form-control" id="search" placeholder="Search...">
        </div>

        <!-- FILTER -->
        <div class="col-md-1">
            <button class="btn btn-primary w-100" onclick="filterMIS()">Filter</button>
        </div>

        <!-- RESET -->
        <div class="col-md-1">
            <button class="btn btn-info w-100" onclick="resetMIS()">Reset</button>
        </div>

        <!-- EXPORT -->
        <div class="col-md-2">
           <a href="{{ route('admin.dsa.mis.export') }}" class="btn btn-success w-100">
    Export to Excel
</a>
        </div>

    </div>

</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Product Type</th>
                <th>Amount</th>
                <th>City</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
        @forelse($misRecords as $mis)
            <tr>
                <td>{{ $mis->id }}</td>
                <td>{{ $mis->name }}</td>
                <td>{{ $mis->email }}</td>
                <td>{{ $mis->contact }}</td>
                <td>{{ $mis->product_type }}</td>
                <td>{{ $mis->amount }}</td>
                <td>{{ $mis->city }}</td>
                <!-- <td>
                    <a href="{{ route('mis.edit', $mis->id) }}" class="btn btn-sm btn-primary">Edit</a>
                </td> -->
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No records found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
<script>
    function filterMIS()
{
    let from_date = $('#from_date').val();
    let to_date = $('#to_date').val();
    let search = $('#search').val();

    $.get("{{ route('admin.dsa.mis.list') }}", {
        from_date: from_date,
        to_date: to_date,
        search: search
    }, function(res){
        $('#dsa_mis_table').html(res.html);
    });
}

function resetMIS()
{
    $('#from_date').val('');
    $('#to_date').val('');
    $('#search').val('');

    loadDsaMIS(); // reload
}
</script>