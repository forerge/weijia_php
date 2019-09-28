<?php
namespace  app\home\controller;
use think\Controller;
use think\Session;

class Base extends Controller{
    public function _initialize(){

        $data_login = Session::get('weijia_home');
        return '123';exit;

   }
}


?>
