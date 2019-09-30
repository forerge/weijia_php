<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class ImgModel extends Model{
    protected $table = 'img';

    public static function upload_img($image=''){
        $file = request()->file('i_img');
        $data['img'] = [];
        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS .'img');
            if($image && file_exists(ROOT_PATH . 'public' . DS . 'uploads' . DS .$image)){
                unlink(ROOT_PATH . 'public' . DS . 'uploads'  . DS .$image);
            }
            if($info){
                $data['img'] = 'img\\'.$info->getSaveName();
            }
        }
        return $data;
    }

}





?>