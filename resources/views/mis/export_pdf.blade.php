<!DOCTYPE html>
<html>
<head>
    <title>MIS Records</title>
</head>
<body>
    <h1>MIS Records</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Product Type</th>
                <th>Amount</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            @foreach($misRecords as $mis)
            <tr>
                <td>{{ $mis->id }}</td>
                <td>{{ $mis->name }}</td>
                <td>{{ $mis->email }}</td>
                <td>{{ $mis->contact }}</td>
                <td>{{ $mis->product_type }}</td>
                <td>{{ $mis->amount }}</td>
                <td>{{ $mis->city }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
