<html>
    <head>
        <title>Register</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="full-height">
            <div class="row m-0">
                <div class="auth-register-form col-lg-6 d-flex align-items-center">
                    <div class="col-lg-12"> 
                        <div class="register-form">
                            <div class="col-lg-12 p-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ url('import\assets\images\contents\auth-png\register.png') }}" class="w-25" alt="">
                                </div>
                            </div>
                            <div class="form-header text-center">
                                <h3>Get Started.</h3>
                                <div class="sub-heading px-4">
                                    <small class="text-muted">Register now for free to access resources and enjoy other services offered by SERDAC-Luzon.</small>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <h4>Personal Info</h4>
                                <small class="text-muted">We'll never share your information with anyone else.</small>
                                <form class="m-1" method="POST" action="{{ route('register.store') }}" autocomplete="off">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                            <label for="fname">First name</label>
                                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" placeholder="First name" required autofocus>
                                            @error('fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg m-2">
                                            <label for="lname">Last name</label>
                                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" placeholder="Last name" required autofocus>
                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg m-2 input-pass-register">
                                            <label for="password">Password</label>
                                            <div class="input-group border rounded bg-light">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mr-5" name="password" value="{{ old('password') }}" placeholder="Password" required autofocus>
                                                <div class="input-group-append">
                                                    <span id="toggle_pass_reg" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                                </div>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg m-2 input-pass-register">
                                            <label for="password_confirm">Confirm Password</label>
                                            <div class="input-group border rounded bg-light">
                                                <input id="password_confirm" type="password" class="form-control @error('password_confirm') is-invalid @enderror mr-5" name="password_confirmation" value="{{ old('password_confirm') }}" placeholder="Confirm password" required autofocus>
                                                <div class="input-group-append">
                                                    <span id="toggle_confirm_reg" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                                </div>
                                                @error('password_confirm')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-2">
                                        <div class="col-lg m-2">
                                            <button type="submit" class="auth-register-btn w-100" >Register</button>
                                        </div>
                                        @if (Route::has('login'))
                                            <div class="login-link col-lg-12 text-center mt-3">
                                                <small>Already have an account?<a href="{{ route('login') }}"> Login here</a></small>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="auth-register-logo col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ url('import\assets\images\contents\auth-png\register.png') }}" class="w-75" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    $(function () {
    $("#toggle_pass_reg").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password").attr("type", type);
    });
    $("#toggle_confirm_reg").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password_confirm").attr("type", type);
    });
    });
</script>
    </body> 
</html>