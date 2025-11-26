<div id="kmk-social-panel" class="kmk-social-panel">
    <div class="inner-panel ass-scrollbar">
        <div class="panel-block dark">
            <a href="./" class="panel-logo item">
                <img src="/assets/images/logo.png" alt=" Business Name" />
            </a>
            <div class="my-card item">
                @auth
                    <div class="info">
                        <a href="{{ route('users.profile') }}" class="profile-avatar">
                            <img src="{{ asset(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->username }}"
                                class="avatar mCS_img_loaded">
                        </a>
                        <div class="profile-name">
                            <a href="{{ route('users.profile') }}" class="name ellipsis">{{ Auth::user()->name }}</a>
                            <small>{{ Auth::user()->user_type == USER_TYPE_ADMIN ? 'Administrator' : 'User' }}</small>

                        </div>
                    </div>
                    <ul class="connections ml-4">
                        <li><span class="count" id="totalFriendsCount">{{ $friends }}</span>
                            <p class="mute">Friends</p>
                        </li>
                        <li><span class="count">0</span>
                            <p class="mute">Groups</p>
                        </li>
                    </ul>
                @endauth
                @guest
                    <h4 class="form-title">Login Now</h4>
                    <form action="{{ route('users.authenticate') }}" method="post" id="panel-login-form"
                        class="kmk-login-form panel-login" name="panel-login">
                        <div class="form-group">
                            <div class="user-name">
                                <label class="screen-reader-text">Email/username</label>
                                <span class="icon"><i class="uil-user"></i></span>
                                <input type="text" id="username" class="username-control" required name="log"
                                    value="" placeholder="Email or username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="pass">
                                <label class="screen-reader-text">Password</label>
                                <span class="icon"><i class="uil-key-skeleton-alt"></i></span>
                                <input type="password" id="password" class="password-control" required name="pwd"
                                    value="" placeholder="Password">
                            </div>
                        </div>
                        <div class="kmk-login-result"></div>
                        <div class="submit">
                            <button type="submit" id="login_submit" class="submit-login" name="wp-submit">Log
                                In</button>
                        </div>
                        <input type="hidden" id="panel-login-security" name="panel-login-security"
                            value="171d7e1524" /><input type="hidden" name="_wp_http_referer"
                            value="/MIGVELv1/activity-2/" />
                        <div class="register-link">
                            <a href="./register/" class="register color-primary">Create an account</a>
                        </div>
                    </form>
                @endguest
            </div>
        </div>
        <div class="panel-block light">
            <div class="panel-menu item">
                <ul id="menu-dashboard-menu" class="navbar-panel">
                    <li id="menu-item-475"
                        class="menu-item menu-item-type-post_type menu-item-object-page
                            @if (Route::currentRouteName() == 'users.show_dashboard') current-menu-item @endif
                            page_item page-item-35 menu-item-475">
                        <a href="{{ route('users.show_dashboard') }}">
                            <i class="uil-notebooks"></i>
                            <span class="nav-link-text">Activity</span>
                        </a>
                    </li>

                    <li id="menu-item-481"
                        class="menu-item menu-item-type-post_type menu-item-object-page
                            @if (Route::currentRouteName() == 'posts.show_photos') current-menu-item @endif
                            menu-item-481">
                        <a href="{{ route('posts.show_photos') }}">
                            <i class="uil-image-v"></i>
                            <span class="nav-link-text">Photos</span>
                        </a>
                    </li>
                    <li id="menu-item-483"
                        class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'posts.show_videos') current-menu-item @endif menu-item-483">
                        <a href="{{ route('posts.show_videos') }}"><i class="uil-play"></i><span
                                class="nav-link-text">Watch</span></a>
                    </li>
                    <li id="menu-item-484"
                        class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'peoples.list') current-menu-item @endif menu-item-484">
                        <a href="{{ route('peoples.list') }}"><i class="uil-user"></i><span
                                class="nav-link-text">People</span></a>
                    </li>
                    <li id="menu-item-614"
                        class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'peoples.games') current-menu-item @endif menu-item-614">
                        <a href="{{ route('peoples.games') }}"><i class="uil-users-alt"></i><span
                                class="nav-link-text">Games</span></a>
                    </li>
                    <li id="menu-item-476"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-476"><a
                            href="{{ route('users.advertisments') }}"><i class="uil-tv-retro"></i><span
                                class="nav-link-text">Adverts</span></a>
                    </li>
                    <li id="menu-item-482"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-482"><a
                            href="{{ route('shops.list') }}"><i class="uil-shopping-trolley"></i><span
                                class="nav-link-text">Shop</span></a></li>
                    <li id="menu-item-480"
                        class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'posts.jobs_listing') current-menu-item @endif menu-item-480">
                        <a href="{{ route('posts.jobs_listing') }}"><i class="uil-briefcase-alt"></i><span
                                class="nav-link-text">Jobs</span></a>
                    </li>
                    <li id="menu-item-478"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-478"><a
                            href="./forums/"><i class="uil-comments"></i><span
                                class="nav-link-text">Forums</span></a></li>
                    <li id="menu-item-477"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-477"><a
                            href="{{ route('blogs.list') }}"><i class="uil-newspaper"></i><span
                                class="nav-link-text">Blog</span></a>
                    </li>
                    <li id="menu-item-701"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-701"><a
                            href="./music/"><i class="uil-music"></i><span class="nav-link-text">Music</span></a>
                    </li>
                    <li id="menu-item-751"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-751"><a
                            href="./stock-market/"><i class="uil-chart-bar"></i><span class="nav-link-text">Stock
                                Market</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
