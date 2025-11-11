@extends('layout.master.main')

@section('title', 'Not Found')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Not Found',
    ])

@section('dashboard-content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <span>Not Found</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-danger" style="text-decoration: underline;">! 404 Page Not Found</h1>
                        <p class="text-gray-500 h4">The page you are looking for does not exist.</p>
                        <a href="{{ route('users.show_dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
