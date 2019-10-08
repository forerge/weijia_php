<?php
namespace  app\home\controller;
use app\home\model\OrderModel;
use think\Controller;
use think\Db;
use think\Request;

class Order extends controller{
    //快租房---普通租客预约查询
   public function kuai_order(){
       Db::startTrans();
       $result = 0;
       $params = Request::instance()->param();
       $map['ou_id'] = is_int($params['uid'])?$params['uid']:intval($params['uid']);
       $map['oh_id'] = is_int($params['hid'])?$params['hid']:intval($params['hid']);
       $map['ohu_id'] = is_int($params['huid'])?$params['huid']:intval($params['huid']);
       $map['o_money'] = is_int($params['money'])?$params['money']:intval($params['money']);
       $map['o_ymoney'] = is_int($params['ymoney'])?$params['ymoney']:intval($params['ymoney']);
       $map['o_zmoney'] = is_int($params['zmoney'])?$params['zmoney']:intval($params['zmoney']);
       $map['o_long'] = is_int($params['long'])?$params['long']:intval($params['long']);
       $test_data = $params['img']['imgUploadView1'];
       foreach($test_data as &$v){
           $v = str_replace('public/uploads/','',$v);
       }
       $map['o_img'] = json_encode($test_data,true) ;

       $order = new OrderModel();
       $list = $order->create($map);
       Db::table('meet')->where('m_id','=',$params['mid'])->update(['mo_id'=>intval($list['o_id'])]);
       try{
           $result = 1;
           // 提交事务
           Db::commit();
       } catch (\Exception $e) {
           // 回滚事务
           Db::rollback();
       }

      echo $result;
   }

    public function kuai_order_hetong(){
        $order = Db::table('record')->where('r_id','=',2)->field('r_hetong')->find();
        $list = json_encode($order,JSON_UNESCAPED_UNICODE,true);
        return $list;
    }

    public function kuai_order_wode(){
        $params = Request::instance()->param();
//       echo $params['role'];
        $role = $params['role'];
        $uid = $params['u_id'];
//        $map['o_status'] = [2,3];
        $map['o_level'] = 1;
        $map['o_leixing'] = 1;
        if($role == 1){
            $key = 'ou_id';
        }else{
            $key = 'ohu_id';
        }
        $map[$key] = $uid;

        $order = Db::table('order')
            ->where($map)->where('o_status','in',[2,3])
            ->join('house','house.h_id = order.oh_id')
            ->select();
        if(!empty($order)){

            $list = json_encode($order,JSON_UNESCAPED_UNICODE);
        }else{
            $list = 0;
        }
        return $list;
    }



}


?>
