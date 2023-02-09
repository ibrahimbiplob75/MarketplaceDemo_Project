@extends('layouts.dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2 style="color:green">Welcome, {{$user_name}}. to your Dashboard -----<span class="float-end"> Total users={{$count}}</span></h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">profile picture</th>
                                <th scope="col">Role</th>
                                <th scope="col">Regis Time</th>
                            </tr>
                            </thead>
                        <tbody>
                        @foreach($user_info as $key=>$info)
                            <tr>

                            <th scope="row">{{$user_info->firstitem()+$key}}</th>
                                <td>{{$info->name}}</td>
                                <td>{{$info->email}}</td>
                                <td><img width="80" src="{{asset('dashboard_assets/uploads/user')}}/{{$info->photo}}"></td>
                                <td>
                                    @php
                                        if($info->role==1){
                                            echo "Admin";
                                        }
                                        else if($info->role==2){
                                            echo "Moderator";
                                        }
                                        else if($info->role==3){
                                            echo "editor";
                                        }
                                         else if($info->role==4){
                                            echo "shopkeper";
                                        }
                                         else {
                                            echo "Not assigned";
                                        }
                                    @endphp

                                </td>
                                <td>{{$info->created_at->diffInHours()>24? $info->created_at->format('d/m/y h:i:s A'):$info->created_at->diffForHumans()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$user_info->links()}}
                </div>
            </div>
        </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h2 style="color:green">Welcome,{{$user_name}}->Add User </h2></div>
                    <div class="card-body">
                        <form action="{{url('add/user/')}}" method="POST">
                        @csrf
                    <div class="form-group">
                    <input type="text"  name="name" class="form-control" placeholder="Enter your Name">
                        @error('name')
                            <span class="Invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter your Email">
                        @error('email')
                            <span class="Invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div><!-- form-group -->
                    <div class="form-group">
                        <select name="role" class="form-control" >
                            <option value=""><--Select Role --></option>
                            <option value="1">>Admin </option>
                            <option value="2">Moderator</option>
                            <option value="3">editor</option>
                            <option value="4">Shopkeeeper</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                    @error('password')
                            <span class="Invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div><!-- form-group -->
                    <button type="submit" class="btn btn-info btn-block">Add user</button>
        </form>
                    </div>
                </div>
            </div>



    </div>
</div>
@endsection
