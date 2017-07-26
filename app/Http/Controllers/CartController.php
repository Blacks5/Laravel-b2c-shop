<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index(){
        $cart=Cart::where('uid',Auth::id())->get();
        return view('cart.index',compact('cart'));
    }

    public function create(Request $request)
    {
        $user = Auth::id();
        $goods=Goods::findOrFail($request->input('goods'));
        $imgs=explode(',',$goods->imgs);

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
            $cart->img=$imgs[0];
            $cart->info=$request->input('info');
            $cart->number=$request->input('number');
            $cart->sale=$goods->sale;
            $cart->total=$goods->sale*$request->input('number');
        }


        if($cart->save()){
            return $msg=['s'=>1,'text'=>'增加成功!'];
        }else{
            return $msg=['s'=>0,'text'=>'增加失败!'];
        }
    }

    public function update(Request $request,$id)
    {
        $rs=DB::table('carts')->where('id',$id)->update([$request->input('action')=>$request->input('value')]);
        if($rs){
            if($request->input('action')=='number'){
                $msg=$this->updateTotal($id);
                $msg['s']=1;
                $msg['text']='修改成功!';
                $msg['id']=$id;
            }
            return $msg;
        }else{
            return $msg=['s'=>0,'text'=>'修改失败'];
        }
    }

    public function updateTotal($id)
    {
        $total=Cart::find($id);
        $total->total=$total->sale*$total->number;
        if($total->save()){
            $msg['total']=$total->total;
            return $msg;
        }
    }

    public function destroy($id)
    {
        if(Cart::destroy($id)){
            return $msg=['s'=>1,'text'=>'删除成功!'];
        }else{
            return $msg=['s'=>0,'text'=>'删除失败!'];
        }
    }
}
