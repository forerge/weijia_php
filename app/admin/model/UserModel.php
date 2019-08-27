<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class UserModel extends Model{
    protected $table = 'user';
    public static function upload_img(){
        $image = [];
        $file = request()->file('u_num0');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'id_card');
            if($info){
                $image['u_num0'] = 'id_card\\'.$info->getSaveName();
            }
        }

        $file = request()->file('u_num1');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'id_card');
            if($info){
                $image['u_num1'] = 'id_card\\'.$info->getSaveName();
            }
        }

        $file = request()->file('u_img');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'license');
            if($info){
                $image['u_img'] = 'license\\'.$info->getSaveName();
            }
        }
        return $image;
    }

    public static function del_img($id){
        $list = Db::table('user')->where('u_id','=',$id)->find();
        $image = $_FILES;
        if($image['u_img']['error'] == 0 && !empty($list['u_img']) ){
            if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'.DS.$list['u_img'])){
                unlink(ROOT_PATH . 'public' . DS . 'uploads'.DS.$list['u_img']);
            }
        }
        if($image['u_num0']['error'] == 0 && !empty($list['u_num0'])){
            if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'.DS.$list['u_num1'])){
                unlink(ROOT_PATH . 'public' . DS . 'uploads'.DS.$list['u_num0']);
            }
        }
        if($image['u_num1']['error'] == 0 && !empty($list['u_num1'])){
            if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'.DS.$list['u_num1'])){
                unlink(ROOT_PATH . 'public' . DS . 'uploads'.DS.$list['u_num1']);
            }
        }
    }

    public static function page_data($data){
        $total = Db::table('user')->count();

        $many = 6;

        $page = new Page($total,$many);

        $list = Db::table('user')->limit($page->offset,$many);
        if(!empty($data)){
            $map = array_filter($data);
            $list->where($map);
        }
        $data_list = $list->select();

        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];
    }

}





?>