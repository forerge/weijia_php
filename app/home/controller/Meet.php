<?php
namespace  app\home\controller;
use app\admin\model\MeetModel;
use think\Controller;
use think\Db;
use think\Request;

class Meet extends controller{
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

    public function add(){
        $params = Request::instance()->param();
        $meet = new MeetModel();
        $map['mh_id'] = $params['h_id'];
        $map['mu_id'] = $params['u_id'];
        $map['m_time'] = $params['time'] ;
        $map['m_ctime'] = time();
        $map['m_content'] = $params['content'];
        $list = $meet->save($map);
        if($list){
            echo 1;
        }else{
            echo 0;
        }

    }

}


?>
