@extends('layout.master.main')

@section('title', 'Members')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', ['pageHeader' => 'Members'])
@endsection

@section('dashboard-content')
    <article id="post-0" class="post-0 page type-page status-publish hentry kmk-post">
        <div class="entry-content clearfix">
            <div id="kmkpress" class="kmkpress-wrap kmk bp-dir-hori-nav alignwide">

                <nav class="members-type-navs main-navs bp-navs dir-navs " role="navigation" aria-label="Directory menu">


                    <ul class="component-navigation members-nav">

                        <li id="members-all" class="selected" data-bp-scope="all" data-bp-object="members">
                            <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/">Active
                                Members&nbsp;<span class="count">{{ count($members) }}</span></a>
                        </li>


                    </ul><!-- .component-navigation -->


                </nav><!-- .bp-navs -->


                <div class="screen-content">

                    <div class="subnav-filters filters no-ajax" id="subnav-filters">

                        <div class="subnav-search clearfix">

                            <div class="dir-search members-search bp-search" data-bp-search="members">
                                <form action="{{ route('peoples.list') }}" method="{{ FORM_METHOD_GET }}" class="bp-dir-search-form" id="dir-members-search-form"
                                    role="search">

                                    <label for="dir-members-search" class="bp-screen-reader-text">Search
                                        Members...</label>

                                    <input id="dir-members-search" name="members_search" value="{{ request()->input('members_search') }}" type="search"
                                        placeholder="Search Members...">

                                    <button type="submit" id="dir-members-search-submit" class="nouveau-search-submit"
                                        name="dir_members_search_submit">
                                        <span class="dashicons dashicons-search" aria-hidden="true"></span>
                                        <span id="button-text" class="bp-screen-reader-text">Search</span>
                                    </button>

                                </form>
                            </div>

                        </div>

                        <div id="dir-filters" class="component-filters clearfix">
                            <div id="members-order-select" class="last filter">
                                <label class="bp-screen-reader-text" for="members-order-by">
                                    <span>Order By:</span>
                                </label>
                                <div class="select-wrap">
                                    <select id="members-order-by" data-bp-filter="members">
                                        <option value="">Select</option>
                                        <option value="active">Last Active</option>
                                        <option value="newest">Newest Registered
                                        </option>
                                        <option value="alphabetical">Alphabetical
                                        </option>

                                    </select>
                                    <span class="select-arrow" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="members-dir-list" class="members dir-list" data-bp-list="members" style="">

                        <ul id="members-list" class="item-list members-list bp-list grid two">

                            @foreach ($members as $key => $value)
                                <li class="item-entryanimate-itemslideInUp odd is-online is-current-user"
                                    data-bp-item-id="8" data-bp-item-component="members">
                                    <div class="list-wrap">

                                        <div class="item-avatar">
                                            <a href="#profile"><img
                                                    loading="lazy"
                                                    src="{{ asset(Auth::user()->profile_picture) }}"
                                                    class="avatar user-8-avatar avatar-200 photo" width="200"
                                                    height="200" alt="Profile picture of {{ Auth::user()->username }}"></a>
                                        </div>

                                        <div class="item">

                                            <div class="item-block">

                                                <h4 class="list-title member-name">
                                                    <a
                                                        href="https://www.clientbetalink.xyz/MIGVELv1/members-2/novipa/">{{ $value->username }}</a>
                                                </h4>

                                                <p class="item-meta last-activity mute">
                                                    {{ $value->created_at->diffForHumans() }} </p>

                                                <ul class="connections">
                                                    <li><span class="count">{{ count($value->getFriends) }}</span>
                                                        <p class="mute">Friends</p>
                                                    </li>
                                                    <li><span class="count">0</span>
                                                        <p class="mute">Groups</p>
                                                    </li>
                                                </ul>

                                                <p class="latest-update"></p>

                                                <ul class=" members-meta action">
                                                    <li class="generic-button"><a
                                                            href="#profile">My
                                                            Profile</a></li>
                                                </ul>
                                            </div>

                                        </div><!-- // .item -->

                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="bp-pagination bottom" data-bp-pagination="upage">

                            <div class="pag-count bottom">

                                <p class="pag-data">
                                    {{ $members->links() }} </p>

                            </div>


                        </div>



                    </div><!-- #members-dir-list -->

                </div><!-- // .screen-content -->

            </div><!-- #kmkpress -->
        </div><!-- .entry-contents -->
    </article>
@endsection
