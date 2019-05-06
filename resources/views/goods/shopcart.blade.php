<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="/css/comm.css" rel="stylesheet" type="text/css" />
    <link href="/css/cartlist.css" rel="stylesheet" type="text/css" />
</head>
<body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="/" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($data as $v)
                    <li goods_id="{{$v->goods_id}}">
                        <s class="xuan current" goods_id="{{$v->goods_id}}"></s>
                        <a class="fl u-Cart-img" href="{{url('goods/shopcontent')}}/{{$v->goods_id}}">
                            <img src="/uploads/{{$v->goods_img}}" border="0" alt="">
                        </a>
                        <div class="u-Cart-r">
                            <a href="/v44/product/12501977.do" class="gray6">{{$v->goods_name}}</a>
                            <span class="gray9">
                                <em>{{$v->self_price}}</em>
                            </span>
                            <div class="num-opt">
                                <em class="num-mius dis min"><i></i></em>
                                <input class="text_box" name="num" maxlength="6" type="text" value="{{$v->buy_num}}" codeid="12501977">
                                <em class="num-add add"><i></i></em>
                            </div>
                            <input type="hidden" value="{{csrf_token()}}" id="_token"> 
                            <a href="javascript:;" name="delLink" goods_id="{{$v->goods_id}}" cid="12501977" isover="0" class="z-del"><s></s></a>
                        </div>    
                    </li>
                @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove">删除</a>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account pay">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    @foreach($sendgoods as $vv)
                        <li>
                            <a href="{{url('goods/shopcontent')}}/{{$vv->goods_id}}" class="g-pic">
                                <img src="/uploads/{{$vv->goods_img}}" width="136" height="136">
                            </a>
                            <p class="g-name">
                                <a href="{{url('goods/goodscontent')}}/{{$vv->goods_id}}">{{$vv->goods_name}}</a>
                            </p>
                            <ins class="gray9">价值:￥{{$vv->self_price}}</ins>
                            <div class="btn-wrap">
                                <div class="Progress-bar">
                                    <p class="u-progress">
                                        <span class="pgbar" style="width:1%;">
                                            <span class="pging"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="gRate" data-productid="23458">
                                    <a href="javascript:;"><s></s></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

       
        

<div class="footer clearfix">
    <ul>
        <li class="f_home"><a href="{{url('/')}}" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="{{url('/')}}" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="{{url('/')}}" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="{{url('goods/shopcart')}}" class="hover"><i></i>购物车</a></li>
        <li class="f_personal"><a href="{{url('goods/userpage')}}" ><i></i>我的潮购</a></li>
    </ul>
</div>

