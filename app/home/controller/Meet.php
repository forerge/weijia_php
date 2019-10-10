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
        $map['m_time'] = $params['time']/1000 ;
        $map['m_ctime'] = time();
        $map['m_content'] = $params['content'];
        $map['mhu_id'] = $hu_id['hu_id'];
//        var_dump($params);
//        var_dump($map);
//        die;
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
                $test = json_decode($val['h_uploads'],true);
                $test_data=[];
                foreach($test as $k => $v){
                    $str = str_replace("\\",'/',$v);
                    $arr = str_replace("//",'/',$str);
                    $test_data[$k] = SERVER_WEIJIA.$arr;
                }
                $val['h_uploads'] = $test_data;
                $val['h_rule'] = house_rule($val['h_rule']);
                $val['m_level'] = meet_level($val['m_level']);
            }
        }
        $list_data = json_encode($list,JSON_UNESCAPED_UNICODE);
        return $list_data;

    }

    public function kuai_list_fangdong(){
        $params = Request::instance()->param();

        $list = Db::table('meet m')
            ->join('house h','h.h_id = m.mh_id')
            ->join('user u','u.u_id = m.mu_id')
            ->field('m.*,h.h_qv,h.h_addr,h.h_state,h_level,u.u_phone,u.u_name,u.u_tname')
            ->where('m.mhu_id','=',$params['id'])       //B端收到的预约邀请
            ->where('m.mu_id','<>',$params['id'])       //不是自己预约的
            ->where('m_status','<>',-1)                 //B端（例：职业经纪人）方删除
            ->where('m_level','<>',-1)                  //排除B端自己拒绝的
            ->order('m_level,m_ctime desc')
            ->select();

        $data = [];
        if(count($list)>0){
            foreach($list as $key => &$val){
               if(!empty($val['u_tname'])){
                   $val['u_uname'] = $val['u_tname'];
               }else{
                   $val['u_uname'] = $val['u_name'];
               }
                $val['h_state'] = $val['h_state']==1?'整租':"合租";
                $val['m_time'] = date('Y-m-d H:i:s',$val['m_time']);
            }
        }
        $list_data = json_encode($list,JSON_UNESCAPED_UNICODE);
        return $list_data;

    }

    public function kuai_meet_shenhe(){
        $params = Request::instance()->param();
        if($params['agree'] == 2){
            Db::table('meet')->where('m_id','=',$params['id'])->update(['m_level'=>2]);
        }else{
            Db::table('meet')->where('m_id','=',$params['id'])->update(['m_level'=>-1,'m_because'=>'已租出','m_status'=>'-1']);
        }
        echo 1;
    }

    public function kuai_meet_del(){
        $params = Request::instance()->param();
        if(Db::table('meet')->where('m_id','=',$params['id'])->update(['m_status'=>-1])){
            echo 1;
        }
    }






}


?>
