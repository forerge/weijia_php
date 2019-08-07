<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\ShenqingModel;
use think\Db;

class Shenqing extends Controller{
    public function index(){
        if($_POST){

        }else{
            $list = Db::table('shenqing')->select();
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit(){
        return $this->fetch();
    }

   public function user(){
       return $this->fetch();
   }

    public function house(){
        return $this->fetch();
    }

    public function detail(){
        $id = $_GET['id'];
        $list = Db::table('shenqing s')
            ->join('user u','u.u_id = s.su_id')
            ->field('s.*,u.u_id,u.u_name')
            ->where('s_id','=',$id)->find();
        $this->assign($list);
        return $this->fetch();
    }

    public function add(){
        $users = Db::table('user')->field('u_id,u_name')->select();
        $this->assign('users',$users);
        if($_POST){
            $data = array_filter($_POST) ;
            $data['s_ctime'] = time();
            $result = ShenqingModel::upload_img();
            $data['s_img'] = $result;
            $shen = new ShenqingModel();
            if($shen ->save($data)){
                $this->success('申请成功！','/admin/shenqing/index');
            }else{
                $this->error('申请失败！');
            }

        }else{
            return $this->fetch();
        }
    }



}



?>
