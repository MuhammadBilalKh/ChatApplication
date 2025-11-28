@foreach ($posts as $post)
    @php
        $topLevelComments = $post->comments->where('parent_comment_id', null);
        $topLevelCommentsCount = $topLevelComments->count();
        $markedFavorite = $post->getMarkedFavorite->contains('user_id', Auth::user()->user_id);
        $userLiked = $post->getLikedBy->contains('user_id', Auth::user()->user_id);

        $hasMedia = $post->postMedia && $post->postMedia->count() > 0;
        $firstMedia = $hasMedia ? $post->postMedia->first() : null;

        $imageCount = $hasMedia ? $post->postMedia->where('media_type', 'image')->count() : 0;
        $videoCount = $hasMedia ? $post->postMedia->where('media_type', 'video')->count() : 0;
@endphp

    <li class="activity-item animate-item slideInUp" data-id="{{ $post->group_post_id }}">

        <div class="activity-avatar item-avatar">
            <a href="#">
                <img src="{{ asset($post->postCreatedBy->profile_picture ?? 'assets/images/default.png') }}"
                    width="50" height="50" class="avatar user-7-avatar avatar-200 photo"
                    alt="User Profile Picture" />
            </a>
        </div>

        <div class="activity-content">

            <div class="activity-header">
                <div class="posted-meta">
                    <p>
                        <a href="{{ route('users.profile') }}" class="h5">
                            {{ $post->postCreatedBy->username }}
                        </a>
                    </p>

                    <div class="date mute">{{ $post->created_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="activity-inner">

                @if ($post->description)
                    <p class="post-text">{{ $post->description }}</p>
                @endif

                @if ($hasMedia)
                    <div class="post-media mt-2">
                        <div class="row postContentModal" data-post-id="{{ $post->group_post_id }}" data-fancybox
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

                            <div class="col-sm-6 mt-2 d-flex align-items-center">
                                <span class="media-count badge">
                                    @if ($imageCount > 0)
                                        {{ $imageCount }} {{ Str::plural('Image', $imageCount) }}
                                    @endif

                                    @if ($videoCount > 0)
                                        @if ($imageCount > 0)
                                            ,
                                        @endif
                                        {{ $videoCount }} {{ Str::plural('Video', $videoCount) }}
                                    @endif
                                </span>
                            </div>

                        </div>
                    </div>
                @endif

            </div>

            <!-- ACTION BUTTONS -->
            <div class="activity-meta action">

                <div class="generic-button">
                    <a class="button acomment-reply bp-primary-action bp-tooltip show-comments-btn"
                        data-comments-count="{{ $topLevelCommentsCount }}" data-post-id="{{ $post->group_post_id }}">
                        <span>{{ $topLevelCommentsCount }} Comments</span>
                    </a>
                </div>

                <div class="generic-button">
                    <a type="button" data-id="post-{{ $post->group_post_id }}"
                        class="button btnMarkFavorite fav bp-secondary-action {{ $markedFavorite ? 'unlike' : 'like' }}">
                        <span>{{ $markedFavorite ? 'Remove Marked' : 'Mark as Favorite' }}</span>
                    </a>
                </div>

                @if (Auth::user()->user_id == $post->postCreatedBy->user_id)
                    <div class="generic-button">
                        <a type="button" data-id="post-{{ $post->group_post_id }}"
                            class="button delPost fav bp-secondary-action">
                            <span>Delete</span>
                        </a>
                    </div>
                @endif

                <div class="generic-button kmk-like">
                    <a type="button" id="post-{{ $post->group_post_id }}" data-id="post-{{ $post->group_post_id }}"
                        class="button btnLikeUnlike bp-primary-action {{ $userLiked ? 'unlike' : 'like' }}">
                        <i
                            class="{{ $userLiked ? 'uil-thumbs-down' : 'uil-thumbs-up' }} post-{{ $post->group_post_id }}"></i>
                        <span class="like-text">{{ count($post->getLikedBy) }} Like</span>
                    </a>
                </div>

            </div>

        </div>

        <div class="activity-comments post-comments" id="comments-{{ $post->group_post_id }}" style="display:none;">

            <ul class="has-comments">
                @foreach ($topLevelComments as $comment)
                    @include('users.profile.groups.comment_item', ['comment' => $comment, 'depth' => 0])
                @endforeach
            </ul>

            <form action="{{ route('group_comments.store', ['group' => $post->group_post_id]) }}" method="{{ FORM_METHOD_POST }}" class="add-comment-form">
                @csrf

                <input type="hidden" name="group_post_id" value="{{ $post->group_post_id }}" />
                <input type="hidden" name="parent_comment_id" value="" />

                <div class="ac-reply-avatar">
                    <img loading="lazy" src="{{ asset(Auth::user()->profile_picture ?? 'assets/images/default.png') }}"
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
