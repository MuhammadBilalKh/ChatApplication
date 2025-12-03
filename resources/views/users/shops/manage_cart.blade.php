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
                Cart updated. </div>
        </div>
    @endif

    <table class="table table-hover table-striped table-bordered">
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
            @foreach ($orders->getLineItems as $key => $value)
                <tr>
                    <td>
                        <a role="button" href="#" class="remove"
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
                        <input type="number" id="quantity_6930a8b369f38" class="input-text qty text" name="cart[{{ $value->getLineItemProduct->product_id }}][qty]" value="{{ $value->quantity }}" aria-label="Product quantity" min="0" step="1" placeholder="" inputmode="numeric" autocomplete="off" />
                    </td>
                    <td>
                        <span class="woocommerce-Price-amount amount">
                            ${{ $value->quantity * $value->getLineItemProduct->price }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
