@push('css')
    <style>
        /* Highest stacking context for chat wrapper */
        .wrapper {
            z-index: 999999;
        }

        .emoji-picker {
            width: 300px !important;
        }

        /* ===== Scrollbar styling ===== */
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

        .chat-window__message-list.vb.vb-invisible {
            scrollbar-width: thin;
            scrollbar-color: #f5bd02 #fff;
        }

        /* ===== Input area ===== */
        .chat-window__inputarea {
            display: flex;
            align-items: flex-end;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 5px 10px;
            width: 100%;
            box-sizing: border-box;
            border-top: 1px solid #ddd;
        }

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

        .chat-window__input--field:focus+.chat-window__input--placeholder,
        .chat-window__input--field:not(:empty)+.chat-window__input--placeholder {
            display: none;
        }

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

        .chat-window__btn--enter {
            margin-left: 5px;
            text-decoration: none;
            color: #007aff;
            font-size: 20px;
        }

        .chat-window__btn--enter:hover {
            color: #005bb5;
        }

        .message img.emoji {
            width: 22px;
            height: 22px;
            vertical-align: middle;
        }

        .chat-float {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 99999;
            display: none;
        }

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

        @media (max-width: 768px) {
            .chat-float {
                display: block;
            }
        }

        /* loader style */
        .chat-loader {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50px;
        }

        .chat-loader>div {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #f5bd02;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 12px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        /* Add a send button for chat input */
        .chat-window__send-btn {
            margin-left: 8px;
            border: none;
            background: #F5BD02;
            color: #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .chat-window__send-btn:hover {
            background: #e0ae00;
        }
        /* Custom styles for sent/received messages */
        .chat-message {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            max-width: 65%;
            background: #f9f9f9;
            border-radius: 12px;
            padding: 8px 14px;
            word-break: break-word;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .chat-message.own-message {
            background: #F5BD02;
            color: #fff;
            margin-left: auto;
            margin-right: 0;
            align-items: flex-end;
        }
        .chat-message.their-message {
            background: #fff;
            color: #333;
            margin-right: auto;
            margin-left: 0;
            align-items: flex-start;
            border: 1px solid #e5e5e5;
        }
        .chat-message .author {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .chat-message .body {
            font-size: 15px;
        }
    </style>
@endpush

<div id="buddy-chat-app" class="dash d-none d-md-block">
    <div id="buddy-chat-buddies" class="collapsed">
        <div class="buddy-chat-buddies__container">
            <div class="header-container">
                <div class="header-title">
                    <span class="dashicons dashicons-format-chat"></span>
                    <div class="window-title">
                        <h5>Messenger</h5>
                    </div>
                </div>
                <div class="dropd-group dropd-dr">
                    <a class="dropd-control mute"><span class="dashicons dashicons-admin-generic"></span></a>
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
                                            <div class="bpc-item mb-3 chat-buddy-item"
                                                data-user="{{ $friend->username }}"
                                                data-userid="{{ $friend->user_id }}">
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
                <li class="chat-window" id="{{ $windowId }}" style="display: none;"
                    data-userid="{{ $friend->user_id }}">
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
                                <div class="chat-loader" style="display: none;">
                                    <div></div>
                                </div>
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
                                <button class="chat-window__send-btn" data-friend="{{ $friend->user_id }}" data-receiver="{{ $friend->user_id }}" title="Send" type="button">
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </button>
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

@push('script')
    <script>
        let messageOffsets = {};
        let messageLoading = {};
        const loggedInUserId = '{{ Auth::user()->user_id }}';

        function showLoader($chatWindow) {
            $chatWindow.find('.chat-loader').show();
        }
        function hideLoader($chatWindow) {
            $chatWindow.find('.chat-loader').hide();
        }

        function loadMessages(userId, append = false, beforeMessageId = null) {
            const $chatWindow = $('#chat-window-' + userId.replace(/[^A-Za-z0-9\-]/g, '-'));
            const $messageList = $('#messages-' + userId);
            if (!messageOffsets[userId]) messageOffsets[userId] = 0;
            if (!messageLoading[userId]) messageLoading[userId] = false;

            if (messageLoading[userId]) return;

            messageLoading[userId] = true;
            showLoader($chatWindow);

            let offset = messageOffsets[userId];

            $.ajax({
                url: '{{ route('chat.load-messages') }}',
                method: 'GET',
                data: {
                    user_id: userId,
                    offset: offset,
                    limit: 10,
                    before_message_id: beforeMessageId || ''
                },
                success: function(response) {
                    hideLoader($chatWindow);
                    if (Array.isArray(response.messages)) {
                        let html = '';
                        response.messages.forEach(function(msg) {
                            // Determine ownership and generate correct CSS class
                            let senderId =
                                typeof msg.sender_id !== 'undefined'
                                    ? String(msg.sender_id)
                                    : '';
                            let isOwn = (senderId === loggedInUserId);
                            html += renderSingleMessage(msg, isOwn);
                        });

                        if (append) {
                            $messageList.append(html);
                        } else {
                            $messageList.prepend(html);
                            if ($messageList[0]) {
                                $messageList.parent()[0].scrollTop = $messageList[0].scrollHeight / 2;
                            }
                        }
                        messageOffsets[userId] += response.messages.length;
                    }
                    if (!response.messages || response.messages.length < 10) {
                        $messageList.data('end', true);
                    }
                    messageLoading[userId] = false;
                },
                error: function() {
                    hideLoader($chatWindow);
                    messageLoading[userId] = false;
                }
            });
        }

        // Helper to render message on right for current user, left otherwise
        function renderSingleMessage(msg, isOwn = true) {
            // Use msg.message (string) if present, fall back to msg.body for backwards compatibility
            let messageText = typeof msg.message !== 'undefined' ? msg.message : (typeof msg.body !== 'undefined' ? msg.body : '');
            let senderName = typeof msg.sender_name !== 'undefined' ? msg.sender_name : '';
            let cssClass = isOwn ? 'own-message' : 'their-message';
            return `<li class="chat-message ${cssClass}">
                    <div class="author">${senderName ? senderName + ':' : ''}</div>
                    <div class="body">${messageText}</div>
                </li>`;
        }

        // Buddy list click handler
        $(document).on('click', '.chat-buddy-item', function() {
            let userId = $(this).attr('data-userid');
            $('.chat-window').hide();
            let $cw = $('.chat-window[data-userid="' + userId + '"]');
            $cw.show();
            $('#messages-' + userId).html('').removeData('end');
            messageOffsets[userId] = 0;
            showLoader($cw);
            loadMessages(userId);
        });

        // Close chat window button
        $(document).on('click', '.chat_window__close-btn', function(e) {
            e.preventDefault();
            $(this).closest('.chat-window').hide();
        });

        // Infinite scroll: load more messages when scroll top
        $(document).on('scroll', '.chat-window__message-list .vb-content', function() {
            let $el = $(this);
            let $ul = $el.find('.bpc-chat-list');
            let userId = $ul.attr('id')?.replace('messages-', '');
            if (!userId) return;
            if (messageLoading[userId]) return;
            if ($ul.data('end')) return;
            if ($el.scrollTop() <= 60) {
                let firstMessageId = $ul.children().first().data('messageid') || null;
                loadMessages(userId, false, firstMessageId);
            }
        });

        // === SEND MESSAGE FUNCTIONALITY ===

        // Handler for send button
        $(document).on('click', '.chat-window__send-btn', function () {
            let receiverId = $(this).data('receiver');
            let userId = receiverId; // For this context
            let $input = $('.message-input[data-friend="' + receiverId + '"]');
            let $msgList = $('#messages-' + receiverId);
            let message = $input.text().trim();

            if (!message || message.length === 0) return;

            // Disable send button during request
            let $btn = $(this);
            $btn.prop('disabled', true);

            $.ajax({
                url: '{{ route('chat.send-message') }}',
                method: 'POST',
                data: {
                    receiver: receiverId, // Backend expects "receiver"
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success' && response.message) {
                        let msgObj;
                        // Controller may return the message as a string or object
                        if (typeof response.message === 'string') {
                            msgObj = {
                                message: response.message,
                                sender_name: '{{ Auth::user()->username }}',
                                sender_id: loggedInUserId
                            };
                        } else {
                            // Add sender_id fallback from response if not present
                            msgObj = response.message;
                            if (typeof msgObj.sender_id === 'undefined') {
                                msgObj.sender_id = loggedInUserId;
                            }
                            if (typeof msgObj.sender_name === 'undefined') {
                                msgObj.sender_name = '{{ Auth::user()->username }}';
                            }
                        }

                        $msgList.append(renderSingleMessage(msgObj, true));
                        // Always scroll to show new message
                        let chatContent = $msgList.closest('.vb-content')[0];
                        if (chatContent) chatContent.scrollTop = chatContent.scrollHeight;
                        $input.text('');
                    } else if (response.errors) {
                        let firstError = Object.values(response.errors)[0];
                        if (Array.isArray(firstError)) firstError = firstError[0];
                        alert(firstError || 'Message could not be sent.');
                    } else {
                        alert('Message could not be sent.');
                    }
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let firstError = Object.values(xhr.responseJSON.errors)[0];
                        if (Array.isArray(firstError)) firstError = firstError[0];
                        alert(firstError || 'An error occurred.');
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                },
                complete: function () {
                    $btn.prop('disabled', false);
                }
            });
        });

        // Send message on ctrl+enter or simple enter (when focused)
        $(document).on('keydown', '.message-input', function (e) {
            let userId = $(this).data('friend');
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                $('.chat-window__send-btn[data-friend="' + userId + '"]').click();
            }
        });
    </script>
@endpush
