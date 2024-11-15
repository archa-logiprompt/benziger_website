@php
$permissions = Session::get('permissions')->toArray();
$data = Auth::user();
@endphp
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <!-- <img
                src="{{ asset('backend/img/kaiadmin/logo_light.png') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
                width="30"

              /> -->
                <h2 style="color: white;">ADMIN PANEL</h2>

            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">

            <ul class="nav nav-secondary">

                @if (in_array('dashboard', $permissions) || $data->role == 1)
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-home"> </i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endif

                @if (in_array('department', $permissions) || $data->role == 1)
                <li class="nav-item {{ Request::is('department') ? 'active' : '' }}">
                    <a href="{{ route('department') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-building"></i>
                        <p>Department</p>
                    </a>
                </li>
                @endif

                @if (in_array('staff', $permissions) || $data->role == 1)
                <li class="nav-item {{ Request::is('admin/staff') ? 'active' : '' }}">
                    <a href="{{ route('admin.staff') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <p>Staff</p>
                    </a>
                </li>
                @endif

                @if (in_array('roles', $permissions) || $data->role == 1)
                <li class="nav-item {{ Request::is('admin/roles/index') ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.view') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <p>Roles</p>
                    </a>
                </li>
                @endif

                {{-- @if (in_array('research_area', $permissions) || $data->role == 1)
                    <li class="nav-item {{ Request::is('admin/researcharea') ? 'active' : '' }}">
                <a href="{{ route('admin.researcharea') }}" class="collapsed" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    <p>Research Area</p>
                </a>
                </li>
                @endif --}}

                @if (in_array('journals', $permissions) || $data->role == 1)
                <li class="nav-item {{ Request::is('staff/journal') ? 'active' : '' }}">
                    <a href="{{ route('journal.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <p>Journels</p>
                    </a>
                </li>
                @endif

                @if (in_array('journals', $permissions) || $data->role == 1)
                <li class="nav-item">
                    <a href="{{ route('admin.notifications') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                @endif

                @if (in_array('journals', $permissions) || $data->role == 1)
                <li class="nav-item">
                    <a href="{{ route('admin.bannerImage') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-image"></i>
                        <p>Banner Images</p>
                    </a>
                </li>
                @endif

                @if (in_array('journals', $permissions) || $data->role == 1)
                <li class="nav-item">
                    <a href="{{ route('admin.generalsettings') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                        <p>General Settings</p>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>