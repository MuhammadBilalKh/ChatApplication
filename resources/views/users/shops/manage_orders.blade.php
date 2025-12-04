@extends('layout.master.main')

@section('title', 'Manage Cart')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Manage Cart',
    ])
@endsection

@section('dashboard-content')
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
            <li
                class="menu-item {{ request()->routeIs('shops.manage_orders') ? 'current-menu-item current_page_item' : '' }}">
                <a href="{{ route('shops.manage_orders') }}">Orders</a>
            </li>
        </ul>
    </nav>

        <div class="shop-filters kmk-filters">
            <table class="table table-hover table-striped table-borderless">
                <thead>
                    <tr>
                        <td>Order Number</td>
                        <td>Created At</td>
                        <td>Ordered By</td>
                        <td>Total Price</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
@endsection
