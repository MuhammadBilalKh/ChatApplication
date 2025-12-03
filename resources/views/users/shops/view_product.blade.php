@php
    session()->put('show_right_bar',  false)
@endphp
@extends('layout.master.main')

@section('title', $product->name)

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => $product->name,
    ])
@endsection

@push('css')
    <style>
        .zoomImg {
            transition: transform 0.3s ease;
            /* Smooth zoom effect */
        }

        .zoomImg:hover {
            transform: scale(1.1);
            /* Increase size by 10% */
        }


        /* Make only this modal full screen */
        #productZoomModal .modal-dialog {
            width: 100%;
            height: 100%;
            margin: 0;
            max-width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #productZoomModal .modal-content {
            width: 100%;
            height: 100%;
            background-color: #000;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #productZoomModal .modal-body {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 0;
        }

        #productZoomModal .img-fluid {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .closeModal:hover {
            height: 40px;
            width: 40px;
        }

        .closeModal:hover {
            background-color: #f5bd02;
            color: #fff;
        }
    </style>
@endpush

@section('dashboard-content')

    <div id="product-299"
        class="kmk-post product type-product post-299 status-publish first instock product_cat-hoodies has-post-thumbnail featured shipping-taxable purchasable product-type-simple">

        <div class="kmk-product-gallery kmk-product-gallery--with-images kmk-product-gallery--columns-4 images"
            data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out;">
            <a href="#" role="button" class="kmk-product-gallery__trigger" aria-haspopup="dialog"
                aria-controls="photoswipe-fullscreen-dialog" aria-label="View full-screen image gallery"><span
                    aria-hidden="true"></span></a>
            <div class="kmk-product-gallery__wrapper">
                <div data-thumb="./assets/images/hoodie-with-zipper-2-100x100.jpg" data-thumb-alt="Hoodie with Zipper"
                    class="kmk-product-gallery__image" style="position: relative; overflow: hidden;">
                    <a href="#">
                        <img fetchpriority="high" width="600" height="600"
                            src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/2020/01/album-1.jpg"
                            class="kmk-post-image" alt="Hoodie with Zipper">
                    </a>

                </div>
            </div>
        </div>

        <div class="summary entry-summary">
            <nav class="woocommerce-breadcrumb" aria-label="Breadcrumb">
                <a href="https://www.clientbetalink.xyz/MIGVELv1">Home</a>&nbsp;/&nbsp;
                <a href="https://www.clientbetalink.xyz/MIGVELv1/product-category/clothing/">Clothing</a>&nbsp;/&nbsp;
                <a
                    href="https://www.clientbetalink.xyz/MIGVELv1/product-category/clothing/hoodies/">Hoodies</a>&nbsp;/&nbsp;Hoodie
                with Zipper
            </nav>
            <h1 class="product_title entry-title">Hoodie with Zipper</h1>
            <p class="price">
                <span class="woocommerce-Price-amount amount">
                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>45.00</bdi>
                </span>
            </p>
            <div class="kmk-product-details__short-description">
                <p>This is a simple product.</p>
            </div>

            <form class="cart" action="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie-with-zipper/" method="post"
                enctype="multipart/form-data">

                <div class="quantity">
                    <label class="screen-reader-text" for="quantity_690552de97dcb">
                        Hoodie with Zipper quantity
                    </label>
                    <input type="number" id="quantity_690552de97dcb" class="input-text qty text" name="quantity"
                        value="1" aria-label="Product quantity" min="1" step="1" inputmode="numeric"
                        autocomplete="off">
                </div>

                <button type="submit" name="add-to-cart" value="299" class="single_add_to_cart_button button alt">Add to
                    cart</button>

            </form>

            <div class="product_meta">
                <span class="sku_wrapper">SKU: <span class="sku">woo-hoodie-with-zipper</span></span>
                <span class="posted_in">Category:
                    <a href="https://www.clientbetalink.xyz/MIGVELv1/product-category/clothing/hoodies/"
                        rel="tag">Hoodies</a>
                </span>
            </div>
        </div>
        <style>
            .woocommerce-Tabs-panel {
                display: none;
                padding: 20px;
                border-top: none;
                background: #fff;
            }

            .woocommerce-Tabs-panel.active {
                display: block;
            }
        </style>
        <div class="woocommerce-tabs wc-tabs-wrapper">
            <ul class="tabs wc-tabs" role="tablist">
                <li role="presentation" class="description_tab active" id="tab-title-description">
                    <a href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true"
                        tabindex="0">Description</a>
                </li>
                <li role="presentation" class="reviews_tab" id="tab-title-reviews">
                    <a href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false"
                        tabindex="-1">Reviews (0)</a>
                </li>
            </ul>

            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab"
                id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">

                <h2>Description</h2>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada
                    fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae,
                    ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam
                    egestas semper. Aenean ultricies mi vitae est. Mauris placerat
                    eleifend leo.</p>
            </div>

            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews panel entry-content wc-tab" id="tab-reviews"
                role="tabpanel" aria-labelledby="tab-title-reviews">
                <div id="reviews" class="woocommerce-Reviews">
                    <div id="comments">
                        <h2 class="woocommerce-Reviews-title">
                            1 review for <span>Album</span> </h2>

                        <ol class="commentlist">
                            <li class="review byuser comment-author-sandlas even thread-even depth-1" id="li-comment-11">

                                <div id="comment-11" class="comment_container">

                                    <img alt=""
                                        src="https://www.clientbetalink.xyz/MIGVELv1/wp-content/uploads/avatars/2/1761166349-bpfull.jpg"
                                        srcset="https://www.clientbetalink.xyz/MIGVELv1https://placehold.co/100x100"
                                        class="avatar avatar-60 photo" height="60" width="60">
                                    <div class="comment-text">

                                        <div class="star-rating" role="img" aria-label="Rated 5 out of 5"><span
                                                style="width:100%">Rated <strong class="rating">5</strong> out of
                                                5</span></div>
                                        <p class="meta">
                                            <strong class="woocommerce-review__author">Sandlas
                                            </strong>
                                            <span class="woocommerce-review__dash">–</span>
                                            <time class="woocommerce-review__published-date"
                                                datetime="2025-11-03T20:31:41+00:00">November
                                                3, 2025</time>
                                        </p>

                                        <div class="description">
                                            <p>test</p>
                                        </div>
                                    </div>
                                </div>
                            </li><!-- #comment-## -->
                        </ol>

                    </div>

                    <div id="review_form_wrapper">
                        <div id="review_form">
                            <div id="respond" class="comment-respond">
                                <span id="reply-title" class="comment-reply-title" role="heading" aria-level="3">Add a
                                    review <small><a rel="nofollow" id="cancel-comment-reply-link"
                                            href="/MIGVELv1/product/album/#respond" style="display:none;">Cancel
                                            reply</a></small></span>
                                <form action="https://www.clientbetalink.xyz/MIGVELv1/wp-comments-post.php" method="post"
                                    id="commentform" class="comment-form">
                                    <div class="comment-form-rating"><label for="rating"
                                            id="comment-form-rating-label">Your
                                            rating&nbsp;<span class="required">*</span></label>
                                        <p class="stars"> <span role="group"
                                                aria-labelledby="comment-form-rating-label">
                                                <a role="radio" tabindex="0" aria-checked="false" class="star-1"
                                                    href="#">1 of 5 stars</a> <a role="radio" tabindex="-1"
                                                    aria-checked="false" class="star-2" href="#">2 of 5 stars</a>
                                                <a role="radio" tabindex="-1" aria-checked="false" class="star-3"
                                                    href="#">3 of 5 stars</a> <a role="radio" tabindex="-1"
                                                    aria-checked="false" class="star-4" href="#">4 of 5 stars</a>
                                                <a role="radio" tabindex="-1" aria-checked="false" class="star-5"
                                                    href="#">5 of 5 stars</a> </span>
                                        </p><select name="rating" id="rating" required="" style="display: none;">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select>
                                    </div>
                                    <p class="comment-form-comment"><label for="comment">Your review&nbsp;<span
                                                class="required">*</span></label>
                                        <textarea id="comment" name="comment" cols="45" rows="8" required=""></textarea>
                                    </p>
                                    <p class="form-submit"><input name="submit" type="submit" id="submit"
                                            class="submit" value="Submit"> <input type="hidden" name="comment_post_ID"
                                            value="302" id="comment_post_ID">
                                        <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                    </p>
                                </form>
                            </div><!-- #respond -->
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <section class="related products">
            <div class="block-title center">
                <h3>Related products</h3>
            </div>
            <ul class="products columns-4">
                <li class="animate-item slideInUp kmk-post product type-product post-291 status-publish first instock product_cat-hoodies has-post-thumbnail sale shipping-taxable purchasable product-type-variable"
                    style="visibility: visible; animation-name: slideInUp;">
                    <div class="item-product">
                        <span class="onsale">Sale!</span>
                        <div class="img-top">
                            <div class="product-img">
                                <img width="300" height="300" src="https://placehold.co/600x600"
                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Hoodie">
                            </div>
                            <div class="hover-only">
                                <a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie/"
                                    class="hover-overlay"></a>
                                <ul class="product-actions">
                                    <li><a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie/"
                                            data-quantity="1" class="button product_type_variable add_to_cart_button"
                                            data-product_id="291" data-product_sku="woo-hoodie"
                                            aria-label="Select options for “Hoodie”" rel="nofollow">Select options</a>
                                    </li>
                                    <li><a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie/"
                                            class="view_cart_button" aria-label="View Product">View
                                            Product</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <h2 class="woocommerce-loop-product__title">
                                <a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie/">Hoodie</a>
                            </h2>
                            <span class="price">
                                <span class="woocommerce-Price-amount amount" aria-hidden="true">
                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>42.00</bdi>
                                </span>
                                <span aria-hidden="true">–</span>
                                <span class="woocommerce-Price-amount amount" aria-hidden="true">
                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>45.00</bdi>
                                </span>
                                <span class="screen-reader-text">Price range: $42.00
                                    through $45.00</span>
                            </span>
                        </div>
                    </div>
                </li>

                <li class="animate-item slideInUp kmk-post product type-product post-292 status-publish instock product_cat-hoodies has-post-thumbnail shipping-taxable purchasable product-type-simple"
                    style="visibility: visible; animation-name: slideInUp;">
                    <div class="item-product">
                        <div class="img-top">
                            <div class="product-img">
                                <img width="300" height="300" src="https://placehold.co/600x600"
                                    class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"
                                    alt="Hoodie with Logo">
                            </div>
                            <div class="hover-only">
                                <a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie-with-logo/"
                                    class="hover-overlay"></a>
                                <ul class="product-actions">
                                    <li><a href="/MIGVELv1/product/hoodie-with-zipper/?add-to-cart=292" data-quantity="1"
                                            class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                            data-product_id="292" data-product_sku="woo-hoodie-with-logo"
                                            aria-label="Add to cart: “Hoodie with Logo”" rel="nofollow"
                                            data-success_message="“Hoodie with Logo” has been added to your cart"
                                            role="button">Add to cart</a></li>
                                    <li><a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie-with-logo/"
                                            class="view_cart_button" aria-label="View Product">View
                                            Product</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <h2 class="woocommerce-loop-product__title">
                                <a href="https://www.clientbetalink.xyz/MIGVELv1/product/hoodie-with-logo/">Hoodie
                                    with Logo</a>
                            </h2>
                            <span class="price">
                                <span class="woocommerce-Price-amount amount">
                                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>45.00</bdi>
                                </span>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
        </section>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.stars a');
            const ratingSelect = document.getElementById('rating');

            stars.forEach((star, index) => {
                star.addEventListener('mouseover', () => {
                    highlightStars(index);
                });

                star.addEventListener('mouseout', () => {
                    resetStars();
                });

                star.addEventListener('click', (e) => {
                    e.preventDefault();
                    ratingSelect.value = 5 - (4 - index); // set hidden select value
                    setSelectedStars(index);
                });
            });

            function highlightStars(index) {
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('hover');
                    } else {
                        star.classList.remove('hover');
                    }
                });
            }

            function resetStars() {
                stars.forEach(star => star.classList.remove('hover'));
            }

            function setSelectedStars(index) {
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            }
        });
    </script>
    <!-- rating -->

    <!-- tab -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tabLinks = document.querySelectorAll(".wc-tabs li a");
            const tabPanels = document.querySelectorAll(".woocommerce-Tabs-panel");

            tabLinks.forEach(link => {
                link.addEventListener("click", (e) => {
                    e.preventDefault();

                    // Remove active classes
                    document.querySelectorAll(".wc-tabs li").forEach(li => li.classList.remove(
                        "active"));
                    tabPanels.forEach(panel => panel.classList.remove("active"));

                    // Add active to clicked tab
                    link.parentElement.classList.add("active");

                    // Show related panel
                    const targetId = link.getAttribute("href");
                    const targetPanel = document.querySelector(targetId);
                    if (targetPanel) targetPanel.classList.add("active");
                });
            });
        });
    </script>
    <!-- --- tab -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Find the zoom trigger button
            const zoomTrigger = document.querySelector('.kmk-product-gallery__trigger');
            const productImage = document.querySelector('.kmk-product-gallery__image img');
            const zoomedImage = document.getElementById('zoomedImage');

            if (zoomTrigger && productImage) {
                zoomTrigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Get large image source (if data attribute exists, otherwise fallback to src)
                    const largeSrc = productImage.getAttribute('data-large_image') || productImage.src;
                    zoomedImage.src = largeSrc;
                    // Show the Bootstrap modal
                    $('#productZoomModal').modal('show');
                });
            }

            // Optional: Reset zoomed image when modal is closed
            $('#productZoomModal').on('hidden.bs.modal', function() {
                zoomedImage.src = '';
            });
        });

        document.querySelectorAll('.kmk-product-gallery__image').forEach(container => {
            const img = container.querySelector('img');

            container.addEventListener('mousemove', e => {
                const rect = container.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                img.style.transformOrigin = `${x}% ${y}%`;
                img.style.transform = 'scale(2)';
            });

            container.addEventListener('mouseleave', () => {
                img.style.transformOrigin = 'center center';
                img.style.transform = 'scale(1)';
            });
        });
    </script>
@endpush
