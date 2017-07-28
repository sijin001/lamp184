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
            ->paginate(5);
        // dd($arr);
        $now = $arr->currentPage();
        return view('admin.goods.shop', ['arr'=>$arr, 'now'=>$now]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        return view('admin.goods.order');
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
