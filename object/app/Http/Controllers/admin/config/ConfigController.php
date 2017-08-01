<?php

namespace App\Http\Controllers\admin\config;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class ConfigController extends Controller
{
    /**
     * 显示网站配置页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = DB::table('config')->first();
        // dd($config);
        return view('admin.config.index', ['config' => $config]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doConfig(Request $request, $id)
    {
        // dd($request);
        // 获取旧图片
        $request->input('wstatus') == 0;
        $old = $request->input('photo');
        $arr = $request->except('_token','photo');
        // dd($arr);
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                $file = $request->file('logo');
                // dd($file);
            }
            $ext = $file->getClientOriginalExtension();
            $logoname = time() . rand(1000,9999) . '.' . $ext;
            // dd($logoname);
            $file->move('./admin/upload/config', $logoname);
            if ($file->getError() > 0) {
                echo '上传失败';
            } else {
                echo '上传成功';
            }
        }
        $arr['logo'] = $logoname;
        // dd($arr);
        // 执行修改
        $res = DB::table('config')->where('id', 1)->update($arr);
        // dd($res);
        // 删除旧图片
        unlink('./admin/upload/config/'.$old);
        if ($res > 0) {
            return redirect('/admin/config')->with('msg', '修改成功');
        }else{
            return redirect('/admin/config')->with('error', '修改失败');
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
