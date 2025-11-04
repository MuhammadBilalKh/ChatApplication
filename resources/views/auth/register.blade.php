@extends('layout.auth.main-login')

@section('breadcrumbs')
    @include('layout.auth.login-breadcrumbs', [
        'pageHeader' => 'Create An Account',
    ])
@endsection

@section('title', APPLICATION_TITLE)

@section('login-section')
    <article id="post-0" class="bp_register type-bp_register post-0 page type-page status-publish hentry kmk-post">
        <div class="entry-content clearfix">
            <div id="kmkpress" class="kmkpress-wrap kmk extended-default-reg alignwide">

                <div id="register-page" class="page register-page">

                    <h2 class="register-page-title">
                        Create an Account </h2>


                    <aside class="bp-feedback bp-messages info">
                        <span class="bp-icon" aria-hidden="true"></span>
                        <p>Registering for this site is easy. Just fill in the fields
                            below, and we&#8217;ll get a new account set up for you in
                            no time.</p>

                    </aside>

                    <form action="" name="signup_form" id="signup-form" class="standard-form signup-form clearfix"
                        method="post" enctype="multipart/form-data">

                        <div class="layout-wrap">



                            <div class="register-section default-profile" id="basic-details-section">


                                <h2 class="bp-heading">Account Details</h2>

                                <label for="signup_username">Username
                                    (required)</label><input type="text" name="signup_username" id="signup_username"
                                    value="" aria-required="true" required="required" autocomplete="off"
                                    autocapitalize="none" /><label for="signup_email">Email Address
                                    (required)</label><input type="email" name="signup_email" id="signup_email"
                                    value="" aria-required="true" required="required" /> <label for="pass1">Choose
                                    a Password (required)</label>

                                <div class="user-pass1-wrap">
                                    <div class="wp-pwd">
                                        <div class="password-input-wrapper">
                                            <input type="password" data-reveal="1" name="signup_password" id="pass1"
                                                class="password-entry" size="24" value="" data-pw="xE1AErUp8$xu"
                                                aria-describedby="pass-strength-result" spellcheck="false"
                                                autocomplete="off" />
                                            <button type="button" class="button wp-hide-pw">
                                                <span class="dashicons dashicons-hidden" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div id="pass-strength-result" aria-live="polite">Strength indicator</div>
                                    </div>
                                    <div class="pw-weak">
                                        <label>
                                            <input type="checkbox" name="pw_weak" class="pw-checkbox" />
                                            Confirm use of weak password </label>
                                    </div>
                                </div>
                                <p class="user-pass2-wrap">
                                    <label for="pass2">Confirm new
                                        password</label><br />
                                    <input type="password" name="signup_password_confirm" id="pass2"
                                        class="password-entry-confirm" size="24" value="" spellcheck="false"
                                        autocomplete="off" />
                                </p>

                                <p class="description indicator-hint">Hint: The password
                                    should be at least twelve characters long. To make
                                    it stronger, use upper and lower case letters,
                                    numbers, and symbols like ! &quot; ? $ % ^ &amp; ).
                                </p>

                            </div><!-- #basic-details-section -->





                            <div class="register-section extended-profile hide-toggles" id="profile-details-section">

                                <h2 class="bp-heading">Profile Details</h2>



                                <div
                                    class="editfield field_1 field_name required-field visibility-public field_type_textbox">
                                    <fieldset>


                                        <legend id="field_1-1">
                                            Name <span class="bp-required-field-label">(required)</span>
                                        </legend>


                                        <input id="field_1" name="field_1" type="text" value=""
                                            aria-required="true" required aria-labelledby="field_1-1"
                                            aria-describedby="field_1-3">




                                        <p class="field-visibility-settings-notoggle field-visibility-settings-header"
                                            id="field-visibility-settings-toggle-1">
                                            This field may be seen by: <span
                                                class="current-visibility-level">Everyone</span>
                                        </p>


                                    </fieldset>
                                </div>


                                <input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids"
                                    value="1" />



                            </div><!-- #profile-details-section -->





                        </div><!-- //.layout-wrap -->




                        <div class="submit"><input type="submit" name="signup_submit" id="submit"
                                value="Complete Sign Up" /></div><input type="hidden" id="_wpnonce" name="_wpnonce"
                            value="47dece736e" /><input type="hidden" name="_wp_http_referer"
                            value="/MIGVELv1/register/" />

                    </form>

                </div>

            </div><!-- #kmkpress -->
        </div><!-- .entry-contents -->
    </article><!-- #post-0 -->

@endsection
