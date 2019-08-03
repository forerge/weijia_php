<?php
namespace  app\admin\controller;
use think\Controller;
use think\Request;

class User extends Controller{
   public function index(){
//       $this->view->engine->layout('common/left');
       return view();
   }

    public function top(){
        return view("top/index");
    }

    public function left(){
        return view("left/index");
    }

    public function right(){
        return view("right/index");
    }


}



?>
