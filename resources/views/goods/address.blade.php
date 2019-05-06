<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>地址管理</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="/css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/address.css">
    <link rel="stylesheet" href="/css/sm.css">
  
   
    
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">地址管理</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="{{url('goods/writeaddr')}}" class="m-index-icon">添加</a>
</div>
<div class="addr-wrapp">

    @foreach($data as $v)
        <div class="addr-list">
            <ul>
                <li class="clearfix">
                    <span class="fl">{{$v->address_name}}</span>
                    <span class="fr">{{$v->address_tel}}</span>
                </li>
                <li>
                    <p>{{$v->address_content}}</p>
                </li>
                <li class="a-set" address_id="{{$v->address_id}}">
                    @if($v->is_default==1)
                        <s class="z-set" style="margin-top: 6px;"></s>
                        <span id="def" >默认</span>
                    @else
                        <span id="default">设为默认</span>
                    @endif
                
                    <div class="fr">
                        <span class="edit"><a href="{{url('goods/editaddr')}}/{{$v->address_id}}">编辑</a></span>
                        <span class="remove">删除</span>
                    </div>
                </li>
            </ul>  
        </div>
    @endforeach
    <input type="hidden" value="{{csrf_token()}}" id='_token'>
</div>


<script src="/js/zepto.js" charset="utf-8"></script>
<script src="/js/sm.js"></script>
<script src="/js/sm-extend.js"></script>
<script src="/layui/layui.js"></script>
<script src="/layui/css/layui.css"></script>


<!-- 单选 -->
<script>
    $(function(){
        layui.use(['layer'],function(){
            var layer = layui.layer;
            //默认地址修改
            $('#default').click(function(){
                var address_id=$(this).parent('li').attr('address_id');
                // console.log(address_id)
                var _token=$('#_token').val();
                $.post(
                    "{{url('goods/default')}}",
                    {address_id:address_id,_token:_token},
                    function(res){
                        // console.log(res);
                        if(res==1){
                            // $("#default").before("<s class='z-set' style='margin-top: 6px;'></s>");
                            // $("#default").text('默认');
                            // $("#def").prev().remove();
                            // $("#def").text('设为默认');
                            layer.msg('修改默认地址成功',{icon:1});
                            history.go(0);
                        }else{
                            layer.msg('修改默认地址失败',{icon:2});
                        }
                    }
                )
            })
            //删除地址
            $('.remove').click(function(){
                var address_id=$(this).parents('li').attr('address_id');
                // console.log(address_id);
                var _token=$('#_token').val();
                $.post(
                    "{{url('goods/deladdr')}}",
                    {address_id:address_id,_token:_token},
                    function(res){
                        // console.log(res);
                        if(res==1){
                            layer.msg('删除成功',{icon:1});
                            history.go(0);
                        }else if (res==2){
                            layer.msg('删除失败',{icon:1});
                        }   
                    }
                )
            })
        })
    })
</script>
<script>
    

     // 删除地址
    // $(document).on('click','span.remove', function () {
    //     var buttons1 = [
    //         {
    //           text: '删除',
    //           bold: true,
    //           color: 'danger',
    //           onClick: function() {
    //             $.alert("您确定删除吗？");
    //           }
    //         }
    //       ];
    //       var buttons2 = [
    //         {
    //           text: '取消',
    //           bg: 'danger'
    //         }
    //       ];
    //       var groups = [buttons1, buttons2];
    //       $.actions(groups);
    // });
</script>
<script src="/js/jquery-1.8.3.min.js"></script>
<script>
    var $$=jQuery.noConflict();
    $$(document).ready(function(){
            // jquery相关代码
            $$('.addr-list .a-set s').toggle(
            function(){
                if($$(this).hasClass('z-set')){
                    
                }else{
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }   
            },
            function(){
                if($$(this).hasClass('z-defalt')){
                    $$(this).removeClass('z-defalt').addClass('z-set');
                    $$(this).parents('.addr-list').siblings('.addr-list').find('s').removeClass('z-set').addClass('z-defalt');
                }
                
            }
        )

    });
    
</script>



</body>
</html>
