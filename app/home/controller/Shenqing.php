<?php
namespace  app\home\controller;
use app\admin\model\ShenqingModel;
use think\Controller;
use think\Db;
use think\Request;

class Shenqing extends Controller{
   public function shenqing(){
      $params = Request::instance()->param();
       var_dump($params);die;
//       $shenqing = new ShenqingModel();
//       $map['su_id'] = $params['id'];
//       $map['s_ctime'] = time();
//       if( array_key_exists('ma',$params)){
//           $map['s_ma'] = $params['ma'];
//       }
//       $map['s_level'] = $params['level'];
//       $map['s_name'] = $params['name'];
//       if($shenqing->save($map)){
//           echo 1;
//       }else{
//           echo 0;
//       }
   }







}


?>
