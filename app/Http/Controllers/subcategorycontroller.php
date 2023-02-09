<?php

namespace App\Http\Controllers;
use App\Models\category_table;
use Illuminate\Http\Request;
use App\Models\subcategory;
use App\Http\Requests\subcategoryrequest;
use carbon\carbon;


class subcategorycontroller extends Controller
{
    function index(){
        $categories=category_table::all();
        $subcategories=subcategory::all();
        $trashed=subcategory::onlyTrashed()->get();
        return view('admin.subcategory.index',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'trashed'=>$trashed,
        ]);
    }
    function insert(subcategoryrequest $request){

        if(subcategory::withTrashed()->where('category_id',$request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
        return back()->with('exit','This Sub category is already exists');

    }

        else{
        subcategory::insert([
            'category_id'=> $request->category_id,
            'subcategory_name'=> $request->subcategory_name,
            'created_at'=>carbon::now(),
        ]);
        return back();
    }
}
    function edit($subcategory_id){
        $subcategories=subcategory::find($subcategory_id);
        $categories=category_table::all();
        return view('admin.subcategory.edit',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
        return back();
    }
    function update(request $request){
        subcategory::where('id',$request->subcategory_id)->update([
            'subcategory_name'=>$request->subcategory_name,
            'updated_at'=>carbon::now(),

        ]);
        return back()->with('edit','subCategory edited succesfully');
    }
    function delete($subcategory_id){
        subcategory::find($subcategory_id)->delete();
        return back()->with('softdelete','subcategory soft deleted succesfully');
    }

    function restore($subcategory_id){
        subcategory::onlyTrashed()->find($subcategory_id)->restore();
        return back();
    }

    function P_delete($subcategory_id){
        subcategory::onlyTrashed()->find($subcategory_id)->forcedelete();
        return back();
    }

}
