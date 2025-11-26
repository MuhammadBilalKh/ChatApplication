<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" media="all" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" media="all" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" media="all" />

    <link rel="stylesheet" href="https://mythemestore.com/beehive-preview/wp-content/themes/beehive/assets/css/bootstrap.min.css?ver=1.6.1" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/beehive.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/woocommerce.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce-layout.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/post-95.css" media="all" />
    <link rel="stylesheet" href="/assets/css/kmk.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" media="all" />
    <link rel="stylesheet" href="/assets/css/job-manager.css" media="all" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

    @stack('css')

</head>

<body
    class="directory activity kmkpress bp-nouveau blog  page-template-default page page-id-35 wp-theme-kmk theme-kmk woocommerce-no-js kmk kmk-guest-user kmk-default kmk-kit-30 title-bar-active kmk-social-layout panel-expanded has-page-sidebar no-js">

    @include('layout.master.sidepanel')

    <div id="kmk-page" class="site">
        @include('layout.master.header')

        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <div class="layout social">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-8 col-main">
                                <main id="main" class="main-content">

                                    @yield('dashboard-breadcrumbs')

                                    @yield('dashboard-content')

                                </main>
                            </div>
                            @include('layout.master.right_panel')
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.master.chatbar')
            @include('layout.master.chat_windows')
        </div>
    </div>

    @include('partials.content_modal')
</body>

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/mscrollbar.min.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/hiraku.min.js"></script>
<script src="/assets/js/flexmenu.min.js"></script>
<script src="/assets/js/masonry.min.js"></script>
<script src="/assets/js/jquery.fitvids.min.js"></script>
<script src="/assets/js/emoji-button-3.0.3.min.js"></script>

<script src="/assets/js/kmk.min.js"></script>
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/lib/media-element/mediaelement-and-player.min.js?ver=4.7.3">
</script>
<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/lib/media-element/wp-mediaelement.min.js?ver=4.7.3">
</script>
<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/app/assets/js/vendors/emoji-picker.js?ver=4.7.3">
</script>

<!-- chat -->

@stack('script')

