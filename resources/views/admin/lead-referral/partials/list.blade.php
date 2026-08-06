@if($leadReferrals->count() > 0)

    @foreach($leadReferrals as $key => $row)

        <tr>

            <td>{{ $key + 1 }}</td>

            <td>{{ $row->referral_code ?? '-' }}</td>

            <td>{{ $row->name }}</td>

            <td>{{ $row->email_id }}</td>

            <td>{{ $row->mobile_no }}</td>

            <td>{{ $row->city_name ?? '-' }}</td>

            <td>{{ $row->state_name ?? '-' }}</td>

            <td>{{ $row->pan_number ?? '-' }}</td>

            <td>

   <a href="{{ route('admin.lead-referral.edit',$row->id) }}"
   class="btn btn-warning btn-sm">
    <i class="fa fa-edit"></i>
</a>

    @if($row->status == 1)
    <button
        type="button"
        class="btn btn-success btn-sm changeStatus"
        data-id="{{ $row->id }}"
        data-status="0">
        Active
    </button>
@else
    <button
        type="button"
        class="btn btn-danger btn-sm changeStatus"
        data-id="{{ $row->id }}"
        data-status="1">
        Inactive
    </button>
@endif

</td>

        </tr>

    @endforeach

@else

<tr>
    <td colspan="9" class="text-center text-danger">
        No Lead Referral Found
    </td>
</tr>

@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).on('click', '.changeStatus', function () {

    let id = $(this).data('id');
    let status = $(this).data('status');

    let title = (status == 0)
        ? "Are you sure you want to Inactive this user?"
        : "Are you sure you want to Active this user?";

    let confirmText = (status == 0)
        ? "Yes, Inactive"
        : "Yes, Active";

    Swal.fire({
        title: title,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmText,
        cancelButtonText: 'Cancel'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('admin.lead-referral.change-status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status: status
                },
                success: function (response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });

                },
                error: function () {

                    Swal.fire(
                        'Error!',
                        'Something went wrong.',
                        'error'
                    );

                }
            });

        }

    });

});
</script>