@extends('management.main_index')
@section('title', 'My Account')
@section('content')
<div class="row bg-light m-0 py-4">
    <div class="col-lg-5 px-5 py-3">
        <div class="private-edit-profile pl-lg-4">
            <h3>Profile</h3>
            <small class="text-muted">Update your account's personal information.</small>
        </div>
    </div>
    <div class="col-lg-7 p-3">
        <div class="private-edit-form bg-white shadow-sm rounded px-4 pt-4 pb-1">
        @if(Auth::guard('staff')->user()->staff_role=='Admin')
            <form action="{{url('admin/profile/update').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST" autocomplete="off" >
                @if (session('updated'))
                <div class="alert alert-success" role="alert">
                    {{ session('updated') }}
                </div>
                @endif
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label for="staff_fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="staff_fname" id="staff_fname" class="form-control" value="{{old('staff_fname',$current_user->staff_fname)}}">
                            @error('staff_fname')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="col-lg-6 p-2">
                            <label for="staff_lname">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="staff_lname" id="staff_lname" class="form-control" value="{{old('staff_lname',$current_user->staff_lname)}}">
                            @error('staff_lname')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 p-2">
                            <label for="staff_email">Email</label>
                            <input type="text" name="staff_email" id="staff_email" class="form-control" value='{{$current_user->staff_email}}' disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label for="staff_contact">Contact<span class="text-danger">*</span></label>
                            <input type="text" name="staff_contact" id="staff_contact" class="form-control" value="{{old('staff_contact',$current_user->staff_contact)}}">
                            @error('staff_contact')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="col-lg-6 p-2">
                            <label for="staff_role">Role</label>
                            <input type="text" name="staff_role" id="staff_role" class="form-control" value='{{$current_user->staff_role}}' disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-netflix w-25">Save</button>
                    </div>
                </div>
            </form>
            @endif
            @if(Auth::guard('staff')->user()->staff_role=='Library Staff')
            <form action="{{url('libr/profile/update').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST" autocomplete="off">
                @if (session('updated'))
                <div class="alert alert-success" role="alert">
                    {{ session('updated') }}
                </div>
                @endif
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label for="staff_fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="staff_fname" id="staff_fname" class="form-control" value="{{old('staff_fname',$current_user->staff_fname)}}">
                            @error('staff_fname')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="col-lg-6 p-2">
                            <label for="staff_lname">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="staff_lname" id="staff_lname" class="form-control" value="{{old('staff_lname',$current_user->staff_lname)}}">
                            @error('staff_lname')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 p-2">
                            <label for="staff_email">Email</label>
                            <input type="text" name="staff_email" id="staff_email" class="form-control" value='{{$current_user->staff_email}}' disabled>
                        
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label for="staff_contact">Contact<span class="text-danger">*</span></label>
                            <input type="text" name="staff_contact" id="staff_contact" class="form-control" value="{{old('staff_contact',$current_user->staff_contact)}}">
                            @error('staff_contact')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="col-lg-6 p-2">
                            <label for="staff_role">Role</label>
                            <input type="text" name="staff_role" id="staff_role" class="form-control" value='{{$current_user->staff_role}}' disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-netflix w-25">Save</button>
                    </div>
                </div>
            </form>
            @endif
            @if(Auth::guard('staff')->user()->staff_role=='Service Staff')
            <form action="{{url('serv/profile/update').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST" autocomplete="off">
                @if (session('updated'))
                <div class="alert alert-success" role="alert">
                    {{ session('updated') }}
                </div>
                @endif
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label for="staff_fname">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="staff_fname" id="staff_fname" class="form-control" value="{{old('staff_fname',$current_user->staff_fname)}}">
                            @error('staff_fname')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="col-lg-6 p-2">
                            <label for="staff_lname">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="staff_lname" id="staff_lname" class="form-control" value="{{old('staff_lname',$current_user->staff_lname)}}">
                            @error('staff_lname')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 p-2">
                            <label for="staff_email">Email</label>
                            <input type="text" name="staff_email" id="staff_email" class="form-control" value='{{$current_user->staff_email}}' disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 p-2">
                            <label for="staff_contact">Contact<span class="text-danger">*</span></label>
                            <input type="text" name="staff_contact" id="staff_contact" class="form-control" value="{{old('staff_contact',$current_user->staff_contact)}}">
                            @error('staff_contact')
                            <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="col-lg-6 p-2">
                            <label for="staff_role">Role</label>
                            <input type="text" name="staff_role" id="staff_role" class="form-control" value='{{$current_user->staff_role}}' disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-netflix w-25">Save</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

