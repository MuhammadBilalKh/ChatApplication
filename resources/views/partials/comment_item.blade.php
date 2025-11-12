<li class="comment-item comment-container" id="comment-{{ $comment->comment_id }}"
    data-comment-id="{{ $comment->comment_id }}" style="margin-left: {{ $depth * 30 }}px;">

    <div class="acomment-avatar item-avatar">
        <a href="#">
            <img loading="lazy" src="{{ asset($comment->commentPostedBy->profile_picture ?? 'assets/images/default.png') }}"
                class="avatar user-2-avatar avatar-50 photo" width="50" height="50"
                alt="Profile picture of {{ $comment->commentPostedBy->username }}">
        </a>
    </div>

    <div class="acomment-meta">
        <a href="#">{{ $comment->commentPostedBy->username }}</a>
        <span class="activity-time-since">
            <time class="time-since" datetime="{{ $comment->created_at }}">
                {{ $comment->created_at->diffForHumans() }}
            </time>
        </span>
    </div>

    <div class="acomment-content">
        <p>{{ $comment->comment_text }}</p>
    </div>

    <div class="activity-meta action">
        <div class="generic-button">
            <a class="acomment-reply bp-primary-action show-reply-form-btn"
               href="#"
               data-comment-id="{{ $comment->comment_id }}">
                Reply
            </a>
        </div>

        @if ($comment->commentPostedBy->user_id == Auth::user()->user_id)
            <div class="generic-button">
                <a class="delete acomment-delete confirm bp-secondary-action"
                   href="#"
                   data-comment-id="{{ $comment->comment_id }}">
                    Delete
                </a>
            </div>
        @endif
    </div>

    <!-- Reply Form (Hidden by default) -->
    <form action="{{ route('comments.store') }}" method="POST" class="add-reply-form" style="display: none;">
        @csrf
        <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
        <input type="hidden" name="parent_comment_id" value="{{ $comment->comment_id }}">

        <div class="ac-reply-avatar">
            <img loading="lazy" src="{{ asset(Auth::user()->profile_picture ?? 'assets/images/default.png') }}"
                class="avatar user-{{ Auth::user()->user_id }}-avatar avatar-50 photo" width="50" height="50"
                alt="Profile picture of {{ Auth::user()->name }}">
        </div>

        <div class="ac-reply-content">
            <div class="ac-textarea">
                <input type="text" class="ac-input bp-suggestions" name="content"
                          placeholder="Write a reply..." spellcheck="false" required />
            </div>
            <input type="submit" value="Post Reply">
            <button type="button" class="ac-reply-cancel">Cancel</button>
        </div>
    </form>

    <!-- Nested Replies -->
    @if($comment->replies && $comment->replies->count() > 0)
        <ul class="reply-list">
            @foreach($comment->replies as $reply)
                @include('partials.comment_item', ['comment' => $reply, 'depth' => $depth + 1])
            @endforeach
        </ul>
    @endif
</li>
