@extends('layouts.app')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header">Reset Password | Staff</div>
                  <div class="card-body">
  
                      <form action="{{ route('staff.password.update') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="form-group row mb-3">
                              <label for="staff_email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="staff_email" class="form-control" name="staff_email" value="{{old('staff_email')}}" required autofocus>
                                  @if ($errors->has('staff_email'))
                                      <span class="text-danger">{{ $errors->first('staff_email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mb-3">
                              <label for="staff_password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="staff_password" class="form-control" name="staff_password" required autofocus>
                                  @if ($errors->has('staff_password'))
                                      <span class="text-danger">{{ $errors->first('staff_password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mb-3">
                              <label for="staff_password_confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="staff_password-confirm" class="form-control" name="staff_password_confirmation" required autofocus>
                                  @if ($errors->has('staff_password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('pstaff_assword_confirmation') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Reset Password
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection