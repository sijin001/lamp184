<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
class HomeController extends Controller
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
                ->orderBy('goods.id','desc')
                ->limit(6)
                ->get();  
            $arr[$type[$i]->tname] = $list;
        }

        //广告
        $ads = DB::table('ads')->orderBy('id','desc')->limit(3)->get();
        //链接
        $link = DB::table('link')->get();
         //$link= \view::share($linko);
        
        session(['link'=>$link]);
            // $ooo=session('link');
            //  dd($ooo);
        
        // 网站配置
        $config = DB::table('config')->first();
        // dd($config);
        session(['config'=>$config]);
        if($config->wstatus == 1){
            return view('home.404');
        }

        return view('home.index',['res' => $res, 'movies' => $movies,'comovies' => $comovies,'type' => $type, 'arr' => $arr, 'ads' => $ads]);
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
