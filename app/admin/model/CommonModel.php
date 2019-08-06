<?php
namespace app\admin\model;
use think\Model;
use think\Upload;
use  think\Db;

class CommonModel extends Model{
    public static function upload_img($id){
        $file = request()->file('u_num0');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'id_card');
            if($info){
                $image['u_num0'] = $info->getSaveName();
            }
        }

        $file = request()->file('u_num1');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'id_card');
            if($info){
                $image['u_num1'] = $info->getSaveName();
            }
        }

        $file = request()->file('u_img');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'license');
            if($info){
                $image['u_img'] = $info->getSaveName();
            }
        }

//        判断是否是新增数据的图片上传      新增：直接上传，  修改：要清空之前的图片
        if($id){
            if(isset($image['u_img'])){
                Db::table('user')->where('u_id','=',$id)->update(['u_img'=>'']);
            }
            if(isset($image['u_num0'])){
                Db::table('user')->where('u_id','=',$id)->update(['u_num0'=>'']);
            }
            if(isset($image['u_num1'])){
                Db::table('user')->where('u_id','=',$id)->update(['u_num1'=>'']);
            }
        }



    }
}





?>