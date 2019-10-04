<?php
namespace  app\home\controller;
use app\home\model\ShenqingModel;
use imageUpload\ImageUpload;
use think\Controller;
use think\Db;
use think\Request;

class Shenqing extends Controller{
   public function shenqing(){
       $params = Request::instance()->param();

       $map['su_id'] = $params['id'];
       $map['s_ctime'] = time();
       if( array_key_exists('ma',$params)){
           $map['s_ma'] = $params['ma'];
       }
       $map['s_level'] = $params['level'];
       $test_data = $params['img']['imgUploadView1'];
       foreach($test_data as &$v){
           $v = str_replace('public/uploads/','',$v);
       }
       $map['s_img'] = json_encode($test_data,true) ;

       $map['s_name'] = $params['name'];
        if(Db::table($params['model'])->insert($map)){
           echo 1;
       }else{
           echo 0;
       }
   }







}


?>
