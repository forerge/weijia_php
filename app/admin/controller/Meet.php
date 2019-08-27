<?php
namespace  app\admin\controller;
use app\admin\model\MeetModel;
use think\Controller;
use app\admin\tools\Page;
use think\Db;

class Meet extends Controller{
   public function index(){
       if($_POST){

       }else{
           $result = MeetModel::page_list();
           $this->assign('list',$result['list']);
           $this->assign('pagelist',$result['pagelist']);
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
            if(!empty($house['h_config'])){
                $house['h_config'] = json_decode($house['h_config'],true);
            }else{
                $house['h_config'] = '';
            }
            if(!empty($house['h_ask'])){
                $house['h_ask'] = json_decode($house['h_ask'],true);
            }else{
                $house['h_ask'] = '';
            }
            if(!empty($house['h_inmoney'])){
                $house['h_inmoney'] = json_decode($house['h_inmoney'],true);
            }else{
                $house['h_inmoney'] = '';
            }
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
            $map['mu_id'] = $_POST['u_id'];
            $map['mh_id'] = $_POST['h_id'];
            $map['m_ctime'] = time();
            $meet = new MeetModel();
            $meet->save($map);
//            echo Db::table('meet')->getLastSql();die;
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
