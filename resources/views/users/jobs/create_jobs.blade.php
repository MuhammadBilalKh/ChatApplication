@extends('layout.master.main')

@section('title', 'Submit Job')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Submit Job',
    ])
@endsection

@push('css')
    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
    <meta name="generator"
        content="Elementor 3.32.4; features: e_font_icon_svg, additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-swap">
    <style type="text/css">
        .recentcomments a {
            display: inline !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
    <style>
        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge {
            padding: 7px 0;
        }

        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge a.ab-item {
            /* Layout  */
            background-color: #F6F7F7;
            border-radius: 2px;
            display: flex;
            height: 18px;
            padding: 0px 6px;
            align-items: center;
            gap: 8px;

            /* Typography  */
            color: #3C434A;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
        }

        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge a.ab-item:hover,
        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge a.ab-item:focus {
            background-color: #DCDCDE;
        }

        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge a.ab-item:focus {
            outline: var(--wp-admin-border-width-focus) solid var(--wp-admin-theme-color-darker-20);
        }

        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge.woocommerce-site-status-badge-live a.ab-item {
            background-color: #E6F2E8;
            color: #00450C;
        }

        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge.woocommerce-site-status-badge-live a.ab-item:hover,
        #wpadminbar .quicklinks #wp-admin-bar-woocommerce-site-visibility-badge.woocommerce-site-status-badge-live a.ab-item:focus {
            background-color: #B8E6BF;
        }
    </style>
    <style type="text/css">
        .wpa-field--website_address,
        .adverts-field-name-website_address {
            display: none !important
        }
    </style>
    <style>
        .e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
        .e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
            background-image: none !important;
        }

        @media screen and (max-height: 1024px) {

            .e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
        }

        @media screen and (max-height: 640px) {

            .e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
        }
    </style>
    {{-- <link rel="icon"
        href="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2025/10/cropped-depositphotos_626754468-stock-illustration-your-logo-here-placeholder-symbol-removebg-preview-32x32.png"
        sizes="32x32" />
    <link rel="icon"
        href="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2025/10/cropped-depositphotos_626754468-stock-illustration-your-logo-here-placeholder-symbol-removebg-preview-192x192.png"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2025/10/cropped-depositphotos_626754468-stock-illustration-your-logo-here-placeholder-symbol-removebg-preview-180x180.png" />
    <meta name="msapplication-TileImage"
        content="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2025/10/cropped-depositphotos_626754468-stock-illustration-your-logo-here-placeholder-symbol-removebg-preview-270x270.png" /> --}}
    <style type="text/css" id="wp-custom-css">
        element.style {}

        img.default-logo {
            display: none;
        }

        nav.navbar.beehive-navbar.social.fixed-top {
            background: #F5BD02;
        }

        .panel-block.dark {
            background: #f5bd02 !important;
        }

        span.account-name {
            color: black;
        }

        /* //input search */
        input#ajax-search-textfield:focus {
            background: #fff;
        }

        nav.beehive-navbar.social .beehive-ajax-search form.ajax-search-form .search-field i {
            left: 5px;
        }

        /* /// user profile top space */
        div#item-header {
            margin-top: 10rem
        }

        li#myaccount-url-list {
            background-color: #fff;
            border-radius: 50px;
            padding: 2px;
        }

        nav.beehive-navbar ul.navbar-user>li>a#nav_my_account .account-name {
            max-width: 156px !important;
            white-space: nowrap;
            width: 111px !important;
            display: block;
            /* text-overflow: ellipsis; */
            /* overflow: hidden; */
        }

        .comments-area {
            margin-top: 0px;
            padding-top: 100px;
            padding-bottom: 100px;
        }

        div#comments {
            width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        img.avatar.avatar-50.photo {
            display: none;
        }
    </style>
@endpush

@section('dashboard-content')

    <nav class="nav-component">
        <ul id="menu-jobs-menu" class="nav-component-list job-navbar">
            <li id="menu-item-122"
                class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'posts.jobs_listing') current_page_item @endif menu-item-122">
                <a href="{{ route('posts.jobs_listing') }}">All jobs</a>
            </li>
            <li id="menu-item-356" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-356">
                <a href="https://www.clientbetalink.xyz/MIGVELv1/job-categories/">Categories</a>
            </li>
            <li id="menu-item-123"
                class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-505 menu-item-123">
                <a href="{{ route('posts.manage_job_posting') }}" aria-current="page">Manage</a>
            </li>
            <li id="menu-item-124"
                class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'posts.submit_job') current_page_item @endif menu-item-124">
                <a href="{{ route('posts.submit_job') }}">Submit</a>
            </li>
        </ul>
    </nav>

    <form action="{{ route('posts.create_job') }}" method="{{ FORM_METHOD_POST }}" id="submit-job-form"
        class="job-manager-form" enctype="multipart/form-data">

        @csrf

        <fieldset class="fieldset-logged_in job-manager-message">
            <label>Your account</label>
            <div class="field account-sign-in">
                You are currently signed in as <strong>{{ Auth::user()->username }}</strong>.
                <a class="logout color-primary" href="{{ route('users.logout') }}">Sign out</a>
            </div>
        </fieldset>

        <div class="block-title">
            <h3>Job details</h3>
        </div>

        <fieldset class="fieldset-job_title fieldset-type-text">
            <label for="job_title">Job Title</label>
            <div class="field required-field">
                <input type="text" class="input-text" name="job_title" id="job_title" value="{{ old('job_title') }}"
                    required>
                @error('job_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset class="fieldset-job_location fieldset-type-text">
            <label for="job_location">Location <small>(optional)</small></label>
            <div class="field">
                <input type="text" class="input-text" name="job_location" id="job_location" placeholder="e.g. London">
            </div>
        </fieldset>

        <fieldset class="fieldset-remote_position fieldset-type-checkbox">
            <label for="remote_position">Remote Position <small>(optional)</small></label>
            <div class="field">
                <input type="checkbox" name="remote_position" id="remote_position" value="1">
            </div>
        </fieldset>

        <fieldset class="fieldset-job_type fieldset-type-term-select">
            <label for="job_type">Job type</label>
            <div class="field required-field">
                <select name="job_type" id="job_type">
                    <option value="">Choose job type…</option>
                    <option value="{{ JOB_TYPE_FREELANCE }}">Freelance</option>
                    <option value="{{ JOB_TYPE_FULL_TIME }}">Full Time</option>
                    <option value="{{ JOB_TYPE_INTERNSHIP }}">Internship</option>
                    <option value="{{ JOB_TYPE_PART_TIME }}">Part Time</option>
                    <option value="{{ JOB_TYPE_TEMPORARY }}">Temporary</option>
                </select>
                @error('job_type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset class="fieldset-job_type">
            <label for="salary">Salary</label>
            <div class="field required-field">
                <input type="number" name="salary" value="{{ old('salary') }}" placeholder="Enter Salary">
                @error('salary')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset class="fieldset-job_description">
            <label for="job_description">Description</label>
            <div class="field required-field">
                <textarea name="description" id="txtDescription">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <fieldset class="fieldset-application fieldset-type-text">
            <label for="application">Application email/URL</label>
            <div class="field required-field">
                <input type="email" class="input-text" name="application_email" id="application"
                    placeholder="Enter an email or website URL" value="{{ old('application_email') }}">
                @error('application_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <div class="block-title">
            <h3>Company details</h3>
        </div>

        <fieldset class="fieldset-company_name">
            <label for="company_name">Company name</label>
            <div class="field required-field">
                <input type="text" class="input-text" name="company_name" id="company_name" required>
            </div>
        </fieldset>

        <fieldset class="fieldset-company_website">
            <label for="company_website">Website <small>(optional)</small></label>
            <div class="field">
                <input type="text" class="input-text" name="company_website" id="company_website"
                    placeholder="http://">
            </div>
        </fieldset>

        <fieldset class="fieldset-company_tagline">
            <label for="company_tagline">Tagline <small>(optional)</small></label>
            <div class="field">
                <input type="text" class="input-text" name="company_tagline" id="company_tagline"
                    placeholder="Briefly describe your company" maxlength="64">
            </div>
        </fieldset>

        <fieldset class="fieldset-company_video">
            <label for="company_video">Video <small>(optional)</small></label>
            <div class="field">
                <input type="text" class="input-text" name="company_video" id="company_video"
                    placeholder="Video link">
            </div>
        </fieldset>

        <fieldset class="fieldset-company_twitter">
            <label for="company_twitter">Twitter username <small>(optional)</small></label>
            <div class="field">
                <input type="text" class="input-text" name="company_twitter" id="company_twitter"
                    placeholder="@yourcompany" value="{{ old('company_twitter') }}">
            </div>
        </fieldset>

        <fieldset class="fieldset-company_logo fieldset-type-file">
            <label for="company_logo">Logo <small>(optional)</small></label>
            <div class="field">

                <div style="position: relative; width: 180px; height: 45px; margin-bottom:10px;">
                    <button type="button" class="button" style="width:100%; height:100%;">Select Logo</button>

                    <input type="file" name="company_logo" id="company_logo" class="wp-job-manager-file-upload"
                        accept="image/png,image/jpg,image/jpeg,image/gif"
                        style="
                            position:absolute;
                            top:0;
                            left:0;
                            width:100%;
                            height:100%;
                            opacity:0;
                            cursor:pointer;
                        ">
                </div>

                <small>Maximum file size: 2GB.</small>
            </div>
        </fieldset>

        <div class="submit">
            <input type="submit" name="save_draft" class="button save_draft" value="Save Draft"
                formnovalidate />
        </div>

    </form>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor.create(document.querySelector('#txtDescription'), {
            toolbar: [
                'bold', 'italic', 'link', 'undo', 'redo',
                'bulletedList', 'numberedList'
            ]
        }).catch(error => console.error(error));
    </script>
@endpush
