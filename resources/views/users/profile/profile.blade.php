@extends('layout.profile.profile-main')

@section('title', 'Profile')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Profile',
    ])
@endsection

@section('profile-content')
    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Profile menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">
            <li id="public-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="public">
                <a href="{{ url('/members-2/sandlas/profile/public') }}" id="public">
                    Update Profile Detail
                </a>
            </li>
        </ul>
    </nav>

    <div class="profile public">
        <h2 class="screen-heading view-profile-screen pt-3">View Profile</h2>

        <div class="bp-widget base">
            <h3 class="screen-heading profile-group-title">Base</h3>

            <!-- Name Field -->
            <div class="editfield field_1 field_name required-field visibility-public field_type_textbox">
                <fieldset>
                    <legend id="field_1-1">
                        Name <span class="bp-required-field-label">(required)</span>
                    </legend>
                    <input id="field_1" name="field_1" type="text" value="{{ Auth::user()->name }}" aria-required="true" required="" aria-labelledby="field_1-1" aria-describedby="field_1-3">
                    <p class="field-visibility-settings-notoggle field-visibility-settings-header" id="field-visibility-settings-toggle-1">
                        This field may be seen by: <span class="current-visibility-level">Everyone</span>
                    </p>
                </fieldset>
            </div>

            <!-- Date of Birth Field -->
            <div class="editfield field_2 field_date-of-birth required-field visibility-public alt field_type_datebox">
                <fieldset>
                    <legend>
                        Date of Birth <span class="bp-required-field-label">(required)</span>
                    </legend>
                    <div class="input-options datebox-selects">
                        <label for="field_2_day" class="xprofile-field-label">Day</label>
                        <select id="field_2_day" name="field_2_day" aria-required="true" required="">
                            <option value="" selected>----</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label for="field_2_month" class="xprofile-field-label">Month</label>
                        <select id="field_2_month" name="field_2_month" aria-required="true" required="">
                            <option value="" selected>----</option>
                            @php $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; @endphp
                            @foreach ($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                        <label for="field_2_year" class="xprofile-field-label">Year</label>
                        <select id="field_2_year" name="field_2_year" aria-required="true" required="">
                            <option value="" selected>----</option>
                            @for ($y = date('Y'); $y >= 1965; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-2">
                        This field may be seen by: <span class="current-visibility-level">Everyone</span>
                        <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>
                    </p>
                    <div class="field-visibility-settings bp-hide" id="field-visibility-settings-2">
                        <fieldset>
                            <legend>Who is allowed to see this field?</legend>
                            <div class="radio">
                                <label for="see-field_2_public">
                                    <input type="radio" id="see-field_2_public" name="field_2_visibility" value="public" checked> <span class="field-visibility-text">Everyone</span>
                                </label>
                                <label for="see-field_2_adminsonly">
                                    <input type="radio" id="see-field_2_adminsonly" name="field_2_visibility" value="adminsonly"> <span class="field-visibility-text">Only Me</span>
                                </label>
                                <label for="see-field_2_loggedin">
                                    <input type="radio" id="see-field_2_loggedin" name="field_2_visibility" value="loggedin"> <span class="field-visibility-text">All Members</span>
                                </label>
                                <label for="see-field_2_friends">
                                    <input type="radio" id="see-field_2_friends" name="field_2_visibility" value="friends"> <span class="field-visibility-text">My Friends</span>
                                </label>
                            </div>
                        </fieldset>
                        <button class="field-visibility-settings-close button" type="button">Close</button>
                    </div>
                </fieldset>
            </div>

            <!-- Sex Field -->
            <div class="editfield field_3 field_sex required-field visibility-public field_type_radio">
                <fieldset>
                    <legend>
                        Sex <span class="bp-required-field-label">(required)</span>
                    </legend>
                    <div id="field_3" class="input-options radio-button-options">
                        <label for="option_4" class="option-label"><input checked type="radio" name="field_3" id="option_4" value="Male">Male</label>
                        <label for="option_5" class="option-label"><input type="radio" name="field_3" id="option_5" value="Female">Female</label>
                    </div>
                    <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-3">
                        This field may be seen by: <span class="current-visibility-level">Everyone</span>
                        <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>
                    </p>
                    <div class="field-visibility-settings bp-hide" id="field-visibility-settings-3">
                        <fieldset>
                            <legend>Who is allowed to see this field?</legend>
                            <div class="radio">
                                <label for="see-field_3_public">
                                    <input type="radio" id="see-field_3_public" name="field_3_visibility" value="public" checked> <span class="field-visibility-text">Everyone</span>
                                </label>
                                <label for="see-field_3_adminsonly">
                                    <input type="radio" id="see-field_3_adminsonly" name="field_3_visibility" value="adminsonly"> <span class="field-visibility-text">Only Me</span>
                                </label>
                                <label for="see-field_3_loggedin">
                                    <input type="radio" id="see-field_3_loggedin" name="field_3_visibility" value="loggedin"> <span class="field-visibility-text">All Members</span>
                                </label>
                                <label for="see-field_3_friends">
                                    <input type="radio" id="see-field_3_friends" name="field_3_visibility" value="friends"> <span class="field-visibility-text">My Friends</span>
                                </label>
                            </div>
                        </fieldset>
                        <button class="field-visibility-settings-close button" type="button">Close</button>
                    </div>
                </fieldset>
            </div>

            <!-- City Field -->
            <div class="editfield field_6 field_city required-field visibility-public alt field_type_textbox">
                <fieldset>
                    <legend id="field_6-1">
                        City <span class="bp-required-field-label">(required)</span>
                    </legend>
                    <input id="field_6" name="field_6" type="text" value="" aria-required="true" required="" aria-labelledby="field_6-1" aria-describedby="field_6-3">
                    <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-6">
                        This field may be seen by: <span class="current-visibility-level">Everyone</span>
                        <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>
                    </p>
                    <div class="field-visibility-settings bp-hide" id="field-visibility-settings-6">
                        <fieldset>
                            <legend>Who is allowed to see this field?</legend>
                            <div class="radio">
                                <label for="see-field_6_public">
                                    <input type="radio" id="see-field_6_public" name="field_6_visibility" value="public" checked> <span class="field-visibility-text">Everyone</span>
                                </label>
                                <label for="see-field_6_adminsonly">
                                    <input type="radio" id="see-field_6_adminsonly" name="field_6_visibility" value="adminsonly"> <span class="field-visibility-text">Only Me</span>
                                </label>
                                <label for="see-field_6_loggedin">
                                    <input type="radio" id="see-field_6_loggedin" name="field_6_visibility" value="loggedin"> <span class="field-visibility-text">All Members</span>
                                </label>
                                <label for="see-field_6_friends">
                                    <input type="radio" id="see-field_6_friends" name="field_6_visibility" value="friends"> <span class="field-visibility-text">My Friends</span>
                                </label>
                            </div>
                        </fieldset>
                        <button class="field-visibility-settings-close button" type="button">Close</button>
                    </div>
                </fieldset>
            </div>

            <div class="editfield field_7 field_country required-field visibility-public field_type_selectbox">
                <fieldset>
                    <legend id="field_7-1">
                        Country <span class="bp-required-field-label">(required)</span>
                    </legend>
                    <select id="field_7" name="field_7" aria-required="true" required="" aria-labelledby="field_7-1" aria-describedby="field_7-3">
                        <option value="">----</option>
                        @php
                        $countries = [
                            "Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina",
                            "Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados",
                            "Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana",
                            "Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada",
                            "Cape Verde","Central African Republic","Chad","Chile","China","Colombi","Comoros",
                            "Congo (Brazzaville)","Congo","Costa Rica","Cote d'Ivoire","Croatia","Cuba","Cyprus",
                            "Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor Timur)",
                            "Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia",
                            "Fiji","Finland","France","Gabon","Gambia, The","Georgia","Germany","Ghana","Greece",
                            "Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland",
                            "India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan",
                            "Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kuwait","Kyrgyzstan","Laos",
                            "Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg",
                            "Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands",
                            "Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Morocco",
                            "Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","New Zealand","Nicaragua",
                            "Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay",
                            "Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda",
                            "Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino",
                            "Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles",
                            "Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia",
                            "South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden",
                            "Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga",
                            "Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine",
                            "United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu",
                            "Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"
                        ];
                        @endphp
                        @foreach($countries as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                    <p class="field-visibility-settings-toggle field-visibility-settings-header" id="field-visibility-settings-toggle-7">
                        This field may be seen by: <span class="current-visibility-level">Everyone</span>
                        <button class="visibility-toggle-link text-button" type="button" aria-expanded="false">Change</button>
                    </p>
                    <div class="field-visibility-settings bp-hide" id="field-visibility-settings-7">
                        <fieldset>
                            <legend>Who is allowed to see this field?</legend>
                            <div class="radio">
                                <label for="see-field_7_public">
                                    <input type="radio" id="see-field_7_public" name="field_7_visibility" value="public" checked> <span class="field-visibility-text">Everyone</span>
                                </label>
                                <label for="see-field_7_adminsonly">
                                    <input type="radio" id="see-field_7_adminsonly" name="field_7_visibility" value="adminsonly"> <span class="field-visibility-text">Only Me</span>
                                </label>
                                <label for="see-field_7_loggedin">
                                    <input type="radio" id="see-field_7_loggedin" name="field_7_visibility" value="loggedin"> <span class="field-visibility-text">All Members</span>
                                </label>
                                <label for="see-field_7_friends">
                                    <input type="radio" id="see-field_7_friends" name="field_7_visibility" value="friends"> <span class="field-visibility-text">My Friends</span>
                                </label>
                            </div>
                        </fieldset>
                        <button class="field-visibility-settings-close button" type="button">Close</button>
                    </div>
                </fieldset>
            </div>

            <div class="bp-avatar">
                <div class="bp-uploader-window">
                    <div id="bp-upload-ui"
                        style="position: relative;"
                        class="drag-drop">
                        <div id="drag-drop-area"
                            style="position: relative;">
                            <div class="drag-drop-inside">
                                <p class="drag-drop-info p-3">
                                    Please Upload Your Profile Picture</p>

                                <p
                                    class="drag-drop-buttons p-3">
                                    <label
                                        for="bp-browse-button"
                                        class="bp-screen-reader-text">
                                        Select your file
                                    </label>
                                    <input id="bp-browse-button"
                                        type="button"
                                        value="Select your file"
                                        class="button"
                                        style="position: relative; z-index: 1;">
                                </p>

                                <div id="avatar-preview" class="m-3"
                                    style="margin-top: 10px;">
                                    <img src=""
                                        alt="Profile Preview"
                                        style="max-width: 50px;  display: none; border-radius: 10%;">
                                </div>

                            </div>
                        </div>
                        <div id="html5_1j9dk63tav751hempgv6698el5_container"
                            class="moxie-shim moxie-shim-html5"
                            style="position: absolute; top: 71px; left: 184px; width: 169px; height: 40px; overflow: hidden; z-index: 0;">
                            <input
                                id="html5_1j9dk63tav751hempgv6698el5"
                                type="file"
                                style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"
                                accept="image/jpeg,.jpg,.jpeg,.jpe,image/gif,.gif,image/png,.png,.webp">
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="field_ids" id="field_ids" value="1,2,3,6,7">

            <div class="submit">
                <input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="Save Changes">
            </div>
            <input type="hidden" id="_wpnonce" name="_wpnonce" value="f6a059572f">
            <input type="hidden" name="_wp_http_referer" value="/members-2/sandlas/profile/edit/group/1/">
        </div>
    </div>
@endsection
