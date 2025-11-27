@extends('users.profile.groups.layout')

@section('group-content')
    <div id="bp-nouveau-activity-form" class="activity-update-form">
        <form name="whats-new-form" method="post" id="whats-new-form" class="activity-form activity-form-expanded">
            <div id="whats-new-avatar">

                <a href="https://www.clientbetalink.xyz/MIGVELv1/members-2/wpdeveloper/">
                    <img src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/avatars/1/1760543513-bpthumb.jpg"
                        class="avatar user-1-avatar avatar-50 photo" width="50" height="50"
                        alt="Profile photo of wpdeveloper">
                </a>

            </div>
            <div id="whats-new-content">
                <div id="whats-new-textarea" style="position: relative;">
                    <textarea name="whats-new" cols="50" rows="4" placeholder="What's new, wpdeveloper?"
                        aria-label="Post what's new" id="whats-new" class="bp-suggestions" style="resize: vertical; height: auto;"
                        maxlength="3000"></textarea><sider-quick-compose-btn dir="ltr" data-gpts-theme="light"
                        data-ext-text-inserter="no" style="display: contents;"></sider-quick-compose-btn>
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
                                            <div id="rtmedia-whts-new-upload-container" style="position: relative;">
                                                <div id="html5_1jb3memm31jard11u4s4mpvnc3_container"
                                                    class="moxie-shim moxie-shim-html5"
                                                    style="position: absolute; top: 0px; left: 0px; width: 141px; height: 30px; overflow: hidden; z-index: 0;">
                                                    <input id="html5_1jb3memm31jard11u4s4mpvnc3" type="file"
                                                        style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"
                                                        multiple=""
                                                        accept="image/jpeg,.jpg,.jpeg,image/png,.png,image/gif,.gif,video/mp4,.mp4,audio/mpeg,.mp3">
                                                </div>
                                            </div><button type="button" class="rtmedia-add-media-button"
                                                id="rtmedia-add-media-button-post-update" title="Attach Media"
                                                style="position: relative; z-index: 1;"><span
                                                    class="dashicons dashicons-admin-media"></span><span
                                                    class="button-text">Attach media</span></button>
                                        </div><span style="font-size: 12px; opacity: 0.7;">Max. File Size: 2048M</span>
                                    </div>
                                </div>
                                <div class="rtmedia-plupload-notice">
                                    <ul class="plupload_filelist_content ui-sortable rtm-plupload-list clear-both"
                                        id="rtmedia_uploader_filelist"></ul>
                                </div><input type="hidden" name="mode" value="file_upload">
                            </div>
                        </div>


                        <input type="hidden" name="rtmedia_upload_nonce" value="165d4d39cf">

                        <input type="submit" id="rtMedia-start-upload" name="rtmedia-upload" value="Upload"
                            style="display: none;">

                    </div>
                </div>
            </div>
            <div id="whats-new-options" style="opacity: 1;">
                <div id="whats-new-submit" class="in-profile"><input type="submit" id="aw-whats-new-submit" class="button"
                        name="aw-whats-new-submit" value="Post Update"><input type="reset" id="aw-whats-new-reset"
                        class="text-button small" value="Cancel"></div>
            </div>
        </form>
    </div>
@endsection
