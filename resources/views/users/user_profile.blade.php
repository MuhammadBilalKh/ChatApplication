@extends('layout.master.main')

@section('title', '@'.Auth::user()->username)

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', ['pageHeader' => '@'.Auth::user()->username])
@endsection
