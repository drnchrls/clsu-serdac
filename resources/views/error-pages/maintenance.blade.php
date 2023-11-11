<!DOCTYPE html>
<html>
    <head>
        <title> CLSU-SERDAC </title>
    </head>
    @include('layouts.stylesheet')
    <body>
        {{-- <header>
            <div class="header-maintenance row m-0 shadow-md rounded">
                <div class="col-lg-6 d-flex justify-content-left p-2">
                    <center>
                        <img src="{{ url('import/assets/images/logo/clsu-serdac-logo.jpeg') }}" class="ml-3" width="70" height="70" alt="logo">
                    </center>
                    <div class="header-org-name mt-2 ml-1">
                        <span class="header-org-main"> Socio-Economic Research and Data Analytics Center </span><br>
                        <span class="header-org-univ"> Central Luzon State University </span>
                    </div>
                </div>
                <div class="local-time col-lg-6 p-2 mt-2">
                    <div class="row m-0 ">
                        <div class="col-lg-12 text-right">
                            <small>
                                <b>
                                    Philippine Standard Time
                                </b>
                            </small>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right mt-2">
                        <small id='ct'></small>
                    </div>
                </div>
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
        </header> --}}
            <div class="container d-flex align-items-center">
                <div class="vh-100 row d-flex align-items-center">
                    <div class="col-lg-6 pt-5">
                        <img src="{{ url('import/assets/images/logo/png/under-cons.png') }}" class="img-fluid mt-3" alt="image">
                    </div>
                    <div class="col-lg-6 text-justify px-5 pt-5 pb-4">
                        <h4 class="text-muted font-weight-normal">Under Maintenance</h4>
                        <h1 class="header-text">We'll Be Back Soon.</h1>
                        <small class="header-description text-muted ">
                            <p> We are currently in the development and maintenance process of our website to provide you with an enhanced browsing experience. Please bear with us as we work diligently to bring you a more robust and user-friendly platform.
                                We apologize for any inconvenience this may cause.</p>
                            <p> We appreciate your patience and support during this period of improvement.
                                Thank you for your understanding, and we eagerly anticipate unveiling our upgraded website soon!</p>
                            <p>For urgent inquiries or assistance, please contact us at <a href="mailto:serdac_luzon@clsu.edu.ph" class="email-us">serdac_luzon@clsu.edu.ph</a>.</p>
                        </small>
                    </div>
                </div>
            </div>
            {{-- <hr> --}}
            {{-- <div class="footer-social-links row">
                <div class="col-md-4 text-center p-2">
                    &copy; <small class="footer-org"> 2023 SERDAC-Luzon</small>
                </div>
                <div class="col-md-4 text-center p-1 ">
                    <img src="{{ url('import/assets/images/logo/clsu-serdac-logo.jpeg') }}" width="60" height="60" class="d-inline-block" alt="CLSU-SERDAC LOGO">
                </div>
                <div class="col-md-4 text-center p-2">
                   <span class="facebook">
                    <a href="https://www.facebook.com/SERDACLuzon" target="_blank">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    Facebook 
                    </a>
                   </span>
                   &emsp;|&emsp;
                   <span class="youtube">
                    <a href="https://www.youtube.com/channel/UCkduqyKlcRHWZKSxZwQSNpA" target="_blank">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    Youtube
                   </a>
                   </span>
                </div>
            </div> --}}
    </body>
</html>