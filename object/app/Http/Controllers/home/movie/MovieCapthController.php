<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class MovieCapthController extends Controller
{
    /**
     * 判断验证码.
     *
     * @return ture or false
     */
    public function index()
    {
        $code = $_GET['code'];
        $mycode = session('mycode');
        if( $code != $mycode){
            echo 'true';
        }else{
            echo 'false';
        }
    }
}
