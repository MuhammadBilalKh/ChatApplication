@extends('layout.auth.main-login')

@section('breadcrumbs')
    @include('layout.auth.login-breadcrumbs', [
        'pageHeader' => 'Login',
    ])
@endsection

@section('title', APPLICATION_TITLE)

@section('login-section')
    <section
        class="kmk-section kmk-inner-section kmk-element kmk-element-bd800a4 kmk-section-content-middle kmk-reverse-mobile kmk-section-boxed kmk-section-height-default kmk-section-height-default"
        data-id="bd800a4" data-element_type="section">
        <div class="kmk-container kmk-column-gap-default">
            <div class="kmk-column kmk-col-50 kmk-inner-column kmk-element kmk-element-d6aa1ef background-primary-09"
                data-id="d6aa1ef" data-element_type="column"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="kmk-widget-wrap kmk-element-populated">
                    <div class="kmk-element kmk-element-d940293 1 kmk-widget kmk-widget-heading" data-id="d940293"
                        data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}"
                        data-widget_type="heading.default">
                        <h3 class="kmk-heading-title kmk-size-default">
                            Join the club</h3>
                    </div>
                    <div class="kmk-element kmk-element-9a6d6c8 1 kmk-widget kmk-widget-text-editor" data-id="9a6d6c8"
                        data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}"
                        data-widget_type="text-editor.default">
                        <p>Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Ut
                            elit tellus, luctus.</p>
                    </div>
                    <div class="kmk-element kmk-element-633213d kmk-mobile-align-center 1 kmk-widget kmk-widget-kmk-iconbox"
                        data-id="633213d" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}" data-widget_type="kmk-iconbox.default">
                        <div class="kmk-widget-container">

                            <div class="kmk-iconbox-element kmk-element icon-view-framed icon-shape-rounded">
                                <div class="icon-wrapper">
                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-music" viewBox="0 0 512 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M470.38 1.51L150.41 96A32 32 0 0 0 128 126.51v261.41A139 139 0 0 0 96 384c-53 0-96 28.66-96 64s43 64 96 64 96-28.66 96-64V214.32l256-75v184.61a138.4 138.4 0 0 0-32-3.93c-53 0-96 28.66-96 64s43 64 96 64 96-28.65 96-64V32a32 32 0 0 0-41.62-30.49z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="iconbox-info">
                                    <h4 class="title">
                                        Community</h4>
                                    <p class="description">
                                        At vero eos et
                                        accusamus et.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kmk-element kmk-element-8d74799 kmk-mobile-align-center 1 kmk-widget kmk-widget-kmk-iconbox"
                        data-id="8d74799" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}" data-widget_type="kmk-iconbox.default">
                        <div class="kmk-widget-container">

                            <div class="kmk-iconbox-element kmk-element icon-view-framed icon-shape-rounded">
                                <div class="icon-wrapper">
                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-shopping-basket"
                                        viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M576 216v16c0 13.255-10.745 24-24 24h-8l-26.113 182.788C514.509 462.435 494.257 480 470.37 480H105.63c-23.887 0-44.139-17.565-47.518-41.212L32 256h-8c-13.255 0-24-10.745-24-24v-16c0-13.255 10.745-24 24-24h67.341l106.78-146.821c10.395-14.292 30.407-17.453 44.701-7.058 14.293 10.395 17.453 30.408 7.058 44.701L170.477 192h235.046L326.12 82.821c-10.395-14.292-7.234-34.306 7.059-44.701 14.291-10.395 34.306-7.235 44.701 7.058L484.659 192H552c13.255 0 24 10.745 24 24zM312 392V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm112 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm-224 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="iconbox-info">
                                    <h4 class="title">Online
                                        shop</h4>
                                    <p class="description">
                                        At vero eos et
                                        accusamus et.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kmk-element kmk-element-4bc7a15 kmk-mobile-align-center 1 kmk-widget kmk-widget-kmk-iconbox"
                        data-id="4bc7a15" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}"
                        data-widget_type="kmk-iconbox.default">
                        <div class="kmk-widget-container">

                            <div class="kmk-iconbox-element kmk-element icon-view-framed icon-shape-rounded">
                                <div class="icon-wrapper">
                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-briefcase" viewBox="0 0 512 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M320 336c0 8.84-7.16 16-16 16h-96c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h416c25.6 0 48-22.4 48-48V288H320v48zm144-208h-80V80c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h512v-80c0-25.6-22.4-48-48-48zm-144 0H192V96h128v32z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="iconbox-info">
                                    <h4 class="title">Job
                                        search</h4>
                                    <p class="description">
                                        At vero eos et
                                        accusamus et.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kmk-column kmk-col-50 kmk-inner-column kmk-element kmk-element-12511e7" data-id="12511e7"
                data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="kmk-widget-wrap kmk-element-populated">
                    <div class="kmk-element kmk-element-18a0f23 kmk-widget__width-initial 1 kmk-widget kmk-widget-image"
                        data-id="18a0f23" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}" data-widget_type="image.default">
                        <img height="374" src="/assets/images/logo.png" class="attachment-large size-large wp-image-712"
                            alt="" />
                    </div>
                    <div class="kmk-element kmk-element-43e6333 1 kmk-widget kmk-widget-heading" data-id="43e6333"
                        data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}"
                        data-widget_type="heading.default">
                        <h3 class="kmk-heading-title kmk-size-default">
                            Welcome</h3>
                    </div>
                    <div class="kmk-element kmk-element-02df375 1 kmk-widget kmk-widget-text-editor" data-id="02df375"
                        data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}"
                        data-widget_type="text-editor.default">
                        <p>Join gazillions of people online
                        </p>
                    </div>
                    <div class="kmk-element kmk-element-145cd8a kmk-align-center 1 kmk-widget kmk-widget-kmk-login"
                        data-id="145cd8a" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}" data-widget_type="kmk-login.default">
                        <div class="kmk-widget-container">

                            <div class="kmk-login-element kmk-element default">
                                <div class="login-form-wrapper">
                                    <form action="./wp-login.php" method="post" id="element-login-form"
                                        class="kmk-login-form element-login-form" name="element-login">
                                        <div class="form-group">
                                            <div class="user-name">
                                                <label class="screen-reader-text">Email/username</label>
                                                <span class="icon"><i class="uil-user"></i></span>
                                                <input type="text" id="element-username" class="username-control"
                                                    required name="log" value=""
                                                    placeholder="Email or username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="pass">
                                                <label class="screen-reader-text">Password</label>
                                                <span class="icon"><i class="uil-key-skeleton-alt"></i></span>
                                                <input type="password" id="element-password" class="password-control"
                                                    required name="pwd" value="" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="forgetmenot">
                                                        <label for="element-rememberme">
                                                            <input id="element-rememberme" name="rememberme"
                                                                type="checkbox" value="forever" />
                                                            Remember
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="forgot-password">
                                                        <a href="./my-account/lost-password/">
                                                            Lost
                                                            Password?
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kmk-login-result">
                                        </div>
                                        <div class="submit">
                                            <button type="submit" id="element_login_submit"
                                                class="wide submit-login ellipsis" name="wp-submit">Log
                                                into your
                                                account</button>
                                        </div>
                                        <input type="hidden" id="element-login-security" name="element-login-security"
                                            value="eb27b9b60c" /><input type="hidden" name="_wp_http_referer"
                                            value="/MIGVELv1/" />
                                        <div class="register-link">
                                            <a href="{{ route('users.register') }}" class="register color-primary">Create
                                                an
                                                account</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
