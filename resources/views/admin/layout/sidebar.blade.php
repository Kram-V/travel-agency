<div class="main-sidebar">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
          <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
          <a href="{{ route('admin_dashboard') }}"></a>
      </div>

      <ul class="sidebar-menu">
          <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_dashboard') }}"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>

          <li class="nav-item dropdown {{ Request::is('admin/blog-*') ? 'active' : '' }}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-pen"></i><span>Blog</span></a>
              <ul class="dropdown-menu">
                  <li class="{{ Request::is('admin/blog-categories*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_blog_categories_index') }}"><i style="margin-right: 4px" class="fas fa-folder"></i>Categories</a></li>
                  <li class="{{ Request::is('admin/blog-posts*') ? 'active' : '' }}"><a class="nav-link active" href="{{ route('admin_blog_posts_index') }}"><i style="margin-right: 4px"  class="fas fa-file-alt"></i>Posts</a></li>
              </ul>
          </li>

          <li class="{{ Request::is('admin/profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_profile') }}"><i class="fas fa-user-circle"></i><span>Profile</span></a></li>
          <li class="{{ Request::is('admin/welcome-item') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_welcome_item_edit') }}"><i class="fas fa-hand-paper"></i><span>Welcome Item</span></a></li>
          <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_sliders_index') }}"><i class="fas fa-sliders-h"></i><span>Sliders</span></a></li>
          <li class="{{ Request::is('admin/features*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_features_index') }}"><i class="fab fa-flipboard"></i><span>Features</span></a></li>
          <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonials_index') }}"><i class="fab fa-discourse"></i><span>Testimonials</span></a></li>
          <li class="{{ Request::is('admin/team-members*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_team_members_index') }}"><i class="fas fa-users"></i><span>Team Members</span></a></li>
          <li class="{{ Request::is('admin/faqs*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faqs_index') }}"><i class="fas fa-question"></i><span>FAQs</span></a></li>
          <li class="{{ Request::is('admin/destinations*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_destinations_index') }}"><i class="fas fa-plane-departure"></i><span>Destinations</span></a></li>
          <li class="{{ Request::is('admin/packages*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_packages_index') }}"><i class="fas fa-box-open"></i><span>Packages</span></a></li>
          <li class="{{ Request::is('admin/amenities*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_amenities_index') }}"><i class="fas fa-hotel"></i><span>Amenities</span></a></li>
          <li class="{{ Request::is('admin/tours*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_tours_index') }}"><i class="fas fa-globe"></i><span>Tours</span></a></li>
          <li class="{{ Request::is('admin/reviews*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_reviews_index') }}"><i class="fas fa-star"></i><span>Reviews</span></a></li>
          <li class="{{ Request::is('admin/messages') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_messages_index') }}"><i class="fas fa-comment"></i><span>Messages</span></a></li>
          <li class="nav-item dropdown {{ Request::is('admin/subscribers-*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>Subscribers Section</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('admin/subscribers-email') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscribers_index') }}"><i style="margin-right: 4px" class="fas fa-list"></i>Subscribers</a></li>
                <li class="{{ Request::is('admin/subscribers-send-email') ? 'active' : '' }}"><a class="nav-link active" href="{{ route('admin_subscribers_email') }}"><i style="margin-right: 4px" class="fas fa-envelope"></i>Email</a></li>
            </ul>
        </li>
      </ul>
  </aside>
</div>