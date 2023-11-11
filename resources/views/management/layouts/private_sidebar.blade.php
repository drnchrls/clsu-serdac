
<div class="sidebar d-flex align-items-center shadow" id="toggleSidebar"> 
    <div class="user-account">
        <img src="{{ url('import/assets/images/logo/clsu-serdac-logo.jpeg') }}" alt="logo" />
    </div>
    @if(Auth::guard('staff')->user()->staff_role == 'Admin')
        <ul class="links">
            <h5>Main Menu</h5>
            {{-- <li>
                <span class="material-symbols-outlined">dashboard</span>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li> --}}
            <li>
                <span class="material-symbols-outlined">monitoring</span>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            {{-- <li>
                <span class="material-symbols-outlined">flag</span>
                <a href="#">Reports</a>
            </li> --}}
            <hr>
            <h5>Web Content</h5>
            <li>
                <span class="material-symbols-outlined">view_carousel</span>
                <a href="{{route('admin.sliders')}}">Slider</a>
            </li>
            <li>
                <span class="material-symbols-outlined">campaign</span>
                <a href="{{ route('admin.announcements') }}"> Announcement </a>
            </li>
            <li>
                <span class="material-symbols-outlined">gallery_thumbnail</span>
                <a href="{{route('admin.galleries')}}"> Gallery </a>
            </li>
            <hr>
            <h5>E-Library</h5>
            <li>
                <span class="material-symbols-outlined">dataset</span>
                <a href="{{route('admin.datasets')}}">Dataset</a>
            </li>
            <li>
                <span class="material-symbols-outlined">menu_book</span>
                <a href="{{route('admin.publications')}}">Publication</a>
            </li>
            <li>
                <span class="material-symbols-outlined">assignment</span>
                <a href="{{ route('admin.publications.requests') }}">Publication Request</a>
            </li>
            <hr>
            <h5>Service</h5>
            <li>
                <span class="material-symbols-outlined">sms</span>
                <a href="{{route('admin.services.requests')}}">Service Request</a>
            </li>
            <hr>
            <h5>Accounts</h5>
            <li>
                <span class="material-symbols-outlined">group</span>
                <a href="{{ route('admin.users') }}">User Accounts</a>
            </li>
            <li>
                <span class="material-symbols-outlined">badge</span>
                <a href="{{ route('admin.staffs') }}">Staff Accounts</a>
            </li>
            <li>
                <span class="material-symbols-outlined">admin_panel_settings</span>
                <a href="{{ url('admin/profile/id='.Auth::guard('staff')->user()->staff_id) }}">My Account</a>
            </li>
            <hr>
            <li class="logout">
                <span class="material-symbols-outlined">logout</span>
                <a href="{{ route('staff.logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    @elseif(Auth::guard('staff')->user()->staff_role == 'Library Staff')
        <ul class="links">
            <h5>Main Menu</h5>
            <li>
                <span class="material-symbols-outlined">dashboard</span>
                <a href="{{ route('libr.dashboard') }}">Dashboard</a>
            </li>
            <hr>
            <h5>E-Library</h5>
            <li>
                <span class="material-symbols-outlined">dataset</span>
                <a href="{{route('libr.datasets')}}">Dataset</a>
            </li>
            <li>
                <span class="material-symbols-outlined">menu_book</span>
                <a href="{{route('libr.publications')}}">Publication</a>
            </li>
            <li>
                <span class="material-symbols-outlined">assignment</span>
                <a href="{{ route('libr.publications.requests') }}">Publication Request</a>
            </li>
            <hr>
            <h5>Accounts</h5>
            <li>
                <span class="material-symbols-outlined">admin_panel_settings</span>
                <a href="{{ url('libr/profile/id='.Auth::guard('staff')->user()->staff_id) }}">My Account</a>
            </li>
            <hr>
            <li class="logout">
                <span class="material-symbols-outlined">logout</span>
                 <a href="{{ route('staff.logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    @else        
    <ul class="links">
        <h5>Main Menu</h5>
        <li>
            <span class="material-symbols-outlined">dashboard</span>
            <a href="{{ route('serv.dashboard') }}">Dashboard</a>
        </li>
        <hr>
        <h5>Service</h5>
        <li>
            <span class="material-symbols-outlined">sms</span>
            <a href="{{route('serv.services.requests')}}">Service Request</a>
        </li>
        <hr>
        <h5>Accounts</h5>
        <li>
            <span class="material-symbols-outlined">admin_panel_settings</span>
            <a href="{{ url('serv/profile/id='.Auth::guard('staff')->user()->staff_id) }}">My Account</a>
        </li>
        <hr>
        <li class="logout">
            <span class="material-symbols-outlined">logout</span>
            <a href="{{ route('staff.logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('staff.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.querySelector(".sidebar");
            const toggleButton = document.getElementById("toggleSidebar");
            
            function closeSidebar() {
                sidebar.classList.remove("expanded");
            }
            toggleButton.addEventListener("click", function () {
                sidebar.classList.toggle("expanded");
            });
            document.addEventListener("click", function (event) {
                if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                    closeSidebar();
                }
            });
        });
    </script>
</div>