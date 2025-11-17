<ul id="friend-list" class="item-list friends-list bp-list friends-request-list mt-4">

    @forelse ($requests as $key => $value)
        <li id="friendship-{{ $value->sender_id }}" class="item-entryanimate-itemslideInUp bp-single-member"
            data-bp-item-id="{{ $value->sender_id }}" data-bp-item-component="members">
            <div class="item-avatar">
                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/novipa/"><img loading="lazy" decoding="async"
                        src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/avatars/8/1761167865-bpfull.png"
                        class="avatar user-8-avatar avatar-200 photo" width="200" height="200"
                        alt="Profile picture of Novipa"></a>
            </div>

            <div class=" friends-meta action">
                <div class="generic-button"><button class="button accept"
                        onclick="ManageFriendRequest($value->sender_id, 'accept')"
                        data-bp-btn-action="accept_friendship">Accept</button></div>
                <div class="generic-button"><button class="button reject"
                        onclick="ManageFriendRequest($value->sender_id, 'reject')"
                        data-bp-btn-action="reject_friendship">Reject</button></div>
            </div>
        </li>

    @empty
        <li class="item-entryanimate-itemslideInUp bp-single-member">
            <span>No Records Found</span>
        </li>
    @endforelse
</ul>
