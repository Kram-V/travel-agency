<div class="main-sidebar">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
          <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
          <a href="{{ route('admin_dashboard') }}"></a>
      </div>

      <ul class="sidebar-menu">

          <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_dashboard') }}"><i class="fas fa-hand-point-right"></i> <span>Dashboard</span></a></li>

          <li class="nav-item dropdown {{ Request::is('admin/blog-*') ? 'active' : '' }}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Blog</span></a>
              <ul class="dropdown-menu">
                  <li class="{{ Request::is('admin/blog-categories*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_blog_categories_index') }}"><i class="fas fa-angle-right"></i>Categories</a></li>
                  <li class="{{ Request::is('admin/blog-posts*') ? 'active' : '' }}"><a class="nav-link active" href="{{ route('admin_blog_posts_index') }}"><i class="fas fa-angle-right"></i>Posts</a></li>
              </ul>
          </li>

          <li class="{{ Request::is('admin/profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_profile') }}"><i class="fas fa-user-circle"></i><span>Profile</span></a></li>
          <li class="{{ Request::is('admin/welcome-item') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_welcome_item_edit') }}"><i class="fab fa-wikipedia-w"></i><span>Welcome Item</span></a></li>
          <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_sliders_index') }}"><i class="fas fa-sliders-h"></i><span>Sliders</span></a></li>
          <li class="{{ Request::is('admin/features*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_features_index') }}"><i class="fab fa-flipboard"></i><span>Features</span></a></li>
          <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_testimonials_index') }}"><i class="fab fa-discourse"></i><span>Testimonials</span></a></li>
          <li class="{{ Request::is('admin/team-members*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_team_members_index') }}"><i class="fas fa-users"></i><span>Team Members</span></a></li>
          <li class="{{ Request::is('admin/faqs*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faqs_index') }}"><i class="fas fa-users"></i><span>FAQs</span></a></li>
      </ul>
  </aside>
</div>