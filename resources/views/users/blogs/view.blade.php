@extends('layout.master.main')

@section('title', 'Post detail')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Post detail',
    ])
@endsection

@section('dashboard-content')

    <div class="entry-header">

        <div class="post-author">
            <span class="author-link">By: <a href="{{ route('users.profile') }}"
                    title="Posts by {{ $blogData->blogPostedBy->username }}"
                    rel="author">{{ $blogData->blogPostedBy->username }}</a>
            </span>
        </div>

        <div class="entry-title">
            <h1 class="title h1">{{ $blogData->title }}</h1>
        </div>
    </div>

    <div class="entry-meta">

        <span class="link date-links"><i class="uil-tag-alt"></i>

            @foreach ($categories as $key => $category)
                <a type="button">{{ $category }}</a>,
            @endforeach
        </span>

        <span class="link tags-links"><i class="uil-tag-alt"></i>

            @foreach ($tags as $key => $value)
                <a type="button">{{ $value }}</a>,
            @endforeach
        </span>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            @forelse ($blogData->getBlog as $key => $value)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ asset('/storage/' . $value->file_path) }}" alt="Slide">
                </div>
            @empty
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('/storage/' . $blogData->featured_image) }}" alt="Slide">
                </div>
            @endforelse

        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container-fluid mt-3">
        {!! $blogData->content !!}
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/bootstrap_carousel.min.js') }}"></script>
@endpush
