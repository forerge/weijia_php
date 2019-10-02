<?php
namespace  app\home\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\home\model\UserModel;

class Login extends Controller{
    public function login(){
        $params = Request::instance()->param();
        $data = Db::table('user')->where('u_phone','=',$params['tel'])->find();
        if(!empty($data)){
            if(md5($params['pwd']).md5($data['u_ctime']) == $data['u_pwd']){
                $list = json_encode($data,JSON_UNESCAPED_UNICODE);
                return $list;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }

    public function kuai_register(){
        $params = Request::instance()->param();
        $user = new UserModel();
        $map['u_ctime'] = time();
        $map['u_pwd'] =md5($params['pwd']).md5($map['u_ctime']) ;
        $map['u_haole'] = $params['pwd'];
        $map['u_phone'] = $params['tel'];
        $list = $user->save($map);
        $id = intval($user->u_id);
        if($list){
            $user_data = Db::table('user')->where('u_id','=',$id)->find();
            $list = json_encode($user_data,JSON_UNESCAPED_UNICODE);
            return $list;
        }else{
            echo '0';
        }
    }

    public function out(){
        Session::set('weijia_pro','');
    }

    public function goon(){
//        var_dump(Session::get('weijia_pro'));
//        die;
        $user_login = Session::get('weijia_pro');
        if(empty($user_login)){
            echo 444;exit;
        }
    }

    public function test1(){
        var_dump(Session::get('you'));
    }

}


?>
