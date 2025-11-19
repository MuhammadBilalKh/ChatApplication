@extends('layout.master.main')

@section('title', $advert->advertisment_title)

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => $advert->advertisment_title,
    ])
@endsection

@section('dashboard-content')
    <article id="post-337" class="post-337 classified type-advert status-publish hentry kmk-post">
        <div class="entry-header">
            <div class="single-classified-title mt-5">
                <h1 class="title h2">{{ $advert->advertisment_title }}
                </h1>
            </div>
        </div>
        <div class="entry-content clearfix">

            <div class="product-gallery">

                @php
                    $media = $advert->getAdvertMedia;
                @endphp

                <!-- Main image -->
                <div class="main-image" id="mainImageContainer" data-toggle="modal" data-target="#imageModal">
                    <img id="mainImage"
                        src="{{ $media->first() ? asset('storage/' . $media->first()->media_path) : 'https://placehold.co/900x600' }}"
                        alt="Product Image">
                </div>

                <div class="image-counter">
                    <i class="uil uil-camera"></i>
                    <span id="currentIndex">1</span> /
                    <span id="totalImages">{{ $media->count() }}</span>
                </div>

                <!-- Thumbnails -->
                <div class="thumbs">
                    @forelse($media as $m)
                        <img src="{{ asset('storage/' . $m->media_path) }}" alt="thumb">
                    @empty
                        <img src="https://placehold.co/900x600" alt="thumb">
                    @endforelse
                </div>

                <div class="gallery-controls d-none">
                    <button id="prevBtn">&#8592;</button>
                    <button id="nextBtn">&#8594;</button>
                </div>

            </div>

            <div
                class="wpadverts-cpt wpadverts-cpt- wpadverts-cpt-data-table wpadverts-cpt-data-table-list atw-w-full atw-flex atw-flex-col">
                <div
                    class="atw-grid atw-grid-cols-1 md:atw-grid-cols-1 atw-border-x-0 atw-border-b-0 atw-mt-6 atw-border-t atw-border-solid atw-border-gray-100">
                    <div class="atw-border-0 atw-border-b atw-border-solid atw-border-gray-100 atw-pb-2">
                        <div class="atw-flex atw-pt-3 atw-pb-1 atw-mx-0">
                            <div
                                class="atw-hidden md:atw-flex atw-justify-center atw-items-center atw-bg-gray-200 atw-w-10 atw-h-10 atw-rounded-full atw-mr-3">
                                <div class=" ">
                                    <i class="fas fa-location-dot atw-text-gray-400 atw-text-lg"></i>
                                </div>
                            </div>
                            <div class="atw-flex atw-flex-col md:atw-flex-row atw-grow">


                                <div class="seller-info">
                                    <div class="seller-details">
                                        <img src="https://placehold.co/50" alt="avatar">
                                        <div>
                                            <div class="seller-name">{{ $advert->advertPostedBy->username }}</div>
                                            <div class="seller-date">Published
                                                {{ $advert->created_at->diffForHumans() }}</div>
                                            <div>
                                                <span class="atw-inline-block ">{{ $advert->location }}</span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="price-box">
                                        <span>${{ number_format($advert->price) }}</span>
                                    </div>
                                </div>

                                <div
                                    class="wpadverts-cpt wpadverts-cpt- wpadverts-cpt-data-table wpadverts-cpt-data-table-list atw-w-full atw-flex atw-flex-col">
                                    <div
                                        class="atw-grid atw-grid-cols-1 md:atw-grid-cols-1 atw-border-x-0 atw-border-b-0 atw-mt-6 atw-border-t atw-border-solid atw-border-gray-100">
                                        <div
                                            class="atw-border-0 atw-border-b atw-border-solid atw-border-gray-100 atw-pb-2">
                                            <div class="atw-flex atw-pt-3 atw-pb-1 atw-mx-0">
                                                <div
                                                    class="atw-hidden md:atw-flex atw-justify-center atw-items-center atw-bg-gray-200 atw-w-10 atw-h-10 atw-rounded-full atw-mr-3">
                                                    <div class=" ">
                                                        <svg class="svg-inline--fa fa-location-dot atw-text-gray-400 atw-text-lg"
                                                            aria-hidden="true" focusable="false" data-prefix="fas"
                                                            data-icon="location-dot" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                                            data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="atw-flex atw-flex-col md:atw-flex-row atw-grow">
                                                    <div
                                                        class="atw-flex atw-flex-none atw-items-center md:atw-w-1/3 atw-h-10 atw-text-gray-700 atw-text-base atw-mb-1 md:atw-mb-0">
                                                        <span
                                                            class="atw-inline-block atw-font-bold md:atw-font-normal">Location</span>
                                                    </div>
                                                    <div
                                                        class="atw-flex atw-grow atw-items-center atw-text-base atw-text-gray-800">
                                                        <span class="atw-inline-block ">{{ $advert->location }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div
                class="wpadverts-cpt wpadverts-cpt- wpadverts-cpt-data-table wpadverts-cpt-data-table-text atw-w-full atw-flex atw-flex-col">

                <div class="atw-mb-6">
                    <div class="mt-3">
                        <div>
                            <span
                                class="atw-inline-block h4 atw-text-gray-700 atw-text-xl atw-font-bold atw-py-3">Description</span>
                        </div>
                        <div class="atw-text-base">
                            {{ $advert->description }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="wpadverts-cpt wpadverts-cpt- wpadverts-cpt-single-contact atw-w-full atw-flex atw-flex-col">

                <style type="text/css">
                </style>

                <div class="wpa-cpt-contact-details">

                    <div class="atw-relative atw-flex atw-flex-col md:atw-flex-row atw--mx-1">

                        <div
                            class="wpadverts-contact-reveal-box atw-bg-gray-100 atw-border atw-border-solid atw-border-gray-200 atw-px-6 atw-pt-3 atw-rounded">

                            <div class="wpadverts-reveal-inner">
                                <div
                                    class="wpadverts-reveal-item wpadverts-reveal--adverts_email atw-flex atw-pb-3 atw-pr-6">
                                    <span class="atw-mr-3 atw-text-lg" title="Email"><svg
                                            class="svg-inline--fa fa-envelope" aria-hidden="true" focusable="false"
                                            data-prefix="fas" data-icon="envelope" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="wpadverts-reveal-value"><a
                                            href="mailto:{{ $advert->advertPostedBy->email }}">{{ $advert->advertPostedBy->email }}</a></span>
                                </div>
                                <div
                                    class="wpadverts-reveal-item
                                            wpadverts-reveal--adverts_phone atw-flex atw-pb-3 atw-pr-6">
                                    <span class="atw-mr-3 atw-text-lg" title="Phone"><svg class="svg-inline--fa fa-phone"
                                            aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                            data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z">
                                            </path>
                                        </svg><!-- <i class="fas fa-phone"></i> Font Awesome fontawesome.com --></span>
                                    <span class="wpadverts-reveal-value"><a
                                            href="tel:+7 (234) 3434 7685">{{ $advert->phone_number }}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@push('script')
    <script>
        const mainImage = document.getElementById('mainImage');
        const thumbs = document.querySelectorAll('.thumbs img');
        const currentIndex = document.getElementById('currentIndex');
        const totalImages = document.getElementById('totalImages');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const modalImage = document.getElementById('modalImage');
        let index = 0;

        if (thumbs.length > 0) {
            thumbs[0].classList.add('active');
        }

        thumbs.forEach((thumb, i) => {
            thumb.addEventListener('click', () => {
                thumbs.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');

                mainImage.style.opacity = 0;
                setTimeout(() => {
                    mainImage.src = thumb.src;
                    mainImage.style.opacity = 1;
                }, 150);

                index = i;
                currentIndex.textContent = i + 1;
            });
        });

        prevBtn.addEventListener('click', () => {
            index = (index - 1 + thumbs.length) % thumbs.length;
            thumbs[index].click();
        });

        nextBtn.addEventListener('click', () => {
            index = (index + 1) % thumbs.length;
            thumbs[index].click();
        });

        $('#imageModal').on('show.bs.modal', function() {
            modalImage.src = mainImage.src;
        });

        $('#imageModal').on('hidden.bs.modal', function() {
            modalImage.src = '';
        });
    </script>
@endpush
