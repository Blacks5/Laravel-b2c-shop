<?php

namespace App\Http\Controllers\Admin;

use App\Article_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   =   Article_type::with('child')->get();

        return view('admin.article.type_index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data   =   Article_type::with('child')->get();

        return view('admin.article.type_create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data   =   $request->all();
        if(Article_type::create($data)){
            return ['s'=>1,'text'=>'增加成功！'];
        }

        return ['s'=>0,'text'=>'增加失败！'];
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
        if($request->input('action')=='show'){
            $type   =   Article_type::findOrFail($id);
            $type->show   =   $request->input('value');
            if($type->save()){
                return ['s'=>1,'text'=>'修改成功！'];
            }
        }

        if($request->input('action')=='name'){
            $type   =   Article_type::findOrFail($id);
            $type->name =   $request->input('value');
            if($type->save()){
                return ['s'=>1,'text'=>'修改成功！'];
            }
        }

        return ['s'=>0,'text'=>'修改失败！'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Article_type::destroy($id)){
            return ['s'=>1,'text'=>'删除分类成功！'];
        }
        return ['s'=>0,'text'=>'删除失败！'];
    }
}
