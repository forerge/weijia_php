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
        $hu_id = Db::table('house')->where('h_id','=',intval($params['h_id']))->find();
        $meet = new MeetModel();
        $map['mh_id'] = $params['h_id'];
        $map['mu_id'] = $params['u_id'];
        $map['m_time'] = $params['time'] ;
        $map['m_ctime'] = time();
        $map['m_content'] = $params['content'];
        $map['mhu_id'] = $hu_id['h_id'];
        $list = $meet->save($map);
        if($list){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function kuai_list_one(){
        $params = Request::instance()->param();
//        var_dump($params);
//        var_dump($params['role']);die;
        $test = $params['role'];
        if($test == 1){
            $keys = 'mu_id';
        }else{
            $keys = 'mhu_id';
        }
        $meet = new MeetModel();
        $map['m_status'] = 1;
        $map[$keys] = $params['id'];
//        $list = $meet->where($map)->join('house h',)->select();
//        var_dump($list);die;

    }

}


?>
