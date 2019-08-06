<?php
namespace  app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class Login extends Controller{
   public function index(){
       if($_POST){
           $name = trim($_POST['a_name']);
           $pw = trim($_POST['a_pwd']);
           $list = Db::table('admin')->where('a_name','=',$name)->find();
           if(empty($list)){
               return $this->error('账号不存在！');
           }
           $pwd = md5($pw);
           $a_pwd = md5($pwd.','.$list['a_toke']);
           if($a_pwd === $list['a_pwd']){
               Session::set('weijia',$list);
               return $this->redirect('index/index');
           }else{
               return $this->error('密码错误！');
           }
       }else{

           return view();
       }
   }

    public function login_out(){
        Session::set('weijia','');
        return $this->redirect('index');
    }

}



?>
