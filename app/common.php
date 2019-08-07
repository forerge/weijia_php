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
    $arr = ['','男','女'];
    return $arr[$a];
}

function shenqing_status($a){
    $num = is_int($a)?$a:intval($a);
    $arr = [-1=>'拒绝',0=>'',1=>'申请中',2=>'同意'];
    return $arr[$num];
}

function shenqing_level($a){
    $num = is_int($a)?$a:intval($a);
    $arr = ['','职业房东','职业经纪人','房源转到青年公寓','房产认证','实名认证'];
    return $arr[$num];
}