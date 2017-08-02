<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GouwuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request);
            
        $ido = $request->input();
        $idr = $ido['canshu'];
        $idp = ltrim($idr,",");
        $id = explode(',',$idp);
        $num = $ido['shuliang'];
        $sum = $ido['zongjia'];

        //dd($id);

       $arr =  DB::table('shopping_cart')
                     ->join('goods','shopping_cart.gid','=','goods.id')
                     ->join('goods_photo','goods_photo.gid','=','goods.id')
                     ->where('goods_photo.index','=',2)
                     ->wherein('shopping_cart.id',$id)
                     ->select('goods.gname','goods.price','goods_photo.gimage','shopping_cart.number','shopping_cart.id')
                     ->get();
       //dd($arr);

        return view('home.goods.goodsOrder',['arr'=>$arr,'num'=>$num,'sum'=>$sum,'idp'=>$idp]);
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
       
       //dd($id);
        $arr = DB::table('shopping_cart')
                ->join('goods','shopping_cart.gid','=','goods.id')
                ->join('goods_photo','goods_photo.gid','=','goods.id')
                ->where('shopping_cart.uid','=',$id)
                ->where('goods_photo.index','=',1)
                ->select('goods.gname','goods.price','goods_photo.gimage','shopping_cart.number','shopping_cart.id')
                ->get();
        // dd($arr);
        return view('home.user.gouwu',['arr'=>$arr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = DB::table('shopping_cart')->where('id',$id)->delete();
       
        if(count($res)>0){
            echo json_encode('删除成功');
        }


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
