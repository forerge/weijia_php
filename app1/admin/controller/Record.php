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
            $data = Db::table('record')->where('r_id','=',$id)->find();
            $image = RecordModel::upload_img();
            unset($list['r_id']);
            if(!empty($image['wei'])){
                $list['r_weima'] = $image['wei'];
                if(!empty($data['r_weima'])){
                    if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'. DS . $data['r_weima'])){
                        unlink(ROOT_PATH . 'public' . DS . 'uploads'. DS . $data['r_weima']);
                    }
                }
            }
            if(!empty($image['zhi'])){
                $list['r_zhima'] = $image['zhi'];
                if(!empty($data['r_zhima'])){
                    if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'. DS . $data['r_zhima'])){
                        unlink(ROOT_PATH . 'public' . DS . 'uploads'. DS . $data['r_zhima']);
                    }
                }
            }
            if(!empty($image['logo'])){
                $list['r_logo'] = $image['logo'];
                if(!empty($data['r_logo'])){
                    if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'. DS . $data['r_logo'])){
                        unlink(ROOT_PATH . 'public' . DS . 'uploads'. DS . $data['r_logo']);
                    }
                }
            }
            $record = new RecordModel();
            $record->save($list,['r_id'=>$id]);
//                return $this->redirect('/admin/record/update');
//            }
        }
            $list = Db::table('record')->where('r_level','=',1)->find();
            $this->assign($list);
      
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

    public function hetong(){
        return $this->fetch();
    }


}



?>
