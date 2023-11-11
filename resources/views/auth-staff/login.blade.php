<!doctype html>
<html lang="en">
  <head>
    <title>Login | Staff</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
  <body class="bg-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card bg-light" style="margin-top: 20%">
                    <div class="card-header">{{ __('Staff Login') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('staff.login.check') }}" autocomplete="off">

                            @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{Session::get('fail')}}
                                </div>
                            @endif

                            @csrf
    
                            <div class="row mb-3">
                                <label for="staff_email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="staff_email" type="email" class="form-control @error('staff_email') is-invalid @enderror" name="staff_email" value="{{ old('staff_email') }}" required autofocus>
    
                                    @error('staff_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="staff_password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="staff_password" type="password" class="form-control @error('staff_password') is-invalid @enderror" name="staff_password" required>
    
                                    @error('staff_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
    
                            {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
    
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('staff.password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
               var input = document.getElementById("staff_password");
       
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


