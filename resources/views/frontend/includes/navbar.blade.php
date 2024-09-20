<body>
   <header role="banner">
    {{-- Navbar Start --}}
    <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">RoomHaven</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
                <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('rooms') ? 'active' : '' }}" href="{{ route('rooms') }}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rooms</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ route('rooms') }}">Room Videos</a>
                            <a class="dropdown-item" href="{{ route('rooms') }}">Presidential Room</a>
                            <a class="dropdown-item" href="{{ route('rooms') }}">Luxury Room</a>
                            <a class="dropdown-item" href="{{ route('rooms') }}">Deluxe Room</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>

                    @guest
                        <!-- If user is not logged in -->
                        <li class="pl-2 nav-item cta d-flex">
                            <a class="nav-link" href="{{ route('login') }}"><span>Login</span></a>
                            <a class="nav-link" href="{{ route('register') }}"><span>Sign up</span></a>
                        </li>
                    @else
                        <!-- If user is logged in -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle profile-pic" href="#" data-bs-toggle="dropdown">
                                <div class="avatar-sm">
                                    <img src="{{ asset(Auth::user()->profile_image) }}" alt="Profile" class="avatar-img rounded-circle">
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold">{{ Auth::user()->username }}</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="{{ asset(Auth::user()->profile_image) }}" alt="Profile" class="avatar-img-lg rounded">
                                            </div>
                                            <div class="u-text">
                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p class="text-muted">{{ Auth::user()->email }}</p>
                                                <a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    {{-- Navbar End  --}}
</header>

</body>