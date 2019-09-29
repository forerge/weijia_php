<?php
namespace  app\home\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Base extends Controller{
    public function _initialize(){
        $data_login = Session::get('weijia_kuai');
        if(empty($data_login)){
            $this->redirect('login');
        }
   }

    public function login(){
        $params = Request::instance()->param();
        $map['u_name'] = $params['name'];
        $map['u_pwd'] = $params['pwd'];
        $data = Db::table('user')->where($map)->find();
        if(empty($data)){
            Session::set('weijia_kuai',$data);
            echo 0;
        }else{
            echo 1;
        }
    }

    public function register(){
        
    }

    public function out(){
        Session::set('weijia_kuai','');
    }

}


?>
