<?php

namespace App\Http\Controllers\admin\user;

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
        $ob = DB::table('user');
        
        if($request->has('name')){
            //获取搜索框input的条件
            $name = $request->input('name');
                        //将要带到分页中的数组
                        $where['name'] = $name;
            //给查询语句添加where条件
            $ob->where('name','like','%'.$name.'%');
        }
        
        //作用同上
        if($request->has('sex')){
            $sex = $request->input('sex');
            $where['sex'] = $sex;
            $ob->where('sex',$sex);
        }
        //执行分页查询
        $list = $ob->paginate(3);
        $now = $list->currentPage();

        //加载模板时，把查询数据以及分页需要携带的参数传到模板页面上
        return view('admin.user.index',['list' => $list,'where'=>$where,'now'=>$now]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
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
       $id = DB::table('user')->insertGetId($arr);
       if($id > 0){
        return redirect('admin/user')->with('msg','添加成功');
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

        $user = DB::table('user')->where('id', $id)->first();
        return view('admin.user.edit', ['user'=>$user]);
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
        

        
        $res = DB::table('user')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('admin/user')->with('msg', '修改成功');
        }else{
            return redirect('admin/user')->with('error', '修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( )
    {
        //return 1111111;
        
    }

    public function delo(Request $request )
    {
        $data = explode('###', $request->input('del'));
        DB::table('user')->whereIn('id',$data)->delete();
       // echo json_encode($data);
       
    }
}
