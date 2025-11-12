@foreach ($posts as $post)
    @php
        $topLevelComments = $post->comments->where('parent_comment_id', null);
        $topLevelCommentsCount = $topLevelComments->count();
    @endphp
    <li class="activity-item animate-item slideInUp" data-id="{{ $post->post_id }}">
        <div class="activity-avatar item-avatar">
            <a href="#">
                <img src="{{ asset($post->postUploadedBy->profile_picture ?? 'assets/images/default.png') }}"
                    width="50" height="50" class="avatar user-7-avatar avatar-200 photo"
                    alt="User Profile Picture" />
            </a>
        </div>

        <div class="activity-content">
            <div class="activity-header">
                <p><strong>{{ $post->postUploadedBy->name ?? 'Unknown User' }}</strong>
                    @if ($post->new_joining_post == NEW_JOINING_USER_POST)
                        became a registered member
                    @endif
                </p>
                <div class="date mute">{{ $post->created_at->diffForHumans() }}</div>
            </div>

            @if ($post->new_joining_post != NEW_JOINING_USER_POST)
                <div class="activity-inner">
                    <p>{{ $post->description }} </p>

                    @if ($post->postMedia && $post->postMedia->count())
                        <div class="post-media">
                            <div class="row">
                                @foreach ($post->postMedia as $media)
                                    <div class="col-sm-6">
                                        @if ($media->media_type === 'image')
                                            <img src="{{ asset($media->file_path) }}" width="300" alt="Post image" />
                                        @elseif($media->media_type === 'video')
                                            <video width="300" controls>
                                                <source src="{{ asset($media->file_path) }}" type="video/mp4" />
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="activity-meta action">
                        <div class="generic-button">
                            <a class="button acomment-reply bp-primary-action bp-tooltip show-comments-btn"
                                data-bp-tooltip="Comment" role="button"
                                data-comments-count="{{ $topLevelCommentsCount }}" data-post-id="{{ $post->post_id }}">
                                <span>{{ $topLevelCommentsCount }} Comments</span>
                            </a>
                        </div>
                        @php
                            $markedFavorite = $post->getMarkedFavorite->contains('user_id', Auth::user()->user_id);
                        @endphp
                        <div class="generic-button">
                            <a type="button" data-id="post-{{ $post->post_id }}" class="button btnMarkFavorite fav bp-secondary-action {{ $markedFavorite ? 'unlike' : 'like' }} bp-tooltip"
                                data-bp-tooltip="Mark as Favorite">
                                <span>{{ $markedFavorite ? "Remove Marked" : "Mark as Favorite"  }}</span>
                            </a>
                        </div>
                        @if (Auth::user()->user_id == $post->postUploadedBy->user_id)
                            <div class="generic-button">
                                <a type="button" data-id="post-{{ $post->post_id }}" class="button delPost fav bp-secondary-action bp-tooltip"
                                    data-bp-tooltip="Delete">
                                    <span>Delete</span>
                                </a>
                            </div>
                        @endif
                        @php
                            $userLiked = $post->getLikedBy->contains('user_id', Auth::user()->user_id);
                        @endphp
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
                <!-- Your existing new member code -->
                <div class="kmk-mini-activity member">
                    <!-- ... existing code ... -->
                </div>
            @endif
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
                    <img loading="lazy" src="{{ asset(Auth::user()->profile_picture ?? 'assets/images/default.png') }}"
                        class="avatar user-{{ Auth::user()->user_id }}-avatar avatar-50 photo" width="50"
                        height="50" alt="Profile picture of {{ Auth::user()->name }}">
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
                    <button type="button" class="ac-reply-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </li>
@endforeach
