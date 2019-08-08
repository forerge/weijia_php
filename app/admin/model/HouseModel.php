<?php
namespace app\admin\model;
use think\Model;
use think\Upload;
use  think\Db;

class HouseModel extends Model{
    protected $table = 'house';

    public static function upload_add($data=''){
        $files = request()->file('h_uploads');
        $list = [];
        foreach($files as $file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'house');
            if($info){
                $list[] = 'house\\'.$info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError().'错误';
            }
        }
        if(!empty($data)){
            foreach($_FILES['h_uploads']['name'] as $k => $v){
                if(!empty($v) && isset($data[$k])){
                    $new = 0;
                    unlink(ROOT_PATH . 'public' . DS . 'uploads'.DS.$data[$k]);
                    $data[$k] = $list[$new];
                    $new++;
                }
            }
            return [$list,$data];
        }else{
            return $list;
        }

    }

    public static function del_images($data){
        foreach($_FILES['h_uploads']['name'] as $k => $v){
            if(!empty($v) && isset($data[$k])){
                unlink(ROOT_PATH . 'public' . DS . 'uploads'.DS.$data[$k]);
            }
        }

    }

}





?>