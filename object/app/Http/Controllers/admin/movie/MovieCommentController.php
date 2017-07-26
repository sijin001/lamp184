<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            ->select('comment.*','movie.title','user.user');

        if($request->has('mid')){
            $mid = $request->input('mid');
            $where['mid'] = $mid;
            $ob->where('mid',$mid);
        }

        //执行搜索分页
        $comments = $ob->paginate(10);

        $movies = DB::table('movie')->select('id','title')->get();
        $users = DB::table('user')->select('id','user')->get();

        return view('admin.movie.movie_comment',['comments'=>$comments,'movies'=>$movies,'users'=>$users,'arr'=>$arr]);
    }

   
    public function destroy($id)
    {
        $res = DB::table('comment')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/moviecomment')->with('msg','删除成功');
        }else{
            return redirect('/moviecomment')->with('msg','删除失败');
        }
    }
}
