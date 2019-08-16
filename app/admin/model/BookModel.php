<?php
namespace app\admin\model;
use app\admin\Tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class BookModel extends Model{
    protected $table = 'book';

    public static function page_list($data){
        $total = Db::table('book')->count();
        $many = 5;
        $page = new Page($total,$many);

        $list = Db::table('book b')->order('b_id desc')
            ->join('user u','u.u_id = b.bu_id','left')
            ->field('u.u_name,u.uh_id,b.*')
            ->limit($page->offset,$many);
        if(!empty($data)){
            $map = array_filter($data);
            $list->where($map);
        }
         $data_list = $list->select();
//        var_dump($list);die;

        $page_list = $page->fpage([3,4,5,6,7,8]);
          return ['list'=>$data_list,'pagelist'=>$page_list];
    }

    public static function upload_card($data = 0){
        $img = '';
        if(!empty($_FILES)){
            $file = request()->file('b_card');
            if($file){
                if(!empty($data['b_card'])){
                    if(file_exists(ROOT_PATH . 'public' . DS . 'uploads\\'.$data['b_card'])){
                        unlink(ROOT_PATH . 'public' . DS . 'uploads\\'.$data['b_card']);
                    }
                }
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS . 'book');
                if($info) {
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $img = 'book\\'.$info->getSaveName();
                    return $img;
                }
            }
        }
    }

    public static function upload_people1($data = 0){
        $img1 = '';
        $file = request()->file('b_people1');
        if($file){
            if(!empty($data['b_people1'])){
                if(file_exists(ROOT_PATH . 'public' . DS . 'uploads\\'.$data['b_people1'])){
                    unlink(ROOT_PATH . 'public' . DS . 'uploads\\'.$data['b_people1']);
                }
            }
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS . 'book');
            if($info) {
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $img1 = 'book\\'.$info->getSaveName();
                return $img1;
            }
        }
    }

    public static function upload_people2($data = 0){
        $img2 = '';
        $file = request()->file('b_people2');
        if($file){
            if(!empty($data['b_people2'])){
                if(file_exists(ROOT_PATH . 'public' . DS . 'uploads\\'.$data['b_people2'])){
                    unlink(ROOT_PATH . 'public' . DS . 'uploads\\'.$data['b_people2']);
                }
            }
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'.DS . 'book');
            if($info) {
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $img2 = 'book\\'.$info->getSaveName();
                return $img2;
            }
        }
    }


}





?>