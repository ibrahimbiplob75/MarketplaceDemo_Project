@extends('layouts.dashboard')
@section('title')
        Products
    @endsection
@section('content')
    <section>

            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header" >
                            <div class="card-header text-center"><h2 style="color:green">products List</h2></div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tr>
                                    <th>SL No</th>
                                    <th>product name</th>
                                    <th>product price</th>
                                    <th>discount price</th>
                                    <th>product description</th>
                                    <th>product Image</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($products as $info)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$info->product_name}}</td>
                                        <td>{{$info->product_price}}</td>
                                        <td>{{$info->discount_price}}</td>
                                        <td>{{substr($info->product_description,0,40).'...more'}}</td>
                                        {{-- for view the output of summernote I have to use {!!  !!}; --}}
                                        <td><img width="50" src="{{asset('dashboard_assets/uploads/products/preview')}}/{{$info->product_photo}}"></td>

                                        <td>{{$info->created_at->DiffForHumans()>24?$info->created_at->format('d/m/y h:i:s A'):$info->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('inventory',$info->id)}}" style="width:52%;text-align:center" class="btn btn-info">Inventory</a>
                                            <a href="{{url('')}}/{{$info->id}}" style="width:45%" class="btn btn-danger">Delete</a>

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
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header text-center"><h2 style="color:green">Add products</h2></div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{(session('success'))}}</div>

                            @endif
                            <form action="{{url('/product/insert')}}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <label class="form-label  mt-03">category List</label>
                                <select name="category_id" class="form-control category_id">
                                    <option value="">--select category</option>
                                    @foreach($category as $info)
                                        <option value="{{$info->id}}">{{$info->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror



                                <label class="form-label mt-03">Subcategory List</label>
                                <select name="subcategory_id" class="form-control category">
                                    <option value="">--select subcategory</option>
                                    @foreach($subcategory as $info)
                                        <option value="{{$info->id}}">{{$info->subcategory_name}}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror


                                <div class="mt-03">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control"  name="product_name" >
                                    @error('product_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="mt-03">
                                    <label class="form-label">Product Price</label>
                                    <input type="text" class="form-control"  name="product_price" >
                                    @error('product_price')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="mt-03">
                                    <label class="form-label">Product % of Discount</label>
                                    <input type="text" class="form-control"  name="discount" >
                                    @error('discount')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="mt-03">
                                    <label class="form-label">Product Description</label>
                                    <textarea type="text-area" class="form-control"  id="summernote"  name="product_description" ></textarea>
                                    @error('product_description')
                                        <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="mt-03 mb-03">
                                    <label class="form-label">Product photo</label>
                                    <input type="file" class="form-control"  name="product_photo" >
                                    @error('product_photo')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="mt-03 mb-03">
                                    <label class="form-label">Product thumbnail</label>
                                    <input multiple type="file" class="form-control"  name="product_thumb[]" >
                                    @error('product_photo')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="form-group mt-6">
                                    <img style="height:100px"  src="{{asset('dashboard_assets/uploads/products/preview/default.png')}}">
                                </div>

                                <div class="text-center form-group mt-2">
                                    <button type="submit" class="btn btn-success">Submit</button>
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

        @section('footer_js')

            <script>
                $('.category')

             $('.category_id').change(function(){
                 var info=$(this).val();

                    $.ajaxSetup(
                        {
                            headers:{
                                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    $.ajax({
                        type:'POST',
                        url:'/getsubcategory',
                        data:{info:info},
                        success:function(data){
                            $('.category').html(data);
                        }
                    })
             });

             $(document).ready(function() {
                    $('.category_id').select2();
                });
                $(document).ready(function() {
                    $('.category').select2();
                });

                $(document).ready(function() {
                    $('#summernote').summernote();
                    });
            </script>
                <script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap , SummerNote',
        tabsize: 5,
        height: 200
      });
    </script>

        @endsection



@endsection
