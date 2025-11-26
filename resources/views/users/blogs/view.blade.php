@extends('layout.master.main')

@section('title', 'Post detail')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Post detail',
    ])
@endsection

@section('dashboard-content')

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

    @include('users.blogs.blog_comments', ['blogData' => $blogData])

    <div id="comments" class="comments-area animate-item slideInUp">

        <div id="respond" class="comment-respond">
            <div class="block-title">
                <h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow"
                            id="cancel-comment-reply-link"
                            href="./MIGVELv1/top-10-fruits-to-make-healthier-and-happier/#respond"
                            style="display:none;">Cancel reply</a></small></h3>
            </div>
            <form action="./wp-comments-post.php" method="post" id="kmk-comment-form" class="comment-form">
                <p class="comment-notes"><span id="email-notes">Your email address will
                        not be published.</span> <span class="required-field-message">Required fields are marked <span
                            class="required">*</span></span></p>
                <p class="comment-form-comment"><label for="comment">Comment <span class="required">*</span></label>
                    <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea>
                </p>
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
                        <a href="{{ route('blogs.view', ['id' => $previousBlog->user_blog_id]) }}" rel="prev"><span
                                class="nav-icon"><i class="icon ion-ios-arrow-back"></i></span>
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
@endpush
