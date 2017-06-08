<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $url = back()->getTargetUrl();
        return view('auth.login',compact('url'));
    }

    public function checkLogin(Request $request){
        if(User::where('email',$request->input('email'))->first()){
            if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$request->input('remember'))){
                return $msg=['s'=>1,'text'=>'登录成功','url'=>$request->input('url')];
            }
            return $msg=['s'=>0,'text'=>'密码不正确!'];
        }
        return $msg=['s'=>0,'text'=>'用户名不存在'];
    }
}
