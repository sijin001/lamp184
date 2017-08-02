<?php

namespace App\Http\Controllers\admin\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class AdminUserController extends Controller
{
    /**
     * 显示管理员列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('administrator')->paginate(3);
        // dd($user);
        $now = $user->currentPage();
        return view('admin.adminuser.index',['user'=>$user,'now'=>$now]);
    }

    /**
     * 显示添加管理员页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminuser.add');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->except('_token');
        $id = DB::table('administrator')->insertGetId($arr);
        if($id > 0){
            return redirect('admin/adminuser')->with('msg','添加成功');
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
        //
    }

    /**
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $user = DB::table('administrator')->where('id', $id)->first();
        return view('admin.adminuser.edit', ['user'=>$user]);
    }

    /**
     * 数据库执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $arr = $request->except('_token','_method');
        // dd($arr);
        
        $res = DB::table('administrator')->where('id',$id)->update($arr);
        // dd($res);
        if($res > 0){
            return redirect('/admin/adminuser')->with('msg', '修改成功');
        }else{
            return redirect('/admin/adminuser')->with('error', '修改失败');
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
        $res = DB::table('administrator')->where('id',$id)->delete();
        // dd($res);
        if($res > 0){
            return redirect('/admin/adminuser')->with('msg', '删除成功');
        }else{
            return redirect('/admin/adminuser')->with('error', '删除失败');
        }
    }
}
