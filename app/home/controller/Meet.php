<?php
namespace  app\home\controller;
use app\home\controller\Base;
use think\Controller;
use think\Db;
use think\Request;

class Meet extends Base{
    //快租房---普通租客预约查询
   public function kuai_user(){
       $params = Request::instance()->param();
       $id = is_int($params['id'])?$params['id']:intval($params['id']);
       $map['m_status'] = 1;
       $map['m_level'] = 1;
       $list = Db::table('meet')->where($map)->select();
       $data = json_encode($list,JSON_UNESCAPED_UNICODE);
       return $data;
   }

}


?>
