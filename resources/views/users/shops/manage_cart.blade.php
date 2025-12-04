@php
    $subTotal = 0;
    $total = 0;
@endphp
@extends('layout.master.main')

@section('title', 'Manage Cart')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Manage Cart',
    ])
@endsection

@section('dashboard-content')
    @if (session()->has('success'))
        <div class="woocommerce-notices-wrapper">
            <div class="woocommerce-message" role="alert" tabindex="-1">
                {{ session()->get('success') }} </div>
        </div>
    @endif

    @if (count($orders) > 0)
        <form method="{{ FORM_METHOD_POST }}" action="{{ route('shops.update_cart') }}">
            @csrf
            <table class="table table-hover table-borderless">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $key => $value)
                        <tr>
                            <td>
                                <a href="{{ route('shops.delete_item', ['id' => $value->order_line_item_id]) }}"
                                    role="button" class="remove"
                                    aria-label="Remove {{ $value->getLineItemProduct->name }} from cart"
                                    data-product_id="{{ $value->getLineItemProduct->product_id }}"
                                    data-product_sku="{{ $value->getLineItemProduct->slug }}">×</a>
                            </td>
                            <td width="100">
                                <img fetchpriority="high" decoding="async" width="100"
                                    src="{{ asset($value->getLineItemProduct->images[0]->file_path) }}"
                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                    alt="{{ $value->getLineItemProduct->name }}" sizes="(max-width: 300px) 100vw, 300px" />
                            </td>
                            <td>
                                {{ $value->getLineItemProduct->name }}
                            </td>
                            <td>
                                <span class="woocommerce-Price-amount amount">
                                    ${{ $value->getLineItemProduct->price }}
                                </span>
                            </td>
                            <td width="100">
                                <input type="number" id="quantity_6930a8b369f38" class="input-text qty text"
                                    name="cart[{{ $value->order_line_item_id }}][qty]" value="{{ $value->quantity }}"
                                    aria-label="Product quantity" min="0" step="1" placeholder=""
                                    inputmode="numeric" autocomplete="off" />
                            </td>
                            <td>
                                <span class="woocommerce-Price-amount amount">
                                    ${{ $value->quantity * $value->getLineItemProduct->price }}
                                </span>
                            </td>
                        </tr>
                        @php
                            $subTotal += $value->quantity * $value->getLineItemProduct->price;
                            $total = $subTotal;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td>
                            <button type="submit" class="button" name="update_cart" value="Update cart">Update
                                cart</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    @else
        <div class="container">
            <span class="text-info h3 text-center">No Product Found</span>
        </div>
    @endif

    @if (count($orders) > 0)
        <div class="cart-collaterals">
            <div class="cart_totals ">

                <div class="block-title">
                    <h3>Cart totals</h3>
                </div>

                <table cellspacing="0" class="shop_table shop_table_responsive">

                    <tbody>
                        <tr class="cart-subtotal">
                            <th>Subtotal</th>
                            <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><bdi><span
                                            class="woocommerce-Price-currencySymbol">$</span>{{ number_format($subTotal) }}</bdi></span>
                            </td>
                        </tr>

                        <tr class="order-total">
                            <th>Total</th>
                            <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">$</span>{{ number_format($total) }}</bdi></span></strong>
                            </td>
                        </tr>


                    </tbody>
                </table>

                <div class="wc-proceed-to-checkout">

                    <a href="{{ route('shops.checkout') }}" class="button button-primary wide large">
                        Proceed to checkout</a>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        jQuery(document).ready(function() {
            jQuery(".woocommerce-message").delay(2500).fadeOut();
        });
    </script>
@endpush
