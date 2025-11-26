@extends('layout.profile.profile-main')

@section('title', 'Create Group')

@section('profile-content')
    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Groups menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="groups-my-groups-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="my-groups">
                <a href="{{ route('groups.create') }}" id="groups-my-groups">
                    Create Group
                </a>
            </li>

            <li id="groups-my-groups-personal-li" class="bp-personal-sub-tab current selected"
                data-bp-user-scope="my-groups">
                <a href="{{ route('groups.index') }}" id="groups-my-groups">
                    Memberships
                </a>
            </li>

            <li id="invites-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="invites">
                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/groups/invites/" id="invites">
                    Invitations
                </a>
            </li>

        </ul>

    </nav>

    <div class="groups mygroups" data-bp-list="groups" style="">
        <form method="{{ FORM_METHOD_POST }}" enctype="multipart/form-data" route="{{ route('groups.store') }}">
            @csrf

            <div class="row container-fluid">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Group Name: </label>
                        <input type="text" name="group_name" class="form-control" id="txtGroupName" value="{{ old("group_name") }}" />
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
