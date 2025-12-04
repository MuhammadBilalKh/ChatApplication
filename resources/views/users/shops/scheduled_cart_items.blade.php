@extends('layout.master.main')

@section('title', $orderID)

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => $orderID,
    ])
@endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="block-title">
                <h4>Cart Items</h4>
            </div>
        </div>

        <div class="col-sm-3">
            <span>Order Number:</span>
        </div>
        <div class="col-sm-9">
            {{ $orderData->order_number }}
        </div>

        <div class="col-sm-3 mt-2">
            <span>Status:</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span class="badge badge-success">{{ strtoupper($orderData->status) }}</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span>Order Placed At:</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span>{{ $orderData->created_at }}</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span>Payment Method:</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span>{{ strtoupper($orderData->payment_method) }}</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span>Total:</span>
        </div>

        <div class="col-sm-3 mt-2">
            <span>$ {{ number_format($orderData->total) }}</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span>Full Name:</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span> {{ ($orderData->billing_name) }}</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span>Company Name:</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span> {{ ($orderData->company_name ?? "NA") }}</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span>Billing Email:</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span> {{ ($orderData->billing_email ?? "NA") }}</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span>Billing Phone:</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span> {{ ($orderData->billing_phone ?? "NA") }}</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span>Billing Address:</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span> {{ ($orderData->billing_address ?? "NA") }}</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span>Region:</span>
        </div>

        <div class="col-sm-6 mt-2">
            <span> {{ ($orderData->region ?? "NA") }}</span>
        </div>

        <div class="col-sm-12 mt-3">
            <span>Items:</span>
            <table class="table table-hover table-striped table-borderless">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Item Name</th>
                        <th>Base Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum = 0;
                    @endphp
                    @foreach($orderData->getLineItems as $key => $value)
                        <tr>
                            <td>{{ ($key + 1) }}</td>
                            <td>{{ $value->getLineItemProduct->name }}</td>
                            <td>$ {{ $value->getLineItemProduct->price }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>$ {{ $value->quantity * $value->getLineItemProduct->price }}</td>
                            @php
                                $sum += $value->quantity * $value->getLineItemProduct->price;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td>Total Cost:</td>
                        <td>$ {{ $sum }}</td>
                    </tr>
                </tbody>
            </table>
            <label>Notes: </label>
            <input name="notes" readonly type="text" class="form-control" value="{{ $orderData->notes }}" />
        </div>
    </div>
@endsection
