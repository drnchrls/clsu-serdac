<html>
    <head>
        <title>Login</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="full-height">
            <div class="row m-0">
                <div class="auth-logo-bg col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="col-lg-10">
                        <div class="auth-login-logo d-flex align-items-center justify-content-center">
                            <img src="{{ url('import\assets\images\logo\clsu-serdac-logo.jpeg') }}" class="w-75" alt="">
                        </div>
                    </div>
                </div>
                <div class="auth-form-bg p-2 col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="col-lg-9 col-12">
                        <div class="auth-login-form px-2 pt-5 pb-1 text-center shadow-lg">
                            <div class="auth-form-logo">
                                <img src="{{ url('import\assets\images\logo\clsu-serdac-logo.jpeg') }}" class="w-25" alt="">
                            </div>
                            <small class="welcome-to">Welcome to</small>
                            <h4>SERDAC-Luzon</h4>
                            <small class="text-muted">Login to your account to access resources and more.</small>
                            <center><hr style="margin: 5px; width:70%;"></center>
                            <div class="form-group d-flex justify-content-center px-lg-5 px-4">
                                <form method="POST" action="{{ route('login.check') }}" autocomplete="off">
                                    @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{Session::get('fail')}}
                                    </div>
                                     @endif
                                    @csrf
                                    <div class="form-row">
                                        <div class="inputbox col-lg-12 my-3 d-flex justify-content-center">
                                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                            <span>Email</span>
                                            <i></i>
                                        </div>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        <div class="inputbox col-lg-12 my-3 d-flex justify-content-center">
                                            <input  id="password" type="password" name="password" required>
                                            <span>Password</span>
                                            <i></i>
                                        </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-row">
                                        <div id="text" class="text-danger mb-2" style="display: none">Capslock is on.</div>
                                        <div class="col-lg-12 text-left">
                                            <input type='checkbox' id='toggle' value='0' ><small><span class="pl-3" id='toggleText'>Show password</span></small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-row mt-4 mb-1">
                                        <button type="submit" class="auth-login-btn w-100">
                                            Login
                                        </button>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <div class="col-lg-12 forgot-link text-center mt-2">
                                        <small><a href="{{ route('password.request') }}">Forgot password?</a></small>
                                    </div>
                                    @endif
                                    @if (Route::has('register'))
                                    <div class="col-lg-12 register-link mt-4">
                                        <small>Dont have an account? <a href="{{ route('register') }}">Sign Up Now</a></small>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center m-2">
                            <div class="homepage-link">
                               <small> Return to <a href="{{ url('/') }}"> Homepage </a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
 $(document).ready(function () {
        var input = document.getElementById("password");

// Get the warning text
        var text = document.getElementById("text");

        // When the user presses any key on the keyboard, run the function
        input.addEventListener("keyup", function(event) {

        // If "caps lock" is pressed, display the warning text
        if (event.getModifierState("CapsLock")) {
            text.style.display = "block";
        } else {
            text.style.display = "none"
        }
        });

    
        $("#toggle").change(function(){
        if($(this).is(':checked')){
            $("#password").attr("type","text");
            $("#toggleText").text("Hide password");
            }
        else{
            $("#password").attr("type","password");
            $("#toggleText").text("Show password");
            }
        });


});
</script>
    </body>
</html>