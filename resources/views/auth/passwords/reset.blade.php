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
                            <form action="{{route('password.update')}}" method="POST">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @csrf
                                {{-- //Email Address --}}
                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                        <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" value="{{ session('email') ?? old('email') }}" required autofocus placeholder="Email" disabled>
                                        <!-- @error('email')
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
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mr-3" name="password" required autofocus placeholder="Password">
                                            <div class="input-group-append">
                                                <span id="toggle_reset_pass" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                            </div>
                                        </div>
                                        @error('password')
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
                                        <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror mr-3" name="password-confirm" required autofocus placeholder="Confirm Password">
                                            <div class="input-group-append">
                                                <span id="toggle_reset_confirm" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                                            </div>
                                        </div>
                                        @error('password-confirm')
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
                        {{-- <div class="row mt-4 mb-3">
                            <div class="col-lg-12 text-center">
                                <small>
                                    <a href="{{ route('login') }}">
                                        <i class="fa fa-chevron-circle-left"></i> &nbsp; Back to Login
                                    </a>
                                </small>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
<script>
    $(function () {
    $("#toggle_reset_pass").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password").attr("type", type);
    });
    $("#toggle_reset_confirm").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password-confirm").attr("type", type);
    });
    });
</script>
    </body>
</html>