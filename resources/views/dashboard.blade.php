<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header styles */
header {
    background-color: #333;
    color: #fff;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.logo {
    font-size: 28px;
    font-weight: bold;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info span {
    margin-right: 10px;
    font-weight: bold;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-weight: normal;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Main content styles */
main {
    flex-grow: 1;
    padding: 20px;
    background-color: #f2f2f2;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

/* Sidebar styles */
.sidebar {
    display: none;
    width: 250px;
    background-color: #fff;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}

.sidebar h2 {
    margin-bottom: 20px;
    font-size: 20px;
    color: #333;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-group button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <header>
        <div class="logo">DASHBOARD</div>
        <div class="user-info">
            <div class="profile-picture">
                <img src="{{ Auth::user()->profile_picture_url }}" alt="Profile Picture">
            </div>
            <span>{{ Auth::user()->name }}</span>
            <div class="dropdown">
                <button>Profile</button>
                <div class="dropdown-content">
                    <a href="#" onclick="openSidebar()">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="handleLogout(event)">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h1>WELCOME TO VOTE-X <span>{{ Auth::user()->name }}</span></h1>
    </main>
    <div class="sidebar" id="sidebar">
        <h2>Edit Profile</h2>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <!-- <input type="hidden" name="_method" value="PUT"> -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>
            <div class="form-group">
                <button type="submit">Save Changes</button>
            </div>
        </form>
    </div>
    <script>
        function handleLogout(event) {
            event.preventDefault();

            fetch('{{ route('logout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) {
                    window.location.replace('/login');
                }
            });
        }

        function openSidebar() {
            document.getElementById('sidebar').style.display = 'block';
        }

        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    </script>
</body>
</html>
