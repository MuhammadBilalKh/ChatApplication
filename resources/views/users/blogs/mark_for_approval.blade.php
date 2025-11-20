@extends('layout.master.main')

@section('title', 'Mark For Approval')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Mark For Approval',
    ])
@endsection

@section('dashboard-content')
    <nav class="nav-component">
        <ul id="menu-adverts-menu" class="nav-component-list advert-navbar">
            <li id="menu-item-118"
                class="menu-item menu-item-type-post_type current-menu-item current_page_item menu-item-object-page menu-item-118">
                <a href="{{ route('blogs.list', ['type' => 'list-blog']) }}">Blogs</a>
            </li>

            <li id="menu-item-119" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                <a href="{{ route('blogs.list', ['type' => 'create-blog']) }}">Submit</a>
            </li>

            @if (Auth::user()->user_type == USER_TYPE_USER)
                <li id="menu-item-119" class="menu-item menu-item-type-post_type current-menu-item current_page_item menu-item-object-page menu-item-119">
                    <a href="{{ route('blogs.list', ['type' => 'mark-approval-blog']) }}">Mark For Approval</a>
                </li>

                <li id="menu-item-119" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                    <a href="{{ route('blogs.list', ['type' => 'manage-blog-approval']) }}">Approve / Reject Blog</a>
                </li>
            @endif

            @if (Auth::user()->user_type == USER_TYPE_ADMIN)
                <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                    <a type="button">Pending For Approval</a>
                </li>
            @endif
        </ul>
    </nav>

    <div class="kmk-post-container blog-layout-grid masonry grid-columns-2">

        @forelse ($pendingBlogs as $key => $value)
            <article id="post-1"
                class="post-259 post type-post status-publish format-standard has-post-thumbnail hentry category-technology tag-marketing kmk-post">
                <div class="entry-wrapper">
                    <div class="entry-thumbnail">

                        <div class="post-medias">
                            <div class="item-media">
                                <a href="#"
                                    style="background-image: url({{ asset('/storage/' . $value->getBlog[0]->file_path) }});"></a>

                            </div>
                        </div>
                    </div>
                    <div class="entry-content">
                        <div class="entry-meta">
                            <span class="link date-links">
                                <a type="button">{{ $value->published_at }}</a>
                            </span>
                        </div>
                        <h4 class="entry-title"><a href="#" rel="bookmark">{{ $value->title }}</a></h4>
                        <div class="entry-excerpt">
                            <p>
                                {!! \Illuminate\Support\Str::limit($value->content, 50) !!}... </p>
                        </div>
                        <div class="read-more">
                            <a href="{{ route('blogs.view', ['id' => $value->user_blog_id]) }}" class="text-info">View Blog</a>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <h3 class="text-center container text-danger">No Blogs Found</h3>
        @endforelse

    </div>

    {{ $pendingBlogs->links() }}
@endsection
