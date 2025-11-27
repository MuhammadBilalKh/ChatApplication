<div id="comments" class="comments-area animate-item slideInUp" style="visibility: visible; animation-name: slideInUp;">

    <div class="block-title">
        <h3 class="comments-title">
            {{ $totalComments }} Comments </h3>
    </div>

    <div class="comment-list">
        @forelse ($comments as $key => $value)
            <div id="comment-223" class="comment byuser comment-author-user even thread-even depth-1">
                <article id="div-comment-223" class="comment-body">
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <img alt=""
                                src="{{ asset("/storage/".$value->commentPostedBy->profile_picture) }}"
                                class="avatar avatar-50 photo" height="50" width="50" decoding="async"> <b
                                class="fn"><a href="https://mythemestore.com/beehive-preview/members/user/"
                                    class="url" rel="ugc">{{ $value->commentPostedBy->username }}</a></b> <span class="says">says:</span>
                        </div>

                        <div class="comment-metadata">
                            <a
                                href="https://mythemestore.com/beehive-preview/10-recipes-you-can-try-at-home-anytime/#comment-223"><time
                                    datetime="2020-10-06T16:51:51+00:00">{{ $value->created_at->diffForHumans() }}</time></a>
                        </div>

                    </footer>

                    <div class="comment-content">
                        <p>{{ $value->comment_text }}</p>
                    </div>

                    {{-- <div class="reply"><a rel="nofollow" class="comment-reply-link"
                            href="https://mythemestore.com/beehive-preview/10-recipes-you-can-try-at-home-anytime/?replytocom=223#respond"
                            data-commentid="223" data-postid="253" data-belowelement="div-comment-223"
                            data-respondelement="respond" data-replyto="Reply to Froy"
                            aria-label="Reply to Froy">Reply</a>
                    </div> --}}
                </article>
            </div>
        @empty
            <div class="container">
                <p>No Comments Found</p>
            </div>
        @endforelse

</div>
