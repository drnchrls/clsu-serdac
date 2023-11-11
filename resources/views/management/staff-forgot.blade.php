<html>
    <head>
        <title>Forgot Password</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="vh-100 row m-0 gradient-bg">
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <div class="row d-flex justify-content-center">
                    <div class="auth-forgot-form col-lg-5 bg-white shadow-lg rounded m-4">
                        <div class="forgot-password-header p-4 text-center">
                            <img src="{{ url('import/assets/images/contents/auth-png/forgot.png') }}" class="" width="150" height="150" alt="logo">
                            <h4>Forgot Password</h4>
                            <small class="text-muted">For security reasons, enter the email address that you used when you joined and we'll send you instructions to reset your password</small>
                        </div>
                        <div class="form-group">
                            <form action="{{ route('staff.password.email') }}" method="POST">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif

                                @csrf

                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                        <input type="text" id="staff_email" class="form-control" name="staff_email" placeholder="Email" required autofocus>
                                        @if ($errors->has('staff_email'))
                                            <span class="text-danger">{{ $errors->first('staff_email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                       <button type="submit" class="btn btn-success w-100"> Submit </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row mt-4 mb-3">
                            <div class="col-lg-12 text-center">
                                <small>
                                    <a href="{{ url('/login') }}">
                                        <i class="fa fa-chevron-circle-left"></i> &nbsp; Back to Login
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>