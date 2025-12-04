@extends('layout.profile.profile-main')

@section('title', 'Notifications')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', ['pageHeader' => 'Notifications'])
@endsection

@section('profile-content')
    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Notifications menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="notifications-my-notifications-personal-li" class="bp-personal-sub-tab current selected"
                data-bp-user-scope="unread">
                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/notifications/unread/"
                    id="notifications-my-notifications">
                    Unread
                </a>
            </li>


            <li id="read-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="read">
                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/notifications/read/" id="read">
                    Read
                </a>
            </li>
        </ul>
    </nav>

    <div id="notifications-user-list" class="notifications dir-list" data-bp-list="notifications" style="">
        <form action="" method="post" id="notifications-bulk-management" class="standard-form">
            <table class="notifications bp-tables-user">
                <thead>
                    <tr>
                        <th class="icon"></th>
                        <th class="bulk-select-all"><input id="select-all-notifications" type="checkbox"><label
                                class="bp-screen-reader-text" for="select-all-notifications">Select all</label></th>
                        <th class="title">Notification</th>
                        <th class="date">
                            Date Received
                        </th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($unreadNotifications as $key => $value)
                        <tr>
                            <td></td>
                            <td class="bulk-select-check"><label for="24"><input id="24" type="checkbox"
                                        name="notifications[]" value="24" class="notification-check"><span
                                        class="bp-screen-reader-text">{{ $value->message }}</span></label>
                            </td>
                            <td>{{ $value->message }}</td>
                                      <td class="notification-since mute">{{ $value->created_at->diffForHumans() }}</td>
                        <td class="notification-actions"><a
                                href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/notifications/read/?action=unread&amp;notification_id=24&amp;_wpnonce=b3ec49d62a"
                                class="mark-unread primary bp-tooltip" data-bp-tooltip="Mark Unread"><span
                                    class="dashicons dashicons-visibility" aria-hidden="true"></span><span
                                    class="bp-screen-reader-text">Read</span></a> / <a
                                href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/notifications/read/?action=delete&amp;notification_id=24&amp;_wpnonce=d2f770a3b8"
                                class="delete secondary confirm bp-tooltip" data-bp-tooltip="Delete"><span
                                    class="dashicons dashicons-dismiss" aria-hidden="true"></span><span
                                    class="bp-screen-reader-text">Delete</span></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="notifications-options-nav">

                <div class="select-wrap">

                    <label class="bp-screen-reader-text" for="notification-select">Select Bulk Action</label>

                    <select name="notification_bulk_action" id="notification-select">
                        <option value="" selected="selected">Bulk Actions</option>

                        <option value="unread">Mark unread</option>
                        <option value="delete">Delete</option>
                    </select>

                    <span class="select-arrow"></span>

                </div>

                <input type="submit" id="notification-bulk-manage" class="button action" value="Apply" disabled="">
            </div>

            <input type="hidden" id="notifications_bulk_nonce" name="notifications_bulk_nonce" value="c45168793c"><input
                type="hidden" name="_wp_http_referer" value="/MIGVELv1/wp-admin/admin-ajax.php">
        </form>


        <div class="bp-pagination bottom" data-bp-pagination="npage">

            <div class="pag-count bottom">

                {{ $unreadNotifications->links() }}

            </div>
        </div>
    </div>
@endsection
