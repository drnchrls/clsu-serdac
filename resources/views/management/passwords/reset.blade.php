<html>
    <head>
        <title>Reset Password</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="vh-100 row m-0 gradient-bg">
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <div class="row d-flex justify-content-center">
                    <div class="auth-forgot-form col-lg-12 bg-white shadow-lg rounded m-4">
                        <div class="forgot-password-header px-4 py-2 text-center">
                            <img src="{{ url('import/assets/images/contents/auth-png/reset.png') }}" class="" width="150" height="150" alt="logo">
                            <h4>Reset Password</h4>
                            {{-- <small class="text-muted">For security reasons, enter the email address that you used when you joined and we'll send you instructions to reset your password</small> --}}
                        </div>
                        <div class="form-group">
                            <form action="{{route('staff.password.update')}}" method="POST">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @csrf
                                {{-- //Email Address --}}
                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                        <input id="staff_email" type="email" class="form-control"  @error('staff_email') is-invalid @enderror name="staff_email" value="{{ session('email') ?? old('staff_email') }}" required autofocus placeholder="Email" disabled>
                                        <!-- @error('staff_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror -->
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                        <div class="input-group border rounded bg-light">
                                            <input id="staff_password" type="password" class="form-control @error('staff_password') is-invalid @enderror mr-3" name="staff_password" required autofocus placeholder="Password">
                                            <div class="input-group-append">
                                                <span id="toggle_staff_pass" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                            </div>
                                        </div>
                                            @error('staff_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>

                                {{-- Confirm Password --}}
                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                        <div class="input-group border rounded bg-light">
                                        <input id="staff_password_confirm" type="password" class="form-control @error('staff_password_confirm') is-invalid @enderror mr-3" name="staff_password_confirm" required autofocus placeholder="Confirm Password">
                                            <div class="input-group-append">
                                                <span id="toggle_staff_confirm" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                            </div>
                                        </div>
                                        
                                        @error('staff_password_confirm')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mx-4 py-4">
                                    <div class="col-lg-12">
                                       <button type="submit" class="btn btn-success w-100"> Reset Password </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
    $(function () {
    $("#toggle_staff_pass").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#staff_password").attr("type", type);
    });
    $("#toggle_staff_confirm").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#staff_password_confirm").attr("type", type);
    });
    });
</script>
    </body>
</html>