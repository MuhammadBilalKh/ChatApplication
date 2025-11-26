@extends('layout.profile.profile-main')

@section('title', 'Groups')

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

        <ul id="groups-list" class="item-list groups-list bp-list grid two">

            @forelse ($groups as $group)
                <li class="item-entryanimate-itemslideInUp even public is-admin is-member group-has-avatar"
                    data-bp-item-id="1" data-bp-item-component="groups">
                    <div class="list-wrap">
                        <div class="item-cover"
                            style="background-image: url('{{ asset('/storage/' . $group->cover_image) }}');">
                        </div>

                        <div class="item-avatar">
                            <a href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/"><img loading="lazy"
                                    src="{{ asset('/storage/' . $group->profile_image) }}"
                                    class="avatar group-1-avatar avatar-200 photo" width="200" height="200"
                                    alt="Group logo of {{ $group->group_name }}"></a>
                        </div>

                        <div class="item">

                            <div class="item-block">

                                <h5 class="list-title groups-title"><a
                                        href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/"
                                        class="bp-group-home-link tech-group-home-link">{{ $group->group_name }}</a></h5>

                                <ul class="inline-members">

                                    <li>
                                        <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/"
                                            title="wpdeveloper" target="_blank">
                                            <img loading="lazy" src="{{ asset($group->groupCreatedBy->profile_picture) }}"
                                                class="avatar user-1-avatar avatar-35 photo" width="35" height="35"
                                                alt="Profile picture of wpdeveloper"> </a>
                                    </li>
                                </ul>


                                <p class="item-meta group-details">Public Group / 1 member</p>

                                <ul class=" groups-meta action">
                                    <li class="generic-button"><a
                                            href="https://www.clientbetalink.xyz/MIGVELv1/groups/tech-group/admin/">Manage
                                            Group</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </li>
            @empty
            @endforelse


        </ul>

        {{ $groups->links() }}
        <div class="bp-pagination bottom" data-bp-pagination="grpage">

            <div class="pag-count bottom">

                <p class="pag-data">
                    Viewing 1 - 2 of 2 groups </p>

            </div>
        </div>
    </div>
@endsection
