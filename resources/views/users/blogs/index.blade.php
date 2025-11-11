@extends('layout.master.main')

@section('title', 'Blogs')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Blogs',
    ])
@endsection

@section('dashboard-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blogs</h1>
            </div>
        </div>
    </div>
@endsection
