@extends('layouts.dashboard')
@section('title')
        subCategory
    @endsection
@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                    <div class="card col-6">
                        <div class="card-header text-center"><h2 style="color:green">Edit subcategory</h2></div>

                        <div class="card-body">
                            @if(session('edit'))
                                <div class="alert alert-success">{{(session('edit'))}}</div>

                            @endif
                            <form action="{{url('/subcategory/insert')}}" method="POST">
                        <div class="form-group p-2">
                            @csrf
                            <label class="form-label">category Name</label>
                                <select name="category_id" class="form-control">
                                    <option value="">--select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"{{((($category->id==$subcategories->category_id)?'selected':''))}}>
                                            {{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                        </div>
                                <div class="form-group p-2">
                                    <label class="form-label">Subcategory Name</label>
                                    <input type="text" class="form-control"  name="subcategory_name" value="{{$subcategories->subcategory_name}}">
                                    @error('subcategory_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                    @enderror
                                </div>

                                <div class="form-group mt-2 mb-4 text-center">
                                    <button type="submit" class="btn btn-warning">update SubCategory</button>
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
