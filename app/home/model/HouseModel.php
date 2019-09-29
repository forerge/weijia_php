<?php
namespace app\home\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class HouseModel extends Model{
    protected $table = 'house';

    public function getHPidAttr($value){
        $status = ['一般房源','全权委托','委托带客看房'];
        return $status[$value];
    }
    public function getHRuleAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','压一付一','压一付三','半年付'];
        return $arr[$num];
    }
    public function getHStatusAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','快租房','青年公寓'];
        return $arr[$num];
    }
    public function getHLevelAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = [-1=>'成交',0=>'不限',1=>'出租中',2=>'下架'];
        return $arr[$num];
    }
    public function getHStateAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','整租','合租'];
        return $arr[$num];
    }
    public function getHElevatorAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','有','无'];
        return $arr[$num];
    }
    public function getHWeijiaAttr($a){
        $arr = ['不限','唯家房源','社会房源'];
        return $arr[$a];
    }
    public function getHTuijianAttr($a){
        $arr = ['','不推荐','参与推荐'];
        return $arr[$a];
    }
    public function getHUploadsAttr($a){
        $str = str_replace("\\",'/',$a);
        $arr = str_replace("//",'/',$str);
        $data = json_decode($arr,true);
        foreach($data as &$val){
            $val = SERVER_WEIJIA.$val;
        }
        return $data;
    }
    public function getHImgAttr($a){
        $str = str_replace("\\",'/',$a);
        $arr = str_replace("//",'/',$str);
        $data = SERVER_WEIJIA.$arr;
        return $data;
    }






}





?>