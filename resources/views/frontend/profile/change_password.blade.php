@extends('frontend.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
               @include('frontend.common.user_sidebar');
                {{-- end col-md-2 --}}
                <div class="col-md-2">

                </div>
                {{-- end col-md-2 --}}
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center">
                        <span class="text-danger">Change Password</span>
                        </h3>

                        <div class="card-body">
                        <form method="POST" action="{{ route('user.password.update') }}" >
                        @csrf

                        
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password<span></span></label>
                                <input type="password"
                                id="current_password"  name="old_password"  class="form-control">
                                @error('old_password')
                            <div class="text-danger">{{$message}}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password<span></span></label>
                                <input type="password" id="password" name="password" class="form-control">
                                @error('password')
                            <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password<span></span></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                            <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                    <button class="btn btn-danger">Update</button>
                            </div>

                            </form>
                        </div>

                    </div>

                </div>
                {{-- end col-md-8 --}}
            </div> 
            {{-- end row --}}
        </div>
    </div>

@endsection