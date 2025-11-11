@extends('layout.master.main')

@section('title', 'Submit Job')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Submit Job',
    ])
@endsection

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
                <a href="https://www.clientbetalink.xyz/MIGVELv1/job-dashboard/" aria-current="page">Manage</a>
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
        <input type="hidden" id="_wpjm_nonce" name="_wpjm_nonce" value="1c25f1ceab"><input type="hidden"
            name="_wp_http_referer" value="/MIGVELv1/post-a-job/">

        <fieldset class="fieldset-logged_in job-manager-message">
            <label>Your account</label>
            <div class="field account-sign-in">
                You are currently signed in as <strong>{{ Auth::user()->username }}</strong>.
                <a class="logout color-primary" href="{{ route('users.logout') }}">Sign
                    out</a>
            </div>
        </fieldset>

        <div class="block-title">
            <h3>Job details</h3>
        </div>

        <fieldset class="fieldset-job_title fieldset-type-text">
            <label for="job_title">Job Title</label>
            <div class="field required-field">
                <input type="text" class="input-text" name="job_title" id="job_title" placeholder=""
                    value="{{ old('job_title') }}" maxlength="" required="">
                @error('job_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>
        <fieldset class="fieldset-job_location fieldset-type-text">
            <label for="job_location">Location <small>(optional)</small></label>
            <div class="field ">
                <input type="text" class="input-text" name="job_location" id="job_location"
                    placeholder="e.g. &quot;London&quot;" value="" maxlength="">
                <small class="description">Leave this blank if the location is
                    not important</small>
            </div>
        </fieldset>
        <fieldset class="fieldset-remote_position fieldset-type-checkbox">
            <label for="remote_position">Remote Position
                <small>(optional)</small></label>
            <div class="field ">
                <input type="checkbox" class="input-checkbox" name="remote_position" id="remote_position" value="1">
                <small class="description">Select if this is a remote
                    position.</small>
            </div>
        </fieldset>
        <fieldset class="fieldset-job_type fieldset-type-term-select">
            <label for="job_type">Job type</label>
            <div class="field required-field">
                <select name="job_type" id="job_type" class="postform">
                    <option value="" selected>Choose job type…</option>
                    <option class="level-0" value="{{ JOB_TYPE_FREELANCE }}">Freelance</option>
                    <option class="level-0" value="{{ JOB_TYPE_FULL_TIME }}">Full Time</option>
                    <option class="level-0" value="{{ JOB_TYPE_INTERNSHIP }}">INTERNSHIP</option>
                    <option class="level-0" value="{{ JOB_TYPE_PART_TIME }}">PART TIME</option>
                    <option class="level-0" value="{{ JOB_TYPE_TEMPORARY }}">TEMPORARY</option>
                </select>
                @error('job_type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>
        <fieldset class="fieldset-job_description fieldset-type-wp-editor">
            <label for="job_description">Description</label>
            <div class="field required-field">
                <div id="wp-job_description-wrap" class="wp-core-ui wp-editor-wrap tmce-active">
                    <textarea name="description" id="txtDescription" value="{{ old('description') }}"></textarea>
                </div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>
        <fieldset class="fieldset-application fieldset-type-text">
            <label for="application">Application email/URL</label>
            <div class="field required-field">
                <input type="email" class="input-text" name="application_email" id="application"
                    placeholder="Enter an email address or website URL" value="{{ old('application_email') }}" />
                @error('application_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <div class="block-title">
            <h3>Company details</h3>
        </div>

        <fieldset class="fieldset-company_name fieldset-type-text">
            <label for="company_name">Company name</label>
            <div class="field required-field">
                <input type="text" class="input-text" name="company_name" id="company_name"
                    placeholder="Enter the name of the company" value="" maxlength="" required="">
            </div>
        </fieldset>
        <fieldset class="fieldset-company_website fieldset-type-text">
            <label for="company_website">Website
                <small>(optional)</small></label>
            <div class="field ">
                <input type="text" class="input-text" name="company_website" id="company_website"
                    placeholder="http://" value="" maxlength="">
            </div>
        </fieldset>
        <fieldset class="fieldset-company_tagline fieldset-type-text">
            <label for="company_tagline">Tagline
                <small>(optional)</small></label>
            <div class="field ">
                <input type="text" class="input-text" name="company_tagline" id="company_tagline"
                    placeholder="Briefly describe your company" value="" maxlength="64">
            </div>
        </fieldset>
        <fieldset class="fieldset-company_video fieldset-type-text">
            <label for="company_video">Video <small>(optional)</small></label>
            <div class="field ">
                <input type="text" class="input-text" name="company_video" id="company_video"
                    placeholder="A link to a video about your company" value="" maxlength="">
            </div>
        </fieldset>
        <fieldset class="fieldset-company_twitter fieldset-type-text">
            <label for="company_twitter">Twitter username
                <small>(optional)</small></label>
            <div class="field ">
                <input type="text" class="input-text" name="company_twitter" id="company_twitter"
                    placeholder="@yourcompany" value="" maxlength="">
            </div>
        </fieldset>
        <fieldset class="fieldset-company_logo fieldset-type-file">
            <label for="company_logo">Logo <small>(optional)</small></label>
            <div class="field ">
                <div class="job-manager-uploaded-files">
                </div>

                <input type="file" class="input-text wp-job-manager-file-upload" data-file_types="jpg|jpeg|gif|png"
                    name="company_logo" id="company_logo" placeholder="">
                <small class="description">
                    Maximum file size: 2 GB. </small>
            </div>
        </fieldset>



        <div class="submit">
            <input type="submit" name="submit_job" class="button" value="Preview" />
            <input type="submit" name="save_draft" class="button button-outline save_draft" value="Save Draft"
                formnovalidate=""> <span class="spinner"
                style="background-image: url('https://www.clientbetalink.xyz/MIGVELv1/wp-includes/images/spinner.gif');"></span>
        </div>

    </form>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#txtDescription'), {
                toolbar: [
                    'bold',
                    'italic',
                    'link',
                    'unlink',
                    'undo',
                    'redo',
                    'bulletedList',
                    'numberedList'
                ]
            })
            .then(editor => {
                console.log('Editor initialized', editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
