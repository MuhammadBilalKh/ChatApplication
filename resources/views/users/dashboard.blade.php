@extends('layout.master.main')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageTitle' => 'Blog',
    ])
@endsection

@section('dashboard-content')
    <article id="post-0" class="bp_activity type-bp_activity post-0 page type-page status-publish hentry kmk-post">
        <div class="entry-content clearfix">
            <div id="kmkpress" class="kmkpress-wrap kmk bp-dir-hori-nav alignwide">

                <h2 class="bp-screen-reader-text">Post Update</h2>

                @if (session()->has('post-upload-success'))
                    <div class="alert alert-success alert-dismissible">
                        <span>{{ session()->get('post-upload-success') }}</span>
                        <button class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $key => $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                @endif

                <div id="bp-nouveau-activity-form" class="activity-update-form">
                    <form action="{{ route('posts.store') }}" name="whats-new-form" method="{{ FORM_METHOD_POST }}"
                        enctype="multipart/form-data" id="whats-new-form" class="activity-form activity-form-expanded">
                        @csrf
                        <div id="whats-new-avatar">

                            <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/novipa/">
                                <img src="{{ asset(Auth::user()->profile_picture) }}"
                                    class="avatar user-8-avatar avatar-50 photo" width="50" height="50"
                                    alt="Profile photo of Novipa">
                            </a>

                        </div>
                        <div id="whats-new-content">
                            <div id="whats-new-textarea" style="position: relative;">
                                <textarea name="description" cols="50" rows="4" placeholder="What's new, {{ Auth::user()->username }}?"
                                    aria-label="To enrich screen reader interactions, please activate Accessibility in Grammarly extension settings"
                                    id="whats-new" class="bp-suggestions" spellcheck="false" maxlength="3000" style="resize: vertical; height: auto;"></textarea>
                            </div>
                        </div>
                        <div class="rtmedia-container rtmedia-uploader-div clearfix"
                            style="opacity: 1; display: block; visibility: visible;">

                            <div class="rtmedia-uploader no-js">
                                <div id="rtmedia-uploader-form">

                                    <div class="rtm-tab-content-wrapper">
                                        <div id="rtm-file_upload-ui" class="rtm-tab-content">
                                            <div class="rtmedia-plupload-container rtmedia-container clearfix">
                                                <div id="rtmedia-action-update" class="">
                                                    <div class="rtm-upload-button-wrapper">
                                                        <div id="rtmedia-whts-new-upload-container"
                                                            style="position: relative;">
                                                            <div id="html5_1j8u2f1q1aon1eei190eik911tu3_container"
                                                                class="moxie-shim moxie-shim-html5"
                                                                style="position: absolute; top: 0px; left: 0px; width: 141px; height: 30px; overflow: hidden; z-index: 0;">
                                                                <input id="html5_1j8u2f1q1aon1eei190eik911tu3"
                                                                    type="file" name="media[]"
                                                                    style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"
                                                                    multiple=""
                                                                    accept="image/jpeg,.jpg,.jpeg,image/png,.png,image/gif,.gif,video/mp4,.mp4,audio/mpeg,.mp3">
                                                            </div>
                                                        </div><button type="button" class="rtmedia-add-media-button"
                                                            id="rtmedia-add-media-button-post-update" title="Attach Media"
                                                            style="position: relative; z-index: 1;"><span
                                                                class="dashicons dashicons-admin-media"></span><span
                                                                class="button-text">Attach
                                                                media</span></button>
                                                    </div><span style="font-size: 12px; opacity: 0.7;">Max.
                                                        File Size: 2048M</span>
                                                </div>
                                            </div>
                                            <div class="rtmedia-plupload-notice">
                                                <ul class="plupload_filelist_content ui-sortable rtm-plupload-list clear-both"
                                                    id="rtmedia_uploader_filelist">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="rtmedia_upload_nonce" value="098cf08bfa">

                                    <input type="submit" id="rtMedia-start-upload" name="rtmedia-upload" value="Upload"
                                        style="display: none;">

                                </div>
                            </div>
                        </div>
                        <div id="whats-new-options" style="opacity: 1;">
                            <div id="whats-new-submit" class="in-profile"><input type="submit" id="aw-whats-new-submit"
                                    class="button" name="aw-whats-new-submit" value="Post Update"><input type="reset"
                                    id="aw-whats-new-reset" class="text-button small" value="Cancel"></div>
                        </div>
                    </form>
                </div>

                <nav class="activity-type-navs main-navs bp-navs dir-navs " role="navigation" aria-label="Directory menu">


                    <ul class="component-navigation activity-nav">


                        <li id="activity-all" class="dynamic selected" data-bp-scope="all" data-bp-object="activity">
                            <a href="./activity-2/">
                                All Members
                                <span class="count"></span>
                            </a>
                        </li>


                        <li id="activity-mentions" class="dynamic" data-bp-scope="mentions" data-bp-object="activity">
                            <a href="./members-2/novipa/activity/mentions/">
                                Mentions
                                <span class="count"></span>
                            </a>
                        </li>

                    </ul>

                </nav>

                <div class="screen-content">

                    <div id="activity-stream" class="activity" data-bp-list="activity" style="">
                        <div class="alert alert-info" id="alertResponse">
                            <span><i class="fa fa-spinner"></i> Loading The Community Events.</span>
                        </div>

                        <ul class="activity-list item-list bp-list" id="listPosts">

                        </ul>

                    </div>

                </div>

            </div>
        </div>
    </article>
