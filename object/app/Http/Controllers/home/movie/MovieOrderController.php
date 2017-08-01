<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use session;
use DB;

class MovieOrderController extends Controller
{

    /**
     * 订单展示.
     *
     */
    public function store(Request $request)
    {
        $arr = $request->except('_token');

        $list = DB::table('show')
            ->where('show.id',$arr['myshowid'])
            ->join('movie_room','movie_room.id','=','show.rid')
            ->join('movie','movie.id','=','show.mid')
            ->select('show.*','movie_room.rname','movie.title','movie.country','movie.format','movie.length','movie.title_pic')
            ->get();
        return view('home.movie.movie_order',['list'=>$list,'arr'=>$arr]);
    }

}
