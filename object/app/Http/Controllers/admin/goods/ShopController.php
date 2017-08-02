<?php

namespace App\Http\Controllers\admin\goods;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ShopController extends Controller
{
    /**
     * 显示购物车列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = DB::table('shopping_cart')
            ->join('goods', 'shopping_cart.gid', '=', 'goods.id')
            ->join('user', 'user.id', '=', 'shopping_cart.uid')
            ->join('goods_photo', 'goods_photo.gid', '=', 'shopping_cart.gid')
            ->where('goods_photo.index', 2)
            ->paginate(5);
        // dd($arr);
        $now = $arr->currentPage();
        return view('admin.goods.shop', ['arr'=>$arr, 'now'=>$now]);
    }

    /**
     * 显示商品订单列表
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        $order = DB::table('goods_order')
            ->join('user', 'user.id', '=', 'goods_order.uid')
            ->select('goods_order.*', 'user.name', 'user.score')
            ->orderBy('goods_order.time', 'desc')
            ->paginate(5);
        // dd($order);
        $now = $order->currentPage();
        return view('admin.goods.order', ['order' => $order, 'now'=>$now]);
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
     * 删除订单
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $res = DB::table('goods_order')->where('id', $id)->delete();
        // dd($res);
        if($res > 0){
            return redirect('/admin/order')->with('msg', '删除成功');
        }else {
            return redirect('/admin/order')->with('error', '删除失败');
        }
    }
}
