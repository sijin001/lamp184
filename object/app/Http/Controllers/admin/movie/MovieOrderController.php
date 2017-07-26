<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //保存搜索条件
        $where = [];
        $arr = [];
        //实例化show表
        $ob = DB::table('movie_order')
            ->join('user','movie_order.uid','=','user.id')
            ->join('show', 'movie_order.sid','=','show.id')
            ->join('movie_room', 'show.rid','=','movie_room.id')
            ->join('movie','show.mid','=','movie.id')
            ->select('movie_order.id','movie_order.number','movie_order.seat','movie.title','show.date','show.time','show.price','movie_room.rname','user.user');

        $arr['mid'] = $request->input('mid');
        $arr['date'] = $request->input('date');
        $arr['time'] = $request->input('time');
        $arr['rid'] = $request->input('rid');
        //判断请求中否有mid字段
        if($request->has('mid')){
            //获取搜索条件
            $mid = $request->input('mid');
            //添加到将要带到分页中的数组
            $where['mid'] = $mid;
            //给查询语句添加where条件
            $ob->where('mid',$mid);
        }

        if($request->has('date')){
            $date = $request->input('date');
            $where['date'] = $date;
            $ob->where('date',$date);
        }

        if($request->has('time')){
            $time = $request->input('time');
            $where['time'] = $time;
            $ob->where('time',$time);
        }

        if($request->has('rid')){
            $rid = $request->input('rid');
            $where['rid'] = $rid;
            $ob->where('rid',$rid);
        }

        //执行分页查询
        $orders = $ob->paginate(10);
        $movies = DB::table('movie')->select('id','title')->get();
        $rooms = DB::table('movie_room')->select('id','rname')->get();
        $show = DB::table('show')->select('id','date','time')->get();
        return view('admin.movie.movie_order', ['orders'=>$orders,'movies'=>$movies,'rooms'=>$rooms,'show'=>$show,'arr'=>$arr]);
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
        $res = DB::table('movie_order')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/movieorder')->with('msg','删除成功!');
        }else{
            return redirect('/movieorder')->with('msg','删除失败!');
        }
    }
}
