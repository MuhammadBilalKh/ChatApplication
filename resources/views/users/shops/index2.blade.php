<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- FIX: File input covering entire page -->
    <style>
        #signup_profile_picture {
            position: relative !important;
            width: auto !important;
            height: auto !important;
            opacity: 1 !important;
            z-index: 1 !important;
            pointer-events: auto !important;
        }

        /* Additional safeguard for any theme-based wrapper */
        .default-profile input[type="file"] {
            position: relative !important;
            width: auto !important;
            height: auto !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        }
    </style>

    <!-- CSS Files -->

    <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" />

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" />

    <link rel="stylesheet" href="/assets/css/job-manager.min.css" />

    <link rel="stylesheet" href="/assets/css/adverts-frontend.min.css" />
    <link rel="stylesheet" href="/assets/css/woocommerce.min.css" />
    <link rel="stylesheet" href="/assets/css/woocommerce-layout.min.css" />

    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" />

    <link rel="stylesheet" href="/assets/css/kmk.min.css" />
    <link rel="stylesheet" href="/assets/css/mediaelementplayer-legacy.min.css" />
    <link rel="stylesheet" href="/assets/css/wp-mediaelement.min.css" />
    <link rel="stylesheet" href="/assets/css/godam-player-frontend.css" />
    <link rel="stylesheet" href="/assets/css/godam-player.css" />
    <link rel="stylesheet" href="/assets/css/rtm-upload-terms.min.css" />
    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" />

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <!-- KMK -->
    <link rel="stylesheet" href="/assets/css/frontend.min.css" />
    <link rel="stylesheet" href="/assets/css/post-95.css" />

    <link rel="stylesheet" href="/assets/css/swiper.min.css?ver=8.4.5" />
    <link rel="stylesheet" href="/assets/css/post-30.css?ver=1761244154" />
    <link rel="stylesheet" href="/assets/css/fadeIn.min.css" />
    <link rel="stylesheet" href="/assets/css/widget-heading.min.css" />
    <link rel="stylesheet" href="/assets/css/fadeInDown.min.css" />
    <link rel="stylesheet" href="/assets/css/widget-image.min.css" />
    <link rel="stylesheet" href="/assets/css/fadeInUp.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <link rel="stylesheet" href="/assets/css/mainCss.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');

        /* Base styles */
        * {
            box-sizing: border-box;
        }

        body {
            color: rgb(98, 108, 114);
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 14px;
            line-height: 26px;
            text-align: left;
            overflow-x: hidden;
        }

        /* Main content container */
        .main-content-container {
            color: rgb(98, 108, 114);
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 14px;
            line-height: 26px;
            text-align: left;
            position: relative;
            box-sizing: border-box;
            width: 100%;
            min-height: 100vh;
            padding: 30px 40px 70px;
        }

        @media (min-width: 992px) {
            .main-content-container {
                width: 66.6667%;
                max-width: 66.6667%;
            }
        }

        @media screen and (max-width: 1199.98px) {
            .main-content-container {
                padding: 30px 30px 70px;
            }
        }

        @media screen and (max-width: 991.98px) {
            .main-content-container {
                padding: 30px 30px 40px;
                min-height: initial;
                width: 100%;
                max-width: 100%;
            }
        }

        @media screen and (max-width: 767.98px) {
            .main-content-container {
                padding: 30px 15px;
            }
        }

        @media screen and (min-width: 1599.98px) {
            .main-content-container {
                padding: 40px 60px 70px;
            }
        }

        @media screen and (min-width: 1799.98px) {
            .main-content-container {
                padding: 60px 80px 70px;
            }
        }

        /* Typography */
        h1,
        .page-title {
            color: rgb(79, 81, 91);
            font-family: Quicksand, Verdana, sans-serif;
            font-size: 1.616em;
            line-height: 1.2;
            text-align: left;
            font-weight: 700;
            margin: 0px;
        }

        h2,
        .product-title {
            color: rgb(79, 81, 91);
            font-family: Quicksand, Verdana, sans-serif;
            font-size: 1rem;
            line-height: 1.2;
            font-weight: 700;
            margin: 0px;
        }

        h5,
        .widget-title {
            color: rgb(79, 81, 91);
            font-family: Quicksand, Verdana, sans-serif;
            font-size: 1rem;
            line-height: 1.2;
            position: relative;
            margin-top: 0px;
            margin-bottom: 1rem;
            font-weight: 700;
            padding-bottom: 1rem;
        }

        /* Navigation */
        .main-navigation {
            display: block;
            margin-bottom: 1.5rem;
        }

        .nav-list {
            white-space: nowrap;
            border-bottom: 1px solid rgb(231, 237, 242);
            overflow: hidden;
            padding: 0px;
            margin: 0px;
        }

        .nav-item {
            display: inline-block;
            list-style: none;
        }

        .nav-item.current {
            border-bottom: 2px solid rgb(245, 189, 2);
            font-weight: 600;
        }

        .nav-link {
            display: block;
            cursor: pointer;
            transition: 0.5s;
            color: rgb(41, 41, 45);
            text-decoration: none;
            padding: 0px 0.75rem 0.5rem;
            font-weight: 600;
        }

        .nav-link.current {
            color: rgb(245, 189, 2);
        }

        .nav-link:hover {
            color: rgb(245, 189, 2);
            text-decoration: underline;
        }

        /* Filters and Search */
        .shop-filters {
            border-bottom: 1px solid rgb(231, 237, 242);
            position: relative;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-wrapper {
            display: flex;
        }

        @media screen and (max-width: 575.98px) {
            .filter-wrapper {
                flex-direction: column;
            }
        }

        .search-container {
            margin-bottom: 0.25rem;
        }

        .search-form {
            position: relative;
        }

        .search-field {
            color: rgb(98, 108, 114);
            font-family: inherit;
            font-size: inherit;
            line-height: 26px;
            background-color: transparent;
            display: block;
            outline-offset: -2px;
            margin: 0px;
            overflow: visible;
            outline: none !important;
            appearance: none;
            height: 2.5rem;
            padding: 0.375rem 1rem;
            border: 1px solid rgb(231, 237, 242);
            border-radius: 20px;
            width: calc(100% - 2.75rem);
            float: left;
        }

        .search-field:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        .search-field:focus {
            border: 1px solid rgb(245, 189, 2);
            outline: none;
        }

        @media screen and (max-width: 575.98px) {
            .search-field {
                width: 100%;
                float: left;
                padding-right: 2.5rem;
            }
        }

        .search-button {
            font-family: inherit;
            font-size: inherit;
            line-height: 16px;
            white-space: nowrap;
            background-image: linear-gradient(90deg, rgb(245, 189, 2) 0px, rgb(253, 211, 70) 50%, rgb(245, 189, 2) 100%);
            float: right;
            display: inline-block;
            border-radius: 30px;
            margin: 0px;
            overflow: visible;
            text-transform: none;
            outline: none;
            background-color: rgb(245, 189, 2);
            color: rgb(255, 255, 255);
            border: none;
            padding: 0px;
            min-height: 2.5rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            box-shadow: rgba(245, 189, 2, 0.5) 0px 1px 2px 0px;
            appearance: button;
            background-size: 200%;
            font-weight: normal;
            width: 2.5rem;
            transition: 0.5s;
        }

        .search-button:focus {
            outline: -webkit-focus-ring-color auto 5px;
            background-color: rgb(253, 205, 45);
            color: rgb(255, 255, 255);
            transition: 750ms;
            background-position: right center;
            box-shadow: rgba(245, 189, 2, 0.5) 0px 1px 3px 0px;
        }

        .search-button:disabled {
            cursor: not-allowed;
            opacity: 0.5;
            pointer-events: none;
        }

        .search-button:hover {
            background-color: rgb(253, 205, 45);
            color: rgb(255, 255, 255);
            transition: 750ms;
            background-position: right center;
            box-shadow: rgba(245, 189, 2, 0.5) 0px 1px 3px 0px;
        }

        .search-button:active {
            background-color: rgb(253, 205, 45);
            color: rgb(255, 255, 255);
            transition: 750ms;
            background-position: right center;
            box-shadow: rgba(245, 189, 2, 0.5) 0px 1px 3px 0px;
        }

        @media screen and (max-width: 575.98px) {
            .search-button {
                position: absolute;
                right: 0px;
                box-shadow: none;
                background: none !important;
                color: inherit !important;
            }
        }

        .filter-toggle {
            margin-left: auto;
        }

        @media screen and (max-width: 575.98px) {
            .filter-toggle {
                margin-left: 0px;
            }
        }

        .filter-button {
            font-family: inherit;
            font-size: inherit;
            line-height: 26px;
            white-space: nowrap;
            border-radius: 30px;
            margin: 0px;
            overflow: visible;
            text-transform: none;
            outline: none;
            background-color: transparent;
            display: inline-block;
            color: rgb(98, 108, 114);
            border: 1px solid rgb(231, 237, 242);
            padding: 0.375rem 1rem;
            min-height: 2.5rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            box-shadow: none;
            border-color: rgb(245, 189, 2);
            appearance: button;
            font-weight: normal;
            background: none !important;
            min-width: 140px;
        }

        .filter-button:focus {
            outline: -webkit-focus-ring-color auto 5px;
            background-color: rgb(245, 189, 2);
            color: rgb(245, 189, 2);
            transition: 750ms;
            background: none;
            border: 1px solid rgb(85, 97, 226);
            border-color: rgb(245, 189, 2);
        }

        .filter-button:disabled {
            cursor: not-allowed;
            opacity: 0.5;
            pointer-events: none;
        }

        .filter-button:hover {
            background-color: rgb(245, 189, 2);
            color: rgb(245, 189, 2);
            transition: 750ms;
            background: none;
            border: 1px solid rgb(85, 97, 226);
            border-color: rgb(245, 189, 2);
        }

        .filter-button:active {
            background-color: rgb(245, 189, 2);
            color: rgb(245, 189, 2);
            transition: 750ms;
            background: none;
            border: 1px solid rgb(85, 97, 226);
            border-color: rgb(245, 189, 2);
        }

        @media screen and (max-width: 575.98px) {
            .filter-button {
                width: 100%;
                text-align: left;
            }
        }

        /* Filter widgets */
        .filter-widgets {
            border-top: 1px solid rgb(231, 237, 242);
            display: none;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .widget-wrapper {
            display: flex;
            margin: -15px;
            flex-wrap: wrap;
        }

        .widget {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 15px;
        }

        @media screen and (min-width: 767.98px) {
            .widget {
                flex: 0 0 calc(33.3333%);
                max-width: calc(33.3333%);
                margin-bottom: 0px;
            }
        }

        /* Dropdowns */
        select {
            color: rgb(98, 108, 114);
            font-family: inherit;
            font-size: inherit;
            line-height: 26px;
            vertical-align: top;
            background-color: rgb(247, 247, 247);
            background-image: url("../images/icon-arrow-down.png");
            background-position: calc(100% - 0.75rem) 50%;
            background-repeat: no-repeat;
            position: relative;
            display: block;
            margin: 0px;
            text-transform: none;
            height: auto;
            padding: 0.125rem calc(1em + 1rem) 0.125rem 1rem;
            border: 1px solid transparent;
            border-radius: 20px;
            outline: none !important;
            background-size: 1em;
            appearance: none;
            width: 100%;
        }

        select:focus {
            border: 1px solid rgb(245, 189, 2);
            outline: none;
        }

        select:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }

        /* Products */
        .products-header {
            display: block;
        }

        .result-count {
            float: left;
            margin: 0px 0px 1em;
        }

        @media screen and (max-width: 575.98px) {
            .result-count {
                display: none;
            }
        }

        .ordering-form {
            margin: 0px 0px 1em;
        }

        @media screen and (min-width: 575.98px) {
            .ordering-form {
                float: right;
            }
        }

        .products-grid {
            border-top: 1px solid rgb(231, 237, 242);
            display: flex;
            clear: both;
            list-style: none;
            padding: 0px;
            flex-wrap: wrap;
            margin: 0px -15px;
        }

        .product-item {
            border-bottom: 1px solid rgb(231, 237, 242);
            position: relative;
            list-style: none;
            animation: slideInUp 0.5s ease forwards;
            padding: 18px 15px;
            flex: 0 0 100%;
            max-width: 100%;
            width: 100%;
            opacity: 0;
        }

        @media screen and (min-width: 575.98px) {
            .product-item {
                flex: 0 0 50%;
                max-width: 50%;
                border-right: 1px solid rgb(231, 237, 242);
            }
        }

        @media screen and (min-width: 991.98px) {
            .product-item {
                flex: 0 0 calc(33.3333%);
                max-width: calc(33.3333%);
                border-right: 1px solid rgb(231, 237, 242);
            }
        }

        @keyframes slideInUp {
            0% {
                transform: translate3d(0px, 100%, 0px);
                opacity: 0;
            }

            100% {
                transform: translateZ(0px);
                opacity: 1;
            }
        }

        .product-item:nth-child(3n) {
            border-right: none;
        }

        @media screen and (min-width: 575.98px) and (max-width: 991.98px) {
            .product-item:nth-child(2n) {
                border-right: none;
            }
        }

        .item-product {
            position: relative;
            text-align: center;
        }

        .sale-badge {
            color: rgb(255, 255, 255);
            font-size: 0.857em;
            font-weight: 600;
            line-height: 1.5;
            text-align: center;
            background-color: rgb(46, 213, 115);
            position: absolute;
            top: -0.5em;
            right: 0.25rem;
            left: auto;
            display: block;
            z-index: 9;
            padding: 0px 0.5em;
            margin: 0px;
            border-radius: 100px;
            box-shadow: rgba(58, 46, 68, 0.1) 0px 3px 4px;
        }

        .product-image-container {
            position: relative;
        }

        .product-image {
            vertical-align: middle;
            max-width: 100%;
            height: auto;
            border: none;
            border-radius: 12px;
            box-shadow: none;
            width: 100%;
        }

        .product-hover {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            inset: 0px;
            background: rgba(0, 0, 0, 0.6);
            transform: scale(0);
            transition: transform 0.3s ease;
        }

        .item-product:hover .product-hover {
            transform: scale(1);
        }

        .hover-overlay {
            position: absolute;
            display: block;
            cursor: pointer;
            transition: 0.5s;
            color: rgb(41, 41, 45);
            text-decoration: none;
            background-color: transparent;
            box-shadow: none;
            inset: 0px;
        }

        .hover-overlay:hover {
            color: rgb(245, 189, 2);
            text-decoration: underline;
        }

        .product-actions {
            position: absolute;
            top: 50%;
            bottom: 1rem;
            clear: both;
            list-style: none;
            padding: 0px;
            left: 0px;
            right: 0px;
            margin: auto;
            transform: translateY(-50%);
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .action-item {
            display: inline-block;
            list-style: none;
        }

        .action-button {
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 0px;
            line-height: 30px;
            text-align: center;
            white-space: nowrap;
            display: block;
            list-style: none;
            color: rgb(255, 255, 255);
            text-decoration: none;
            background-color: transparent;
            transition: 0.5s;
            outline: none;
            fill: rgb(245, 189, 2);
            border: none;
            border-radius: 50%;
            padding: 0px;
            min-height: initial;
            cursor: pointer;
            box-shadow: none;
            margin-top: 0px;
            background: rgba(255, 255, 255, 0.2);
            height: 30px;
            width: 30px;
            font-weight: normal;
        }

        .action-button:hover {
            color: rgb(255, 255, 255);
            text-decoration: underline;
            background-color: rgb(245, 189, 2);
            transition: 750ms;
        }

        .action-button:disabled {
            cursor: not-allowed;
            opacity: 0.5;
            pointer-events: none;
        }

        .action-button:active {
            background-color: rgb(245, 189, 2);
            color: rgb(255, 255, 255);
            transition: 750ms;
        }

        .action-button:focus {
            background-color: rgb(245, 189, 2);
            color: rgb(255, 255, 255);
            transition: 750ms;
        }

        .product-info {
            position: relative;
            text-align: center;
            padding-top: 1em;
        }

        .product-title {
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            padding: 1em 0px 0.25em;
            margin: 0px;
        }

        .product-price {
            color: rgb(245, 189, 2);
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 14px;
            line-height: 1;
            text-align: center;
            display: block;
            margin-top: 0.5rem;
        }

        .regular-price {
            color: inherit;
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 14px;
            line-height: 14px;
            text-align: center;
            display: inline-block;
            opacity: 0.5;
            font-weight: normal;
        }

        .sale-price {
            color: rgb(245, 189, 2);
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            line-height: 14px;
            text-align: center;
            display: inline-block;
            background: none;
        }

        /* Pagination */
        .pagination {
            position: relative;
            display: block;
            margin: 30px -2px 0px;
        }

        @media screen and (max-width: 767.98px) {
            .pagination {
                text-align: center;
            }
        }

        .page-numbers-list {
            padding: 0px;
            margin: 0px;
        }

        .page-item {
            display: inline-block;
            list-style: none;
        }

        .page-numbers {
            font-family: "Nunito Sans", Arial, sans-serif;
            font-size: 14px;
            line-height: 26px;
            text-align: center;
            background-color: rgb(249, 249, 249);
            display: inline-block;
            cursor: pointer;
            transition: 0.5s;
            color: rgb(41, 41, 45);
            text-decoration: none;
            min-width: 2.25rem;
            height: 2.25rem;
            padding: 0.25rem 0.75rem;
            margin: 2px;
            border: 1px solid transparent;
            border-radius: 20px;
            box-shadow: none;
        }

        .page-numbers:hover {
            color: rgb(245, 189, 2);
            text-decoration: underline;
        }

        .current-page {
            color: rgb(255, 255, 255);
            font-weight: 600;
            background-color: rgb(245, 189, 2);
            background-image: linear-gradient(90deg, rgb(245, 189, 2) 0px, rgb(253, 211, 70) 50%, rgb(245, 189, 2) 100%);
            text-decoration: none;
            border-radius: 20px;
            background-size: 200%;
            box-shadow: rgba(245, 189, 2, 0.5) 0px 1px 3px 0px;
        }

        /* Utility classes */
        .screen-reader-text {
            position: absolute;
            top: -10000em;
            overflow: hidden;
            clip: rect(0px, 0px, 0px, 0px);
            height: 1px;
            width: 1px;
            overflow-wrap: normal !important;
            margin: -1px;
            padding: 0px;
            border: 0px;
        }

        .icon {
            cursor: pointer;
        }

        /* Print styles */
        @media print {
            * {
                text-shadow: none !important;
                box-shadow: none !important;
            }

            a {
                text-decoration: underline;
            }

            .result-count,
            .product-title {
                orphans: 3;
                widows: 3;
            }

            .product-title {
                break-after: avoid;
            }

            .product-image {
                break-inside: avoid;
            }
        }
    </style>
</head>

<body
    class="directory activity kmkpress bp-nouveau blog page-template-default page page-id-35 wp-theme-kmk theme-kmk woocommerce-no-js kmk kmk-guest-user kmk-default kmk-kit-30 title-bar-active kmk-social-layout panel-expanded has-page-sidebar no-js">

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


                                    <div class="kmk-title-bar social">
                                        <div class="title-bar-wrapper">
                                            <div class="title-wrapper screen-reader-text">
                                                <h1 class="title h3">Shop</h1>
                                            </div>
                                        </div>
                                    </div>

                                    <nav class="nav-component">
                                        <ul id="menu-shop-menu" class="nav-component-list shop-navbar">
                                            <li id="menu-item-121"
                                                class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-121">
                                                <a href=".//shop/" aria-current="page">All products</a>
                                            </li>
                                            <li id="menu-item-120"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-120">
                                                <a href=".//product-categories/">Categories</a>
                                            </li>
                                        </ul>
                                    </nav>

                                    <div class="shop-filters kmk-filters">
                                        <div class="filter-wrapper">
                                            <div class="search kmk-shop-search">
                                                <form role="search" method="get" class="kmk-product-search">
                                                    <label class="screen-reader-text"
                                                        for="kmk-product-search-field-0">Search for:</label>
                                                    <input type="search" id="kmk-product-search-field-0"
                                                        class="search-field" placeholder="Search products…"
                                                        value="" name="s">
                                                    <button type="submit" value="Search"><i
                                                            class="icon ion-android-search"></i></button>
                                                    <input type="hidden" name="post_type" value="product">
                                                </form>
                                            </div>
                                            <div class="wrap-collapse-button">
                                                <button class="button button-filter" type="button"
                                                    data-toggle="collapse" data-target="#shop_filter_widgets"
                                                    aria-expanded="false" aria-controls="shop_filter_widgets">
                                                    <i class=" uil-sliders-v"></i>
                                                    Filter </button>
                                            </div>
                                        </div>
                                        <div id="shop_filter_widgets" class="collapse">
                                            <div class="widget-wrapper">
                                                <div id="woocommerce_layered_nav-1"
                                                    class="widget woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                                                    <h5 class="widget-title">Filter by</h5>
                                                    <form method="get" action=".//shop/"
                                                        class="woocommerce-widget-layered-nav-dropdown"><select
                                                            class="woocommerce-widget-layered-nav-dropdown dropdown_layered_nav_color select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                            <option value="">Any color</option>
                                                            <option value="blue">Blue</option>
                                                            <option value="gray">Gray</option>
                                                            <option value="green">Green</option>
                                                            <option value="red">Red</option>
                                                            <option value="yellow">Yellow</option>
                                                        </select><span
                                                            class="select2 select2-container select2-container--default"
                                                            dir="ltr" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    aria-haspopup="true" aria-expanded="false"
                                                                    tabindex="0"
                                                                    aria-labelledby="select2-uf3q-container"
                                                                    role="combobox"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-uf3q-container" role="textbox"
                                                                        aria-readonly="true"><span
                                                                            class="select2-selection__placeholder">Any
                                                                            color</span></span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span><input type="hidden"
                                                            name="filter_color" value=""></form>
                                                </div>
                                                <div id="woocommerce_layered_nav-2"
                                                    class="widget woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                                                    <h5 class="widget-title">Filter by</h5>
                                                    <form method="get" action=".//shop/"
                                                        class="woocommerce-widget-layered-nav-dropdown"><select
                                                            class="woocommerce-widget-layered-nav-dropdown dropdown_layered_nav_size select2-hidden-accessible"
                                                            tabindex="-1" aria-hidden="true">
                                                            <option value="">Any size</option>
                                                            <option value="large">Large</option>
                                                            <option value="medium">Medium</option>
                                                            <option value="small">Small</option>
                                                        </select><span
                                                            class="select2 select2-container select2-container--default"
                                                            dir="ltr" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single"
                                                                    aria-haspopup="true" aria-expanded="false"
                                                                    tabindex="0"
                                                                    aria-labelledby="select2-8g3e-container"
                                                                    role="combobox"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-8g3e-container" role="textbox"
                                                                        aria-readonly="true"><span
                                                                            class="select2-selection__placeholder">Any
                                                                            size</span></span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper"
                                                                aria-hidden="true"></span></span><input type="hidden"
                                                            name="filter_size" value=""></form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <header class="kmk-products-header">

                                    </header>
                                    <div class="woocommerce-notices-wrapper"></div>
                                    <p class="woocommerce-result-count" role="alert" aria-relevant="all"
                                        aria-hidden="false">
                                        Showing 1–12 of 17 results</p>
                                    <form class="woocommerce-ordering" method="get">
                                        <select name="orderby" class="orderby" aria-label="Shop order">
                                            <option value="menu_order" selected="selected">Default sorting</option>
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="rating">Sort by average rating</option>
                                            <option value="date">Sort by latest</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                        <input type="hidden" name="paged" value="1">
                                    </form>
                                    <ul class="products columns-3">
                                        <li class="animate-item slideInUp kmk-post product type-product post-302 status-publish first instock product_cat-music has-post-thumbnail downloadable virtual purchasable product-type-simple"
                                            style="visibility: visible; animation-name: slideInUp;">
                                            <div class="item-product">
                                                <div class="img-top">
                                                    <div class="product-img">
                                                        <img fetchpriority="high" width="300" height="300"
                                                            src="https://placehold.co/300x300"
                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                            alt="Album">
                                                    </div>
                                                    <div class="hover-only">
                                                        <a href="#" class="hover-overlay"></a>
                                                        <ul class="product-actions">
                                                            <li><a href="#" data-quantity="1"
                                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                                    data-product_id="302" data-product_sku="woo-album"
                                                                    aria-label="Add to cart: “Album”" rel="nofollow"
                                                                    data-success_message="“Album” has been added to your cart"
                                                                    role="button">Add to cart</a></li>
                                                            <li><a href="#" class="view_cart_button"
                                                                    aria-label="View Product">View Product</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h2 class="woocommerce-loop-product__title"><a
                                                            href="#">Album</a>
                                                    </h2>
                                                    <span class="price"><span
                                                            class="woocommerce-Price-amount amount"><bdi><span
                                                                    class="woocommerce-Price-currencySymbol">$</span>15.00</bdi></span></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="animate-item slideInUp kmk-post product type-product post-294 status-publish instock product_cat-accessories has-post-thumbnail sale shipping-taxable purchasable product-type-simple"
                                            style="visibility: visible; animation-name: slideInUp;">
                                            <div class="item-product">
                                                <span class="onsale">Sale!</span>
                                                <div class="img-top">
                                                    <div class="product-img">
                                                        <img width="300" height="300"
                                                            src="https://placehold.co/300x300"
                                                            class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                                            alt="Beanie">
                                                    </div>
                                                    <div class="hover-only">
                                                        <a href="#" class="hover-overlay"></a>
                                                        <ul class="product-actions">
                                                            <li><a href="#" data-quantity="1"
                                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                                    data-product_id="294"
                                                                    data-product_sku="woo-beanie"
                                                                    aria-label="Add to cart: “Beanie”" rel="nofollow"
                                                                    data-success_message="“Beanie” has been added to your cart"
                                                                    role="button">Add to cart</a></li>
                                                            <li><a href="#" class="view_cart_button"
                                                                    aria-label="View Product">View Product</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h2 class="woocommerce-loop-product__title"><a
                                                            href="#">Beanie</a>
                                                    </h2>
                                                    <span class="price"><del aria-hidden="true"><span
                                                                class="woocommerce-Price-amount amount"><bdi><span
                                                                        class="woocommerce-Price-currencySymbol">$</span>20.00</bdi></span></del>
                                                        <span class="screen-reader-text">Original price was:
                                                            $20.00.</span><ins aria-hidden="true"><span
                                                                class="woocommerce-Price-amount amount"><bdi><span
                                                                        class="woocommerce-Price-currencySymbol">$</span>18.00</bdi></span></ins><span
                                                            class="screen-reader-text">Current price is:
                                                            $18.00.</span></span>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                    <nav class="woocommerce-pagination kmk-pagination">
                                        <ul class="page-numbers">
                                            <li><span aria-label="Page 1" aria-current="page"
                                                    class="page-numbers current">1</span></li>
                                            <li><a aria-label="Page 2" class="page-numbers" href="#">2</a>
                                            </li>
                                            <li><a class="next page-numbers" href="#"><i
                                                        class="uil-angle-right"></i></a></li>
                                        </ul>
                                    </nav>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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

</html>
