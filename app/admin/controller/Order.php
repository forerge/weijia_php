<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\OrderModel;
use think\Db;

class Order extends Controller{
   public function index(){
       $result = OrderModel::page_list_house($_POST);
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

    public function weixiu(){
        $result = OrderModel::page_list_weixiu($_POST);
        $this->assign('list',$result['list']);
        $this->assign('pagelist',$result['pagelist']);
        return $this->fetch();
    }

    public function update(){
        $id = $_GET['id'];
        $order =  $list = Db::table('order o')
            ->join('user u','u.u_id = o.ou_id')
            ->field('o.*,u.u_name')
            ->where('o_id','=',$id)
            ->find();

        if(!empty($order['o_img'])){
            $order['o_img'] = json_decode($order['o_img'],true);
        }
//        var_dump(json_decode($order['o_img'],true));die;
        $this->assign($order);
        return $this->fetch();
    }

    public function del(){
        $id = intval($_GET['id']);
        Db::table('order')->where('o_id','=',$id)->delete();
        $this->redirect('/admin/order/index');
    }



}



?>
