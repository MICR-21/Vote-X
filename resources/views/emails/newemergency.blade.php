<!DOCTYPE html>
<html>
<head>
    <title>New User Registration</title>
</head>
<body>
    <h1>New Emergency Received</h1>
    <p>A user has an emergency on your platform.</p>
    <p><strong>Id:</strong> {{ $emergency->id }}</p>
    <p><strong>UserId:</strong> {{ $emergency->userid }}</p>
    <p><strong>Country:</strong> {{ $emergency->country }}</p>
    <p><strong>Longitude:</strong> {{ $emergency->longitude }}</p>
    <p>click link below to view emergencies</p>
    <a href="http://127.0.0.1:8000/admin/emergencies/assignmedic/{{$emergency->id}}">View</a>
</body>
</html>
