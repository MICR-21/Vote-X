<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome-free/css/all.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <!-- ./wrapper -->
    <div class="wrapper">

        @include('navbar')

      <!-- Main Sidebar Container -->
        @include('sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Admin Dashboard</h1>
              </div><!-- /.col -->
              <!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Election Statistics -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Election Statistics</h5>
              <p class="card-text">
                Overview of current elections, including the number of candidates, voters, and ongoing polls.
              </p>
              <ul>
                <li>Total Candidates: 25</li>
                <li>Total Voters: 1000</li>
                <li>Ongoing Polls: 5</li>
              </ul>
            </div>
          </div>

          <!-- Recent Activities -->
          <div class="card card-primary card-outline">
            <div class="card-body">
              <h5 class="card-title">Recent Activities</h5>
              <p class="card-text">
                Latest actions taken by administrators and users within the e-voting platform.
              </p>
              <ul>
                <li>New candidate registered for Presidential Election</li>
                <li>Poll for Local Council Election started</li>
                <li>Voter John Doe updated profile</li>
              </ul>
              <a href="#" class="card-link">View all activities</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->

        <!-- Management Options -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Manage Elections</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Election Management Tools</h6>
              <p class="card-text">
                Access tools to create, edit, and monitor elections.
              </p>
              <a href="{{ route('elections.index') }}" class="btn btn-primary">Create New Election</a>
              <a href="#" class="btn btn-secondary">Edit Existing Elections</a>
            </div>
          </div>

          <!-- Manage Candidates -->
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">Manage Candidates</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Candidate Management Tools</h6>
              <p class="card-text">
                Tools to add, edit, and remove candidates for various elections.
              </p>
              <a href="#" class="btn btn-primary">Add New Candidate</a>
              <a href="#" class="btn btn-secondary">Edit Candidates</a>
            </div>
          </div>

          <!-- System Notifications -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0">System Notifications</h5>
            </div>
            <div class="card-body">
              <h6 class="card-title">Important Updates and Alerts</h6>
              <p class="card-text">
                Stay informed with the latest system updates and alerts related to the e-voting platform.
              </p>
              <ul>
                <li>System maintenance scheduled for July 1, 2024</li>
                <li>New security patch released</li>
              </ul>
              <a href="#" class="btn btn-primary">View all notifications</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- Voter Statistics -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Voter Statistics</h5>
              <p class="card-text">
                Detailed statistics about voter registration and participation.
              </p>
              <ul>
                <li>Registered Voters: 1000</li>
                <li>Active Voters: 850</li>
                <li>Inactive Voters: 150</li>
              </ul>
              <a href="#" class="btn btn-primary">View Detailed Statistics</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->

        <!-- Election Reports -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Election Reports</h5>
              <p class="card-text">
                Access comprehensive reports on past and ongoing elections.
              </p>
              <a href="#" class="btn btn-primary">View Reports</a>
              <a href="#" class="btn btn-secondary">Download Reports</a>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      @include('footer')
    </div>

    <script>
        // Simulate a function that triggers a new message notification
        function notifyNewEvent(type, name) {
          // Increment badge count
          let badge = document.getElementById('notification-badge');
          let currentCount = parseInt(badge.innerText) || 0;
          badge.innerText = currentCount + 1;

          // Create new message item
          let messagesDiv = document.getElementById('notification-messages');
          let newItem = document.createElement('a');
          newItem.classList.add('dropdown-item');

          // Message content
          newItem.innerHTML = `
            <div class="media">
              <img src="${getImageUrlForType(type)}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  ${name}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">${type === 'candidate' ? 'New candidate created' : 'New election created'}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Just now</p>
              </div>
            </div>
          `;

          messagesDiv.insertBefore(newItem, messagesDiv.firstChild);
        }

        // Function to get appropriate image URL based on type
        function getImageUrlForType(type) {
          switch (type) {
            case 'candidate':
              return '{{ asset("assets/dist/img/user1-128x128.jpg") }}';
            case 'election':
              return '{{ asset("assets/dist/img/user8-128x128.jpg") }}';
            default:
              return '{{ asset("assets/dist/img/user3-128x128.jpg") }}';
          }
        }

        // Example usage: Call notifyNewEvent('candidate', 'John Doe') or notifyNewEvent('election', '2024 Election')
        // This would add a new message to the dropdown with the appropriate details.
      </script>
