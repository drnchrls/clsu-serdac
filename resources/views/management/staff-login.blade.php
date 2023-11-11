<html>
    <head>
        <title>CLSU SERDAC | Private</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="vh-100 row m-0 ">
            <div class="col-lg-12 center-div d-flex align-items-center justify-content-center">
                <div class="row bg-white m-1 m-lg-5 shadow-lg rounded">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center bg-success rounded p-5">
                        <div class="private-logo-container d-flex align-items-center justify-content-center">
                            <img src="{{ url('import\assets\images\logo\management\clsu-logo.png') }}" class="w-75"  alt="">
                        </div>
                    </div>
                    <div class="private-login-border col-lg-6 px-5 pt-5 ">
                        <div class="private-login-header mb-4 mt-3 pt-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <hr>
                                    <h5>Login as Privileged User</h5>
                                    <small class="text-muted">Please use your valid credentials.</small>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                    <img src="{{ url('import\assets\images\logo\management\clsu-rc-logo.png') }}"  alt="">
                                </div>
                            </div>
                        </div>
                        <div class="private-form-container form-group">
                            <form method="POST" action="{{ route('staff.login.check') }}" autocomplete="off">
                                @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{Session::get('fail')}}
                                    </div>
                                @endif

                                @csrf

                                <div class="form-row">
                                    <div class="col-lg-12 p-2">
                                        <input id="staff_email" type="email" class="form-control" @error('staff_email') is-invalid @enderror name="staff_email" placeholder="Email" value="{{ old('staff_email') }}" required autofocus>
                                        @error('staff_email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 p-2 input-pass-staff">
                                        <div class="input-group border rounded bg-light">
                                            <input id="staff_password" type="password" class="form-control mr-5" @error('staff_password') is-invalid @enderror name="staff_password" placeholder="Password" value="{{ old('staff_password') }}" required autofocus>
                                            <div class="input-group-append">
                                                <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                            </div>
                                        </div>
                                        @error('staff_password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 p-2 mt-2">
                                        <button type="submit" class="form-control btn btn-success">Login</button>
                                    </div>
                                    <div class="col-lg-12 mt-2 text-center">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('staff.password.request') }}">Forgot your password?</a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-lg-12 mt-2 text-right">
                                    <a href="{{ url('/') }}" class="serdac-link">
                                        <small> SERDAC <i class="fa fa-home"></i></small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    $(function () {
    $("#toggle_pwd").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#staff_password").attr("type", type);
    });
    });
</script>
    </body>
</html>