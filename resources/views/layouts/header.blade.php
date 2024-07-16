<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo nav-link text-white" href="{{url('/')}}">
            <h3>Vote_X</h3>
        </a>
        <a class="sidebar-brand brand-logo-mini nav-link text-white" href="{{url('/')}}">
            <h3>Vote_X</h3>
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                    <img class="img-xs rounded-circle"src="{{ Auth::user()->profile_pic ?
                    asset(Auth::user()->profile_pic) : asset('public/assets/images/Login_bg2.jpg') }}" alt="">

                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                        <span>
                            @if (Auth::user()->user_type == 1)
                                Administrator
                            @elseif (Auth::user()->user_type == 2)
                                Company
                            @endif
                        </span>
                        <span>{{ Request::segment(1) }}</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i
                        class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        @if (Auth::user()->user_type == 1)
            <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(2) == 'admin') active @endif" href="{{ url('admin/dashboard') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(2) == 'admin') active @endif"
                    href="{{ url('admin/admin/list') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">View Admins</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(3) == 'admin') active @endif"
                    href="{{ url('admin/candidate/list') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">View Candidates</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(3) == 'admin') active @endif"
                    href="{{ url('admin/elections/list') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">View Elections</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-icon">
                        <i class="mdi mdi-laptop"></i>
                    </span>
                    <span class="menu-title">Add</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link @if (Request::segment(2) == 'admin') active @endif"
                                href="{{ url('admin/candidate/add') }}">Add Candidate</a></li>

                        <li class="nav-item"> <a class="nav-link @if (Request::segment(2) == 'subject') active @endif""
                                href="{{ url('admin/admin/add') }}">Add Admin</a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(1) == 'admin') active @endif"
                    href="pages/tables/basic-table.html">
                    <span class="menu-icon">
                        <i class="mdi mdi-table-large"></i>
                    </span>
                    <span class="menu-title">Reports</span>
                </a>
            </li> -->

            <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(3) == 'assignedlist') active @endif" href="{{url('admin/user/list')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Users</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(3) == 'assignedlist') active @endif" href="{{url('admin/candidate/list')}}">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Candidates</span>
                </a>
            </li>
            <!-- <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(1) == 'admin') active @endif" data-bs-toggle="collapse"
                    href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                    </span>
                    <span class="menu-title">Account Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{url('/admin/admin/edit',Auth::user()->id)}}"> View Profile
                            </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/change_password') }}"> Change
                                Password </a></li>

                        <li class="nav-item"> <a class="nav-link" href="{{ url('logout') }}"> Logout </a></li>
                        </li>
                    </ul>
                </div>
            </li> -->

        @elseif(Auth::user()->user_type == 2)
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>





            <!-- <li class="nav-item menu-items">
                <a class="nav-link" href="pages/icons/mdi.html">
                    <span class="menu-icon">
                        <i class="mdi mdi-contacts"></i>
                    </span>
                    <span class="menu-title">Emergencies</span>
                </a>
            </li> -->
            <!-- <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(1) == 'admin') active @endif" data-bs-toggle="collapse"
                    href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                    </span>
                    <span class="menu-title">Account Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> View Profile
                            </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('teacher/change_password') }}"> Change
                                Password </a></li>
                                <li class="nav-item"> <a class="nav-link"  href="{{ url('logout') }}"> Logout
                                 </a></li>

                        </li>
                    </ul>
                </div>
            </li> -->

        @elseif(Auth::user()->user_type == 3)
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ url('user/dashboard') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            {{-- <li class="nav-item menu-items">
                <a class="nav-link" href="{{ url('admin/admin/list') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Emergencies</span>
                </a>
            </li> --}}



            <!-- <li class="nav-item menu-items">
                <a class="nav-link @if (Request::segment(1) == 'admin') active @endif" data-bs-toggle="collapse"
                    href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                    </span>
                    <span class="menu-title">Account Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> View Profile
                            </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('student/change_password') }}"> Change
                                Password </a></li>
                        <li class="nav-item"> <a class="nav-link"  href="{{ url('logout') }}"> Logout
                                 </a></li>

                        </li>
                    </ul>
                </div>
            </li> -->

        @endif

    </ul>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img
                    src="{{ asset('assets/images/logo-mini.svg') }}"" alt="logo here" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
                <li class="nav-item w-100">
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                        <input type="text" class="form-control" placeholder="Search products">
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">



                <li class="nav-item dropdown">
                    <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                        <div class="navbar-profile">
                        <img class="img-xs rounded-circle"
     src="{{ Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('images/happy.png') }}"
     alt="">
                            <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="profileDropdown">
                        <h6 class="p-3 mb-0">Profile</h6>
                        <div class="dropdown-divider"></div>

                        @if(Auth::user()->user_type== 1)
                        <a class="dropdown-item preview-item" href="{{url('/admin/admin/edit',Auth::user()->id)}}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Account</p>
                            </div>
                        </a>
                        @elseif(Auth::user()->user_type == 2)
                        <a class="dropdown-item preview-item" href="{{url('/admin/medic/edit',Auth::user()->id)}}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Account</p>
                            </div>
                        </a>
                        @else
                        <a class="dropdown-item preview-item" href="{{url('/admin/user/edit',Auth::user()->id)}}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-settings text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Account</p>
                            </div>
                        </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="{{ url('logout') }}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-logout text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="preview-subject mb-1">Log out</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="mdi mdi-format-line-spacing"></span>
            </button>
        </div>
    </nav>
