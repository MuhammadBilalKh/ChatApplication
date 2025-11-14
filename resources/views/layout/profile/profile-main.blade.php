<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

    <title>Profile</title>

    <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" media="all" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" media="all" />

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/kmk.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" media="all" />

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <!-- KMK -->
    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">


    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

    <style>
        /* Highest stacking context for chat wrapper */
        .wrapper {
            z-index: 999999;
        }

        .emoji-picker {
            width: 300px !important;
        }

        /* ===== Scrollbar styling ===== */

        /* WebKit browsers (Chrome, Edge, Safari) */
        .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar {
            width: 12px;
        }

        .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar-track {
            background: #fff;
        }

        .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar-thumb {
            background-color: #f5bd02;
            border-radius: 6px;
            border: 3px solid #fff;
        }

        /* Firefox scrollbar */
        .chat-window__message-list.vb.vb-invisible {
            scrollbar-width: thin;
            scrollbar-color: #f5bd02 #fff;
        }

        /* ===== Input area ===== */
        .chat-window__inputarea {
            display: flex;
            align-items: flex-end;
            /* align emoji + input + send button at bottom */
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 5px 10px;
            width: 100%;
            box-sizing: border-box;
            border-top: 1px solid #ddd;
        }

        /* ===== Message input field ===== */
        .chat-window__input {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            position: relative;
            border-radius: 6px;
            min-height: 40px;
            background: #fff;
        }

        .chat-window__input--placeholder {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
            font-size: 14px;
            user-select: none;
        }

        .chat-window__input--field {
            min-height: 35px;
            padding: 8px 12px;
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            line-height: 20px;
        }

        /* Hide placeholder when typing */
        .chat-window__input--field:focus+.chat-window__input--placeholder,
        .chat-window__input--field:not(:empty)+.chat-window__input--placeholder {
            display: none;
        }

        /* ===== Emoji button ===== */
        .chat-window__input--emoji {
            display: flex;
            align-items: flex-end;
            margin-left: 8px;
        }

        .chat-window__input--emoji button {
            background: transparent;
            border: none;
            font-size: 19px;
            cursor: pointer;
            transition: transform 0.2s ease;
            padding: 0;
            box-shadow: none;
        }

        .chat-window__input--emoji button:hover {
            transform: scale(1.2);
        }

        /* ===== Send button ===== */
        .chat-window__btn--enter {
            margin-left: 5px;
            text-decoration: none;
            color: #007aff;
            font-size: 20px;
        }

        .chat-window__btn--enter:hover {
            color: #005bb5;
        }

        /* ===== Emoji images in messages ===== */
        .message img.emoji {
            width: 22px;
            height: 22px;
            vertical-align: middle;
        }

        /* Base styles for the floating button */
        .chat-float {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 99999;
            display: none;
            /* Hidden by default (for desktop/tablet) */
        }

        /* Circle shape and styling */
        .chat-floatbody {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #F5BD02;
            color: #fff;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            font-size: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .chat-floatbody:hover {
            background-color: #f0c22a;
            transform: scale(1.1);
        }

        .chat-floatbody .dropd-control .dashicons {
            height: 30px;
            width: 30px;
            position: absolute;
            top: 11px;
            left: 7px;
        }

        /* Show only on mobile */
        @media (max-width: 768px) {
            .chat-float {
                display: block;
            }
        }
    </style>

</head>

