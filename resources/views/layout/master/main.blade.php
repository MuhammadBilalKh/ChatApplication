<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" media="all" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" media="all" />

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/kmk.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" media="all" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />


    <style>
        .fancybox-content {
            background: transparent;
            display: inline-block;
            margin: 0;
            max-width: 100%;
            overflow: visible;
            -webkit-overflow-scrolling: touch;
            position: relative;
            text-align: left;
            vertical-align: middle;
        }

        .mfp-container {
            max-width: 100%;
            height: auto;
        }

        .fancybox-button {
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .fancybox-button:hover {
            background-color: #555;
        }

        .emoji-picker,
        #emojiBtn2 {
            font-size: 20px;
            cursor: pointer;
        }

        .modal-contentPost {
            width: 1200px;
            height: auto;
            max-width: 95vw;
            max-height: none;
            /* background: #fff; */
            border-radius: 10px;
            overflow: visible;
        }

        button.rtmedia-edit.rtmedia-action-buttons.button,
        button.rtmedia-delete-media.rtmedia-action-buttons.button {
            background: transparent;
            box-shadow: none;
            padding: 9px;
        }

        .rtmedia-single-container button.rtmedia-like:hover,
        .rtmedia-single-container button.rtmedia-like:active,
        .rtmedia-single-container button.rtmedia-like:focus {
            color: #f5bd02;
        }

        .fancybox-close-small {
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .modal-contentPost {
                width: 90vw;
                height: 600px;
                max-height: none;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        @media (max-width: 600px) {
            .modal-contentPost {
                width: 95vw;
                height: auto;
                max-height: none;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 20px;
            }

            textarea#comment_content {
                font-size: 14px;
            }

            .fancybox-content {
                padding: 0;
            }
        }
    </style>

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
                            @include('layout.master.chat_windows')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.master.chatbar')

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}

{{-- <script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/lib/media-element/mediaelement-and-player.min.js?ver=4.7.3">
</script>
<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/lib/media-element/wp-mediaelement.min.js?ver=4.7.3">
</script>
<script type="text/javascript"
    src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/plugins/buddypress-media/app/assets/js/vendors/emoji-picker.js?ver=4.7.3">
</script> --}}

<script>
    const chatBuddies = document.getElementById('buddy-chat-buddies');
    const collapserButton = document.getElementById('buddy-chat-buddies__collapser');
    const chatWindowCloseButtons = document.querySelectorAll('.chat_window__close-btn');
    const chatBuddiesItems = document.querySelectorAll('.bpc-item');
    const emojiBtn = document.getElementById('emojiBtn');
    const inputField = document.querySelector('.chat-window__input--field');
    const placeholder = document.querySelector('.chat-window__input--placeholder');
    const sendButton = document.querySelector('.chat-window__btn--enter');
    const chatList = document.querySelector('.bpc-chat-list');

    // Toggle sidebar
    // collapserButton.addEventListener('click', () => {
    //     chatBuddies.classList.toggle('collapsed');
    // });

    // Close chat
    chatWindowCloseButtons.forEach(button => {
        button.addEventListener('click', () => {
            const chatWindow = button.closest('.chat-window');
            chatWindow.style.display = 'none';
        });
    });

    // Open chat
    chatBuddiesItems.forEach(item => {
        item.addEventListener('click', () => {
            const userName = item.querySelector('.chat-buddy').textContent.trim();
            const chatWindow = document.getElementById(`chat-window-${userName.replace(" ", "-")}`);
            if (chatWindow) chatWindow.style.display = 'block';
        });
    });

    // Input placeholder logic
    if (inputField) {
        inputField.addEventListener('input', function() {
            placeholder.style.display = this.textContent.trim() ? 'none' : 'block';
        });
    }

    // Send message
    function sendMessage() {
        const message = inputField.textContent.trim();
        if (!message) return;

        const newMsg = document.createElement('li');
        newMsg.classList.add('message--self');
        newMsg.innerHTML = `
            <time>${new Date().toLocaleString()}</time>
            <div class="message-block">
                <div class="messages">
                    <div class="message">${message}</div>
                </div>
            </div>
        `;

        chatList.appendChild(newMsg);
        inputField.textContent = '';
        placeholder.style.display = 'block';

        // ✅ Scroll to latest message
        chatList.scrollTop = chatList.scrollHeight;
    }

    // Send on button click
    if (sendButton) {
        sendButton.addEventListener('click', e => {
            e.preventDefault();
            sendMessage();
        });
    }

    // Send on Enter key
    if (inputField) {
        inputField.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    // === Emoji Picker ===
    // Only initialize if emojiBtn exists
    if (emojiBtn) {
        const picker = new EmojiButton({
            position: 'top-start',
            theme: 'light'
        });

        picker.on('emoji', emoji => {
            inputField.textContent += emoji;
            inputField.focus();
            placeholder.style.display = 'none';
        });

        emojiBtn.addEventListener('click', () => picker.togglePicker(emojiBtn));
    }

    //mobile toggle chat
    $('#toggle-chat').on('click', function() {

        // Check screen width for mobile (under 768px)
        if ($(window).width() < 768) {
            $('#buddy-chat-app').toggleClass('d-none');
        } else {
            console.log('Not mobile view — no toggle.');
        }
    });
</script>
<!-- chat -->

@stack('script')

<script>
    jQuery(document).ready(function() {

        jQuery('#openModalBtn').on('click', function() {
            $.fancybox.open();
        });

        jQuery('#postCloser').on('click', function() {
            $.fancybox.close();
        });

        jQuery('[data-fancybox]').fancybox({
            loop: true,
            buttons: ["zoom", "share", "close"],
            smallBtn: true,
            closeBtn: true,
        });

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

        jQuery('.rtmedia-like, .rt_media_comment_submit').on('click', function(e) {
            e.preventDefault();

            if (jQuery(this).hasClass('rtmedia-like')) {
                jQuery(this).toggleClass('liked');
                if (jQuery(this).hasClass('liked')) {
                    jQuery(this).find('span').text('Unlike');
                } else {
                    jQuery(this).find('span').text('Like');
                }
            }

            if (jQuery(this).attr('id') === 'rt_media_comment_submit') {
                var commentText = jQuery('#comment_content').val();
                if (commentText.trim() !== "") {
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
                            </li> `;
                    jQuery('#rtmedia_comment_ul').append(newComment);
                    jQuery('#comment_content').val('');
                }
            }
        });

        jQuery(document).on('click', '.rtmedia-delete-comment', function(e) {
            e.preventDefault();
            jQuery(this).closest('.rtmedia-comment').remove();
        });
    });
</script>

<script>
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
    ['DOMContentLoaded', 'kmk/lazyload/observe']
    .forEach(e => document.addEventListener(e, lazyloadRunObserver));

    jQuery.ajax({
        url: "{{ route('users.show_stats') }}",
        type: "{{ FORM_METHOD_POST }}",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        success: function(resp) {
            if (resp.pendingFriendRequests == 0) {
                jQuery("#pendingFriendRequestCount").html("No Pending Request Found")
            } else {
                jQuery("#pendingFriendRequestCount").html(resp.pendingFriendRequests + " Pending Request")
            }

            jQuery("#totalFriendsCount").html(resp.totalFriends);
        }
    });
</script>

</html>
