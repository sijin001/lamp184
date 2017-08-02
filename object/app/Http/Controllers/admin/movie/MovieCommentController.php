<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieCommentController extends Controller
{
    /**
     * 后台电影评论列表.
     *
     */
    public function index(Request $request)
    {
        $where = [];
        $arr = [];
        //将传过来的值存入数组返回
        $arr['mid'] = $request->input('mid');


        $ob = DB::table('comment')
            ->join('movie','comment.mid','=','movie.id')
            ->join('user','comment.uid','=','user.id')
            ->select('comment.*','movie.title','user.name');

        if($request->has('mid')){
            $mid = $request->input('mid');
            $where['mid'] = $mid;
            $ob->where('mid',$mid);
        }

        //执行搜索分页
        $comments = $ob->paginate(10);

        $movies = DB::table('movie')->select('id','title')->get();
        $users = DB::table('user')->select('id','name')->get();

        return view('admin.movie.movie_comment',['comments'=>$comments,'movies'=>$movies,'users'=>$users,'arr'=>$arr,'where'=>$where]);
    }

    /**
     * 后台电影评论删除.
     *
     */
    public function destroy($id)
    {
        $res = DB::table('comment')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/admin/moviecomment')->with('msg','删除成功');
        }else{
            return redirect('/admin/moviecomment')->with('msg','删除失败');
        }
    }
}
