<?php
namespace  app\home\controller;
use think\Controller;
use think\Session;
use app\home\controller\Login;

class Base extends Controller{
    public function _initialize(){
        $user_login = Session::get('weijia_kuai');
        if(empty($user_login)){
            echo 444;exit;
        }
   }
}


?>
