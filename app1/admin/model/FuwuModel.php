<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class FuwuModel extends Model{
    protected $table = 'fuwu';

    public static function page_list($data){
        $total = Db::table('fuwu')->count();
        $many = 6;
        $page = new Page($total,$many);

        $list = Db::table('fuwu f')->limit($page->offset,$many)
            ->join('user u','f.fu_id = u.u_id','left')
            ->join('house h','h.h_id = u.uh_id')
            ->field('f.*,u.u_name,u.u_phone,h.h_province,h.h_city,h.h_area,h.h_town,h.h_addr,h.h_qv');
        if(!empty($data)){
            $map = array_filter($data);
            $list->where($map);
        }
            $data_list = $list->select();
//        var_dump($data_list);die;
        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];
    }

    public static function uploads_add(){
        if(!empty($_FILES['f_uploads'])){
            $files = request()->file('f_uploads');
            $li_image = [];
            foreach($files as $file){
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'fuwu');
                if($info){
                    $li_image[] = 'fuwu\\'.$info->getSaveName();
                }
            }
            return $li_image;
        }
    }

}





?>