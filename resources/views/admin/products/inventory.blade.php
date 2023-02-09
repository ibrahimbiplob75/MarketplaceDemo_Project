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



                            </div>

                        </div>
                    </div>
                <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header text-center"><h2 style="color:green">Products Inventory</h2>
                            </div>

                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{(session('success'))}}</div>

                                @endif
                                <form action="{{url('/inventory/insert')}}" method="POST" >
                                    @csrf
                                    <div class="mt-03">
                                        <label class="form-label">Products Name</label>
                                        <input type="text" readonly class="form-control" value="{{$products->product_name}} " name="product_name" >
                                        <input type="hidden" class="form-control" value="{{$products->id}} " name="product_id" >
                                        @error('product_name')
                                    <strong class="text-danger"> {{$message}}</strong>
                                        @enderror
                                    </div>

                                    <div class="mt-05">
                                        <label class="form-label">color_code</label>
                                        <select name="color_id" class="form-control">
                                            <option value=""><-- select color --></option>
                                            @foreach($colors as $color)
                                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                                            @endforeach
                                        </select>
                                            @error('product_price')
                                                <strong class="text-danger"> {{$message}}</strong>
                                            @enderror
                                    </div>
                                    <div class="mt-05">
                                        <label class="form-label">Product Size</label>
                                        <select name="size_id" class="form-control">
                                            <option value=""><--select Size--></option>
                                            @foreach($sizes as $size )
                                                <option value="{{$size->id}}">{{$size->size_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-03">
                                        <label class="form-label">Products Quntity</label>
                                        <input type="text" class="form-control"  name="product_Quantity" >
                                        @error('product_Quantity')
                                    <strong class="text-danger"> {{$message}}</strong>
                                        @enderror
                                    </div>


                                    <div class="text-center form-group mt-2">
                                    <button type="submit" class="btn btn-success">Submit Inventory</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

        </div>


    </section>
@endsection
