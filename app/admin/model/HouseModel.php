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
            }
        }
        if(!empty($data)){
            foreach($_FILES['h_uploads']['name'] as $k => $v){
                if(!empty($v)){
                    static $new = 0;
                    if(isset($data[$k])){
                        if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'.DS.$data[$k])){
                            unlink(ROOT_PATH . 'public' . DS . 'uploads'.DS.$data[$k]);
                        }
                        $data[$k] = $list[$new];
                    }
                    if(!isset($data[$k])){
                        $data[$k] = $list[$new];
                    }
                    $new+=1;
                }
            }
            return [$list,$data];
        }else{
            return $list;
        }

    }

    public static function upload_update($data){
    }

}





?>