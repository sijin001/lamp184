<?php

namespace App\Http\Controllers\admin\slides;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imgs = DB::table('slides')->paginate(5);
        // 当前页
        $now = $imgs->currentPage(); 
        
        return view('admin.slides.index', ['imgs' => $imgs, 'now' => $now]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.add');
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
        if ($request->hasFile('img')) {
            if ($request->file('img')->isValid()) {
                $file = $request->file('img');
                // dd($file);
            }
            $ext = $file->getClientOriginalExtension();
            $lunboname = time() . rand(1000,9999) . '.' . $ext;
            // dd($lunboname);
            $file->move('./admin/upload/slides', $lunboname);
            if ($file->getError() > 0) {
                echo '上传失败';
            } else {
                echo '上传成功';
            }
        }

        $arr['img'] = $lunboname;
        // dd($arr);
        $res = DB::table('slides')->insertGetId($arr);
        // dd($res);
        if($res > 0) {
            return redirect('admin/lunbo')->with('msg', '添加成功');
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
     * 删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $res = DB::table('slides')->where('id', $id)->delete();
        if($res > 0) {
            return redirect('admin/lunbo')->with('msg', '删除成功');
        }else{
            return redirect('admin/lunbo')->with('error', '删除失败');   
        }
    }
}
