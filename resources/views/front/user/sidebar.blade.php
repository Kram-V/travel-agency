<ul class="list-group list-group-flush">
  <li class="list-group-item {{ Route::is('dashboard') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}">Dashboard</a>
  </li>
  <li class="list-group-item">
      <a href="user-order.html">Orders</a>
  </li>
  <li class="list-group-item">
      <a href="user-wishlist.html">Wishlist</a>
  </li>
  <li class="list-group-item">
      <a href="user-message.html">Message</a>
  </li>
  <li class="list-group-item">
      <a href="user-review.html">Reviews</a>
  </li>
  <li class="list-group-item {{ Route::is('profile') ? 'active' : '' }}">
      <a href="{{ route('profile') }}">Edit Profile</a>
  </li>
  <li class="list-group-item" {{ Route::is('logout') ? 'active' : '' }}>
      <a href="{{ route('logout_submit') }}">Logout</a>
  </li>
</ul>