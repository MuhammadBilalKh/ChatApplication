<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

    <title>@yield('title')</title>

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
        /* Chatbar-like styles */
        .chat-window__inputarea {
            display: flex;
            align-items: flex-end;
            background: #fff;
            border-radius: 23px;
            border: 1px solid #ebebeb;
            padding: 4px 10px;
            min-height: 46px;
            box-sizing: border-box;
            width: 100%;
        }

        .chat-window__input {
            flex: 1 1 0%;
            display: flex;
            flex-direction: column;
            position: relative;
            background: #fff;
        }

        .chat-window__input--placeholder {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2b2b2;
            pointer-events: none;
            font-size: 15px;
            z-index: 1;
            user-select: none;
        }

        .chat-window__input--field {
            min-height: 26px;
            max-height: 120px;
            padding: 8px 14px 8px 14px;
            border: 0;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 16px;
            border-radius: 7px;
            resize: none;
            position: relative;
            z-index: 2;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .chat-window__input--field:focus {
            background: #f8f8fa;
        }

        .chat-window__input--field:not(:empty)+.chat-window__input--placeholder {
            display: none;
        }

        .chat-window__input--field:empty:before {
            content: none;
        }

        .chat-window__input--emoji {
            display: flex;
            align-items: center;
            margin-left: 7px;
        }

        .chat-window__input--emoji button {
            background: transparent;
            border: none;
            font-size: 22px;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 33px;
            width: 33px;
            transition: background 0.18s, transform 0.18s;
        }

        .chat-window__input--emoji button:hover {
            background: #f3f3f3;
            transform: scale(1.11);
            border-radius: 50%;
        }

        .chat-window__btn--enter {
            margin-left: 3px;
            color: #2877fa;
            font-size: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 32px;
            width: 32px;
            border-radius: 50%;
            text-decoration: none;
            transition: background 0.16s, color 0.16s;
        }

        .chat-window__btn--enter:hover {
            color: #174ee7;
            background: #f2f6fa;
        }

        .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar {
            width: 7px;
            background: #f8f8fa;
        }

        .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar-thumb {
            background-color: #ebebeb;
            border-radius: 6px;
        }

        .chat-window__message-list.vb.vb-invisible {
            scrollbar-width: thin;
            scrollbar-color: #ebebeb #f8f8fa;
        }

        .chat-float {
            position: fixed;
            bottom: 24px;
            left: 18px;
            z-index: 99999;
            display: none;
        }

        .chat-floatbody {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: linear-gradient(92deg, #fec029 0%, #fda52b 100%);
            color: #fff;
            border-radius: 50%;
            box-shadow: 0 4px 15px 0 #dcb94c77;
            font-size: 26px;
            transition: background 0.18s, transform 0.18s;
        }

        .chat-floatbody:hover {
            background: linear-gradient(88deg, #ffd24d 0%, #fec029 85%);
            transform: scale(1.07);
        }

        @media (max-width: 768px) {
            .chat-float {
                display: block;
            }
        }

        #header-cover-image {
            height: 300px;
            background-image: url('{{ asset('/storage/' . Auth::user()->cover_image) }}');
        }
    </style>
    @stack('css')
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
                                                                                    alt="Profile picture of {{ Auth::user()->username }}">
                                                                            </a>
                                                                        </div>
                                                                        <h3 class="profile-name">
                                                                            {{ Auth::user()->username }}</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div id="item-header-content">
                                                                        <h2 class="user-nicename text-white">@
                                                                            {{ Auth::user()->username }}</h2>
                                                                        <div class="item-meta">
                                                                            <span class="activity d-none">Active 44
                                                                                seconds ago</span>
                                                                        </div>
                                                                    </div>
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
                                                                            <a href="{{ route('users.profile') }}"
                                                                                id="user-xprofile" title="Profile">
                                                                                <span
                                                                                    class="nav-link-text ">Profile</span>
                                                                            </a>
                                                                        </li>
                                                                        <li id="friends-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="{{ route('peoples.list_requests') }}"
                                                                                id="user-friends" title="Friends">
                                                                                <span
                                                                                    class="nav-link-text">Friends</span>
                                                                                <span
                                                                                    class="count color-primary">{{ Auth::user()->getFriends()->count() }}</span>
                                                                            </a>
                                                                        </li>
                                                                        <li id="groups-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="{{ route('groups.index') }}"
                                                                                id="user-groups" title="Groups">
                                                                                <span
                                                                                    class="nav-link-text">Groups</span>
                                                                            </a>
                                                                        </li>
                                                                        <li id="my-adverts-personal-li"
                                                                            class="bp-personal-tab">
                                                                            <a href="{{ route('users.advertisments') }}"
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
                                                                                aria-expanded="false">
                                                                                <span class="nav-link-text">More</span>
                                                                                <span class="count">6</span>
                                                                            </a>
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
                                                                                    <a href="{{ route('users.notifications', ['type' => "unread"]) }}"
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
                                                                                    <a href="{{ route('users.general_settings') }}"
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
                                                                            <li>
                                                                                <span
                                                                                    class="count color-primary">{{ Auth::user()->getFriends()->count() }}</span>
                                                                                <p>Friends</p>
                                                                            </li>
                                                                            <li>
                                                                                <span
                                                                                    class="count color-primary">0</span>
                                                                                <p>Groups</p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="widget">
                                                                        <h5 class="widget-title">My photos</h5>
                                                                        <ul class="member-photo-list"
                                                                            style="padding:0;margin:0;">
                                                                            @php
                                                                                $latestImages = Auth::user()
                                                                                    ->getPosts()
                                                                                    ->with([
                                                                                        'postMedia' => function (
                                                                                            $query,
                                                                                        ) {
                                                                                            $query->where(
                                                                                                'media_type',
                                                                                                MEDIA_TYPE_IMAGE,
                                                                                            );
                                                                                        },
                                                                                    ])
                                                                                    ->orderByDesc('created_at')
                                                                                    ->limit(10)
                                                                                    ->get()
                                                                                    ->flatMap(function ($post) {
                                                                                        return $post->postMedia;
                                                                                    })
                                                                                    ->sortByDesc('created_at')
                                                                                    ->take(5);
                                                                                $imagesChunked = $latestImages->chunk(
                                                                                    3,
                                                                                );
                                                                            @endphp
                                                                            <div
                                                                                style="display: flex; flex-direction: column; gap: 8px;">
                                                                                @foreach ($imagesChunked as $row)
                                                                                    <div
                                                                                        style="display: flex; gap: 8px;">
                                                                                        @foreach ($row as $media)
                                                                                            @php $count = 0; @endphp
                                                                                            <div
                                                                                                style="width: 60px; height: 60px; overflow: hidden; border-radius: 6px; border: 1px solid #ddd;">
                                                                                                <a href="{{ asset($media->file_path) }}"
                                                                                                    target="_blank"
                                                                                                    style="display: block; width: 100%; height: 100%;">
                                                                                                    <img src="{{ asset($media->file_path) }}"
                                                                                                        alt="User photo"
                                                                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                                                                </a>
                                                                                            </div>
                                                                                            @php $count++; @endphp
                                                                                            @if ($loop->parent->last && $loop->last && $count == 5)
                                                                                                <div
                                                                                                    style="margin-left: 8px; display: flex; align-items: center;">
                                                                                                    <a href="{{ route('posts.show_photos') }}"
                                                                                                        title="View All"
                                                                                                        style="font-size: 13px; padding: 0; background: none; border: none; color: #007bff; text-decoration: underline; cursor: pointer;">
                                                                                                        View All
                                                                                                    </a>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                @endforeach
                                                                                <div
                                                                                    style="margin-top: 6px; display: flex; align-items: center;">
                                                                                    <a href="{{ route('posts.show_photos') }}"
                                                                                        title="View All"
                                                                                        class="float-right text-warning"
                                                                                        target="_blank">
                                                                                        View All ...
                                                                                    </a>
                                                                                </div>
                                                                            </div>
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
                                                                                <p><a href="./">Sandlas</a> posted
                                                                                    a new activity comment</p>
                                                                                <span class="activity mute">22 hours,
                                                                                    49 minutes ago</span>
                                                                            </li>
                                                                            <li class="activity activity_comment activity-item"
                                                                                id="activity-51">
                                                                                <p><a href="./">Sandlas</a> posted
                                                                                    a new activity comment</p>
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
                    <div class="header-title">
                        <span class="dashicons dashicons-format-chat"></span>
                        <div class="window-title">
                            <h5>Messenger</h5>
                        </div>
                    </div>
                    <div class="dropd-group dropd-dr">
                        <a class="dropd-control mute"><span class="dashicons dashicons-admin-generic"></span></a>
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
                                            @foreach ($all_friends as $value)
                                                @php
                                                    $friend =
                                                        $value->sender_id == Auth::user()->user_id
                                                            ? $value->getReceiver
                                                            : $value->getSender;
                                                @endphp
                                                <div class="bpc-item mb-3 chat-buddy-item"
                                                    data-user="{{ $friend->username }}"
                                                    data-userid="{{ $friend->user_id }}">
                                                    <div class="avatar-container">
                                                        <img src="{{ asset($friend->profile_picture) }}"
                                                            alt="{{ $friend->username }}" class="avatar">
                                                        <span class="status online"></span>
                                                    </div>
                                                    <div class="bpc-item-body">
                                                        <div class="flex-r">
                                                            <div class="buddy">
                                                                <div class="chat-buddy anchor ellipsis">
                                                                    {{ $friend->username }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                @foreach ($all_friends as $value)
                    @php
                        $friend = $value->sender_id == Auth::user()->user_id ? $value->getReceiver : $value->getSender;
                        $windowId = 'chat-window-' . preg_replace('/[^A-Za-z0-9\-]/', '-', $friend->username);
                    @endphp
                    <li class="chat-window" id="{{ $windowId }}" style="display: none;"
                        data-userid="{{ $friend->user_id }}">
                        <div class="chat-window__container">
                            <div class="chat-window__title">
                                <div class="avatar-container">
                                    <img src="{{ asset($friend->profile_picture) }}" alt="{{ $friend->username }}"
                                        class="avatar">
                                    <span class="status {{ $friend->is_online ? 'online' : 'offline' }}"></span>
                                </div>
                                <div class="flex-r">
                                    <div>
                                        <div class="chat-buddy anchor ellipsis">
                                            {{ $friend->username }}
                                        </div>
                                        <div class="mute">
                                            {{ $friend->is_online ? 'Online' : 'Offline' }}
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="chat_window__close-btn">
                                    <span class="dashicons dashicons-no-alt"></span>
                                </a>
                            </div>
                            <div class="chat-window__message-list vb vb-invisible">
                                <div class="vb-content" style="overflow-y:scroll; max-height: 350px;">
                                    <div class="chat-loader" style="display: none;">
                                        <div></div>
                                    </div>
                                    <ul class="bpc-chat-list overflow-auto" id="messages-{{ $friend->user_id }}">
                                        <!-- JS will load messages using .message--self (right, sent) or .message--other (left, received) -->
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="chat-window__inputarea" data-friend="{{ $friend->user_id }}">
                                    <div class="chat-window__input">
                                        <div class="chat-window__input--placeholder">Write your message</div>
                                        <div contenteditable="true" class="chat-window__input--field message-input"
                                            data-friend="{{ $friend->user_id }}"></div>
                                    </div>
                                    <div class="chat-window__input--emoji">
                                        <button type="button" class="emojiBtn">😊</button>
                                    </div>
                                    <button class="chat-window__send-btn" data-friend="{{ $friend->user_id }}"
                                        data-receiver="{{ $friend->user_id }}" title="Send" type="button">
                                        <span class="dashicons dashicons-arrow-right-alt"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="chat-float chat-floatbody  d-md-none" id="toggle-chat">
        <a class="dropd-control">
            <span class="dashicons dashicons-format-chat text-white"></span>
        </a>
    </div>
</body>

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
<script src="/assets/js/kmk.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.querySelector('.flexMenu-viewMore > a');
        const menu = document.querySelector('.flexMenu-popup');

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ?
                'block' :
                'none';
        });

        // Optional: close when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // When any comment button is clicked
        document.querySelectorAll('.acomment-reply').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Find the parent <li> (the post)
                const activityItem = this.closest('.activity-item');
                if (!activityItem) return;

                // Find its form
                const commentForm = activityItem.querySelector('.ac-form');
                if (!commentForm) return;

                // Toggle visibility
                const isVisible = commentForm.style.display === 'block';
                document.querySelectorAll('.ac-form').forEach(f => f.style.display =
                'none'); // Hide all forms
                commentForm.style.display = isVisible ? 'none' :
                'block'; // Toggle only this one
            });
        });

        // Cancel button hides its form
        document.querySelectorAll('.ac-reply-cancel').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.ac-form');
                if (form) form.style.display = 'none';
            });
        });
    });
