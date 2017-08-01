<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Article_type;
use App\Http\Controllers\Controller;
use App\Translate\Translate;
use App\Translate\TranslateTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   =   Article::join('article_types as t',function ($jion){
            $jion->on('articles.tid','=','t.id');
        })->get();

        return view('admin.article.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type   =   Article_type::with('child')->get();

        return view('admin.article.add',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data   =   $request->all();
        $to = new TranslateTitle();
        $data['url']    =   $to->translateTitle($data['title']);
        Article::create($data);

        return ['s'=>1,'text'=>'增加成功！'];
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
        $data   =   Article::join('article_types','articles.tid','=','article_types.id')->where('url',$id)->get();
        $type   = Article_type::with('child')->get();

        return view('admin.article.edit',compact('data'));
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
        //
    }
}
