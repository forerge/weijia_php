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
    $arr = ['不限','职业房东','职业经纪人','房源转到青年公寓','房产认证','实名认证'];
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
    $arr = ['不限','有','无'];
    return $arr[$num];
}
function house_weijia($a){
    $arr = ['不限','唯家房源','社会房源'];
    return $arr[$a];
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