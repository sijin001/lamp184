<?php

namespace App\Http\Controllers\admin\link;

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
        $ob = DB::table('link');
        
        if($request->has('tilte')){
            //获取搜索框input的条件
            $name = $request->input('title');
            //将要带到分页中的数组
            $where['title'] = $title;
            //给查询语句添加where条件
            $ob->where('title','like','%'.$title.'%');
        }
        
        
        //执行分页查询
        $list = $ob->paginate(3);

        //加载模板时，把查询数据以及分页需要携带的参数传到模板页面上
        return view('admin.link.index',['list' => $list,'where'=>$where]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->except('_token');
       $id = DB::table('link')->insertGetId($arr);
       if($id > 0){
        return redirect('admin/link')->with('msg','添加成功');
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
       $link = DB::table('link')->where('id', $id)->first();
        return view('admin.link.edit', ['link'=>$link]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $arr = $request->except('_token','_method');
        //dd($arr);
        

        
        $res = DB::table('link')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('admin/link')->with('msg', '修改成功');
        }else{
            return redirect('admin/link')->with('error', '修改失败');
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
        DB::table('link')->whereIn('id',$data)->delete();
        echo json_encode($data);
       
    }
}

