@extends('layout.profile.profile-main')

@section('title', 'Settings')

@section('profile-content')

    @php
        function checkedYes($value)
        {
            return $value == 1 ? 'checked' : '';
        }
        function checkedNo($value)
        {
            return $value == 0 ? 'checked' : '';
        }
    @endphp

    <nav class="bp-navs bp-subnavs no-ajax user-subnav mb-3" id="subnav" role="navigation" aria-label="Settings menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="general-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="general">
                <a href="{{ route('users.general_settings') }}" id="general">
                    General
                </a>
            </li>

            <li id="notifications-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="notifications">
                <a href="{{ route('users.email_setting') }}" id="notifications">
                    Email
                </a>
            </li>


            <li id="profile-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="profile">
                <a href="{{ route('users.profile_visibility_settings') }}" id="profile">
                    Profile Visibility
                </a>
            </li>


            <li id="invites-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="invites">
                <a href="https://mythemestore.com/beehive-preview/members/user/settings/invites/" id="invites">
                    Group Invites
                </a>
            </li>


            <li id="data-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="data">
                <a href="https://mythemestore.com/beehive-preview/members/user/settings/data/" id="data">
                    Export Data
                </a>
            </li>

        </ul>

    </nav>

    @if (session()->has('errors'))
        <div class="alert alert-danger">
            {{ session()->get('errors') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <h2 class="screen-heading general-settings-screen">
        Email Notification Settings</h2>

    <p class="info email-pwd-info">
        Set your email notification preferences.</p>

    <form method="POST" action="{{ route('users.update_email_setting') }}">
        @csrf

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th width="40%">Notification Type</th>
                    <th width="10%">Yes</th>
                    <th width="10%">No</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><strong>Activity Notifications</strong></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>A member mentions you {{ '@' . Auth::user()->username }}</td>
                    <td><input type="radio" name="notifications[notification_activity_new_mention]" value="yes"
                            {{ checkedYes($meta->email_on_metion) }}></td>
                    <td><input type="radio" name="notifications[notification_activity_new_mention]" value="no"
                            {{ checkedNo($meta->email_on_metion) }}></td>
                </tr>

                <tr>
                    <td>A member replies to your update or comment</td>
                    <td><input type="radio" name="notifications[notification_activity_new_reply]" value="yes"
                            {{ checkedYes($meta->email_on_reply_or_comment) }}></td>
                    <td><input type="radio" name="notifications[notification_activity_new_reply]" value="no"
                            {{ checkedNo($meta->email_on_reply_or_comment) }}></td>
                </tr>

                <tr>
                    <td><strong>Messages</strong></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>You receive a new private message</td>
                    <td><input type="radio" name="notifications[notification_messages_new_message]" value="yes"
                            {{ checkedYes($meta->email_on_sending_message) }}></td>
                    <td><input type="radio" name="notifications[notification_messages_new_message]" value="no"
                            {{ checkedNo($meta->email_on_sending_message) }}></td>
                </tr>

                <tr>
                    <td><strong>Members</strong></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>A member accepts your membership invitation</td>
                    <td><input type="radio" name="notifications[notification_members_invitation_accepted]" value="yes"
                            {{ checkedYes($meta->email_on_accept_membership_invitation) }}></td>
                    <td><input type="radio" name="notifications[notification_members_invitation_accepted]" value="no"
                            {{ checkedNo($meta->email_on_accept_membership_invitation) }}></td>
                </tr>

                <tr>
                    <td><strong>Friend Requests</strong></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>You receive a friend request</td>
                    <td><input type="radio" name="notifications[notification_friends_friendship_request]" value="yes"
                            {{ checkedYes($meta->email_on_friend_request_receive) }}></td>
                    <td><input type="radio" name="notifications[notification_friends_friendship_request]" value="no"
                            {{ checkedNo($meta->email_on_friend_request_receive) }}></td>
                </tr>

                <tr>
                    <td>A member accepts your friend request</td>
                    <td><input type="radio" name="notifications[notification_friends_friendship_accepted]" value="yes"
                            {{ checkedYes($meta->email_on_friend_request_accept) }}></td>
                    <td><input type="radio" name="notifications[notification_friends_friendship_accepted]" value="no"
                            {{ checkedNo($meta->email_on_friend_request_accept) }}></td>
                </tr>

                <tr>
                    <td><strong>Group Notifications</strong></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>You receive a group membership invitation</td>
                    <td><input type="radio" name="notifications[notification_groups_invite]" value="yes"
                            {{ checkedYes($meta->email_on_receiving_membership_invitation) }}></td>
                    <td><input type="radio" name="notifications[notification_groups_invite]" value="no"
                            {{ checkedNo($meta->email_on_receiving_membership_invitation) }}></td>
                </tr>

                <tr>
                    <td>You are promoted to a group admin/moderator</td>
                    <td><input type="radio" name="notifications[notification_groups_admin_promotion]" value="yes"
                            {{ checkedYes($meta->email_on_changing_group_role) }}></td>
                    <td><input type="radio" name="notifications[notification_groups_admin_promotion]" value="no"
                            {{ checkedNo($meta->email_on_changing_group_role) }}></td>
                </tr>

                <tr>
                    <td>You receive a group membership request</td>
                    <td><input type="radio" name="notifications[notification_groups_membership_request]" value="yes"
                            {{ checkedYes($meta->email_on_receiving_request_for_private_group) }}>
                    </td>
                    <td><input type="radio" name="notifications[notification_groups_membership_request]" value="no"
                            {{ checkedNo($meta->email_on_receiving_request_for_private_group) }}>
                    </td>
                </tr>

                <tr>
                    <td>Your group membership request is approved/rejected</td>
                    <td><input type="radio" name="notifications[notification_membership_request_completed]" value="yes"
                            {{ checkedYes($meta->email_on_group_joining_accepted_or_rejected) }}>
                    </td>
                    <td><input type="radio" name="notifications[notification_membership_request_completed]"
                            value="no" {{ checkedNo($meta->email_on_group_joining_accepted_or_rejected) }}>
                    </td>
                </tr>

            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Save Settings</button>

    </form>

@endsection

@push('script')
    <script>
        jQuery(document).ready(function() {
            jQuery(".alert").delay(2500).fadeOut();
        });
    </script>
@endpush
