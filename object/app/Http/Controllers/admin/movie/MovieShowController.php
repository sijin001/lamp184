<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieShowController extends Controller
{
    /**
     * 后台电影场次列表展示.
     *
     */
    public function index(Request $request)
    {
        //保存搜索条件
        $where = [];
        $arr = [];
        //实例化show表
        $ob = DB::table('show')
            ->join('movie','show.mid','=','movie.id')
            ->join('movie_room','show.rid','=','movie_room.id')
            ->select('show.*','movie.title','movie_room.rname');

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
        $shows = $ob->paginate(10);

        $movies = DB::table('movie')->select('id','title')->where('status',1)->get();
        $rooms = DB::table('movie_room')->select('id','rname')->get();
        $show = DB::table('show')->distinct()->get();

        return view('admin.movie.movie_show',['movies'=>$movies,'rooms'=>$rooms,'shows'=>$shows,'where'=>$where,'show'=>$show,'arr'=>$arr]);
    }

    /**
     * 后台电影场次添加.
     *
     */
    public function store(Request $request)
    {
        //自定义错误信息格式
        $messages = array(
            'mid.required'=>'电影必须选择',
            'date.required'=>'日期必须填写',
            'time.required'=>'时间必须填写',
            'rid.required'=>'影厅必须选择',
            'price.required'=>'价格必须填写'
        );

        //表单自动验证(用户提交的请求数据，验证规则，自定义的错误信息)
        $this->validate($request,[
            'mid' => 'required',
            'date' => 'required',
            'time' => 'required',
            'rid' => 'required',
            'price' => 'required'
        ],$messages);

        $arr = $request->except('_token');
        $id = DB::table('show')->insertGetId($arr);
        if($id > 0){
            return redirect('/admin/movieshow')->with('msg','添加成功');
        }else{
            return redirect('/admin/movieshow')->with('msg','添加失败');
        }
    }

    /**
     * 电影场次更改.
     *
     */
    public function doChange(Request $request)
    {
        $arr = $request->except('_token');
        $arr1[$request['name']] = $request['value'];
        $res = DB::table('show')->where('id',$arr['id'])->update($arr1);
        echo json_encode($arr1);
    }
    
    /**
     * 后台电影场次删除.
     *
     */
    public function destroy($id)
    {
        DB::table('movie_order')->where('sid',$id)->delete();
        $res = DB::table('show')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/admin/movieshow')->with('msg','删除成功');
        }else{
            return redirect('/admin/movieshow')->with('msg','删除失败');
        }
    }
}
