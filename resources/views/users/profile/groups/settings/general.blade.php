@extends('layout.profile.profile-main')

@section('title', 'Settings')

@section('profile-content')

     <nav class="bp-navs bp-subnavs no-ajax user-subnav mb-3" id="subnav" role="navigation" aria-label="Settings menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="general-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="general">
                <a href="{{ route('users.general_settings') }}" id="general">
                    General
                </a>
            </li>

            <li id="notifications-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="notifications">
                <a href="{{ route('users.email_setting') }}" id="notifications">
                    Email
                </a>
            </li>


            <li id="profile-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="profile">
                <a href="{{ route('users.profile_visibility_settings') }}" id="profile">
                    Profile Visibility
                </a>
            </li>


            <li id="invites-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="invites">
                <a href="https://mythemestore.com/beehive-preview/members/user/settings/invites/" id="invites">
                    Group Invites
                </a>
            </li>


            <li id="data-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="data">
                <a href="https://mythemestore.com/beehive-preview/members/user/settings/data/" id="data">
                    Export Data
                </a>
            </li>

        </ul>

    </nav>

    @if (session()->has('errors'))
        <div class="alert alert-danger">
            {{ session()->get('errors') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <h2 class="screen-heading general-settings-screen">
        Email &amp; Password</h2>

    <p class="info email-pwd-info">
        Update your email and or password.</p>

    <form action="{{ route('users.update_general_settings') }}" method="{{ FORM_METHOD_POST }}" class="standard-form"
        id="your-profile">
        @csrf

        <label for="pwd">
            Current Password <span>(required to update email or change current password)</span> </label>
        <input type="password" name="current_password" id="pwd" value="" size="24"
            class="settings-input small" spellcheck="false" autocomplete="off"> &nbsp;<a href="#">Lost your
            password?</a>

        <label for="email">Account Email</label>
        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="settings-input">

        <div class="info bp-feedback">
            <span class="bp-icon" aria-hidden="true"></span>
            <p class="text">Click on the "Generate Password" button to change your password.</p>
        </div>

        <div class="user-pass1-wrap">
            <button type="button" class="button wp-generate-pw" onclick="generateStrongPassword(8)">
                Generate Password </button>

            <div class="wp-pwd">
                <label for="pass1">Add Your New Password</label>
                <span class="password-input-wrapper">
                    <input type="password" name="pass1" id="pass1" size="24"
                        class="settings-input small password-entry" value="" data-pw="Zn97$tzmlHsjs%lp5EkyBk69"
                        aria-describedby="pass-strength-result" spellcheck="false" autocomplete="off">
                </span>
                <button type="button" class="button wp-hide-pw" data-toggle="0" aria-label="Hide password">
                    <span class="dashicons dashicons-hidden" aria-hidden="true"></span>
                    <span class="text bp-screen-reader-text">Hide</span>
                </button>
                <button type="button" class="button wp-cancel-pw" data-toggle="0" aria-label="Cancel password change">
                    <span class="text">Cancel</span>
                </button>
                <div id="pass-strength-result" aria-live="polite" style="display: block;"></div>
            </div>
        </div>

        <div class="user-pass2-wrap" style="display: none;">
            <label class="label" for="pass2">Repeat Your New Password</label>
            <input name="pass2" type="password" id="pass2" size="24"
                class="settings-input small password-entry-confirm" value="" spellcheck="false" autocomplete="off">
        </div>

        <div class="pw-weak">
            <label>
                <input type="checkbox" name="pw_weak" class="pw-checkbox">
                <span id="pw-weak-text-label">Confirm use of potentially weak password</span>
            </label>
        </div>

        <div class="submit"><input type="submit" name="submit" id="submit" value="Save Changes" class="auto">
        </div><input type="hidden" id="_wpnonce" name="_wpnonce" value="73483a59e9"><input type="hidden"
            name="_wp_http_referer" value="/beehive-preview/members/user/settings/">
    </form>

@endsection

@push('script')
    <script>
        jQuery(document).ready(function() {

            jQuery(".wp-hide-pw").on("click", function() {
                let input = jQuery("#pass1");
                let type = input.attr("type") === "password" ? "text" : "password";
                input.attr("type", type);
            });

            jQuery(".alert").delay(2500).fadeOut();
        });
    </script>

    <script>
        function generateStrongPassword(length = 12) {
            const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
            const numberChars = '0123456789';
            const specialChars = '!@#$%^&*()_+[]{}|;:,.<>?';

            const allChars = uppercaseChars + lowercaseChars + numberChars + specialChars;

            let password = '';

            password += uppercaseChars[Math.floor(Math.random() * uppercaseChars.length)];
            password += lowercaseChars[Math.floor(Math.random() * lowercaseChars.length)];
            password += numberChars[Math.floor(Math.random() * numberChars.length)];
            password += specialChars[Math.floor(Math.random() * specialChars.length)];

            for (let i = password.length; i < length; i++) {
                password += allChars[Math.floor(Math.random() * allChars.length)];
            }

            password = password.split('').sort(() => Math.random() - 0.5).join('');

            jQuery("#pass1").val(password);
        }
    </script>
@endpush
