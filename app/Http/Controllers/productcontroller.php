<?php

namespace App\Http\Controllers;
use App\Models\category_table;
use App\Models\products;
use App\Models\colorSize;
use App\Models\Size;
use App\Models\inventory;
use App\Models\productThamnails;
use App\Models\subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class productcontroller extends Controller
{
    public function product_invetory(){
        $colors=colorSize::all();
        $size=Size::all();
        return view("admin.products.colorSize",[
            'colors'=>$colors,
            'size'=>$size,
        ]);
    }
    function product_color(request $request){
        colorSize::insert([
            "color_name"=>$request->color_name,
            "color_code"=>$request->color_code,
            "created_at"=>carbon::now(),
        ]);
        return back()->with('success','Color & code added succesfully');
    }
    function product_size(request $request){
        Size::insert([
            "size_name"=>$request->size_name,
            "created_at"=>carbon::now(),
        ]);
        return back()->with('success_s','Size added succesfully');
    }
    public function index(){
        $category= category_table::all();
        $subcategory= subcategory::all();
        $products= products::all();
        return view("admin.products.index", [
            'category'=>$category,
            'subcategory'=>$subcategory,
            'products'=>$products,
        ]);
    }

    function getsubcategory(Request $request){
       $hamdu= subcategory::where('category_id',$request->info)->select('id','subcategory_name')->get();
       $srtring_to_send="<option>..select subcategory..</option>";

       foreach($hamdu  as $subcategory){
        $srtring_to_send.='<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name."</option>";
       }

       echo $srtring_to_send;

    }

    function product_insert(request $request){
        $products_id=products::insertGetId(
             [
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'product_name'=>$request->product_name,
                'product_price'=>$request->product_price,
                'discount'=>$request->discount,
                'discount_price'=>$request->product_price-($request->product_price * $request->discount)/100,
                'product_description'=>$request->product_description,
                'product_photo'=>$request->product_photo,
                'created_at'=>Carbon::now(),

             ]);


             $product_photo=$request->product_photo;
             $extension=$product_photo->getClientOriginalExtension();
             $product_image_name=$products_id.".".$extension;
             //echo $product_image_name.'<br>';

             products::find($products_id)->update(
                 [
                    'product_photo'=>$product_image_name,
                 ]
                 );

             Image::make($product_photo)->resize(360, 300)->save(public_path('dashboard_assets/uploads/products/preview/').$product_image_name);

            $number=1;
            foreach($request->file('product_thumb') as $products_thumb){

                $extension=$products_thumb->getClientOriginalExtension();
                $product_thum_image=$products_id."_".$number.".".$extension;
                //echo $product_thum_image.'<br>';
                productThamnails::insert(
                    [
                        'products_id'=>$products_id,
                        'product_thum_image'=>$product_thum_image,
                        'created_at'=>carbon::now(),
                    ]
                    );
                Image::make($products_thumb)->resize(360, 300)->save(public_path('dashboard_assets/uploads/products/thumbnail/').$product_thum_image);
                $number++;
            }


            return back()->with('success','Products Details Update successfully');
    }
    function inventory($products_id){
        $color=colorSize::all();
        $size=Size::all();
        $products_id=products::find($products_id);
        return view('admin.products.inventory',[
           'colors'=>$color,
           'sizes'=>$size,
           'products'=>$products_id,
        ]);
    }
    function inventory_insert(request $request){
        if(inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->where('size_id', $request->size_id)->exists()){
            inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->where('size_id', $request->size_id)->increment('product_Quantity',$request->product_Quantity);
            return back()->with('success','product inventory submitted');
        }
        else{
            inventory::insert([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'product_Quantity'=>$request->product_Quantity,
                'created_at'=>carbon::now(),
            ]);
            return back()->with('success','product inventory submitted');
        }
    }
}
