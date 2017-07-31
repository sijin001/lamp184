<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Gregwar\Captcha\CaptchaBuilder;
use App\Models\Userzc;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.login');
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
        //dd($request);
        //提过来下面的验证码
        $checkcode = session('checkcode'); 
        //判断input过来的验证码和下面的是否一致
        if($checkcode != $request->input('checkcode')){
            return back()->with('msg','登录失败，验证码错误');
        }

        //实例化model-user模型
        $user = new Userzc();
        //调用模型中的index验证用户登录
        $ob = $user->index($request);
        if($ob){
            //登录成功，保存用户登录信息session
            session(['user'=>$ob]);
            return redirect('/');
        }else{
            //登录失败则调回上一页
            return back()->with('msg','登录失败：用户名或密码错误');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function capth()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        // $builder->build($width = 200, $height = 44, $font = null);
        $builder->build(160, 36, null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

         
        //把内容存入session
        session()->flash('checkcode', $phrase);
        // Session::flash('milkcaptcha', $phrase);
       
        //生成图片
        // header('Content-Type: image/jpeg');
        return response($builder->output())->header('Content-type', 'image/jpeg');
    }

    public function out()
    {
        session()->flush();
        return redirect('/');

    }


}
