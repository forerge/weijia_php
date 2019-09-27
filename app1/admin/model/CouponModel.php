<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class CouponModel extends Model{
    protected $table = 'coupon';

    public static function page_list($data){
        $total = Db::table('coupon')->count();
        $many = 6;

        $page = new Page($total,$many);

//        $list = Db::table('coupon c')->limit($page->offset,$many);
        $test1 = Db::table('coupon c')->limit($page->offset,$many)->join('user u','c.cu_id = u.u_id','left')->field('c.*,u.u_name')->select();
        $test2 = Db::table('coupon c')->limit($page->offset,$many)->join('user u','c.cu_sid = u.u_id','left')->field('u.u_name as u_sname')->select();
        foreach($test1 as $k => $v){
            $data_list[$k] = array_merge($test1[$k],$test2[$k]);
        }

        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];
    }

}





?>