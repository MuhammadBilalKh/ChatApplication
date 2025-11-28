<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />

      <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" media="all" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" media="all" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" media="all" />

    <link rel="stylesheet" href="https://mythemestore.com/beehive-preview/wp-content/themes/beehive/assets/css/bootstrap.min.css?ver=1.6.1" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/beehive.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/woocommerce.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce-layout.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/post-95.css" media="all" />
    <link rel="stylesheet" href="/assets/css/kmk.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/testing.min.css" />

    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" media="all" />
    <link rel="stylesheet" href="/assets/css/job-manager.css" media="all" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

    <style>
        #header-cover-image {
            height: 300px;
            background-image: url('{{ asset('/storage/' . $groupData->cover_image) }}');
        }
    </style>
</head>

<body
    class="registration register  kmkpress bp-nouveau  post-template-default page page-id-0 page-parent wp-theme-kmk theme-kmk woocommerce-no-js kmk kmk-guest-user kmk-default kmk-kit-30 title-bar-active kmk-social-layout panel-collapsed no-sidebar no-js">

    <div id="kmk-social-panel" class="kmk-social-panel">
        <div class="inner-panel ass-scrollbar">
            <div class="panel-block dark">
                <a href="./" class="panel-logo item">
                    <img src="{{ asset('assets/images/logo.png') }}" alt=" Business Name" />
                </a>
                <div class="my-card item">
                    <h4 class="form-title">Login Now</h4>
                    <form action="{{ route('users.authenticate') }}" method="{{ FORM_METHOD_POST }}"
                        id="panel-login-form" class="kmk-login-form panel-login" name="panel-login">
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
                                <input type="password" id="password" class="password-control" required
                                    name="pwd" value="" placeholder="Password">
                            </div>
                        </div>
                        <div class="kmk-login-result"></div>
                        <div class="submit">
                            <button type="submit" id="login_submit" class="submit-login" name="wp-submit">Log
                                In</button>
                        </div>
                        <input type="hidden" id="panel-login-security" name="panel-login-security"
                            value="171d7e1524" /><input type="hidden" name="_wp_http_referer"
                            value="/MIGVELv1/register/" />
                        <div class="register-link">
                            <a href="./register/" class="register color-primary">Create an account</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel-block light">
                <div class="panel-menu item d-n000one">
                    <ul id="menu-dashboard-menu " class="navbar-panel">
                        <li id="menu-item-475"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-475"><a
                                href="./activity-2/"><i class="uil-notebooks"></i><span
                                    class="nav-link-text">Activity</span></a></li>
                        <li id="menu-item-481"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-481"><a
                                href="./photos/"><i class="uil-image-v"></i><span
                                    class="nav-link-text">Photos</span></a></li>
                        <li id="menu-item-483"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-483"><a
                                href="./videos/"><i class="uil-play"></i><span class="nav-link-text">Watch</span></a>
                        </li>
                        <li id="menu-item-484"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-484"><a
                                href="./members-2/"><i class="uil-user"></i><span
                                    class="nav-link-text">People</span></a></li>
                        <li id="menu-item-614"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-614"><a
                                href="./games/"><i class="uil-users-alt"></i><span
                                    class="nav-link-text">Games</span></a></li>
                        <li id="menu-item-476"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-476"><a
                                href="./adverts/"><i class="uil-tv-retro"></i><span
                                    class="nav-link-text">Adverts</span></a></li>
                        <li id="menu-item-482"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-482"><a
                                href="./shop/"><i class="uil-shopping-trolley"></i><span
                                    class="nav-link-text">Shop</span></a></li>
                        <li id="menu-item-480"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-480"><a
                                href="./jobs/"><i class="uil-briefcase-alt"></i><span
                                    class="nav-link-text">Jobs</span></a></li>
                        <li id="menu-item-478"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-478"><a
                                href="./forums/"><i class="uil-comments"></i><span
                                    class="nav-link-text">Forums</span></a></li>
                        <li id="menu-item-477"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-477"><a
                                href="./blog/"><i class="uil-newspaper"></i><span
                                    class="nav-link-text">Blog</span></a></li>
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

    <div id="kmk-page" class="site">

        <header id="sochead" class="site-header social-header user-nav-active">
            <nav class="navbar kmk-navbar social fixed-top">
                <div class="container">
                    <div id="kmk-ajax-search" class="kmk-ajax-search">

                        <div id="ajax-search-result"></div>
                    </div>


                </div>
            </nav>
        </header><!-- #sochead -->
        <div id="content" class="site-content">



            <div id="primary" class="content-area">
                <div class="layout social-wide">
                    <div class="container">
                        <div class="row">


                            <div class="col-lg-12 col-main">
                                <main id="main" class="main-content">


                                    <div class="beehive-title-bar social">
                                        <div class="title-bar-wrapper">
                                            <div class="title-wrapper screen-reader-text">
                                                <h1 class="title h3">Blog</h1>
                                            </div>
                                        </div>
                                    </div>


                                    <article id="post-0"
                                        class="bp_group type-bp_group post-0 page type-page status-publish hentry beehive-post">
                                        <div class="entry-content clearfix">
                                            <div id="kmk"
                                                class="kmk-wrap beehive bp-dir-hori-nav alignwide">

                                                <div id="item-header" role="complementary" data-bp-item-id="1"
                                                    data-bp-item-component="groups"
                                                    class="groups-header single-headers">


                                                    <div id="cover-image-container">

                                                        <div id="container">
                                                            <span id="header-cover-image"></span>
                                                        </div>

                                                        <div id="item-header-cover-image">
                                                            <div class="row">

                                                                <div class="col-lg-3">
                                                                    <div id="item-header-avatar">
                                                                        <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/"
                                                                            title="TECH GROUP">

                                                                            <img loading="lazy" decoding="async"
                                                                                loading="lazy"
                                                                                src="{{ asset('/storage/' . $groupData->profile_image) }}"
                                                                                class="avatar group-1-avatar avatar-200 photo"
                                                                                width="200" height="200"
                                                                                alt="Group logo of TECH GROUP" />
                                                                        </a>
                                                                        <h3 class="profile-name">
                                                                            {{ $groupData->group_name }}</h3>
                                                                    </div><!-- #item-header-avatar -->
                                                                </div>

                                                                <div class="col-lg-9">
                                                                    <div id="item-header-content">

                                                                        <p class="highlight group-status">
                                                                            <strong>Public Group</strong>
                                                                        </p>

                                                                        <p class="activity">
                                                                            Active <span
                                                                                data-livestamp="2025-11-26T17:17:55+0000">1
                                                                                day, 4 hours ago</span> </p>





                                                                    </div><!-- #item-header-content -->
                                                                </div>

                                                            </div>

                                                            <div id="item-actions" class="group-item-actions">


                                                                <h2 class="bp-screen-reader-text">Group Leadership</h2>

                                                                <dl class="moderators-lists">
                                                                    <dt class="moderators-title">Group Administrators
                                                                    </dt>
                                                                    <dd class="user-list admins">
                                                                        <ul id="group-admins">
                                                                            <li>
                                                                                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/"
                                                                                    class="bp-tooltip"
                                                                                    data-bp-tooltip="wpdeveloper">
                                                                                    <img loading="lazy"
                                                                                        decoding="async"
                                                                                        loading="lazy"
                                                                                        src="{{ asset('/storage/'.$groupData->groupCreatedBy->profile_picture) }}"
                                                                                        class="avatar user-1-avatar avatar-50 photo"
                                                                                        width="50" height="50"
                                                                                        alt="Profile picture of wpdeveloper" />
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </dd>
                                                                </dl>

                                                            </div><!-- .item-actions -->

                                                        </div><!-- #item-header-cover-image -->

                                                    </div><!-- #cover-image-container -->

                                                </div><!-- #item-header -->

                                                <div class="bp-wrap">



                                                    <nav class="main-navs no-ajax bp-navs single-screen-navs horizontal groups-nav"
                                                        id="object-nav" role="navigation" aria-label="Group menu">

                                                        <div class="row">
                                                            <div class="col-lg-6 ml-auto mr-auto">
                                                                <div class="nav-container">


                                                                    <ul class="profile-nav">


                                                                        <li id="home-groups-li" class="bp-groups-tab">
                                                                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/home/"
                                                                                id="home" title="Home">
                                                                                <span class="nav-link-text">Home</span>

                                                                            </a>
                                                                        </li>


                                                                        <li id="nav-forum-groups-li"
                                                                            class="bp-groups-tab">
                                                                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/forum/"
                                                                                id="nav-forum" title="Forum">
                                                                                <span
                                                                                    class="nav-link-text">Forum</span>

                                                                            </a>
                                                                        </li>


                                                                        <li id="members-groups-li"
                                                                            class="bp-groups-tab">
                                                                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/members/"
                                                                                id="members" title="Members">
                                                                                <span
                                                                                    class="nav-link-text">Members</span>

                                                                                <span
                                                                                    class="count color-primary">1</span>
                                                                            </a>
                                                                        </li>


                                                                        <li id="invite-groups-li"
                                                                            class="bp-groups-tab">
                                                                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/send-invites/"
                                                                                id="invite" title="Invite">
                                                                                <span
                                                                                    class="nav-link-text">Invite</span>

                                                                            </a>
                                                                        </li>


                                                                        <li id="media-groups-li"
                                                                            class="bp-groups-tab">
                                                                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/media"
                                                                                id="media" title="Media">
                                                                                <span
                                                                                    class="nav-link-text">Media</span>

                                                                            </a>
                                                                        </li>


                                                                        <li id="admin-groups-li"
                                                                            class="bp-groups-tab current selected">
                                                                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/admin/"
                                                                                id="admin" title="Manage">
                                                                                <span
                                                                                    class="nav-link-text">Manage</span>

                                                                            </a>
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
                                                                        <div class="widget-block about">
                                                                            <h5 class="widget-title">About Group</h5>
                                                                            <div class="about-group">
                                                                                <p>{{ \Illuminate\Support\Str::limit($groupData->group_description, 50) }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="widget-block group-members">
                                                                            <h5 class="widget-title">Newest Members
                                                                            </h5>
                                                                            <div class="newest-group-members">
                                                                                <ul>
                                                                                    <li><a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/"
                                                                                            title="wpdeveloper"
                                                                                            target="_blank"><img
                                                                                                loading="lazy"
                                                                                                decoding="async"
                                                                                                loading="lazy"
                                                                                                src="{{ asset("/storage/".$groupData->groupCreatedBy->profile_picture) }}"
                                                                                                class="avatar user-1-avatar avatar-30 photo"
                                                                                                width="30"
                                                                                                height="30"
                                                                                                alt="Profile picture of wpdeveloper" /></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </aside>
                                                            </div>

                                                            <div class="col-lg-6 profile-col-main">
                                                                @yield("group-content")
                                                            </div>

                                                            <div class="col-lg-3 profile-col-aside right">
                                                                <aside id="member_profile_sidebar"
                                                                    class="widget-area profile-widget-area member-profile-sidebar">
                                                                    <div id="beehive_widget_latest_activity-2"
                                                                        class="widget beehive-activity-widget buddypress">
                                                                        <h5 class="widget-title">Recent activity</h5>
                                                                        <div class="alert alert-warning"
                                                                            role="alert">
                                                                            No activity found! </div>

                                                                    </div>
                                                                </aside>
                                                            </div>

                                                        </div>

                                                    </div><!-- #item-body -->

                                                </div><!-- // .bp-wrap -->



                                            </div><!-- #buddypress -->
                                        </div><!-- .entry-contents -->
                                    </article><!-- #post-0 -->




                                </main><!-- #main -->
                            </div><!-- .col-main -->


                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .layout -->
            </div><!-- #primary -->

        </div><!-- #content -->

    </div><!-- #kmk-page -->
</body>

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/mscrollbar.min.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/hiraku.min.js"></script>
<script src="/assets/js/flexmenu.min.js"></script>
<script src="/assets/js/masonry.min.js"></script>
<script src="/assets/js/jquery.fitvids.min.js"></script>

<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/lib/media-element/mediaelement-and-player.min.js?ver=4.7.3">
</script>
<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/lib/media-element/wp-mediaelement.min.js?ver=4.7.3">
</script>
<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/app/assets/js/vendors/emoji-picker.js?ver=4.7.3">
</script>

<script src="/assets/js/kmk.min.js"></script>

<script>
    document.title = "Manage Group";
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

@stack('script')
</html>