<div class="row bg-white m-0  py-4">
    <div class="col-lg-5 px-5 py-3">
        <div class="private-edit-profile pl-lg-4">
            <h3>Change Password</h3>
            <small class="text-muted">Change your password at any time for security puposes.</small>
        </div>
    </div>
    <div class="col-lg-7 p-3">
        <div class="private-edit-form bg-light shadow-sm rounded px-4 pt-4 pb-1">
            @if(Auth::guard('staff')->user()->staff_role=='Admin')
            <form action="{{url('admin/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-12">
                            <small class="text-muted"><strong>Note:</strong> Password must contain at least 8 characters.</small>
                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_old_pass">Old Password<span class="text-danger">*</span></label>
                            <input name="old_staff_password" type="password" class="form-control @error('old_staff_password') is-invalid @enderror" id="old_staff_password"
                            placeholder="Old Password">
                            @error('old_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_new_pass">New Password<span class="text-danger">*</span></label>
                            <input name="new_staff_password" type="password" class="form-control" id="new_staff_password"
                            placeholder="New Password">

                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_confirm_pass">Confirm Password<span class="text-danger">*</span></label>
                            <input name="new_staff_password_confirmation" type="password" class="form-control" id="new_staff_password_confirmation"
                            placeholder="Confirm New Password">
                            @error('new_staff_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 text-left">
                            <input type='checkbox' id='toggle' value='0' onchange='togglePassword(this);'>&nbsp;&nbsp; <small><span id='toggleText'>Show password</span></small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-netflix w-25">Change</button>
                    </div>
                </div>
            </form>
            @endif
            @if(Auth::guard('staff')->user()->staff_role=='Service Staff')
            <form action="{{url('serv/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-12">
                            <small class="text-muted"><strong>Note:</strong> Password must contain at least 8 characters.</small>
                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_old_pass">Old Password<span class="text-danger">*</span></label>
                            <input name="old_staff_password" type="password" class="form-control @error('old_staff_password') is-invalid @enderror" id="old_staff_password"
                            placeholder="Old Password">
                            @error('old_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_new_pass">New Password<span class="text-danger">*</span></label>
                            <input name="new_staff_password" type="password" class="form-control" id="new_staff_password"
                            placeholder="New Password">

                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_confirm_pass">Confirm Password<span class="text-danger">*</span></label>
                            <input name="new_staff_password_confirmation" type="password" class="form-control" id="new_staff_password_confirmation"
                            placeholder="Confirm New Password">
                            @error('new_staff_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 text-left">
                            <input type='checkbox' id='toggle' value='0' onchange='togglePassword(this);'>&nbsp;&nbsp; <small><span id='toggleText'>Show password</span></small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-netflix w-25">Change</button>
                    </div>
                </div>
            </form>
            @endif
            @if(Auth::guard('staff')->user()->staff_role=='Library Staff')
            <form action="{{url('libr/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-lg-12">
                            <small class="text-muted"><strong>Note:</strong> Password must contain at least 8 characters.</small>
                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_old_pass">Old Password<span class="text-danger">*</span></label>
                            <input name="old_staff_password" type="password" class="form-control @error('old_staff_password') is-invalid @enderror" id="old_staff_password"
                            placeholder="Old Password">
                            @error('old_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_new_pass">New Password<span class="text-danger">*</span></label>
                            <input name="new_staff_password" type="password" class="form-control" id="new_staff_password"
                            placeholder="New Password">

                        </div>
                        <div class="col-lg-12 p-2">
                            <label for="staff_confirm_pass">Confirm Password<span class="text-danger">*</span></label>
                            <input name="new_staff_password_confirmation" type="password" class="form-control" id="new_staff_password_confirmation"
                            placeholder="Confirm New Password">
                            @error('new_staff_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6 text-left">
                            <input type='checkbox' id='toggle' value='0' onchange='togglePassword(this);'>&nbsp;&nbsp; <small><span id='toggleText'>Show password</span></small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-success font-netflix w-25">Change</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

<script>
    $(function(){
    $("#toggle").change(function(){
    
    // Check the checkbox state
    if($(this).is(':checked')){
    // Changing type attribute
    $("#old_staff_password").attr("type","text");
    $("#new_staff_password").attr("type","text");
    $("#new_staff_password_confirmation").attr("type","text");
    // Change the Text
    $("#toggleText").text("Hide password");
    }else{
    // Changing type attribute
    $("#old_staff_password").attr("type","password");
    $("#new_staff_password").attr("type","password");
    $("#new_staff_password_confirmation").attr("type","password");
    // Change the Text
    $("#toggleText").text("Show password");
    }
    
    });
    });
</script>
@endsection



