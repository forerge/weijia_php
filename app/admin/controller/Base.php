<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class Base extends Controller{
    public function _initialize(){
        $adm = Session('weijia');
        if(empty($adm)){
            $this->redirect('login/index');
        }
    }
}


?>
