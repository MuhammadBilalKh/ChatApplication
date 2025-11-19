@extends('layout.master.main')

@section('title', 'Advertisments')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Advertisments',
    ])
@endsection

@section('dashboard-content')
    <nav class="nav-component">
        <ul id="menu-adverts-menu" class="nav-component-list advert-navbar">
            <li id="menu-item-118" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-118">
                <a type="button">All
                    Adverts</a>
            </li>

            <li id="menu-item-119" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                <a type="button">Submit</a>
            </li>

            @if (Auth::user()->user_type == USER_TYPE_ADMIN)
                <li id="menu-item-120"
                    class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-511 menu-item-120">
                    <a type="button" aria-current="page">Categories</a>
                </li>

                <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                    <a type="button">Pending Adverts</a>
                </li>
            @endif

            <li id="menu-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-119">
                <a type="button">Marked Featured</a>
            </li>

        </ul>
    </nav>

    <article id="post-493" class=" post-493 page type-page status-publish hentry beehive-post">
        @if (session()->has('success'))
            <div class="alert alert-success">
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $key => $value)
                        <li>{{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="container" class="entry-content clearfix">

        </div>
    </article>

    <div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog" aria-labelledby="modalEditCategoryTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>

                </div>
                <div class="modal-body">

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
            loadTabContent(jQuery("#menu-item-118"), "list");

            jQuery(".alert").delay(2500).fadeOut();

            jQuery("#menu-item-118").on("click", function() {
                loadTabContent(this, "list");
            });

            jQuery("#menu-item-119").on("click", function() {
                loadTabContent(this, "create");
            });

            jQuery("#menu-item-120").on("click", function() {
                loadTabContent(this, "categories");
            });

            jQuery("#menu-item-121").on("click", function() {
                loadTabContent(this, "mark-featured");
            });

            jQuery("#menu-item-122").on("click", function() {
                loadTabContent(this, "pending-for-approval");
            });
        });

        function loadTabContent(menuItem, viewType) {

            jQuery(".nav-component-list li").removeClass("current-menu-item current_page_item");

            jQuery(menuItem).addClass("current-menu-item current_page_item");

            jQuery.ajax({
                url: "{{ route('adverts.list') }}",
                type: "{{ FORM_METHOD_GET }}",
                data: {
                    view_type: viewType,
                },
                beforeSend: function() {
                    jQuery("#container").html("<span class='h4'>Loading.. Please Wait!</span>");
                },
                success: function(resp) {
                    jQuery("#container").html(resp);
                },
                error: function() {
                    jQuery("#container").html(
                        "<span class='h4' style='color: #dc3545;'>An Error Occured While Processing The Request!</span>"
                    );
                }
            });
        }

        function EditCategory(el) {
            jQuery.ajax({
                url: "{{ route('categories.edit') }}",
                type: "{{ FORM_METHOD_GET }}",
                data: {
                    category_id: el.id
                },
                success: function(resp) {
                    jQuery(".modal-body").html(resp);
                }
            });
        }
    </script>
@endpush

@push('script')
    <script>
        function MarkFeatured(e) {
            jQuery("#txtAdvertismentID").val(e.id);
        }

        function ManageApprovalStatus(e, approvalStatus){
            jQuery("#txtAdvertismentID").val(e.id)
            jQuery("#lblStatus").html(approvalStatus);
            jQuery("#txtApprovalStatus").val(approvalStatus);
        }
    </script>
@endpush
