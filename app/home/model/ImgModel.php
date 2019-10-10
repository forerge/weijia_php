<?php
namespace app\home\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class ImgModel extends Model{
    protected $table = 'img';

    public function getIImgAttr($a){
        $str = str_replace("\\",'/',$a);
        $arr = str_replace("//",'/',$str);

        $data = SERVER_WEIJIA.$arr;
        return $data;
    }
//
//    public static function images(){
//        $list = self::where('i_level','=',1)->select();
//        return $list;
//    }

}





?>