<script>
    jQuery(document).ready(function($) {
        // Initialize Fancybox
        $('#openModalBtn').on('click', function() {
            $.fancybox.open();
        });

        $('#postCloser').on('click', function() {
            $.fancybox.close();
        });

        $('[data-fancybox]').fancybox({
            loop: true,
            buttons: ["zoom", "share", "close"],
            smallBtn: true,
            closeBtn: true,
        });

        // Emoji Picker for comments
        const emojiBtn2 = document.getElementById('emojiBtn2');
        const inputField2 = document.getElementById('comment_content');

        if (emojiBtn2 && inputField2) {
            const picker2 = new EmojiButton({
                position: 'top-start',
                theme: 'light'
            });

            picker2.on('emoji', emoji => {
                inputField2.value += emoji;
                inputField2.focus();
            });

            emojiBtn2.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                picker2.togglePicker(emojiBtn2);
            });
        }

        // Comment functionality
        $(document).on('click', '.rt_media_comment_submit', function(e) {
            e.preventDefault();

            var commentText = $('#comment_content').val();
            if (commentText.trim() !== "") {
                var $commentUl = $('#rtmedia_comment_ul');
                if ($commentUl.length === 0) {
                    $commentUl = $(this).closest('.rtm-media-single-comments')
                        .siblings('.rtmedia-item-comments').find('#rtmedia_comment_ul');
                }

                var $submitBtn = $(this);
                var postIdValue = $("#txtPostID").val();

                var newComment = `
                        <li class="rtmedia-comment">
                            <div class="rtmedia-comment-user-pic">
                                <a href="#" title="Current User">
                                    <img loading="lazy" src="{{ asset(Auth::user()->profile_picture) }}" class="avatar" width="90" height="90" alt="Profile Photo">
                                </a>
                            </div>
                            <div class="rtm-comment-wrap">
                                <div class="rtmedia-comment-details">
                                    <span class="rtmedia-comment-author"><a href="#" title="Current User">{{ Auth::user()->username }}</a></span>
                                    <span class="rtmedia-comment-date">Just now</span>
                                    <div class="rtmedia-comment-content">
                                        <p>${commentText}</p>
                                    </div>
                                </div>
                            </div>
                        </li>`;

                $.ajax({
                    url: "{{ route('comments.store') }}",
                    type: "{{ FORM_METHOD_POST }}",
                    data: {
                        parent_comment_id: '',
                        post_id: postIdValue,
                        content: commentText,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(resp) {
                        if (resp.status === "success") {
                            if ($commentUl.length) {
                                $commentUl.append(newComment);
                            }
                            $('#comment_content').val('');
                        }
                    }
                });
            }
        });

        // Delete comment
        $(document).on('click', '.rtmedia-delete-comment', function(e) {
            e.preventDefault();

            if (window.confirm('Are you sure you want to delete this comment?')) {
                var $comment = $(this).closest('.rtmedia-comment');
                $.ajax({
                    url: "{{ route('comments.destroy') }}",
                    type: "{{ FORM_METHOD_POST }}",
                    data: {
                        comment_id: $(this).data("id"),
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(resp) {
                        if (resp.status == "success") {
                            $comment.remove();
                        }
                    }
                });
            }
        });

        // Initialize chat system
        initializeChatSystem();
    });

    // Chat System Functions
    function initializeChatSystem() {
        const chatBuddies = document.getElementById('buddy-chat-buddies');
        const collapserButton = document.getElementById('buddy-chat-buddies__collapser');
        const emojiPickers = new Map();
        let activeInputField = null;

        // Collapser functionality
        if (collapserButton) {
            collapserButton.addEventListener('click', () => {
                chatBuddies.classList.toggle('collapsed');
            });
        }

        // Chat buddy click handlers
        document.querySelectorAll('.bpc-item').forEach(item => {
            item.addEventListener('click', () => {
                const userName = item.getAttribute('data-user');
                openChatWindow(userName);
            });
        });

        // Close button handlers
        document.querySelectorAll('.chat_window__close-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const chatWindow = button.closest('.chat-window');
                chatWindow.style.display = 'none';
            });
        });

        // Initialize emoji pickers for each chat window
        document.querySelectorAll('.chat-window').forEach(chatWindow => {
            const emojiBtn = chatWindow.querySelector('.emojiBtn');
            const inputField = chatWindow.querySelector('.chat-window__input--field');

            if (emojiBtn && inputField) {
                const picker = new EmojiButton({
                    position: 'top-start',
                    theme: 'light',
                    autoFocusSearch: false
                });

                picker.on('emoji', emoji => {
                    if (inputField === activeInputField) {
                        insertEmojiAtCursor(inputField, emoji);
                        updatePlaceholderVisibility(inputField);
                        inputField.focus();
                    }
                });

                emojiBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    activeInputField = inputField;
                    picker.togglePicker(emojiBtn);
                });

                emojiPickers.set(inputField, picker);
            }
        });

        // Input field event handlers
        document.querySelectorAll('.chat-window__input--field').forEach(inputField => {
            inputField.addEventListener('focus', function() {
                activeInputField = this;
                updatePlaceholderVisibility(this);
                setTimeout(() => {
                    placeCaretAtEnd(this);
                }, 0);
            });

            inputField.addEventListener('input', function() {
                updatePlaceholderVisibility(this);
            });

            inputField.addEventListener('blur', function() {
                if (activeInputField === this) {
                    activeInputField = null;
                }
            });

            inputField.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage(this);
                }
            });

            inputField.addEventListener('click', function() {
                setTimeout(() => {
                    placeCaretAtEnd(this);
                }, 0);
            });
        });

        // Send button handlers
        document.querySelectorAll('.chat-window__btn--enter').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const inputArea = this.closest('.chat-window__inputarea');
                const inputField = inputArea.querySelector('.chat-window__input--field');
                if (inputField) {
                    sendMessage(inputField);
                }
            });
        });

        // Mobile chat toggle
        const toggleChat = document.getElementById('toggle-chat');
        if (toggleChat) {
            toggleChat.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    document.getElementById('buddy-chat-app').classList.toggle('d-none');
                }
            });
        }
    }

    function openChatWindow(username) {
        const chatWindow = document.getElementById(`chat-window-${username.replace(/[^A-Za-z0-9\-]/g, '-')}`);

        if (chatWindow) {
            // Hide all chat windows first
            document.querySelectorAll('.chat-window').forEach(window => {
                window.style.display = 'none';
            });

            // Show the selected chat window
            chatWindow.style.display = 'block';

            // Focus on the input field
            const inputField = chatWindow.querySelector('.chat-window__input--field');
            if (inputField) {
                setTimeout(() => {
                    inputField.focus();
                    placeCaretAtEnd(inputField);
                }, 100);
            }
        }
    }

    function updatePlaceholderVisibility(inputField) {
        const placeholder = inputField.parentNode.querySelector('.chat-window__input--placeholder');
        if (placeholder) {
            placeholder.style.display = inputField.textContent.trim() ? 'none' : 'block';
        }
    }

    function placeCaretAtEnd(element) {
        element.focus();
        if (typeof window.getSelection !== "undefined" && typeof document.createRange !== "undefined") {
            const range = document.createRange();
            range.selectNodeContents(element);
            range.collapse(false);
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
        }
    }

    function insertEmojiAtCursor(element, emoji) {
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            range.deleteContents();
            const textNode = document.createTextNode(emoji);
            range.insertNode(textNode);
            range.setStartAfter(textNode);
            range.setEndAfter(textNode);
            selection.removeAllRanges();
            selection.addRange(range);
        } else {
            element.textContent += emoji;
        }

        const event = new Event('input', {
            bubbles: true
        });
        element.dispatchEvent(event);
    }

    function sendMessage(inputField) {
        const message = inputField.textContent.trim();
        if (!message) return;

        const friendId = inputField.getAttribute('data-friend');
        const messagesList = document.getElementById(`messages-${friendId}`);

        if (messagesList) {
            const newMsg = document.createElement('li');
            newMsg.classList.add('message--self');
            newMsg.innerHTML = `<time>${new Date().toLocaleString()}</time>
                <div class="message-block">
                    <div class="messages">
                        <div class="message">${message}</div>
                    </div>
                </div>`;

            messagesList.appendChild(newMsg);

            inputField.textContent = '';
            updatePlaceholderVisibility(inputField);

            messagesList.scrollTop = messagesList.scrollHeight;

            inputField.focus();
        }

        // AJAX call to send message to backend would go here
        console.log(`Sending message to friend ${friendId}: ${message}`);

        // Example AJAX implementation:
        /*
        fetch('/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                friend_id: friendId,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Message sent successfully
            }
        });
        */
    }

    // Lazy load observer
    const lazyloadRunObserver = () => {
        const lazyloadBackgrounds = document.querySelectorAll('.e-con.e-parent:not(.e-lazyloaded)');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('e-lazyloaded');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '200px 0px 200px 0px'
        });
        lazyloadBackgrounds.forEach(el => observer.observe(el));
    };

    ['DOMContentLoaded', 'kmk/lazyload/observe'].forEach(e => document.addEventListener(e, lazyloadRunObserver));
</script>

</html>
