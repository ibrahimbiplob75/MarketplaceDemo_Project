<?php

namespace App\Http\Controllers;

use App\Models\coustomerlogin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class coustomerregiscontroller extends Controller
{
    function coustomer_register(request $request){
       coustomerlogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        return view("auth.myaccount");
    }
    function coustomer_account(){
        return view("auth.myaccount");
    }
}


