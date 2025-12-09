@extends('layout.profile.profile-main')

@section('title', 'Groups Invitation')

@section('profile-content')
    <nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Groups menu">
        <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">

            <li id="groups-my-groups-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="my-groups">
                <a href="{{ route('groups.create') }}" id="groups-my-groups">
                    Create Group
                </a>
            </li>

            <li id="groups-my-groups-personal-li" class="bp-personal-sub-tab" data-bp-user-scope="my-groups">
                <a href="{{ route('groups.index') }}" id="groups-my-groups">
                    Memberships
                </a>
            </li>

            <li id="invites-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="invites">
                <a href="{{ route('groups.invitation') }}" id="invites">
                    Invitations
                </a>
            </li>

        </ul>

    </nav>

    @if(session()->has('success'))
        <div class="alert alert-success">
            <span>{{ session()->get('success') }}</span>
        </div>
    @endif

    <div class="groups mygroups" data-bp-list="groups">
        <div class="row mt-3">

            @forelse ($invitations as $key => $value)
                <div class="col-sm-12">

                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="item-avatr">
                                        <img class="avatar group-1-avatar avatar-200 photo"
                                            src="{{ asset('/storage/' . $value->getgroup->profile_image) }}" />
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p style="font-weight: bold;"> {{ $value->getgroup->group_name }}
                                        ({{ ucfirst($value->getgroup->getMeta->privacy_setting) }} Group)
                                    </p>
                                    <p style="font-weight: bold;">Created By: {{ $value->getgroup->groupCreatedBy->name }}
                                        ({{ $value->getgroup->groupCreatedBy->username }})</p>
                                </div>
                            </div>
                            <form method="{{ FORM_METHOD_POST }}" action="{{ route('groups.approve_reject_group_invitation', ['group' => $value->getgroup->group_id]) }}">
                                @csrf
                                <input type="hidden" name="group_id" value="{{ $value->getgroup->group_id }}" />
                                <button type="submit" name="approval_type" value="approve" class="btn btn-success btn-sm float-right m-1">Approve</button>
                                <button type="submit" name="approval_type" value="reject" class="btn btn-sm btn-danger float-right m-1">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <aside class="bp-feedback bp-messages info">
                    <span class="bp-icon" aria-hidden="true"></span>
                    <p>You have no outstanding group invites.</p>
                </aside>
            @endforelse
        </div>
    </div>

    {{ $invitations->links() }}
@endsection

@push('script')
    <script>
        jQuery(document).ready(function(){
            jQuery(".alert").delay(2500).fadeOut();
        });
    </script>
@endpush
