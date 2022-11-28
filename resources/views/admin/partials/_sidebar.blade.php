<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-code"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DevPedia Panel<sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <i class="fas fa-user"></i>
                    <span>Users</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.categories') }}">
                    <i class="fa-brands fa-stack-overflow"></i>
                    <span>Categories</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.reports') }}">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Reports</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.activity') }}">
                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                    <span>Activity</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa-solid fa-backward"></i>
                    <span>Back to DevPedia</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block mt-3">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>