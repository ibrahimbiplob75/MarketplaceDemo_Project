@extends('layouts.dashboard')
    @section('title')
        Products color&size
    @endsection
@section('content')
    <section>
        <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header" >
                                <div class="card-header text-center"><h2 style="color:green">products Color&Size</h2></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SL No</th>
                                        <th>color name </th>
                                        <th>color code</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($colors as $info)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$info->color_name}}</td>
                                            <td class="text-center">
                                                <i  style="height:30px;width:30px;display:inline-block;border-radius:50%;background:{{$info->color_code}}">
                                                </i>
                                            </td>
                                            <td>{{$info->created_at->DiffForHumans()>24?$info->created_at->format('d/m/y h:i:s A'):$info->created_at->diffForHumans()}}</td>
                                        <td >
                                            <!-- <a href="{{url('/category/edit')}}/{{$info->id}}" class="btn btn-info">Inventory</a> -->
                                            <a href="{{url('/products/color/delete')}}/{{$info->id}}" class="btn btn-danger">Delete</a>

                                        </td>
                                    @endforeach
                                    </table>
                                </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>SL No</th>
                                        <th>Size name </th>
                                        <th>Action </th>
                                    </tr>
                                    @foreach($size as $info)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$info->size_name}}</td>
                                        <td >
                                            <!-- <a href="{{url('/category/edit')}}/{{$info->id}}" class="btn btn-info">Inventory</a> -->
                                            <a href="{{url('/products/color/delete')}}/{{$info->id}}" class="btn btn-danger">Delete</a>

                                        </td>
                                    @endforeach
                                </table>
                            </div>

                        </div>
                    </div>
                <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header text-center"><h2 style="color:green">Add    Color</h2>
                            </div>

                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{(session('success'))}}</div>

                                @endif
                                <form action="{{url('/product/color/insert')}}" method="POST" >
                                    @csrf
                                    <div class="mt-03">
                                        <label class="form-label">Color Name</label>
                                        <input type="text" class="form-control"  name="color_name" >
                                        @error('product_name')
                                    <strong class="text-danger"> {{$message}}</strong>
                                        @enderror
                                    </div>

                                    <div class="mt-03">
                                        <label class="form-label">color_code</label>
                                        <input type="text" class="form-control"  name="color_code" >
                                        @error('product_price')
                                    <strong class="text-danger"> {{$message}}</strong>
                                        @enderror
                                    </div>
                                    <div class="text-center form-group mt-2">
                                    <button type="submit" class="btn btn-success">Submit Color</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="card mt-5">
                            <div class="card-header text-center"><h2 style="color:green">Add Size</h2></div>
                            <div class="card-body">
                                @if(session('success_s'))
                                    <div class="alert alert-success">{{(session('success_s'))}}</div>

                                @endif
                                <form  action="{{url('/product/size/insert')}}" method="POST" >
                                    @csrf
                                    <div class="mt-03">
                                        <label class="form-label">size Name</label>
                                        <input type="text" class="form-control"  name="size_name" >
                                        @error('product_size')
                                    <strong class="text-danger"> {{$message}}</strong>
                                        @enderror
                                    </div>

                                    <div class="text-center form-group mt-2">
                                    <button type="submit" class="btn btn-success">Submit Size</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>


    </section>
@endsection
