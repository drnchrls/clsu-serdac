<html>
    <head>
        <title>OTP Verification</title>
        @include('layouts.stylesheet')
    </head>
    <body onload="setTimer()">
        <div class="vh-100 row m-0 gradient-bg">
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <div class="row d-flex justify-content-center">
                    <div class="otp-form col-lg-5 bg-white shadow-lg rounded m-4">
                        <div class="otp-header p-4 text-center">
                            <img src="{{ url('import/assets/images/contents/auth-png/otp.png') }}" class="" width="150" height="150" alt="logo">
                            <h4 class="">OTP Verification</h4>
                            <small class="text-muted">Enter the One-Time Password (OTP) that is sent to your email account to complete and verify the registration.</small>
                        </div>
                        <div class="form-group">
                            <form action="{{route('otp.verify')}}" method="POST">

                                @if (session('fail'))
                                <div class="alert alert-danger">
                                    {{session('fail')}}
                                </div>
                                @endif

                                @if (session('sent'))
                                    <div class="alert alert-success">
                                        {{session('sent')}}
                                    </div>
                                @endif

                                @csrf

                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                        <input id="otp" type="text" class="form-control" name="otp" required autofocus>
                                    </div>
                                </div>
                                <div class="form-row mx-4 py-2">
                                    <div class="col-lg-12">
                                       <button type="submit" class="btn btn-success w-100"> Verify </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <form action="" method="">
                        @csrf
                            <div class="row mt-4 mb-3">
                                <div id="resend" class="col-lg-12 text-center" hidden>
                                    <small>
                                        <a href="{{ url('/resend-otp') }}" class="text-success" type="submit" id="btnResend">
                                            <i class="fa fa-refresh"></i> &nbsp; Resend OTP
                                        </a>
                                    </small>
                                </div>
                                <div id="time" class="col-lg-12 text-center text-danger">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

{{-- Bootstrap --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

var interval;

function setTimer(){
  var time = 15;
  startTimer(time);
}


function startTimer(duration) {

var timer = duration, minutes, seconds;

interval = setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    $('#time').html('Resend OTP available in ' + minutes + ":" + seconds);

      if (--timer < 0) {


        stopTimer();
        $('#time').hide();
        // document.querySelector('#btnResend').disabled = false;
        document.querySelector('#resend').hidden = false;
      }

  }, 1000);
}

function stopTimer(){
  clearInterval(interval);
}

$('#btnResend').click(function (e) { 
  e.preventDefault();
  document.querySelector('#resend').hidden = true;

  Swal.fire({
            title: 'Please wait...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            showConfirmButton: false,
            onOpen: ()=>{
                Swal.showLoading();
            },
        });
  $.ajax({
    type: "POST",
    url: "{{route('otp.resend')}}",
    // data: "data",
    // dataType: "json",
    success: function (response) {
      // document.querySelector('#btnResend').disabled = true;
      Swal.close();
      setTimer();
      $('#time').show();
      console.log('Success: ', response);
      swal("New OTP has been sent! Please check your email", {
                icon: "success",
            });
    },
    error: function(response){
      console.log('Error: ', response);
    }
  });

});


</script>

</html>