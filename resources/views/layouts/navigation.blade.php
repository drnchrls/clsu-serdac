<nav class="navbar navbar-expand-lg sticky-top text-center">
  <div id="collapsible-div" class="my-div">
    <small class="navbar-brand">
      <img src="{{ url('import/assets/images/logo/clsu-serdac-logo.jpeg') }}" class="" width="50" height="50" alt="">
      <span>SERDAC</span>
    </small>
  </div>
  <button class="navbar-toggler justify-content-center" type="button" data-toggle="collapse" data-target="#navbarContent">
    <span class="fa fa-bars"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav m-auto">
      <li class="nav-item">
        <a class="nav-link current" href="{{ url('/#home') }}">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/#news') }}">News</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/#about-us') }}">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/#services') }}">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/#gallery') }}">Gallery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/#publications') }}">E-Library</a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
          <a class="dropdown-toggle" type="button" href="#" id="dropdownMenuButtons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Request
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButtons">
            <a class="dropdown-item" href="{{ url('/service-request') }}">Service Request</a>
            <a class="dropdown-item" href="{{ url('/submission-publication') }}">Submit Publication</a>
          </div>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/#partners') }}">Partners</a>
      </li> --}}
      @auth('staff')
      <li class="nav-item ">
        <div class="dropdown">
          <a class="dropdown-toggle" type="button" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Account
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if(Auth::guard('staff')->user()->staff_role == 'Admin')
              <a class="dropdown-item" href="{{url('admin/profile').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Profile') }}</a>
              {{-- <a class="dropdown-item" href="{{url('admin/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Change Password') }}</a> --}}
              @endif  
            @if(Auth::guard('staff')->user()->staff_role == 'Library Staff')
              <a class="dropdown-item" href="{{url('libr/profile').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Profile') }}</a>
              {{-- <a class="dropdown-item" href="{{url('libr/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Change Password') }}</a> --}}
            @endif
            @if(Auth::guard('staff')->user()->staff_role == 'Service Staff')
              <a class="dropdown-item" href="{{url('serv/profile').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Profile') }}</a>
              {{-- <a class="dropdown-item" href="{{url('serv/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}">{{ __('Change Password') }}</a> --}}
            @endif
              <a class="dropdown-item" href="{{ route('staff.logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                  <span class="text-danger">Logout</span>
              </a>
              <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>
        </div>
      </li>
      @else
      @auth('web')
      <li class="nav-item ml-lg-5 pl-lg-2">
        <div class="dropdown">
          <a class="dropdown-toggle" type="button" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
           </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{url('profile')}}">{{ __('Profile') }}</a>
              {{-- <a class="dropdown-item" href="{{url('password/change')."/id=".Auth::guard('web')->user()->id}}">{{ __('Change Password') }}</a> --}}
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 <span class="text-danger">Logout</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>
        </div>
      </li>
      @else
        @if (Route::has('login'))
      <li class="nav-item ml-lg-5 pl-lg-5">
        <a class="login-button nav-link rounded" href="{{ route('login') }}">
          Login <i class="pl-3 fa fa-user"></i>
        </a>
      </li>
      @endif
    </ul>
     @endauth   
    @endauth
  </div>
</nav>
  
      {{-- <a class="lms-button lg-12 py-1 px-3 shadow-sm rounded" href="{{ url('https://sites.google.com/clsu.edu.ph/serdac-lms/about-lms') }}">
          Login <i class="fa fa-user"></i>
      </a> --}}
        <!-- Authentication Links -->
        {{-- @auth('staff')
          <li class="nav-item dropdown ml-lg-5 pl-lg-2">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              Account                  
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
              {{-- {{ Auth::guard('staff')->user()->staff_fname }}   --}}
              {{-- @if(Auth::guard('staff')->user()->staff_role == 'Admin')
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
                <div class="dropdown-divider"></div>
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
          <li class="nav-item dropdown ml-lg-5 pl-lg-2">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
               Account           
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                {{-- <a class="dropdown-item" href="{{route('dashboard')}}">{{ __('Dashboard') }}</a> --}}
                {{-- <a class="dropdown-item" href="{{url('profile')}}">{{ __('Profile') }}</a>
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
          <li class="nav-item ml-lg-5 pl-lg-5">
            <a class="login-button nav-link rounded" href="{{ route('login') }}">
              Login <i class="pl-3 fa fa-user"></i>
            </a>
          </li>
          @endif
        </ul>
         @endauth   
        @endauth --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li> --}}
            {{-- @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif --}}