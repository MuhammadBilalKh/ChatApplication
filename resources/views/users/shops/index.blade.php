@extends('layout.master.main')

@section('title', 'Shops')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Shops',
    ])
@endsection

@section('dashboard-content')

    {{-- SHOP TOP NAV --}}
    <nav class="nav-component">
        <ul id="menu-shop-menu" class="nav-component-list shop-navbar">
            <li class="menu-item {{ request()->routeIs('shops.list') ? 'current-menu-item current_page_item' : '' }}">
                <a href="{{ route('shops.list') }}">All products</a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/product-categories') }}">Categories</a>
            </li>
            <li class="menu-item {{ request()->routeIs('shops.create') ? 'current-menu-item current_page_item' : '' }}">
                <a href="{{ route('shops.create') }}">Upload Products</a>
            </li>
        </ul>
    </nav>


    {{-- FILTER BAR --}}
    <div class="shop-filters kmk-filters">

        <div class="filter-wrapper">

            {{-- SEARCH BAR --}}
            <div class="search kmk-shop-search">
                <form role="search" method="GET" action="{{ route('shops.list') }}" class="kmk-product-search">

                    <label for="kmk-product-search-field-0" class="screen-reader-text">
                        Search for:
                    </label>

                    <input type="search" id="kmk-product-search-field-0" class="search-field"
                        placeholder="Search products…" name="s" value="{{ request('s') }}">

                    <button type="submit">
                        <i class="icon ion-android-search"></i>
                    </button>

                </form>
            </div>

            <div class="wrap-collapse-button">
                <button class="button button-filter" type="button" data-toggle="collapse"
                    data-target="#shop_filter_widgets" aria-expanded="false" aria-controls="shop_filter_widgets">
                    <i class="uil-sliders-v"></i> Filter
                </button>
            </div>

        </div>

        {{-- COLLAPSIBLE FILTERS --}}
        <div id="shop_filter_widgets" class="collapse">
            <div class="widget-wrapper">

                {{-- FILTER COLOR --}}
                <div class="widget woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                    <h5 class="widget-title">Filter by</h5>
                    <form method="GET" action="{{ route('shops.list') }}" class="woocommerce-widget-layered-nav-dropdown">

                        <select name="filter_color"
                            class="woocommerce-widget-layered-nav-dropdown dropdown_layered_nav_color select2-hidden-accessible">
                            <option value="">Any color</option>
                            <option value="blue">Blue</option>
                            <option value="gray">Gray</option>
                            <option value="green">Green</option>
                            <option value="red">Red</option>
                            <option value="yellow">Yellow</option>
                        </select>

                    </form>
                </div>

                {{-- FILTER SIZE --}}
                <div class="widget woocommerce widget_layered_nav woocommerce-widget-layered-nav">
                    <h5 class="widget-title">Filter by</h5>
                    <form method="GET" action="{{ route('shops.list') }}" class="woocommerce-widget-layered-nav-dropdown">

                        <select name="filter_size"
                            class="woocommerce-widget-layered-nav-dropdown dropdown_layered_nav_size select2-hidden-accessible">
                            <option value="">Any size</option>
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <p class="woocommerce-result-count" role="alert">
        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results
    </p>

    <form class="woocommerce-ordering" method="GET" action="{{ route('shops.list') }}">

        <select name="orderby" class="orderby" aria-label="Shop order">

            @php
                $sortOptions = [
                    'menu_order' => 'Default sorting',
                    'popularity' => 'Sort by popularity',
                    'rating' => 'Sort by average rating',
                    'date' => 'Sort by latest',
                    'price' => 'Sort by price: low to high',
                    'price-desc' => 'Sort by price: high to low',
                ];
            @endphp

            @foreach ($sortOptions as $value => $label)
                <option value="{{ $value }}" {{ request('orderby') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach

        </select>

        <input type="hidden" name="paged" value="1">
    </form>

    <ul class="products columns-3">
        @foreach ($products as $product)
            <li class="animate-item slideInUp kmk-post product type-product"
                style="visibility: visible; border:none; animation-name: slideInUp;">
                <div class="item-product">

                    <!-- Product Card -->
                    <div class="card">

                        @if ($product->sale_price)
                            <span class="onsale">Sale!</span>
                        @endif

                        <!-- Product Image -->
                        <div class="img-top">
                            <div class="product-img">
                                @php
                                    $img = optional($product->images[0])->file_path;
                                @endphp
                                <img width="300" height="300"
                                    src="{{ $img ? asset($img) : 'https://placehold.co/300x300' }}"
                                    alt="{{ $product->slug }}">
                            </div>

                            <!-- Hover Actions -->
                            <div class="hover-only">
                                <a href="{{ route('shops.show', $product->product_id) }}" class="hover-overlay"></a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('shops.show', $product->product_id) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>

                            <p class="card-text">
                                <span class="price">
                                    @if ($product->sale_price)
                                        <del>${{ $product->price }}</del>
                                        <ins>${{ $product->sale_price }}</ins>
                                    @else
                                        ${{ $product->price }}
                                    @endif
                                </span>
                            </p>

                            <a href="#" class="btn btn-primary add_to_cart_button"
                                data-product_id="{{ $product->product_id }}">
                                Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <nav class="woocommerce-pagination kmk-pagination">
        {{ $products->links() }}
    </nav>

@endsection
