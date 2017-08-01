<?php

namespace App\Http\Controllers\admin\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MoControllers extends Controller
{
    /**
     * 显示会员列表页面
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
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // 
        
    }

    /**
     * 显示修改用户页面
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
     * 执行修改会员操作
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
    // 删除会员
    public function delo(Request $request )
    {
        $data = explode('###', $request->input('del'));
        DB::table('user')->whereIn('id',$data)->delete();
       // echo json_encode($data);
       
    }
}
