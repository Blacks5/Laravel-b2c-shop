<?php

namespace App\Http\Controllers\Admin;

use App\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{

    /*
     * show position view
     */
    public function position()
    {
        $data   =   $this->positionType(Position::all());

        return view('admin.ad.position',compact('data'));
    }

    /*
     * return 1=>图片 2=>flash    3=>js   4=>文字
     */
    protected function positionType($data)
    {
        foreach ($data as $key => $d){
            if($d->type == 1){
                $data[$key]['type'] =   '图片';
            }elseif ($d->type == 2){
                $data[$key]['type'] =  'flash';
            }elseif($d->type    ==  3){
                $data[$key]['type'] =  'js';
            }else{
                $data[$key]['type'] =  '文字';
            }
        }

        return $data;
    }
    /*
     * position add view
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $create =   Position::create($request->all());
            if($create){
                return ['s'=>1,'text'=>'增加广告位成功!'];
            }
            return ['s'=>0,'text'=>'增加广告位失败!'];
        }

        return view('admin.ad.position_create');
    }

    /*
     * $id edit
     */
    public function edit($id)
    {
        $data   =   Position::findOrFail($id);

        return view('admin.ad.position_edit',compact('data'));
    }

    /*  修改广告位   */
    public function update(Request $request)
    {
        $position   = Position::findOrFail($request->input('id'));
        $position->name =   $request->input('name');
        $position->width    =   $request->input('width');
        $position->height   =   $request->input('height');
        $position->type =   $request->input('type');
        $position->desc =   $request->input('desc');
        $position->enable   =   $request->input('enable');
        if($position->save()){
            return ['s'=>'1','text'=>'修改成功!'];
        }
        return ['s'=>'0','text'=>'修改失败!'];
    }

    /*  删除广告位 by id */
    public function destroy($id)
    {
        if(Position::destroy($id)){
            return ['s'=>1,'text'=>'删除成功!'];
        }
        return ['s'=>0,'text'=>'删除失败!'];
    }
}
