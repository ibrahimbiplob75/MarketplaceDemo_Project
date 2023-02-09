<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class coustomerlogincontroller extends Controller
{
    function coustomer_login(request $request){
    if(Auth::guard('coustomerlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
        return redirect('/');
    }
    else{
        return back();
    }



    }
}
