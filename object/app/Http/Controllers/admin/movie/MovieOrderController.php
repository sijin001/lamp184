<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieOrderController extends Controller
{
    /**
     * 后台电影订单列表.
     *  搜索分页
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
            ->select('movie_order.id','movie_order.number','movie_order.seat','movie.title','show.date','show.time','show.price','movie_room.rname','user.name');

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
        $showDate = DB::table('show')->select('date')->distinct()->get();
        $showTime = DB::table('show')->select('time')->distinct()->get();
        return view('admin.movie.movie_order', ['orders'=>$orders,'movies'=>$movies,'rooms'=>$rooms,'showDate'=>$showDate,'showTime'=>$showTime,'arr'=>$arr,'where'=>$where]);
    }

    /**
     * 后台电影订单删除.
     *
     */
    public function destroy($id)
    {
        $res = DB::table('movie_order')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/admin/movieorder')->with('msg','删除成功!');
        }else{
            return redirect('/admin/movieorder')->with('msg','删除失败!');
        }
    }
}
