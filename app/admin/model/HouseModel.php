<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class HouseModel extends Model{
    protected $table = 'house';

    public static function upload_add($data='')
    {
        $files = request()->file('h_uploads');
        $list = [];
        if (!empty($files)){
            foreach ($files as $file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'house');
                if ($info) {
                    $list[] = 'house\\' . $info->getSaveName();
                }
            }
            if (!empty($data)) {
                foreach ($_FILES['h_uploads']['name'] as $k => $v) {
                    if (!empty($v)) {
                        static $new = 0;
                        if (isset($data[$k])) {
                            if (file_exists(ROOT_PATH . 'public' . DS . 'uploads' . DS . $data[$k])) {
                                unlink(ROOT_PATH . 'public' . DS . 'uploads' . DS . $data[$k]);
                            }
                            $data[$k] = $list[$new];
                        }
                        if (!isset($data[$k])) {
                            $data[$k] = $list[$new];
                        }
                        $new += 1;
                    }
                }
                return [$list, $data];
            }
        }
            return $list;


    }

    public static function upload_update($data){
    }

    public static function page_list($data){
        $total = Db::table('house')->count();
        $many = 5;

        $page = new Page($total,$many);

        $list = Db::table('house')->limit($page->offset,$many);
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