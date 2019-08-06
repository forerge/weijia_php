<?php
namespace  app\admin\controller;
//use think\Controller;
use app\admin\controller\Base;

class Index extends Base{
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

    public function go(){
        return $this->fetch();
    }


}



?>
