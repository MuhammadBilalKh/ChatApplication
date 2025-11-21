<div class="@if(Route::currentRouteName() == "blogs.list") col-lg-12 @else col-lg-4 @endif col-aside">
    <aside id="default_sidebar" class="widget-area sidebar-widget-area sticky-sidebar">
        <div id="search-1" class="widget widget_search">
            <form role="search" method="get" class="search-form form-inline" action="./">
                <div class="search-field">
                    <input type="text" name="s" placeholder="Search..." value="" />
                </div>
                <div class="search-button">
                    <button type="submit" class="search-submit"><i class="uil-search-alt"></i></button>
                </div>
            </form>

        </div>

        @if (View::hasSection('dashboard-extra-rightpanel'))
            @yield('dashboard-extra-rightpanel')
        @endif

        <div id="recent-posts-1" class="widget widget_recent_entries">
            <h5 class="widget-title">Recent Posts</h5>
            <ul id="recentPosts">
                @forelse ($recent_blogs as $key => $value)
                    <li>{{ $value->title }}</li>
                    @empty
                        <li>No Published Blogs.</li>
                @endforelse
            </ul>
        </div>
        <div id="recent-comments-1" class="widget widget_recent_comments">
            <h5 class="widget-title">Recent Comments</h5>
            <ul id="recentcomments">
                <li class="recentcomments"><span class="comment-author-link">Sandlas</span>
                    on <a href="./stock-market/#comment-10">Stock
                        Market</a></li>
                <li class="recentcomments"><span class="comment-author-link">Sandlas</span>
                    on <a href="./stock-market/#comment-9">Stock
                        Market</a></li>
                <li class="recentcomments"><span class="comment-author-link">Sandlas</span>
                    on <a href="./stock-market/#comment-8">Stock
                        Market</a></li>
                <li class="recentcomments"><span class="comment-author-link">Sandlas</span>
                    on <a href="./stock-market/#comment-7">Stock
                        Market</a></li>
                <li class="recentcomments"><span class="comment-author-link">Sandlas</span>
                    on <a href="./stock-market/#comment-6">Stock
                        Market</a></li>
            </ul>
        </div>
        <div id="archives-1" class="widget widget_archive">
            <h5 class="widget-title">Archives</h5>
            <ul>
                <li><a href='./2025/10/'>October
                        2025</a></li>
                <li><a href='./2020/01/'>January
                        2020</a></li>
            </ul>

        </div>
        <div id="categories-1" class="widget widget_categories">
            <h5 class="widget-title">Categories</h5>
            <ul>
                @forelse ($categories as $key => $value)
                    <li class="cat-item cat-item-47"><a type="button"
                            data-id="category-{{ $value->category_id }}">{{ $value->category_title }}</a>

                    </li>
                @empty
                    <li class="cat-item cat-item-47"><a type="button">No Categories Found</a>
                    </li>
                @endforelse
            </ul>

        </div>
        <div id="meta-1" class="widget widget_meta">
            <h5 class="widget-title">Meta</h5>
            <ul>
                <li><a href="./register/">Register</a>
                </li>
                <li><a href="{{ route('users.authenticate') }}">Log
                        in</a></li>
                <li><a href="./feed/">Entries feed</a>
                </li>
                <li><a href="./comments/feed/">Comments
                        feed</a></li>

                <li><a href="https://wordpress.org/">WordPress.org</a></li>
            </ul>

        </div>
        <nav class="sidebar-nav-menu">
            <ul id="menu-sidebar-menu" class="aside-navbar">
                <li id="menu-item-456"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-456">
                    <a href="./">Home</a>
                </li>
                <li id="menu-item-114" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-114">
                    <a href="./about-us/">About Us</a>
                </li>
                <li id="menu-item-113" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-113">
                    <a href="./faqs/">FAQs</a>
                </li>
                <li id="menu-item-116" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-116">
                    <a href="./blog/">Blog</a>
                </li>
                <li id="menu-item-112" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112">
                    <a href="./contact/">Contact</a>
                </li>
            </ul>
        </nav>
    </aside>
</div>
