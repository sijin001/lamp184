<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
class MovieRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movierooms = DB::table('movie_room')->get();
        return view('admin.movie.movie_room',['movierooms'=>$movierooms]);
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
        $messages = array(
            'rname.required'=>"影厅名不能为空！",
            'number.required'=>"数量不能为空！"
            );
        $this->validate($request, [
            'rname'=>'required',
            'number'=>'required'
            ],$messages);
        $arr = $request->except('_token');

        $id = DB::table('movie_room')->insertGetId($arr);
        if($id > 0){
            return redirect('/movieroom')->with('msg','添加成功');
        }

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

    public function doChange(Request $request)
    {
        $arr = $request->except('_token');
        $arr1[$request['name']] = $request['value'];
        $res = DB::table('movie_room')->where('id',$arr['id'])->update($arr1);
        echo json_encode($arr1);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = DB::table('show')->select('id')->where('rid',$id)->get();
        for ($i=0; $i < count($list); $i++) { 
            $b = DB::table('movie_order')->where('sid',$list[$i]->id)->delete();
        }
        $a = DB::table('show')->where('rid',$id)->delete();
        $res = DB::table('movie_room')->where('id', $id)->delete();
        if($res > 0){
            return redirect('/movieroom')->with('msg','删除成功！');
        }else{
            return redirect('/movieroom')->with('msg','删除失败！');
        }
    }
}
