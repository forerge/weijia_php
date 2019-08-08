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