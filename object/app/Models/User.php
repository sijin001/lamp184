<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'administrator';

    public function index($request)
    {
    	//获取到用户登录时填写的用户名
    	$name = $request->input('name');
    	//通过用户名查询数据库有没有此用户
    	$ob = $this->where('name',$name)->first();

    	if($ob){
    		if($request->input('pass') == $ob->pass){
    			//返回用户信息
    			return $ob;
    		}else{
    			//返回空，密码不对
    			return null;
    		}
    	}else{
    	//返回空，用户名不对
    	return null;
    	}
    }
}
