<?php

namespace App\Http\Controllers;
use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id= Auth::id();
        $user_info=user::where('id','!=',$user_id)->orderBy('id','desc')->paginate(5);
        $count =user::count();
        $user_name= Auth::user()->name;
        $user_photo= Auth::user()->photo;
        return view('home',compact('user_info','count','user_name','user_photo'));
    }

}
