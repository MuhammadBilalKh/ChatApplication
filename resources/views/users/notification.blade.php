@extends('layout.profile.profile-main')

@section('title', 'Notifications')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', ['pageHeader' => 'Notifications'])
@endsection

@section('profile-content')

    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Notifications menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="notifications-my-notifications-personal-li"
                class="bp-personal-sub-tab {{ request()->type === 'unread' ? 'current selected' : '' }}"
                data-bp-user-scope="unread">
                <a href="{{ route('users.notifications', ['type' => 'unread']) }}">
                    Unread
                </a>
            </li>

            <li id="read-personal-li"
                class="bp-personal-sub-tab {{ request()->type === 'read' ? 'current selected' : '' }}"
                data-bp-user-scope="read">
                <a href="{{ route('users.notifications', ['type' => 'read']) }}">
                    Read
                </a>
            </li>
        </ul>
    </nav>

    <div id="notifications-user-list" class="notifications dir-list">

        <form id="bulkNotificationForm">

            <table class="notifications bp-tables-user">
                <thead>
                    <tr>
                        <th class="icon"></th>
                        <th class="bulk-select-all">
                            <input id="select-all-notifications" type="checkbox">
                            <label class="bp-screen-reader-text" for="select-all-notifications">Select all</label>
                        </th>
                        <th class="title">Notification</th>
                        <th class="date">Date Received</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($unreadNotifications as $value)
                        <tr>
                            <td></td>

                            <td class="bulk-select-check">
                                <label>
                                    <input id="notification-{{ $value->notification_id }}" type="checkbox"
                                        name="notifications[]" value="{{ $value->notification_id }}"
                                        class="notification-check">
                                    <span class="bp-screen-reader-text">{{ $value->message }}</span>
                                </label>
                            </td>

                            <td>{{ $value->message }}</td>

                            <td class="notification-since mute">{{ $value->created_at->diffForHumans() }}</td>

                            <td class="notification-actions">

                                <a href="{{ route('notifications.manage_notifications', ['id' => $value->notification_id, 'action_type' => 'read']) }}"
                                    class="mark-unread primary bp-tooltip" data-bp-tooltip="Mark Read">
                                    <span class="dashicons dashicons-visibility"></span>
                                </a>

                                /

                                <a href="{{ route('notifications.manage_notifications', ['id' => $value->notification_id, 'action_type' => 'delete']) }}"
                                    class="delete secondary confirm bp-tooltip" data-bp-tooltip="Delete">
                                    <span class="dashicons dashicons-dismiss"></span>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row mt-2">

                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="bp-screen-reader-text" for="notification-select">Select Bulk Action</label>

                        <select name="notification_bulk_action" id="notification-select">
                            <option value="" selected>Bulk Actions</option>
                            <option value="{{ request()->type == "read" ? "unread" : "read" }}">Mark {{ request()->type == "read" ? "unread" : "read" }}</option>
                            <option value="delete">Delete</option>
                        </select>

                        <span class="select-arrow"></span>
                    </div>
                </div>

                <div class="col-sm-1">
                    <button type="button" id="notification-bulk-manage" class="button action">Apply</button>
                </div>

            </div>

        </form>

        {{-- PAGINATION --}}
        <div class="bp-pagination bottom">
            {{ $unreadNotifications->links() }}
        </div>

    </div>

@endsection

@push('script')
    <script>
        jQuery(document).ready(function($) {

            // Select All checkbox
            $("#select-all-notifications").on("change", function() {
                $(".notification-check").prop("checked", $(this).is(":checked"));
            });

            // Bulk Action Click
            $("#notification-bulk-manage").on("click", function() {

                let action = $("#notification-select").val();
                if (!action) {
                    alert("Please select a bulk action.");
                    return;
                }

                // Gather selected IDs
                let ids = [];
                $(".notification-check:checked").each(function() {
                    ids.push($(this).val());
                });

                if (ids.length === 0) {
                    alert("Please select at least one notification.");
                    return;
                }

                $.ajax({
                    url: "{{ route('notifications.bulk_action') }}",
                    method: "{{ FORM_METHOD_POST }}",
                    data: {
                        ids: ids,
                        action_type: action
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong.");
                    }
                });

            });

        });
    </script>
@endpush
