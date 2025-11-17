@extends('layout.profile.profile-main')

@section('title', 'Profile')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Profile',
    ])
@endsection

@push('css')
    <style>
        #header-cover-image{
            height: 300px;
            background-image: url('{{ asset('/storage/'.Auth::user()->cover_image) }}');
        }
        </style>
@endpush

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

        <div class="bp-widget base">

            @if ($errors->any())
                <div class="alert alert-danger m-2">
                    <ul>
                        @foreach ($errors->all() as $key => $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success m-2">
                    <span>{{ session()->get('success') }}</span>
                </div>
            @endif

            <form action={{ route('users.update_profile') }} method="{{ FORM_METHOD_POST }}" enctype="multipart/form-data">
                @csrf
                <div class="editfield mt-3 field_1 field_name required-field visibility-public field_type_textbox">
                    <fieldset>
                        <legend id="field_1-1">
                            Name <span class="bp-required-field-label">(required)</span>
                        </legend>
                        <input id="field_1" name="user_full_name" type="text" value="{{ Auth::user()->name }}"
                            aria-required="true" aria-labelledby="field_1-1" aria-describedby="field_1-3">

                    </fieldset>
                </div>

                <div
                    class="editfield mt-3 field_2 field_date-of-birth required-field visibility-public alt field_type_datebox">
                    <fieldset>
                        <legend>
                            Date of Birth <span class="bp-required-field-label">(required)</span>
                        </legend>
                        <div class="row">
                            @php
                                $dob = Auth::user()->date_of_birth;
                                $selectedDay = $selectedMonth = $selectedYear = '';
                                if ($dob) {
                                    $dt = \Carbon\Carbon::parse($dob);
                                    $selectedDay = (int) $dt->format('d');
                                    $selectedMonth = $dt->format('F');
                                    $selectedYear = $dt->format('Y');
                                }
                                $months = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December',
                                ];
                            @endphp
                            <div class="form-group col-md-4 mb-2">
                                <label for="field_2_day" class="xprofile-field-label">Day</label>
                                <select id="field_2_day" name="field_2_day" class="form-control" aria-required="true">
                                    <option value="" @if (empty($selectedDay)) selected @endif>----</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}"
                                            @if ($selectedDay == $i) selected @endif>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="field_2_month" class="xprofile-field-label">Month</label>
                                <select id="field_2_month" name="field_2_month" class="form-control" aria-required="true">
                                    <option value="" @if (empty($selectedMonth)) selected @endif>----</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month }}"
                                            @if ($selectedMonth == $month) selected @endif>
                                            {{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="field_2_year" class="xprofile-field-label">Year</label>
                                <select id="field_2_year" name="field_2_year" class="form-control" aria-required="true">
                                    <option value="" @if (empty($selectedYear)) selected @endif>----</option>
                                    @for ($y = date('Y'); $y >= 1965; $y--)
                                        <option value="{{ $y }}"
                                            @if ($selectedYear == $y) selected @endif>
                                            {{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                    </fieldset>
                </div>

                <div class="editfield mt-3 field_3 field_sex required-field visibility-public field_type_radio">
                    <fieldset>
                        <legend>
                            Sex <span class="bp-required-field-label">(required)</span>
                        </legend>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div id="field_3" class="input-options radio-button-options">
                                    <div class="form-check form-check-inline">
                                        <input @if (Auth::user()->gender == 'male') checked @endif type="radio"
                                            name="user_gender" id="option_4" value="Male" />
                                        <label for="option_4" class="form-check-label option-label">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input @if (Auth::user()->gender == 'female') checked @endif type="radio"
                                            name="user_gender" id="option_5" value="Female" />
                                        <label for="option_5" class="form-check-label option-label">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </div>

                <div class="editfield mt-3 field_6 field_city required-field visibility-public alt field_type_textbox">
                    <fieldset>
                        <legend id="field_6-1">
                            City <span class="bp-required-field-label">(required)</span>
                        </legend>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input id="field_6" name="city_name" type="text" class="form-control"
                                    value="{{ Auth::user()->city_name }}" aria-required="true" aria-labelledby="field_6-1"
                                    aria-describedby="field_6-3">
                            </div>
                        </div>

                    </fieldset>
                </div>

                <div class="editfield mt-3 field_7 field_country required-field visibility-public field_type_selectbox">
                    <fieldset>
                        <legend id="field_7-1">
                            Country <span class="bp-required-field-label">(required)</span>
                        </legend>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <select id="field_7" name="country_id" class="form-control" aria-required="true"
                                    aria-labelledby="field_7-1" aria-describedby="field_7-3">
                                    <option value="">----</option>
                                    @foreach ($countries as $id => $country_name)
                                        <option @if (Auth::user()->country_id == $id) selected @endif
                                            value="{{ $id }}">{{ $country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </fieldset>
                </div>

                <div class="bp-avatar">
                    <div class="bp-uploader-window">
                        <div id="bp-upload-ui" style="position: relative;" class="drag-drop">
                            <div id="drag-drop-area" style="position: relative;">
                                <div class="drag-drop-inside">
                                    <p class="drag-drop-info p-3">
                                        Please Upload Your Profile Picture</p>
                                    <p class="drag-drop-buttons p-3">
                                        <label for="bp-browse-button" class="bp-screen-reader-text">
                                            Select your file
                                        </label>
                                        <input id="bp-browse-button" type="button" value="Select your file"
                                            class="button" style="position: relative; z-index: 1;">
                                    </p>

                                    <div id="avatar-preview" class="m-3" style="margin-top: 10px;">
                                        <img src="" alt="Profile Preview"
                                            style="max-width: 50px;  display: none; border-radius: 10%;">
                                    </div>

                                </div>
                            </div>
                            <div id="html5_1j9dk63tav751hempgv6698el5_container" class="moxie-shim moxie-shim-html5"
                                style="position: absolute; top: 71px; left: 184px; width: 169px; height: 40px; overflow: hidden; z-index: 0;">
                                <input id="html5_1j9dk63tav751hempgv6698el5" type="file"
                                    style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"
                                    accept="image/jpeg,.jpg,.jpeg,.jpe,image/gif,.gif,image/png,.png,.webp"
                                    name="profile_image" />
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="field_ids" id="field_ids" value="1,2,3,6,7">

                <div class="bp-avatar">
                    <div class="bp-uploader-window">
                        <div id="bp-upload-ui" style="position: relative;" class="drag-drop">
                            <div id="drag-drop-area" style="position: relative;">
                                <div class="drag-drop-inside">
                                    <p class="drag-drop-info p-3">
                                        Please Upload Your Cover Picture</p>
                                    <p class="drag-drop-buttons p-3">
                                        <label for="bp-browse-button-cover" class="bp-screen-reader-text">
                                            Select your file
                                        </label>
                                        <input id="bp-browse-button-cover" type="button" value="Select your file"
                                            class="button" style="position: relative; z-index: 1;">
                                    </p>

                                    <div id="avatar-preview-cover" class="m-3" style="margin-top: 10px;">
                                        <img src="" alt="Profile Preview"
                                            style="max-width: 50px;  display: none; border-radius: 10%;">
                                    </div>

                                </div>
                            </div>
                            <div id="html5_1j9dk63tav751hempgv6698el5_container" class="moxie-shim moxie-shim-html5"
                                style="position: absolute; top: 71px; left: 184px; width: 169px; height: 40px; overflow: hidden; z-index: 0;">
                                <input id="html5_1j9dk63tav751hempgv6698el5-cover" type="file"
                                    style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"
                                    accept="image/jpeg,.jpg,.jpeg,.jpe,image/gif,.gif,image/png,.png,.webp"
                                    name="cover_image" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit">
                    <input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit"
                        value="Save Changes">
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const button = document.getElementById('bp-browse-button');
        const coverImageButton = document.getElementById('bp-browse-button-cover');
        const fileInput = document.getElementById('html5_1j9dk63tav751hempgv6698el5');
        const fileInputCover = document.getElementById('html5_1j9dk63tav751hempgv6698el5-cover');
        const preview = document.getElementById('avatar-preview').querySelector('img');
        const coverPreview = document.getElementById('avatar-preview-cover').querySelector('img');

        coverImageButton.addEventListener('click', () => {
            fileInputCover.click();
        });

        button.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        fileInputCover.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.src = e.target.result;
                    coverPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
