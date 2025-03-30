<div class="top bg-warning">
  <div class="container">
      <div class="row">
          <div class="col-md-6 left-side">
              <ul>
                  <li class="phone-text"><i class="fas fa-phone"></i> 222-222-2222</li>
                  <li class="email-text"><i class="fas fa-envelope"></i> contact@example.com</li>
              </ul>
          </div>

          <div class="col-md-6 right-side">
            <ul class="right">
              @if (Auth::guard('web')->check())
                <li class="menu">
                  @if (Auth::guard('web')->user()->photo)
                    <img style="width: 30px; border-radius: 100%" src="{{ asset('uploads/user/' . Auth::guard('web')->user()->photo) }}" alt="{{ Auth::guard('web')->user()->name }}">
                  @else
                    <img style="width: 30px; border-radius: 100%" src="images/default.png" alt="Default">
                  @endif
                </li>
                <li class="menu">
                  <a href="{{ route('dashboard') }}"><i class="fas fa-columns"></i> Dashboard</a>
                </li>
                <li class="menu">
                  <a href="{{ route('logout_submit') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
              @else
                <li class="menu">
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
                <li class="menu">
                    <a href="{{ route('register') }}"><i class="fas fa-user"></i> Sign Up</a>
                </li>
              @endif
            </ul>
          </div>
      </div>
  </div>
</div>


<div class="navbar-area" id="stickymenu">
  <!-- Menu For Mobile Device -->
  <div class="mobile-nav">
      <a style="font-weight: 700; font-size: 20px; text-transform: none;"  href="{{ route('home') }}" class="text-black logo">
          EscapeEase
      </a>
  </div>

  <!-- Menu For Desktop Device -->
  <div class="main-nav">
      <div class="container">
          <nav class="navbar navbar-expand-md navbar-light">
              <a style="font-weight: 700; font-size: 25px;" class="text-black" href="{{ route('home') }}">
                  EscapeEase
              </a>
              <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                          <a href="{{ route('home') }}" class="nav-link">Home</a>
                      </li>
                      <li class="nav-item {{ Route::is('about') ? 'active' : '' }}">
                          <a href="{{ route('about') }}" class="nav-link">About</a>
                      </li>
                      <li class="nav-item {{ Route::is('destinations') ? 'active' : '' }}">
                          <a href="{{ route('destinations') }}" class="nav-link">Destinations</a>
                      </li>
                      <li class="nav-item {{ Route::is('packages') ? 'active' : '' }}">
                          <a href="{{ route('packages') }}" class="nav-link">Packages</a>
                      </li>
                      <li class="nav-item {{ Route::is('team_members') ? 'active' : '' }}">
                          <a href="{{ route('team_members') }}" class="nav-link">Team</a>
                      </li>
                      <li class="nav-item {{ Route::is('faqs') ? 'active' : '' }}">
                          <a href="{{ route('faqs') }}" class="nav-link">FAQ</a>
                      </li>
                      <li class="nav-item {{ Route::is('blogs') ? 'active' : '' }}">
                          <a href="{{ route('blogs') }}" class="nav-link">Blogs</a>
                      </li>
                      <li class="nav-item {{ Route::is('contact') ? 'active' : '' }}">
                          <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                      </li>
                  </ul>
              </div>
          </nav>
      </div>
  </div>
</div>