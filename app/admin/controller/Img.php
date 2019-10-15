<?php
namespace  app\admin\controller;
use app\admin\model\ImgModel;
use think\Controller;
use think\Db;
use think\Request;

class Img extends Controller{
    public function index(){
        $result = Db::table('img')->select();
        $this->assign('list',$result);
        return $this->fetch();
    }

    public function del(){
        $params = Request::instance()->param();
        $id = is_int($params['id'])?$params['id']:intval($params['id']);
        Db::table('img')->delete($id);
        $this->redirect('/admin/img/index');
    }

    public function update(){

        if($_POST){
            $params = Request::instance()->param();
            $img = new ImgModel();
            $result = ImgModel::upload_img($params['i_img']);
            if(!empty($result)){
                $data['i_img'] = $result['img'];
            }
            $data['i_ctime'] = time();
            $data['i_sort'] = $params['i_sort'];
            $data['i_level'] = $params['i_level'];
            $data['i_status'] = $params['i_status'];
            if($img ->save($data,['i_id'=>$params['i_id']])){
                $this->success('修改成功！','/admin/img/index');
            }else{
                $this->error('修改失败！');
            }
        }else{
            $id = $_GET['id'];
            $list = Db::table('img')->where('i_id','=',$id)->find();
            $this->assign($list);
            return $this->fetch();
        }


    }

    public function add(){
        $params = Request::instance()->param();
        if($params){
            $img = new ImgModel();
            $result = ImgModel::upload_img();
            $data['i_img'] = $result['img'];
            $data['i_ctime'] = time();
            $data['i_sort'] = $params['i_sort'];
            $data['i_status'] = $params['i_status'];
            if($img ->save($data)){
                $this->success('添加成功！','/admin/img/index');
            }else{
                $this->error('添加失败！');
            }
        }else{
            return $this->fetch();
        }
    }




}



?>