<body
    class="directory activity kmkpress bp-nouveau blog  page-template-default page page-id-35 logged-in wp-theme-kmk theme-kmk  kmk kmk-user buddychat-is-active   title-bar-active kmk-social-layout panel-expanded has-page-sidebar">

    @include('layout.master.sidepanel')

    <div id="kmk-page" class="site">
        @include('layout.profile.profile_header')
        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <div class="layout social">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-12 col-main">
                                <main id="main" class="main-content">

                                    <div class="kmk-title-bar social">
                                        <div class="title-bar-wrapper">
                                            <div class="title-wrapper screen-reader-text">
                                                <h1 class="title h3">Blog</h1>
                                            </div>
                                        </div>
                                    </div>

                                    <article id="post-0"
                                        class="bp_members type-bp_members post-0 page type-page status-publish hentry kmk-post">
                                        <div class="entry-content clearfix">
                                            <div id="buddypress" class="buddypress-wrap kmk bp-dir-hori-nav alignwide">

                                                <div id="item-header" role="complementary" data-bp-item-id="2"
                                                    data-bp-item-component="members"
                                                    class="users-header single-headers">


                                                    <div id="cover-image-container">
                                                        <div id="header-cover-image"></div>

                                                        <div id="item-header-cover-image">
                                                            <div class="row">

                                                                <div class="col-lg-3">
                                                                    <div id="item-header-avatar">
                                                                        <div class="item-avatar">
                                                                            <a href="/members-2/">
                                                                                <img src="{{ asset(Auth::user()->profile_picture) }}"
                                                                                    class="avatar user-2-avatar avatar-200 photo"
                                                                                    width="200" height="200"
                                                                                    alt="Profile picture of Sandlas">
                                                                            </a>

                                                                        </div>
                                                                        <h3 class="profile-name">
                                                                            {{ Auth::user()->username }}</h3>
                                                                    </div><!-- #item-header-avatar -->
                                                                </div>

                                                                <div class="col-lg-9">

                                                                    <div id="item-header-content">

                                                                        <h2 class="user-nicename text-white">@
                                                                            {{ Auth::user()->username }}
                                                                        </h2>

                                                                        <div class="item-meta">
                                                                            <span class="activity d-none">Active 44
                                                                                seconds ago</span>
                                                                        </div><!-- #item-meta -->
                                                                    </div><!-- #item-header-content -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bp-wrap">


                                                    <nav class="main-navs no-ajax bp-navs single-screen-navs horizontal users-nav"
                                                        id="object-nav" role="navigation" aria-label="Member menu">

                                                        <div class="row">
                                                            <div class="col-lg-6  mx-auto">
                                                                <div class="nav-container">

                                                                    <ul class="profile-nav p-0">

                                                                        <li id="xprofile-personal-li"
                                                                            class="bp-personal-tab selected current">
                                                                            <a href="." id="user-xprofile"
                                                                                title="Profile">
                                                                                <span
                                                                                    class="nav-link-text ">Profile</span>

                                                                            </a>
                                                                        </li>

                                                                        <li id="friends-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="./friends/" id="user-friends"
                                                                                title="Friends">
                                                                                <span
                                                                                    class="nav-link-text">Friends</span>

                                                                                <span
                                                                                    class="count color-primary">2</span>
                                                                            </a>
                                                                        </li>

                                                                        <li id="groups-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="./groups/" id="user-groups"
                                                                                title="Groups">
                                                                                <span
                                                                                    class="nav-link-text">Groups</span>

                                                                            </a>
                                                                        </li>

                                                                        <li id="my-adverts-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="./my-adverts/"
                                                                                id="user-my-adverts" title="Adverts">
                                                                                <span
                                                                                    class="nav-link-text">Adverts</span>

                                                                            </a>
                                                                        </li>

                                                                        <li id="forums-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="./forums/" id="user-forums"
                                                                                title="Forums">
                                                                                <span
                                                                                    class="nav-link-text">Forums</span>

                                                                            </a>
                                                                        </li>
                                                                        <li class="flexMenu-viewMore">
                                                                            <a href="#" data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false"><span
                                                                                    class="nav-link-text">More<text></text></span><span
                                                                                    class="count">6</span></a>
                                                                            <ul
                                                                                class="flexMenu-popup dropdown-menu dropdown-menu-right">
                                                                                <li id="shop-personal-li"
                                                                                    class="bp-personal-tab">
                                                                                    <a href="./shop/" id="user-shop"
                                                                                        title="Shop">
                                                                                        <span
                                                                                            class="nav-link-text">Shop</span>

                                                                                    </a>
                                                                                </li>
                                                                                <li id="media-personal-li"
                                                                                    class="bp-personal-tab">
                                                                                    <a href="./media/" id="user-media"
                                                                                        title="Media">
                                                                                        <span
                                                                                            class="nav-link-text">Media</span>

                                                                                        <span
                                                                                            class="count color-primary">4</span>
                                                                                    </a>
                                                                                </li>
                                                                                <li id="invitations-personal-li"
                                                                                    class="bp-personal-tab">
                                                                                    <a href="./invitations/"
                                                                                        id="user-invitations"
                                                                                        title="Invitations">
                                                                                        <span
                                                                                            class="nav-link-text">Invitations</span>

                                                                                    </a>
                                                                                </li>
                                                                                <li id="notifications-personal-li"
                                                                                    class="bp-personal-tab">
                                                                                    <a href="./notifications/"
                                                                                        id="user-notifications"
                                                                                        title="Notifications">
                                                                                        <span
                                                                                            class="nav-link-text">Notifications</span>

                                                                                    </a>
                                                                                </li>
                                                                                <li id="messages-personal-li"
                                                                                    class="bp-personal-tab">
                                                                                    <a href="./messages/"
                                                                                        id="user-messages"
                                                                                        title="Messages">
                                                                                        <span
                                                                                            class="nav-link-text">Messages</span>

                                                                                    </a>
                                                                                </li>
                                                                                <li id="settings-personal-li"
                                                                                    class="bp-personal-tab">
                                                                                    <a href="./settings/"
                                                                                        id="user-settings"
                                                                                        title="Settings">
                                                                                        <span
                                                                                            class="nav-link-text">Settings</span>

                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </nav>

                                                    <div id="item-body" class="item-body">

                                                        <div class="row">

                                                            <div class="col-lg-3 profile-col-aside left">
                                                                <aside
                                                                    class="widget-area profile-widget-area displayed-profile-info">
                                                                    <div class="widget">
                                                                        <ul class="connections">
                                                                            <li><span
                                                                                    class="count color-primary">2</span>
                                                                                <p>Friends</p>
                                                                            </li>
                                                                            <li><span
                                                                                    class="count color-primary">0</span>
                                                                                <p>Groups</p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                    <div class="widget">
                                                                        <h5 class="widget-title">My photos</h5>
                                                                        <ul class="member-photo-list">
                                                                            <li
                                                                                class="rtmedia-list-media rtm-gallery-list member-photo">
                                                                                <div class="inner">
                                                                                    <a href="./media/10/">
                                                                                        <img src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/rtMedia/users/2/2025/10/GettyImages-2171965934-250x250.jpg"
                                                                                            alt="GettyImages-2171965934">
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="rtmedia-list-media rtm-gallery-list member-photo">
                                                                                <div class="inner">
                                                                                    <a href="./media/9/">
                                                                                        <img src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/rtMedia/users/2/2025/10/513551639_2456303934741441_2207866387033912126_n-250x250.jpg"
                                                                                            alt="513551639_2456303934741441_2207866387033912126_n">
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="rtmedia-list-media rtm-gallery-list member-photo">
                                                                                <div class="inner">
                                                                                    <a href="./media/8/">
                                                                                        <img src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/rtMedia/users/2/2025/10/Screenshot-2025-09-03-112450-250x250.png"
                                                                                            alt="Screenshot 2025-09-03 112450">
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                            <li
                                                                                class="rtmedia-list-media rtm-gallery-list member-photo">
                                                                                <div class="inner">
                                                                                    <a href="./media/6/">
                                                                                        <img src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/rtMedia/users/2/2025/10/portrait-happy-smiling-millennial-woman-hugging-playing-group-akita-inu-puppies-sofa_1429-24033-250x250.jpg"
                                                                                            alt="portrait-happy-smiling-millennial-woman-hugging-playing-group-akita-inu-puppies-sofa_1429-24033">
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </aside>
                                                            </div>

                                                            <div class="col-lg-6 profile-col-main">
                                                                @yield('profile-content')
                                                            </div>

                                                            <div class="col-lg-3 profile-col-aside right">
                                                                <aside id="member_profile_sidebar"
                                                                    class="widget-area profile-widget-area member-profile-sidebar">
                                                                    <div id="kmk_widget_latest_activity-1"
                                                                        class="widget kmk-activity-widget buddypress">
                                                                        <h5 class="widget-title">Recent activity</h5>
                                                                        <ul class="widget-activity-list">
                                                                            <li class="activity activity_comment activity-item"
                                                                                id="activity-52">
                                                                                <p><a href="./">Sandlas</a>
                                                                                    posted a new activity comment</p>
                                                                                <span class="activity mute">22 hours,
                                                                                    49
                                                                                    minutes ago</span>
                                                                            </li>
                                                                            <li class="activity activity_comment activity-item"
                                                                                id="activity-51">
                                                                                <p><a href="./">Sandlas</a>
                                                                                    posted a new activity comment</p>
                                                                                <span class="activity mute">1 day, 4
                                                                                    hours ago</span>
                                                                            </li>
                                                                            <li class="members new_avatar activity-item mini"
                                                                                id="activity-46">
                                                                                <p><a href="./">Sandlas</a>
                                                                                    changed their profile picture</p>
                                                                                <span class="activity mute">2 weeks, 1
                                                                                    day ago</span>
                                                                            </li>
                                                                        </ul>

                                                                    </div>
                                                                </aside>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="buddy-chat-app" class="dash d-none d-md-block">
        <div id="buddy-chat-buddies" class="collapsed">
            <div class="buddy-chat-buddies__container">
                <div class="header-container">
                    <div class="header-title"><span class="dashicons dashicons-format-chat"></span>
                        <div class="window-title">
                            <h5>Messenger</h5>
                        </div>
                    </div>
                    <div class="dropd-group dropd-dr"><a class="dropd-control mute"><span
                                class="dashicons dashicons-admin-generic"></span></a>
                        <div class="dropd-menu"><a class="dropd-item">Mute</a></div>
                    </div>
                </div>
                <div class="vb vb-invisible" style="position: relative; overflow: hidden;">
                    <div class="buddy-chat-buddies__content vb-content"
                        style="display: block; overflow: hidden scroll; height: 100%; width: calc(100% + 20px);">
                        <ul class="buddy-chat-nav-tabs">
                            <li class="item"><a class="item-link active">Friends</a></li>
                            <li class="item"><a class="item-link">Groups</a></li>
                        </ul>
                        <div id="buddy-list" class="bpc-tab-content">
                            <div>
                                <div class="vue-recycle-scroller bpc-buddy-list friends ready direction-vertical">
                                    <div class="vue-recycle-scroller__item-wrapper">
                                        <div class="vue-recycle-scroller__item-view">
                                            <!-- User contact item -->
                                            <div class="bpc-item mb-3" data-user="Natalie Berry">
                                                <div class="avatar-container"><img
                                                        src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/avatars/3/1760986305-bpthumb.jpg"
                                                        alt="Natalie Berry" class="avatar"> <span
                                                        class="status online"></span>
                                                </div>
                                                <div class="bpc-item-body">
                                                    <div class="flex-r">
                                                        <div class="buddy">
                                                            <div class="chat-buddy anchor ellipsis">Natalie Berry</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vb-dragger" style="position: absolute; height: 0px; top: 0px;">
                        <div class="vb-dragger-styler"></div>
                    </div>
                </div>
                <div id="buddy-chat-buddies__collapser" class="buddy-chat-buddies__collapser">
                    <div class="collapse-icon"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
                    <div class="action-text">
                        <h5>Collapse</h5>
                    </div>
                </div>
            </div>
        </div>

        <div id="buddy-chat-windows">
            <ul class="bpc-chat-windows-list">
                <li class="chat-window focused" id="chat-window-Natalie-Berry" style="display: none;">
                    <div class="chat-window__container">
                        <div class="chat-window__title">
                            <div class="avatar-container"><img
                                    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/avatars/3/1760986305-bpthumb.jpg"
                                    alt="Natalie Berry" class="avatar"> <span class="status"></span></div>
                            <div class="flex-r">
                                <div>
                                    <div class="chat-buddy anchor ellipsis">
                                        Natalie Berry
                                    </div>
                                    <div class="mute">
                                        Offline
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="chat_window__close-btn"><span
                                    class="dashicons dashicons-no-alt"></span></a>
                        </div>
                        <div class="chat-window__message-list vb vb-invisible">
                            <div class="vb-content">
                                <ul class="bpc-chat-list overflow-auto">
                                    <li class="message--self">
                                        <time>Oct 21, 2025, 2:30 AM</time>
                                        <div class="message-block">
                                            <div class="messages">
                                                <div class="message">😍</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="message--self">
                                        <time>Nov 1, 2025, 5:45 AM</time>
                                        <div class="message-block">
                                            <div class="messages">
                                                <div class="message">aaaa</div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div>
                            <div id="3" type="one2one">
                                <div class="chat-window__inputarea">
                                    <div class="chat-window__input">
                                        <div class="chat-window__input--placeholder">
                                            Write your message
                                        </div>
                                        <div contenteditable="true" class="chat-window__input--field"></div>
                                    </div>
                                    <div class="chat-window__input--emoji">
                                        <button id="emojiBtn" type="button">😊</button>
                                    </div>
                                    <!-- <a href="#" class="chat-window__btn--enter"><span
                                            class="dashicons dashicons-yes"></span></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="chat-float chat-floatbody  d-md-none" id="toggle-chat">
        <a class="dropd-control">
            <span class="dashicons dashicons-format-chat text-white"></span>
        </a>
    </div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/mscrollbar.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/hiraku.min.js"></script>
    <script src="/assets/js/flexmenu.min.js"></script>
    <script src="/assets/js/masonry.min.js"></script>
    <script src="/assets/js/jquery.fitvids.min.js"></script>
    <script src="/assets/js/emoji-button-3.0.3.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script src="/assets/js/kmk.min.js"></script>

