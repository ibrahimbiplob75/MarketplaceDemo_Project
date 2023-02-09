<?php

namespace App\Http\Controllers;

use App\Models\category_table;
use App\Models\colorSize;
use App\Models\inventory;
use App\Models\products;
use App\Models\productThamnails;
use App\Models\Size;
use Illuminate\Http\Request;

class forntend extends Controller
{
    function welcome(){
        $all_category=category_table::all();
        $all_category=category_table::take(3)->get();
        $new_product=products::latest()->take(5)->get();
        $all_products=products::all();
        $all_thumbnails=productThamnails::all();
        return view('admin.frontend.welcome',[
            'all_category'=>$all_category,
            'all_products'=>$all_products,
            'all_thumbnails'=> $all_thumbnails,
            'new_product'=>$new_product,
        ]);
    }

     function product_details($product_id){
        $all_category = category_table::all();
        $all_category = category_table::take(3)->get();
        $new_product = products::latest()->take(5)->get();
        $all_products = products::all();
        $product_info= products::find($product_id);
        $related_product = products::where('category_id', $product_info->category_id)->where('id','!=',$product_id)->get();
        $all_thumbnails = productThamnails::all();
        $available_color= inventory::where('product_id',$product_id)->groupBy('color_id')->selectRaw('count(*) as total , color_id')->get();
        return view('admin.frontend.product_details',[
            'product_info'=>$product_info,
            'all_thumbnails' => $all_thumbnails,
            'all_category' => $all_category,
            'all_products' => $all_products,
            'all_thumbnails' => $all_thumbnails,
            'new_product' => $new_product,
            'available_color'=> $available_color,
            'related_product'=> $related_product,
     ]);

     }

    function getsize(request $request){
        $sizes= inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->get('size_id');
        $size_name_send='';
        foreach($sizes as $size){
            $size_name=Size::find($size->size_id)->size_name;
            $size_name_send .= '<li><a name="'.$size->size_id.'" class="size_id">'.$size_name.'</a></li>';
        }

        echo $size_name_send;



     }
    // function dashboard(){
    //     return view('admin.index');
    // }
}
