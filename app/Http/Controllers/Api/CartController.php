<?php

namespace App\Http\Controllers\Api;

use App\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $goods  =   Goods::findOrFail($request->input('id'));
        $goods->imgs    =   explode(',',$goods->imgs);

        $user   =   Auth::loginUsingId(2);
        if($car=Cart::where('uid',$user)->where('gid',$goods->id)->where('info',$request->input('info'))->first()){
            $num=$car->number+$request->input('number');
            $cart=Cart::find($car->id);
            $cart->number=$num;
            $cart->total=$num*$car->sale;
        }else{
            $cart= new  Cart();
            $cart->uid=$user;
            $cart->gid=$goods->id;
            $cart->name=$goods->name;
            $cart->img=$goods->imgs[0];
            $cart->info="";
            $cart->number=$request->input('number');
            $cart->sale=$goods->sale;
            $cart->total=$goods->sale*$request->input('number');
        }

        if($cart->save()){
            return response()->json(['status'=>200,'text'=>'增加购物车成功!']);
        }
        return response()->json(['status'=>400,'text'=>'增加购物车失败!']);
    }
}
