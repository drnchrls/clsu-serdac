
<html lang="en">
    <head>
        <title>CLSU SERDAC | @yield('title')</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        @include('management.layouts.private_sidebar')
        @include('management.layouts.private_header')
        <div class="dashboard-container ml-5">
            @yield('content')
        </div>
        <script type="text/javascript"> 
            function doDate()
                {
                    var str = "";
                    var days = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                    var months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    
                    var now = new Date();
    
                    var time = now.toLocaleTimeString();
    
                    str += days[now.getDay()] + ", " + now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear() + " " + time;
                    document.getElementById("ct").innerHTML = str;
                }
    
                setInterval(doDate, 1000);
            </script>
    </body>
</html>