<?php
namespace  app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\UserModel;
use app\admin\model\CommonModel;
use think\Request;

class User extends Controller{
   public function index(){
       if($_POST){
           $data = array_filter($_POST);
           if(!empty($data['u_phone'])){
                $data['u_phone'] = intval($data['u_phone']);
           }
           if(!empty($data['u_sex'])){
               $data['u_sex'] = intval($data['u_sex']);
           }
           if(!empty($data['tuijian'])){
               if(in_array(1,$data['tuijian'])){
                   $data['u_one'] = 1;
               }
               if(in_array(2,$data['tuijian'])){
                   $data['u_two'] = 1;
               }
               if(in_array(3,$data['tuijian'])){
                   $data['u_three'] = 1;
               }
               if(in_array(4,$data['tuijian'])){
                   $data['u_four'] = 1;
               }
               unset($data['tuijian']);
           }
           $list = Db::table('user')->where($data)->select();
       }else{
           $list = Db::table('user')->select();
       }
       $this->assign('list',$list);
       return view();
   }

    public function add(){
        if($_POST){
            $data = $_POST;
            $map['u_name'] = $data['name'];
            $map['u_phone'] = $data['phone'];
            $map['u_sex'] = $data['sex'];
            $map['u_ma'] = $data['ma'];
            $map['u_ctime'] = time();
            $users = new UserModel();
            if($users->save($map)){
                $this->success('添加成功！','index');
            }else{
                $this->error('添加失败！');
            }

        }else{
            return view();
        }
    }

    public function update(){
        if($_POST){
            $result = CommonModel::upload_img($_POST['u_id']);
            $data = array_filter($_POST) ;
            if(!isset($data['u_one'])){ $data['u_one'] = -1; }else{ $data['u_one'] = intval($data['u_one']); }
            if(!isset($data['u_two'])){ $data['u_two'] = -1; }else{ $data['u_two'] = intval($data['u_two']); }
            if(!isset($data['u_three'])){ $data['u_three'] = -1; }else{ $data['u_three'] = intval($data['u_three']); }
            if(!isset($data['u_four'])){ $data['u_four'] = -1; }else{ $data['u_four'] = intval($data['u_four']); }
            $id = $data['u_id'];
            unset($data['u_id']);
            if(Db::table('user')->where('u_id','=',$id)->update($data)){
                $this->success('修改成功！','index');
            }else{
                $this->error('修改失败！');
            }
        }else{
            $id = $_GET['id'];
            $user = Db::table('user')->where('u_id','=',$id)->find();
            $this->assign($user);
        }
        return $this->fetch();
    }


}



?>
