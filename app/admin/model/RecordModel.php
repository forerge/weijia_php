<?php
namespace app\admin\model;
use think\Model;
use think\Upload;
use  think\Db;

class RecordModel extends Model{
    protected $table = 'record';

    public static function upload_img(){
        $image = [];
        $file = request()->file('r_weima');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'company');
            if($info) {
                $image['wei'] = 'company'.DS.$info->getSaveName();
            }
        }else{
            $image['wei'] = '';
        }

        $file = request()->file('r_zhima');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'company');
            if($info) {
                $image['zhi'] = 'company'.DS.$info->getSaveName();
            }
        }else{
            $image['zhi'] = '';
        }

        $file = request()->file('r_logo');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'company');
            if($info) {
                $image['logo'] = 'company'.DS.$info->getSaveName();
            }
        }else{
            $image['logo'] = '';
        }

        return $image;
    }

}





?>