<script src="/js/jquery-1.11.2.min.js"></script>
<script src="/layui/layui.js"></script>
<script src="/layui/css/layui.css"></script>
<!---商品加减算总数---->
    <script type="text/javascript">
        $(function () {
            layui.use(['layer'],function(){
                var layer = layui.layer;
                //点击加号
                $(".add").click(function () {
                    var _token=$('#_token').val();
                    var t = $(this).prev();
                    t.val(parseInt(t.val()) + 1);
                    var num=t.val();
                    var goods_id=$(this).parents('li').attr('goods_id');
                    // console.log(goods_id);
                    $.post(
                        "{{url('goods/updatecart')}}",
                        {num:num,goods_id:goods_id,_token:_token},
                        function(res){
                            console.log(res);
                        }
                    )
                    GetCount();
                })
                //点击减号
                $(".min").click(function () {
                    // var _token=$('#_token').val();
                    var t = $(this).next();
                    if(t.val()>1){
                        t.val(parseInt(t.val()) - 1);
                        var num=t.val();
                        var goods_id=$(this).parents('li').attr('goods_id');
                        var _token=$('#_token').val();
                        $.post(
                            "{{url('goods/updatecart')}}",
                            {num:num,goods_id:goods_id,_token:_token},
                            function(res){
                                // 
                                console.log(res);
                            }
                        )
                        GetCount();
                    }
                })
                //失去焦点修改购买数量
                $(".text_box").blur(function(){
                    var _token=$("#_token").val();
                    var num=$(this).val();
                    var goods_id=$(this).parents('li').attr('goods_id');
                    // console.log(goods_id);
                    $.post(
                        "{{url('goods/updatecart')}}",
                        {goods_id:goods_id,num:num,_token:_token},
                        function(res){
                            // console.log(res);
                        }
                    )
                })
                //单删
                $(".z-del").click(function(){
                    // alert(123);
                    var goods_id=$(".z-del").attr('goods_id');
                    var _token=$("#_token").val();
                    $.post(
                        "{{url('goods/delcart')}}",
                        {goods_id:goods_id,_token:_token,type:1},
                        function(res){
                            // console.log(res);
                            if(res==1){
                                layer.msg('删除成功',{icon:1});
                                history.go(0)
                            }else{
                                layer.msg('删除失败',{icon:2});
                            }
                        }
                    )

                })
                //批删
                $(document).on('click','.remove',function(){
                    var goods_id='';
                    var _token=$("#_token").val();
                    $(".g-Cart-list .xuan").each(function(){
                        if($(this).hasClass('current')){
                            for (var i = 0 ; i<$(this).length; i++){
                                goods_id+=parseInt($(this).attr('goods_id'))+',';
                            }
                        }
                    });
                    goods_id=goods_id.substr(0,goods_id.length-1);
                    // console.log(goods_id);
                    $.post(
                        "{{url('goods/delcart')}}",
                        {goods_id:goods_id,_token:_token,type:2},
                        function(res){
                            // console.log(res);
                            if(res){
                                layer.msg('删除成功',{icon:1});
                                history.go(0)
                            }else{
                                layer.msg('删除失败',{icon:2});
                            }
                        }
                    )
                })
                //点击结算
                $(document).on('click','.pay',function(){
                    var _token=$("#_token").val();
                    var goods_id='';
                    $(".g-Cart-list .xuan").each(function(){
                        if($(this).hasClass('current')){
                            for (var i = 0 ; i<$(this).length; i++){
                                goods_id+=parseInt($(this).attr('goods_id'))+',';
                            }
                        }
                    });
                    goods_id=goods_id.substr(0,goods_id.length-1);
                    // console.log(goods_id);
                    $.post(
                        "{{url('goods/pay')}}",
                        {goods_id:goods_id,_token:_token},
                        function(res){
                            // console.log(res);
                            location.href="{{url('goods/payment')}}"
                        }
                    )
                })
            })
            
        })
    </script>



    
    <script>

        // 全选        
        $(".quanxuan").click(function () {
            if($(this).hasClass('current')){
                $(this).removeClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        $(this).removeClass("current"); 
                    } else {
                        $(this).addClass("current");
                    } 
                });
                GetCount();
            }else{
                $(this).addClass('current');

                $(".g-Cart-list .xuan").each(function () {
                    $(this).addClass("current");
                    // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
                });
                GetCount();
            }
            
            
        });
        // 单选
        $(".g-Cart-list .xuan").click(function () {
            if($(this).hasClass('current')){
                

                $(this).removeClass('current');

            }else{
                $(this).addClass('current');
            }
            if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                    $('.quanxuan').addClass('current');

                }else{
                    $('.quanxuan').removeClass('current');
                }
            // $("#total2").html() = GetCount($(this));
            GetCount();
            //alert(conts);
        });
        // 已选中的总额
        function GetCount() {
            var conts = 0;
            var aa = 0; 
            $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    for (var i = 0; i < $(this).length; i++) {
                        var self_price = $(this).parents('li').find('span.gray9').text();
                        var num=$(this).parents('li').find('input.text_box').val();
                        var all_price=self_price*num;
                        // console.log(all_price);
                        conts += parseInt(all_price);
                        // aa += 1;
                    }
                }
            });
            
            $(".total").html('<span>￥</span>'+(conts).toFixed(2));
        }
        GetCount();
    </script>
</body>
</html>
