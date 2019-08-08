<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\HouseModel;
use think\Db;
use think\Request;

class House extends Controller{
   public function index(){
       if($_POST){

       }else{
           $list = Db::table('house')->select();
       }
       $this->assign('list',$list);
       return view();
   }

    public function add(){
        if($_POST){
            $data = $_POST;
            $data['h_config'] = json_encode($data['h_config'],true);
            $data['h_ask'] = json_encode($data['h_ask'],true);
            $data['h_inmoney'] = json_encode($data['h_inmoney'],true);
            $data['h_ctime'] = time();
            $house = new HouseModel();
            if($house->save($data)){
                $this->redirect('/admin/house/index');
            }else{
                $this->error('添加失败！');
            }
        }else{
            return view();
        }
    }

    public function update(){
        if($_POST){
            $list = $_POST;
            $id = $list['h_id'];
            unset($list['h_id']);
            $list['h_config'] = json_encode($list['h_config'],true);
            $list['h_ask'] = json_encode($list['h_ask'],true);
            $list['h_inmoney'] = json_encode($list['h_inmoney'],true);
            $house = new HouseModel();
            if($house->save($list,['h_id'=>$id])){
                $this->redirect('/admin/house/index');
            }else{
                $this->error('修改失败！');
            }

        }else{
            $id = $_GET['id'];
            $list = Db::table('house')->where('h_id','=',$id)->find();
            $list['h_inmoney'] = json_decode($list['h_inmoney'],true);
            $list['h_config'] = json_decode($list['h_config'],true);
            $list['h_ask'] = json_decode($list['h_ask'],true);
            $this->assign($list);
        }
        return $this->fetch();
    }



}



?>
