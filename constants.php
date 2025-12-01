<?php

defined("APPLICATION_TITLE") || define("APPLICATION_TITLE", "Chat App");

defined("FORM_MRTHOD_GET") || define("FORM_METHOD_GET", "GET");

defined("FORM_METHOD_POST") || define("FORM_METHOD_POST", "POST");

defined("REQUEST_PROCESSED") || define("REQUEST_PROCESSED", 1);

defined("REQUEST_GOT_ERROR") || define("REQUEST_GOT_ERROR", 0);

defined("ACCOUNT_STATUS_ACTIVE") || define("ACCOUNT_STATUS_ACTIVE", 1);

defined("ACCOUNT_STATUS_INACTIVE") || define("ACCOUNT_STATUS_INACTIVE", 2);

defined("FRIEND_REQUEST_STATUS_PENDING") || define("FRIEND_REQUEST_STATUS_PENDING", "pending");

defined("FRIEND_REQUEST_STATUS_ACCEPTED") || define("FRIEND_REQUEST_STATUS_ACCEPTED", "accepted");

defined("FREIND_REQUEST_STATUS_DECLINED") || define("FRIEND_REQUEST_STATUS_DECLINED", "declined");

defined("FRIEND_REQUEST_STATUS_BLOCKED") || define("FRIEND_REQUEST_STATUS_BLOCKED", 'blocked');

defined("LIMITED_POST_IN_RIGHTBAR") || define("LIMITED_POST_IN_RIGHTBAR", 10);

defined("NEW_JOINING_USER_POST") || define("NEW_JOINING_USER_POST", 1);

defined("PROFILE_INFO_UPDATED_POST") || define("PROFILE_INFO_UPDATED_POST", 1);

defined("POST_VISIBILITY_PUBLIC") || define("POST_VISIBILITY_PUBLIC","public");

defined("MEDIA_TYPE_IMAGE") || define("MEDIA_TYPE_IMAGE", "image");

defined("MEDIA_TYPE_VIDEO") || define("MEDIA_TYPE_VIDEO", "video");

defined("POSTING_TYPE_POST") || define("POSTING_TYPE_POST", 1);

defined("POSTING_TYPE_ADVERT") || define("POSTING_TYPE_ADVERT", 2);

defined("POSTING_TYPE_JOB_LISTING") || define("POSTING_TYPE_JOB_LISTING", 3);

defined("JOB_TYPE_FREELANCE") || define("JOB_TYPE_FREELANCE", 1);

defined("JOB_TYPE_FULL_TIME") || define("JOB_TYPE_FULL_TIME", 2);

defined("JOB_TYPE_INTERNSHIP") || define("JOB_TYPE_INTERNSHIP", 3);

defined("JOB_TYPE_PART_TIME") || define("JOB_TYPE_PART_TIME", 4);

defined("JOB_TYPE_TEMPORARY") || define("JOB_TYPE_TEMPORARY", 5);

defined("JOB_SUBMITTION_DRAFT") || define("JOB_SUBMITTION_DRAFT", 1);

defined("JOB_SUBMITTION_POSTING") || define("JOB_SUBMITTION_POSTING", 2);

defined("PUBLISHING_STATUS_DRAFT") || define("PUBLISHING_STATUS_DRAFT", 1);

defined("PUBLISHING_STATUS_PUBLIC") || define("PUBLISHING_STATUS_PUBLIC", 2);

defined("USER_TYPE_ADMIN") || define("USER_TYPE_ADMIN", "admin");

defined("USER_TYPE_USER") || define("USER_TYPE_USER", "user");

defined("COMMENT_TYPE_TEXT") || define("COMMENT_TYPE_TEXT", "text");

defined("USER_STATUS_MARK_ONLINE") || define("USER_STATUS_MARK_ONLINE", 1);

defined("USER_STATUS_MARL_OFFLINE") || define("USER_STATUS_MARK_OFFLINE", 0);

defined("NOTIFICATION_TYPE_COMMENT") || define("NOTIFICATION_TYPE_COMMENT", "comment");

defined("NOTIFICATION_TYPE_FRIEND_REQUEST") || define("NOTIFICATION_TYPE_FRIEND_REQUEST", "friend_request");

defined("NOTIFICATION_TYPE_LIKE") || define("NOTIFICATION_TYPE_LIKE", "like");

defined("NOTIFICATION_TYPE_SYSTEM") || define("NOTIFICATION_TYPE_SYSTEM", "system");

defined("NOTIFICATION_TYPE_MESSAGE") || define("NOTIFICATION_TYPE_MESSAGE", "message");

defined("NOTIFICATION_TYPE_OTHER") || define("NOTIFICATION_TYPE_OTHER", "other");

