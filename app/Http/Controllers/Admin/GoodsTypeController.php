<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GoodsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $data=Type::all();
        $data= Type::with('childrenType')->orderBy('short')->get();
        //return $data;
        return view('admin.goods.type',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pid)
    {
        return view('admin.goods.type_add',compact('pid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $depth = 1;
        if($request->input('pid')!=0){
            $p=Type::find($request->input('pid'));
            $depth = $p->depth+1;
        }
        $types= new Type();
        $types->name=$request->input('name');
        $types->pid=$request->input('pid');
        $types->depth=$depth;
        $types->show=$request->input('show');
        if($types->save()){
            return $msg=['s'=>1,'text'=>'增加分类成功!'];
        }
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
    public function edit($id,Request $request)
    {
        $types=DB::table('types')->where('id',$id)->update([$request->input('action')=>$request->input('value')]);
        if($types){
            return $msg=['s'=>1,'text'=>'修改成功!'];
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Type::destroy($id)){
            return $msg=['s'=>1,'text'=>'删除成功!'];
        }
    }
}
