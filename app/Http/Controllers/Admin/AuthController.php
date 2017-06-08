<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //show login view
    public function login(){
        return view('admin.login');
    }

    //check login ; return 0->false  1->true
    public function checkLogin(Request $request){
        $validate=Validator::make($request->all(),[
            'email'=> 'required|string',
            'password'=>'required|string'
        ],[
            'email.required'=>"用户名不能为空",
            'password.required'=>'密码不能为空'
        ]);
        if($validate->fails()){
            return redirect('admin/login')->withErrors($validate)->withInput();
        }
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            return redirect('admin');
        }else{
            if(User::where('email',$request->input('email'))->count()){
                return redirect('admin/login')->withErrors(['password'=>'密码错误!'])->withInput();
            }else{
                return redirect('admin/login')->withErrors(['email'=>'没有此账号'])->withInput();
            }
        }


    }

    //login out
    public function loginOut(){
        Auth::logout();
        return redirect('admin/login');
    }
}
