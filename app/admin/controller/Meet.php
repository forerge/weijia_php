<?php
namespace  app\admin\controller;
use app\admin\model\MeetModel;
use think\Controller;
use app\admin\model\AdminModel;
use think\Db;

class Meet extends Controller{
   public function index(){
       if($_POST){

       }else{
           $list = Db::table('meet m')
               ->join('user u','u.u_id=m.mu_id','left')
               ->join('house h','h.h_id = m.mh_id','left')
               ->field('u.u_name,u.u_phone,h.h_addr')
               ->select();
           $this->assign('list',$list);

       }
       return $this->fetch();
   }

    public function update(){
        if($_POST){

        }else{
            $id = $_GET['id'];
            $meet = Db::table('meet')->where('m_id','=',$id)->find();
            $user = Db::table('user')->where('u_id','=',$meet['mu_id'])->find();
            $house = Db::table('house h')->where('h_id','=',$meet['mh_id'])
                ->join('user u','u.u_id = h.hu_id','left')
                ->find();
            $house['h_config'] = json_decode($house['h_config'],true);
            $house['h_ask'] = json_decode($house['h_ask'],true);
            $house['h_inmoney'] = json_decode($house['h_inmoney'],true);
            if(!empty($house['h_uploads'])){
                $house['h_uploads'] = json_decode($house['h_uploads'],true);
            }else{
                $house['h_uploads'] = [];
            }
//            var_dump($house);die;
            $this->assign('user',$user);
            $this->assign($house);
            $this->assign($meet);
            return $this->fetch();
        }
    }

    public function add(){
        if($_POST){
            $house = Db::table('house')->where('h_id','=',$_POST['h_id'])->find();
            $user = Db::table('user')->where('u_id','=',$_POST['u_id'])->find();
            $map['mu_name'] = $user['u_name'];
            $map['mu_id'] = $_POST['u_id'];
            $map['mh_id'] = $_POST['h_id'];
            $map['mu_phone'] = $user['u_phone'];
            $map['mh_name'] = $house['hu_name'];
            $map['mh_phone'] = $house['hu_phone'];
            $map['mh_addr'] = $house['h_province'].'、'.$house['h_city'].'、'.$house['h_area'].'、'.$house['h_town'].'、'.$house['h_qv'].'、'.$house['h_addr'];
            $map['m_ctime'] = time();
            $meet = new MeetModel();
            $meet->save($map);
            $this->redirect('/admin/meet/index');

        }else{
            $users = Db::table('user')->where('u_level','=',1)->select();
            $houses = Db::table('house')->where('h_level','=',1)->select();
            $this->assign('users',$users);
            $this->assign('houses',$houses);
            return $this->fetch();
        }
    }



}



?>
