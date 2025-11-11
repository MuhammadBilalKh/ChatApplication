@foreach ($posts as $post)
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
                            <a class="button acomment-reply bp-primary-action bp-tooltip" data-bp-tooltip="Comment"
                                role="button">
                                <span>{{ $post->comments_count }} Comments</span>
                            </a>
                        </div>
                        <div class="generic-button">
                            <a href="#" class="button fav bp-secondary-action bp-tooltip"
                                data-bp-tooltip="Mark as Favorite">
                                <span>Favorite</span>
                            </a>
                        </div>
                        <div class="generic-button kmk-like">
                            <a href="#" class="button bp-primary-action like">
                                <i class="uil-thumbs-up"></i>
                                <span class="like-text">{{ $post->likes_count }} Like</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="kmk-mini-activity member">
                    <div class="mini-activity-inner">
                        <div class="mini-cover"
                            style="background-image: url('{{ asset('assets/images/default-cover.png') }}')">
                        </div>
                        <div class="mini-content">
                            <div class="mini-avatar">
                                <a href="#">
                                    <img loading="lazy"
                                        src="{{ asset($post->postUploadedBy->profile_picture ?? 'assets/images/default.png') }}"
                                        class="avatar user-1-avatar avatar-200 photo" width="200" height="200"
                                        alt="Profile Photo" />
                                </a>
                            </div>
                            <div class="mini-info">
                                <h5 class="mini-title">
                                    <a href="#"
                                        class="ellipsis">{{ $post->postUploadedBy->username ?? 'Unknown' }}</a>
                                </h5>
                                <div class="mini-meta">
                                    <span class="ellipsis">
                                        <i class="uil-at"></i>{{ $post->postUploadedBy->username ?? 'unknown' }}
                                    </span>
                                </div>
                            </div>
                            <div class="mini-actions">
                                <div class="friendship-button generic-button">
                                    @if (Auth::user()->user_id != $post->postUploadedBy->user_id)
                                        @if ($post->friend_status === 'none')
                                            <a href="#" id="member-{{ $post->postUploadedBy->user_id }}"
                                                onclick="SendFriendRequest({{ $post->postUploadedBy->user_id }})"
                                                class="friendship-button add" title="Add Friend">Add Friend</a>
                                        @elseif ($post->friend_status === 'sent')
                                            <a href="#" id="member-{{ $post->postUploadedBy->user_id }}"
                                                onclick="CancelFriendRequest({{ $post->postUploadedBy->user_id }})"
                                                class="friendship-button remove" title="Cancel Request">Requested</a>
                                        @elseif ($post->friend_status === 'received')
                                            <a href="#" id="member-{{ $post->postUploadedBy->user_id }}"
                                                onclick="AcceptFriendRequest({{ $post->postUploadedBy->user_id }})"
                                                class="friendship-button add" title="Accept Request">Accept</a>
                                        @elseif ($post->friend_status === 'friends')
                                            <a href="#" class="friendship-button remove"
                                                title="Unfriend">Friends</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="activity-comments">
            <ul>
                @foreach ($post->comments as $key => $value)
                    <li id="acomment-{{ $value->comment_id }}" class="comment-item"
                        data-bp-activity-comment-id="{{ $value->comment_id }}">
                        <div class="acomment-avatar item-avatar">
                            <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/sandlas/">
                                <img loading="lazy" src="{{ asset(Auth::user()->profile_picture) }}"
                                    class="avatar user-2-avatar avatar-50 photo" width="50" height="50"
                                    alt="Profile picture of {{ Auth::user()->username }}"> </a>
                        </div>

                        <div class="acomment-meta">

                            <a
                                href="https://www.clientbetalink.xyz/MIGVELv1/members-2/sandlas/">{{ $value->commentPostedBy->username }}</a>
                            replied <a href="https://www.clientbetalink.xyz/MIGVELv1/activity-2/p/30/#acomment-51"
                                class="activity-time-since"><time class="time-since" datetime="2025-11-05 17:05:59"
                                    data-bp-timestamp="1762362359">{{ $value->created_at->diffForHumans() }}</time></a>
                        </div>

                        <div class="acomment-content">
                            <p>{{ $value->comment_text }}</p>
                        </div>

                        <div class=" activity-meta action">
                            <div class="generic-button"><a class="acomment-reply bp-primary-action"
                                    id="acomment-reply-30-from-{{ $value->comment_id }}" href="#acomment-51">Reply</a>
                            </div>
                            @if ($value->commentPostedBy->user_id == Auth::user()->user_id)
                                <div class="generic-button"><a
                                        class="delete acomment-delete confirm bp-secondary-action" rel="nofollow"
                                        href="https://www.clientbetalink.xyz/MIGVELv1/activity-2/delete/51/?cid=51&amp;_wpnonce=386f661e3c">Delete</a>
                            @endif
                        </div>
        </div>
    </li>
@endforeach
</ul>
<form action="{{ route('comments.store', ['post' => $post->post_id]) }}" method="post"
    id="ac-form-{{ $post->post_id }}" class="ac-form root" style="display: block;">
    @csrf
    <div class="ac-reply-avatar">
        <img loading="lazy" src="{{ asset(Auth::user()->profile_picture ?? 'assets/images/default.png') }}"
            class="avatar user-{{ Auth::user()->user_id }}-avatar avatar-50 photo" width="50" height="50"
            alt="Profile picture of {{ Auth::user()->name }}">
    </div>
    <div class="ac-reply-content">
        <div class="ac-textarea">
            <label for="ac-input-{{ $post->post_id }}" class="bp-screen-reader-text">
                Comment
            </label>
            <textarea id="ac-input-{{ $post->post_id }}" class="ac-input bp-suggestions" name="comment" spellcheck="false"
                aria-label="To enrich screen reader interactions, please activate Accessibility in Grammarly extension settings"></textarea>
        </div>
        <input type="hidden" name="comment_form_id" value="{{ $post->post_id }}">
        <input type="submit" name="ac_form_submit" value="Post">
        <button type="button" class="ac-reply-cancel" onclick="this.closest('form').reset()">Cancel</button>
    </div>
</form>
</div>
</li>
@endforeach
