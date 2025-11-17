@extends('layout.profile.profile-main')

@section('title', 'Friend Requests')

@section('dashboard-breadcrumbs')
    @include('layout.master.breadcrumbs', [
        'pageHeader' => 'Friend Requests',
    ])
@endsection

@section('profile-content')
<nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Profile menu">
    <ul id="member-secondary-nav" class="subnav bp-priority-subnav-nav-items">
        <li id="public-personal-li" class="bp-personal-sub-tab current selected" data-bp-user-scope="public">
            <a href="{{ url('/members-2/sandlas/profile/public') }}" id="public">
                Friend Requests
            </a>
        </li>
    </ul>
</nav>
@endsection
