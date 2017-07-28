<?php

namespace App\Http\Controllers\admin\type;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 保存搜索条件
        $where = [];
        // 实例化需要的表
        // dd('')
        $ob = DB::table('goods_type')
            ->select(DB::raw('concat(path,",",id) as newpath, id, tname, path, upid, series'))
            ->orderBy('newpath');

        // dd($ob);
        // 判断请求中是否有name字段
        if ($request->has('tname')) {
            // 获取搜索条件
            $name = $request->input('tname');
            // 添加到将要带到分页中的数组
            $where['tname'] = $name;
            // 给查询语句添加where条件
            $ob->where('tname', 'like', '%' . $name . '%');
        }
        // 执行分页查询
        $list = $ob->paginate(6);
        $now = $list->currentPage();
        // 加载模板的同时，把查询的条件以及分页时需要携带的参数传到模板上
        return view('admin.type.index', ['list' => $list, 'where' => $where, 'now' => $now]);
    }

    /**
     * 显示添加分类页面.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.add');
    }

    /**
     * 数据库添加分类名：插入数据
     *
     * @param  $id:自动递增的id号
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // 自定义错误消息
        $messages = array(
            'tname.required' => '分类名必须填写',
            'tname.unique' => '分类已存在',
        );

        // 表单自动验证用户提交的请求数据，验证规则，自定义错误信息
        $this->validate($request, ['tname' => 'required|unique:goods_type'], $messages);

        $res = $request->except('_token');
        $id = DB::table('goods_type')->insertGetId($res);
        if ($id > 0) {
            return redirect('/admin/type')->with('msg', '添加成功');
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
     * 从数据表中获取查询取出单行数据,并带到修改视图页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = DB::table('goods_type')->where('id', $id)->first();
        return view('admin.type.edit', ['type' => $type]);
    }

    /**
     * 向数据库提交修改数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = $request->except('_token', '_method');
        $res = DB::table('goods_type')->where('id', $id)->update($arr);
        if ($res > 0) {
            return redirect('/admin/type')->with('msg', '修改成功');
        } else {
            return redirect('/admin/type')->with('error', '修改失败');
        }
    }

    /**
     * 从数据库删除一条记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = DB::table('goods_type')->where('upid', $id)->first();
        if (count($list) > 0) {
            // 如果存在子分类，则不能删除，直接跳转
            return redirect('admin/type')->with('error', '要删除这个分类必须先删除他下面的子分类');
        }
        // 删除
        $res = DB::table('goods_type')->where('id', $id)->delete();
        if ($res > 0) {
            return redirect('/admin/type')->with('msg', '删除成功');
        } else {
            return redirect('/admin/type')->with('error', '删除失败');
        }
    }
    /**
     * 显示添加子分类页面
     * @param  int $id 所属分类的id
     * @return
     */
    public function subCreate($id)
    {
        $list = DB::table('goods_type')->where('id', $id)->first();
        return view('admin.type.subAdd', ['list' => $list]);
    }
    /**
     * 执行子分类添加操作
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function subStore(Request $request)
    {
        // 自定义错误消息
        $messages = array(
            'tname.required' => '分类名必须填写',
            'tname.unique' => '分类已存在',
        );

        // 表单自动验证用户提交的请求数据，验证规则，自定义错误信息
        $this->validate($request, ['tname' => 'required|unique:goods_type'], $messages);

        $res = $request->except('_token');
        // 获取当前添加子分类的父分类的信息
        $pres = DB::table('goods_type')->where('id', $request->input('upid'))->first();
        // dd($pres);
        // 拼出path
        $res['path'] = $pres->path . ',' . $res['upid'];
        // 添加
        $id = DB::table('goods_type')->insertGetId($res);
        if ($id > 0) {
            return redirect('/admin/type')->with('msg', '添加成功');
        }
    }
}
