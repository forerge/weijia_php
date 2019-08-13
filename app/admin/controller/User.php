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
           if(!empty($data['u_sex'])){
               $data['u_sex'] = intval($data['u_sex']);
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
                $this->success('添加成功！','/admin/user/index');
            }else{
                $this->error('添加失败！');
            }
        }else{
            return view();
        }
    }

    public function update(){
        if($_POST){
            $data = array_filter($_POST) ;
            $id = $data['u_id'];
            UserModel::del_img($id);//判断是否是新增数据的图片上传      新增：直接上传，  修改：要清空之前的图片
            unset($data['u_id']);
            $result = UserModel::upload_img($_POST['u_id']);     //图片上传
            $data = array_merge($data,$result);
            if(!isset($data['u_one'])){ $data['u_one'] = '-1'; }
            if(!isset($data['u_two'])){ $data['u_two'] = '-1'; }
            if(!isset($data['u_three'])){ $data['u_three'] = '-1'; }
            if(!isset($data['u_four'])){ $data['u_four'] = '-1'; }
            if(!isset($data['u_five'])){ $data['u_five'] = '-1'; }
            Db::table('user')->where('u_id','=',$id)->update($data);
            $this->success('修改成功！','/admin/user/index');
        }else{
            $id = $_GET['id'];
            $user = Db::table('user')->where('u_id','=',$id)->find();
            $this->assign($user);
        }
        return $this->fetch();
    }


}



?>
