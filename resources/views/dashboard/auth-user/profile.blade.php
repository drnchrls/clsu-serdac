@extends('dashboard.auth-user.dashboard')
@section('title', 'Profile')
@section('account-content')
    <div class="col-lg-9">
        <div class="row dashboard-pane p-2 p-lg-4 bg-white rounded">
            <div class="col-lg-12">
                @if(session('success'))
                <div class="alert alert-success aler-dismissable fade show">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                @endif
            </div>
            <div class="col-6 header text-left ">
                <h4>Profile</h4>
                <small class="text-muted">Edit Profile</small>
            </div> 
            <div class="col-6 d-flex justify-content-end align-items-center">
                <span class="material-symbols-outlined sz-60">settings_account_box</span>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <hr style="margin: 10px; width:90%;">
            </div>
            <div class="col-lg-12 profile-content  px-lg-4 px-0 py-2 bg-white py-2 rounded">
                <form id="updateProfile" action="{{ url('profile/update')."/id=".Auth::guard('web')->user()->id }}" enctype='multipart/form-data' method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-lg-4 p-2">
                                <label for="fname" class="text-muted">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" value="{{old('fname', $current_user->fname)}}" required>
                            </div>
                            <div class="col-lg-4 p-2">
                                <label for="lname" class="text-muted">Last Name</label>
                                <input type="text" class="form-control" name="lname" value="{{old('fname', $current_user->lname)}}" required>
                            </div>
                            <div class="col-lg-2 col-6 p-2">
                                <label for="gender" class="text-muted">Gender</label>
                                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="{{old('gender', $current_user->gender)}}" selected disabled>{{old('gender', $current_user->gender)}}</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                    <option value="Prefer to self-describe">Prefer to self-describe</option>
                                </select>
                            </div> 
                            <div class="col-lg-2 col-6 p-2">
                                <label for="age" class="text-muted">Age</label>
                                <input type="text" inputmode="numeric" class="form-control" name="age" value="{{old('age', $current_user->age)}}" required>
                            </div>
                            <div class="col-lg-6 p-2">
                                <label for="" class="text-muted">Email</label>
                                <input id="" type="email" inputmode="email" class="form-control" value="{{$current_user->email}}" disabled>
                            </div>
                            <div class="col-lg-6 p-2">
                                <label for="contact" class="text-muted">Contact</label>
                                <input type="text" inputmode="tel" class="form-control" name="contact" value="{{old('contact', $current_user->contact)}}" required>
                            </div>
                            <div class="col-lg-12 p-2">
                                <label for="address" class="text-muted">Address</label>
                                <input type="text" class="form-control" name="address" value="{{old('address', $current_user->address)}}" required>
                            </div>
                            <div class="col-lg-6 p-2">
                                <label for="occupation" class="text-muted">Occupation</label>
                                <!-- <input type="text" class="form-control" name="occupation" value="{{old('occupation', $current_user->occupation)}}"> -->
                                <select class="form-control @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation') }}" required>
                                    <option value="{{old('occupation', $current_user->occupation)}}" selected disabled>{{old('occupation', $current_user->occupation)}}</option>
                                    <option value="Student">Student</option>
                                    <option value="Employed (Full-time)">Employed (Full-time)</option>
                                    <option value="Employed (Part-time)">Employed (Part-time)</option>
                                    <option value="Self-employed">Self-employed</option>
                                    <option value="Homemake">Homemake</option>
                                    <option value="Retired">Retired</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-lg-6 p-2">
                                <label for="educational_level" class="text-muted">Educational Level</label>
                                <!-- <input type="text" class="form-control" name="educational_level" value="{{old('educational_level', $current_user->educational_level)}}"> -->
                                <select class="form-control @error('educational_level') is-invalid @enderror" name="educational_level" id="educational_level" value="{{ old('educational_level') }}" required>
                                    <option value="{{old('educational_level', $current_user->educational_level)}}" selected disabled>{{old('educational_level', $current_user->educational_level)}}</option>
                                    <option value="No schooling">No schooling</option>
                                    <option value="Elementary">Elementary</option>
                                    <option value="High School">High School</option>
                                    <option value="Vocational">Vocational</option>
                                    <option value="College">College</option>
                                    <option value="Postgraduate">Postgraduate</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" row d-flex px-3 pt-2 pb-5">
                        <div class="w-100 pl-1">
                          <input type="submit" name="submit" value="Save Changes" class="btn btn-block btn-success">
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>

@endsection