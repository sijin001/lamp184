<?php

namespace App\Http\Controllers\home\goods;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class GoodsController extends Controller
{
    /**
     * 展示商品页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 轮播图
        $res = DB::table('slides')->get();

        $arr = [];
        $type = DB::table('goods_type')->get();
        // dd($type);
        
        for($i = 0; $i < count($type); $i++) {
            $list = DB::table('goods')->where('tid', $type[$i]->id)
                ->join('goods_photo', 'goods_photo.gid', '=', 'goods.id')
                ->where('goods_photo.index',1)
                ->orderBy('goods.id', 'desc')
                ->limit(6)
                ->get();  
            // dd($list);
            $arr[$type[$i]->tname] = $list;
        }
        // dd($arr);
        return view('home.goods.index', ['type' => $type, 'arr' => $arr, 'res' => $res]);
    
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
     * 展示商品详情页内容
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $photo = DB::table('goods_photo')->where('goods_photo.gid',$id)->where('goods_photo.index','=',3)->get();
        // dd($photo);

        $res = DB::table('goods')->where('goods.id',$id)
            ->join('goods_type','goods_type.id','=','goods.tid')
            ->join('goods_photo','goods_photo.gid','=','goods.id')
            ->where('goods_photo.index','=',2)
            ->first();
        // dd($res);
        return view('home.goods.goodsDetail',['photo' => $photo,'res' => $res]);
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
