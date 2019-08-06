<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\AdminModel;
use think\Db;

class Meet extends Controller{
   public function index(){
       return $this->fetch();
   }

    public function update(){
        return $this->fetch();
    }



}



?>
