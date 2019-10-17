<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\OrderModel;
use think\Db;
use think\Request;

class Order extends Controller{
   public function index(){
       $result = OrderModel::page_list_house($_POST);
       $this->assign('list',$result['list']);
       $this->assign('pagelist',$result['pagelist']);
       return $this->fetch();
   }

    public function fang(){
        $result = OrderModel::page_list_fang($_POST);
        $this->assign('list',$result['list']);
        $this->assign('pagelist',$result['pagelist']);
        return $this->fetch();
    }

    public function other(){
        $result = OrderModel::page_list_other_house($_POST);
        $this->assign('list',$result['list']);
        $this->assign('pagelist',$result['pagelist']);
        return $this->fetch();
    }

    public function baojie(){
        $result = OrderModel::page_list_baojie($_POST);
        $this->assign('list',$result['list']);
        $this->assign('pagelist',$result['pagelist']);
        return $this->fetch();
    }

    public function update(){
        if($_POST){
            $params = Request::instance()->param();
            $list = Db::table('order')->where('o_id','=',$params['o_id'])->update(['o_status'=>2]);
            if($list){
                $this->redirect('/admin/order/index');
            }
        }else{
            $id = $_GET['id'];
            $order =  $list = Db::table('order o')
                ->join('user u','u.u_id = o.ou_id')->field('o.*,u.u_name')
                ->where('o_id','=',$id)->find();
            if(!empty($order['o_img'])){
                $order['o_img'] = json_decode($order['o_img'],true);
            }
            $this->assign($order);
            return $this->fetch();
        }
    }

    public function house(){
        if($_POST){
            $params = Request::instance()->param();
            $order = Db::table('order')->where('o_id','=',$params['o_id'])->find();
            $yu_e = $order['o_money']-$order['o_zmoney']-$order['o_ymoney'];
            $time = time();
            $record = Db::table('record')->where('r_id','=',1)->find();
            $money = $record['r_coupon0'];
            Db::startTrans();
            try{
                Db::table('order')->where('o_id','=',$params['o_id'])->update(['o_ctime'=>$time,'o_status'=>3]);
                Db::table('house')->where('h_id','=',$params['h_id'])->update(['h_level'=>-1,'h_etime'=>$time,'h_money1'=>$order['o_zmoney']]);
                Db::table('user')->where('u_id','=',$params['u_id'])
                    ->update(['uh_id'=>$params['h_id'],'u_yajin'=>$order['o_ymoney'],'u_zujin'=>$order['o_zmoney'],'u_money1'=>$yu_e,'u_intime'=>$time]);
                $data = ['c_ctime'=>$time,'c_money'=>$money,'cu_id'=>$params['u_id'],'cu_sid'=>$params['u_id']];
                Db::table('coupon')->insert($data);
                Db::commit();
                $this->redirect('/admin/order/agree');
            } catch (\Exception $e) {
                Db::rollback();
            }
        }else{
            $id = $_GET['id'];
            $order =  $list = Db::table('order o')
                ->join('user u','u.u_id = o.ou_id')->field('o.*,u.u_name')
                ->where('o_id','=',$id)->find();
            if(!empty($order['o_img'])){
                $order['o_img'] = json_decode($order['o_img'],true);
            }
            $this->assign($order);
            return $this->fetch();
        }
    }

    public function del(){
        $id = intval($_GET['id']);
        Db::table('order')->where('o_id','=',$id)->delete();
        $this->redirect('/admin/order/index');
    }



}



?>
