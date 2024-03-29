<?php
namespace  app\home\controller;
use app\home\model\OrderModel;
use think\Controller;
use think\Db;
use think\Request;

class Order extends controller{

   public function qing_order_add(){
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
           $map['o_ctime'] = time();
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

    public function kuai_list_fangke(){
        $params = Request::instance()->param();
        $uid = $params['u_id'];
        $map['o_level'] = 1;
        $map['o_leixing'] = 1;
//        $map['o_status'] > 0;
        $map['ou_id'] = $uid;
        $order = Db::table('order')
            ->where($map)
//            ->where('o_status','>',0)
            ->join('house','house.h_id = order.oh_id')
            ->select();
//        var_dump($order);die;
        if(!empty($order)){
            $list = json_encode($order,JSON_UNESCAPED_UNICODE);
        }else{
            $list = 0;
        }
        return $list;
    }

    public function kuai_list_fangdong(){
        $params = Request::instance()->param();
        $uid = $params['u_id'];
        $map['o_level'] = 1;
        $map['o_leixing'] = 1;
        $map['ohu_id'] = $uid;
        $order = Db::table('order')
            ->where($map)
            ->where('o_status','>',0)
            ->join('house','house.h_id = order.oh_id')
            ->select();
        if(!empty($order)){
            $list = json_encode($order,JSON_UNESCAPED_UNICODE);
        }else{
            $list = 0;
        }
        return $list;
    }

    public function qing_order_del()
    {
        $params = Request::instance()->param();
        $list = Db::table('order')->where('o_id', '=', $params['o_id'])->update(['o_level' => -1]);
        if ($list) {
            echo 1;
        } else {
            echo 0;
        }
//        echo 1;
    }

    public function kuai_order_chengjiao()
    {
        $params = Request::instance()->param();
        $order = Db::table('order')->where('o_id','=',$params['oid'])->find();
        $yu_e = $order['o_money']-$order['o_zmoney']-$order['o_ymoney'];
        $time = time();
        $record = Db::table('record')->where('r_id','=',1)->find();
        $money = $record['r_coupon0'];
        Db::startTrans();
        try{
            Db::table('order')->where('o_id','=',$params['oid'])->update(['o_ctime'=>$time,'o_status'=>3]);
            Db::table('house')->where('h_id','=',$params['hid'])->update(['h_level'=>-1,'h_etime'=>$time,'h_money1'=>$order['o_zmoney']]);
            Db::table('user')->where('u_id','=',$params['uid'])
                ->update(['uh_id'=>$params['hid'],'u_yajin'=>$order['o_ymoney'],'u_zujin'=>$order['o_zmoney'],'u_money1'=>$yu_e,'u_intime'=>$time]);
            $data = ['c_ctime'=>$time,'c_money'=>$money,'cu_id'=>$params['uid'],'cu_sid'=>$params['uid']];
            Db::table('coupon')->insert($data);
            // 提交事务
            Db::commit();
            echo 1;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            echo 0;
        }
    }

    public function kuai_list_fangke_wuye(){
        $params = Request::instance()->param();
        $orders = Db::table('order o')
            ->join('house h','h.h_id = o.oh_id')
            ->join('user u','u.uh_id = h.h_id')
            ->where('ou_id','=',$params['uid'])  //本人相关订单
            ->where('o.o_status','=',3)          //订单状态完成
            ->where('o.o_leixing','=',1)         //租房类型订单
            ->where('h.h_level','=',-1)          //成交房源
            ->where('u.u_level','=',1)           //正常状态用户
            ->field('o.*,h.h_qv,h.h_addr,h.h_wuye')
            ->select();
        if(!empty($orders)){
            $list = json_encode($orders,JSON_UNESCAPED_UNICODE);
        }else{
            $list = 0;
        }
        return $list;
    }

    public function kuai_list_fangdong_wuye(){
        $params = Request::instance()->param();
        $orders = Db::table('order o')
            ->join('house h','h.h_id = o.oh_id')
            ->join('user u','u.uh_id = h.h_id')
            ->where('ohu_id','=',$params['uid'])  //本人相关订单
            ->where('o.o_status','=',3)          //订单状态完成
            ->where('o.o_leixing','=',1)         //租房类型订单
            ->where('h.h_level','=',-1)          //成交房源
            ->field('o.*,h.h_qv,h.h_addr,h.h_wuye,h.h_id,o.o_id')
            ->select();
        if(!empty($orders)){
            $list = json_encode($orders,JSON_UNESCAPED_UNICODE);
        }else{
            $list = 0;
        }
        return $list;
    }

    public function qing_baojie(){
        $params = Request::instance()->param();
        $params['o_ctime'] = time();
        $params['o_state'] = 1;
        $params['o_leixing'] = 2;
        if(Db::table('order')->insert($params)){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function qing_baojie_have(){
        $params = Request::instance()->param();

        $map['o_level'] = 1;
        $map['o_leixing'] = 2;
        $map['ou_id'] = $params['ou_id'];
        $map['oh_id'] = $params['oh_id'];
        $data = Db::table('order')->where($map)
            ->where('o_status','in',[1,2])
            ->find();
        if($data){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function qing_baojie_chexiao(){
        $params = Request::instance()->param();
        $data = Db::table('order')->where('o_id','=',$params['o_id'])->update(['o_status'=>-1]);
        if($data){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function qing_baojie_jiaofei(){
        $params = Request::instance()->param();
        $data = Db::table('order')->where('o_id','=',$params['o_id'])->update(['o_status'=>3]);
        if($data){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function qing_weixiu_tianjia(){
        $params = Request::instance()->param();
        $params['o_ctime'] = time();
        $params['o_leixing'] = 3;
        $list = Db::table('order')->insert($params);
        if($list){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function qing_weixiu(){
        $params = Request::instance()->param();
        $data = Db::table('order')->where($params)->order('o_id desc')->select();
        if($data){
            $list = json_encode($data,JSON_UNESCAPED_UNICODE);
            return $list;
        }
    }

    public function qing_weixiu_zhifu(){
        $params = Request::instance()->param();
        $data = Db::table('order')->where('o_id','=',$params['o_id'])->update(['o_money'=>$params['o_money'],'o_status'=>3]);
        if($data){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function qing_weixiu_detail(){
        $params = Request::instance()->param();
        $data = Db::table('order')->where('o_id','=',$params['o_id'])->find();
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public function qing_order_list(){
        $params = Request::instance()->param();
        $data = Db::table('order')->where($params)->where('o_status','=',3)->order('o_ctime desc')->select();
        foreach($data as &$v){
            $v['o_ctime'] = date('Y-m-d H:i:s',$v['o_ctime']);
            $v['o_leixing'] = order_leixing($v['o_leixing']);
        }
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        if(!empty($list)){
            return $list;
        }else{
            echo 0;
        }

    }

    public function qing_jiaozu(){
        $params = Request::instance()->param();
        $data = Db::table('order')->order('o_ctime desc')
            ->where('ou_id','=',$params['u_id'])
            ->where('oh_id','=',$params['uh_id'])
            ->where('o_status','=',3)->find();
        if(!empty($data)){
            $data['o_ctime'] = date('Y-m-d H:i:s',$data['o_ctime']);
            $list = json_encode($data,JSON_UNESCAPED_UNICODE);
            return $list;
        }else{
            echo 0;
        }
    }

    public function qing_order_fangzu(){
        $params = Request::instance()->param();
        $params['o_leixing'] = 4;
        $params['o_status'] = 3;
        $params['o_state'] = 1;
        $params['o_ctime'] = time();
        $data = Db::table('order')->insert($params);
        if($data){
            echo 1;
        }else{
            echo 0;
        }
    }




}


?>
