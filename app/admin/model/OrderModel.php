<?php
namespace app\admin\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class OrderModel extends Model{
    protected $table = 'order';

    public static function page_list_house($data){
        $total = Db::table('order')
            ->where('o_status','>',0)

            ->count();
        $many = 10;

        $page = new Page($total,$many);
        $list = Db::table('order o')
            ->join('user u','u.u_id = o.ou_id')
            ->field('o.*,u.u_name')
            ->order('o_id desc')
            ->where('o_status','>',0)

            ->limit($page->offset,$many);
        if(!empty($data)){
            $map = array_filter($data);
            $list->where($map);
        }
        $data_list = $list->select();

        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];
    }
    public static function page_list_fang($data){
        $where['o_leixing'] = 1;

        $total = Db::table('order')->where($where)
            ->where('o_status','>',0)

            ->count();
        $many = 10;

        $page = new Page($total,$many);

        $list = Db::table('order o')->where($where)
            ->join('user u','u.u_id = o.ou_id')
            ->field('o.*,u.u_name')
            ->where('o_status','>',0)

            ->limit($page->offset,$many);
        if(!empty($data)){
            $map = array_filter($data);
            $list->where($map);
        }
        $data_list = $list->select();

        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];
    }
    public static function page_list_other_house($data){
        $total = Db::table('order')->count();
        $many = 10;

        $page = new Page($total,$many);
        $where['o_status'] = 3;
        $list = Db::table('order o')->where($where)
            ->where('o_leixing','>',3)
            ->join('user u','u.u_id = o.ou_id')
            ->field('o.*,u.u_name')
            ->limit($page->offset,$many);
        if(!empty($data)){
            $map = array_filter($data);
            $list->where($map);
        }
        $data_list = $list->select();

        $pagelist = $page->fpage([3,4,5,6,7,8]);
        return ['list'=>$data_list,'pagelist'=>$pagelist];
    }

    public static function page_list_baojie($data){

        $total = Db::table('order')
            ->where('o_leixing','in',[2,3])
            ->where('o_status','>',0)
            ->count();
        $many = 10;
        $page = new Page($total,$many);

        $list = Db::table('order o')
            ->where('o_leixing','in',[2,3])
            ->join('user u','u.u_id = o.ou_id')
            ->where('o_status','>',0)
            ->field('o.*,u.u_name')
            ->limit($page->offset,$many);
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