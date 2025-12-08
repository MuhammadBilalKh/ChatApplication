@extends('layout.profile.profile-main')

@section('title', 'Profile Visibility Settings')

@section('profile-content')
     <nav class="bp-navs bp-subnavs no-ajax user-subnav mb-3" id="subnav" role="navigation" aria-label="Settings menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="general-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="general">
                <a href="{{ route('users.general_settings') }}" id="general">
                    General
                </a>
            </li>

            <li id="notifications-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="notifications">
                <a href="{{ route('users.email_setting') }}" id="notifications">
                    Email
                </a>
            </li>


            <li id="profile-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="profile">
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

    @if (session()->has('success'))
        <div class="alert alert-success">
            <span>{{ session()->get('success') }}</span>
        </div>
    @endif

    <h2 class="screen-heading profile-settings-screen">
        Profile Visibility Settings</h2>

    <p class="bp-help-text profile-visibility-info">
        Select who may see your profile details.</p>

    <form action="{{ route('users.update_profile_visibility_settings') }}" method="{{ FORM_METHOD_POST }}"
        class="standard-form" id="settings-form">
        @csrf

        <table class="profile-settings bp-tables-user" id="xprofile-settings-base">
            <thead>
                <tr>
                    <th class="title field-group-name">Base</th>
                    <th class="title">Visibility</th>
                </tr>
            </thead>

            <tbody>

                <tr class="field_1 field_name required-field visibility-public field_type_textbox">
                    <td class="field-name">Name</td>
                    <td class="field-visibility">
                        <span class="field-visibility-settings-notoggle">Everyone</span>
                    </td>
                </tr>

                <tr class="field_3 field_date-of-birth required-field visibility-adminsonly alt field_type_datebox">
                    <td class="field-name">Date of Birth</td>
                    <td class="field-visibility">

                        <label for="date_of_birth_visibility" class="bp-screen-reader-text">Select visibility</label>
                        <select class="bp-xprofile-visibility" name="date_of_birth_visibility"
                            id="date_of_birth_visibility">
                            <option @if ($metaData->date_of_birth == 'everyone') selected="selected" @endif value="everyone">Everyone
                            </option>

                            <option @if ($metaData->date_of_birth == 'only-me') selected="selected" @endif value="only-me">Only Me
                            </option>

                            <option @if ($metaData->date_of_birth == 'all-members') selected="selected" @endif value="all-members">All
                                Members</option>

                            <option @if ($metaData->date_of_birth == 'my-friends') selected="selected" @endif value="my-friends">My
                                Friends</option>

                        </select>

                    </td>
                </tr>

                <tr class="field_4 field_sex required-field visibility-public field_type_radio">
                    <td class="field-name">Sex</td>
                    <td class="field-visibility">

                        <label for="sex_visibility" class="bp-screen-reader-text">Select visibility</label>
                        <select class="bp-xprofile-visibility" name="sex_visibility" id="sex_visibility">

                            <option @if ($metaData->sex == 'everyone') selected="selected" @endif value="everyone">Everyone
                            </option>

                            <option @if ($metaData->sex == 'only-me') selected="selected" @endif value="only-me">Only Me
                            </option>

                            <option @if ($metaData->sex == 'all-members') selected="selected" @endif value="all-members">All
                                Members</option>

                            <option @if ($metaData->sex == 'my-friends') selected="selected" @endif value="my-friends">My
                                Friends</option>

                        </select>

                    </td>
                </tr>

                <tr class="field_7 field_city required-field visibility-public alt field_type_textbox">
                    <td class="field-name">City</td>
                    <td class="field-visibility">

                        <label for="city_visibility" class="bp-screen-reader-text">Select visibility</label>
                        <select class="bp-xprofile-visibility" name="city_visibility" id="city_visibility">
                            <option @if ($metaData->city == 'everyone') selected="selected" @endif value="everyone">Everyone
                            </option>

                            <option @if ($metaData->city == 'only-me') selected="selected" @endif value="only-me">Only Me
                            </option>

                            <option @if ($metaData->city == 'all-members') selected="selected" @endif value="all-members">All
                                Members</option>

                            <option @if ($metaData->city == 'my-friends') selected="selected" @endif value="my-friends">My
                                Friends</option>

                        </select>

                    </td>
                </tr>


                <tr class="field_8 field_country required-field visibility-public field_type_selectbox">
                    <td class="field-name">Country</td>
                    <td class="field-visibility">

                        <label for="country_visibility" class="bp-screen-reader-text">Select visibility</label>
                        <select class="bp-xprofile-visibility" name="country_visibility" id="country_visibility">

                            <option @if ($metaData->country == 'everyone') selected="selected" @endif value="everyone">Everyone
                            </option>

                            <option @if ($metaData->country == 'only-me') selected="selected" @endif value="only-me">Only Me
                            </option>

                            <option @if ($metaData->country == 'all-members') selected="selected" @endif value="all-members">All
                                Members</option>

                            <option @if ($metaData->country == 'my-friends') selected="selected" @endif value="my-friends">My
                                Friends</option>

                        </select>

                    </td>
                </tr>

            </tbody>
        </table>

        <input type="hidden" name="field_ids" id="field_ids" value="1,3,4,7,8" />

        <div class="submit"><input type="submit" name="xprofile-settings-submit" id="submit" value="Save Changes"
                class="auto"></div><input type="hidden" id="_wpnonce" name="_wpnonce" value="1d2449dec2" />
    </form>
@endsection

@push('script')
    <script>
        jQuery(document).ready(function() {
            jQuery(".alert").delay(2500).fadeOut();
        });
    </script>
@endpush
