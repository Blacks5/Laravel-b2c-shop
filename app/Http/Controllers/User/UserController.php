<?php

namespace App\Http\Controllers\User;

use App\Address;
use App\Events\Register;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getUser()
    {
        $user=Auth::user();
    }

    /*  用户主页 */
    public function index()
    {
        $user=Auth::user();
        $order="";
        return view('user.index',compact('user','order'));
    }

    /* 用户资料 */
    public function info()
    {
        $user=Auth::user();
        return view('user.info',compact('user'));
    }

    /* 修改用户资料*/
    public function infoUpdate(Request $request)
    {
        $user=Auth::user();
        $user->nick_name=   $request->input('nick_name');
        $user->bron_y   =   $request->input('bron_y');
        $user->bron_m   =   $request->input('bron_m');
        $user->bron_d   =   $request->input('bron_d');
        $user->phone    =   $request->input('phone');
        $user->sex      =   $request->input('sex');
        if($user->save()){
            return ['s'=>1,'text'=>'修改成功!'];
        }
        return ['s'=>0,'text'=>'修改失败'];
    }

    /* 安全中心 */
    public function safety()
    {
        $user=Auth::user();
        return view('user.safety',compact('user'));
    }

    /* 修改密码 */

    public function password(Request $request)
    {
        if($request->isMethod('post')){
            $validata= Validator::make($request->all(),[
                'password'  =>  'required|between:6,20',
                'new_password'  =>  'required|between:6,20|confirmed'
            ],[
                'required'  =>  '请填写密码!',
                'between'   =>  '密码长度在6-20个字符之间',
                'confirmed' =>  '2次密码输入不正确',
            ]);
            $user=Auth::user();
            $password   = $request->input('password');
            $validata->after(function($validata) use ($password, $user) {
                if (!\Hash::check($password, $user->password)) { //原始密码和数据库里的密码进行比对
                    $validata->errors()->add('password', '原密码错误'); //错误的话显示原始密码错误
                }
            });
            if($validata->fails()){
                return view('user.password')->withErrors($validata);
            }
            $user->password =   bcrypt($request->input('new_password'));
            $user->save();
            $request->session()->flash('success', '修改成功！');
            return redirect()->back();
        }

        return view('user.password');
    }

    /* 收货地址管理 */
    public function address()
    {
        $user   =   Auth::user();
        $adr    =   Address::where('uid',$user->id)->orderBy('type','desc')->get();
        return view('user/address',compact('adr'));
    }
}
