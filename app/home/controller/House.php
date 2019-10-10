<?php
namespace  app\home\controller;
use app\home\model\ImgModel;
use app\home\model\MeetModel;
use app\home\model\HouseModel;
use think\Controller;
use think\Db;
use think\Request;

class House extends Controller{

    //快租房---首页推荐列表
   public function kuai_hot(){
       $house_data = new HouseModel();
       $map['h_level'] = 1;
       $map['h_tuijian'] = 2;
       $map['h_status'] = 1;
       $map['h_shenhe'] = 1;
//       $data = $house->where($map)->limit(3)->select();
       $data['house'] = $house_data->where($map)->limit(3)->select();
       $img = new ImgModel();
       $data['banner'] = $img->where('i_level','=',1)->order('i_sort')->select();
       $list = json_encode($data,JSON_UNESCAPED_UNICODE);
       return $list;
   }

    //快租房----房源列表
    public function kuai_list(){
        $state = Request::instance()->param();

        $house = new HouseModel();
        $map['h_level'] = 1;
        $map['h_shenhe'] = 1;
        if(!empty($state)){
            $map['h_state'] = $state['state'];
        }
        $map['h_status'] = 1;
        $data = $house
            ->where($map)
            ->select();

        $list = json_encode($data);
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
        $same_data = $same_house->where('h_qv','=',$name)->where('h_shenhe','=',1)->limit(3)->select();
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

    public function kuai_add(){
        $params = Request::instance()->param();
//        var_dump($params);die;
        $house = new HouseModel();
        $house->h_qv = $params['one']['qv'];
        $house->h_shi = $params['one']['shi'];
        $house->h_state = $params['one']['state'];
        $house->hu_id = $params['one']['uid'];
        $house->h_status = $params['one']['status'];
        $house->h_weijia = $params['one']['weijia'];
        $house->h_listen = $params['one']['listen'];
        $house->h_province = $params['one']['h_province'];
        $house->h_city = $params['one']['h_city'];
        $house->h_area = $params['one']['h_area'];
        $house->h_metro_no = $params['one']['metro_no'];
        $house->h_metro_length = $params['one']['metro_length'];
        $house->hu_name = $params['one']['name'];
        $house->h_ting = $params['one']['ting'];
        $house->h_wei = $params['one']['wei'];
        $house->h_addr = $params['one']['addr'];
        $house->h_space = $params['one']['space'];
        $house->h_xiang = $params['one']['xiang'];
        $house->h_money = $params['one']['money'];
        $house->h_floor = $params['one']['floor']>0?$params['one']['floor']:-1;
        $house->h_car = $params['one']['car']>0?$params['one']['car']:-1;
        $house->h_elevator = $params['one']['elevator']>0?$params['one']['elevator']:-1;
        $house->h_rule = $params['one']['rule'];
        $house->h_inmoney = json_encode($params['one']['in_money'],true);
        $house->h_many = $params['two']['renshu'];
        $house->h_content = $params['two']['buchong'];
        $result = HouseModel::many_json($params['two']['fangwupeizhi'],$params['two']['chuzuyaoqiu'],$params['two']['fangwuliangdian']);
        $images = HouseModel::images($params['one']['uploads'],$params['two']['img']);
        $house->h_ask = $result['h_ask'];
        $house->h_liangdian = $result['h_liangdian'];
        $house->h_config = $result['h_config'];
        $house->h_uploads = $images['h_uploads'];
        $house->h_img = $images['h_img'];
//        var_dump($house);die;
        if($house->save()){
            echo 1;
        }else{
            echo 0;
        }

    }



}


?>
