<?php
namespace  app\admin\controller;
use think\Controller;
use think\Db;

class Coupon extends Controller{
   public function index(){
       return $this->fetch();
   }

    public function update(){
            return $this->fetch();
    }

    public function del(){
//        $id = intval($_POST['id']);
//        Db::table('admin')->where('a_id','=',$id)->update(['a_status'=>-1]);
    }

    public function add(){
        if($_POST){
            $map['c_level'] = $_POST['c_level'];
            $map['c_status'] = 1;
            $map['c_state'] = 1;
            $map['c_ctime'] =time();
            $map['cu_id'] = $_POST['cu_id'];
            var_dump($_POST);die;
        }else{
            $users = Db::table('user')->field('u_id,u_name')->select();
            $this->assign('users',$users);
            return $this->fetch();
        }
    }



}



?>
