	@extends('goods/muster')
	@section('title')
		首页
	@endsection

	@section('content')
    <div class="marginB" id="loadingPicBlock">
        <!--首页头部-->
        <div class="m-block-header" style="display: none">
        	<div class="search"></div>
        	<a href="/" class="m-public-icon m-1yyg-icon"></a>
        </div>
        <!--首页头部 end-->

        <!-- 关注微信 -->
        <div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
            <div class="app-icon">
                <a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
                <a href="javascript:;" class="info-icon">
                    <i class="set-icon"></i>
                    <div class="info">
                        <p>点击关注666潮人购官方微信^_^</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- 焦点图 -->
        <div class="hotimg-wrapper">
            <div class="hotimg-top"></div>
            <section id="sliderBox" class="hotimg">
        		<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
					@foreach($image as $vv)
        			<li class="clone" style="width: 414px; float: left; display: block;">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
        					<img src="/uploads/{{$vv->goods_img}}" alt="暂无图片">
        				</a>
					</li>
					@endforeach
        		</ul>
            </section>
        </div>
       <!--  <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> 
		<script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script> -->
        
        <!--分类-->
        <div class="index-menu thin-bor-top thin-bor-bottom">
            <ul class="menu-list">
				@foreach($data as $v)
                <li>
                    <a href="{{url('goods/allshops')}}" id="btnNew">
                        <i class="xinpin"></i>
                        <span class="title">{{$v->cate_name}}</span>
                    </a>
				</li>
				@endforeach
            </ul>
        </div>
        <!--导航-->
        <div class="success-tip">
        	<div class="left-icon"></div>
        	<ul class="right-con">
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
			</ul>
        </div>
        <!-- 热门推荐 -->
        <div class="line hot">
        	<div class="hot-content">
        		<i></i>
        		<span>潮人推荐</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <div class="hot-wrapper">
        	<ul class="clearfix">
        		<li style="border-right:1px solid #e4e4e4; ">
        			<a href="shopcontent.html">
        				<p class="title">洋河 蓝色经典 海之蓝42度</p>
        				<p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
        				<img src="/images/goods2.jpg" alt="">
        			</a>
        		</li>
        		<li>
        			<a href="shopcontent.html">
        				<p class="title">洋河 蓝色经典 海之蓝42度</p>
        				<p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
        				<img src="/images/goods2.jpg" alt="">
        			</a>
        		</li>
        	</ul>
        </div>
        <!-- 猜你喜欢 -->
        <div class="line guess">
        	<div class="hot-content">
        		<i></i>
        		<span>猜你喜欢</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <!--商品列表-->
        <div class="goods-wrap marginB">
            <ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($gdata as $vvv)
            	<li id="23558" codeid="12751965" goodsid="23558" codeperiod="28436">
            		<a href="{{url('goods/shopcontent')}}/{{$vvv->goods_id}}" class="g-pic">
            			<img class="lazy" name="goodsImg" src="/uploads/{{$vvv->goods_img}}" width="136" height="136">
            		</a>
            		<p class="g-name">{{$vvv->goods_name}}</p>
            		<ins class="gray9">价值：￥{{$vvv->self_price}}</ins>
            		<div class="Progress-bar">
            			<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
            			</p>

            		</div>
            		<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
            			<a href="javascript:;" class="buy-btn" codeid="12751965">立即潮购</a>
            			<div class="gRate" codeid="12751965" canbuy="58" goods_id="{{$vvv->goods_id}}">
							<input type="hidden" value="{{csrf_token()}}" id="_token">  
            				<a href="javascript:;"></a>
            			</div>
            		</div>
				</li>
				@endforeach
            </ul>
            <div class="loading clearfix"><b></b>正在加载</div>
        </div>  
<!--底部-->


@endsection

@section('my-js')
<script src="/layui/layui.js" charset="utf-8"></script>
<script src="/layui/css/layui.css" charset="utf-8"></script>
<script>
	$(function(){
		layui.use(['layer'],function(){
			var layer=layui.layer;
			$(document).on('click','.gRate',function(){
				// alert(123);
				var goods_id=$(this).attr('goods_id');
				// console.log(goods_id);
				var _token=$("#_token").val();
				$.post(
					"{{url('goods/cartadd')}}",
					{goods_id:goods_id,_token:_token},
					function(res){
						// console.log(res);
						if(res==1){
                            alert('添加成功');
                        }else{
                            alert('添加失败');
                        }
					}
				)
			})
		})
	})
</script>
<script>
		$(function () {
			$('.hotimg').flexslider({
				directionNav: false,   //是否显示左右控制按钮
				controlNav: true,   //是否显示底部切换按钮
				pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
				animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
				slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
				animationSpeed: 150,   //轮播效果切换时间,默认600ms
				direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
				randomize: false,   //是否随机幻切换
				animationLoop: true   //是否循环滚动
			});
			//setTimeout($('.flexslider img').fadeIn());

		
		});

		jQuery(document).ready(function() {
			$("img.lazy").lazyload({
				placeholder : "images/loading2.gif",
				effect: "fadeIn",
			});

			// 返回顶部点击事件
			$('#div_fastnav #li_menu').click(
					function(){
						if($('.sub-nav').css('display')=='none'){
							$('.sub-nav').css('display','block');
						}else{
							$('.sub-nav').css('display','none');
						}

					}
			)
			$("#li_top").click(function(){
				$('html,body').animate({scrollTop:0},300);
				return false;
			});

			$(window).scroll(function(){
				if($(window).scrollTop()>200){
					$('#li_top').css('display','block');
				}else{
					$('#li_top').css('display','none');
				}

			})


		});
	</script>
@endsection