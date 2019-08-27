<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class MeetModel extends Model{
    protected $table = 'meet';

    public static function page_list(){
        $total = Db::table('meet')->count();
        $many = 5;
        $page = new Page($total,$many);

        $list = Db::table('meet m')->order('m_id desc')
            ->join('user u','u.u_id = m.mu_id','left')
            ->join('house h','h.h_id = m.mh_id')
            ->field('u.u_name,u.u_phone,h.hu_name,h.h_province,h_city,h_area,h_town,h_qv,h_addr,m.*')
            ->limit($page->offset,$many)
            ->select();
//        var_dump($list);die;

        $page_list = $page->fpage([3,4,5,6,7,8]);
          return ['list'=>$list,'pagelist'=>$page_list];
    }

}





?>