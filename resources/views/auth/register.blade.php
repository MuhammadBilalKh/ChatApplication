<!DOCTYPE html>

<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />


    <!-- CSS Files -->
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

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <!-- KMK -->
    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

    <style>
        #signup_profile_picture {
            position: relative !important;
            opacity: 1 !important;
            width: auto !important;
            height: auto !important;
            top: auto !important;
            left: auto !important;
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
                                <input type="text" id="username" class="username-control" required
                                    name="log" value="" placeholder="Email or username">
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
                <div class="panel-menu item d-none">
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
                        <form role="search" method="get" id="ajax-search-form"
                            class="ajax-search-form form-inline" action="./">
                            <div class="search-field">
                                <i class="icon ion-android-search"></i>
                                <input id="ajax-search-textfield" type="text" name="s"
                                    placeholder="Search..." value="" autocomplete="off" required>
                                <span class="kmk-loading-ring"></span>
                            </div>
                            <div class="search-button">
                                <button type="submit" class="search-submit"><i
                                        class="icon ion-android-search"></i></button>
                            </div>
                        </form>
                        <div id="ajax-search-result"></div>
                    </div>

                    <ul id="navbar-user" class="navbar-nav navbar-user">
                        <li class="mini-cart nav-item"><a href="./cart/" class="cart-contents nav-link"
                                title="View Cart"><i class="uil-cart"></i></a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link login" data-toggle="modal"
                                data-target="#login-modal">Login</a>
                        </li>

                        <li class="nav-item">
                            <a href="./register/" class="nav-link register">Register</a>
                        </li>
                    </ul>
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


                                    <div class="kmk-title-bar social">
                                        <div class="title-bar-wrapper">
                                            <div class="title-wrapper screen-reader-text">
                                                <h1 class="title h3">Create an Account</h1>
                                            </div>
                                        </div>
                                    </div>


                                    <article id="post-0"
                                        class="bp_register type-bp_register post-0 page type-page status-publish hentry kmk-post">
                                        <div class="entry-content clearfix">
                                            <div id="kmkpress"
                                                class="kmkpress-wrap kmk extended-default-reg alignwide">

                                                <div id="register-page" class="page register-page">

                                                    <h2 class="register-page-title">
                                                        Create an Account </h2>

                                                    <aside class="bp-feedback bp-danger bp-messages info">
                                                        <span class="bp-icon" aria-hidden="true"></span>
                                                        <p>Registering for this site is easy. Just fill in the fields
                                                            below, and we&#8217;ll get a new account set up for you in
                                                            no time.</p>

                                                    </aside>

                                                    @if ($errors->any())

                                                        <div class="alert alert-warning alert-dismissible">
                                                            <span class="bp-icon" aria-hidden="true"></span>
                                                            <p>Please Fix Following Validation Errors.</p>
                                                            <button class="border-none close"
                                                                data-dismiss="alert">&times;</button>

                                                            <ul type="circle">
                                                                @foreach ($errors->all() as $key => $value)
                                                                    <li class="text-danger">{{ $value }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    @endif

                                                    <form action="{{ route('users.submit_registration') }}"
                                                        name="signup_form" id="signup-form"
                                                        class="standard-form signup-form clearfix"
                                                        method="{{ FORM_METHOD_POST }}" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="layout-wrap">



                                                            <div class="register-section default-profile"
                                                                id="basic-details-section">


                                                                <h2 class="bp-heading">Account Details</h2>
                                                                <label for="signup_profile_picture">Profile Picture
                                                                    (required)</label>
                                                                <input type="file" accept="image/*"
                                                                    name="signup_profile_picture"
                                                                    id="signup_profile_picture" />

                                                                <label for="signup_username">Username
                                                                    (required)</label>
                                                                <input type="text" name="signup_username"
                                                                    id="signup_username_field" value=""
                                                                    aria-required="true" autocomplete="off"
                                                                    autocapitalize="none" />

                                                                <label for="signup_email">Email Address
                                                                    (required)</label>
                                                                <input type="email" name="signup_email"
                                                                    id="signup_email" value=""
                                                                    aria-required="true" required="required" />

                                                                <label for="pass1">Choose a Password
                                                                    (required)</label>

                                                                <div class="user-pass1-wrap">
                                                                    <div class="wp-pwd">
                                                                        <div class="password-input-wrapper">
                                                                            <input type="password" data-reveal="1"
                                                                                name="signup_password" id="pass1"
                                                                                class="password-entry" size="24"
                                                                                value="" data-pw="xE1AErUp8$xu"
                                                                                aria-describedby="pass-strength-result"
                                                                                spellcheck="false"
                                                                                autocomplete="off" />
                                                                            <button type="button"
                                                                                class="button wp-hide-pw">
                                                                                <span
                                                                                    class="dashicons dashicons-hidden"
                                                                                    aria-hidden="true"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div id="pass-strength-result"
                                                                            aria-live="polite">Strength indicator</div>
                                                                    </div>
                                                                    <div class="pw-weak">
                                                                        <label>
                                                                            <input type="checkbox" name="pw_weak"
                                                                                class="pw-checkbox" />
                                                                            Confirm use of weak password </label>
                                                                    </div>
                                                                </div>
                                                                <p class="user-pass2-wrap">
                                                                    <label for="pass2">Confirm new
                                                                        password</label><br />
                                                                    <input type="password"
                                                                        name="signup_password_confirm" id="pass2"
                                                                        class="password-entry-confirm" size="24"
                                                                        value="" spellcheck="false"
                                                                        autocomplete="off" />
                                                                </p>

                                                                <p class="description indicator-hint">Hint: The
                                                                    password
                                                                    should be at least twelve characters long. To make
                                                                    it stronger, use upper and lower case letters,
                                                                    numbers, and symbols like ! &quot; ? $ % ^ &amp; ).
                                                                </p>

                                                            </div><!-- #basic-details-section -->

                                                            <div class="register-section extended-profile hide-toggles"
                                                                id="profile-details-section">

                                                                <h2 class="bp-heading">Profile Details</h2>

                                                                <div
                                                                    class="editfield field_1 field_name required-field visibility-public field_type_textbox">
                                                                    <fieldset>

                                                                        <legend id="field_1-1">
                                                                            Name <span
                                                                                class="bp-required-field-label">(required)</span>
                                                                        </legend>


                                                                        <input id="field_1" name="field_1"
                                                                            type="text"
                                                                            value="{{ old('field_1') }}"
                                                                            aria-required="true"
                                                                            aria-labelledby="field_1-1"
                                                                            aria-describedby="field_1-3">




                                                                        <p class="field-visibility-settings-notoggle field-visibility-settings-header"
                                                                            id="field-visibility-settings-toggle-1">
                                                                            This field may be seen by: <span
                                                                                class="current-visibility-level">Everyone</span>
                                                                        </p>


                                                                    </fieldset>
                                                                </div>


                                                                <input type="hidden" name="signup_profile_field_ids"
                                                                    id="signup_profile_field_ids" value="1" />



                                                            </div><!-- #profile-details-section -->





                                                        </div><!-- //.layout-wrap -->




                                                        <div class="submit"><input type="submit"
                                                                name="signup_submit" id="submit"
                                                                value="Complete Sign Up" /></div><input type="hidden"
                                                            id="_wpnonce" name="_wpnonce"
                                                            value="47dece736e" /><input type="hidden"
                                                            name="_wp_http_referer" value="/MIGVELv1/register/" />

                                                    </form>

                                                </div>

                                            </div><!-- #kmkpress -->
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
    document.title = "Create An Account";
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
