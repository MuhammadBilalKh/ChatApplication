@extends('layout.profile.profile-main')

@section('title', 'Friend Requests')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Friend Requests',
    ])
@endsection

@section('profile-content')
    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Profile menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">
            <li class="bp-personal-sub-tab" data-bp-user-scope="public">
                <a href="javascript:void(0);" id="friendships-tab-link">
                    FriendShips
                </a>
            </li>
            <li class="bp-personal-sub-tab" data-bp-user-scope="public">
                <a href="javascript:void(0);" id="requests-tab-link">
                    Requests
                </a>
            </li>
        </ul>
    </nav>

    <div class="container" id="tab-contents">
        <div id="friends-tab" class="tab-pane" style="display: none;">
            <div id="friends-content"></div>
        </div>
        <div id="requests-tab" class="tab-pane" style="display: none;">
            <div id="requests-content"></div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        jQuery(document).ready(function () {
            // Show Friends tab by default
            showTab('friends');

            jQuery('#friendships-tab-link').on('click', function () {
                showTab('friends');
                loadFriends();
            });
            jQuery('#requests-tab-link').on('click', function () {
                showTab('requests');
                loadRequests();
            });

            function showTab(tab) {
                jQuery('#member-secondary-nav .bp-personal-sub-tab').removeClass('current selected');
                if (tab === 'friends') {
                    jQuery('#friendships-tab-link').parent().addClass('current selected');
                    jQuery('#friends-tab').show();
                    jQuery('#requests-tab').hide();
                } else {
                    jQuery('#requests-tab-link').parent().addClass('current selected');
                    jQuery('#friends-tab').hide();
                    jQuery('#requests-tab').show();
                }
            }

            function loadFriends() {
                var $container = jQuery('#friends-content');
                $container.html('<span class="h4"><i class="fa fa-spinner"></i></span>');
                jQuery.ajax({
                    url: "{{ route('peoples.list_friends') }}",
                    type: "GET",
                    success: function (resp) {
                        $container.html(resp);
                    },
                    error: function () {
                        $container.html('<div class="alert alert-danger">Unable to load friends.</div>');
                    }
                });
            }

            function loadRequests() {
                var $container = jQuery('#requests-content');
                $container.html('<span class="h4"><i class="fa fa-spinner"></i></span>');
                jQuery.ajax({
                    url: "{{ route('peoples.list_requests') }}",
                    type: "GET",
                    success: function (resp) {
                        $container.html(resp);
                    },
                    error: function () {
                        $container.html('<div class="alert alert-danger">Unable to load requests.</div>');
                    }
                });
            }

            loadFriends();
        });

        function ManageFriendRequest(senderID, status){
            jQuery.ajax({
                url:"{{ route('') }}",
                type:"{{ FORM_METHOD_GET }}",
                data:{
                    request_type: status,
                    member_id: senderID,
                },
                success:function(resp){
                    if(resp.status == {{ REQUEST_PROCESSED }}){
                        alert("Request Processed.");
                        jQuery("#friendship-"+senderID).remove();
                    }
                }
            });
        }
    </script>
@endpush
