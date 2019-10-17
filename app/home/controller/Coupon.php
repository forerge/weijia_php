<?php
namespace  app\home\controller;
use app\home\controller\Base;
use app\home\model\CouponModel;
use imageUpload\ImageUpload;
use think\Controller;
use think\Request;

class Coupon extends controller{
    public function qing_list(){
        $params = Request::instance()->param();
        $coupon = new CouponModel();
        $map['cu_id'] = $params['u_id'];
        $data = $coupon->where($map)->select();
        $list = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $list;

    }




}
?>
