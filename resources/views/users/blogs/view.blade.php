@extends('layout.master.main')

@section('title', 'Post detail')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Post detail',
    ])
@endsection

@section('dashboard-content')

@if(session()->has('success'))
<div class="alert alert-success">
    <span>{{ session()->get('success') }}</span>
</div>

@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $key => $value)
                <li>{{ $value }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="entry-header">

        <div class="post-author">
            <span class="author-link">By: <a href="{{ route('users.profile') }}"
                    title="Posts by {{ $blogData->blogPostedBy->username }}"
                    rel="author">{{ $blogData->blogPostedBy->username }}</a>
            </span>
        </div>

        <div class="entry-title">
            <h1 class="title h1">{{ $blogData->title }}</h1>
        </div>
    </div>

    <div class="entry-meta">

        <span class="link date-links"><i class="uil-tag-alt"></i>

            @foreach ($categories as $key => $category)
                <a type="button">{{ $category }}</a>,
            @endforeach
        </span>

        <span class="link tags-links"><i class="uil-tag-alt"></i>

            @foreach ($tags as $key => $value)
                <a type="button">{{ $value }}</a>,
            @endforeach
        </span>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            @forelse ($blogData->getBlog as $key => $value)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ asset('/storage/' . $value->file_path) }}" alt="Slide">
                </div>
            @empty
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('/storage/' . $blogData->featured_image) }}" alt="Slide">
                </div>
            @endforelse

        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container-fluid mt-3">
        {!! $blogData->content !!}
    </div>

    <div id="comments" class="comments-area animate-item slideInUp"
        style="visibility: visible; animation-name: slideInUp;">

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
                                <img alt="" src="{{ asset( $value->commentPostedBy->profile_picture) }}"
                                    class="avatar avatar-50 photo" height="50" width="50" decoding="async"> <b
                                    class="fn"><a href="https://mythemestore.com/beehive-preview/members/user/"
                                        class="url" rel="ugc">{{ $value->commentPostedBy->username }}</a></b> <span
                                    class="says">says:</span>
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

            {{ $comments->links() }}
        </div>

        <div id="comments" class="comments-area animate-item slideInUp">

            <div id="respond" class="comment-respond">
                <div class="block-title">
                    <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow"
                                id="cancel-comment-reply-link"
                                href="./MIGVELv1/top-10-fruits-to-make-healthier-and-happier/#respond"
                                style="display:none;">Cancel reply</a></small></h3>
                </div>
                <form action="{{ route('blogs.post_comment') }}" method="{{ FORM_METHOD_POST }}" id="kmk-comment-form" class="comment-form">
                    @csrf
                    <p class="comment-form-comment"><label for="comment">Comment <span class="required">*</span></label>
                        <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea>
                    </p>
                    <input type="hidden" name="blog_id" value="{{ $blogData->user_blog_id }}" />
                    <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit"
                            value="Post Comment" /> <input type='hidden' name='comment_post_ID' value='247'
                            id='comment_post_ID' />
                        <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
                    </p>
                </form>
            </div>

        </div>

        <div class="post-navigation animate-item slideInUp">
            <div class="wrapper">
                @if (isset($previousBlog))
                    <div class="previous-post">
                        <div class="prev">
                            <a href="{{ route('blogs.view', ['id' => $previousBlog->user_blog_id]) }}"
                                rel="prev"><span class="nav-icon"><i class="icon ion-ios-arrow-back"></i></span>
                                <h5 class="post-nav-label">Prev post</h5>
                            </a>
                        </div>
                    </div>
                @endif
                @if (isset($nextBlog))
                    <div class="next-post">
                        <div class="next">
                            <a href="{{ route('blogs.view', ['id' => $nextBlog->user_blog_id]) }}" rel="next"><span
                                    class="nav-icon"><i class="icon ion-ios-arrow-right"></i></span>
                                <h5 class="post-nav-label">Next post</h5>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if (Auth::user()->user_type == USER_TYPE_ADMIN &&
                $blogData->user_id != Auth::user()->user_id &&
                $blogData->status == BLOG_STATUS_DRAFT)
            <div class="post-navigation animate-item slideInUp">
                <form action="{{ route('blogs.manage_blog_status') }}" method="{{ FORM_METHOD_POST }}">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blogData->user_blog_id }}">
                    <button type="submit" name="status" value="1" class="btn btn-success">Published</button>
                    <button type="submit" name="status" value="0" class="btn btn-danger">Discard</button>
                </form>
            </div>
        @endif

    @endsection

    @push('script')
        <script src="{{ asset('assets/js/bootstrap_carousel.min.js') }}"></script>
        <script>
            jQuery(document).ready(function(){
                jQuery(".alert").delay(2500).fadeOut();
            });
        </script>
        @endpush
