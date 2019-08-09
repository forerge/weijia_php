<?php
namespace  app\admin\controller;
use app\admin\model\RecordModel;
use think\Controller;
use think\Db;

class Record extends Controller{
    public function update(){
        if($_POST){
            $list = $_POST;
            $id = $_POST['r_id'];
            $image = RecordModel::upload_img();
            unset($list['r_id']);
            if(!empty($image['wei'])){
                $list['r_weima'] = $image['wei'];
            }
            if(!empty($image['zhi'])){
                $list['r_zhima'] = $image['zhi'];
            }
            if(!empty($image['logo'])){
                $list['r_logo'] = $image['logo'];
            }
            $record = new RecordModel();
            if($record->save($list,['r_id'=>$id])){
                $this->redirect('/admin/record/update');
            }
        }else{
            $list = Db::table('record')->find();
            $this->assign($list);
        }
            return $this->fetch();
    }
    public function add(){
        if($_POST){
            Db::table('record')->insert($_POST);
            return $this->fetch('/admin/record/update');
        }else{
            return $this->fetch();
        }
    }


}



?>
