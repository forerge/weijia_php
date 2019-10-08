<?php
namespace  app\home\controller;
use app\home\model\MeetModel;
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
        $test = $params['role'];
        if($test == 1){
            $keys = 'mu_id';
        }else{
            $keys = 'mhu_id';
        }
        $meet = new MeetModel();
        $list = $meet->join('house','house.h_id = meet.mh_id')->where($keys,'=',$params['id'])->where('meet.mo_id','=',0)->select();
        $data = [];
        if(count($list)>0){
            foreach($list as $key => &$val){
//                $data[$key]['m_id'] = $val['m_id'];
//                $data[$key]['mu_id'] = $val['mu_id'];
//                $data[$key]['mh_id'] = $val['mh_id'];
//                $data[$key]['m_ctime'] = $val['m_ctime'];
//                $data[$key]['m_level'] = $val['m_level'];
//                $data[$key]['m_etime'] = $val['m_etime'];
//                $data[$key]['m_because'] = $val['m_because'];
//                $data[$key]['m_status'] = $val['m_status'];
//                $data[$key]['m_content'] = $val['m_content'];
//                $data[$key]['m_time'] = $val['m_time'];
//                $data[$key]['mhu_id'] = $val['mhu_id'];
//                $data[$key]['hu_name'] = $val['hu_name'];
                $test = json_decode($val['h_uploads'],true);
                $test_data=[];
                foreach($test as $k => $v){
                    $str = str_replace("\\",'/',$v);
                    $arr = str_replace("//",'/',$str);
                    $test_data[$k] = SERVER_WEIJIA.$arr;
                }
                $val['h_uploads'] = $test_data;
            }
        }
        $list_data = json_encode($list,JSON_UNESCAPED_UNICODE);
        return $list_data;

    }

}


?>
