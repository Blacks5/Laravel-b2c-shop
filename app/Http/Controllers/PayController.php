<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\Factory\Promotion;
use App\Order;
use App\Order_goods;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;
use function PHPSTORM_META\map;

class PayController extends Controller
{
    use Promotion;
    public function index($id)
    {
        $cart=$this->findCart($id);
        $address=Address::where('uid',Auth::id())->orderBy('type','desc')->get();
        //$promotion =['type'=>'满减','condition'=>300,'return'=>50,'total'=>900];
        //dd($this->getTotal($promotion));
        return view('pay.index',compact('cart','address','id'));
    }

    public function pay($pay,$address,$goods)
    {
        $cart=$this->findCart($goods);
        $adr=Address::find($address);
        $total=$this->total($cart);
        $No=date('Ymd',time()).rand(1000,9999);
        if($pay=='alipay'){
            $alipay=$this->alipay($No,$total,$cart[0]->name,$cart[0]->info);
            //return redirect()->to($alipay->getPayLink());
        }


    }

    /*  增加订单    */
    public function payAdd(Request $request)
    {
        $address =Address::findOrFail($request->input('address'));

        $item['uid']    =   Auth::id();
        $item['goods']   =  $this->cart($request->input('goods'));
        //$item['goods']   =  '{["img":1,"name":"2"],["img":2,"name":"good"]}';
        $item['address']    =   $address->prov." ".$address->city." ".$address->district." ".$address->info;
        $item['name']   =   $address->name;
        $item['phone']  =   $address->phone;
        $item['total']  =   $this->total($item['goods']);
        $item['order_number']   =   date('Ymdhis').rand(1000,9999);
        $item['remake'] =   $request->input('remake');
        $item['postage']=   $request->input('postage');
        $item['pay_way']=   $request->input('pay');
        $item['pay_number'] =   $item['total']+$item['postage'];
        $this->orderAdd($item);
        $this->orderGoods($item['order_number'],$item['uid'],$item['goods']);
        $pay    =   $this->goToPay($item);
        return redirect()->to($pay);
    }
    /*  增加订单详情  */
    protected function orderAdd($data)
    {
        return Order::create($data);
    }

    /*  增加订单商品  */
    protected function orderGoods($oid,$uid,$goods)
    {
        $good['oid']    =   $oid;
        $good['uid']    =   $uid;
        foreach ($goods as $item => $g){
            $good['gid']    =   $g->gid;
            $good['img']    =   $g->img;
            $good['name']   =   $g->name;
            $good['info']   =   $g->info;
            $good['sale']   =   $g->sale;
            $good['number'] =   $g->number;
            $good['total']  =   $g->total;
            Order_goods::create($good);
            Cart::destroy($g->id);
        }
    }
    /*  获取订单总额  */
    public function total($cart)
    {
        $total=0;
        foreach ($cart as $t){
            $total+=$t->total;
        }
        return $total;
    }

    public function cart($id)
    {

        $goods   =   Cart::findOrFail(explode(',',$id));
        return $goods;
    }

    /* 返回商品列表 */
    public function findCart($id){
        $goods=explode(',',$id);
        foreach ($goods as $key =>$g){
            $cart[$key]=Cart::find($g);
        }
        return $cart;
    }
    
    /*  支付  */
    public function goToPay($data)
    {
        if($data['pay_way']=='alipay'){
            $alipay=$this->alipay($data['order_number'],$data['total'],$data['order_number'].'订单支付',$data['name'].'购买的商品');
            return $alipay->getPayLink();
        }
    }

    /*  重新支付订单  */
    public function rePay($oid)
    {
        $data   =   Order::where('order_number',$oid)->where('uid',Auth::id())->first();
        $pay    =   $this->goToPay($data);

        return redirect()->to($pay);
    }

    public function alipay($no,$total,$title,$dsc)
    {
        $alipay=app('alipay.web');
        $alipay->setOutTradeNo($no);
        $alipay->setTotalFee($total);
        $alipay->setSubject($title);
        $alipay->setBody($dsc);

        $alipay->setQrPayMode('4');

        return $alipay;
    }

    /**
     * 同步通知
     */
    public function webReturn()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            return 'zhifushibai';
            return view('alipay.fail');
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
return 'ok';                break;
        }

        //return view('alipay.success');
    }

    /**
     * 异步通知
     */
    public function webNotify()
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => Request::instance()->getContent()
            ]);
            return 'fail';
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }

        return 'success';
    }
}
