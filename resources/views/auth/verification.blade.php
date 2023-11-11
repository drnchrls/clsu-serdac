<html>
    <head>
        <title>Email Verification</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="vh-100 row m-0 gradient-bg">
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <div class="row d-flex justify-content-center">
                    <div class="auth-forgot-form col-lg-5 bg-white shadow-lg rounded m-4">
                        <div class="forgot-password-header p-4 text-center">
                            <img src="{{ url('import/assets/images/contents/auth-png/email.png') }}" class="" width="150" height="150" alt="logo">
                            <h4>Email Verification</h4>
                            <small class="text-muted">For security reasons, we've sent an <b>6-digit OTP</b> to your email address to protect our users from spams and possible abuse to our resources.
                                Please check your email enter the code to complete your registration.
                            </small>
                        </div>
                        <div class="form-group">
                            <form action="">
                                <div class="form-row mx-4 d-flex justify-content-center">
                                    <div class="col-md-4 py-2">
                                        <input type="email" placeholder="XXXXXX" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 py-2">
                                       <button type="submit" class="btn btn-success w-100"> Verify </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>