defined("NOTIFICATION_PAGINATION_LIMIT") || define("NOTIFICATION_PAGINATION_LIMIT", 10);

defined("MAX_MEDIA_UPLOAD_SIZE_MB") || define("MAX_MEDIA_UPLOAD_SIZE_MB", 10);

defined("MAX_MEDIA_UPLOAD_SIZE_KB") || define("MAX_MEDIA_UPLOAD_SIZE_KB", MAX_MEDIA_UPLOAD_SIZE_MB * 1024);

defined("ALLOWED_MEDIA_TYPES") || define("ALLOWED_MEDIA_TYPES", ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'wmv']);

defined("MEDIA_TYPE_IMAGE_EXTENSIONS") || define("MEDIA_TYPE_IMAGE_EXTENSIONS", ['jpg', 'jpeg', 'png', 'gif']);

defined("MEDIA_TYPE_VIDEO_EXTENSIONS") || define("MEDIA_TYPE_VIDEO_EXTENSIONS", ['mp4', 'mov', 'avi', 'wmv']);

defined("MEDIA_UPLOAD_PATH") || define("MEDIA_UPLOAD_PATH", 'uploads/media/');

defined("PROFILE_PICTURE_UPLOAD_PATH") || define("PROFILE_PICTURE_UPLOAD_PATH", 'uploads/profile_pictures/');

defined("DEFAULT_PROFILE_PICTURE") || define("DEFAULT_PROFILE_PICTURE", 'uploads/profile_pictures/default.png');

defined("DEFAULT_COVER_PHOTO") || define("DEFAULT_COVER_PHOTO", 'uploads/cover_photos/default_cover.jpg');

defined("COVER_PHOTO_UPLOAD_PATH") || define("COVER_PHOTO_UPLOAD_PATH", 'uploads/cover_photos/');

defined("POST_MEDIA_UPLOAD_PATH") || define("POST_MEDIA_UPLOAD_PATH", 'uploads/post_media/');

defined("MAX_PROFILE_PICTURE_WIDTH") || define("MAX_PROFILE_PICTURE_WIDTH", 300);

defined("MAX_PROFILE_PICTURE_HEIGHT") || define("MAX_PROFILE_PICTURE_HEIGHT", 300);

defined("MAX_COVER_PHOTO_WIDTH") || define("MAX_COVER_PHOTO_WIDTH", 1200);

defined("MAX_COVER_PHOTO_HEIGHT") || define("MAX_COVER_PHOTO_HEIGHT", 400);

defined("MAX_POST_MEDIA_IMAGE_WIDTH") || define("MAX_POST_MEDIA_IMAGE_WIDTH", 1200);

defined("MAX_POST_MEDIA_IMAGE_HEIGHT") || define("MAX_POST_MEDIA_IMAGE_HEIGHT", 1200);

defined("MAX_POST_MEDIA_VIDEO_WIDTH") || define("MAX_POST_MEDIA_VIDEO_WIDTH", 1920);

defined("MAX_POST_MEDIA_VIDEO_HEIGHT") || define("MAX_POST_MEDIA_VIDEO_HEIGHT", 1080);

defined("POST_MEDIA_THUMBNAIL_PATH") || define("POST_MEDIA_THUMBNAIL_PATH", 'uploads/post_media/thumbnails/');

defined("NOTIFICATION_TYPE_FAVORITE") || define("NOTIFICATION_TYPE_FAVORITE", "favorite");

defined("CATEGORY_STATUS_ACTIVE") || define("CATEGORY_STATUS_ACTIVE", 1);

defined("CATEGORY_STATUS_INACTIVE") || define("CATEGORY_STATUS_INACTIVE", 0);

defined("ADVERT_STATUS_PENDING") || define("ADVERT_STATUS_PENDING", 1);

defined("ADVERT_STATUS_APPROVED") || define("ADVERT_STATUS_APPROVED", 2);

defined("ADVERT_STATUS_REJECTED") || define("ADVERT_STATUS_REJECTED", 3);

defined("BLOG_STATUS_DRAFT") || define("BLOG_STATUS_DRAFT", "draft");

defined("BLOG_STATUS_PUBLISHED") || define("BLOG_STATUS_PUBLISHED", "published");

defined("BLOG_STATUS_ARCHIVED") || define("BLOG_STATUS_ARCHIVED", "archived");

defined("BLOG_STATUS_REJETED") || define("BLOG_STATUS_REJECTED", "cancelled");

defined("MESSAGE_SEEN") || define("MESSAGE_SEEN", 1);

defined("MESSAGE_NOT_SEEN") || define("MESSAGE_NOT_SEEN" ,0);
