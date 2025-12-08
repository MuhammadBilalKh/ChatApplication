@extends('layout.master.main')

@section('title', 'Preview Job')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Preview Job',
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
                                        @switch($data->job_type)
                                            @case(JOB_TYPE_FREELANCE)
                                                Freelance
                                            @break

                                            @case(JOB_TYPE_FULL_TIME)
                                                Full Time
                                            @break

                                            @case(JOB_TYPE_INTERNSHIP)
                                                Internship
                                            @break

                                            @case(JOB_TYPE_PART_TIME)
                                                Part Time
                                            @break

                                            @case(JOB_TYPE_TEMPORARY)
                                                Temporary
                                            @break

                                            @default
                                        @endswitch
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
                                    <a class="google_map_link" href="{{ urlencode($data->location) }}"
                                        target="_blank">{{ $data->location }}</a>
                                </div>
                            </li>


                        </ul>

                        <div class="company job-single-header">
                            <div class="logo">
                                <img decoding="async" class="company_logo"
                                    src="{{ asset('/storage/'.$data->company_logo) }}"
                                    alt="test company">
                            </div>
                            <div class="info">
                                <h1 class="job_title h2">{{ $data->title }}</h1> <span
                                    class="color-primary">{{ $data->company_name }}</span>
                                <p class="tagline">{{ $data->tagline }}</p>
                            </div>
                            <div class="contacts">
                            </div>
                        </div>


                        <div class="job_description">
                            <p>{!! $data->description !!}</p>
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
