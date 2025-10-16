<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="/" class="brand-link"> --}}
        {{-- <span class="brand-text font-weight-light"> --}}
             <a href="/" class="brand-link d-flex justify-content-center align-items-center">
            {{Auth::user()->name}}
             </a>
        {{-- </span> --}}
    {{-- </a> --}}

    <!-- Sidebar -->
    <div class="sidebar ">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->

        @if(Auth::user()->status == 'verified')

         {{-- <li class="nav-item">
                    <a href="/createnewuser" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                        Create New User
                        </p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="/ViewUsers" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Registered Students
                        </p>
                    </a>
                </li>

                   <li class="nav-item">
                    <a href="/VerifiedUsers" class="nav-link">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                        Verified Students
                        </p>
                    </a>
                </li>

                   <li class="nav-item">
                    <a href="/RejectedUsers" class="nav-link">
                        <i class="nav-icon fas fa-user-times"></i>
                        <p>
                        Rejected Students
                        </p>
                    </a>
                </li>
@endif
                <li class="nav-item">
                    <a class="nav-link logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out left" aria-hidden="true"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>


    <!-- /.sidebar -->
</aside>
<style>
/* Apply Inter font to all sidebar-related elements */
body, .sidebar, .nav, .nav-link, .brand-link {
    font-family: 'Inter', sans-serif !important;
}

/* Optional: Improve typography for sidebar links */
.sidebar .nav-link p {
    font-size: 14px;
    font-weight: 500;
    margin: 0;
}

/* Optional: Style the user name / brand link */
.brand-link {
    font-size: 16px;
    font-weight: 600;
    color: #ffffff !important;
    background-color: #1e282c; /* Optional: matches default dark sidebar tone */
    height: 64px;
    text-align: center;
}

/* Optional: Enhance search box input appearance */
.form-control-sidebar {
    border-radius: 20px;
    font-size: 13px;
    padding: 0.375rem 0.75rem;
}

/* Optional: Better spacing on the nav items */
.nav-sidebar .nav-link {
    padding: 10px 15px;
    border-radius: 6px;
    transition: background 0.3s ease;
}

.nav-sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
}
</style>

