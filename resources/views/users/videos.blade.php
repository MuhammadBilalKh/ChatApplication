@extends('layout.master.main')

@section('title', 'Videos')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', ['pageHeader' => 'Videos'])
@endsection

@section('dashboard-content')
    <article id="post-510" class="kmk-post">
        <div class="entry-content clearfix">

            <div class="rtmedia_gallery_wrapper">
                <div class="rtmedia-container">

                    <nav class="nav-component">
                        <ul class="nav-component-list media-navigation">
                            <li class="media-navigation-item selected">
                                <a href="#" class="media-navigation-link">
                                    <span class="nav-link-text">All Videos</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="rtm-gallery-title-container mb-3">
                        <h2 class="screen-reader-text">All Videos</h2>
                    </div>

                    @if ($videos->count())
                        <ul class="rtmedia-list rtmedia-media-list-video columns-3">
                            @foreach ($videos as $video)
                                <li class="rtmedia-list-item animate-item slideInUp">
                                    <a href="{{ asset($video->media_url) }}" target="_blank" class="rtmedia-list-item-a">
                                        <div class="rtmedia-item-thumbnail">
                                            <span class="rtmedia_time">{{ $video->duration }}</span>
                                            <video width="100%" height="200" preload="metadata">
                                                <source src="{{ asset($video->media_url) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>

                                        <div class="rtmedia-item-meta">
                                            <div class="author-info">
                                                <h5 class="author ellipsis">{{ $video->getPost->postUploadedBy->name ?? 'Unknown' }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-4">
                            {{ $videos->links() }}
                        </div>
                    @else
                        <p class="text-center">No videos found.</p>
                    @endif

                </div>
            </div>

        </div>
    </article>
@endsection
