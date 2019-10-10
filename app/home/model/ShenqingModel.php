<?php
namespace app\home\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class ShenqingModel extends Model{
    protected $table = 'shenqing';

//    public function getHPidAttr($value){
//        $status = ['一般房源','全权委托','委托带客看房'];
//        return $status[$value];
//    }

        public function getSStatusAttr($value){
            $status = [0=>'不限',1=>'申请中',2=>'通过',-1=>'拒绝'];
            return $status[intval($value)];
        }

    public function getSLevelAttr($a){
        $status = [0=>'不限',1=>'申请职业房东',2=>'申请职业经纪人',3=>'申请房源转到青年公寓',4=>'房产认证'];
        return $status[$a];
    }


}





?>