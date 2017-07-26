<?php

namespace App\Http\Controllers\admin\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
class MovieController extends Controller
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
        $ob = DB::table('movie');

        $arr['hot'] = $request->input('hot');
        $arr['new'] = $request->input('new');
        $arr['status'] = $request->input('status');
        //判断请求中否有hot字段
        if($request->has('hot')){
            //获取搜索条件
            $hot = $request->input('hot');
            //添加到将要带到分页中的数组
            $where['hot'] = $hot;
            //给查询语句添加where条件
            $ob->where('hot',$hot);
        }

        if($request->has('new')){
            $new = $request->input('new');
            $where['new'] = $new;
            $ob->where('new',$new);
        }

        if($request->has('status')){
            $status = $request->input('status');
            $where['status'] = $status;
            $ob->where('status',$status);
        }

        $movies = $ob->paginate(5);
       // dd($arr);
        return view('admin.movie.movie_test',['movies'=>$movies,'where'=>$where,'arr'=>$arr]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movie.movie_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //自定义错误消息格式
        $messages = array(
            'title.required' => '用户名必须填写',
            'showtime.required' => '上映时间必须填写',
            'country.required' => '国家必须填写',
            'director.required' => '导演必须填写',
            'star.required' => '主演必须填写',
            'type.required' => '类型必须填写',
            'format.required' => '版本必须填写',
            'length.required' => '长度必须填写',
            'hot.required' => '热度必须填写',
            'new.required' => '最新必须填写',
            'status.required' => '是否上映必须填写',
            'des.required' => '剧情简介必须填写'
        );

        //表单自动验证（用户提交的请求数据，验证规则，自定义的错误消息）
        $this->validate($request, [
            'title' => 'required',
            'showtime' => 'required',
            'country' => 'required',
            'director' => 'required',
            'star' => 'required',
            'type' => 'required',
            'format' => 'required',
            'length' => 'required',
            'hot' => 'required',
            'new' => 'required',
            'status' => 'required',
            'des' => 'required'
        ],$messages);

        if ($request->hasFile('poster')) {
            // 判断文件是否有效
            if ($request->file('poster')->isValid()) {
                //生成上传文件对象
                $file = $request->file('poster');
            }
            //获取源文件的后缀
            $ext = $file->getClientOriginalExtension();
            //生成一个新文件名
            $postername = 'poster'.time().'.'.$ext;
            //移动文件
            $file->move('./admin/upload/movie', $postername);
            // dd($file->getError());
            if($file->getError() > 0){
                // return redirect('/uploads')->with('msg', '上传失败');
                echo '上传失败';
            }else{
                // return redirect('/uploads')->with('msg', '上传成功');
                echo '上传成功';
            }
        }
         
        if ($request->hasFile('images')) {
            // 判断文件是否有效
            if ($request->file('images')->isValid()) {
                //生成上传文件对象
                $file = $request->file('images');
            }
            //获取源文件的后缀
            $ext = $file->getClientOriginalExtension();
            //生成一个新文件名
            $imagesname = 'images'.time().'.'.$ext;
            //移动文件
            $file->move('./admin/upload/movie', $imagesname);
            // dd($file->getError());
            if($file->getError() > 0){
                // return redirect('/uploads')->with('msg', '上传失败');
                echo '上传失败';
            }else{
                // return redirect('/uploads')->with('msg', '上传成功');
                echo '上传成功';
            }
        }
        
        if ($request->hasFile('title_pic')) {
            // 判断文件是否有效
            if ($request->file('title_pic')->isValid()) {
                //生成上传文件对象
                $file = $request->file('title_pic');
            }
            //获取源文件的后缀
            $ext = $file->getClientOriginalExtension();
            //生成一个新文件名
            $titlepicname = 'title_pic'.time().'.'.$ext;
            //移动文件
            $file->move('./admin/upload/movie', $titlepicname);
            // dd($file->getError());
            if($file->getError() > 0){
                // return redirect('/uploads')->with('msg', '上传失败');
                echo '上传失败';
            }else{
                // return redirect('/uploads')->with('msg', '上传成功');
                echo '上传成功';
            }
        }

        $arr = $request->except('_token');
        $arr['poster'] = $postername;
        $arr['images'] = $imagesname;
        $arr['title_pic'] = $titlepicname;
       // dd($arr);
        $id = DB::table('movie')->insertGetId($arr);
        if($id > 0){
            return redirect('/movie')->with('msg', '添加成功');
        }
    }

    public function doChange(Request $request)
    {
        //获取传过来的值
        $arr = $request->except('_token');
        //将传过来的值设为数组
        $arr1[$request['name']] = $request['value'];
        //执行修改
        $res = DB::table('movie')->where('id',$arr['id'])->update($arr1);
        echo json_encode($arr1);
    }


    public function destroy($id)
    {
        $list = DB::table('show')->select('id')->where('mid',$id)->get();
        for ($i=0; $i < count($list); $i++) { 
            $b = DB::table('movie_order')->where('sid',$list[$i]->id)->delete();
        }
        $a = DB::table('show')->where('mid',$id)->delete();
        
        $c = DB::table('comment')->where('mid',$id)->delete();
        $res = DB::table('movie')->where('id',$id)->delete();
        if($res > 0) {
            return redirect('/movie')->with('msg','删除成功');
        }else{
            return redirect('/movie')->with('msg','删除失败');
        }
    }
}
