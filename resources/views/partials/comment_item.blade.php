@push('css')
    <style>
        .edit-comment-form {
            margin-top: 10px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .edit-actions {
            margin-top: 10px;
        }

        .edit-actions input[type="submit"] {
            background: #007cba;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px;
        }

        .edit-actions .cancel-edit {
            background: #6c757d;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 3px;
            cursor: pointer;
        }

        .edit-actions input[type="submit"]:hover {
            background: #005a87;
        }

        .edit-actions .cancel-edit:hover {
            background: #545b62;
        }

        .edited-text {
            color: #6c757d;
            font-style: italic;
            font-size: 0.9em;
        }

        .comment-content p {
            margin: 0;
            word-wrap: break-word;
        }
    </style>
@endpush

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
            @if ($comment->updated_at != $comment->created_at)
                <span class="edited-text">(edited)</span>
            @endif
        </span>
    </div>

    <div class="acomment-content" id="comment-content-{{ $comment->comment_id }}">
        <p>{{ $comment->comment_text }}</p>
    </div>

    <!-- Edit Comment Form (Hidden by default) -->
    @if ($comment->commentPostedBy->user_id == Auth::user()->user_id)
        <form action="{{ route('comments.update', $comment->comment_id) }}" method="POST" class="edit-comment-form"
            id="edit-form-{{ $comment->comment_id }}" style="display: none;" data-comment-id="{{ $comment->comment_id }}">
            @csrf
            @method('PUT')
            <div class="ac-reply-content">
                <div class="ac-textarea">
                    <input class="ac-input form-control bp-suggestions edit-comment-text" value="{{ $comment->comment_text }}" name="content" spellcheck="false" required />
                </div>
                <div class="edit-actions">
                    <input type="submit" class="mt-3" value="Update">
                    <button type="button" class="cancel-edit">Cancel</button>
                </div>
            </div>
        </form>
    @endif

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
                <a class="acomment-edit bp-primary-action edit-comment-btn"
                   href="#"
                   data-comment-id="{{ $comment->comment_id }}">
                    Edit
                </a>
            </div>
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
            <input type="submit" class="mt-3" value="Post Reply">
            <button type="button" id="btnCancel" class="ac-reply-cancel">Cancel</button>
        </div>
    </form>

    <!-- Nested Replies -->
    @if ($comment->replies && $comment->replies->count() > 0)
        <ul class="reply-list">
            @foreach ($comment->replies as $reply)
                @include('partials.comment_item', ['comment' => $reply, 'depth' => $depth + 1])
            @endforeach
        </ul>
    @endif
</li>
