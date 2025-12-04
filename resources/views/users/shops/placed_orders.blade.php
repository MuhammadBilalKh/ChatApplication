@extends('layout.master.main')

@section('title', 'Check-Out')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Check-Out',
    ])
@endsection

@section('dashboard-content')
    <div class="row">
        <div class="col-sm-12">
            <div class="block-title">
                <h4>Your Orders</h4>
            </div>
        </div>

        <div class="col-sm-12">
            <table class="table tabl-hover table-striped table-borderless">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->order_number }}</td>
                            <td>{{ ucfirst($value->status) }}</td>
                            <td>{{ $value->total }}</td>
                            <td>
                                <a href="{{ route('shops.scheduled_cart_items', ['id' => Crypt::encrypt($value->order_id)]) }}" target="_blank" style="cursor:pointer;"
                                    class="text-warning">
                                    <i class="dashicons dashicons-cart"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Scheduled Orders Found. <a href='{{ route('shops.list') }}'>Browser
                                    Products</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalViewProducts" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        jQuery(document).ready(function() {

        });
    </script>
@endpush
