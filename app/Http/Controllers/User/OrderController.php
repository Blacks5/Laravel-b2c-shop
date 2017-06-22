<?php

namespace App\Http\Controllers\User;

use App\Api\Express;
use App\Order;
use App\Order_goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /* 用户订单列表   */
    public function index()
    {
        $order  =   Order::where('uid',Auth::id())->get();
        foreach ($order as $key => $o){
            $order[$key]['goods'] =   Order_goods::where('oid',$o->order_number)->get();
        }
        return view('user.order_index',compact('order'));
    }

    /*  订单详情    */
    public function orderInfo($oid)
    {
        $order  =   Order::where('order_number',$oid)->where('uid',Auth::id())->first();
        $order['goods'] =   Order_goods::where('oid',$oid)->get();
        if($order->state>2){
            $express    =   new Express();
            $order->express =   json_decode($express->getExpress($order->post_code,$order->post_no));
        }

        return view('user.order_info',compact('order'));
    }

    /*  退款/退货   页面   */
    public function refund($id)
    {
        $goods  =   Order_goods::where('id',$id)->where('uid',Auth::id())->first();

        return view('user.order_refund',compact('goods'));
    }

    public function getExpress($oid)
    {
        $order  =   Order::where('order_number',$oid)->first();
        $express    = new Express();
        $data   =   json_decode($express->getExpress($order->post_code,$order->post_no));
        $data->post_name  =   $order->post_name;

        return view('user.order_express',compact('data'));
    }
}
