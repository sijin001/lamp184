<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ToMovieDesController extends Controller
{
    /**
     * 添加评论.
     *
     */
    public function store(Request $request)
    {
        $list = $request->except('_token');
        $res = DB::table('comment')->insertGetId($list);
        if($res > 0){
            return redirect('/home/movie/toDescription/'.$list['mid'])->with('msg','添加成功');
        }else{
            return redirect('/home/movie/toDescription/'.$list['mid'])->with('msg','添加失败');
        }
    }

    /**
     * 即将上映电影列表.
     *
     */
    public function show($id)
    {
        $movies = DB::table('movie')->where('id','=',$id)->get();
        $ob = DB::table('comment')
            ->where('mid',$id)
            ->join('user','user.id','=','comment.uid')
            ->select('user.name','user.photo','comment.ctime','comment.content')
            ->orderBy('comment.ctime', 'desc');
        //执行搜索分页
        $comments = $ob->paginate(10);
        return view('home.movie.tomovie_des',['movies'=>$movies,'comments'=>$comments]); 
    }

}
