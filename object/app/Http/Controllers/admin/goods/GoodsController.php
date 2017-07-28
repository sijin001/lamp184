<?php

namespace App\Http\Controllers\admin\goods;

use App\Http\Controllers\Controller;

use DB;

use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * 显示商品列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        // 保存搜索条件
        $where = [];
        $ob = DB::table('goods')
            ->join('goods_type', 'goods.tid', '=', 'goods_type.id')
            ->select('goods.*', 'goods_type.tname')
            ->orderBy('tid');
        // ->get();
        // dd($ob);
        // 判断请求中是否有搜索条件name字段
        if ($request->has('gname')) {
            // 获取搜索条件
            $name = $request->input('gname');
            // 添加到数组中
            $where['gname'] = $name;
            $ob->where('gname', 'like', '%' . $name . '%');
        }
        // 分页查询
        $list = $ob->paginate(5);
        // 当前页
        $now = $list->currentPage();
        // 加载模板，带上查询条件，以及分页参数
        return view('admin.goods.index', ['list' => $list, 'where' => $where, 'now'=>$now]);
    }

    /**
     * 商品添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ob = DB::table('goods_type')->get();
        // dd($ob);
        return view('admin.goods.add', ['ob' => $ob]);
    }

    /**
     * 添加商品
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //自定义错误消息格式
        $messages = array(
            'gname.required' => '商品名必须填写',
            'gname.unique'  => '商品已存在',
            'price.required' => '价格必须填写',
            'theme.required' => '主题必须填写',
            'num.required' => '数量必须填写'
        );

        //表单自动验证（用户提交的请求数据，验证规则，自定义的错误消息）
        $this->validate($request, [
            'gname' => 'required|unique:goods',
            'price' => 'required',
        ],$messages);

        // dd($request);
        $arr = $request->except('_token', 'picture1', 'picture2','picture3');
        // dd($arr);
        $id = DB::table('goods')->insertGetId($arr);
        // dd($id);
        // 商品主图上传：判断是否有文件上传
        if ($request->hasFile('picture1')) {
            // 判断文件是否有效
            if ($request->file('picture1')->isValid()) {
                // 生成上传文件对象
                $file = $request->file('picture1');
            }
            // 获取源文件的后缀名
            $ext = $file->getClientOriginalExtension();
            // dd($ext);
            $picname1 = time() . rand(1000, 9999) . '.' . $ext;
            // dd($picname);
            $file->move('./admin/upload/goods', $picname1);
            // dd($file->getError());//0表示上传文件成功
            if ($file->getError() > 0) {
                echo '上传失败';
            } else {
                echo '上传成功';
                $v1['gimage'] = $picname1;
                $v1['gid'] = $id;
                $v1['index'] = 1;
                DB::table('goods_photo')->insert($v1);
            }
        }

        // 商品缩略图上传
        if ($request->hasFile('picture2')) {
            // 判断文件是否有效
            if ($request->file('picture2')->isValid()) {
                // 生成上传文件对象
                $file = $request->file('picture2');
            }
            // 获取源文件的后缀名
            $ext = $file->getClientOriginalExtension();
            // dd($ext);
            $picname2 = time() . rand(1000, 9999) . '.' . $ext;
            // dd($picname);
            $file->move('./admin/upload/goods', $picname2);
            // dd($file->getError());//0表示上传文件成功
            if ($file->getError() > 0) {
                echo '上传失败';
            } else {
                echo '上传成功';
                $v2['gimage'] = $picname2;
                $v2['gid'] = $id;
                $v2['index'] = 2;
                DB::table('goods_photo')->insert($v2);
            }
        }

        // 商品详情图片上传：多图
        $err = array();
        if($request->hasFile('picture3')) {
            // 生成上传文件对象
            $data = $request->file('picture3');
            for($i = 0; $i < count($data); $i++){
                // 获取后缀名
                $ext = $data[$i]->getClientOriginalExtension();
                $picname3 = time() . rand(1000, 9999) . '.' . $ext;
                // 获取旧图片名
                $oldname = $data[$i]->getClientOriginalName();
                // 移动图片
                $data[$i]->move('./admin/upload/goods', $picname3);
                if($data[$i]->getError()>0){
                    $err[] = $oldname.'上传失败';
                }else{
                    echo '上传成功';
                    $v3['gimage'] = $picname3;
                    $v3['gid'] = $id;
                    $v3['index'] = 3;
                    DB::table('goods_photo')->insert($v3);
                }
            }
        }

        return redirect('/admin/goods')->with('msg', '添加成功');
    
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
     * 显示具体商品修改页面，携带所属分类
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = DB::table('goods')
            ->join('goods_type', 'goods_type.id', '=', 'goods.tid')
            ->select('goods.*', 'goods_type.tname')
            ->where('goods.id', '=', $id)
            ->first();
        // dd($goods);
        // dd($goods->content);
        return view('admin.goods.edit', ['goods' => $goods]);
    }

    /**
     * 商品修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request);
        // $arr = $request->except('_token', '_method');
        // $id = DB::table('goods')->where('id', $id)->update($arr);
       
        // 商品主图上传：判断是否有文件上传
        if ($request->hasFile('picture1')) {
            // 判断文件是否有效
            if ($request->file('picture1')->isValid()) {
                // 生成上传文件对象
                $file = $request->file('picture1');
            }
            // 获取源文件的后缀名
            $ext = $file->getClientOriginalExtension();
            $picname1 = time() . rand(1000, 9999) . '.' . $ext;
            $file->move('./admin/upload/goods', $picname1);
            // dd($file->getError());//0表示上传文件成功
            if ($file->getError() > 0) {
                echo '上传失败';
            } else {
                echo '上传成功';
                $v1['gimage'] = $picname1;
                $v1['gid'] = $id;
                $v1['index'] = 1;
                DB::table('goods_photo')->where('index', 1)->where('gid', $id)->update($v1);
            }
        }

        // 商品缩略图上传
        if ($request->hasFile('picture2')) {
            // 判断文件是否有效
            if ($request->file('picture2')->isValid()) {
                // 生成上传文件对象
                $file = $request->file('picture2');
            }
            // 获取源文件的后缀名
            $ext = $file->getClientOriginalExtension();
            $picname2 = time() . rand(1000, 9999) . '.' . $ext;
            $file->move('./admin/upload/goods', $picname2);
            // dd($file->getError());//0表示上传文件成功
            if ($file->getError() > 0) {
                echo '上传失败';
            } else {
                echo '上传成功';
                $v2['gimage'] = $picname2;
                $v2['gid'] = $id;
                $v2['index'] = 2;
                DB::table('goods_photo')->where('index', 2)->where('gid', $id)->update($v2);
            }
        }

        // 商品详情图片上传：多图
        DB::table('goods_photo')->where('gid', $id)->where('index',3)->delete();
        $err = array();
        if($request->hasFile('picture3')) {
            // 生成上传文件对象
            $data = $request->file('picture3');
            for($i = 0; $i < count($data); $i++){
                // 获取后缀名
                $ext = $data[$i]->getClientOriginalExtension();
                $picname3 = time() . rand(1000, 9999) . '.' . $ext;
                // 获取旧图片名
                $oldname = $data[$i]->getClientOriginalName();
                // 移动图片
                $data[$i]->move('./admin/upload/goods', $picname3);
                if($data[$i]->getError()>0){
                    $err[] = $oldname.'上传失败';
                }else{
                    echo '上传成功';
                    $v3['gimage'] = $picname3;
                    $v3['gid'] = $id;
                    $v3['index'] = 3;
                    DB::table('goods_photo')->where('gid', $id)->insert($v3);
                }
            }
        }
        $arr = $request->except('_token', '_method','picture1','picture2', 'picture3');
        // dd($arr);
        $id = DB::table('goods')->where('id', $id)->update($arr);
        // dd($id);
        // if($id > 0) {
            return redirect('/admin/goods')->with('msg', '修改成功');
        // }else{
        //     return redirect('/admin/goods')->with('error', '修改失败');
        // }

    }

    /**
     * 商品删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('goods')->where('id', $id)->delete();
        if ($res > 0) {
            return redirect('/admin/goods')->with('msg', '删除成功');
        } else {
            return redirect('/admin/goods')->with('error', '删除失败');
        }
    }

    /**
     * 商品是否为新品操作
     * @param  int $id [description]
     * @return [type]     [description]
     */
    public function doGnew($id)
    {
        // DB::table('goods')->where('id', $id)->update(['gnew'=>0 ? '0' : '1']);
        // return back();
        $gid = DB::table('goods')->where('id', $id)->value('gnew');
        // dd($gid);
        if($gid == 0) {
            DB::table('goods')->where('id', $id)->update(['gnew'=>1]);
            return back();
        }else{
            DB::table('goods')->where('id', $id)->update(['gnew'=>0]);
            return back();   
        }
    }

    /**
     * 商品是否为热销操作
     * @param  int $id    [description]
     * @return [type]     [description]
     */
    public function doGhot($id)
    {
        $gid = DB::table('goods')->where('id', $id)->value('ghot');
        // dd($gid);
        if($gid == 0) {
            DB::table('goods')->where('id', $id)->update(['ghot'=>1]);
            return back();
        }else{
            DB::table('goods')->where('id', $id)->update(['ghot'=>0]);
            return back();   
        }
    }


}
