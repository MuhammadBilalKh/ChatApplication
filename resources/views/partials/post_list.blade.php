@foreach ($posts as $post)
    @php
        $topLevelComments = $post->comments->where('parent_comment_id', null);
        $topLevelCommentsCount = $topLevelComments->count();
        $markedFavorite = $post->getMarkedFavorite->contains('user_id', Auth::user()->user_id);
        $userLiked = $post->getLikedBy->contains('user_id', Auth::user()->user_id);

        $isSpecialMiniActivity =
            $post->new_joining_post == NEW_JOINING_USER_POST || $post->is_profile_info_updated_post == 1;
    @endphp

    <li class="activity-item animate-item slideInUp" data-id="{{ $post->post_id }}">

        {{-- USER AVATAR --}}
        <div class="activity-avatar item-avatar">
            <a href="#">
                <img src="{{ asset($post->postUploadedBy->profile_picture ?? 'assets/images/default.png') }}"
                    width="50" height="50" class="avatar user-7-avatar avatar-200 photo"
                    alt="User Profile Picture" />
            </a>
        </div>

        <div class="activity-content">

            <div class="activity-header">
                <div class="posted-meta">
                    <p>
                        <a href="{{ route('users.profile') }}" class="h5">
                            {{ $post->postUploadedBy->username }}
                        </a>

                        @if ($isSpecialMiniActivity)
                            <span>{{ $post->description }}</span>
                        @endif
                    </p>

                    <div class="date mute">{{ $post->created_at->diffForHumans() }}</div>
                </div>
            </div>


            @if (!$isSpecialMiniActivity)
                <div class="activity-inner">

                    @if ($post->description)
                        <p class="post-text">{{ $post->description }}</p>
                    @endif

                    @if ($post->postMedia && $post->postMedia->count())
                        @php
                            $firstMedia = $post->postMedia->first();
                            $imageCount = $post->postMedia->where('media_type', 'image')->count();
                            $videoCount = $post->postMedia->where('media_type', 'video')->count();
                        @endphp

                        <div class="post-media mt-2">
                            <div class="row postContentModal" data-post-id="{{ $post->post_id }}" data-fancybox
                                data-src="#postModal" id="openModalBtn" href="javascript:;">

                                <div class="col-sm-6 mt-2">
                                    @if ($firstMedia->media_type === 'image')
                                        <img src="{{ asset($firstMedia->file_path) }}" width="300"
                                            alt="Post image" />
                                    @elseif ($firstMedia->media_type === 'video')
                                        <video width="300" controls>
                                            <source src="{{ asset($firstMedia->file_path) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>

                                {{-- Count of media --}}
                                <div class="col-sm-6 mt-2 d-flex align-items-center">
                                    <span class="media-count badge">
                                        @if ($imageCount > 0)
                                            {{ $imageCount }} {{ Str::plural('Image', $imageCount) }}
                                        @endif

                                        @if ($videoCount > 0)
                                            , {{ $videoCount }} {{ Str::plural('Video', $videoCount) }}
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </div>
                    @else

                    @endif

                </div>


                {{-- MINI ACTIVITY POSTS --}}
            @else
                <div class="kmk-mini-activity member">
                    <div class="mini-activity-inner">

                        <div class="mini-cover"
                            style="background-image: url('{{ asset('/storage/' . $post->postUploadedBy->cover_image) }}')">
                        </div>

                        <div class="mini-content">

                            <div class="mini-avatar">
                                <a href="#">
                                    <img loading="lazy" src="{{ asset($post->postUploadedBy->profile_picture) }}"
                                        class="avatar user-1-avatar avatar-200 photo" width="200" height="200"
                                        alt="Profile Photo" />
                                </a>
                            </div>

                            <div class="mini-info">
                                <h5 class="mini-title">
                                    <a href="#" class="ellipsis">{{ $post->postUploadedBy->username }}</a>
                                </h5>
                                <div class="mini-meta">
                                    <span class="ellipsis">
                                        <i class="uil-at"></i>{{ $post->postUploadedBy->username }}
                                    </span>
                                </div>
                            </div>

                            {{-- Friend Request Actions --}}
                            @if ($post->new_joining_post == NEW_JOINING_USER_POST && Auth::user()->user_id != $post->user_id)
                                <div class="mini-actions">

                                    @if ($post->friend_status == 'none')
                                        <div class="friendship-button pending_friend generic-button">
                                            <a type="button" data-action="send" onclick="ManageFriendRequest(this)"
                                                class="friendship-button pending_friend requested"
                                                id="friend-{{ $post->user_id }}">
                                                Send Friendship Request
                                            </a>
                                        </div>
                                    @elseif ($post->friend_status == 'sent' || $post->friend_status == 'accepted')
                                        <div class="friendship-button pending_friend generic-button">
                                            <a type="button" data-action="remove" onclick="ManageFriendRequest(this)"
                                                class="friendship-button pending_friend remove"
                                                id="friend-{{ $post->user_id }}">
                                                Cancel Friendship Request
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endif


            {{-- POST ACTION BUTTONS --}}
            <div class="activity-meta action">

                <div class="generic-button">
                    <a class="button acomment-reply bp-primary-action bp-tooltip show-comments-btn"
                        data-comments-count="{{ $topLevelCommentsCount }}" data-post-id="{{ $post->post_id }}">
                        <span>{{ $topLevelCommentsCount }} Comments</span>
                    </a>
                </div>

                <div class="generic-button">
                    <a type="button" data-id="post-{{ $post->post_id }}"
                        class="button btnMarkFavorite fav bp-secondary-action {{ $markedFavorite ? 'unlike' : 'like' }}">
                        <span>{{ $markedFavorite ? 'Remove Marked' : 'Mark as Favorite' }}</span>
                    </a>
                </div>

                @if (Auth::user()->user_id == $post->postUploadedBy->user_id || Auth::user()->user_type == USER_TYPE_ADMIN)
                    <div class="generic-button">
                        <a type="button" data-id="post-{{ $post->post_id }}"
                            class="button delPost fav bp-secondary-action">
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

        </div> {{-- END activity-content --}}


        {{-- COMMENTS SECTION --}}
        <div class="activity-comments post-comments" id="comments-{{ $post->post_id }}" style="display:none;">

            <ul class="comment-list">
                @foreach ($topLevelComments as $comment)
                    @include('partials.comment_item', ['comment' => $comment, 'depth' => 0])
                @endforeach
            </ul>

            {{-- COMMENT FORM --}}
            <form action="{{ route('comments.store') }}" method="POST" class="add-comment-form">
                @csrf

                <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                <input type="hidden" name="parent_comment_id" value="">

                <div class="ac-reply-avatar">
                    <img loading="lazy"
                        src="{{ asset(Auth::user()->profile_picture ?? 'assets/images/default.png') }}"
                        class="avatar avatar-50 photo" width="50" height="50" />
                </div>

                <div class="ac-reply-content">
                    <div class="ac-textarea">
                        <input type="text" class="ac-input" name="content" placeholder="Write a comment..."
                            required />
                    </div>

                    <input type="submit" value="Post Comment" class="mt-3">
                    <button type="reset" class="ac-reply-cancel">Cancel</button>
                </div>
            </form>

        </div>

    </li>
@endforeach
