<div id="rtmedia-single-media-container" class="rtmedia-single-media rtm-single-media rtm-media-type-photo">
    @php
        $mediaItems = $postData->postMedia ?? collect();
        $mediaCount = $mediaItems->count();
    @endphp

    <div class="rtmedia-media" style="max-height: 557.67px;">
        @if ($mediaCount > 0)
            <div id="media-slider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($mediaItems as $index => $media)
                        <div class="carousel-item @if ($index === 0) active @endif">
                            @if ($media->media_type === 'image')
                                <img src="{{ asset($media->file_path) }}" alt="Post media" class="d-block w-100"
                                    style="object-fit:contain;max-height:557px;">
                            @elseif($media->media_type === 'video')
                                <video controls class="d-block w-100" style="max-height:557px;">
                                    <source src="{{ asset($media->file_path) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if ($mediaCount > 1)
                    <button class="carousel-control-prev" type="button" data-target="#media-slider" data-slide="prev"
                        title="Previous Media">
                        <i class="uil-arrow-left" aria-hidden="true"></i> <!-- FontAwesome Icon -->
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#media-slider" data-slide="next"
                        title="Next Media">
                        <i class="uil-arrow-right" aria-hidden="true"></i> <!-- FontAwesome Icon -->
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif

            </div>
        @else
            <div class="alert alert-info alert-dismissible">No media available for this post.</div>
        @endif
    </div>

    <div class="rtm-ltb-action-container clearfix">
        <div class="rtm-ltb-title">
            <span class="rtmedia-media-name rtmedia-media-name-width-50">
                &nbsp;<a href="#" title="{{ $postData->title ?? 'Media' }}">{{ $postData->title ?? 'Media' }}</a>
            </span>

            <span class="rtmedia-album-name">
                <span>&nbsp;under</span>
                <a href="#" title="Wall Posts">Wall Posts</a>
            </span>
        </div>

        <div class="rtmedia-actions rtmedia-author-actions rtm-item-actions">
            <form action="#">
                <button type="submit" class="rtmedia-edit rtmedia-action-buttons button">Edit</button>
            </form>
            <form action="#" id="rtmedia-media-view-form"></form>
            <form method="post" action="#">
                <input type="hidden" name="id" id="id" value="{{ $postData->post_id }}">
                <button type="submit" title="Delete Media"
                    class="rtmedia-delete-media rtmedia-action-buttons button">Delete</button>
            </form>
        </div>
    </div>
</div>

<div class="rtmedia-single-meta rtm-single-meta">
    <div class="rtmedia-scroll">
        <div class="rtm-single-meta-contents logged-in">
            <div class="rtm-user-meta-details">
                <div class="userprofile rtm-user-avatar">
                    <a href="#" title="{{ $postData->postUploadedBy->username ?? 'User' }}">
                        <img loading="lazy"
                            src="{{ asset($postData->postUploadedBy->profile_picture ?? 'assets/images/default.png') }}"
                            class="avatar user-{{ $postData->postUploadedBy->user_id ?? 'unknown' }}-avatar avatar-90 photo"
                            width="90" height="90" alt="Profile Photo">
                    </a>
                </div>

                <div class="username">
                    <a href="#"
                        title="{{ $postData->postUploadedBy->username ?? 'User' }}">{{ $postData->postUploadedBy->username ?? 'Unknown User' }}</a>
                </div>

                <div class="rtm-time-privacy clearfix">
                    <span>{{ $postData->created_at ? $postData->created_at->diffForHumans() : '' }}</span>
                    <i class="dashicons dashicons-admin-site" title="Public"></i>
                </div>
            </div>

            <div class="rtmedia-actions-before-description clearfix"></div>

            <div class="rtmedia-media-description rtm-more">
                {{ $postData->description ?? '' }}
            </div>

            <div class="rtmedia-item-comments">
                <div class="rtmedia-actions-before-comments clearfix">
                    <span>
                        <form action="#">
                            <button type="submit" class="rtmedia-like rtmedia-action-buttons button "
                                title="Like/Unlike">
                                <span>{{ $postData->getLikedBy->contains('user_id', Auth::user()->user_id) ? 'Unlike' : 'Like' }}</span>
                            </button>
                        </form>
                    </span>
                </div>
                <div class="rtm-like-comments-info ">
                    <div class="rtmedia-like-info ">
                        <i class="dashicons dashicons-thumbs-up"></i>
                        <span class="rtmedia-like-counter-wrap">
                            {{ $postData->getLikedBy->count() ?? 0 }}
                        </span>
                    </div>
                    <div class="rtmedia-comments-container">
                        <ul id="rtmedia_comment_ul" class="rtm-comment-list">
                            @forelse($postData->comments as $comment)
                                <li class="rtmedia-comment">
                                    @include('partials.modal_post_comment', ['comment' => $comment])
                                </li>
                            @empty
                                <li class="rtmedia-comment  ">
                                    <div class="rtmedia-comment-content">
                                        <p>No comments yet. Be the first to comment!</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="rtm-media-single-comments">
            <form id="rt_media_comment_form" class="rt_media_comment_form" onsubmit="return false;">
                <textarea style="width:100%" placeholder="Type Comment..." name="comment_content" id="comment_content"
                    class="bp-suggestions ac-input emojiable-option"></textarea>
                    <input type="hidden" name="post_id" id="txtPostID" value="{{ $postData->post_id }}" />
                <button type="button" id="emojiBtn" aria-label="Insert emoji" style="background:none;border:none;cursor:pointer;font-size:1.3em;vertical-align:middle;">🙂</button>
                <input type="submit" id="rt_media_comment_submit" class="rt_media_comment_submit"
                    value="Comment" />
            </form>
        </div>
    </div>
</div>
