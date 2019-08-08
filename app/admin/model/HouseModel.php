<?php
namespace app\admin\model;
use think\Model;
use think\Upload;
use  think\Db;

class HouseModel extends Model{
    protected $table = 'house';

    public static function upload_img(){
        $file = request()->file('s_img');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'license');
            if($info){
                $image = 'license\\'.$info->getSaveName();
            }
        }
        return $image;
    }

    public static function data_add($data){


    }

}





?>