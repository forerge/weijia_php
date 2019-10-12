<?php
namespace app\home\model;
use app\admin\tools\Page;
use think\Model;
use think\Upload;
use  think\Db;

class HouseModel extends Model{
    protected $table = 'house';

    public function getHPidAttr($value){
        $status = ['一般房源','全权委托','委托带客看房'];
        return $status[$value];
    }
    public function getHRuleAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','压一付一','压一付三','半年付'];
        return $arr[$num];
    }
    public function getHStatusAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','快租房','青年公寓'];
        return $arr[$num];
    }
    public function getHLevelAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = [-1=>'成交',0=>'不限',1=>'出租中',2=>'下架'];
        return $arr[$num];
    }
    public function getHStateAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = ['不限','整租','合租'];
        return $arr[$num];
    }
    public function getHElevatorAttr($a){
        $num = is_int($a)?$a:intval($a);
        $arr = [0=>'不限',1=>'有',-1=>'无'];
        return $arr[$num];
    }
    public function getHWeijiaAttr($a){
        $arr = ['不限','唯家房源','社会房源'];
        return $arr[$a];
    }
    public function getHTuijianAttr($a){
        $arr = ['','不推荐','参与推荐'];
        return $arr[$a];
    }
    public function getHUploadsAttr($a){
        $str = str_replace("\\",'/',$a);
        $arr = str_replace("//",'/',$str);
        $data = json_decode($arr,true);
        foreach($data as &$val){
            $val = SERVER_WEIJIA.$val;
        }
        return $data;
    }
    public function getHImgAttr($a){
        $str = str_replace("\\",'/',$a);
        $arr = str_replace("//",'/',$str);
        $data = SERVER_WEIJIA.$arr;
        return $data;
    }
    public function getHConfigAttr($a){
        $str = json_decode($a,true);
        $arr = array_flip($str);
        return $arr;
    }
    public function getHAskAttr($a){
        $str = json_decode($a,true);
        $arr = array_flip($str);
        return $arr;
    }
    public function getHInmoneyAttr($a){
        $str = json_decode($a,true);
        $arr = array_flip($str);
        return $arr;
    }
    public function getHLiangdianAttr($a){
        $str = json_decode($a,true);
        $arr = array_flip($str);
        return $arr;
    }

    public static function many_json($config,$ask,$liangdian,$inmoney){
        $h_config = [0=>'a'];
        if(in_array('宽带',$config)){array_push($h_config,'kuandai');}
        if(in_array('床',$config)){array_push($h_config,'chuang');}
        if(in_array('衣柜',$config)){array_push($h_config,'yigui');}
        if(in_array('沙发',$config)){array_push($h_config,'shafa');}
        if(in_array('桌椅',$config)){array_push($h_config,'zhuoyi');}
        if(in_array('电视',$config)){array_push($h_config,'dianshi');}
        if(in_array('空调',$config)){array_push($h_config,'kongtiao');}
        if(in_array('洗衣机',$config)){array_push($h_config,'xiyiji');}
        if(in_array('冰箱',$config)){array_push($h_config,'bingxiang');}
        if(in_array('热水器',$config)){array_push($h_config,'reshuiqi');}
        if(in_array('燃气灶',$config)){array_push($h_config,'ranqizao');}
        if(in_array('抽烟机',$config)){array_push($h_config,'chouyanji');}
        if(in_array('电磁炉',$config)){array_push($h_config,'diancilu');}
        if(in_array('微波炉',$config)){array_push($h_config,'weibolu');}
        if(in_array('独立卫生间',$config)){array_push($h_config,'duliweishengjian') ;}
        if(in_array('可做饭',$config)){array_push($h_config,'kezuofan');}


        $h_ask = [0=>'a'];
        if(in_array('只限女生',$ask)){array_push($h_ask,'zhixiannvsheng');}
        if(in_array('一家人',$ask)){array_push($h_ask,'yijiaren');}
        if(in_array('禁止养宠物',$ask)){array_push($h_ask,'jinzhiyangchongwu') ;}
        if(in_array('半年起租',$ask)){array_push($h_ask,'bannianqizu');}
        if(in_array('一年起租',$ask)){array_push($h_ask,'yinianqizu');}
        if(in_array('租户稳定',$ask)){array_push($h_ask,'zuhuwending') ;}
        if(in_array('作息正常',$ask)){array_push($h_ask,'zuoxizhengchang') ;}
        if(in_array('禁烟',$ask)){array_push($h_ask,'jinyan');}

        $h_liangdian = [0=>'a'];
        if(in_array('南北通透',$liangdian)){array_push($h_liangdian,'nanbeitongtou');}
        if(in_array('首次出租',$liangdian)){array_push($h_liangdian,'shoucichuzu');}
        if(in_array('有阳台',$liangdian)){array_push($h_liangdian,'youyangtai');}

        $test_inmoney = is_string($inmoney)?explode(',',$inmoney):$inmoney;
        $h_inmoney = [0=>'a'];
        if(in_array('水费',$test_inmoney)){array_push($h_inmoney,'shuifei');}
        if(in_array('电费',$test_inmoney)){array_push($h_inmoney,'dianfei');}
        if(in_array('燃气费',$test_inmoney)){array_push($h_inmoney,'ranqifei');}
        if(in_array('宽带费',$test_inmoney)){array_push($h_inmoney,'kuandaifei');}
        if(in_array('物业费',$test_inmoney)){array_push($h_inmoney,'wuyefei');}
        if(in_array('有线电视费',$test_inmoney)){array_push($h_inmoney,'youxiandianshifei');}
        if(in_array('停车费',$test_inmoney)){array_push($h_inmoney,'tingche');}

        $h_config = json_encode($h_config,JSON_UNESCAPED_UNICODE);
        $h_ask = json_encode($h_ask,JSON_UNESCAPED_UNICODE);
        $h_liangdian = json_encode($h_liangdian,JSON_UNESCAPED_UNICODE);
        $h_inmoney = json_encode($h_inmoney,JSON_UNESCAPED_UNICODE);

        return ['h_config'=>$h_config,'h_ask'=>$h_ask,'h_liangdian'=>$h_liangdian,'h_inmoney'=>$h_inmoney];
    }

    public static function images($uploads,$img){
        foreach($uploads as &$val){
            $val = str_replace('public/uploads/','',$val);
        }
        foreach($img as &$v){
            $v = str_replace('public/uploads/','',$v);
        }
        $h_uploads = json_encode($uploads,JSON_UNESCAPED_UNICODE);
        $h_img = json_encode($img,JSON_UNESCAPED_UNICODE);
       return ['h_uploads'=>$h_uploads,'h_img'=>$h_img];
    }







}





?>