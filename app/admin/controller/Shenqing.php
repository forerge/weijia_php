<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\ShenqingModel;
use think\Db;

class Shenqing extends Controller{
    public function index(){
        if($_POST){

        }else{
            $list = Db::table('shenqing s')
                ->join('user u','u.u_id = s.su_id','left')
                ->field('s.*,u.u_id,u.u_name')
                ->select();
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit(){
        return $this->fetch();
    }

   public function user(){
       $list = Db::table('shenqing s')
           ->join('user u','u.u_id=s.su_id','left')
           ->field('s.*,u.u_id,u.u_name')
           ->where('s_level','=',1)
           ->where('s_status','=',1)
           ->select();
       $this->assign('list',$list);
       return $this->fetch('index');
   }

    public function house(){
        $list = Db::table('shenqing s')
            ->join('user u','u.u_id=s.su_id','left')
            ->field('s.*,u.u_id,u.u_name')
            ->where('s_level','=',2)
            ->where('s_status','=',1)
            ->select();
        $this->assign('list',$list);
        return $this->fetch('index');
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

    public function apply(){
        $list = $_POST;
        if($list['status'] == 1){
            $map['u_tname'] = $list['name'];
            $map['u_num'] = $list['num'];
            $map['u_img'] = $list['img'];
            $map['u_money'] = $list['money'];
            if($list['level'] == 1){
                $map['u_three'] = 1;
            }else if($list['level'] == 2){
                $map['u_four'] = 1;
            }else if($list['level'] == 3){


            }else if($list['level'] == 4){



            }else if($list['level'] == 5){
                $map['u_two'] = 1;
            }
            $_POST['data'] = array_filter($map);
            Db::transaction(function(){
                Db::table('shenqing')->where('s_id','=',$_POST['s_id'])->update(['s_status'=>2]);
                Db::table('user')->where('u_id','=',$_POST['u_id'])->update($_POST['data']);
            });
        }else{
            $result['s_status'] = -1;
            $result['s_refuse'] = $list['refuse'];
            Db::table('shenqing')->where('s_id','=',$list['s_id'])->update($result);
        }
        echo 1;
    }



}



?>
