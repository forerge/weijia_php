<?php
namespace  app\admin\controller;
use think\Controller;
use think\Request;

class Index extends Controller{
   public function index(){
//       $this->view->engine->layout('common/left');
       return view();
   }

    public function top(){
        return view();
    }

    public function left(){
        return view();
    }

    public function right(){
        return view();
    }

    public function test1(){
        echo 'yyy';
    }


}



?>
