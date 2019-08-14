<?php
namespace app\admin\model;
use app\admin\Tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class ShenqingModel extends Model{
    protected $table = 'shenqing';

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

    public static function page_list($data){
        $total = Db::table('shenqing')->count();
        $many = 6;

        $page = new Page($total,$many);

        $list = Db::table('shenqing s')->limit($page->offset,$many)
              ->join('user u','u.u_id = s.su_id','left');
        if(!empty($data)){
            $map = array_filter($list);
            $list->where($map);
        }
        $data_list = $list->select();
        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];

    }

}





?>