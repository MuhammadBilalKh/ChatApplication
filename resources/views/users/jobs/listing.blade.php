@extends('layout.master.main')

@section('title', 'Jobs Listing')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Jobs Listing',
    ])
@endsection

@section('dashboard-extra-rightpanel')
    <div id="recent-posts-1" class="widget widget_recent_entries">
        <h5 class="widget-title">Featured Jobs</h5>
        <ul id="recentPosts">

        </ul>
    </div>
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

    <article id="post-506" class="post-506 page type-page status-publish hentry kmk-post">
        <div class="entry-content clearfix">
            <div class="job_listings" data-location="" data-keywords="" data-show_filters="true"
                data-show_pagination="false" data-per_page="30" data-orderby="featured" data-order="DESC" data-categories=""
                data-disable-form-state-storage="" data-featured_first="false" data-post_id="506">
                <form class="job_filters kmk-filters">

                    <div class="search_jobs">

                        <div class="search_keywords">
                            <label for="search_keywords">Keywords</label>
                            <input type="text" name="search_keywords" id="search_keywords" placeholder="Keywords"
                                value="">
                        </div>

                        <div class="search_location">
                            <label for="search_location">Location</label>
                            <input type="text" name="search_location" id="search_location" placeholder="Location"
                                value="">
                        </div>

                        <div class="search_submit">
                            <input type="submit" value="" />
                        </div>

                    </div>


                    <button class="button-filter" type="button" data-toggle="collapse" data-target="#job_filters_collapse"
                        aria-expanded="false" aria-controls="job_filters_collapse">
                        <i class=" uil-sliders-v"></i>
                        Filter</button>
                    <div class="collapse" id="job_filters_collapse">
                        <ul class="job_types">
                            <li><label for="job_type_freelance" class="freelance"><input type="checkbox"
                                        name="filter_job_type[]" value="freelance" checked="checked"
                                        id="job_type_freelance"> Freelance</label></li>
                            <li><label for="job_type_full-time" class="full-time"><input type="checkbox"
                                        name="filter_job_type[]" value="full-time" checked="checked"
                                        id="job_type_full-time"> Full Time</label></li>
                            <li><label for="job_type_internship" class="internship"><input type="checkbox"
                                        name="filter_job_type[]" value="internship" checked="checked"
                                        id="job_type_internship">
                                    Internship</label></li>
                            <li><label for="job_type_part-time" class="part-time"><input type="checkbox"
                                        name="filter_job_type[]" value="part-time" checked="checked"
                                        id="job_type_part-time"> Part Time</label></li>
                            <li><label for="job_type_temporary" class="temporary"><input type="checkbox"
                                        name="filter_job_type[]" value="temporary" checked="checked"
                                        id="job_type_temporary"> Temporary</label></li>
                        </ul>
                        <input type="hidden" name="filter_job_type[]" value="">
                    </div>

                    <div class="showing_jobs" style="display: block;">
                        <span>&nbsp;</span><a
                            href="https://www.clientbetalink.xyz/MIGVELv1?feed=job_feed&amp;job_types=freelance%2Cfull-time%2Cinternship%2Cpart-time%2Ctemporary&amp;search_location&amp;job_categories&amp;search_keywords"
                            class="rss_link">RSS</a>
                    </div>
                </form>


                <noscript>Your browser does not support JavaScript, or it is disabled.
                    JavaScript must be enabled in order to view listings.</noscript>
                <ul class="job_listings">
                    @forelse ($postings as $key => $value)
                        <li class="animate-item slideInUp post-281 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_type-full-time kmk-post job-type-full-time"
                            data-longitude="" data-latitude="" style="visibility: visible; animation-name: slideInUp;">
                            <div class="job-list-item">
                                <div class="logo">
                                    <figure>
                                        <img class="company_logo"
                                            src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2020/01/job-logo-8.png"
                                            alt="Clinivex Analytics">
                                    </figure>
                                </div>
                                <div class="job-info">
                                    <h4 class="job-title">
                                        <a
                                            href="https://www.clientbetalink.xyz/MIGVELv1/job/marketing-data-enrichment-specialist/">Marketing
                                            {{ $value->title }}</a>
                                    </h4>
                                    <div class="about-company">
                                        <span class="address mute ellipsis">{{ $value->location }}</span>
                                        <p class="company-name color-primary ellipsis">
                                            {{ $value->company_name }}</p>
                                    </div>
                                </div>
                                <div class="job-listing-meta">
                                    <ul class="job-types-lists ellipsis">
                                        <li class="job-type full-time">{{ $value->job_type }}</li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li
                            class="animate-item slideInUp post-281 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_type-full-time kmk-post job-type-full-time">
                            {{ __('No Active Job Posting Found.') }}
                        </li>
                    @endforelse
                </ul>
                {{ $postings->links() }}
            </div>
        </div>
    </article>
@endsection
