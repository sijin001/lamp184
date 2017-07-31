<?php

namespace App\Http\Controllers\admin\ads;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MoControllers extends Controller
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
        //实例化需要的表
        $ob = DB::table('ads');
        
        if($request->has('title')){
            //获取搜索框input的条件
            $title = $request->input('title');
            //将要带到分页中的数组
            $where['title'] = $title;
            //给查询语句添加where条件
            $ob->where('title','like','%'.$title.'%');
        }
        
        
        //执行分页查询
        $ads = $ob->paginate(3);

        //加载模板时，把查询数据以及分页需要携带的参数传到模板页面上
        return view('admin.ads.index',['ads' => $ads,'where'=>$where]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //加载添加页面
        return view('admin.ads.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        //接收add页面提交，操作数据库，带参返回列表页
         $arr = $request->except('_token');
        
        
         //图片上传
        if ($request->hasFile('picture')) {
            // 判断文件是否有效
            if ($request->file('picture')->isValid()) {
                //生成上传文件对象
                $file = $request->file('picture');
            }
            //获取源文件的后缀
            $ext = $file->getClientOriginalExtension();
            //生成一个新文件名
            $picname = time().rand(1000,9999).'.'.$ext;
            //移动文件
            $file->move('./admin/upload/ads', $picname);
            // dd($file->getError());
            if($file->getError() > 0){
                // return redirect('/uploads')->with('msg', '上传失败');
                echo '上传失败';
            }else{
                // return redirect('/uploads')->with('msg', '上传成功');
                //echo '图片提交成功';
                //上传的图片提交到arr数组
                $arr['picture'] = $picname; 
                
            }
        }

        //操作数据库
        $id = DB::table('ads')->insertGetId($arr);
       if($id > 0){
        return redirect('admin/ads')->with('msg','添加成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $ads = DB::table('ads')->where('id', $id)->first();
        return view('admin.ads.edit', ['ads'=>$ads]);
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
        //修改页面
         $arr = $request->except('_token','_method');
        //dd($arr);
        
          //图片上传
        if ($request->hasFile('picture')) {
            // 判断文件是否有效
            if ($request->file('picture')->isValid()) {
                //生成上传文件对象
                $file = $request->file('picture');
            }
            //获取源文件的后缀
            $ext = $file->getClientOriginalExtension();
            //生成一个新文件名
            $picname = time().rand(1000,9999).'.'.$ext;
            //移动文件
            $file->move('./admin/upload/ads', $picname);
            // dd($file->getError());
            if($file->getError() > 0){
                // return redirect('/uploads')->with('msg', '上传失败');
                echo '上传失败';
            }else{
                // return redirect('/uploads')->with('msg', '上传成功');
                //echo '图片提交成功';
                //上传的图片提交到arr数组
                $arr['picture'] = $picname; 
                
            }
        }



        //数据库操作修改
        $res = DB::table('ads')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('admin/ads')->with('msg', '修改成功');
        }else{
            return redirect('admin/ads')->with('error', '修改失败');
        }
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

    public function delo(Request $request )
    {
        $data = explode('###', $request->input('del'));
        DB::table('ads')->whereIn('id',$data)->delete();
       // echo json_encode($data);
       
    }


}
