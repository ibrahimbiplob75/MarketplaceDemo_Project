<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\validator;
use Illuminate\validation\Rules\password;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;



class profile extends Controller
{

    function profile(){
        return view('admin.profile.edit');
    }
    function user_login()
    {
        return view('auth.user_login');
    }
    function add_user(Request $request){
        user::insert(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'role'=>$request->role,

                'created_at'=>Carbon::now(),
            ]
            );
            return back();
    }

    function update(request $request){

        user::find(Auth::id())->update(
            [
                'name'=>$request->name,
            ]);
            return back();

    }
    function p_update(request $request){
        $request->validate(
            [
                'password'=>'required',
                'password'=>'confirmed',
                'password'=>password::min(8)->mixedCase()->letters()->numbers()->symbols(),

            ]);
            if(Hash::check($request->old_password, Auth::user()->password)){
                user::find(Auth::id())->update(
                    [
                        'password'=>bcrypt($request->password),
                    ]
                    );
                    return back()->with('update_password','new Password updated succesfully ');
            }

            else{
                return back()->with('error','Old password dosent Match!');
            }



    }
    function profilepictureupdate(request $request){

        $request->validate(
            [
                'photo'=>'required',
                'photo'=>'image',
                'photo'=>'file|max:512',

            ]);
            $new_profile_photo=$request->photo;
            $extension=$new_profile_photo->getClientOriginalExtension();
            $name=Auth::user()->id.'.'.$extension;

            // if(auth::user()->photo != 'deafault.png'){
            //     $path=public_path().'/dashboard_assets/uploads/user/'.Auth::user()->photo;
            //     unlink($path);

            // }

           Image::make($new_profile_photo)->resize(360, 300)->save('dashboard_assets/uploads/user/'.$name);
            user::find(Auth::id())->update(
                [
                    'photo'=>$name,
                ]
                );

                return back()->with('photo','All Criterial dosent Match');
         }

}
