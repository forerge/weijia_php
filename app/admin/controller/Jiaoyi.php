<?php
namespace  app\admin\controller;
use think\Controller;
use think\Db;

class Jiaoyi extends Controller{
   public function index(){
       return $this->fetch();
   }

    public function update(){
            return $this->fetch();
    }

    public function del(){
//        $id = intval($_POST['id']);
//        Db::table('admin')->where('a_id','=',$id)->update(['a_status'=>-1]);
    }



}



?>
