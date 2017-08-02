<?php

namespace App\Http\Controllers\home\goods;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ConfirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request);
        // $arr = $request->except('_token', 'city');
        $arr = [];
        $arr['uid'] = $request->input('uid');
        $arr['gid'] = $request->input('gid');
        $arr['sname'] = $request->input('myname');
        $arr['site'] = $request->input('address');
        $arr['number'] = $request->input('mynumber');
        $arr['time'] = $request->input('time');
        $arr['sendtime'] = $request->input('sendtime');
        $arr['phone'] = $request->input('phone');
        $arr['prices'] = $request->input('myprice');

        //dd($arr);
        $reso = DB::table('user')->where('id',$arr['uid'])->update(['score'=>$arr['prices']]);
        $res = DB::table('goods_order')->insertGetId($arr);
        // dd($arr);
        // if($res > 0){
        //     return redirect('')
        // }

        return view('home.goods.orderConfirm' ,['arr' => $arr]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $res = explode('&',$id);
        // dd($res);
        
        $arr = DB::table('goods')->where('goods.id',$res[0])
            // ->join('goods_photo','goods_photo.gid','=','goods.id')
            ->first();
        
        $num = $res[1];
        // dd($num);
        // dd($list);
        return view('home.goods.orderConfirm', ['arr' => $arr, 'num' => $num]);
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

    public function doSuccess($id) 
    {
        //var_dump($id);
        $ido =  explode(',',$id);
        $del = DB::table('shopping_cart')->wherein('id',$ido)->delete();
       // dd($del);
        return view('home.goods.orderSuccess');
    }
}
