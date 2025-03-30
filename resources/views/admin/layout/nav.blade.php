<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right justify-content-end rightsidetop">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @if (Auth::guard('admin')->user()->photo)
                  <img alt="image" src="{{ asset('uploads/admin/' . Auth::guard('admin')->user()->photo) }}" class="rounded-circle-custom">
                @else
                  <img alt="image" src="{{ asset('images/default.png') }}" class="rounded-circle-custom">
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('admin_profile') }}"><i class="far fa-user"></i> Edit Profile</a></li>
                <li>
                  <a class="dropdown-item" href="{{ route('admin_logout_submit') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>