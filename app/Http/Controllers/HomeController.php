<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Goods;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type=Type::with('childrenType')->get();
        $lunbo =    Ad::where('position_id','1')->where('enable','1')->get();
        $topNav =   Ad::where('position_id','3')->where('enable','1')->get();
        $goods=Goods::all();
        return view('home.index',compact('type','lunbo','topNav'));
    }

    public function goodsList(Request $request,$id)
    {
        if($request->has('order')){

            $goods=Goods::where('type',$id)->orderBy($request->input('order'),'desc')->paginate(12);
        }else{
            $goods=Goods::where('type',$id)->orderBy('sale')->orderBy('saleNum')->paginate(12);
        }
        //return $goods;
        $count=Goods::where('type',$id)->count();
        return view('home.search',compact('goods','count'));
    }

    public function goods($id)
    {
        $goods=Goods::where('id',$id)->firstOrFail();
        $img=explode(',',$goods->imgs);
        return view('home.goods',compact('goods','img'));
    }

    public function cartAdd(Request $request)
    {
        $goods=Goods::find($request->input('goods'));
        $user=Auth::user();
    }
}