</script>

<script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>

<script>
    const socket = io("http://localhost:3002");
    let messageOffsets = {};
    let messageLoading = {};
    const loggedInUserId = '{{ Auth::user()->user_id }}';

    function showLoader($chatWindow) {
        $chatWindow.find('.chat-loader').show();
    }

    function hideLoader($chatWindow) {
        $chatWindow.find('.chat-loader').hide();
    }

    function loadMessages(userId, {
        append = false,
        beforeMessageId = null,
        scrollTo = 'bottom'
    } = {}) {
        const $chatWindow = $('#chat-window-' + userId.replace(/[^A-Za-z0-9\-]/g, '-'));
        const $messageList = $('#messages-' + userId);
        if (!messageOffsets[userId]) messageOffsets[userId] = 0;
        if (!messageLoading[userId]) messageLoading[userId] = false;
        if (messageLoading[userId]) return;

        messageLoading[userId] = true;
        showLoader($chatWindow);

        $.ajax({
            url: '{{ route('chat.load-messages') }}',
            method: 'GET',
            data: {
                user_id: userId,
                offset: messageOffsets[userId],
                limit: 10,
                before_message_id: beforeMessageId || ''
            },
            success: function(response) {
                hideLoader($chatWindow);
                if (Array.isArray(response.messages)) {
                    let html = '';
                    response.messages.forEach(function(msg) {
                        let senderId = typeof msg.sender_id !== 'undefined' ? String(msg
                            .sender_id) : '';
                        let isOwn = (senderId === loggedInUserId);
                        html += renderChatMessageItem(msg, isOwn);
                    });
                    var $currentScrollTarget = $messageList.closest('.vb-content');
                    var previousScrollHeight = $currentScrollTarget[0].scrollHeight;
                    if (append) {
                        $messageList.append(html);
                    } else {
                        $messageList.prepend(html);
                    }
                    messageOffsets[userId] += response.messages.length;
                    // Maintain scroll position if loading older messages
                    if (beforeMessageId !== null && !append) {
                        var newScrollHeight = $currentScrollTarget[0].scrollHeight;
                        $currentScrollTarget[0].scrollTop = newScrollHeight - previousScrollHeight;
                    } else if (scrollTo === 'bottom') {
                        $currentScrollTarget[0].scrollTop = $currentScrollTarget[0].scrollHeight;
                    } else if (scrollTo === 'top') {
                        $currentScrollTarget[0].scrollTop = 0;
                    }
                }
                if (!response.messages || response.messages.length < 10) {
                    $messageList.data('end', true);
                }
                messageLoading[userId] = false;
            },
            error: function() {
                hideLoader($chatWindow);
                messageLoading[userId] = false;
            }
        });
    }

    function renderChatMessageItem(msg, isOwn = true) {
        let messageText = '';
        if (typeof msg.message !== 'undefined' && msg.message !== null && msg.message !== '') {
            messageText = msg.message;
        }
        let timestamp = (typeof msg.created_at !== 'undefined' && msg.created_at) ? msg.created_at : '';
        let dateString = timestamp ? `<time>${escapeHtml(timestamp)}</time>` : '';
        let cls = isOwn ? 'message--self' : 'message--other';
        return `<li class="${cls}"${typeof msg.id !== 'undefined' ? ` data-messageid="${msg.id}"`:''}>
        ${dateString}
        <div class="message-block">
            <div class="messages">
                <div class="message">${escapeHtml(messageText)}</div>
            </div>
        </div>
    </li>`;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str;
    }

    $(document).on('click', '.chat-buddy-item', function() {
        let userId = $(this).attr('data-userid');
        $('.chat-window').hide();
        let $cw = $('.chat-window[data-userid="' + userId + '"]');
        $cw.show();
        $('#messages-' + userId).html('').removeData('end');
        messageOffsets[userId] = 0;
        showLoader($cw);
        loadMessages(userId, {
            scrollTo: 'bottom'
        });
        setTimeout(function() {
            $cw.find('.message-input').focus();
            let $c = $cw.find('.vb-content');
            if ($c.length) $c[0].scrollTop = $c[0].scrollHeight;
        }, 200);
    });

    $(document).on('click', '.chat_window__close-btn', function(e) {
        e.preventDefault();
        $(this).closest('.chat-window').hide();
    });

    $(document).on('scroll', '.chat-window__message-list .vb-content', function() {
        let $el = $(this);
        let $ul = $el.find('.bpc-chat-list');
        let userId = $ul.attr('id')?.replace('messages-', '');
        if (!userId) return;
        if (messageLoading[userId]) return;
        if ($ul.data('end')) return;
        if ($el[0].scrollTop <= 10) {
            let firstMessageId = $ul.children().first().data('messageid') || null;
            loadMessages(userId, {
                append: false,
                beforeMessageId: firstMessageId,
                scrollTo: 'top'
            });
        }
    });

    $(document).on('click', '.chat-window__send-btn', function() {
        let receiverId = $(this).data('receiver');
        let userId = receiverId;
        let $input = $('.message-input[data-friend="' + receiverId + '"]');
        let $msgList = $('#messages-' + receiverId);
        let message = $input.text().trim();

        if (!message || message.length === 0) return;

        let $btn = $(this);
        $btn.prop('disabled', true);

        $.ajax({
            url: '{{ route('chat.send-message') }}',
            method: 'POST',
            data: {
                receiver: receiverId,
                message: message,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // The server should now trigger the MessageSent event upon successful save
                if (
                    response.status === 'success' &&
                    response.message &&
                    typeof response.message === 'object' &&
                    (
                        typeof response.message.message !== 'undefined' &&
                        response.message.message !== null &&
                        response.message.message !== ''
                    )
                ) {
                    let msgObj = response.message;
                    if (typeof msgObj.sender_id === 'undefined') {
                        msgObj.sender_id = loggedInUserId;
                    }
                    if (typeof msgObj.created_at === 'undefined') {
                        msgObj.created_at = (new Date()).toLocaleString();
                    }
                    $msgList.append(renderChatMessageItem(msgObj, true));
                    // Scroll to bottom after sending
                    let chatContent = $msgList.closest('.vb-content')[0];
                    if (chatContent) chatContent.scrollTop = chatContent.scrollHeight;
                    $input.text('');
                } else if (
                    response.status === 'success' &&
                    response.message &&
                    typeof response.message === 'object' &&
                    (
                        typeof response.message.message === 'undefined' ||
                        response.message.message === null ||
                        response.message.message === ''
                    )
                ) {
                    alert('Message was sent, but it is empty and will not be shown.');
                    $input.text('');
                } else if (response.status === 'success' && typeof response.message === 'string' &&
                    response.message !== '') {
                    let msgObj = {
                        message: response.message,
                        sender_id: loggedInUserId,
                        created_at: (new Date()).toLocaleString()
                    };
                    $msgList.append(renderChatMessageItem(msgObj, true));
                    let chatContent = $msgList.closest('.vb-content')[0];
                    if (chatContent) chatContent.scrollTop = chatContent.scrollHeight;
                    $input.text('');
                } else if (response.errors) {
                    let firstError = Object.values(response.errors)[0];
                    if (Array.isArray(firstError)) firstError = firstError[0];
                    alert(firstError || 'Message could not be sent.');
                } else {
                    alert('Message could not be sent.');
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let firstError = Object.values(xhr.responseJSON.errors)[0];
                    if (Array.isArray(firstError)) firstError = firstError[0];
                    alert(firstError || 'An error occurred.');
                } else {
                    alert('An error occurred. Please try again.');
                }
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    });

    // Send on Enter (no shift) in input
    $(document).on('keydown', '.message-input', function(e) {
        let userId = $(this).data('friend');
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            $('.chat-window__send-btn[data-friend="' + userId + '"]').click();
        }
    });

    // Listen for the real-time MessageSent event broadcast from the server after send-message POST
    if (typeof Echo !== 'undefined') {
        Echo.channel('chat')
            .listen('MessageSent', (event) => {
                let messageObj = event.message || {};
                let chatUserId = '';

                if (String(messageObj.sender_id) === String(loggedInUserId)) {
                    // Sent by this user; show in receiver's chat window as self
                    chatUserId = messageObj.receiver_id;
                } else {
                    // Received from other user; show in their chat window as an "other" message
                    chatUserId = messageObj.sender_id;
                }

                // Try to find the correct chat message list
                let msgListSelector = '#messages-' + chatUserId;
                let $msgList = $(msgListSelector);
                if ($msgList.length) {
                    // Prevent duplicate message display by ID
                    if (
                        !$msgList.children('[data-messageid="' + (messageObj.id || '') + '"]').length &&
                        typeof renderChatMessageItem === 'function'
                    ) {
                        let isOwn = (String(messageObj.sender_id) === String(loggedInUserId));
                        $msgList.append(renderChatMessageItem(messageObj, isOwn));
                        let chatContent = $msgList.closest('.vb-content')[0];
                        if (chatContent) chatContent.scrollTop = chatContent.scrollHeight;
                    }
                }
            });
    }
</script>

@stack('script')

</html>
