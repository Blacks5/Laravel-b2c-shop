<?php

namespace App\Http\Controllers\User;

use App\Api\Express;
use App\Comment;
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
        $goods->order_state =   Order::where('order_number',$goods->oid)->value('state');

        return view('user.order_refund',compact('goods'));
    }

    /*  申请退款/退货  Ajax */
    public function refundAjax(Request $request)
    {
        $goods  =   Order_goods::where('id',$request->input('id'))->where('uid',Auth::id())->first();
        $goods->refund  =   1;
        $goods->state   =   1;
        $goods->refund_no   =   date('Ymdhis');
        $goods->refund_time =   date('Y-m-d h:i:s',time());
        $goods->refund_type =   $request->input('type');
        $goods->refund_reason   =   $request->input('reason');
        $goods->refund_price    =   $goods->total;
        $goods->refund_info =   $request->input('info');
        $goods->refund_img  =   $request->input('img');
        dd( $goods);
        if($goods->save()){
            return ['s'=>1,'text'=>'申请'.$request->input('type').'成功!'];
        }
        return ['s'=>0,'text'=>'申请'.$request->input('type').'失败!'];
    }

    /*  退款售后 页面 */
    public function change()
    {
        $goods  =   Order_goods::where('refund','1')->where('uid',Auth::id())->get();

        return view('user.order_change',compact('goods'));
    }

    /*  退款收货 详情*/
    public function record($id)
    {
        $goods  =   Order_goods::findOrFail($id);

        return view('user.order_record',compact('goods'));
    }

    /*  快递详情页   */
    public function getExpress($oid)
    {
        $order  =   Order::where('order_number',$oid)->first();
        $express    = new Express();
        $data   =   json_decode($express->getExpress($order->post_code,$order->post_no));
        $data->post_name  =   $order->post_name;

        return view('user.order_express',compact('data'));
    }

    /*  提醒发货    */
    public function remind(Request $request)
    {
        $order  =   Order::findOrFail($request->input('oid'));
        $order->remind  =   1;
        if($order->save()){
            return ['s'=>1,'text'=>'提醒发货成功!'];
        }
        return ['s'=>0,'text'=>'提醒发货失败!'];
    }

    /*  确认收货    */
    public function confirm(Request $request)
    {
        $order  =   Order::findOrFail($request->input('id'));
        $order->state   =   4;
        if($order->save()){
            return ['s'=>1,'text'=>'确认收货成功!'];
        }
        return ['s'=>0,'text'=>'确认收货失败!'];
    }

    /*  评价订单 页面    */
    public function commentList($oid)
    {
        $goods   =   Order_goods::where('oid',$oid)->where('uid',Auth::id())->get();
        if(Comment::where('oid',$goods[0]->id)->get()){
            return redirect('user/order/commentlist');
        }

        return view('user.order_commentList',compact('goods'));
    }

    /*  增加评论    */
    public function commentAdd(Request $request)
    {
        $data   =   $request->all();
        $item   =   0;
        foreach ($request->input('oid') as  $key => $d){
            $order  =   Order_goods::findOrFail($data['oid'][$key]);
            $comment    = new Comment();
            $comment->uid  =   Auth::id();
            $comment->gid =   $order->gid;
            $comment->oid   =   $data['oid'][$key];
            $comment->score =   $data['score'][$key];
            $comment->content  =   $data['text'][$key];
            $comment->img   =   $data['img'][$key];
            if($comment->save()){
                $item+=1;
            }
        }

        if($item==count($request->input('oid'))){
            return ['s'=>1,'text'=>'增加评论成功!'];
        }
        return ['s'=>0,'text'=>'增加评论失败'];
    }

    public function comment()
    {
        $comment    =   new Comment();
        $comments  =   $comment->userComment(Auth::id());
        return view('user.order_comment',compact('comments'));
    }
}
