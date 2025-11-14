@foreach ($posts as $post)
    @php
        $topLevelComments = $post->comments->where('parent_comment_id', null);
        $topLevelCommentsCount = $topLevelComments->count();
        $markedFavorite = $post->getMarkedFavorite->contains('user_id', Auth::user()->user_id);
        $userLiked = $post->getLikedBy->contains('user_id', Auth::user()->user_id);
    @endphp
    <li class="activity-item animate-item slideInUp" data-id="{{ $post->post_id }}">
        <div class="activity-avatar item-avatar">
            <a href="#">
                <img src="{{ asset('/storage/' . $post->postUploadedBy->profile_picture ?? 'assets/images/default.png') }}"
                    width="50" height="50" class="avatar user-7-avatar avatar-200 photo"
                    alt="User Profile Picture" />
            </a>
        </div>

        <div class="activity-content">
            <div class="activity-header">
                <div class="posted-meta">
                    <p>
                        <a href="{{ route('users.profile') }}">{{ Auth::user()->username }}</a>
                    </p>
                </div>
                <div class="date mute">{{ $post->created_at->diffForHumans() }}</div>
            </div>

            @if ($post->is_new_joining_post == NEW_JOINING_USER_POST || $post->is_profile_info_updated_post == 1)
                <div class="activity-inner">
                    <div class="beehive-mini-activity member">
                        <div class="mini-activity-inner">
                            <div class="mini-cover"></div>
                            <div class="mini-content">
                                <div class="mini-avatar">
                                    <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/david/">
                                        <img loading="lazy"
                                            src="{{ asset('/storage/' . Auth::user()->profile_picture) }}"
                                            class="avatar user-6-avatar avatar-200 photo" width="200" height="200"
                                            alt="Profile Photo"> </a>
                                </div>
                                <div class="mini-info">
                                    <h5 class="mini-title"><a
                                            href="https://www.clientbetalink.xyz/MIGVELv1/members-2/david/"
                                            class="ellipsis">Mùchén</a></h5>
                                    <div class="mini-meta">
                                        <span class="ellipsis"><i class="uil-at"></i>david</span>
                                    </div>
                                </div>
                                <div class="mini-actions">
                                    <div class="friendship-button is_friend generic-button" id="friendship-button-6"><a
                                            href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/friends/remove-friend/6/?_wpnonce=7d4735fa0a"
                                            class="friendship-button is_friend remove" id="friend-6" rel="remove"
                                            title="Cancel Friendship" data-bp-btn-action="is_friend">Cancel
                                            Friendship</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($post->new_joining_post != NEW_JOINING_USER_POST)
                <div class="activity-inner">
                    <p>{{ $post->description }} </p>
                    @if ($post->postMedia && $post->postMedia->count())
                        @php
                            $firstMedia = $post->postMedia->first();
                            $mediaCount = $post->postMedia->count();
                            $imageCount = $post->postMedia->where('media_type', 'image')->count();
                            $videoCount = $post->postMedia->where('media_type', 'video')->count();
                        @endphp
                        <div class="post-media">
                            <div class="row postContentModal" data-post-id="{{ $post->post_id }}" data-fancybox
                                id="openModalBtn" data-src="#postModal" href="javascript:;">
                                <div class="col-sm-6 mt-2">
                                    @if ($firstMedia->media_type === 'image')
                                        <img src="{{ asset($firstMedia->file_path) }}" width="300"
                                            alt="Post image" />
                                    @elseif($firstMedia->media_type === 'video')
                                        <video width="300" controls>
                                            <source src="{{ asset($firstMedia->file_path) }}" type="video/mp4" />
                                        </video>
                                    @endif
                                </div>
                                <div class="col-sm-6 mt-2 d-flex align-items-center">
                                    <span class="media-count badge">
                                        @if ($imageCount > 0 && $videoCount > 0)
                                            {{ $imageCount }}
                                            {{ \Illuminate\Support\Str::plural('Image', $imageCount) }},
                                            {{ $videoCount }}
                                            {{ \Illuminate\Support\Str::plural('Video', $videoCount) }}
                                        @elseif ($imageCount > 0)
                                            {{ $imageCount }}
                                            {{ \Illuminate\Support\Str::plural('Image', $imageCount) }}
                                        @elseif ($videoCount > 0)
                                            {{ $videoCount }}
                                            {{ \Illuminate\Support\Str::plural('Video', $videoCount) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="activity-meta action">
                        <div class="generic-button">
                            <a class="button acomment-reply bp-primary-action bp-tooltip show-comments-btn"
                                data-bp-tooltip="Comment" role="button"
                                data-comments-count="{{ $topLevelCommentsCount }}"
                                data-post-id="{{ $post->post_id }}">
                                <span> Comments</span>
                            </a>
                        </div>
                        <div class="generic-button">
                            <a type="button" data-id="post-{{ $post->post_id }}"
                                class="button btnMarkFavorite fav bp-secondary-action {{ $markedFavorite ? 'unlike' : 'like' }} bp-tooltip"
                                data-bp-tooltip="Mark as Favorite">
                                <span>{{ $markedFavorite ? 'Remove Marked' : 'Mark as Favorite' }}</span>
                            </a>
                        </div>
                        @if (Auth::user()->user_id == $post->postUploadedBy->user_id)
                            <div class="generic-button">
                                <a type="button" data-id="post-{{ $post->post_id }}"
                                    class="button delPost fav bp-secondary-action bp-tooltip" data-bp-tooltip="Delete">
                                    <span>Delete</span>
                                </a>
                            </div>
                        @endif
                        <div class="generic-button kmk-like">
                            <a type="button" id="post-{{ $post->post_id }}" data-id="post-{{ $post->post_id }}"
                                class="button btnLikeUnlike bp-primary-action {{ $userLiked ? 'unlike' : 'like' }}">
                                <i
                                    class="{{ $userLiked ? 'uil-thumbs-down' : 'uil-thumbs-up' }} post-{{ $post->post_id }}"></i>
                                <span class="like-text">{{ count($post->getLikedBy) }} Like</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="kmk-mini-activity member">
                    <div class="mini-activity-inner">
                        <div class="mini-cover"
                            style="background-image: url('{{ asset('/storage/' . $post->postUploadedBy->cover_image) }}')">
                        </div>
                        <div class="mini-content">
                            <div class="mini-avatar">
                                <a href="./members-2/wpdeveloper/">
                                    <img loading="lazy"
                                        src="{{ asset('/storage/' . $post->postUploadedBy->profile_picture) }}"
                                        class="avatar user-1-avatar avatar-200 photo" width="200" height="200"
                                        alt="Profile Photo" />
                                </a>
                            </div>
                            <div class="mini-info">
                                <h5 class="mini-title"><a href="./members-2/wpdeveloper/"
                                        class="ellipsis">{{ $post->postUploadedBy->username }}</a>
                                </h5>
                                <div class="mini-meta">
                                    <span class="ellipsis"><i
                                            class="uil-at"></i>{{ $post->postUploadedBy->username }}</span>
                                </div>
                            </div>
                            <div class="mini-actions">
                                <div class="friendship-button pending_friend generic-button" id="friendship-button-1">
                                    <a href="./members-2/novipa/friends/requests/cancel/1/?_wpnonce=b59a45b00b"
                                        class="friendship-button pending_friend requested" id="friend-1"
                                        rel="remove" title="Cancel Friendship Requested"
                                        data-bp-btn-action="pending">Cancel
                                        Friendship Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="activity-meta action"
                style="{{ $post->new_joining_post == NEW_JOINING_USER_POST ? '' : 'display:none;' }}">
                <div class="generic-button">
                    <a class="button acomment-reply bp-primary-action bp-tooltip show-comments-btn"
                        data-bp-tooltip="Comment" role="button" data-comments-count="{{ $topLevelCommentsCount }}"
                        data-post-id="{{ $post->post_id }}">
                        <span>{{ $topLevelCommentsCount }} Comments</span>
                    </a>
                </div>
                <div class="generic-button">
                    <a type="button" data-id="post-{{ $post->post_id }}"
                        class="button btnMarkFavorite fav bp-secondary-action {{ $markedFavorite ? 'unlike' : 'like' }} bp-tooltip"
                        data-bp-tooltip="Mark as Favorite">
                        <span>{{ $markedFavorite ? 'Remove Marked' : 'Mark as Favorite' }}</span>
                    </a>
                </div>
                @if (Auth::user()->user_id == $post->postUploadedBy->user_id)
                    <div class="generic-button">
                        <a type="button" data-id="post-{{ $post->post_id }}"
                            class="button delPost fav bp-secondary-action bp-tooltip" data-bp-tooltip="Delete">
                            <span>Delete</span>
                        </a>
                    </div>
                @endif
                <div class="generic-button kmk-like">
                    <a type="button" id="post-{{ $post->post_id }}" data-id="post-{{ $post->post_id }}"
                        class="button btnLikeUnlike bp-primary-action {{ $userLiked ? 'unlike' : 'like' }}">
                        <i
                            class="{{ $userLiked ? 'uil-thumbs-down' : 'uil-thumbs-up' }} post-{{ $post->post_id }}"></i>
                        <span class="like-text">{{ count($post->getLikedBy) }} Like</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="activity-comments post-comments" id="comments-{{ $post->post_id }}" style="display: none;">
            <!-- Comments List -->
            <ul class="comment-list">
                @foreach ($topLevelComments as $comment)
                    @include('partials.comment_item', ['comment' => $comment, 'depth' => 0])
                @endforeach
            </ul>

            <!-- Add Comment Form -->
            <form action="{{ route('comments.store') }}" method="POST" class="add-comment-form">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                <input type="hidden" name="parent_comment_id" value="">

                <div class="ac-reply-avatar">
                    <img loading="lazy"
                        src="{{ asset('/storage/' . Auth::user()->profile_picture ?? 'assets/images/default.png') }}"
                        class="avatar user-{{ Auth::user()->user_id }}-avatar avatar-50 photo" width="50"
                        height="50" alt="Profile picture of {{ Auth::user()->name }}" />
                </div>

                <div class="ac-reply-content">
                    <div class="ac-textarea">
                        <label for="comment-{{ $post->post_id }}" class="bp-screen-reader-text">
                            Comment
                        </label>
                        <input type="text" id="comment-{{ $post->post_id }}" class="ac-input bp-suggestions"
                            name="content" placeholder="Write a comment..." spellcheck="false" required />
                    </div>
                    <input type="submit" name="ac_form_submit" class="mt-3" value="Post Comment">
                    <button type="reset" class="ac-reply-cancel" value="Cancel">Cancel </button>
                </div>
            </form>
        </div>
    </li>
@endforeach
