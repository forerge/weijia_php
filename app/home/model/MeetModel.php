<?php
namespace app\home\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class MeetModel extends Model{
    protected $table = 'meet';

//    public function getHPidAttr($value){
//        $status = ['一般房源','全权委托','委托带客看房'];
//        return $status[$value];
//    }
    public function house(){
        return $this->hasMany('house','h_id','mh_id');
    }


}





?>