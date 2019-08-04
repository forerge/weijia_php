<?php
namespace app\admin\model;
use think\Model;

class AdminModel extends Model{
    protected  $table = 'admin';

    public static function add_data($data){
        $map['a_name'] = $data['a_name'];
        $map['a_pwd'] = $data['a_pwd'];
        $map['a_level'] = intval($data['a_level']);
        $map['a_phone'] = $data['a_phone'];
        $map['a_email'] = $data['a_email'];
        $map['a_ctime'] = time();
        $map['a_utime'] = time();
        if(empty($data['a_pwd'])
            || empty($data['a_name'])
            || empty($data['a_level'])
            || empty($data['a_email'])
            || empty($data['a_phone'])){
            return 0;
        }else{
            $map['a_toke'] = md5(time());
            $pwd = md5($map['a_pwd']);
            $map['a_pwd'] = md5($pwd.','.$map['a_toke']);
            return $map;
        }
    }

    public static function update_data($data){
        $id = $data['a_id'];
        $map['a_name'] = $data['a_name'];
        $map['a_level'] = intval($data['a_level']);
        $map['a_phone'] = $data['a_phone'];
        $map['a_email'] = $data['a_email'];
        $map['a_utime'] = time();
        return [$map,$id];
    }





}



?>