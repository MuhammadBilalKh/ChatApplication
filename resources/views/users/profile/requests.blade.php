@extends('layout.profile.profile-main')

@section('title', 'Friend Requests')

@section('profile-content')

    <ul id="friend-list" class="item-list friends-list bp-list friends-request-list">

        @forelse ($requests as $key => $value)
            <form method="POST" action="{{ route('peoples.manage_request_response') }}">
                @csrf
                <input type="hidden" name="memberID" value="{{ $value->getSender->user_id }}" />
                <input type="hidden" id="response" name="response" value="" />

                <li id="friendship-{{ $value->sender_id }}" class="item-entryanimate-itemslideInUp bp-single-member"
                    data-bp-item-id="{{ $value->sender_id }}" data-bp-item-component="members">

                    <div class="item-avatar">
                        <a href="#">
                            <img loading="lazy" decoding="async" src="{{ asset($value->getSender->profile_picture) }}"
                                class="avatar user-8-avatar avatar-200 photo" width="200" height="200"
                                alt="Profile picture of {{ $value->getSender->username }}">
                        </a>
                    </div>

                    <div class="item">
                        <h5 class="list-title">
                            <a href="#">{{ $value->getSender->username }}</a>
                        </h5>
                        <div class="meta item-meta mute">
                            <span class="activity">Active 3 weeks, 2 days ago</span>
                        </div>
                    </div>

                    <div class="friends-meta action">
                        <div class="generic-button">
                            <button class="button accept" type="submit"
                                onclick="document.getElementById('response').value = '1'">
                                Accept
                            </button>
                        </div>

                        <div class="generic-button">
                            <button class="button reject" type="submit"
                                onclick="document.getElementById('response').value = '0'">
                                Reject
                            </button>
                        </div>
                    </div>

                </li>
            </form>

        @empty
            <li class="item-entryanimate-itemslideInUp bp-single-member">
                <span>No Records Found</span>
            </li>
        @endforelse
    </ul>

@endsection
