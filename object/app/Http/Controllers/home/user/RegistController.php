<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sms\REST;

class RegistController extends Controller
{

    //主帐号,对应官网开发者主账号下的 ACCOUNT SID
    private $accountSid= null;

    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    private $accountToken= null;

    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    private $appId=null;

    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    private $serverIP=null;


    //请求端口，生产环境和沙盒环境一致
    private $serverPort=null;

    //REST版本号，在官网文档REST介绍中获得。
    private $softVersion=null;

   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.register');
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
        
        $arr = $request->except('__VIEWSTATE','_token','repass','checkcode','msmcode','chk_agree');
        //dd($arr);
        $ob = DB::table('user')->where('name',$arr['name'])->get();
        if($ob = '[]'){
            $id = DB::table('user')->insertGetId($arr);
            if($id > 0){
            return redirect('/login')->with('msg','添加成功');
            }

        }else{
            return redirect('/regist')->with('msg','添加失败');
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

    public function smsphone(Request $request)
    {
         //主帐号,对应官网开发者主账号下的 ACCOUNT SID
        $this->accountSid= '8a216da85d7dbf78015d83a25fe90322';

        //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        $this->accountToken= 'a01a7a00caeb42f78458264344db2ae1';

        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        $this->appId='8a216da85d7dbf78015d83a2602b0326';

        //请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        $this->serverIP='app.cloopen.com';


        //请求端口，生产环境和沙盒环境一致
        $this->serverPort='8883';

        //REST版本号，在官网文档REST介绍中获得。
        $this->softVersion='2013-12-26';
        $sj = rand(1000,9999);
        session(['phonecode'=>$sj]);

        



        //echo json_encode($request->input('phone'));

        $this->sendTemplateSMS($request->input('phone'),array($sj,'10'),"1");

    }

    public function sendTemplateSMS($to,$datas,$tempId)
    {
         // 初始化REST SDK
         $accountSid = $this->accountSid;
         $accountToken = $this->accountToken;
         $appId = $this->appId;
         $serverIP = $this->serverIP;
         $serverPort = $this->serverPort;
         $softVersion = $this->softVersion;
         $rest = new REST($serverIP,$serverPort,$softVersion);
         $rest->setAccount($accountSid,$accountToken);
         $rest->setAppId($appId);
        
         // 发送模板短信
         echo "Sending TemplateSMS to $to <br/>";
         $result = $rest->sendTemplateSMS($to,$datas,$tempId);
         if($result == null ) {
             echo "result error!";
             //break;
         }
         if($result->statusCode!=0) {
             echo "error code :" . $result->statusCode . "<br>";
             echo "error msg :" . $result->statusMsg . "<br>";
             //TODO 添加错误处理逻辑
         }else{
             echo "Sendind TemplateSMS success!<br/>";
             // 获取返回信息
             $smsmessage = $result->TemplateSMS;
             echo "dateCreated:".$smsmessage->dateCreated."<br/>";
             echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
             //TODO 添加成功处理逻辑
         }
    }

    //  public function bjq(Request $request)
    // {
    //     dd($request);
    // }


}
