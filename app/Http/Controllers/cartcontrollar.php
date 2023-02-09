<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartcontrollar extends Controller
{
    function cart_insert(request $request){
        if(cart::where('user_id', Auth::guard('coustomerlogin')->id())->where('product_id',$request->product_id,)->where('size_id',$request->size_id,)->where('color_id',$request->color_id,)->exists()){
            cart::where('user_id', Auth::guard('coustomerlogin')->id())->where('product_id',$request->product_id,)->where('size_id',$request->size_id,)->where('color_id',$request->color_id,)->increament('quantity',$request->quantity);
        }
        cart::insert([
            'user_id'=>Auth::guard('coustomerlogin')->id(),
            'product_id'=>$request->product_id,
            'size_id'=>$request->size_id,
            'color_id'=>$request->color_id,
            'quantity'=>$request->qtybutton,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('cart_add','Product added in cart');


}
    function cart_delete($cart_id)
    {
        cart::find($cart_id)->delete();
        return back();
    }
}
