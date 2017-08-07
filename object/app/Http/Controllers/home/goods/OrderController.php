<?php

namespace App\Http\Controllers\home\goods;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class OrderController extends Controller
{
    /**
     * 购买商品进入填写订单页面
     *
     * @return 
     */
    public function index()
    {
        // echo $_GET['num'];
        // echo $_GET['id'];
        echo "/home/goodsorder/".$_GET['id'].'?number='.$_GET['num'];
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
     * 商品添加购物车
     *
     * @param  
     * @return 
     */
    public function store(Request $request)
    {   
        // echo $_POST['id'];
        // echo $_POST['num'];
        $res = DB::table('shopping_cart')->insertGetId(
            ['uid'=>session('user')->id, 'gid'=>$_POST['id'], 'number'=>$_POST['num']]
        );
        $str = '添加购物车成功';
        echo json_encode($str);        
    }
    /**
     * 商品立即购买，进入填写订单页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($_GET['number']);
        $arr = DB::table('goods')->where('goods.id',$id)
            ->join('goods_photo','goods_photo.gid','=','goods.id')
            ->where('goods_photo.index',2)
            ->get();
         $arr['0']->number  = $_GET['number'];

         $sum = $_GET['number']*$arr['0']->price;
         //dd($sum);

        return view('home.goods.goodsOrder',['arr' => $arr,'num'=>$_GET['number'],'sum'=>$sum,'idp'=>$id]);
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

    public function doGet(Request $request)
    {
        $list = DB::table('district')->where('upid',$request->input('upid'))->get();
        echo json_encode($list);
    }

    public function doPost(Request $request)
    {
        $list = DB::table('district')->where('upid',$request->input('upid'))->get();
        echo json_encode($list);
    }
}
