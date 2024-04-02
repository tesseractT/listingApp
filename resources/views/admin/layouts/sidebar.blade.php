<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b>
                            <p>Hello, Bro!</p>
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Dedik Sugiharto</b>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                            <div class="is-online"></div>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Agung Ardiansyah</b>
                            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Ardian Rahardiansyah</b>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                            <div class="time">16 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-avatar">
                            <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Alfa Zulkarnain</b>
                            <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Template update is available now!
                            <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-danger text-white">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Low disk space. Let's clean it!
                            <div class="time">17 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Welcome to Stisla template!
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>



            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Starter</li>
            <li class="{{ setSidebarActive(['admin.dashboard.index']) }}"><a class="nav-link"
                    href="{{ route('admin.dashboard.index') }}"><i class="far fa-square"></i>
                    <span>Dashboard
                    </span></a></li>

            {{-- Sections --}}
            @can('section index')
                <li class="dropdown {{ setSidebarActive(['admin.hero.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Sections</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.hero.index']) }}"><a class="nav-link"
                                href="{{ route('admin.hero.index') }}">Hero</a></li>
                        <li class="{{ setSidebarActive(['admin.our-features.index']) }}"><a class="nav-link"
                                href="{{ route('admin.our-features.index') }}">Our Feature</a></li>
                        <li class="{{ setSidebarActive(['admin.counter.index']) }}"><a class="nav-link"
                                href="{{ route('admin.counter.index') }}">Counter</a></li>
                    </ul>
                </li>
            @endcan

            {{-- Listings --}}
            @canany(['listing index', ' pending listing', 'listing review ', 'listing claims'])
                <li
                    class="dropdown
            {{ setSidebarActive(['admin.category.*', 'admin.location.*', 'admin.amenity.*', 'admin.listing.*', 'admin.pending-listing.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Listings</span></a>

                    <ul class="dropdown-menu">
                        @can('listing index')
                            <li class="{{ setSidebarActive(['admin.category.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.category.index') }}">Categories</a></li>
                            <li class="{{ setSidebarActive(['admin.location.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.location.index') }}">Locations</a></li>
                            <li class="{{ setSidebarActive(['admin.amenity.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.amenity.index') }}">Amenities</a></li>
                            <li class="{{ setSidebarActive(['admin.listing.*', 'admin.listing-.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.listing.index') }}">All Listings</a></li>
                        @endcan

                        @can('pending listing')
                            <li class="{{ setSidebarActive(['admin.pending-listing.*', 'admin.listing-.*']) }}"><a
                                    class="nav-link" href="{{ route('admin.pending-listing.index') }}">Pending Listings</a>
                            </li>
                        @endcan
                        @can('listing review')
                            <li class="{{ setSidebarActive(['admin.listing-review.index']) }}"><a class="nav-link"
                                    href="{{ route('admin.listing-review.index') }}">Listing Reviews</a>
                            </li>
                        @endcan
                        @can('listing claims')
                            <li class="{{ setSidebarActive(['admin.listing-claims.index']) }}"><a class="nav-link"
                                    href="{{ route('admin.listing-claims.index') }}">Claims</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanany
            {{-- PAckages and Payments --}}
            @can('package index')
                <li class="dropdown {{ setSidebarActive(['admin.package.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Manage Packages</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.package.*']) }}"><a class="nav-link"
                                href="{{ route('admin.package.index') }}">Packages</a></li>
                        @can('payment settings index')
                            <li class="{{ setSidebarActive(['admin.package.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.payment-settings.index') }}">Payment Settings</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Order --}}
            @can('order index')
                <li><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="far fa-square"></i> <span>
                            Orders</span></a></li>
            @endcan
            {{-- Message --}}
            @can('message index')
                <li><a class="nav-link" href="{{ route('admin.messages.index') }}"><i class="far fa-square"></i> <span>
                            Messages</span></a></li>
            @endcan
            {{-- Testimonial --}}
            @can('testimonial index')
                <li><a class="nav-link" href="{{ route('admin.testimonial.index') }}"><i class="far fa-square"></i>
                        <span>
                            Testimonials</span></a></li>
            @endcan
            {{-- Blog --}}
            @can('blog index')
                <li class="dropdown {{ setSidebarActive(['admin.blog-category.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Manage Blog</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.blog-category.*']) }}"><a class="nav-link"
                                href="{{ route('admin.blog-category.index') }}">Blog Categories</a></li>
                        <li class="{{ setSidebarActive(['admin.blog.*']) }}"><a class="nav-link"
                                href="{{ route('admin.blog.index') }}">Blog Posts</a></li>
                        <li class="{{ setSidebarActive(['admin.blog-comment.*']) }}"><a class="nav-link"
                                href="{{ route('admin.blog-comment.index') }}">Blog Comments</a></li>
                    </ul>
                </li>
            @endcan

            {{-- Pages --}}
            @canany(['about index', 'contact index', 'privacy policy index', 'terms and conditions index'])
                <li class="dropdown {{ setSidebarActive(['admin.blog-category.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Pages</span></a>

                    <ul class="dropdown-menu">
                        @can('about index')
                            <li class="{{ setSidebarActive(['admin.about-us.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.about-us.index') }}">About Us</a></li>
                        @endcan
                        @can('contact index')
                            <li class="{{ setSidebarActive(['admin.contact-us.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.contact-us.index') }}">Contact Us</a></li>
                        @endcan
                        @can('privacy policy index')
                            <li class="{{ setSidebarActive(['admin.privacy-policy.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.privacy-policy.index') }}">Privacy Policy</a></li>
                        @endcan
                        @can('terms and conditions index')
                            <li class="{{ setSidebarActive(['admin.terms-and-conditions.*']) }}"><a class="nav-link"
                                    href="{{ route('admin.terms-and-conditions.index') }}">Terms & Conditions</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            {{-- Footer --}}
            @can('footer index')
                <li class="dropdown {{ setSidebarActive(['admin.footer-info.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Manage Footer</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.footer-info.*']) }}"><a class="nav-link"
                                href="{{ route('admin.footer-info.index') }}">Footer Info</a></li>
                        <li class="{{ setSidebarActive(['admin.social-link.*']) }}"><a class="nav-link"
                                href="{{ route('admin.social-link.index') }}">Social Links</a></li>
                    </ul>
                </li>
            @endcan

            {{-- Access Management --}}
            @can('access management index')
                <li class="dropdown {{ setSidebarActive(['admin.footer-info.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i> <span>Access Management</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role-user.index') }}">Roles Users</a></li>
                        <li class="{{ setSidebarActive(['admin.role.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role.index') }}">Roles and Permissions</a></li>

                    </ul>
                </li>
            @endcan

            {{-- Menu Builder --}}
            @can('menu builder index')
                <li><a class="nav-link" href="{{ route('admin.menu-builder.index') }}"><i class="far fa-square"></i>
                        <span>
                            Menu Builder</span></a></li>
            @endcan

            {{-- Settings --}}
            @can('settings index')
                <li><a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="far fa-square"></i> <span>
                            Settings</span></a></li>
            @endcan

        </ul>


    </aside>
</div>
