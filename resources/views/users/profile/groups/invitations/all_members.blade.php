@extends('users.profile.groups.layout')

@section('title', 'Settings')

@section('group-content')
    <h2 class="bp-screen-title">
        All Members </h2>

    <div id="group-invites-container">
        <nav class="bp-navs bp-subnavs no-ajax group-subnav bp-invites-nav" id="subnav" role="navigation"
            aria-label="Group invitations menu">
            <ul class="subnav">
                <li>
                    <a href="{{ route('groups.manage_invite', ['group' => $groupData->group_id]) }}" class="bp-invites-nav-item" data-nav="friends">My Friends</a>
                </li>
                <li class="current">
                    <a href="{{ route('groups.all_members', ['group' => $groupData->group_id]) }}" class="bp-invites-nav-item" data-nav="members">All Members</a>
                </li>
            </ul>
        </nav>
        <div class="group-invites-column">
            <div class="subnav-filters group-subnav-filters bp-invites-filters">
                <div>
                    <div class="group-invites-search subnav-search clearfix" role="search">
                        <div class="bp-search">
                            <form action="" method="get" id="group_invites_search_form"
                                class="bp-invites-search-form" data-bp-search="members">
                                <label for="group_invites_search" class="bp-screen-reader-text">Search Members</label>
                                <input type="search" id="group_invites_search" placeholder="Search">

                                <button type="submit" id="group_invites_search_submit" class="nouveau-search-submit">
                                    <span class="dashicons dashicons-search" aria-hidden="true"></span>
                                    <span id="button-text" class="bp-screen-reader-text">Search</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="members bp-invites-content">
                <ul id="members-list" class="item-list bp-list">
                    @forelse($membersToInvite as $key => $value)
                        <li class="">
                            <div class="item-avatar">
                                <img src="{{ asset($value->profile_picture) }}" class="avatar"
                                    alt="Profile Picture of {{ '@' . $value->username }}" />
                            </div>

                            <div class="item">
                                <div class="list-title member-name">
                                    {{ $value->username }}
                                </div>
                            </div>

                        </li>
                    @empty
                        <li>
                            There Are No Members In This Group
                        </li>
                    @endforelse

                </ul>

                {{ $membersToInvite->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        jQuery(document).ready(function() {

            jQuery(document).on("click", ".group-add-remove-invite-button", function() {

                let btn = jQuery(this);
                btn.attr("disabled", true);

                let userID = btn.data("user-id");

                $.ajax({
                    url: "{{ route('groups.send_remove_group_invitation', ['group' => $groupData->group_id]) }}",
                    type: "{{ FORM_METHOD_POST }}",
                    data: {
                        user_id: userID,
                    },
                    headers:{
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    success: function(resp) {

                        if (resp.status == {{ REQUEST_PROCESSED }}) {

                            let isInviting = btn.hasClass("invite-button");

                            if (isInviting) {
                                jQuery(".action-" + userID).html(`
                                <button type="button"
                                    class="button btn-delete-invite group-add-remove-invite-button bp-tooltip bp-icons"
                                    data-user-id="${userID}"
                                    data-bp-tooltip="Delete Invitation">
                                    <span>Delete Invitation</span>
                                </button>
                            `);
                            } else {
                                jQuery(".action-" + userID).html(`
                                <button type="button"
                                    class="button invite-button group-add-remove-invite-button bp-tooltip bp-icons"
                                    data-user-id="${userID}"
                                    data-bp-tooltip="Invite">
                                    <span>Invite</span>
                                </button>
                            `);
                            }
                        }
                    },
                    error: function() {
                        alert("An Error Occured While Processing The Request");
                    }
                });
            });

        });
    </script>
@endpush
