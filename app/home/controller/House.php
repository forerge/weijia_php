<?php
namespace  app\home\controller;
use app\admin\model\MeetModel;
use app\home\model\HouseModel;
use think\Controller;
use think\Db;
use think\Request;

class House extends Controller{

    //快租房---首页推荐列表
   public function kuai_hot(){
       $house = new HouseModel();
       $map['h_level'] = 1;
       $map['h_tuijian'] = 2;
       $map['h_status'] = 1;
       $data = $house->where($map)->limit(3)->select();
       $list = json_encode($data,JSON_UNESCAPED_UNICODE);
       return $list;
   }

    //快租房----房源列表
    public function kuai_list(){
        $house = new HouseModel();
        $map['h_level'] = 1;
        $map['h_status'] = 1;
        $data = $house->where($map)->select();
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    //快租房---房源详情
    public function kuai_detail(){
        $house = new HouseModel();
        $data = Request::instance()->param();
        $id = is_int($data['id'])?$data['id']:intval($data['id']);
        $data = $house->where('h_id','=',$id)->find();
        $name = $data['h_qv'];
        $same_house = new HouseModel();
        $same_data = $same_house->where('h_qv','=',$name)->limit(3)->select();
        $data['same'] = $same_data;
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public function kuai_meet(){
        $params = Request::instance()->param();
        $params['uid'] = 30 ;
        $params['hid'] = 18 ;
        $meet = new MeetModel();
        $meet['mu_id'] = is_int($params['uid'])?$params['uid']:intval($params['uid']) ;
        $meet['mh_id'] = is_int($params['hid'])?$params['hid']:intval($params['hid']) ;
        $meet['m_ctime'] = time();
        $meet->save();
        echo 1;
    }

}


?>
