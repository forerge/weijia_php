<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

function json_format($data,$status=0,$msg='返回成功'){
    $list = json_encode($data,JSON_UNESCAPED_UNICODE);
    return [$list,$status,$msg];
}

// 应用公共文件
function yesno($a){
    $arr = [-1=>'否',0=>'不限',1=>'是'];
    return $arr[$a];
}
function haveno($a){
    $arr = [-1=>'没有',0=>'不限',1=>'有'];
    return $arr[$a];
}
function delete($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','正常','已删除'];
    return $arr[$num];
}


function admin_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','总管','主管','员工'];
    return $arr[$num];
}


function user_sex($a){
    $arr = ['不限','男','女'];
    return $arr[$a];
}


function shenqing_status($a){
    $num = is_int($a)?$a:intval($a);
    $arr = [-1=>'拒绝',0=>'不限',1=>'申请中',2=>'同意'];
    return $arr[$num];
}
function shenqing_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','职业房东','职业经纪人','房源转到青年公寓','房产认证','实名认证','房东'];
    return $arr[$num];
}


function house_rule($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','压一付一','压一付三','半年付'];
    return $arr[$num];
}
function house_status($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','快租房','青年公寓'];
    return $arr[$num];
}
function house_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = [-1=>'成交',0=>'不限',1=>'出租中',2=>'下架'];
    return $arr[$num];
}
function house_state($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','整租','合租'];
    return $arr[$num];
}
function house_elevator($a){
    $num = is_int($a)?$a:intval($a);
    $arr = [-1=>'无',0=>'不限',1=>'有'];
    return $arr[$num];
}
function house_weijia($a){
    $arr = ['不限','唯家房源','社会房源'];
    return $arr[$a];
}
function house_tuijian($a){
    $arr = ['','不推荐','参与推荐'];
    return $arr[$a];
}
function house_pid($a){
    $arr = ['一般房源','全权委托','委托带客看房'];
    return $arr[$arr];
}
function house_shenhe($a){
    $num = is_int($a)?$a:intval($a);
    $arr = [-1=>'未审核',0=>'不限',1=>'已审核'];
    return $arr[$num];
}


function coupon_status($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','未用','已用'];
    return $arr[$num];
}
function coupon_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','租房福利券','非租房福利券'];
    return $arr[$num];
}
function coupon_state($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','未赠送','已赠送'];
    return $arr[$num];
}


function meet_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = [-1=>'拒绝',0=>'不限',1=>'申请中',2=>'预约成功'];
    return $arr[$num];
}


function fuwu_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','维修服务','保洁服务'];
    return $arr[$num];
}
function fuwu_status($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['不限','请求中','处理中','完成'];
    return $arr[$num];
}


function book_level($a){
    $arr = ['不限','租房合同','居间合同'];
    return $arr[$a];
}
function book_state($a){
    $arr = ['不限','有效中','到期',''];
    return $arr[$a];
}
function book_status($a){
    $arr = ['不限','审核中','审核成功','已归档'];
    return $arr[$a];
}

function img_level($a){
    $arr = [0=>'不限',1=>'展示',-1=>'不展示'];
    return $arr[$a];
}
function img_status($a){
    $arr = ['不限','快出房','青年公寓'];
    return $arr[$a];
}

function order_leixing($a){
    $arr = [0=>'不限',1=>'租房',2=>'保洁',3=>'维修',4=>'交租',5=>'水费',6=>'电费',7=>'燃气费'];
    return $arr[$a];
}
function order_state($a){
    $arr = [0=>'不限',1=>'微信',2=>'支付宝',3=>'其他'];
    return $arr[$a];
}
function order_status($a){
    $arr = [0=>'不限',1=>'等待确认',2=>'已接收',3=>'完成',-1=>'无效'];
    return $arr[$a];
}