@endsection

@push('script')
    <script>
        let page = 1;
        let loading = false;

        jQuery(document).ready(function() {
            const alertResponse = jQuery("#alertResponse");
            const listPosts = document.querySelector('#listPosts');
            const uploadButton = document.getElementById('rtmedia-add-media-button-post-update');
            const fileInput = document.getElementById('html5_1j8u2f1q1aon1eei190eik911tu3');
            const fileListContainer = document.getElementById('rtmedia_uploader_filelist');

            // Initially hide alert
            document.title = "Welcome {{ Auth::user()->name }}";

            loadPosts();

            uploadButton.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function(event) {
                const files = event.target.files;

                Array.from(files).forEach(function(file) {
                    const previewElement = document.createElement('li');
                    previewElement.classList.add('plupload_file', 'ui-state-default',
                        'plupload_queue_li');
                    const fileId = `file-${Date.now()}`;
                    previewElement.setAttribute('id', fileId);

                    const thumbContainer = document.createElement('div');
                    thumbContainer.classList.add('plupload_file_thumb');
                    previewElement.appendChild(thumbContainer);

                    const fileNameContainer = document.createElement('div');
                    fileNameContainer.classList.add('plupload_file_name');
                    fileNameContainer.setAttribute('title', file.name);

                    const fileNameWrapper = document.createElement('span');
                    fileNameWrapper.classList.add('plupload_file_name_wrapper');
                    fileNameWrapper.textContent = file.name;
                    fileNameContainer.appendChild(fileNameWrapper);

                    previewElement.appendChild(fileNameContainer);

                    const fileSizeContainer = document.createElement('div');
                    fileSizeContainer.classList.add('plupload_file_size');
                    fileSizeContainer.textContent = `${(file.size / 1024).toFixed(2)} KB`;
                    previewElement.appendChild(fileSizeContainer);

                    const removeButton = document.createElement('span');
                    removeButton.classList.add('remove-from-queue', 'dashicons',
                        'dashicons-dismiss');
                    removeButton.addEventListener('click', function() {
                        removeFile(fileId);
                    });

                    const fileActionContainer = document.createElement('div');
                    fileActionContainer.classList.add('plupload_file_action');
                    fileActionContainer.appendChild(removeButton);
                    previewElement.appendChild(fileActionContainer);

                    fileListContainer.appendChild(previewElement);

                    const fileReader = new FileReader();
                    fileReader.onload = function(e) {
                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = file.name;
                            img.style.maxWidth = '100px';
                            img.style.maxHeight = '60px';
                            thumbContainer.appendChild(img);
                        } else if (file.type.startsWith('video/')) {
                            const video = document.createElement('video');
                            video.src = e.target.result;
                            video.controls = true;
                            video.style.maxWidth = '100px';
                            video.style.maxHeight = '60px';
                            thumbContainer.appendChild(video);
                        } else {
                            thumbContainer.textContent = 'No preview available';
                        }
                    };
                    fileReader.readAsDataURL(file);
                });
            });

            function removeFile(fileId) {
                const fileItem = document.getElementById(fileId);
                if (fileItem) fileItem.remove();
            }

            window.addEventListener('scroll', () => {
                const scrollPosition = window.innerHeight + window.scrollY;
                const pageHeight = document.documentElement.scrollHeight;
                if (scrollPosition >= pageHeight - 2) {
                    loadPosts();
                }
            });

            function loadPosts() {
                if (loading) return;
                loading = true;

                alertResponse.html('<i class="fa fa-spinner fa-spin"></i> Loading Community Events...');
                alertResponse.fadeIn();

                fetch(`{{ route('posts.load') }}?page=${page}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.html.trim() !== '') {
                            listPosts.insertAdjacentHTML('beforeend', data.html);
                            page++;
                        }
                        loading = false;
                        alertResponse.fadeOut(300);
                    })
                    .catch(() => {
                        loading = false;
                        alertResponse.html('<span class="text-danger">Error loading posts.</span>');
                        setTimeout(() => alertResponse.fadeOut(300), 500);
                    });
            }

            function SendFriendRequest(receiverID) {
                jQuery.ajax({
                    url: "{{ route('peoples.create_friend_request') }}",
                    type: "{{ FORM_METHOD_POST }}",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    data: {
                        memberID: receiverID,
                    },
                    beforeSend: function() {

                    },
                    success: function(response) {
                        if (response.status == {{ REQUEST_PROCESSED }}) {
                            jQuery("#member-" + receiverID).removeClass("add").addClass("requested")
                        }
                    }
                });
            }

            function CancelFriendRequest(receiverID) {

            }

            function AcceptFriendRequest(receiverID) {

            }

        });
        jQuery(document).ready(function($) {
            // ... your existing file upload code ...

            // Toggle comments section
            $(document).on('click', '.show-comments-btn', function(e) {
                e.preventDefault();
                const postId = $(this).data('post-id');
                const $commentsSection = $('#comments-' + postId);
                $commentsSection.slideToggle(300);
            });

            $(document).on('submit', '.add-comment-form', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $btn = $form.find('[type="submit"]');
                const postId = $form.find('input[name="post_id"]').val();

                $btn.prop('disabled', true).val('Posting...');

                $.ajax({
                    url: "{{ route('comments.store') }}",
                    type: "POST",
                    data: {
                        post_id: postId,
                        content: $form.find('input[name="content"]').val(),
                        parent_comment_id: $form.find('input[name="parent_comment_id"]').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // FIXED: Better selector for comment list
                            const $commentsSection = $form.closest('.post-comments');
                            let $commentList = $commentsSection.find('.comment-list').first();

                            console.log('Comment list found:', $commentList.length); // Debug

                            if ($commentList.length === 0) {
                                // Create comment list before the form
                                $commentList = $('<ul class="comment-list"></ul>');
                                $form.before($commentList);
                            }

                            // Append the new comment
                            $commentList.append(response.html);

                            // Reset form
                            $form.find('input[name="content"]').val('');

                            // Update comment count
                            updateCommentCount(postId, 1);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('Error posting comment. Please try again.');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).val('Post Comment');
                    }
                });
            });

            $(document).on("click", "#btnCancel", function() {
                $(this).closest('form').find('input[type="text"]').val('');
            });

            function updateCommentCount(postId, increment = 1) {
                const $commentBtn = $(`.show-comments-btn[data-post-id="${postId}"]`);
                if ($commentBtn.length) {
                    const currentCount = parseInt($commentBtn.data('comments-count')) || 0;
                    const newCount = currentCount + increment;
                    $commentBtn.data('comments-count', newCount);
                    $commentBtn.find('span').text(newCount + ' Comments');
                }
            }

            // Add reply
            $(document).on('submit', '.add-reply-form', function(e) {
                e.preventDefault();
                const $form = $(this);
                const $btn = $form.find('[type="submit"]');
                const parentCommentId = $form.find('input[name="parent_comment_id"]').val();

                $btn.prop('disabled', true).val('Posting...');

                $.ajax({
                    url: "{{ route('comments.store') }}",
                    type: "POST",
                    data: $form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Find or create reply list
                            let $replyList = $form.siblings('.reply-list');
                            if ($replyList.length === 0) {
                                $replyList = $('<ul class="reply-list"></ul>');
                                $form.after($replyList);
                            }

                            // Add reply
                            $replyList.append(response.html);

                            // Reset and hide form
                            $form.find('textarea').val('');
                            $form.slideUp(200);

                            // Update parent comment reply count if needed
                            const $parentComment = $('#comment-' + parentCommentId);
                            const $replyBtn = $parentComment.find(
                                '.show-reply-form-btn');
                            // You can add reply count logic here if needed
                        }
                    },
                    error: function(xhr) {
                        alert('Error posting reply. Please try again.');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).val('Post Reply');
                    }
                });
            });

            // Show/hide reply form
            $(document).on('click', '.show-reply-form-btn', function(e) {
                e.preventDefault();
                const $btn = $(this);
                const $commentContainer = $btn.closest('.comment-container');
                const $replyForm = $commentContainer.find('.add-reply-form').first();

                $replyForm.slideToggle(200, function() {
                    if ($replyForm.is(':visible')) {
                        $replyForm.find('textarea').focus();
                    }
                });
            });

            $(document).on('click', '.ac-reply-cancel', function() {
                const $form = $(this).closest('form');
                $form.find('textarea').val('');
                if ($form.hasClass('add-reply-form')) {
                    $form.slideUp(200);
                }
            });

            $(document).on('click', '.acomment-delete', function(e) {
                e.preventDefault();
                const commentId = $(this).data('comment-id');

                if (confirm('Are you sure you want to delete this comment?')) {
                    $.ajax({
                        url: "{{ route('comments.destroy') }}",
                        type: "{{ FORM_METHOD_POST }}",
                        data: {
                            comment_id: commentId,
                        },
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#comment-' + commentId).fadeOut(300, function() {
                                    $(this).remove();
                                });
                            }
                        },
                        error: function() {
                            alert('Error deleting comment.');
                        }
                    });
                }
            });

            $(document).on('click', '.edit-comment-btn', function(e) {
                e.preventDefault();

                const commentId = $(this).data('comment-id');
                const $commentContainer = $('#comment-' + commentId);
                const $contentDisplay = $commentContainer.find('.acomment-content');
                const $editForm = $commentContainer.find('.edit-comment-form');

                // Hide content, show edit form
                $contentDisplay.hide();
                $editForm.show();

                // Focus on textarea
                $editForm.find('.edit-comment-text').focus();
            });

            // Cancel edit
            $(document).on('click', '.cancel-edit', function(e) {
                e.preventDefault();

                const $editForm = $(this).closest('.edit-comment-form');
                const $commentContainer = $editForm.closest('.comment-container');
                const $contentDisplay = $commentContainer.find('.acomment-content');

                // Show content, hide edit form
                $contentDisplay.show();
                $editForm.hide();
            });

            // Submit edit form
            $(document).on('submit', '.edit-comment-form', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $btn = $form.find('[type="submit"]');
                const commentId = $form.closest('.comment-container').data('comment-id');
                const content = $form.find('input[name="content"]').val().trim();

                if (!content) {
                    alert('Comment cannot be empty');
                    return;
                }

                $btn.prop('disabled', true).val('Updating...');

                $.ajax({
                    url: "{{ route('comments.update') }}",
                    type: '{{ FORM_METHOD_POST }}',
                    data: {
                        content: content,
                        comment_id: commentId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update the comment content display
                            const $commentContainer = $('#comment-' + commentId);
                            const $contentDisplay = $commentContainer.find('.acomment-content');
                            const $editForm = $commentContainer.find('.edit-comment-form');

                            // Update content
                            $contentDisplay.find('p').text(content);

                            // Update edited timestamp if needed
                            const $timeElement = $commentContainer.find('.activity-time-since');
                            if (response.comment.is_edited) {
                                if (!$timeElement.find('.edited-text').length) {
                                    $timeElement.append(
                                        ' <span class="edited-text">(edited)</span>');
                                }
                            }

                            // Show content, hide edit form
                            $contentDisplay.show();
                            $editForm.hide();

                            // Show success message
                            showTempMessage('Comment updated successfully', 'success');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error updating comment:', xhr.responseText);
                        let errorMessage = 'Error updating comment';

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = Object.values(xhr.responseJSON.errors).join(', ');
                        }

                        alert(errorMessage);
                    },
                    complete: function() {
                        $btn.prop('disabled', false).val('Update');
                    }
                });
            });

            // Helper function to show temporary messages
            function showTempMessage(message, type = 'success') {
                const $message = $('<div class="temp-message alert alert-' + type + '">' + message + '</div>');
                $('body').append($message);

                $message.css({
                    'position': 'fixed',
                    'top': '20px',
                    'right': '20px',
                    'z-index': '9999',
                    'padding': '10px 20px',
                    'border-radius': '5px'
                });

                setTimeout(function() {
                    $message.fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 3000);
            }
        });
    </script>
@endpush
