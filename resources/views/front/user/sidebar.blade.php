<ul class="list-group list-group-flush">
  <li class="list-group-item {{ Route::is('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}">Dashboard</a>
  </li>
  <li class="list-group-item {{ Route::is('bookings') ? 'active' : '' }}">
      <a href="{{ route('bookings') }}">Bookings</a>
  </li>
  <li class="list-group-item">
      <a href="user-message.html">Message</a>
  </li>
  <li class="list-group-item {{ Route::is('reviews') ? 'active' : '' }}">
      <a href="{{ route('reviews') }}">Reviews</a>
  </li>
  <li class="list-group-item {{ Route::is('profile') ? 'active' : '' }}">
      <a href="{{ route('profile') }}">Edit Profile</a>
  </li>
  <li class="list-group-item" {{ Route::is('logout') ? 'active' : '' }}>
      <a href="{{ route('logout_submit') }}">Logout</a>
  </li>
</ul>