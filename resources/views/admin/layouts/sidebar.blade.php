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

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>

                <a href="{{ route('admin.settings.index') }}" class="dropdown-item has-icon">
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
            <a href="{{ route('admin.dashboard.index') }}">{{ config('settings.site_name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard.index') }}">{{ truncateText(config('settings.site_name'), 2) }}</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">MENU</li>
            <li class="{{ setSidebarActive(['admin.dashboard.index']) }}"><a class="nav-link"
                    href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i>
                    <span>Dashboard
                    </span></a></li>

            {{-- Sections --}}
            @can('section index')
                <li
                    class="dropdown {{ setSidebarActive([
                        'admin.hero.index',
                        'admin.our-features.index',
                        'admin.counter.index',
                        'admin.section-title.index',
                    ]) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>Sections</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.hero.index']) }}"><a class="nav-link"
                                href="{{ route('admin.hero.index') }}">Hero</a></li>
                        <li class="{{ setSidebarActive(['admin.our-features.index']) }}"><a class="nav-link"
                                href="{{ route('admin.our-features.index') }}">Our Feature</a></li>
                        <li class="{{ setSidebarActive(['admin.counter.index']) }}"><a class="nav-link"
                                href="{{ route('admin.counter.index') }}">Counter</a></li>
                        <li class="{{ setSidebarActive(['admin.section-title.index']) }}"><a class="nav-link"
                                href="{{ route('admin.section-title.index') }}">Section Titles</a></li>
                    </ul>
                </li>
            @endcan

            {{-- Listings --}}
            @canany(['listing index', ' pending listing', 'listing review ', 'listing claims'])
                <li
                    class="dropdown
            {{ setSidebarActive(['admin.category.*', 'admin.location.*', 'admin.amenity.*', 'admin.listing.*', 'admin.pending-listing.*', 'admin.listing-review.*', 'admin.listing-claims.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list-alt"></i>
                        <span>Listings</span></a>

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
                <li class="dropdown {{ setSidebarActive(['admin.package.*', 'admin.payment-settings.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-credit-card"></i></i> <span>Manage Packages</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.package.index']) }}"><a class="nav-link"
                                href="{{ route('admin.package.index') }}">Packages</a></li>
                        @can('payment settings index')
                            <li class="{{ setSidebarActive(['admin.payment-settings.index']) }}"><a class="nav-link"
                                    href="{{ route('admin.payment-settings.index') }}">Payment Settings</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            {{-- Order --}}
            @can('order index')
                <li class="{{ setSidebarActive(['admin.orders.index']) }}"><a class="nav-link"
                        href="{{ route('admin.orders.index') }}"><i class="fas fa-cart-plus"></i><span>
                            Orders</span></a></li>
            @endcan
            {{-- Message --}}
            @can('message index')
                <li class="{{ setSidebarActive(['admin.messages.index']) }}"><a class="nav-link"
                        href="{{ route('admin.messages.index') }}"><i class="fas fa-comment-alt"></i><span>
                            Messages</span></a></li>
            @endcan
            {{-- Testimonial --}}
            @can('testimonial index')
                <li class="{{ setSidebarActive(['admin.testimonial.index']) }}"><a class="nav-link"
                        href="{{ route('admin.testimonial.index') }}"><i class="fas fa-smile"></i></i>
                        <span>
                            Testimonials</span></a></li>
            @endcan
            {{-- Blog --}}
            @can('blog index')
                <li
                    class="dropdown {{ setSidebarActive(['admin.blog-category.*', 'admin.blog.*', 'admin.blog-comment.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-rss"></i>
                        <span>Manage Blog</span></a>

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
                <li
                    class="dropdown {{ setSidebarActive([
                        'admin.about-us.*',
                        'admin.contact-us.*',
                        'admin.privacy-policy.*',
                        'admin.terms-and-conditions.*',
                    ]) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="far fa-file-alt"></i> <span>Pages</span></a>

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
                <li class="dropdown {{ setSidebarActive(['admin.footer-info.*', 'admin.social-link.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-info-circle"></i> <span>Manage Footer</span></a>

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
                <li class="dropdown {{ setSidebarActive(['admin.role-user.*', 'admin.role.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-fingerprint"></i> <span>Access Management</span></a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role-user.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role-user.index') }}">Roles Users</a></li>
                        <li class="{{ setSidebarActive(['admin.role.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role.index') }}">Roles and Permissions</a></li>

                    </ul>
                </li>
            @endcan

            {{-- Menu Builder --}}
            @can('menu builder index')
                <li class="{{ setSidebarActive(['admin.menu-builder.*']) }}"><a class="nav-link"
                        href="{{ route('admin.menu-builder.index') }}"><i class="fas fa-wrench"></i>
                        <span>
                            Menu Builder</span></a></li>
            @endcan

            {{-- Settings --}}
            @can('settings index')
                <li class="{{ setSidebarActive(['admin.settings.*']) }}"><a class="nav-link"
                        href="{{ route('admin.settings.index') }}"><i class="fas fa-cogs"></i> <span>
                            Settings</span></a></li>
            @endcan

            {{-- Clear Database --}}
            @can('clear database')
                <li class="{{ setSidebarActive(['admin.clear-database.*']) }}"><a class="nav-link"
                        href="{{ route('admin.clear-database.index') }}"><i class="fas fa-skull-crossbones"></i>
                        <span>
                            Wipe Database</span></a></li>
            @endcan

        </ul>


    </aside>
</div>
