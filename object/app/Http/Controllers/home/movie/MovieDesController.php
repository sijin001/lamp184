<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieDesController extends Controller
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
             return redirect('/home/movie/description/'.$list['mid'])->with('msg','添加成功');
        }else{
            return redirect('/home/movie/description/'.$list['mid'])->with('msg','添加失败');
        }
    }

    /**
     *显示评论.
     *
     * @return 评论信息
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
        return view('home.movie.movie_des',['movies'=>$movies,'comments'=>$comments]);
    }
}
