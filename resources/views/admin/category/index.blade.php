@extends('layouts.dashboard')
@section('title')
        Category
    @endsection
@section('content')
    <section>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" >
                            <div class="card-header text-center"><h2 style="color:green">category List</h2></div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>SL No</th>
                                    <th>category_name</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($category as $info)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$info->category_name}}</td>
                                        <td>{{App\Models\User::where('id',$info->added_by)->first()->name}}</td>
                                        <td>{{$info->created_at->DiffForHumans()>24?$info->created_at->format('d/m/y h:i:s A'):$info->created_at->diffForHumans()}}</td>
                                        <td >
                                            <a href="{{url('/category/delete')}}/{{$info->id}}" class="btn btn-danger">Delete</a>
                                            <a href="{{url('/category/edit')}}/{{$info->id}}" class="btn btn-success">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(session('delete'))
                                <div class="alert alert-success">{{(session('delete'))}}</div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center"><h2 style="color:green">category</h2></div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{(session('success'))}}</div>

                            @endif
                            <form action="{{url('category/insert')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">category</label>
                                    <input type="text" class="form-control"  placeholder="slect-category" name="category_name" >
                                </div>
                                @error('category_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-success">Add Category</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>




        <main class="py-4">
            @yield('content')
        </main>

@endsection
