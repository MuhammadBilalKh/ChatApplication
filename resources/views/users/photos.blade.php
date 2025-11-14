@extends('layout.master.main')

@section('title', 'Photos')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageTitle' => 'Photos',
    ])
@endsection

@section('dashboard-content')
    <article id="post-509" class="post-509 page type-page status-publish hentry kmk-post">
        <div class="entry-content clearfix">
            <input type="hidden" id="rtmedia_media_delete_nonce" name="rtmedia_media_delete_nonce" value="3bb8e26a5c"><input
                type="hidden" name="_wp_http_referer" value="/MIGVELv1/photos/">
            <div class="rtmedia_gallery_wrapper"><input name="rtmedia_shortcode" value="true" type="hidden"><input
                    name="is_on_home" value="" type="hidden"><input name="global" value="true"
                    type="hidden"><input name="media_type" value="photo" type="hidden"><input name="context_id"
                    value="509" type="hidden"><input name="context" value="page" type="hidden"><input
                    name="hide_comment_media" value="1" type="hidden"><input name="search_filter" value="true"
                    type="hidden">
                <div class="rtmedia-container" id="rtmedia_gallery_container_449">

                    <nav class="nav-component">
                        <ul class="nav-component-list media-navigation">
                            <li class="media-navigation-item selected">
                                <a href="https://www.clientbetalink.xyz/MIGVELv1/photos/" class="media-navigation-link">
                                    <span class="nav-link-text">
                                        All Photos </span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <div id="rtm-media-options" class="rtm-media-options rtm-media-search-enable kmk-filters">
                        <div class="filter-wrapper">

                            <form method="{{ FORM_METHOD_POST }}" id="media_search_form" class="media_search"><input
                                    type="text" id="media_search_input" value="" placeholder="Search Media"
                                    class="media_search_input" name="media_search"><span
                                    id="media_fatch_loader"></span><span id="media_search_remove"
                                    class="media_search_remove search_option"><i
                                        class="dashicons dashicons-no"></i></span><button type="submit" id="media_search"
                                    class="search_option" style="cursor: not-allowed;"><i
                                        class="dashicons dashicons-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div id="rtm-gallery-title-container" class="clearfix rtm-gallery-shortcode-title-container">

                        <h2 class="screen-reader-text">
                            All Photos </h2>
                    </div>


                    <ul class="rtmedia-list rtmedia-list-media rtm-gallery-list  rtmedia-media-list-photo columns-3">

                        @foreach ($photos as $key => $value)
                            <li class="rtmedia-list-item animate-item slideInUp" id="10"
                                style="visibility: visible; animation-name: slideInUp;">

                                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/sandlas/media/10/"
                                    title="GettyImages-2171965934" class="rtmedia-list-item-a">

                                    <div class="rtmedia-item-thumbnail">
                                        <img src="{{ asset($value->file_path) }}" alt="gettyimages-2171965934">
                                    </div>

                                    <div class="rtmedia-item-meta">
                                        <div class="author-avatar"><img loading="lazy"
                                                src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/avatars/2/1761166349-bpthumb.jpg"
                                                class="avatar user-2-avatar avatar-90 photo" width="90" height="90"
                                                alt="Profile Photo">
                                        </div>
                                        <div class="author-info">
                                            <div class="author-name">
                                                <h4 class="author ellipsis">Sandlas</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </li>
                        @endforeach

                    </ul>

                    {{ $photos->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div><!-- .entry-contents -->
    </article>
@endsection
