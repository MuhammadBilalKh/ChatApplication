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
                                            <a type="button" class="btn btn-success btn-sm" href="{{ route('posts.make_job_public', ['jobID' => $value->job_posting_id]) }}">Submit</a>
                                            <li class="job-type">
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
        </article>
    @endsection

    @push('script')
        <script>
            jQuery(document).ready(function() {

            });
        </script>
    @endpush
