<?php

namespace App\Http\Controllers\admin\user;

use Illuminate\Http\Request;

use Gregwar\Captcha\CaptchaBuilder;

use Session;

use App\Models\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function doLogin(Request $request)
    {   

        //dd($request);
        //下面存的验证码
        $mycode = session('mycode');

        //dd($request);
        //判断和下面的验证码是否一致
        if($mycode != $request->input('yanzheng')){
            //不一致则跳转回
            return back()->with('msg','登录失败，验证码错误');
        }
        //实例化一个模型
        $user = new User();
        //调用模型中的index验证用户登录
        $ob = $user->index($request);
        if($ob){
            //如果登录成功，保存用户登录信息
            session(['adminuser'=>$ob]);
            //跳转到后台页面
            return redirect('admin/film');
        }else{
            //登录失败则跳转回上一页
            return back()->with('msg', '登录失败：用户名或密码错误');
        }

    }

    public function capth()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        // $builder->build($width = 200, $height = 44, $font = null);
        $builder->build(200, 44, null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

            //dd($phrase);
        //把内容存入session
        session()->flash('mycode', $phrase);
        // Session::flash('milkcaptcha', $phrase);
        //生成图片
        // header('Content-Type: image/jpeg');
        return response($builder->output())->header('Content-type', 'image/jpeg');
    }


    public function out()
    {
        session()->flush();
        return redirect('admin/over');
    }
}
