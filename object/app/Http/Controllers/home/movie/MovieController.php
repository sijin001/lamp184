<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
class MovieController extends Controller
{
    /**
     * 显示网站前台首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 轮播图
        $res = DB::table('slides')->get();
        
        // 电影
        $movies = DB::table('movie')->where('status','=',1)->get();
        $comovies = DB::table('movie')->where('status','=',2)->get();

        $arr = [];
        // 商品分类
        $type = DB::table('goods_type')->get();
        
        // 商品
        for($i = 0; $i < count($type); $i++) {
            $list = DB::table('goods')->where('tid', $type[$i]->id)
                ->join('goods_photo', 'goods_photo.gid', '=', 'goods.id')
                ->where('goods_photo.index',1)
                ->get();  
            $arr[$type[$i]->tname] = $list;
        }

        return view('home.index',['res' => $res, 'movies' => $movies,'comovies' => $comovies,'type' => $type, 'arr' => $arr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
