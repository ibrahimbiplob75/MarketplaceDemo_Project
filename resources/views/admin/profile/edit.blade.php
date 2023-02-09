@extends('layouts.dashboard')
@section('title')
        profile
    @endsection
@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                    <div class="card col-10">
                        <div class="card-header text-center"><h2 style="color:green">Edit Profile </h2></div>

                        <div class="card-body">
                            @if(session('edit'))
                                <div class="alert alert-success">{{(session('edit'))}}</div>

                            @endif
                            <form action="{{url('profile/update')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Profile Name</label>
                                    <input type="hidden" class="form-control"name="name" value=''>
                                    <input type="text" class="form-control"  name="name" value={{Auth::user()->name}}>
                                </div>
                                @error('name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group text-center mt-2">
                                    <button type="submit" class=" btn btn-success text-center">Update Profile</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                 <div class="row justify-content-center">
                    <div class="card col-10">
                        <div class="card-body">
                            @if(session('photo_suc'))
                                <div class="alert alert-success">{{(session('photo_suc'))}}</div>
                            @endif
                            <form action="{{url('/profile/picture/update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control"  name="photo" >
                                </div>
                                @error('photo')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group">
                                    <img  class="h-10 w-10" src="{{asset('dashboard_assets/uploads/user')}}/{{Auth::user()->photo}}">
                                </div>


                                <div class="form-group text-center mt-2">
                                    <button type="submit" class=" btn btn-success text-center">Update Profile</button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="row justify-content-center">
                    <div class="card col-9">
                        <div class="card-body">
                            @if(session('update_password'))
                                <div class="alert alert-success">{{(session('update_password'))}}</div>

                            @endif

                            @if(session('error'))
                                <div class="alert alert-warning">{{(session('error'))}}</div>

                            @endif

                            <form action="{{url('password/update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Old Password</label>
                                    <input type="password" class="form-control"  name="old_password">
                                </div>
                                @error('password')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control"  name="password">
                                </div>
                                @error('password')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group">
                                    <label class="form-label">confirmed Password</label>
                                    <input type="password" class="form-control"  name="password_confirmation">
                                </div>
                                @error('password')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group text-center mt-2">
                                    <button type="submit" class=" btn btn-success text-center">Update Password</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
    </section>




        <main class="py-4">
            @yield('content')
        </main>

@endsection
