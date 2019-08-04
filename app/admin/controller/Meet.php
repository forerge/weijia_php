<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\Model\AdminModel;
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
