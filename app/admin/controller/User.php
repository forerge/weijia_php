<?php
namespace  app\admin\controller;
use think\Controller;
use think\Request;

class User extends Controller{
   public function index(){
       return view();
   }

    public function add(){
        return view();
    }

    public function update(){
        return $this->fetch();
    }


}



?>
