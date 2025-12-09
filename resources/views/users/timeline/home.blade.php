@extends('layout.profile.profile-main')

@section('title', 'Timeline')

@section('profile-content')
    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Activity menu">
        <ul class="subnav">
            <li id="just-me-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="just-me">
                <a href="{{ route('users.timeline_activity') }}" id="just-me">
                    Personal
                </a>
            </li>
            <li id="activity-favs-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="favorites">
                <a href="{{ route('users.timline_favorites_activity') }}" id="activity-favs">
                    Favorites
                </a>
            </li>
            <li id="activity-friends-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="friends">
                <a href="{{ route('users.timeline_friends_activity') }}" id="activity-friends">
                    Friends
                </a>
            </li>
        </ul>
    </nav>

    <div class="screen-content mt-3">
        <div id="activity-stream" class="activity" data-bp-list="activity" style="">
            <div class="alert alert-info d-none" id="alertResponse">
                <span><i class="fa fa-spinner"></i> Loading The Community Events.</span>
            </div>

            <ul class="activity-list item-list bp-list" id="listPosts">
                {{-- The posts will be loaded here via AJAX --}}
            </ul>

            <div class="flex justify-center mt-4" id="loadMoreContainer">
                <button type="button" id="loadMoreBtn" class="btn btn-warning">
                    <span id="loadMoreBtnText">Load More</span>
                    <span id="loadMoreSpinner" class="hidden ml-2"><i class="fa fa-spinner fa-spin"></i></span>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let page = 1;
        let loading = false;
        let morePages = true;
        const alertResponse = jQuery("#alertResponse");
        const listPosts = document.querySelector('#listPosts');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const loadMoreBtnText = document.getElementById('loadMoreBtnText');
        const loadMoreSpinner = document.getElementById('loadMoreSpinner');
        const loadMoreContainer = document.getElementById('loadMoreContainer');

        function showAlertLoading() {
            alertResponse.removeClass('d-none');
            alertResponse.html('<i class="fa fa-spinner fa-spin"></i> Loading Community Events...');
            alertResponse.fadeIn();
        }

        function hideAlert() {
            alertResponse.fadeOut(300, function() {
                alertResponse.addClass('d-none');
            });
        }

        function showLoadMoreBtn() {
            loadMoreBtn.classList.remove('hidden');
            loadMoreBtn.disabled = false;
            loadMoreBtnText.style.display = 'inline';
            loadMoreSpinner.classList.add('hidden');
        }

        function hideLoadMoreBtn() {
            loadMoreBtn.classList.add('hidden');
        }

        function showLoadMoreSpinner() {
            loadMoreBtn.disabled = true;
            loadMoreBtnText.style.display = 'none';
            loadMoreSpinner.classList.remove('hidden');
        }

        jQuery(document).ready(function() {
            document.title = "Timeline";
            loadPosts(true); // Load first page and clear list

            jQuery(document).on('click', '.show-comments-btn', function(e) {
                e.preventDefault();
                const postId = jQuery(this).data('post-id');
                const $commentsSection = jQuery('#comments-' + postId);
                $commentsSection.slideToggle(300);
            });

            loadMoreBtn.addEventListener('click', function() {
                if (!loading && morePages) {
                    showLoadMoreSpinner();
                    loadPosts(false);
                }
            });
        });

        function loadPosts(isInitial = false) {
            if (loading || !morePages) return;

            loading = true;
            showAlertLoading();

            $.ajax({
                url: "{{ route('users.timeline_activity') }}",
                type: "{{ FORM_METHOD_GET }}",
                data: {
                    page: page,
                    only_post_with_comments_and_replies: true
                },
                success: function(data) {
                    if (isInitial) {
                        listPosts.innerHTML = '';
                        page = 1;
                    }
                    if ($.trim(data.html) !== '') {
                        listPosts.insertAdjacentHTML('beforeend', data.html);
                        page++;
                        morePages = data.hasMore ?? false;
                        if (morePages) {
                            showLoadMoreBtn();
                        } else {
                            hideLoadMoreBtn();
                        }
                    } else {
                        morePages = false;
                        hideLoadMoreBtn();
                        if (page === 1) {
                            listPosts.innerHTML =
                                '<li class="text-center text-gray-600 py-6">No posts found.</li>';
                        }
                    }
                    loading = false;
                    hideAlert();
                },
                error: function() {
                    loading = false;
                    showLoadMoreBtn();
                    alertResponse.html('<span class="text-danger">Error loading posts.</span>');
                    alertResponse.removeClass('d-none');
                    setTimeout(() => hideAlert(), 1200);
                }
            });
        }
    </script>
@endpush
