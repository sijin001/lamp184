<?php

namespace App\Http\Controllers\admin\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShowController extends Controller
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
    
    public function show($id)
    {
         $user = DB::table('administrator')->where('id', $id)->first();
        return view('admin.adminuser.edit', ['user'=>$user]);
    }

    public function updato(Request $request, $id)
    {
        //
    }

   public function showgl()
   {
    //
   }

}
