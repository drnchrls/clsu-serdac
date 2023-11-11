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
                            <div class="d-flex justify-content-center">
                                <div class="col-lg-5 col-8 py-5 px-4">
                                    <div class="progress-bars">
                                        <div class="circle-icon">
                                            <div class="bg-white p-1 rounded-circle"></div>
                                            <small class="steps-span mt-5 position-absolute text-secondary">Step 1</small>
                                        </div>
                                        <div class="last-step-progress"></div>
                                        <div class="last-circle-icon">
                                            <div class="bg-white p-1 rounded-circle"></div>
                                            <small class="steps-span mt-5 position-absolute text-secondary">Step 2</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Account Info</h4>
                                <small class="text-muted">We'll never share your information with anyone else.</small>
                                <form class="m-1" method="POST" action="{{ route('register.second.store') }}" autocomplete="off">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                            <label for="email">Email<span class="text-danger">*</span></label>
                                            <input id="email" type="email" inputmode="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                            
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-lg m-2 input-pass-register">
                                            <label for="password">Password<span class="text-danger">*</span></label>
                                            <div class="input-group border rounded bg-light">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mr-5" name="password" value="{{ old('password') }}" placeholder="Password" required autofocus>
                                                <div class="input-group-append">
                                                    <span id="toggle_pass_reg" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg m-2 input-pass-register">
                                            <label for="password-confirm">Confirm Password<span class="text-danger">*</span></label>
                                            <div class="input-group border rounded bg-light">
                                                <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror mr-5" name="password-confirm" value="{{ old('password-confirm') }}" placeholder="Re-type Your Password" required autofocus>
                                                <div class="input-group-append">
                                                    <span id="toggle_confirm_reg" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                                </div>
                                            </div>
                                            @error('password-confirm')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="form-row mt-2">
                                        <div class="col m-2">
                                            <a href="{{url('register')}}" class="">
                                            <button type="button" class="auth-prev-btn w-100"><span><i class="fa fa-angle-double-left p-2" aria-hidden="true"></i></span> Back</button>
                                            </a>
                                        </div>
                                        <div class="col m-2">
                                            <button type="submit" class="auth-register-btn w-100" >Next <span><i class="fa fa-angle-double-right p-2" aria-hidden="true"></i></span></button>
                                        </div>
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
        $("#password-confirm").attr("type", type);
    });
    });
</script>
    </body>
</html>