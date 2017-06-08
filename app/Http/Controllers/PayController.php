<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\map;

class PayController extends Controller
{
    public function index($id)
    {
        $cart=$this->findCart($id);
        $address=Address::where('uid',Auth::id())->orderBy('type','desc')->get();
        return view('pay.index',compact('cart','address','id'));
    }

    public function pay($pay,$address,$goods)
    {
        $cart=$this->findCart($goods);
        $adr=Address::find($address);
        $total=0;
        foreach ($cart as $c){$total+=$c->total;}
        $No=date('Ymd',time()).rand(1000,9999);
        if($pay=='alipay'){
            $alipay=$this->alipay($No,$total,$cart[0]->name,$cart[0]->info);
            return redirect()->to($alipay->getPayLink());
        }


    }

    public function findCart($id){
        $goods=explode(',',$id);
        foreach ($goods as $key =>$g){
            $cart[$key]=Cart::find($g);
        }
        return $cart;
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
