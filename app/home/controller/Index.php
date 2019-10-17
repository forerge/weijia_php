<?php
namespace  app\home\controller;
use app\home\controller\Base;
use imageUpload\ImageUpload;
use think\Controller;
use think\Db;
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

    public function qing_baojie_have(){
        $params = Request::instance()->param();
        $map['ou_id'] = $params['u_id'];
        $map['oh_id'] = $params['h_id'];
        $map['o_level'] = 1;
        $map['o_leixing'] = 2;
        $data = Db::table('order')->where($map)->where('o_status','in',[1,2])->find();
        $data['o_ctime'] = date('Y-m-d H:i:s',$data['o_ctime']);

        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;

    }

}
?>
