<header id="sochead" class="site-header social-header user-nav-active">
    <nav class="navbar kmk-navbar social fixed-top">
        <div class="container">

            <ul id="navbar-user" class="navbar-nav navbar-user">
                @auth
                    <li id="friend-requests-list" class="nav-item dropdown friend-requests-list">
                        <a class="nav-link dropdown-toggle" href="#" id="nav_friend_requests" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-user-plus"></i>
                            <span class="nav-item-title">Friend Requests</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nav_friend_requests">
                            <div class="dropdown-title">Friend requests</div>
                            <div class="alert-message">
                                <div class="alert alert-warning" role="alert" id="pendingFriendRequestCount">

                                </div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="./friends/requests/" class="button">All Requests</a>
                            </div>
                        </div>
                    </li>
                    <li id="notification-list" class="nav-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle" href="#" id="nav_notification" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-bell"></i>
                            <span class="nav-item-title">Notifications</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nav_notification">
                            <div class="dropdown-title">Notifications</div>
                            <div class="alert-message">
                                <div class="alert alert-warning" role="alert">No notifications found</div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="./notifications/unread/" class="button">All Notifications</a>
                            </div>
                        </div>
                    </li>
                    <li id="private-message-list" class="nav-item dropdown private-message-list">
                        <a class="nav-link dropdown-toggle" href="#" id="nav_private_messages" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-envelope-open"></i>
                            <span class="nav-item-title">Messages</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nav_private_messages">
                            <div class="dropdown-title">Unread messages</div>
                            <div class="alert-message">
                                <div class="alert alert-warning" role="alert">No messages to read.</div>
                            </div>
                            <div class="dropdown-footer">
                                <a href="./messages/inbox/" class="button">All Messages</a>
                            </div>
                        </div>
                    </li>
                    <li class="mini-cart nav-item"><a href="{{ route('shops.manage_cart') }}" class="cart-contents nav-link" title="View Cart"><i
                                class="uil-cart"></i><span class="count">{{ $cartItems ?? "" }}</span></a></li>
                    <li id="myaccount-url-list" class="nav-item dropdown myaccount-url-list">
                        <a class="nav-link dropdown-toggle" href="#" id="nav_my_account" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img alt="" src="{{ asset(Auth::user()->profile_picture) }}"
                                class="avatar avatar-30 photo" height="30" width="30"> <span
                                class="account-name">@
                                {{ Auth::user()->username }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nav_my_account">
                            <ul id="menu-account-menu" class="member-account-menu">
                                <li id="menu-item-485"
                                    class="bp-menu bp-activity-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-485">
                                    <a href="./activity/">Timeline</a>
                                </li>
                                <li id="menu-item-486"
                                    class="bp-menu bp-profile-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-486">
                                    <a href="{{ route('users.profile') }}">Profile</a>
                                </li>
                                <li id="menu-item-487"
                                    class="bp-menu bp-friends-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-487">
                                    <a href="{{ route('peoples.list_friends') }}">Friends</a>
                                </li>
                                <li id="menu-item-488"
                                    class="bp-menu bp-groups-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-488">
                                    <a href="{{ route('groups.index') }}">Groups</a>
                                </li>
                                <li id="menu-item-611"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-611">
                                    <a href="{{ route('peoples.games') }}">Games</a>
                                </li>
                                <li id="menu-item-491"
                                    class="bp-menu bp-notifications-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-491">
                                    <a href="./notifications/">Notifications</a>
                                </li>
                                <li id="menu-item-492"
                                    class="bp-menu bp-messages-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-492">
                                    <a href="./messages/">Messages</a>
                                </li>
                                <li id="menu-item-93"
                                    class="bp-menu bp-settings-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-93">
                                    <a href="./settings/">Settings</a>
                                </li>
                                <li id="menu-item-94"
                                    class="bp-menu bp-logout-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-94">
                                    <a href="{{ route('users.logout') }}">Log
                                        Out</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endauth

                @guest

                    <li class="mini-cart nav-item"><a href="{{ route('shops.manage_cart') }}" class="cart-contents nav-link" title="View Cart"><i
                                class="uil-cart"></i></a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link login" data-toggle="modal"
                            data-target="#login-modal">Login</a>
                    </li>

                    <li class="nav-item">
                        <a href="./register/" class="nav-link register">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
