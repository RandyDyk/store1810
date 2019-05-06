<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Goods;
use App\Model\Cart;
use App\Model\User;
use App\Model\Address;
use cache;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
   
    //首页
    public function index(Request $request)
    {
        echo 123123132;
        echo 456456456456;
        echo 45645645646;
        $data=Category::where('pid',0)->get();
        $image=Goods::select('goods_img')->limit(5)->get();
        $gdata=Goods::get();
        return view('goods.index',['data'=>$data,'gdata'=>$gdata,'image'=>$image]);
    }
    //注册
    public function register(Request $request)
    {
        return view('goods.register');
    }
    //注册执行
    public function registerdo(Request $request)
    {
        $code=session('code');
        $data=$request->post();
        $user_tel=$data['user_tel'];
        $codee=$request->code;
        $user_pwd=$request->user_pwd;
        if($code!=$codee){
            echo 1;exit;
        }
        $result=User::where('user_tel',$user_tel)->first();
        if(!empty($result)){
            echo 2;exit;
        }
        $data['user_pwd']=encry大家都在发pt($data['user_pwd']);
        // var_dump($data['user_pwd']);
        unset($data['_token']);
        unset($data['code']);
        $res=User::insert($data);
        if($res){
            echo 3;
        }else{
            echo 4;exit;
        }
    }
    //获取验证码
    public function sendcode($code,$phone)
    {
        $host = "http://yzxyzm.market.alicloudapi.com";
        $path = "/yzx/verifySms";
        $method = "POST";
        $appcode = "5c2987184b4540ab92147b80ccf0de59";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "phone=$phone&templateId=TP18040314&variable=code%3A$code";        
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }
    //验证码
    public function code(Request $request)
    {
        $data=$request->post();
        // var_dump($data);
        $phone=$data['user_tel'];
        $code=rand(100000,999999);
        session(['user_tel'=>$phone]);
        session(['code'=>$code]);
        $this->sendcode($code,$phone);
    }
    //登录视图
    public function login()
    {
        return view('goods.login');
    }
    //登录执行
    public function logindo(Request $request)
    {
        $data=$request->all();
        $code=$data['code'];
        $pwd=$data['user_pwd'];
        $user_tel=$data['user_tel'];
        $codede=session(',');
        if($code!=$codede){
            echo 1;exit;
        }
     
        $arr=User::where('user_tel',$user_tel)->first();
        if(empty($arr)){
            echo 2;exit;
            //手机号不存在请前往注册页面
        }else{
            if($pwd!=decrypt($arr['user_pwd'])){
                echo 3;exit;
            }else{
                session(['login_id'=>$arr['user_id']]);
                echo 4;
            }
        }
        
        
    }
    //全部商品
    public function allshops(Request $request)
    {
        $id=$request->id;
        
        $cate=Category::where('pid',0)->get();
        // dd($id);
        if(empty($id)){
            $search=$request->search;
            $arr=Goods::get();
        }else{
            $allcate=Category::get();
            $id=intval($id);
            $Cate=$this->getcate($allcate,$id);
            $arr=[];
            foreach($Cate as $v){
                $goods=Goods::where('cate_id',$v['cate_id'])->first();
                if($goods!=''){
                    $arr[]=$goods;
                }
            }
        }        
        return view('goods.allshops',['cate'=>$cate,'arr'=>$arr,'id'=>$id]);
    }
    //无限极分类
    public function getcate($allcate,$id)
    {
        static $Cate=[];
        foreach($allcate as $v){
            if($id==$v['pid']){
                $Cate[]=$v;
            }
        }
        return $Cate;
    }
    //搜索
    public function search(Request $request)
    {
        $search=$request->search;
        // var_dump($search);exit;
        // $where=[];
        $search=$search??'';
        $where[]=['goods_name','like',"%$search%"];
        $arr=Goods::where($where)->get();
        return view('goods.li',['arr'=>$arr]);
    }
    //商品详情
    public function shopcontent(Request $request)
    {
        $id=$request->id;
        $data=cache('data'.$id);
        // var_dump($data);exit;
        if(!$data){
            
            $data=Goods::where('goods_id',$id)->first();
            cache(['data'.$id=>$data],60);
            echo 11111;
        }
        // exit;
        // var_dump($data);exit;
        return view('goods.shopcontent',['data'=>$data]);
    }
    //商品价格库存是否新品
    public function goodssort(Request $request)
    {
         $data=$request->all();
         $top=$data['top'];
         $type=$data['_type'];
         // $cate_id=$data['cate_id'];
         var_dump($data);
    }
    //购物车视图
    public function shopcart(Request $request)
    {
        $user_id=session('login_id');
        $data=cache('data');
        // $sendgoods=\cache('sendgoods');
        // \var_dump($data);exit;
        
        if(empty($user_id)){
            echo "<script>alert('请先登录'),location.href='login'</script>" ;
        }else{
            if(!$data){
                $data=Goods::join('cart','goods.goods_id','=','cart.goods_id')
                    ->where(['cart.user_id'=>$user_id])->get();
                
                cache(['data'=>$data],60);
                // cache(['sendgoods'=>$sendgoods],60);
                // echo 11111111111;
            }else{
                echo 22222;
                // print_r($sendgoods);
                // print_r($data);
            }
            $sendgoods=Goods::orderBy('send_num','desc')->limit(4)->get();
            // exit;
            // var_dump($data);exit;
            return view('goods.shopcart',['data'=>$data,'sendgoods'=>$sendgoods]);
        }
        
        
    }
    //添加购物车
    public function cartadd(Request $request)
    {
        $user_id=session('login_id');
        // var_dump($user_id);exit;
        if(empty($user_id)){
            echo 3;exit;
        }else{
            $goods_id=$request->goods_id;
            
            // var_dump($goods_id);
            $where=[
                'goods_id'=>$goods_id,
                'user_id'=>$user_id,
            ];
            $goods=Cart::where($where)->first();
            if($goods!=''){
                $data=[
                    'buy_num'=>$goods['buy_num']+1,
                    'user_id'=>$user_id
                ];
                $res=Cart::where('goods_id',$goods_id)->update($data);
            }else{
                $data=[
                    'goods_id'=>$goods_id,
                    'user_id'=>$user_id,
                    'buy_num'=>1
                ];
                $res=Cart::insert($data);
            }
            // var_dump($res);exit;
            if($res){
                echo '1';
            }else{
                echo '2';exit;
            }
        };
        
    }
    //点击加减号修改购买数量
    public function updatecart(Request $request)
    {
        $data=$request->all();
        $num=$data['num'];
        $goods_id=$data['goods_id'];
        $res=Cart::where('goods_id',$goods_id)->update(['buy_num'=>$num]);
        // var_dump($res);
        // var_dump($data);
        if($res){
            echo 1;
        }

    }
    //删除购物车 修改is_del状态 单删批删
    public function delcart(Request $request)
    {
        $data=$request->all();
        $goods_id=$data['goods_id'];
        
        $type=$data['type'];
        if($type==1){
            $res=Cart::where('goods_id',$goods_id)->delete();
        }else if($type==2){
            $goods_id=explode(',',$goods_id);

            $res=Cart::where('goods_id',$goods_id)->delete();
        }
        if($res){
            echo 1;
        }else{
            echo 2;exit;
        }
    }
    //结算
    public function pay(Request $request)
    {
        $data=$request->all();
        // var_dump($data);
        $goods_id=$data['goods_id'];
        session(['goods_id'=>$goods_id]);

    }
    //结算视图
    public function payment(Request $request)
    {
        $goods_id=session('goods_id');
        $user_id=session('login_id');
        $goods_id=explode(',',$goods_id);
        $data=Goods::join('cart','cart.goods_id','=','goods.goods_id')->where('cart.user_id',$user_id)->whereIn('goods.goods_id',$goods_id)->get();
        // var_dump($data);exit;
        return view('goods.payment',['data'=>$data]);
    }
    //个人中心
    public function userpage()
    {
        $user_id=session('login_id');
        if(empty($user_id)){
            echo "<script>alert('请先登录'),location.href='login'</script>" ;
        }
        $data=User::where('user_id',$user_id)->first();
        return view('goods.userpage',['data'=>$data]);
    }
    //收货地址展示
    public function address()
    {
        $user_id=session('login_id');
        $data=Address::where('user_id',$user_id)->get();
        return view('goods/address',['data'=>$data]);
    }
    //添加收货地址
    public function writeaddr()
    {
        return view('goods.writeaddr');
    }
    //添加收货地址执行
    public function writeaddrdo(Request $request)
    {
        $user_id=session('login_id');
        $data=$request->all();
        $data=$data['obj'];
        $data['user_id']=$user_id;
        // var_dump($data);
        $res=Address::insert($data);
        if($res){
            echo 1;
        }else{
            echo 2;exit;
        }
    }
    //修改默认地址
    public function default(Request $request)
    {
        $address_id=$request->address_id;
        DB::beginTransaction();
        $where=[
            'address_id'=>$address_id,
            'user_id'=>session('login_id'),
        ];
        $result=Address::where('user_id',session('login_id'))->update(['is_default'=>2]);
        $res=Address::where($where)->update(['is_default'=>1]);
        // var_dump($address_id);
        if($result&&$res){
            DB::commit();
            echo 1;
        }else{
            DB::rollback();
            echo 2;exit;
        }
    }
    //修改地址视图
    public function editaddr(Request $request)
    {
        $address_id=$request->id;
        session(['address_id'=>$address_id]);
        // var_dump($address_id);exit;
        $data=Address::where('address_id',$address_id)->first();
        // var_dump($data);exit;
        return view('goods/editaddr',['data'=>$data]);
    }
    //修改执行
    public function editaddrdo(Request $request)
    {
        $address_id=session('address_id');
        $arr=Address::where('address_id',$address_id)->first();
        // $address_name=$arr['address_name'];
        $arr=[
            'address_name'=>$arr['address_name'],
            'address_tel'=>$arr['address_tel'],
            'address_area'=>$arr['address_area'],
            'address_content'=>$arr['address_content'],
            'is_default'=>$arr['is_default'],
        ];
        //
        $data=$request->all();
        $data=$data['obj'];
        // var_dump($arr);
        // var_dump($data);exit;
        if($arr==$data){
            echo 1;exit;
        }
        $res=Address::where('address_id',$address_id)->update($data);
        if($res){
            echo 2;
        }else{
            echo 3;exit;
        }
        
        
        
    }
    //删除收货地址
    public function deladdr(Request $request)
    {
        $address_id=$request->address_id;
        $res=Address::where('address_id',$address_id)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;exit;
        }
    }
    //我的潮沟
    public function buyrecord()
    {
        $sendgoods=Goods::orderBy('send_num','desc')->limit(4)->get();
        return view('goods.buyrecord',['sendgoods'=>$sendgoods]);
    }
}