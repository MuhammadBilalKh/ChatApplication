@push('css')
    <style>
        /* Updated chat bubble and window styles as per revised spec */
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
            background: transparent;
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

        .message--self {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-left: auto;
            margin-right: 0;
            margin-bottom: 12px;
            max-width: 65%;
            background: #F5BD02;
            color: #fff;
            border-radius: 18px 18px 4px 18px;
            padding: 0;
            border: none;
        }

        .message--other {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-right: auto;
            margin-left: 0;
            margin-bottom: 12px;
            max-width: 65%;
            background: #fff;
            color: #333;
            border-radius: 18px 18px 18px 4px;
            border: 1px solid #e5e5e5;
            padding: 0;
        }

        .message-block {
            display: flex;
            flex-direction: row;
            margin-top: 2px;
            width: 100%;
        }

        .messages {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .message--self .messages .message,
        .message--other .messages .message {
            background: none;
            color: inherit;
            font-size: 15px;
            padding: 8px 14px;
            border-radius: 0;
            word-break: break-word;
        }

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
                                <span class="status {{ $friend->is_online ? 'online' : 'offline' }}"></span>
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
                        <div class="chat-window__message-list vb vb-invisible">
                            <div class="vb-content" style="overflow-y:scroll; max-height: 350px;">
                                <div class="chat-loader" style="display: none;">
                                    <div></div>
                                </div>
                                <ul class="bpc-chat-list overflow-auto" id="messages-{{ $friend->user_id }}">
                                    <!-- JS will load messages using .message--self (right, sent) or .message--other (left, received) -->
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="chat-window__inputarea" data-friend="{{ $friend->user_id }}">
                                <div class="chat-window__input">
                                    <div class="chat-window__input--placeholder">Write your message</div>
                                    <div contenteditable="true" class="chat-window__input--field message-input"
                                        data-friend="{{ $friend->user_id }}"></div>
                                </div>
                                <div class="chat-window__input--emoji">
                                    <button type="button" class="emojiBtn">😊</button>
                                </div>
                                <button class="chat-window__send-btn" data-friend="{{ $friend->user_id }}"
                                    data-receiver="{{ $friend->user_id }}" title="Send" type="button">
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
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>

    <script>
        const socket = io("http://localhost:3002");
        let messageOffsets = {};
        let messageLoading = {};
        const loggedInUserId = '{{ Auth::user()->user_id }}';

        socket.emit("join", loggedInUserId);

        socket.on("receive-message", function(data) {
            let userId = data.sender_id;

            let msgList = $("#messages-" + userId);

            // If chat window is not open → open it automatically (optional)
            let win = $('.chat-window[data-userid="' + userId + '"]');
            win.show();

            msgList.append(`
                <li class="message--other">
                    <div class="message-block">
                        <div class="messages">
                            <div class="message">${data.message}</div>
                        </div>
                    </div>
                </li> `);

            // Scroll to bottom
            let chatContent = msgList.closest('.vb-content')[0];
            chatContent.scrollTop = chatContent.scrollHeight;
        });

        // Show loader utility
        function showLoader($chatWindow) {
            $chatWindow.find('.chat-loader').show();
        }

        function hideLoader($chatWindow) {
            $chatWindow.find('.chat-loader').hide();
        }

        // Load initial and scrollable messages (+scroll to bottom/top logic)
        function loadMessages(userId, {
            append = false,
            beforeMessageId = null,
            scrollTo = 'bottom'
        } = {}) {
            const $chatWindow = $('#chat-window-' + userId.replace(/[^A-Za-z0-9\-]/g, '-'));
            const $messageList = $('#messages-' + userId);
            if (!messageOffsets[userId]) messageOffsets[userId] = 0;
            if (!messageLoading[userId]) messageLoading[userId] = false;
            if (messageLoading[userId]) return;

            messageLoading[userId] = true;
            showLoader($chatWindow);

            $.ajax({
                url: '{{ route('chat.load-messages') }}',
                method: 'GET',
                data: {
                    user_id: userId,
                    offset: messageOffsets[userId],
                    limit: 10,
                    before_message_id: beforeMessageId || ''
                },
                success: function(response) {
                    hideLoader($chatWindow);
                    if (Array.isArray(response.messages)) {
                        let html = '';
                        response.messages.forEach(function(msg) {
                            let senderId = typeof msg.sender_id !== 'undefined' ? String(msg
                                .sender_id) : '';
                            let isOwn = (senderId === loggedInUserId);
                            html += renderChatMessageItem(msg, isOwn);
                        });
                        var $currentScrollTarget = $messageList.closest('.vb-content');
                        var previousScrollHeight = $currentScrollTarget[0].scrollHeight;
                        if (append) {
                            $messageList.append(html);
                        } else {
                            $messageList.prepend(html);
                        }
                        messageOffsets[userId] += response.messages.length;
                        // Maintain scroll position if loading older messages
                        if (beforeMessageId !== null && !append) {
                            var newScrollHeight = $currentScrollTarget[0].scrollHeight;
                            $currentScrollTarget[0].scrollTop = newScrollHeight - previousScrollHeight;
                        } else if (scrollTo === 'bottom') {
                            $currentScrollTarget[0].scrollTop = $currentScrollTarget[0].scrollHeight;
                        } else if (scrollTo === 'top') {
                            $currentScrollTarget[0].scrollTop = 0;
                        }
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

        function renderChatMessageItem(msg, isOwn = true) {
            let messageText = '';
            if (typeof msg.message !== 'undefined' && msg.message !== null && msg.message !== '') {
                messageText = msg.message;
            }
            let timestamp = (typeof msg.created_at !== 'undefined' && msg.created_at) ? msg.created_at : '';
            let dateString = timestamp ? `<time>${escapeHtml(timestamp)}</time>` : '';
            let cls = isOwn ? 'message--self' : 'message--other';
            return `<li class="${cls}"${typeof msg.id !== 'undefined' ? ` data-messageid="${msg.id}"`:''}>
                ${dateString}
                <div class="message-block">
                    <div class="messages">
                        <div class="message">${escapeHtml(messageText)}</div>
                    </div>
                </div>
            </li>`;
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str;
        }

        $(document).on('click', '.chat-buddy-item', function() {
            let userId = $(this).attr('data-userid');
            $('.chat-window').hide();
            let $cw = $('.chat-window[data-userid="' + userId + '"]');
            $cw.show();
            $('#messages-' + userId).html('').removeData('end');
            messageOffsets[userId] = 0;
            showLoader($cw);
            loadMessages(userId, {
                scrollTo: 'bottom'
            });
            setTimeout(function() {
                $cw.find('.message-input').focus();
                let $c = $cw.find('.vb-content');
                if ($c.length) $c[0].scrollTop = $c[0].scrollHeight;
            }, 200);
        });

        $(document).on('click', '.chat_window__close-btn', function(e) {
            e.preventDefault();
            $(this).closest('.chat-window').hide();
        });

        $('.chat-window__message-list .vb-content').on('scroll', function() {
            let $el = $(this);
            let $ul = $el.find('.bpc-chat-list');
            let userId = $ul.attr('id')?.replace('messages-', '');
            if (!userId) return;
            if (messageLoading[userId]) return;
            if ($ul.data('end')) return;
            if ($el[0].scrollTop <= 10) {
                let firstMessageId = $ul.children().first().data('messageid') || null;
                loadMessages(userId, {
                    append: false,
                    beforeMessageId: firstMessageId,
                    scrollTo: 'top'
                });
            }
        });

        $(document).on('click', '.chat-window__send-btn', function() {
            let receiverId = $(this).data('receiver');
            let userId = receiverId;
            let $input = $('.message-input[data-friend="' + receiverId + '"]');
            let $msgList = $('#messages-' + receiverId);
            let message = $input.text().trim();

            if (!message || message.length === 0) return;

            let $btn = $(this);
            $btn.prop('disabled', true);

            $.ajax({
                url: '{{ route('chat.send-message') }}',
                method: 'POST',
                headers:{
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                data: {
                    receiver: receiverId,
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (
                        response.status === 'success' &&
                        response.message &&
                        typeof response.message === 'object' &&
                        (
                            typeof response.message.message !== 'undefined' &&
                            response.message.message !== null &&
                            response.message.message !== ''
                        )
                    ) {
                        let msgObj = response.message;
                        if (typeof msgObj.sender_id === 'undefined') {
                            msgObj.sender_id = loggedInUserId;
                        }
                        if (typeof msgObj.created_at === 'undefined') {
                            msgObj.created_at = (new Date()).toLocaleString();
                        }
                        $msgList.append(renderChatMessageItem(msgObj, true));
                        let chatContent = $msgList.closest('.vb-content')[0];
                        if (chatContent) chatContent.scrollTop = chatContent.scrollHeight;
                        socket.emit("send-message", {
                            sender_id: loggedInUserId,
                            receiver_id: receiverId,
                            message: message,
                            created_at: new Date().toLocaleString()
                        });
                        $input.text('');
                    } else if (
                        response.status === 'success' &&
                        response.message &&
                        typeof response.message === 'object' &&
                        (
                            typeof response.message.message === 'undefined' ||
                            response.message.message === null ||
                            response.message.message === ''
                        )
                    ) {
                        // Special case: status is success but .message is missing or empty
                        alert('Message was sent, but it is empty and will not be shown.');
                        $input.text('');
                    } else if (response.status === 'success' && typeof response.message === 'string' &&
                        response.message !== '') {
                        // Legacy support: backend returned message as simple string
                        let msgObj = {
                            message: response.message,
                            sender_id: loggedInUserId,
                            created_at: (new Date()).toLocaleString()
                        };
                        $msgList.append(renderChatMessageItem(msgObj, true));
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
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let firstError = Object.values(xhr.responseJSON.errors)[0];
                        if (Array.isArray(firstError)) firstError = firstError[0];
                        alert(firstError || 'An error occurred.');
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    $btn.prop('disabled', false);
                }
            });
        });

        // Send on Enter (no shift) in input
        $(document).on('keydown', '.message-input', function(e) {
            let userId = $(this).data('friend');
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                $('.chat-window__send-btn[data-friend="' + userId + '"]').click();
            }
        });

        // Listen for the real-time MessageSent event broadcast from the server after send-message POST
        if (typeof Echo !== 'undefined') {
            Echo.channel('my-channel')
                .listen('.my-event', (event) => {
                    let messageObj = event.message || {};
                    let chatUserId = '';

                    if (String(messageObj.sender_id) === String(loggedInUserId)) {
                        // Sent by this user; show in receiver's chat window as self
                        chatUserId = messageObj.receiver_id;
                    } else {
                        // Received from other user; show in their chat window as an "other" message
                        chatUserId = messageObj.sender_id;
                    }

                    // Try to find the correct chat message list
                    let msgListSelector = '#messages-' + chatUserId;
                    let $msgList = $(msgListSelector);
                    if ($msgList.length) {
                        // Prevent duplicate message display by ID
                        if (
                            !$msgList.children('[data-messageid="' + (messageObj.id || '') + '"]').length &&
                            typeof renderChatMessageItem === 'function'
                        ) {
                            let isOwn = (String(messageObj.sender_id) === String(loggedInUserId));
                            $msgList.append(renderChatMessageItem(messageObj, isOwn));
                            let chatContent = $msgList.closest('.vb-content')[0];
                            if (chatContent) chatContent.scrollTop = chatContent.scrollHeight;
                        }
                    }
                });
        }
    </script>
@endpush
