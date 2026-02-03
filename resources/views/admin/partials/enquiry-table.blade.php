<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($enquiries as $enquiry)
            <tr>
                <td>{{ $enquiry->enquiry_id }}</td>
                <td>{{ $enquiry->name }}</td>
                <td>{{ $enquiry->email }}</td>
                <td>{{ $enquiry->contact }}</td>
                <td>{{ $enquiry->message }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No enquiries found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $enquiries->links('pagination::bootstrap-4') }}
