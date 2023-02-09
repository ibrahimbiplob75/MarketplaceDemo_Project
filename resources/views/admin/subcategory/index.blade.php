@extends('layouts.dashboard')
    @section('title')
        subCategory
    @endsection
@section('content')
<section>
    <div class="container ">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header text-center "><h2 style="color:green">Subcategory List
                            </h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                                <tr>
                                    <th>SL No</th>
                                    <th>category_name</th>
                                    <th>subcategory_name</th>
                                    <th>Added By</th>
                                    <th>Created At</th>

                                    <th>Action</th>
                                </tr>
                                @foreach($subcategories as $info)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{App\Models\category_table::find($info->category_id)->category_name}}</td>
                                        <td>{{$info->subcategory_name}}</td>
                                        <td>{{App\Models\category_table::find($info->category_id)->added_by}}</td>
                                        <td>{{$info->created_at->DiffForHumans()>24?$info->created_at->format('d/m/y h:i:s A'):$info->created_at->diffForHumans()}}</td>

                                        <td >
                                            <a href="{{url('/subcategory/delete')}}/{{$info->id}}" class="btn btn-danger">Delete</a>
                                            <a href="{{url('/subcategory/edit')}}/{{$info->id}}" class="btn btn-success">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            @if(session('softdelete'))
                                <div class="alert alert-success">{{(session('softdelete'))}}</div>

                            @endif
                    </div>
                </div>
            </div>
            <div class="col-3">
            <div class="card">
                    <div class="card-body">
                        <div class="card-header text-center"><h2 style="color:green">Subcategory</h2></div>
                    </div>

                    <form action="{{url('/subcategory/insert')}}" method="POST">
                        <div class="form-group p-2">
                            @csrf
                            <label class="form-label">category Name</label>
                                <select name="category_id" class="form-control">
                                    <option value="">--select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                        </div>
                                <div class="form-group p-2">
                                    <label class="form-label">Subcategory Name</label>
                                    <input type="text" class="form-control"  name="subcategory_name" >
                                    @error('subcategory_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="form-group mt-2 mb-4 text-center">
                                    <button type="submit" class="btn btn-success">Add SubCategory</button>
                                </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">

            <div class="card">
                    <div class="card-header">
                        <div class="card-header text-center "><h2 style="color:green">Trash Subcategory List
                            </h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                                <tr>
                                    <th>SL No</th>
                                    <th>category_name</th>
                                    <th>subcategory_name</th>
                                    <th>Added By</th>
                                    <th>Created At</th>

                                    <th>Action</th>
                                </tr>
                                @foreach($trashed as $info)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{App\Models\category_table::find($info->category_id)->category_name}}</td>
                                        <td>{{$info->subcategory_name}}</td>
                                        <td>{{App\Models\category_table::find($info->category_id)->added_by}}</td>
                                        <td>{{$info->created_at->DiffForHumans()>24?$info->created_at->format('d/m/y h:i:s A'):$info->created_at->diffForHumans()}}</td>

                                        <td >

                                            <a href="{{url('/subcategory/restore')}}/{{$info->id}}" class="btn btn-warning">Restore</a>
                                            <a href="{{url('/subcategory/permanent/delete')}}/{{$info->id}}" class="btn btn-danger">Delete</a>

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
        </div>
    </div>

</section>
@endsection