</body>

<script>
    const button = document.getElementById('bp-browse-button');
    const fileInput = document.getElementById('html5_1j9dk63tav751hempgv6698el5');
    const preview = document.getElementById('avatar-preview').querySelector('img');

    // When the visible button is clicked, open the hidden file input
    button.addEventListener('click', () => {
        fileInput.click();
    });

    // When a file is selected, show the preview
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    const button = document.getElementById('bp-browse-button');
    const fileInput = document.getElementById('html5_1j9dk63tav751hempgv6698el5');
    const preview = document.getElementById('avatar-preview').querySelector('img');

    // When the visible button is clicked, open the hidden file input
    button.addEventListener('click', () => {
        fileInput.click();
    });

    // When a file is selected, show the preview
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    $(document).ready(function() {


        $('#openModalBtn').on('click', function() {
            $.fancybox.open();
        });

        $('#postCloser').on('click', function() {
            $.fancybox.close();
        });




        // Initialize Fancybox
        $('[data-fancybox]').fancybox({
            loop: true,
            buttons: ["zoom", "share", "close"],
            smallBtn: true,
            closeBtn: true,
        });

        // Emoji Picker
        const emojiBtn2 = document.getElementById('emojiBtn2');
        const inputField2 = document.getElementById('comment_content');

        if (emojiBtn2 && inputField2) {
            const picker2 = new EmojiButton({
                position: 'top-start',
                theme: 'light',
            });

            picker2.on('emoji', emoji => {
                inputField2.value += emoji;
                inputField2.focus();
            });

            emojiBtn2.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                picker2.togglePicker(emojiBtn2);
            });
        }

        // Handle Like, Comment Submission and Deletion
        $('.rtmedia-like, .rt_media_comment_submit').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('rtmedia-like')) {
                $(this).toggleClass('liked');
                if ($(this).hasClass('liked')) {
                    $(this).find('span').text('Unlike');
                } else {
                    $(this).find('span').text('Like');
                }
            }

            if ($(this).attr('id') === 'rt_media_comment_submit') {
                var commentText = $('#comment_content').val();
                if (commentText.trim() !== "") {
                    var newComment = `
                            <li class="rtmedia-comment">
                                <div class="rtmedia-comment-user-pic">
                                    <a href="#" title="Current User">
                                        <img loading="lazy" src="https://placehold.co/90x90?text=You" class="avatar" width="90" height="90" alt="Profile Photo">
                                    </a>
                                </div>
                                <div class="rtm-comment-wrap">
                                    <div class="rtmedia-comment-details">
                                        <span class="rtmedia-comment-author"><a href="#" title="Current User">You</a></span>
                                        <span class="rtmedia-comment-date">Just now</span>
                                        <div class="rtmedia-comment-content">
                                            <p>${commentText}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                    $('#rtmedia_comment_ul').append(newComment);
                    $('#comment_content').val(''); // Clear input field
                }
            }
        });

        // Handle delete comment
        $(document).on('click', '.rtmedia-delete-comment', function(e) {
            e.preventDefault();
            $(this).closest('.rtmedia-comment').remove();
        });
    });
</script>





<!-- chat -->
<script>
    const chatBuddies = document.getElementById('buddy-chat-buddies');
    const collapserButton = document.getElementById('buddy-chat-buddies__collapser');
    const chatWindowCloseButtons = document.querySelectorAll('.chat_window__close-btn');
    const chatBuddiesItems = document.querySelectorAll('.bpc-item');
    const emojiBtn = document.getElementById('emojiBtn');
    const inputField = document.querySelector('.chat-window__input--field');
    const placeholder = document.querySelector('.chat-window__input--placeholder');
    const sendButton = document.querySelector('.chat-window__btn--enter');
    const chatList = document.querySelector('.bpc-chat-list');

    // Toggle sidebar
    collapserButton.addEventListener('click', () => {
        chatBuddies.classList.toggle('collapsed');
    });

    // Close chat
    chatWindowCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const chatWindow = button.closest('.chat-window');
            chatWindow.style.display = 'none';
        });
    });

    chatBuddiesItems.forEach(item => {
        item.addEventListener('click', () => {
            const userName = item.querySelector('.chat-buddy').textContent.trim();
            const chatWindow = document.getElementById(`chat-window-${userName.replace(" ", "-")}`);
            if (chatWindow) chatWindow.style.display = 'block';
        });
    });

    // Input placeholder logic
    if (inputField) {
        inputField.addEventListener('input', function() {
            placeholder.style.display = this.textContent.trim() ? 'none' : 'block';
        });
    }

    // Send message
    function sendMessage() {
        const message = inputField.textContent.trim();
        if (!message) return;

        const newMsg = document.createElement('li');
        newMsg.classList.add('message--self');
        newMsg.innerHTML = `
            <time>${new Date().toLocaleString()}</time>
            <div class="message-block">
                <div class="messages">
                    <div class="message">${message}</div>
                </div>
            </div>
        `;

        chatList.appendChild(newMsg);
        inputField.textContent = '';
        placeholder.style.display = 'block';

        // ✅ Scroll to latest message
        chatList.scrollTop = chatList.scrollHeight;
    }

    // Send on button click
    if (sendButton) {
        sendButton.addEventListener('click', e => {
            e.preventDefault();
            sendMessage();
        });
    }

    // Send on Enter key
    if (inputField) {
        inputField.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    // === Emoji Picker ===
    const picker = new EmojiButton({
        position: 'top-start',
        theme: 'light'
    });

    picker.on('emoji', emoji => {
        inputField.textContent += emoji;
        inputField.focus();
        placeholder.style.display = 'none';
    });

    emojiBtn.addEventListener('click', () => picker.togglePicker(emojiBtn));

    //mobile toggle chat
    $('#toggle-chat').on('click', function() {

        // Check screen width for mobile (under 768px)
        if ($(window).width() < 768) {
            $('#buddy-chat-app').toggleClass('d-none');
        } else {
            console.log('Not mobile view — no toggle.');
        }
    });
</script>
<!-- chat -->




<!-- Inline JS -->
<script>
    const lazyloadRunObserver = () => {
        const lazyloadBackgrounds = document.querySelectorAll('.e-con.e-parent:not(.e-lazyloaded)');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('e-lazyloaded');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '200px 0px 200px 0px'
        });
        lazyloadBackgrounds.forEach(el => observer.observe(el));
    };
    ['DOMContentLoaded', 'kmk/lazyload/observe']
    .forEach(e => document.addEventListener(e, lazyloadRunObserver));
</script>

</html>
