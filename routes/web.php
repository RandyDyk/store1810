<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/hello', function () {
            return 'hello aaa';
        });
        Route::get('/form', function () {
            return '<form action="/foo" method="post"> '.csrf_field().'<input type="text" name="aaa"/> <button>提交</button>';
        });
        Route::post('/foo', function () {
            return 'hello aaa';
        });
        //重定向
        Route::redirect('/aaa','/',301);
        //路由视图

        //Route::get('/he', function () {
        //    return view('test');
        //});
        //Route::view('/he','test',['name'=>'zhangsan']);
        //路由参数
        //Route::get('/he/{id}', function ($id) {
        //    return 'id 是：'.$id;
        //});

*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/')->group(function(){
    //商城首页
    Route::any('/','IndexController@index');
    //全部商品
    Route::any('goods/allshops/{id?}','IndexController@allshops');
    //搜索
    Route::any('goods/search','IndexController@search');
    //搜索页面
    Route::any('goods/li','IndexController@li');
    //商品详情
    Route::any('goods/shopcontent/{id?}','IndexController@shopcontent');
    //排序
    Route::any('goods/goodssort','IndexController@goodssort');
    //购物车
    Route::any('goods/shopcart','IndexController@shopcart');
    //删除购物车修改is_show'状态
    Route::any('goods/delcart','IndexController@delcart');
    //添加购物车
    Route::any('goods/cartadd','IndexController@cartadd'); 
    //修改购物车
    Route::any('goods/updatecart','IndexController@updatecart'); 
    //结算
    Route::any('goods/pay','IndexController@pay'); 
    //结算视图
    Route::any('goods/payment','IndexController@payment'); 
    //注册
    Route::any('goods/register','IndexController@register'); 
    //注册执行
    Route::any('goods/registerdo','IndexController@registerdo'); 
    //验证码
    Route::any('goods/code','IndexController@code'); 
    //获取验证码
    Route::any('goods/sendcode','IndexController@sendcode'); 
    //登录视图
    Route::any('goods/login','IndexController@login'); 
    //登录执行
    Route::any('goods/logindo','IndexController@logindo'); 
    //个人中心视图
    Route::any('goods/userpage','IndexController@userpage'); 
    //收货地址
    Route::any('goods/address','IndexController@address'); 
    //添加收货地址
    Route::any('goods/writeaddr','IndexController@writeaddr'); 
    //添加收货地址执行
    Route::any('goods/writeaddrdo','IndexController@writeaddrdo');
    //修改默认地址
    Route::any('goods/default','IndexController@default');  
    //修改收货地址
    Route::any('goods/editaddr/{id?}','IndexController@editaddr'); 
    //修改收货地址执行
    Route::any('goods/editaddrdo','IndexController@editaddrdo'); 
    //删除收货地址
    Route::any('goods/deladdr','IndexController@deladdr'); 
    //我的潮沟视图
    Route::any('goods/buyrecord','IndexController@buyrecord'); 
});
     //登录验证码
     Route::any('verify/create','CaptchaController@create');
     Route::any('/alipay',function(){
         $ordersn=date('YmdHis').rand(1000,9999);
         return "<b><a href=/pay/".$ordersn.">支付宝支付</a></b>";
     });

     Route::any('/pay/{ordersn}','AlipayController@pay');
     Route::any('return','AlipayController@return');

    

Route::prefix('/')->group(function(){
    route::any('/wechat','WechatController@valid');
});
