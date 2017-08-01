<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieGetController extends Controller
{
    /**
     * 默认显示场次页面.
     *
     * @return 当日所有场次
     */
    public function index()
    {

        //创建一个空数组 接收遍历出来的数据
        $arr = [];
        //单独获取电影列表
        $movies = DB::table('movie')->where('status',1)->get();
        //获取电影及场次信息
        $movie = DB::table('movie')->where('status',1)->get();
        //默认显示今日场次
        $date = date("Y-m-d");
        // 默认id为0
        $id = 0;
        $format = 0;
        for ($i=0; $i < count($movies) ; $i++) { 
            $list = DB::table('show')
                ->where('show.mid',$movies[$i]->id)
                ->where('show.date',$date)
                ->join('movie','show.mid','=','movie.id')
                ->join('movie_room','show.rid','=','movie_room.id')
                ->select('show.*','movie.format','movie_room.rname','movie_room.number')
                ->get();
            // 获取对应电影的影评
            $num = DB::table('comment')->where('mid',$movies[$i]->id)->count();
            $movie[$i]->Num = $num;
            $arr[$movies[$i]->title] = $list; 
        }
        return view('home.movie.movie_get',['movies'=>$movies,'movie'=>$movie,'arr'=>$arr,'date'=>$date,'id'=>$id,'format'=>$format]);
    }

    /**
     * 带搜索条件的页面展示.
     *
     */
    public function show($id)
    {

        $arr = [];
        //  如果传过来的id不为0  则返回对应id信息
        $ob = DB::table('movie')->where('status',1);
        if($id != '0') {
            $ob->where('id',$id);
        }

        // 如果传过来的format不为0 则返回对应的信息
        if($_GET['format'] != '0') {
            $ob->where('format',$_GET['format']);
        }
        // 获取当前搜索条件下的电影
        $movie = $ob->get();
        // 获取当日播放的电影列表
        $movies = DB::table('movie')->where('status',1)->get();
        // 获取传过来的日期
        $date = $_GET['date'];
        // 获取传过来的影片类型
        $format = $_GET['format'];
        // 获取具体信息
        for ($i=0; $i < count($movie); $i++) { 
            $list = DB::table('show')
                ->where('show.mid',$movie[$i]->id)
                ->where('show.date',$date)
                ->join('movie','show.mid','=','movie.id')
                ->join('movie_room','show.rid','=','movie_room.id')
                ->select('show.*','movie.format','movie_room.rname','movie_room.number')
                ->get(); 
            // 获取对应电影的影评
            $num = DB::table('comment')->where('mid',$movie[$i]->id)->count();
            $movie[$i]->Num = $num;
            // 获取搜索条件下的场次信息
            $arr[$movie[$i]->title] = $list;
        }
        return view('home.movie.movie_get',['movies'=>$movies,'movie'=>$movie,'arr'=>$arr,'date'=>$date,'id'=>$id,'format'=>$format]);
    }
}
