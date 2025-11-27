@extends('layout.profile.profile-main')

@section('title', 'Frineds')

@section('profile-content')
    <div class="members friends" id="content">
        <ul class="item-list members-friends-list bp-list members-list grid two">
            @forelse ($friends as $key => $value)
                <li class="item-entryanimate-itemslideInUp odd" data-bp-item-id="7" data-bp-item-component="members">
                    <div class="list-wrap">

                        <div class="item-avatar">
                            <a href="{{ $value->getReceiver->username }}"><img loading="lazy"
                                    src="{{ asset($value->getReceiver->profile_picture) }}"
                                    class="avatar user-7-avatar avatar-200 photo" width="200" height="200"
                                    alt="Profile picture of {{ $value->getReceiver->username }}"></a>
                        </div>

                        <div class="item">

                            <div class="item-block">

                                <h4 class="list-title member-name">
                                    <a href="#">{{ $value->getReceiver->username }}</a>
                                </h4>

                                <p class="item-meta last-activity mute">
                                    Active 3 weeks, 6 days ago </p>


                                <ul class="connections">
                                    <li><span class="count">{{ $value->getReceiver->getFriends()->count() }}</span>
                                        <p class="mute">Friends</p>
                                    </li>
                                    <li><span class="count">0</span>
                                        <p class="mute">Groups</p>
                                    </li>
                                </ul>

                                <p class="latest-update"></p>

                                <ul class=" friends-meta action">
                                    <li id="friendship-button-7" class=" friendship-button is_friend generic-button">
                                        <a href="{{ route('peoples.cancel_friend_request', ['member_id' => $value->getReceiver->user_id]) }}"
                                            id="friend-7" class="friendship-button is_friend remove" rel="remove"
                                            title="Cancel Friendship" data-bp-btn-action="is_friend">Cancel
                                            Friendship</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </li>
            @empty
                <li class="item-entryanimate-itemslideInUp odd" data-bp-item-id="7" data-bp-item-component="members">
                    <div class="row">
                        <div class="col-12 col-lg-main">
                            <div class="list-wrap">
                                <div class="alert alert-warning alert-dismissible">
                                    <span>No Records Found</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
@endsection
