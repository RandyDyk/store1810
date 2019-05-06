<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Order;
class AlipayController extends Controller
{
    //
    public function pay(Request $request)
    {
        $ordersn=201904260322031062;
        // echo $ordersn;
        $money=Order::where('ordersn',$ordersn)->value('money');
        // var_dump($arr);exit;
         //商户订单号，商户网站订单系统中唯一订单号，必填
      

        //订单名称，必填
        $subject = "商城测试";

        //付款金额，必填
        $total_amount = "$money";

        //商品描述，可空
        $body = 'null';

        $config=config('alipay');
        // dd($config);
        require_once app_path('Tools/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('Tools/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($ordersn);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
        */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

    }
    public function return(Request $request)
    {
        echo 123;
    
    }
}
