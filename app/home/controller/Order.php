<?php
namespace  app\home\controller;
use app\home\model\OrderModel;
use think\Controller;
use think\Db;
use think\Request;

class Order extends controller{
    //快租房---普通租客预约查询
   public function kuai_order(){
       $params = Request::instance()->param();
//        var_dump($params['uid']);die;
       $map['ou_id'] = is_int($params['uid'])?$params['uid']:intval($params['uid']);
       $map['oh_id'] = is_int($params['hid'])?$params['hid']:intval($params['hid']);
       $map['ohu_id'] = is_int($params['huid'])?$params['huid']:intval($params['huid']);
       $map['o_money'] = is_int($params['money'])?$params['money']:intval($params['money']);
       $map['o_ymoney'] = is_int($params['ymoney'])?$params['ymoney']:intval($params['ymoney']);
       $map['o_zmoney'] = is_int($params['zmoney'])?$params['zmoney']:intval($params['zmoney']);
//       var_dump($map);die;
       $order = new OrderModel();
       if($order->save($map)){
           echo 1;
       }else{
           echo 0;
       }
   }



}


?>
