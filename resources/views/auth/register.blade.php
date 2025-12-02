<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- FIX: File input covering entire page -->
    <style>
        #signup_profile_picture {
            position: relative !important;
            width: auto !important;
            height: auto !important;
            opacity: 1 !important;
            z-index: 1 !important;
            pointer-events: auto !important;
        }

        /* Additional safeguard for any theme-based wrapper */
        .default-profile input[type="file"] {
            position: relative !important;
            width: auto !important;
            height: auto !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        }
    </style>

    <!-- CSS Files -->
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

    <link rel="stylesheet" href="/assets/css/job-manager.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />

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

    <link rel="stylesheet" href="/assets/css/swiper.min.css?ver=8.4.5" />
    <link rel="stylesheet" href="/assets/css/post-30.css?ver=1761244154" />
    <link rel="stylesheet" href="/assets/css/fadeIn.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/widget-heading.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/fadeInDown.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/widget-image.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/fadeInUp.min.css?ver=3.32.4" />

    <link rel="stylesheet" href="/assets/css/adverts-frontend.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce-layout.min.css" media="all" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />
</head>

<body
    class="directory activity kmkpress bp-nouveau blog page-template-default page page-id-35 wp-theme-kmk theme-kmk woocommerce-no-js kmk kmk-guest-user kmk-default kmk-kit-30 title-bar-active kmk-social-layout panel-expanded has-page-sidebar no-js">

    @include('layout.master.sidepanel')

    <div id="kmk-page" class="site">
        @include('layout.master.header')

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
                                                <h1 class="title h3">Create an Account</h1>
                                            </div>
                                        </div>
                                    </div>

                                    <article id="post-0" class="bp_register ...">
                                        <div class="entry-content clearfix">
                                            <div id="kmkpress" class="kmkpress-wrap kmk extended-default-reg alignwide">

                                                <div id="register-page" class="page register-page">

                                                    <h2 class="register-page-title">Create an Account</h2>

                                                    <aside class="bp-feedback bp-danger bp-messages info">
                                                        <span class="bp-icon"></span>
                                                        <p>Registering for this site is easy...</p>
                                                    </aside>

                                                    @if ($errors->any())
                                                        <div class="alert alert-warning alert-dismissible">
                                                            <p>Please Fix Following Validation Errors.</p>
                                                            <button class="border-none close" data-dismiss="alert">&times;</button>
                                                            <ul>
                                                                @foreach ($errors->all() as $value)
                                                                    <li class="text-danger">{{ $value }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <form action="{{ route('users.submit_registration') }}"
                                                        method="{{ FORM_METHOD_POST }}"
                                                        enctype="multipart/form-data">

                                                        @csrf

                                                        <div class="layout-wrap">

                                                            <div class="register-section default-profile" id="basic-details-section">

                                                                <h2 class="bp-heading">Account Details</h2>

                                                                <label for="signup_profile_picture">Profile Picture (required)</label>
                                                                <input type="file"
                                                                    accept="image/*"
                                                                    name="signup_profile_picture"
                                                                    id="signup_profile_picture" />

                                                                <label for="signup_username">Username (required)</label>
                                                                <input type="text" name="signup_username"
                                                                    id="signup_username_field" autocomplete="off" />

                                                                <label for="signup_email">Email Address (required)</label>
                                                                <input type="email" name="signup_email" id="signup_email" required />

                                                                <label for="pass1">Choose a Password (required)</label>

                                                                <div class="user-pass1-wrap">
                                                                    <div class="wp-pwd">
                                                                        <div class="password-input-wrapper">
                                                                            <input type="password" name="signup_password"
                                                                                id="pass1" class="password-entry"
                                                                                autocomplete="off" />

                                                                            <button type="button" class="button wp-hide-pw">
                                                                                <span class="dashicons dashicons-hidden"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div id="pass-strength-result">Strength indicator</div>
                                                                    </div>

                                                                    <div class="pw-weak">
                                                                        <label>
                                                                            <input type="checkbox" name="pw_weak" class="pw-checkbox" /> Confirm use of weak password
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <p class="user-pass2-wrap">
                                                                    <label for="pass2">Confirm Password</label>
                                                                    <input type="password" name="signup_password_confirm"
                                                                        id="pass2" autocomplete="off" />
                                                                </p>

                                                                <p class="description indicator-hint">Password hint...</p>

                                                            </div>

                                                            <div class="register-section extended-profile hide-toggles"
                                                                id="profile-details-section">
                                                                <h2 class="bp-heading">Profile Details</h2>

                                                                <div class="editfield field_1 required-field">
                                                                    <fieldset>
                                                                        <legend>Name (required)</legend>
                                                                        <input id="field_1" name="field_1" type="text"
                                                                            value="{{ old('field_1') }}" />
                                                                    </fieldset>
                                                                </div>

                                                                <input type="hidden" name="signup_profile_field_ids"
                                                                    value="1" />
                                                            </div>

                                                        </div>

                                                        <div class="submit">
                                                            <input type="submit" value="Complete Sign Up" />
                                                        </div>

                                                    </form>

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
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

</html>
