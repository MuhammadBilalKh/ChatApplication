@extends('layout.master.main')

@section('title', 'Submit Job')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Submit Job',
    ])
@endsection

@section('dashboard-content')
    <article id="post-504" class="post-504 page type-page status-publish hentry beehive-post">
        <div class="entry-content clearfix">
            <form method="post" id="job_preview" action="/MIGVELv1/post-a-job/">
                <input type="hidden" id="_wpjm_nonce" name="_wpjm_nonce" value="2194508bc9"><input type="hidden"
                    name="_wp_http_referer" value="/MIGVELv1/post-a-job/">
                <div class="job_listing_preview_title">
                    <h4 class="preview-title">Preview</h4>
                    <input type="submit" name="edit_job" class="button job-manager-button-edit-listing button-solid"
                        value="Edit listing">
                    <input type="submit" name="continue" id="job_preview_submit_button"
                        class="button job-manager-button-submit-listing button-solid" value="Submit Listing">
                </div>
                <div class="job_listing_preview single_job_listing">

                    <div class="single_job_listing">

                        <ul class="job-listing-meta meta">

                            <li class="single-job-type">
                                <div class="item-name">
                                    <span class="item-icon"><i class="uil-briefcase-alt"></i></span>
                                    <span class="item-title">
                                        <strong>Job Type</strong>
                                    </span>
                                </div>
                                <div class="item-desc">
                                    <span>
                                        @php
                                            switch ($data->job_type) {
                                                case JOB_TYPE_FREELANCE:
                                                    return "Freelance";
                                                    break;
                                                case JOB_TYPE_FULL_TIME:
                                                    return "Full Time";
                                                    break;
                                                case JOB_TYPE_INTERNSHIP:
                                                    return "Internship";
                                                    break;
                                                case JOB_TYPE_PART_TIME:
                                                    return "Part Time";
                                                    break;
                                                case JOB_TYPE_TEMPORARY:
                                                    return "Temporary";
                                                    break;
                                                default:
                                                    return ""
                                                    break;
                                            }
                                        @endphp
                                    </span>
                                </div>
                            </li>

                            <li class="location">
                                <div class="item-name">
                                    <span class="item-icon"><i class="uil-location-point"></i></span>
                                    <span class="item-title">
                                        <strong>Location</strong>
                                    </span>
                                </div>
                                <div class="item-desc">
                                    <a class="google_map_link"
                                        href="{{ urlencode($data->location) }}"
                                        target="_blank">testing (Remote)</a>
                                </div>
                            </li>


                        </ul>

                        <div class="company job-single-header">
                            <div class="logo">
                                <img decoding="async" class="company_logo"
                                    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/job-manager-uploads/company_logo/2025/11/Social_Media_DB-150x150.png"
                                    alt="test company">
                            </div>
                            <div class="info">
                                <h1 class="job_title h2">{{ $data->title }}</h1> <span class="color-primary">{{ $data->company_name }}</span>
                                <p class="tagline">{{ $data->tagline }}</p>
                            </div>
                            <div class="contacts">
                            </div>
                        </div>


                        <div class="job_description">
                            <p>{{ $data->description }}</p>
                        </div>


                    </div>

                    {{-- <input type="hidden" name="job_id" value="806">
                    <input type="hidden" name="step" value="1">
                    <input type="hidden" name="job_manager_form" value="submit-job"> --}}
                </div>
            </form>

        </div>
    </article>
@endsection
