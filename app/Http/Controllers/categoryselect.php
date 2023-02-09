<?php

namespace App\Http\Controllers;

use App\Models\category_table;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Http\Controllers\HomeController;
use Carbon\Carbon;
use App\Http\Requests\categoryrequest;

class categoryselect extends Controller
{
    function index(){
        return view('admin.category.index',compact('user_name'));

    }
   function category(){
        $category= category_table::all();
        return view("admin.category.index", [
            'category'=>$category,
        ]);
    }

    function insert(categoryRequest $request){
            category_table::insert([

                'category_name'=>$request->category_name,
                'added_by'=>Auth::id(),
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success' ,'category added successfully');
    }
    function delete($category_id){
        category_table::where('id',$category_id)->delete();
        subcategory::where('category_id',$category_id)->delete();
        return back()->with('delete','Category deleted succesfully');
    }
    function edit($category_id){
        $category_edit= category_table::find($category_id);
        return view('admin.category.edit', [
            'category_edit'=>$category_edit,
        ]);
    }
    function update(request $request){
        category_table::where('id',$request->category_id)->update([
            'category_name'=>$request->category_name,
            'updated_at'=>carbon::now(),

        ]);
        return back()->with('edit','Category edited succesfully');
    }

}
