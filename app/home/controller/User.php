<?php
namespace  app\home\controller;
use app\home\controller\Base;

use app\home\model\ShenqingModel;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class User extends Controller{
   public function kuai_apply(){
       $params = Request::instance()->param();
       $id = is_int($params['id'])?$params['id']:intval($params['id']);
       if($params['apply'] == 3){
           $map = ['u_three'=>1];
       }else if($params['apply'] == 4){
           $map = ['u_four'=>1];
       }
       if(Db::table('user')->where('u_id','=',$id)->update($map)){
           echo 1;
       }else{
           echo 0;
       }
   }

    public function kuai_renzheng(){
        $id = Request::instance()->param('uid');
        $role = Request::instance()->param('role');
        $map['su_id'] = $id;
        $map['s_state'] = 1;
        if($role<2){
            $data = Db::table('shenqing')->where($map)->where('s_level','<',3)->select();
        }else{
            $data = Db::table('shenqing s')->where($map)
                ->join('house h','h_id = s.sh_id','left')
                ->field('s.*,h.h_qv,h.h_addr')
                ->select();
        }

//        var_dump($data);
        $list = [];
        foreach($data as $k => $v){
            $list[$k] = $v;
            $list[$k]['level'] = $v['s_level'];
            $list[$k]['s_level'] = shenqing_level($v['s_level']);
            $list[$k]['s_status'] = shenqing_status($v['s_status']);
        }

        $list = json_encode($list,JSON_UNESCAPED_UNICODE);
//        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public function kuai_renzheng_fangdong(){
        $id = Request::instance()->param('uid');
        $map['su_id'] = $id;
        $map['s_state'] = 1;
        $shenqing = new ShenqingModel();
        $data = $shenqing->where($map)->select();
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }

    public function kuai_detail(){
        $id = Request::instance()->param('id');
        var_dump($id);die;

    }

    public function test(){
        var_dump(Session::get('weijia_pro'));
    }

    public function kuai_shuaxin(){
        $params = Request::instance()->param();
        $data = Db::table('user')->where('u_id','=',$params['uid'])->find();
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;
    }





}


?>
