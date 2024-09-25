<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('index')}}" class="logo">
                <img src="{{ asset('backend-assets/img/logo.png') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
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
                <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @if (Auth::user()->role === 'Admin')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#user"
                        class="{{ Request::routeIs('users.create') || Request::routeIs('users.index') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <p>Users</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('users.create') || Request::routeIs('users.index') ? 'show' : '' }}"
                        id="user">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::routeIs('users.create') ? 'active' : '' }}">
                                <a href="{{ route('users.create') }}">
                                    <span class="sub-item">Add User</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('users.index') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}">
                                    <span class="sub-item">Manage Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#media" class="{{ Request::routeIs('media.create') || Request::routeIs('media.index') ? 'active' : '' }}">
                        <i class="fa-regular fa-image"></i>
                        <p>Media</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="media">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::routeIs('media.create') ? 'active' : '' }}">
                                <a href="{{ route('media.create') }}">
                                    <span class="sub-item">Add Image</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('media.index') ? 'active' : '' }}">
                                <a href="{{ route('media.index') }}">
                                    <span class="sub-item">Manage Images</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#rooms" class="{{ Request::routeIs('rooms.create') || Request::routeIs('rooms.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <p>Rooms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="rooms">
                        <ul class="nav nav-collapse">
                            @if (Auth::user()->role === 'Admin')
                            <li class="{{ Request::routeIs('rooms.create') ? 'active' : '' }}">
                                <a href="{{ route('rooms.create') }}">
                                    <span class="sub-item">Add Room</span>
                                </a>
                            </li>
                            @endif
                            <li class="{{ Request::routeIs('rooms.index') ? 'active' : '' }}">
                                <a href="{{ route('rooms.index') }}">
                                    <span class="sub-item">Manage Rooms</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#booking" class="{{ Request::routeIs('booking.create') || Request::routeIs('booking.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-book"></i>
                        <p>Bookings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="booking">
                        <ul class="nav nav-collapse">
                            <li class="{{ Request::routeIs('booking.create') ? 'active' : '' }}">
                                <a href="{{ route('booking.create') }}">
                                    <span class="sub-item">Add Booking</span>
                                </a>
                            </li>
                            <li class="{{ Request::routeIs('booking.index') ? 'active' : '' }}">
                                <a href="{{ route('booking.index') }}">
                                    <span class="sub-item">Manage Bookings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
