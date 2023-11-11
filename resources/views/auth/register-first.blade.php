<html>
    <head>
        <title>Register</title>
        @include('layouts.stylesheet')
    </head>
    <body>
        <div class="full-height">
            <div class="row m-0">
                <div class="auth-register-form col-lg-6 d-flex align-items-center">
                    <div class="col-lg-12"> 
                        <div class="register-form">
                            <div class="col-lg-12 p-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ url('import\assets\images\contents\auth-png\register.png') }}" class="w-25" alt="">
                                </div>
                            </div>
                            <div class="form-header text-center">
                                <h3>Get Started.</h3>
                                <div class="sub-heading px-4">
                                    <small class="text-muted">Register now for free to access resources and enjoy other services offered by SERDAC-Luzon.</small>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center">
                                <div class="col-lg-5 col-8 py-5 px-4 text-secondary">
                                    <div class="progress-bars">
                                        <div class="circle-icon">
                                            <div class="bg-white p-1 rounded-circle"></div>
                                            <small class="steps-span mt-5 position-absolute text-secondary">Step 1</small>
                                        </div>
                                        <div class="first-step-progress"></div>
                                        <div class="circle-icon">
                                            <div class="bg-secondary p-1 rounded-circle"></div>
                                            <small class="steps-span mt-5 position-absolute">Step 2</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Personal Info</h4>
                                <small class="text-muted">We'll never share your information with anyone else.</small>
                                <form class="m-1" method="POST" action="{{ route('register.first.store') }}" autocomplete="off">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                            <label for="fname">First name<span class="text-danger">*</span></label>
                                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname', session('fname')) }}" placeholder="First name" required autofocus>
                                            @error('fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg m-2">
                                            <label for="lname">Last name<span class="text-danger">*</span></label>
                                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname', session('lname')) }}" placeholder="Last name" required autofocus>
                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                            <label for="gender">Gender<span class="text-danger">*</span></label>
                                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" value="{{ old('gender', session('gender')) }}" required>
                                                <option value="" disabled selected>- Gender -</option>
                                                <option value="Male" @if(session('gender') == 'Male') selected @endif>Male</option>
                                                <option value="Female" @if(session('gender') == 'Female') selected @endif>Female</option>
                                                <option value="Prefer not to say" @if(session('gender') == 'Prefer not to say') selected @endif>Prefer not to say</option>
                                                <option value="Prefer to self-describe" @if(session('gender') == 'Prefer to self-describe') selected @endif>Prefer to self-describe</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg m-2">
                                            <label for="age">Age<span class="text-danger">*</span></label>
                                            <input id="age" type="text" inputmode="numeric" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age', session('age')) }}" placeholder="Age" required autofocus>
                                            @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg m-2">
                                            <label for="contact">Contact<span class="text-danger">*</span></label>
                                            <input id="contact" type="text" inputmode="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact', session('contact')) }}" placeholder="Contact" required autofocus>
                                            @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                            <label for="occupation">Occupation<span class="text-danger">*</span></label>
                                            <select class="form-control @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation', session('occupation')) }}" required>
                                                <option value="" disabled selected>- Occupation -</option>
                                                <option value="Student" @if(session('occupation') == 'Student') selected @endif>Student</option>
                                                <option value="Employed (Full-time)" @if(session('occupation') == 'Employed (Full-time)') selected @endif>Employed (Full-time)</option>
                                                <option value="Employed (Part-time)" @if(session('occupation') == 'Employed (Part-time)') selected @endif>Employed (Part-time)</option>
                                                <option value="Self-employed" @if(session('occupation') == 'Self-employed') selected @endif>Self-employed</option>
                                                <option value="Homemake" @if(session('occupation') == 'Homemake') selected @endif>Homemake</option>
                                                <option value="Retired" @if(session('occupation') == 'Retired') selected @endif>Retired</option>
                                                <option value="Others" @if(session('occupation') == 'Others') selected @endif>Others</option>
                                            </select>
                                            @error('occupation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg m-2">
                                            <label for="educational_level">Educational Level<span class="text-danger">*</span></label>
                                            <select class="form-control @error('educational_level') is-invalid @enderror" name="educational_level" id="educational_level" value="{{ old('educational_level', session('educational_level')) }}" required>
                                                <option value="" disabled selected>- Educational Level -</option>
                                                <option value="No schooling" @if(session('educational_level') == 'No schooling') selected @endif>No schooling</option>
                                                <option value="Elementary" @if(session('educational_level') == 'Elementary') selected @endif>Elementary</option>
                                                <option value="High School" @if(session('educational_level') == 'High School') selected @endif>High School</option>
                                                <option value="Vocational" @if(session('educational_level') == 'Vocational') selected @endif>Vocational</option>
                                                <option value="College" @if(session('educational_level') == 'College') selected @endif>College</option>
                                                <option value="Postgraduate" @if(session('educational_level') == 'Postgraduate') selected @endif>Postgraduate</option>
                                            </select>
                                            @error('educational_level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg m-2">
                                                <label for="address">Address<span class="text-danger">*</span></label>
                                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', session('address')) }}" placeholder="Address" required autofocus>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="form-row mt-2">
                                        <div class="col-lg m-2">
                                            <button type="submit" class="auth-register-btn w-100" >Next <span><i class="fa fa-angle-double-right p-2" aria-hidden="true"></i></span></button>
                                        </div>
                                        @if (Route::has('login'))
                                            <div class="login-link col-lg-12 text-center mt-3">
                                                <small>Already have an account?<a href="{{ route('login') }}"> Login here</a></small>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="auth-register-logo col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ url('import\assets\images\contents\auth-png\register.png') }}" class="w-75" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>