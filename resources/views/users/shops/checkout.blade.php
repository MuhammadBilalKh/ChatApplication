@extends('layout.master.main')

@section('title', 'Check-Out')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Check-Out',
    ])
@endsection

@section('dashboard-content')

    <form method="{{ FORM_METHOD_POST }}" action="{{ route('shops.proceed_with_order') }}" enctype="multipart/form-data"
        class="p-3">
        @csrf

        <div class="row">

            <div class="col-12 mb-4">
                <div class="block-title">
                    <h3>Billing details</h3>
                </div>
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $key => $value)
                                    <li>{{ $value }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">First Name *</label>
                        <input type="text" class="form-control" name="billing_first_name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name *</label>
                        <input type="text" class="form-control" name="billing_last_name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Company (optional)</label>
                        <input type="text" class="form-control" name="billing_company" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Country *</label>
                        <select class="form-select" name="billing_country" required>
                            <option value="">Select</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Street Address *</label>
                        <input type="text" class="form-control" name="billing_address_1" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Apartment / Unit (optional)</label>
                        <input type="text" class="form-control" name="billing_address_2">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">City *</label>
                        <input type="text" class="form-control" name="billing_city" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">State *</label>
                        <input type="text" class="form-control" name="billing_state" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">ZIP Code *</label>
                        <input type="text" class="form-control" name="billing_postcode" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone *</label>
                        <input type="tel" class="form-control" name="billing_phone" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="billing_email" required>
                    </div>

                </div>
            </div>

            <div class="col-12 mb-4">
                <h4 class="mb-3">Additional Information</h4>

                <label class="form-label">Order Notes (optional)</label>
                <textarea class="form-control" name="order_comments" rows="3" placeholder="Notes about your order (optional)"></textarea>
            </div>

            <div class="col-12 mb-4">
                <h4 class="mb-3">Your Order</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="70%">Product</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $subTotal = 0;
                        @endphp
                        @foreach ($items as $key => $value)
                            <tr>
                                <td> {{ $value->getLineItemProduct->name }} x {{ $value->quantity }}</td>
                                <td>$ {{ $value->getLineItemProduct->price * $value->quantity }}</td>
                                @php
                                    $subTotal += $value->getLineItemProduct->price * $value->quantity;
                                    $total = $subTotal;
                                @endphp
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Subtotal</th>
                            <td>$ {{ number_format($subTotal) }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><strong>$ {{ number_format($total) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary btn-lg px-4">
                    Place Order
                </button>
            </div>

        </div>
    </form>

@endsection
