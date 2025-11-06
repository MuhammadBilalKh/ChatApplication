@foreach ($posts as $post)
    <li class="activity-item animate-item slideInUp" data-id="{{ $post->post_id }}">
        <div class="activity-avatar item-avatar">
            <a href="#">
                <img src="{{ asset($post->postUploadedBy->profile_picture ?? 'assets/images/default.png') }}"
                    width="50" height="50" class="avatar user-7-avatar avatar-200 photo" alt="User Profile Picture" />
            </a>
        </div>

        <div class="activity-content">
            <div class="activity-header">
                <p><strong>{{ $post->postUploadedBy->name ?? 'Unknown User' }}</strong> @if ($post->new_joining_post == NEW_JOINING_USER_POST)
                    became a registered member
                @endif</p>
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
                                    <a href="#" class="friendship-button add" title="Add Friend">Add Friend</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </li>
@endforeach
