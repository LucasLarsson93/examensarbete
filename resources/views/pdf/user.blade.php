<!DOCTYPE html>
<html>

<head>
    <title>User Details</title>
</head>

<body id="top">
    <h1>{{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Created At: {{ $user->created_at }}</p>
    <p>Ip address: {{ $user->ip_address }}</p>
</body>

</html>
