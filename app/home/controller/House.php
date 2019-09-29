<?php
namespace  app\home\controller;
use app\home\model\HouseModel;
use think\Controller;
use think\Db;
use think\Request;

class House extends Controller{
   public function hot(){
       $house = new HouseModel();
       $map['h_level'] = 1;
       $map['h_tuijian'] = 2;
       $map['h_status'] = 1;
       $data = $house->where($map)->limit(3)->select();
       $list = json_encode($data,JSON_UNESCAPED_UNICODE);
       return $list;
   }
}


?>
