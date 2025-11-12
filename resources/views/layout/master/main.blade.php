<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/main.css?ver=1760540595" media="all" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" media="all" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" media="all" />


    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/job-manager.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/adverts-frontend.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce-layout.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/kmk.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mediaelementplayer-legacy.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/wp-mediaelement.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/godam-player-frontend.css?ver=1760540595" media="all" />
    <link rel="stylesheet" href="/assets/css/godam-player.css?ver=1760540595" media="all" />
    <link rel="stylesheet" href="/assets/css/rtm-upload-terms.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" media="all" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

    @stack('css')
</head>

<body
    class="directory activity kmkpress bp-nouveau blog  page-template-default page page-id-35 wp-theme-kmk theme-kmk woocommerce-no-js kmk kmk-guest-user kmk-default kmk-kit-30 title-bar-active kmk-social-layout panel-expanded has-page-sidebar no-js">

    @include('layout.master.sidepanel')

    <div id="kmk-page" class="site">
        @include('layout.master.header')

        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <div class="layout social">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-8 col-main">
                                <main id="main" class="main-content">

                                    @yield('dashboard-breadcrumbs')

                                    @yield('dashboard-content')<!-- #post-0 -->

                                </main>
                            </div><!-- .col-main -->

                            @include('layout.master.right_panel')

                        </div><!-- .row -->

                    </div><!-- .container -->

                </div><!-- .layout -->
            </div><!-- #primary -->
        </div>
    </div>

</body>

<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
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

@stack('script')

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

    jQuery.ajax({
        url: "{{ route('users.show_stats') }}",
        type: "{{ FORM_METHOD_POST }}",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        success: function(resp) {
            if (resp.pendingFriendRequests == 0) {
                jQuery("#pendingFriendRequestCount").html("No Pending Request Found")
            } else {
                jQuery("#pendingFriendRequestCount").html(resp.pendingFriendRequests + " Pending Request")
            }

            jQuery("#totalFriendsCount").html(resp.totalFriends);
        }
    });
</script>

</html>
