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

    <div class="col-sm-6">

    </div>

        <div class="col-sm-12">
            <table class="table table-hover table-striped table-borderless">
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
     </div>
@endsection
