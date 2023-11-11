@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                
                @if(Auth::guard('staff')->user()->staff_role == 'Admin')

                <form action="{{url('admin/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST">
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

                  <div class="form-gourp mb-3">
                      <label for="old_staff_password" class="form-label">Old Password</label>
                      <input name="old_staff_password" type="password" class="form-control @error('old_staff_password') is-invalid @enderror" id="old_staff_password"
                          placeholder="Old Password">
                      @error('old_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-gourp mb-3">
                      <label for="new_staff_password" class="form-label">New Password</label>
                      <input name="new_staff_password" type="password" class="form-control @error('new_staff_password') is-invalid @enderror" id="new_staff_password"
                          placeholder="New Password">
                      @error('new_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-gourp mb-3">
                      <label for="new_staff_password_confirmation" class="form-label">Confirm New Password</label>
                      <input name="new_staff_password_confirmation" type="password" class="form-control" id="new_staff_password_confirmation"
                          placeholder="Confirm New Password">
                  </div>

                  <div class="form-group border-top pt-3">
                    <button class="btn btn-success">Update</button>
                    <a name="" id="" class="btn btn-danger" href="{{route('admin.dashboard')}}" role="button">Cancel</a>
                  </div>
                </form>

                @endif

                @if(Auth::guard('staff')->user()->staff_role == 'Library Staff')

                <form action="{{url('libr/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST">
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

                  <div class="form-gourp mb-3">
                      <label for="old_staff_password" class="form-label">Old Password</label>
                      <input name="old_staff_password" type="password" class="form-control @error('old_staff_password') is-invalid @enderror" id="old_staff_password"
                          placeholder="Old Password">
                      @error('old_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-gourp mb-3">
                      <label for="new_staff_password" class="form-label">New Password</label>
                      <input name="new_staff_password" type="password" class="form-control @error('new_staff_password') is-invalid @enderror" id="new_staff_password"
                          placeholder="New Password">
                      @error('new_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-gourp mb-3">
                      <label for="new_staff_password_confirmation" class="form-label">Confirm New Password</label>
                      <input name="new_staff_password_confirmation" type="password" class="form-control" id="new_staff_password_confirmation"
                          placeholder="Confirm New Password">
                  </div>

                  <div class="form-group border-top pt-3">
                    <button class="btn btn-success">Update</button>
                    <a name="" id="" class="btn btn-danger" href="{{route('libr.dashboard')}}" role="button">Cancel</a>
                  </div>
                </form>

                @endif

                @if(Auth::guard('staff')->user()->staff_role == 'Service Staff')

                <form action="{{url('serv/password/change').'/id='.Auth::guard('staff')->user()->staff_id}}" method="POST">
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

                  <div class="form-gourp mb-3">
                      <label for="old_staff_password" class="form-label">Old Password</label>
                      <input name="old_staff_password" type="password" class="form-control @error('old_staff_password') is-invalid @enderror" id="old_staff_password"
                          placeholder="Old Password">
                      @error('old_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-gourp mb-3">
                      <label for="new_staff_password" class="form-label">New Password</label>
                      <input name="new_staff_password" type="password" class="form-control @error('new_staff_password') is-invalid @enderror" id="new_staff_password"
                          placeholder="New Password">
                      @error('new_staff_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  <div class="form-gourp mb-3">
                      <label for="new_staff_password_confirmation" class="form-label">Confirm New Password</label>
                      <input name="new_staff_password_confirmation" type="password" class="form-control" id="new_staff_password_confirmation"
                          placeholder="Confirm New Password">
                  </div>

                  <div class="form-group border-top pt-3">
                    <button class="btn btn-success">Update</button>
                    <a name="" id="" class="btn btn-danger" href="{{route('serv.dashboard')}}" role="button">Cancel</a>
                  </div>
                </form>

                @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection