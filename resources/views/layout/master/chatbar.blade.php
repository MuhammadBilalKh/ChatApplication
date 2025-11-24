<style>
    /* Highest stacking context for chat wrapper */
    .wrapper {
        z-index: 999999;
    }

    .emoji-picker {
        width: 300px !important;
    }

    /* ===== Scrollbar styling ===== */

    /* WebKit browsers (Chrome, Edge, Safari) */
    .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar {
        width: 12px;
    }

    .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar-track {
        background: #fff;
    }

    .chat-window__message-list.vb.vb-invisible::-webkit-scrollbar-thumb {
        background-color: #f5bd02;
        border-radius: 6px;
        border: 3px solid #fff;
    }

    /* Firefox scrollbar */
    .chat-window__message-list.vb.vb-invisible {
        scrollbar-width: thin;
        scrollbar-color: #f5bd02 #fff;
    }

    /* ===== Input area ===== */
    .chat-window__inputarea {
        display: flex;
        align-items: flex-end;
        /* align emoji + input + send button at bottom */
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 25px;
        padding: 5px 10px;
        width: 100%;
        box-sizing: border-box;
        border-top: 1px solid #ddd;
    }

    /* ===== Message input field ===== */
    .chat-window__input {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        position: relative;
        border-radius: 6px;
        min-height: 40px;
        background: #fff;
    }

    .chat-window__input--placeholder {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #aaa;
        pointer-events: none;
        font-size: 14px;
        user-select: none;
    }

    .chat-window__input--field {
        min-height: 35px;
        padding: 8px 12px;
        border: none;
        outline: none;
        width: 100%;
        font-size: 14px;
        line-height: 20px;
    }

    /* Hide placeholder when typing */
    .chat-window__input--field:focus+.chat-window__input--placeholder,
    .chat-window__input--field:not(:empty)+.chat-window__input--placeholder {
        display: none;
    }

    /* ===== Emoji button ===== */
    .chat-window__input--emoji {
        display: flex;
        align-items: flex-end;
        margin-left: 8px;
    }

    .chat-window__input--emoji button {
        background: transparent;
        border: none;
        font-size: 19px;
        cursor: pointer;
        transition: transform 0.2s ease;
        padding: 0;
        box-shadow: none;
    }

    .chat-window__input--emoji button:hover {
        transform: scale(1.2);
    }

    /* ===== Send button ===== */
    .chat-window__btn--enter {
        margin-left: 5px;
        text-decoration: none;
        color: #007aff;
        font-size: 20px;
    }

    .chat-window__btn--enter:hover {
        color: #005bb5;
    }

    /* ===== Emoji images in messages ===== */
    .message img.emoji {
        width: 22px;
        height: 22px;
        vertical-align: middle;
    }

    /* Base styles for the floating button */
    .chat-float {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 99999;
        display: none;
        /* Hidden by default (for desktop/tablet) */
    }

    /* Circle shape and styling */
    .chat-floatbody {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #F5BD02;
        color: #fff;
        border-radius: 50%;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        font-size: 20px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .chat-floatbody:hover {
        background-color: #f0c22a;
        transform: scale(1.1);
    }

    .chat-floatbody .dropd-control .dashicons {
        height: 30px;
        width: 30px;
        position: absolute;
        top: 11px;
        left: 7px;
    }

    /* Show only on mobile */
    @media (max-width: 768px) {
        .chat-float {
            display: block;
        }
    }
</style>


<div id="buddy-chat-app" class="dash d-none d-md-block">
    <div id="buddy-chat-buddies" class="collapsed">
        <div class="buddy-chat-buddies__container">
            <div class="header-container">
                <div class="header-title"><span class="dashicons dashicons-format-chat"></span>
                    <div class="window-title">
                        <h5>Messenger</h5>
                    </div>
                </div>
                <div class="dropd-group dropd-dr"><a class="dropd-control mute"><span
                            class="dashicons dashicons-admin-generic"></span></a>
                    <div class="dropd-menu"><a class="dropd-item">Mute</a></div>
                </div>
            </div>
            <div class="vb vb-invisible" style="position: relative; overflow: hidden;">
                <div class="buddy-chat-buddies__content vb-content"
                    style="display: block; overflow: hidden scroll; height: 100%; width: calc(100% + 20px);">
                    <ul class="buddy-chat-nav-tabs">
                        <li class="item"><a class="item-link active">Friends</a></li>
                        <li class="item"><a class="item-link">Groups</a></li>
                    </ul>
                    <div id="buddy-list" class="bpc-tab-content">
                        <div>
                            <div class="vue-recycle-scroller bpc-buddy-list friends ready direction-vertical">
                                <div class="vue-recycle-scroller__item-wrapper">
                                    <div class="vue-recycle-scroller__item-view">

                                        @foreach ($all_friends as $value)
                                            @php
                                                $friend =
                                                    $value->sender_id == Auth::user()->user_id
                                                        ? $value->getReceiver
                                                        : $value->getSender;
                                            @endphp

                                            <div class="bpc-item mb-3" data-user="{{ $friend->username }}">
                                                <div class="avatar-container">
                                                    <img src="{{ asset($friend->profile_picture) }}"
                                                        alt="{{ $friend->username }}" class="avatar">
                                                    <span class="status online"></span>
                                                </div>

                                                <div class="bpc-item-body">
                                                    <div class="flex-r">
                                                        <div class="buddy">
                                                            <div class="chat-buddy anchor ellipsis">
                                                                {{ $friend->username }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vb-dragger" style="position: absolute; height: 0px; top: 0px;">
                    <div class="vb-dragger-styler"></div>
                </div>
            </div>
            <div id="buddy-chat-buddies__collapser" class="buddy-chat-buddies__collapser">
                <div class="collapse-icon"><span class="dashicons dashicons-arrow-right-alt2"></span></div>
                <div class="action-text">
                    <h5>Collapse</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat windows -->
    <div id="buddy-chat-windows">
        <ul class="bpc-chat-windows-list">

            @foreach ($all_friends as $value)
                @php
                    $friend = $value->sender_id == Auth::user()->user_id ? $value->getReceiver : $value->getSender;

                    $windowId = 'chat-window-' . preg_replace('/[^A-Za-z0-9\-]/', '-', $friend->username);
                @endphp

                <li class="chat-window" id="{{ $windowId }}" style="display: none;">
                    <div class="chat-window__container">

                        <div class="chat-window__title">
                            <div class="avatar-container">
                                <img src="{{ asset($friend->profile_picture) }}" alt="{{ $friend->username }}"
                                    class="avatar">
                                <span class="status {{ $friend->online ?? 'offline' }}"></span>
                            </div>

                            <div class="flex-r">
                                <div>
                                    <div class="chat-buddy anchor ellipsis">
                                        {{ $friend->username }}
                                    </div>
                                    <div class="mute">
                                        {{ $friend->is_online ? 'Online' : 'Offline' }}
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="chat_window__close-btn">
                                <span class="dashicons dashicons-no-alt"></span>
                            </a>
                        </div>

                        <!-- MESSAGE LIST -->
                        <div class="chat-window__message-list vb vb-invisible">
                            <div class="vb-content">
                                <ul class="bpc-chat-list overflow-auto" id="messages-{{ $friend->user_id }}">
                                    <!-- Messages will be loaded here dynamically with JS/AJAX -->
                                </ul>
                            </div>
                        </div>

                        <!-- INPUT AREA -->
                        <div>
                            <div class="chat-window__inputarea" data-friend="{{ $friend->user_id }}">
                                <div class="chat-window__input">
                                    <div class="chat-window__input--placeholder">Write your message</div>
                                    <div contenteditable="true" class="chat-window__input--field message-input"
                                        data-friend="{{ $friend->user_id }}">
                                    </div>
                                </div>

                                <div class="chat-window__input--emoji">
                                    <button type="button" class="emojiBtn">😊</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </li>
            @endforeach

        </ul>
    </div>
</div>

<div class="chat-float chat-floatbody  d-md-none" id="toggle-chat">
    <a class="dropd-control">
        <span class="dashicons dashicons-format-chat text-white"></span>
    </a>
</div>
