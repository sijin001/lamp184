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
    public function index()
    {
        return view('admin.index');
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
    
        $arr = $request->except('_token','_method');
        //dd($arr);
        
        $res = DB::table('administrator')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('admin/film')->with('msg', '修改成功');
        }else{
            return redirect('admin/film')->with('error', '修改失败');
        }
   }

   public function showgl()
   {
    $user = DB::table('administrator')->get();
    //dd($user);
    return view('admin.adminuser.index',['user'=>$user]);
   }

}
