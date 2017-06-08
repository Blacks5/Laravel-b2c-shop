<?php

namespace App\Http\Controllers\Admin;

use App\Goods;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= Goods::all();
        return view('admin.goods.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = Type::with('childrenType')->orderBy('short')->get();
        return view('admin.goods.goods_add',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $goods= Goods::create($request->all());
        if($goods){
            return $msg=['s'=>1,'text'=>'增加商品成功!'];
        }


        return $msg=['s'=>0,'text'=>'增加商品失败!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax()){
            $rs=DB::table('goods')->where('id',$id)->update([$request->input('action')=>$request->input('value')]);
            if($rs){
                return $msg=['s'=>1,'text'=>'修改成功!'];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rs= Goods::destroy($id);
        if($rs){
            return $msg=['s'=>1,'text'=>'删除成功!'];
        }
    }
}
