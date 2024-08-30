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
                  <a class="nav-link dropdown-toggle {{ Request::is('rooms') ? 'active' : '' }}" href="{{ route('rooms')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rooms</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="{{ route('rooms')}}">Room Videos</a>
                    <a class="dropdown-item" href="{{ route('rooms')}}">Presidential Room</a>
                    <a class="dropdown-item" href="{{ route('rooms')}}">Luxury Room</a>
                    <a class="dropdown-item" href="{{ route('rooms')}}">Deluxe Room</a>
                  </div>
  
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about')}}">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact')}}">Contact</a>
                </li>
  
                 <li class="nav-item cta">
                  <a class="nav-link {{ Request::is('booknow') ? 'active' : '' }}" href="{{ route('booknow')}}"><span>Book Now</span></a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
      </header>
      {{-- Navbar End  --}}
</body>