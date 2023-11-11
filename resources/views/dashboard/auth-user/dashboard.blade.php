@extends('index.index')
@section('web-content')
    @php
        $activeSection = Route::currentRouteName();
    @endphp
    <div class="row m-1 py-5">
        <div class="col-lg-3 text-center border-right">
            <div class="user-dashboard ">
                <div class="details-pane px-5 pt-5 pb-2 ">
                    <span class="material-symbols-outlined sz-70">
                        account_circle
                        </span>
                    <div>
                        <div class="name mt-3">
                            <h3> {{ Auth::guard('web')->user()->fname }} </h3>
                        </div>
                        <div class="email">
                            <small class="text-muted">{{ Auth::guard('web')->user()->lname }}</small>
                        </div>
                    </div>
                </div>
                <div class="px-4">
                    <hr>
                </div>
                <div class="menu-pane py-1 text-left">
                    <ul>
                        <li class="{{ request()->is('auth-dashboard*') ? 'active-link' : '' }}">
                            <span class="material-symbols-outlined">settings_account_box</span>
                            <a href="{{url('profile')}}"> Profile</a>
                        </li>
                        <li class="{{ request()->is('auth-downloads*') ? 'active-link' : '' }}">
                            <span class="material-symbols-outlined">download</span>
                            <a href="{{route('history')}}"> Downloads</a>
                        </li>
                        <li class="{{ request()->is('auth-requests*') ? 'active-link' : '' }}">
                            <span class="material-symbols-outlined">recent_actors</span>
                            <a href="{{url('request-history')}}"> Requests</a>
                        </li>
                        <li class="{{ request()->is('auth-change*') ? 'active-link' : '' }}">
                            <span class="material-symbols-outlined">password</span>
                            <a href="{{url('password/change')}}"> Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @yield('account-content')
    </div>
@endsection