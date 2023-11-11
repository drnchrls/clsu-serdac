@extends('dashboard.auth-user.dashboard')
@section('title', 'Change Password')
@section('account-content')
    <div class="col-lg-9">
        <div class="row dashboard-pane p-2 p-lg-4 bg-white rounded">
            <div class="col-6 header text-left">
                <h4>Password</h4>
                <small class="text-muted">Change Password</small>
            </div> 
            <div class="col-6 d-flex justify-content-end align-items-center">
                <span class="material-symbols-outlined sz-60">password</span>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <hr style="margin: 10px; width:90%;">
            </div>
            <div class="col-lg-12 profile-content px-lg-4 px-0 py-2 bg-white py-2 rounded">
                <form action="{{url('password/change').'/id='.Auth::user()->id}}" method="POST">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-12 p-2">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 p-2">
                                <label for="new_password" class="form-label">New Password</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 p-2">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation"
                                    placeholder="Confirm New Password">
                            </div> 
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6 text-left">
                                <input type='checkbox' id='toggle' value='0' onchange='togglePassword(this);'>&nbsp;&nbsp; <small><span id='toggleText'>Show password</span></small>
                            </div>
                        </div>
                    </div>
                    <div class=" row d-flex px-3 pt-2 pb-5">
                        <div class="w-50 pr-1">
                          <input class="btn btn-block btn-danger" type="reset" value="Reset">
                        </div>
                        <div class="w-50 pl-1">
                          <input type="submit" name="submit" value="Update" class="btn btn-block btn-success">
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(function(){
    $("#toggle").change(function(){
    
    // Check the checkbox state
    if($(this).is(':checked')){
    // Changing type attribute
    $("#old_password").attr("type","text");
    $("#new_password").attr("type","text");
    $("#new_password_confirmation").attr("type","text");
    // Change the Text
    $("#toggleText").text("Hide password");
    }else{
    // Changing type attribute
    $("#old_password").attr("type","password");
    $("#new_password").attr("type","password");
    $("#new_password_confirmation").attr("type","password");
    // Change the Text
    $("#toggleText").text("Show password");
    }
    
    });
    });
    </script>
@endsection