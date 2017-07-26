<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieGetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $id = 0;
        for ($i=0; $i < count($movies) ; $i++) { 
            $list = DB::table('show')
                ->where('show.mid',$movies[$i]->id)
                ->where('show.date',$date)
                ->join('movie','show.mid','=','movie.id')
                ->join('movie_room','show.rid','=','movie_room.id')
                ->select('show.*','movie.format','movie_room.rname','movie_room.number')
                ->get();
            $arr[$movies[$i]->title] = $list; 
        }
        return view('home.movie.movie_get',['movies'=>$movies,'movie'=>$movie,'arr'=>$arr,'date'=>$date,'id'=>$id]);
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
        // var_dump($_GET['date']);
        $where = [];
        $arr = [];
        if($id != '0'){

            $movie = DB::table('movie')->where('id',$id)->where('status',1)->get();

        }else{
            $movie = DB::table('movie')->where('status',1)->get();
        }
        // var_dump($movie);
        $movies = DB::table('movie')->where('status',1)->get();
        $date = $_GET['date'];
        for ($i=0; $i < count($movie); $i++) { 
            $list = DB::table('show')
                ->where('show.mid',$movie[$i]->id)
                ->where('show.date',$date)
                ->join('movie','show.mid','=','movie.id')
                ->join('movie_room','show.rid','=','movie_room.id')
                ->select('show.*','movie.format','movie_room.rname','movie_room.number')
                ->get(); 
            $arr[$movie[$i]->title] = $list;
        }
        return view('home.movie.movie_get',['movies'=>$movies,'movie'=>$movie,'arr'=>$arr,'date'=>$date,'id'=>$id]);
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
