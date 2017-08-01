<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieAjaxController extends Controller
{
    
    /**
     * 获取订单信息并判断订单场次座位号是否已被预定.
     *
     * @return 如果已被预订 则返回false  如果未被预定 则返回订单id
     */
    public function store(Request $request)
    {
        // 获取用户所选座位
        $newStr = $request->input('seat');
        // 将用户所选座位字符串分割成数组
        $new = explode('_',$newStr);
        // 去掉数组最后的空值
        array_pop($new);
        // 获取所有该场次已被订的座位
        $sid = $request->input('sid');
        $str = DB::table('movie_order')->where('sid',$sid)->select('seat')->get();
        // 定义一个空字符串 用来接收拼接的已被订字段
        $oldStr = '';
        // 拼接
        for ($i=0; $i < count($str); $i++) { 
            $oldStr = $oldStr.$str[$i]->seat;
        };
        // 将拼接的字符串分割为数组
        $old = explode('_',$oldStr);
        // 去掉数组中最后一个空值
        array_pop($old);
        // 遍历传过来的座位数组  用来判断
        for ($i=0; $i < count($new); $i++) { 
            // 判断传过来的座位是否已经售出
            if(in_array($new[$i],$old)) {
                // 如果售出 返回false
                return 'false';
                die;
            }
        }
        // 如果该座位未被售出 则生成订单 存入数据库
        $arr = $request->except('_token');
        $res = DB::table('movie_order')->insertGetId($arr);
        return ($res);
    }

    /**
     * 订单生成成功页面.
     *
     * @return 订单信息
     */
    public function show($id)
    {
        // 获取订单信息
        $list = DB::table('movie_order')
            ->where('movie_order.id',$id)
            ->join('show','show.id','=','movie_order.sid')
            ->join('movie_room','movie_room.id','=','show.rid')
            ->join('movie','movie.id','=','show.mid')
            ->select('movie_order.*','show.date','show.time','show.price','movie_room.rname','movie.title','movie.country','movie.format','movie.length','movie.title_pic')
            ->get();
        // 返回生成的订单页面
        return view('home.movie.movie_ajax',['list'=>$list]);
    }
}
