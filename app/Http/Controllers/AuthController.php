<?php

namespace App\Http\Controllers;

use App\Events\Register;
use App\Mailer\UserMailer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $url = back()->getTargetUrl();
        return view('auth.login',compact('url'));
    }
    /*
     * 检测登录
     */
    public function checkLogin(Request $request){
        if(User::where('email',$request->input('email'))->first()){
            if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$request->input('remember'))){
                return $msg=['s'=>1,'text'=>'登录成功','url'=>$request->input('url')];
            }
            return $msg=['s'=>0,'text'=>'密码不正确!'];
        }
        return $msg=['s'=>0,'text'=>'用户名不存在'];
    }
    /*
     * 重新发送邮箱!
     */
    public function reSend()
    {
        $user=Auth::user();
        event(new Register($user));
        return $msg=['s'=>1,'text'=>'邮件重新发送成功!'];
    }

    /*
     * 注册页面
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /*
     * 注册 request [name email password password_confirmed ]
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user=$this->create($request->all());
        $this->guard()->login($user);

        return $msg=['s'=>1,'text'=>'登录成功!'];
    }
    /*
     * 验证注册用户数据是否正确
     * 返回 true or false
     */
    public function validator(array $data)
    {
        return Validator::make($data,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6|confirmed'
        ],[
            'name.required'=>'名称不能为空',
            'name.string'=>'名称必须是字符',
            'name.max'=>'名称最多255个字符',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式必须正确!',
            'email.max'=>'邮箱最多255个字符',
            'email.unique'=>'此邮箱已被使用!',
            'password.required'=>'密码不能为空',
            'password.string'=>'密码必须是字符!',
            'password.min'=>'最少6个字符!',

        ]);
    }

    /*
     * 保存用户
     * return user
     */
    public function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'emailToken'=>str_random(16),
        ]);
        event(new Register($user));

        return $user;
    }

    /*
     * 返回当前 guard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /*
     * 邮箱验证页面
     */
    public function showActivated()
    {
        $user=Auth::user();
        return view('auth.activated',compact('user'));
    }
    /*
     * 激活邮箱
     */
    protected function activated($id,$token)
    {
        $user=User::find($id);
        if($user->emailToken===$token){
            $user->activated=1;
            $user->save();
            return redirect('user')->with(['msg'=>'邮箱激活成功!']);
        }
        return redirect('user/activated')->with(['msg'=>'邮箱激活失败!']);
    }
}
