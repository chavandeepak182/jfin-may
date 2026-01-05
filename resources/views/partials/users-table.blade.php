@forelse ($users as $user)
<tr>
    <td><input type="checkbox"></td>

    <td>
        <div class="customer-cell">
            <div class="customer-avatar">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div class="customer-info">
                <a href="javascript:void(0);"
                   class="user-link"
                   data-name="{{ $user->name }}"
                   data-email="{{ $user->email_id }}"
                   data-mobile="{{ $user->profile->mobile_no ?? '-' }}"
                   data-status="{{ $user->is_email_verify ? 'Active' : 'Inactive' }}">
                    {{ $user->name }}
                </a>
                <div>#{{ $user->id }}</div>
            </div>
        </div>
    </td>

    <td>{{ $user->email_id }}</td>
    <td>{{ $user->profile->mobile_no ?? '-' }}</td>
    <td>{{ $user->profile->pan_number ?? '-' }}</td>

    <td>
        <input type="radio" onclick="updateStatus({{ $user->id }},1)" {{ $user->is_email_verify ? 'checked' : '' }}> Active
        <input type="radio" onclick="updateStatus({{ $user->id }},0)" {{ !$user->is_email_verify ? 'checked' : '' }}> Inactive
    </td>

    <td>
        <a href="javascript:void(0)"
           class="edit-user-btn"
           data-id="{{ $user->id }}"
           data-name="{{ $user->name }}"
           data-email="{{ $user->email_id }}"
           data-mobile="{{ $user->profile->mobile_no ?? '' }}">
           ✏️
        </a>

        <a href="javascript:void(0)" onclick="deleteUser({{ $user->id }})">
           🗑️
        </a>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">No users found</td>
</tr>
@endforelse
