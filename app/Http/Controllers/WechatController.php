<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{
    //
    public function valid(Request $request)
    {
        $echostr = $request -> echostr;
        if($this->CheckSignature($request)){
            echo $echostr;
        }
    }

    public function CheckSignature(Request $request)
    {   
        dd($request);
        $nonce = $request->nonce;
        $timestamp=$request->timestamp;
        $signature=$request->signature;
        $token=evn("TOKEN");
        $tmparr=[$token,$timestamp,$nonce];
        sort($tmparr);
        $tmpstr=implode($tmparr);
        $str=sha1($tmpstr);
        if($str == $signature){
            return true;
        }else{
            return false;
        }
    }
}
