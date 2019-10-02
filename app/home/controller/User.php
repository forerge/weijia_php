<?php
namespace  app\home\controller;
use app\home\controller\Base;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class User extends Controller{
   public function kuai_apply(){
       $params = Request::instance()->param();
       $id = is_int($params['id'])?$params['id']:intval($params['id']);
       if($params['apply'] == 3){
           $map = ['u_three'=>1];
       }else if($params['apply'] == 4){
           $map = ['u_four'=>1];
       }
       if(Db::table('user')->where('u_id','=',$id)->update($map)){
           echo 1;
       }else{
           echo 0;
       }
   }

    public function kuai_register(){


    }

    public function test(){
        var_dump(Session::get('weijia_pro'));
    }





}


?>
