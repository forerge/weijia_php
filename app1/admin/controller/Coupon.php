<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\CouponModel;
use think\Request;
use think\Db;

class Coupon extends Controller{
   public function index(){
       $result = CouponModel::page_list($_POST);
       $this->assign('list',$result['list']);
       $this->assign('pagelist',$result['pagelist']);
       return $this->fetch();
   }

    public function update(){
        if($_POST){
            $list = $_POST;
            $id = $list['c_id'];
            unset($list['c_id']);
            $cou = new CouponModel();
            $cou->save($list,['c_id'=>$id]);
            $this->redirect('/admin/coupon/index');
        }else{
            $id = $_GET['id'];
            $coupon = Db::table('coupon c')
                ->join('user u','u.u_id = c.cu_id','left')
                ->field('c.*,u.u_name')
                ->where('c_id','=',$id)
                ->find();
            $cu_sname = Db::table('coupon c')->join('user u','u.u_id = c.cu_sid','left')
                ->field('u.u_name')->where('c_id','=',$id)->find();
            $coupon['cu_sname'] = $cu_sname['u_name'];
            $this->assign($coupon);
            return $this->fetch();
        }
    }

    public function del(){
//        $id = intval($_POST['id']);
//        Db::table('admin')->where('a_id','=',$id)->update(['a_status'=>-1]);
    }

    public function add(){
        if($_POST){
            $company_data = Db::table('record')->where('r_level','=',1)->find();
            $r_money0 = $company_data['r_coupon0'];     //租房劵的面值
            $r_money1 = $company_data['r_coupon0'];     //非租房劵的面值
            $map['c_level'] = $_POST['c_level'];
            if($_POST['c_level'] == 1){
                $map['c_money'] = $r_money0;
            }else if($_POST['c_level'] == 2){
                $map['c_money'] = $r_money1;
            }
            $map['c_status'] = 1;
            $map['c_state'] = 1;
            $map['c_ctime'] =time();
            $map['cu_id'] = $_POST['cu_id'];
            $map['cu_sid'] = $_POST['cu_id'];
            $cou = new CouponModel();
            $cou->save($map);
            $this->redirect('/admin/coupon/index');
        }else{
            $users = Db::table('user')->field('u_id,u_name')->select();
            $this->assign('users',$users);
            return $this->fetch();
        }
    }



}



?>
