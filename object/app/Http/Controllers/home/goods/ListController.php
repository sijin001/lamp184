<?php

namespace App\Http\Controllers\home\goods;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ListController extends Controller
{
    /**
     * 展示所有商品列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = DB::table('goods_type')->get();
        // dd($type);
        $where = [];
        $ob = DB::table('goods')
            ->join('goods_photo', 'goods_photo.gid', '=', 'goods.id')
            ->where('goods_photo.index',2);
            // ->get()
            // ->paginate(5);
        if ($request->has('gname')) {
            // 获取搜索条件
            $name = $request->input('gname');
            // 添加到数组中
            $where['gname'] = $name;
            $ob->where('gname', 'like', '%' . $name . '%');
        }
        $list = $ob->paginate(8);
        // dd($list);
        return view('home.goods.goodsList',['list' => $list,'where' => $where,'type' => $type]);
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
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $type = DB::table('goods_type')->get();
        // dd($type);
        $where = [];
        $ob = DB::table('goods')
            ->join('goods_photo', 'goods_photo.gid', '=', 'goods.id')
            ->where('goods_photo.index',2);
            // ->get()
            // ->paginate(5);
        if ($request->has('gname')) {
            // 获取搜索条件
            $name = $request->input('gname');
            // 添加到数组中
            $where['gname'] = $name;
            $ob->where('gname', 'like', '%' . $name . '%');
        }
        $list = $ob->paginate(8);
        // dd($list);
        return view('home.goods.goodsList',['list' => $list,'where' => $where,'type' => $type]);  
    }

    /**
     * 显示所属分类下的全部商品的列表页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // dd($id);
        $type = DB::table('goods_type')->where('id', $id)->first();
        // dd($type);
        $where = [];
        $ob = DB::table('goods')->where('goods_type.id',$id)
            ->join('goods_type', 'goods_type.id', '=', 'goods.tid')
            ->join('goods_photo', 'goods_photo.gid', '=', 'goods.id')
            ->where('goods_photo.index',2);
            // ->get();
        // dd($ob);
        if ($request->has('gname')) {
            // 获取搜索条件
            $name = $request->input('gname');
            // 添加到数组中
            $where['gname'] = $name;
            $ob->where('gname', 'like', '%' . $name . '%');
        }
        $list = $ob->paginate(8);
        return view('home.goods.typesList', ['type' => $type,'list' => $list,'where' => $where]);
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
