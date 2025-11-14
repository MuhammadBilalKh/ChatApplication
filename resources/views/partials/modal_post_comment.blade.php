<div class="rtmedia-comment-user-pic clearfix">
    <a href="{{ route('users.profile', ['id' => $comment->commentPostedBy->user_id ?? 0]) }}"
        title="{{ $comment->commentPostedBy->name ?? 'User' }}">
        <img loading="lazy" src="{{ asset($comment->commentPostedBy->profile_picture ?? 'assets/images/default.png') }}"
            class="avatar user-{{ $comment->commentPostedBy->user_id ?? 'unknown' }}-avatar avatar-90 photo"
            width="90" height="90" alt="Profile Photo">
    </a>
</div>
<div class="rtm-comment-wrap">
    <div class="rtmedia-comment-details">
        <span class="rtmedia-comment-author">
            <a href="{{ route('users.profile', ['id' => $comment->commentPostedBy->user_id ?? 0]) }}"
                title="{{ $comment->commentPostedBy->name ?? 'User' }}">
                {{ $comment->commentPostedBy->username ?? 'Unknown User' }}
            </a>
        </span>
        <span class="rtmedia-comment-date">
            {{ $comment->created_at ? $comment->created_at->diffForHumans() : '' }}
        </span>
        <div class="rtmedia-comment-content">
            <p>{{ $comment->comment_text }}</p>
        </div>
        <div class="rtmedia-comment-extra"></div>
        @if (Auth::user()->user_id === ($comment->commented_by ?? null))
            <i data-id="{{ $comment->comment_id }}" class="rtmedia-delete-comment dashicons dashicons-no-alt"
                title="Delete Comment"></i>
        @endif
        <div class="clear"></div>
    </div>
    @if (isset($comment->replies) && $comment->replies->count())
        <ul class="rtm-comment-list child-comment-list">
            @foreach ($comment->replies as $reply)
                <li class="rtmedia-comment">
                    @include('partials.modal_post_comment', ['comment' => $reply])
                </li>
            @endforeach
        </ul>
    @endif
</div>
