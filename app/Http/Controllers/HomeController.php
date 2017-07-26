<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Goods;
use App\Type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * @var static Chche Time
     */
    public $expiresAt;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->expiresAt    =   Carbon::now()->addDay(15);
    }

    /**
     * type:goods type;type[$key]['goods']:type goods
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if no type cache then add indexType
        if(!Cache::has('indexType')){
            $type   =   $this->getGoodsByType(Type::with('childrenType')->get());
            Cache::put('indexType',$type,$this->expiresAt);
        }
        //if no lb cache then add
        if(Cache::has('indexLb')){
            $lb =   Ad::where('position_id','1')->where('enable','1')->get();
            Cache::put('indexLb',$lb,$this->expiresAt);
        }
        //if no nav cache then add
        if(Cache::has('indexNav')){
            $nav    =    Ad::where('position_id','3')->where('enable','1')->get();
            Cache::put('indexNav',$nav,$this->expiresAt);
        }

        $type   =   Cache::get('indexType');
        $lb     =   Cache::get('indexLb');
        $nav    =   Cache::get('indexNav');


        return view('home.index',compact('type','lb','nav'));
    }

    /**
     * get goods by type limit 9
     *
     * @param $type
     * @return mixed
     */
    private function getGoodsByType($type){
        foreach ($type as $key => $t){
            if($t->pid==0){
                $goodsId = Type::where('pid',$t->id)->get(['id'])->toArray();
                $type[$key]['goods']    =   Goods::whereIn('type',$goodsId)->limit(9)->get();
            }
        }

       return $type;
    }

    /**
     * get GoodsList
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * goods view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goods($id)
    {
        $goods=Goods::where('id',$id)->firstOrFail();
        $img=explode(',',$goods->imgs);
        return view('home.goods',compact('goods','img'));
    }

    /**
     * add cart
     *
     * @param Request $request
     */
    public function cartAdd(Request $request)
    {
        $goods=Goods::find($request->input('goods'));
        $user=Auth::user();
    }
}
