<?php
namespace  app\home\controller;
use app\home\model\ImgModel;
use app\home\model\MeetModel;
use app\home\model\HouseModel;
use app\home\model\ShenqingModel;
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
       $data['banner'] = $img->where('i_level','=',1)
           ->where('i_status','=',1)
           ->order('i_sort')->select();
       $list = json_encode($data,JSON_UNESCAPED_UNICODE);
       return $list;
   }

    public function qing_hot(){
        $house_data = new HouseModel();
        $map['h_level'] = 1;
        $map['h_tuijian'] = 2;
        $map['h_status'] = 2;
        $map['h_shenhe'] = 1;
//       $data = $house->where($map)->limit(3)->select();
        $data['house'] = $house_data->where($map)->limit(3)->select();

        $img = new ImgModel();
        $data['banner'] = $img->where('i_level','=',1)
            ->where('i_status','=',2)
            ->order('i_sort')->select();
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
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public function qing_list(){
        $state = Request::instance()->param();

        $house = new HouseModel();
        $map['h_level'] = 1;
        $map['h_status'] = 2;
        $map['h_shenhe'] = 1;
        if(!empty($state)){
            $map['h_state'] = $state['state'];
        }
        $data = $house
            ->where($map)
            ->select();
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

    public function kuai_detail_zufang(){
        $house = new HouseModel();
        $meet = new MeetModel();
        $data = Request::instance()->param();
        $hid = is_int($data['hid'])?$data['hid']:intval($data['hid']);
        $mid = is_int($data['mid'])?$data['mid']:intval($data['mid']);
        $data['house'] = $house->where('h_id','=',$hid)->find();
        $data['meet'] = $meet->where('m_id','=',$mid)->find();
        $name = $data['house']['h_qv'];
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
//        var_dump($params['one']['pid']);die;
        if(isset($params['one']['pid'])){
            $house->h_pid = intval($params['one']['pid']) ;
        }
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
        $house->h_hname = $params['two']['hname'];    //签合同的乙方名称
        $house->hu_name = $params['one']['name'];    //发布房源者的真实姓名
        $house->h_ting = $params['one']['ting'];
        $house->h_wei = $params['one']['wei'];
        $house->h_addr = $params['one']['addr'];
        $house->h_space = $params['one']['space'];
        $house->h_xiang = $params['one']['xiang'];
        $house->hu_phone = $params['one']['phone'];
//        $house->hu_phone = $params['one']['tel'];
        $house->h_money = $params['one']['money'];
        $house->h_floor = $params['one']['floor']>0?$params['one']['floor']:-1;
        $house->h_car = $params['one']['car']>0?$params['one']['car']:-1;
        $house->h_elevator = $params['one']['elevator']>0?$params['one']['elevator']:-1;
        $house->h_rule = $params['one']['rule'];

        $house->h_many = $params['two']['renshu'];
        $house->h_content = $params['two']['buchong'];
        $result = HouseModel::many_json($params['two']['fangwupeizhi'],$params['two']['chuzuyaoqiu'],$params['two']['fangwuliangdian'],$params['one']['in_money']);
        $images = HouseModel::images($params['one']['uploads'],$params['two']['img']);
        $house->h_ask = $result['h_ask'];
        $house->h_inmoney = $result['h_inmoney'];
        $house->h_liangdian = $result['h_liangdian'];
        $house->h_config = $result['h_config'];
        $house->h_uploads = $images['h_uploads'];
        $house->h_img = $images['h_img'];
        $house->save();

//
//        $shenqing = new ShenqingModel();
//        $shenqing->su_id = $params['one']['uid'];
//        $shenqing->s_level = 4;
//        $shenqing->sh_id = $house->h_id;
//        $shenqing->s_ctime = time();
//        $shenqing->save();

        echo 1;
    }



    public function kuai_wuye_one(){
        $params = Request::instance()->param();
        $house = Db::table('house')->where('h_id','=',$params['id'])->field('h_id,h_hname')->find();
        $list = json_encode($house,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public function kuai_wuye_jiaojie(){
        $params = Request::instance()->param();
        if(Db::table('house')->where('h_id','=',$params['id'])->update(['h_tel'=>$params['tel'],'h_wuye'=>2])){

        }
    }

    public function kuai_wodefabu(){
        $params = Request::instance()->param();
        $list = Db::table('house')
            ->where('hu_id','=',$params['uid'])
            ->where('h_level','=',intval($params['level']))
            ->field('h_qv,h_id,h_addr,h_state,h_level,h_space')
            ->select();
        if(!empty($list)){
            $test = array_unique(array_column($list,'h_qv')) ;
            $test2=[];
            foreach($list as $k =>$v){
                $v['h_state'] = $v['h_state'] == 1?'整租':'合租';
                if(in_array($v['h_qv'],$test)){
                    $test2[$v['h_qv']][] = $v;
                }
            }
            $data = json_encode($test2,JSON_UNESCAPED_UNICODE);
        }else{
            $data =0;
        }
        return $data;
    }

public function kuai_wodefabu_change_level(){
    $params = Request::instance()->param();
    if(Db::table('house')->where('h_id','=',intval($params['hid']))->update(['h_level'=>$params['level']])){
        echo 1;
    }else{
        echo 0;
    }
}

















}


?>
