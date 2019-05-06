                        <div class="goodList mui-scroll">
                            <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
                                @foreach($arr as $vv)
                                <li id="23468">    
                                    <span class="gList_l fl">
                                        <a href="{{url('goods/shopcontent')}}/{{$vv->goods_id}}"><img class="lazy" src="/uploads/{{$vv->goods_img}}"></a>        
                                        
                                    </span>    
                                    <div class="gList_r">        
                                        <h3 class="gray6">{{$vv->goods_name}}</h3>        
                                        <em class="gray9">价值：￥{{$vv->self_price}}</em>
                                        <div class="gRate">            
                                            <div class="Progress-bar">    
                                                <p class="u-progress">
                                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                                </p>                
                                                <ul class="Pro-bar-li">
                                                    <li class="P-bar01"><em>7342</em>已参与</li>
                                                    <li class="P-bar02"><em>7988</em>总需人次</li>
                                                    <li class="P-bar03"><em>646</em>剩余</li>
                                                </ul>            
                                            </div>           
                                            <a codeid="12785750" class="" id="add" goods_id="{{$vv->goods_id}}" canbuy="646"><s></s></a>   
                                            <input type="hidden" value="{{csrf_token()}}" id="_token">   
                                        </div>    
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>    