<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Election Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: #333;
            padding: 10px 15px;
            margin-bottom: 10px;
            text-decoration: none;
        }
        .sidebar a.active {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar">
            <h2 class="text-center">Hive</h2>
            <a href="#" class="active">Overview</a>
            <a href="#">Ballot</a>
            <a href="#">Voters</a>
            <a href="#">Notifications</a>
            <a href="#">Account</a>
            <a href="#" class="text-danger">Log Out</a>
        </nav>
        <div class="content flex-grow-1">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
