<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use App\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   =   $this->getPosition(Ad::all());

        return view('admin.ad.ad_index',compact('data'));
    }

    /**
     * get Position name by ad->position_id
     */
    protected function getPosition($data)
    {
        foreach ($data as $key => $d){
            $position   =   Position::findOrFail($d->position_id);
            $data[$key]['position_name']    =   $position->name;
        }

        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data   =   Position::all();
        return view('admin.ad.ad_create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Ad::create($request->all())){
            return ['s'=>1,'text'=>'增加广告成功!'];
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
    public function edit($id)
    {
        $data   = Position::all();
        $ad     =   Ad::findOrFail($id);

        return view('admin.ad.ad_edit',compact('data','ad'));
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
        $ad =   Ad::findOrFail($id);
        $ad->position_id    =   $request->input('position_id');
        $ad->name   =   $request->input('name');
        $ad->link   =   $request->input('link');
        $ad->code   =   $request->input('code');
        $ad->start_time =   $request->input('start_time');
        $ad->end_time   =   $request->input('end_time');
        $ad->enable =   $request->input('enable');

        if($ad->save()){
            return ['s'=>1,'text'=>'修改成功!'];
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
        if(Ad::destroy($id)){
            return ['s'=>1,'text'=>'删除成功!'];
        }
    }
}
