@extends('layout.master.main')

@section('title', 'Manage Job Posting')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Manage Job Posting',
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
                class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-505 @if (Route::currentRouteName() == 'posts.manage_job_posting') current_page_item @endif menu-item-123">
                <a href="{{ route('posts.manage_job_posting') }}" aria-current="page">Manage</a>
            </li>
            <li id="menu-item-124"
                class="menu-item menu-item-type-post_type menu-item-object-page @if (Route::currentRouteName() == 'posts.submit_job') current_page_item @endif menu-item-124">
                <a href="{{ route('posts.submit_job') }}">Submit</a>
            </li>
        </ul>
    </nav>


    <article id="post-505" class="post-505 page type-page status-publish hentry kmk-post">

        <div class="entry-content clearfix">

            <div id="job-manager-job-dashboard">
                <form action="{{ route('posts.jobs_listing') }}" class="job_filters kmk-filters">

                    <div class="search_jobs">

                        <div class="search_keywords">
                            <label for="search_keywords">Keywords</label>
                            <input type="text" name="search_keywords" id="search_keywords" placeholder="Keywords"
                                value="{{ request()->search_keywords }}">
                        </div>

                        <div class="search_location">
                            <label for="search_location">Location</label>
                            <input type="text" name="search_location" id="search_location" placeholder="Location"
                                value="{{ request()->search_location }}">
                        </div>

                        <div class="search_submit">
                            <input type="submit" value="">
                        </div>

                    </div>

                    <button class="button-filter" type="button" data-toggle="collapse" data-target="#job_filters_collapse"
                        aria-expanded="false" aria-controls="job_filters_collapse">
                        <i class=" uil-sliders-v"></i>
                        Filter</button>
                    <div class="collapse" id="job_filters_collapse">
                        <ul class="job_types">
                            <li>
                                <label for="job_type_freelance" class="freelance">
                                    <input type="checkbox" name="filter_job_type[]" value="{{ JOB_TYPE_FREELANCE }}"
                                        {{ in_array(JOB_TYPE_FREELANCE, request('filter_job_type', [])) ? 'checked' : '' }}>
                                    Freelance
                                </label>
                            </li>

                            <li>
                                <label for="job_type_full-time" class="full-time">
                                    <input type="checkbox" name="filter_job_type[]" value="{{ JOB_TYPE_FULL_TIME }}"
                                        {{ in_array(JOB_TYPE_FULL_TIME, request('filter_job_type', [])) ? 'checked' : '' }}>
                                    Full Time
                                </label>
                            </li>

                            <li>
                                <label for="job_type_internship" class="internship">
                                    <input type="checkbox" name="filter_job_type[]" value="{{ JOB_TYPE_INTERNSHIP }}"
                                        {{ in_array(JOB_TYPE_INTERNSHIP, request('filter_job_type', [])) ? 'checked' : '' }}>
                                    Internship
                                </label>
                            </li>

                            <li>
                                <label for="job_type_part-time" class="part-time">
                                    <input type="checkbox" name="filter_job_type[]" value="{{ JOB_TYPE_PART_TIME }}"
                                        {{ in_array(JOB_TYPE_PART_TIME, request('filter_job_type', [])) ? 'checked' : '' }}>
                                    Part Time
                                </label>
                            </li>

                            <li>
                                <label for="job_type_temporary" class="temporary">
                                    <input type="checkbox" name="filter_job_type[]" value="{{ JOB_TYPE_TEMPORARY }}"
                                        {{ in_array(JOB_TYPE_TEMPORARY, request('filter_job_type', [])) ? 'checked' : '' }}>
                                    Temporary
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="showing_jobs" style="display: block;">
                        <span>&nbsp;</span><a
                            href="https://www.clientbetalink.xyz/MIGVELv1?feed=job_feed&amp;job_types=freelance%2Cfull-time%2Cinternship%2Cpart-time%2Ctemporary&amp;search_location&amp;job_categories&amp;search_keywords"
                            class="rss_link">RSS</a>
                    </div>
                </form>
                <ul class="job_listings">

                    @forelse ($list as $key => $value)
                        <li class="animate-item slideInUp post-281 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_type-full-time kmk-post job-type-full-time"
                            data-longitude="" data-latitude="" style="visibility: visible; animation-name: slideInUp;">
                            <div class="job-list-item">
                                <div class="logo">
                                    <figure>
                                        <img class="company_logo"
                                            src="{{ asset('/storage/'.$value->company_logo) }}"
                                            alt="{{ ucwords($value->company_name) }}" />
                                    </figure>
                                </div>
                                <div class="job-info">
                                    <a href="#" class="job-title" target="_blank">{{ $value->title }}</a>

                                    <div class="about-company">
                                        <span class="address mute ellipsis">{{ $value->location }}</span>
                                        <p class="company-name ellipsis">
                                            {{ ucwords($value->company_name) }}</p>
                                    </div>
                                </div>

                                <div class="job-listing-meta">
                                    <ul class="job-types-lists ellipsis">
                                        <li class="job-type full-time">
                                            @switch($value->job_type)
                                                @case(JOB_TYPE_FREELANCE)
                                                    Freelance
                                                @break

                                                @case(JOB_TYPE_FULL_TIME)
                                                    Full Time
                                                @break

                                                @case(JOB_TYPE_INTERNSHIP)
                                                    Intership
                                                @break

                                                @case(JOB_TYPE_PART_TIME)
                                                    Part Time
                                                @break

                                                @case(JOB_TYPE_TEMPORARY)
                                                    Temporary Basis
                                                @break

                                                @default
                                                    Temporary Basis
                                                @break
                                            @endswitch
                                        </li>
                                    </ul>
                                </div>
                                &nbsp;
                                <span>:</span>
                            </div>
                        </li>
                        @empty
                            <li>You do not have any active listings.</li>
                        @endforelse
                    </ul>
                </div>
                <dialog class="jm-dialog" id="jmDashboardOverlay">
                    <div class="jm-dialog-open">
                        <div class="jm-dialog-backdrop" onclick="jmDashboardOverlay.close()"></div>
                        <div class="jm-dialog-modal jm-dashboard__overlay" style="">
                            <div class="jm-dialog-modal-container">
                                <div class="jm-dialog-modal-content"></div>
                                <a href="#" role="button" class="jm-ui-button--icon jm-dialog-close"
                                    onclick="jmDashboardOverlay.close();  event.preventDefault();" aria-label="Close"><span
                                        class="jm-ui-button__icon"></span></a>
                            </div>
                        </div>
                    </div>
                </dialog>
            </div>
            {{ $list->links() }}
        </article>
    @endsection

    @push('script')
        <script>
            jQuery(document).ready(function() {

            });
        </script>
    @endpush
