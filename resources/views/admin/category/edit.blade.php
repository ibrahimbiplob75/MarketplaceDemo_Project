@extends('layouts.dashboard')
@section('title')
        Category
    @endsection
@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                    <div class="card col-6">
                        <div class="card-header text-center"><h2 style="color:green">Edit category</h2></div>

                        <div class="card-body">
                            @if(session('edit'))
                                <div class="alert alert-success">{{(session('edit'))}}</div>

                            @endif
                            <form action="{{url('category/update')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">category</label>
                                    <input type="hidden" class="form-control"name="category_id" value={{$category_edit->id}}>
                                    <input type="text" class="form-control"  placeholder="slect-category" name="category_name" value={{$category_edit->category_name}}>
                                </div>
                                @error('category_name')
                                   <strong class="text-danger"> {{$message}}</strong>
                                @enderror
                                <div class="form-group text-center mt-2">
                                    <button type="submit" class=" btn btn-success text-center">Update Category</button>
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
