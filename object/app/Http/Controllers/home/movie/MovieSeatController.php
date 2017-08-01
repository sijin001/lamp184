<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use session;

//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;

class MovieSeatController extends Controller
{
    

    /**
     * 座位页面展示.
     *
     */
    public function show($id)
    {
        
        $show = DB::table('show')
            ->where('show.id',$id)
            ->join('movie','show.mid','=','movie.id')
            ->join('movie_room','show.rid','=','movie_room.id')
            ->select('show.*','movie.title','movie.format','movie.length','movie.country','movie.title_pic','movie_room.rname')
            ->get();
        $seats = DB::table('movie_order')->where('sid',$id)->select('seat')->get();
        // 定义一个空字符串 用来拼接订单中的座位
        $str = '';
        $arr = [];
        foreach($seats as $val) { 
            $str = $str.$val->seat;
        }
        // 分割拼接的字符串 使之成为数组
        $arr1 = explode('_',$str);
        // 去除数组中最后一个空值
        array_pop($arr1);
        // 遍历数组
        foreach($arr1 as $v) {
            // 获得第几行
            $arr2 = explode('排',$v);
            // 获得第几个位置
            $arr3 = explode('座',$arr2['1']);
            // 重新拼成数组 行为键  位置为对应的数组
            $arr[$arr2['0']][] = $arr3['0'];
        }

        $arrStr = json_encode($arr);
        return view('home.movie.movie_seat',['show'=>$show,'seats'=>$seats,'arrStr'=>$arrStr]);
    }

     /**
     * 生产验证码.
     * @return 验证码图片
     */
    public function capth()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 300, $height = 120, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        session()->flash('mycode',$phrase);
        //生成图片
        return response($builder->output())->header('Content-type','image/jpeg');
        die;
    }
    
}
