<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="/css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/writeaddr.css">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/dist/css/LArea.css">
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="javascript:;" class="m-index-icon" id="btn" >保存</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">  
  
</form> -->
<form class="layui-form" action="">
  <div class="addrcon">
    <ul>
      <li><em>收货人</em><input type="text" class="name" placeholder="请填写真实姓名" name='address_name'></li>
      <li><em>手机号码</em><input type="number" class="tel" placeholder="请输入手机号" name='address_tel'></li>
      <li><em>所在区域</em><input id="demo1" class="area" type="text"  name="address_area" placeholder="请选择所在区域"></li>
      <li class="addr-detail"><em>详细地址</em><input type="text" class="content" name="address_content" placeholder="20个字以内" class="addr"></li>
    </ul>
    <div class="setnormal"><span>设为默认地址</span><input type="checkbox" id='checked' name="xxx" lay-skin="switch">  </div>
  </div>
  <input type="hidden" id='_token' value="{{csrf_token()}}">
</form>

<!-- SUI mobile -->
<script src="/dist/js/LArea.js"></script>
<script src="/dist/js/LAreaData1.js"></script>
<script src="/dist/js/LAreaData2.js"></script>
<script src="/js/jquery-1.11.2.min.js"></script>
<script src="/layui/layui.js"></script>

<script>
  //Demo
  layui.use('form', function(){
    var form = layui.form();
    
    //监听提交
    form.on('submit(formDemo)', function(data){
      layer.msg(JSON.stringify(data.field));
      return false;
    });
  });

  var area = new LArea();
  area.init({
      'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
      'valueTo':'#value1',//选择完毕后id属性输出到该位置
      'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
      'type':1,//数据源类型
      'data':LAreaData//数据源
  });


</script>
<script>
  $(function(){
    layui.use(['layer'],function(){
      var layer = layui.layer;
      //收货人验证
      $('.name').blur(function(){
        var address_name=$(this).val();
        var reg =/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
        if(address_name==''){
          layer.msg('收货人名称必填',{icon:2});
        }else if (!reg.test(address_name)){
          layer.msg('收货人名称由数字字母下划线组成',{icon:2});
        }
      })
      //手机号验证
      $('.tel').blur(function(){
        var address_tel=$(this).val();
        var reg=/^1[34578]\d{9}$/;
        if(address_tel==''){
          layer.msg('手机号必填',{icon:2});
        }else if(!reg.test(address_tel)){
          layer.msg('请填写正确的手机号',{icon:2});
        }
      })
      //所在区域验证
      $('.area').blur(function(){
        var address_area=$(this).val();
        if(address_area==''){
          layer.msg('所在区域必填',{icon:2});
        }
      })
      //详细地址
      $('.content').blur(function(){
        var address_content=$(this).val();
        if(address_content==''){
          layer.msg('详细地址必填',{icon:2});
        }
      })
      //保存地址
      $('#btn').click(function(){
        var obj={};
        obj.address_name=$('.name').val();
        obj.address_tel=$('.tel').val();
        obj.address_area=$('.area').val();
        obj.address_content=$('.content').val();
        var checked=$('#checked').prop('checked');
        // console.log(checked);
        if(checked==true){
          obj.is_default=1;
        }else{
          obj.is_default=2;
        }
        var _token=$('#_token').val();
        $.post(
          "{{url('goods/writeaddrdo')}}",
          {obj:obj,_token:_token},
          function(res){
            // console.log(res);
            if(res==1){
              layer.msg('添加地址成功',{icon:1},function(){
                location.href="{{url('goods/address')}}"
              });
            }else{
              layer.msg('添加失败',{icon:2});
            }
          }
        )
      })

    })
  })
</script>

</body>
</html>
