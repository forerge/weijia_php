<?php
namespace  app\home\controller;
use app\home\controller\Base;
use imageUpload\ImageUpload;
use think\Controller;
use think\Request;

class Index extends controller{
   public function index(){
       echo 'aaa';exit;
   }


public function uploads(){
    $list = Request::instance()->param();
    $upload = new ImageUpload('public/uploads/'.$list['url'].'/');
    $data = $upload->startUpload();
    echo $data;
}

}
?>
