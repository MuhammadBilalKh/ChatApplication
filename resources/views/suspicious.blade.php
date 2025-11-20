@extends('layout.master.main')

@section('title', 'Suspicious Activity')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'title' => 'Suspicious Activity',
    ])

@endsection

@section('dashboard-content')
    <div class="container">
        <span class="h3 text-danger">You Have Done Suspicious Acitivty</span>
    </div>
@endsection
