<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    {{-- DATATABLES CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body onload="setTimer()">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
              <div id="collapsible-div" class="my-div">
                <small class="navbar-brand ml-3">
                  <a href="/">
                    <img src="{{ url('import/assets/images/logo/clsu-serdac-logo.jpeg') }}" class="ml-2" width="40" height="40" alt="">
                  </a>SERDAC
                </small>
              </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                  @auth('staff')
                    @if(Auth::guard('staff')->user()->staff_role == 'Admin')
                    <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('admin.users')}}">Users Account</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.staffs')}}">Staffs Account</a>
                      </li>
                    </ul>
                    @endif
                  @endauth
                  <ul class="navbar-nav me-auto">

                  </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
    @auth('staff')        
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                  {{ Auth::guard('staff')->user()->staff_fname }}                    
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

              @if(Auth::guard('staff')->user()->staff_role == 'Admin')
                <a class="dropdown-item" href="{{url('admin/profile').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{url('admin/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Change Password') }}</a>
              @endif  
              @if(Auth::guard('staff')->user()->staff_role == 'Library Staff')
                <a class="dropdown-item" href="{{url('libr/profile').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Profile') }}</a> 
                <a class="dropdown-item" href="{{url('libr/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Change Password') }}</a>
              @endif
              @if(Auth::guard('staff')->user()->staff_role == 'Service Staff')
                <a class="dropdown-item" href="{{url('serv/profile').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{url('serv/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Change Password') }}</a>
              @endif
              
                <div class="border-top"></div>
                <a class="dropdown-item" href="{{ route('staff.logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </li>

        @else

          @auth('web')
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              
                  {{ Auth::guard('web')->user()->fname }}  
                  <i class="fa fa-lg fa-user-circle" aria-hidden="true" style="font-size: 24px"></i>                  
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('dashboard')}}">{{ __('Dashboard') }}</a>
                <a class="dropdown-item" href="{{url('profile')."/id=".Auth::guard('web')->user()->id}}">{{ __('Profile') }}</a>
                <a class="dropdown-item" href="{{url('password/change')."/id=".Auth::guard('web')->user()->id}}">{{ __('Change Password') }}</a>
                <div class="border-top"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </li>

          @else
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif

          @endauth   


        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
</body>