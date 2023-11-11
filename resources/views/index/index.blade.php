<!DOCTYPE html>
<html lang="en">
    <head>
      <title> @yield('title')</title>
      @include('layouts.stylesheet')
    </head>
    <body>
      @include('layouts.header') 
      @yield('slider-content')
      @include('layouts.navigation')
      <div class="container">
        @yield('web-content')
      </div>
      {{-- <div class="row mx-lg-3 m-0 mx-nh bg-white">
        <div class="col-lg-12">
          
        </div>
      </div> --}}
      {{-- <div class="container">
      </div>
        <div class="row mx-lg-0 m-0 mx-nh p-0">
          <div class="col-lg-12 p-0">
            <div class="row mx-lg-0 m-0 mx-nh bg-white">
              <div class="col-lg-12 p-0">
        @yield('web-content')
              </div>
            </div>
          </div>
        </div> --}}
      @include('layouts.footer')
    </body>
</html>