<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\tools\Page;
use app\admin\model\FuwuModel;
use think\Db;

class Fuwu extends Controller{
   public function index(){
       $result = FuwuModel::page_list($_POST);
       $this->assign('list',$result['list']);
       $this->assign('pagelist',$result['pagelist']);
       return $this->fetch();
   }

    public function update(){
        if($_POST){

        }else{
            $id = $_GET['id'];
            $data = Db::table('fuwu f')->where('f_id','=',$id)
                ->join('user u','u.u_id = f.fu_id','left')
                ->find();
            $data['f_uploads'] = json_decode($data['f_uploads']);
            $this->assign($data);
            return $this->fetch();
        }
    }

    public function add(){
        if($_POST){
            $fuwu = new FuwuModel();
            $images = FuwuModel::uploads_add();
            $id = $_POST['u_id'];
            $user = Db::table('user')->where('u_id','=',$id)->find();
            $map['fh_id'] = $user['uh_id'];
            $map['f_level'] = $_POST['f_level'];
            $map['f_ctime'] =time();
            $map['fu_id'] =$_POST['u_id'];
            $map['f_uploads'] =json_encode($images,true) ;
            $map['f_description'] = $_POST['f_description'];
//            var_dump($map);
            $fuwu->save($map);
//            echo Db::table('fuwu')->getLastSql();die;
            $this->redirect('/admin/fuwu/index');
        }else{
            $users = Db::table('user')->where('u_level','=',1)->select();
            $this->assign('users',$users);
            return $this->fetch();
        }
    }



}



?>
