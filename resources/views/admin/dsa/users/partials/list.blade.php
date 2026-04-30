

@forelse($users as $u)
<tr>
    <td>{{ $u->name }}</td>
    <td>{{ $u->mobile_no }}</td>
    <td>{{ $u->email }}</td>
    <td>{{ $u->state_name ?? '-' }}</td>
    <td>{{ $u->city_name ?? '-' }}</td>

  <td>
    <button class="edit-btn editBtn" data-id="{{ $u->id }}">
        <i class="fa fa-pen"></i>
    </button
    >
</td>
<style>
    .edit-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: #1e63b5;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    transition: 0.3s ease;
}

.edit-btn i {
    font-size: 16px;
}

.edit-btn:hover {
    background-color: #174a8c;
}
</style>
</tr>
@empty

<tr>
    <td colspan="6" class="text-center">No Data</td>
</tr>

@endforelse