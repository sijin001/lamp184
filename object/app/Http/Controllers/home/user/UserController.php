<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 显示用户基本信息页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        return view('home.user.userInfo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * 修改个人信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   //接收add页面提交,删除token和method
        $arr = $request->except('_token','_method');

        //判断图片上传
        if ($request->hasFile('photo')) {
            // 判断文件是否有效
            if ($request->file('photo')->isValid()) {
                //生成上传文件对象
                $file = $request->file('photo');
            }
            //获取源文件的后缀
            $ext = $file->getClientOriginalExtension();
            //生成一个新文件名
            $picname = time().rand(1000,9999).'.'.$ext;
            //移动文件
            $file->move('./admin/upload/photo', $picname);
            // dd($file->getError());
            if($file->getError() > 0){
                // return redirect('/uploads')->with('msg', '上传失败');
                echo '上传失败';
            }else{
                // return redirect('/uploads')->with('msg', '上传成功');
                //echo '图片提交成功';
                //上传的图片提交到arr数组
                $arr['photo'] = $picname; 
                
            }
        }

        $res = DB::table('user')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('home/user')->with('msg','修改成功');
        }else{
            return redirect('home/user')->with('msg','修改失败');
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
}
