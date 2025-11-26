@extends('layout.master.main')

@section('title', 'Shops')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Shops',
    ])
@endsection

@section('dashboard-content')
    <nav class="nav-component">
        <ul id="menu-shop-menu" class="nav-component-list shop-navbar">
            <li id="menu-item-121"
                class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-121">
                <a href=".//shop/" aria-current="page">All products</a>
            </li>
            <li id="menu-item-120" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-120">
                <a href="./product-categories/">Categories</a>
            </li>
        </ul>
    </nav>


    <div class="shop-filters beehive-filters">
        <div class="filter-wrapper">
            <div class="search kmk-shop-search">
                <form role="search" method="get" class="kmk-product-search">
                    <label class="screen-reader-text" for="kmk-product-search-field-0">Search for:</label>
                    <input type="search" id="kmk-product-search-field-0" class="search-field"
                        placeholder="Search products…" value="" name="s">
                    <button type="submit" value="Search"><i class="icon ion-android-search"></i></button>
                    <input type="hidden" name="post_type" value="product">
                </form>
            </div>
            <div class="wrap-collapse-button">
                <button class="button button-filter" type="button" data-toggle="collapse"
                    data-target="#shop_filter_widgets" aria-expanded="false" aria-controls="shop_filter_widgets">
                    <i class=" uil-sliders-v"></i>
                    Filter </button>
            </div>
        </div>
        <div id="shop_filter_widgets" class="collapse">
            <div class="widget-wrapper">
                <div id="woocommerce_layered_nav-1"
                    class="widget woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                    <h5 class="widget-title">Filter by</h5>
                    <form method="get" action=".//shop/" class="woocommerce-widget-layered-nav-dropdown"><select
                            class="woocommerce-widget-layered-nav-dropdown dropdown_layered_nav_color select2-hidden-accessible"
                            tabindex="-1" aria-hidden="true">
                            <option value="">Any color</option>
                            <option value="blue">Blue</option>
                            <option value="gray">Gray</option>
                            <option value="green">Green</option>
                            <option value="red">Red</option>
                            <option value="yellow">Yellow</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                            style="width: 100%;"><span class="selection"><span
                                    class="select2-selection select2-selection--single" aria-haspopup="true"
                                    aria-expanded="false" tabindex="0" aria-labelledby="select2-uf3q-container"
                                    role="combobox"><span class="select2-selection__rendered" id="select2-uf3q-container"
                                        role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Any
                                            color</span></span><span class="select2-selection__arrow" role="presentation"><b
                                            role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                                aria-hidden="true"></span></span><input type="hidden" name="filter_color" value="">
                    </form>
                </div>
                <div id="woocommerce_layered_nav-2"
                    class="widget woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                    <h5 class="widget-title">Filter by</h5>
                    <form method="get" action=".//shop/" class="woocommerce-widget-layered-nav-dropdown"><select
                            class="woocommerce-widget-layered-nav-dropdown dropdown_layered_nav_size select2-hidden-accessible"
                            tabindex="-1" aria-hidden="true">
                            <option value="">Any size</option>
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                            style="width: 100%;"><span class="selection"><span
                                    class="select2-selection select2-selection--single" aria-haspopup="true"
                                    aria-expanded="false" tabindex="0" aria-labelledby="select2-8g3e-container"
                                    role="combobox"><span class="select2-selection__rendered" id="select2-8g3e-container"
                                        role="textbox" aria-readonly="true"><span
                                            class="select2-selection__placeholder">Any
                                            size</span></span><span class="select2-selection__arrow"
                                        role="presentation"><b role="presentation"></b></span></span></span><span
                                class="dropdown-wrapper" aria-hidden="true"></span></span><input type="hidden"
                            name="filter_size" value=""></form>
                </div>
            </div>
        </div>
    </div>
    <header class="kmk-products-header">

    </header>
    <div class="woocommerce-notices-wrapper"></div>
    <p class="woocommerce-result-count" role="alert" aria-relevant="all" aria-hidden="false">
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
        @php
            $products = []
        @endphp
        @foreach ($products as $product)
            <li class="kmk-post product type-product">
                <div class="item-product">

                    {{-- Sale badge --}}
                    @if ($product->sale_price)
                        <span class="onsale">Sale!</span>
                    @endif

                    <div class="img-top">
                        <div class="product-img">
                            <img width="300" height="300"
                                src="{{ $product->image_url ?? 'https://placehold.co/300x300' }}"
                                alt="{{ $product->name }}">
                        </div>

                        <div class="hover-only">
                            <a href="{{ route('shop.show', $product->id) }}" class="hover-overlay"></a>
                            <ul class="product-actions">
                                <li>
                                    <a href="#" data-product_id="{{ $product->id }}"
                                        class="button add_to_cart_button" role="button">Add to cart</a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.show', $product->id) }}" class="view_cart_button">View
                                        Product</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product-info">
                        <h2 class="woocommerce-loop-product__title">
                            <a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a>
                        </h2>

                        <span class="price">
                            @if ($product->sale_price)
                                <del><span>${{ $product->price }}</span></del>
                                <ins><span>${{ $product->sale_price }}</span></ins>
                            @else
                                <span>${{ $product->price }}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
    <nav class="woocommerce-pagination kmk-pagination">
        <ul class="page-numbers">
            <li><span aria-label="Page 1" aria-current="page" class="page-numbers current">1</span></li>
            <li><a aria-label="Page 2" class="page-numbers" href="#">2</a>
            </li>
            <li><a class="next page-numbers" href="#"><i class="uil-angle-right"></i></a></li>
        </ul>
    </nav>
@endsection
