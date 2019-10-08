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
        $arr = ['不限','有','无'];
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

    public static function many_json($config,$ask){
        $h_config = [];
        if(in_array('宽带',$config)){$h_config['kuandai']=1;}
        if(in_array('床',$config)){$h_config['chuang']=1;}
        if(in_array('衣柜',$config)){$h_config['yigui']=1;}
        if(in_array('沙发',$config)){$h_config['shafa']=1;}
        if(in_array('桌椅',$config)){$h_config['zhuoyi']=1;}
        if(in_array('电视',$config)){$h_config['dianshi']=1;}
        if(in_array('空调',$config)){$h_config['kongtiao']=1;}
        if(in_array('洗衣机',$config)){$h_config['xiyiji']=1;}
        if(in_array('冰箱',$config)){$h_config['bingxiang']=1;}
        if(in_array('热水器',$config)){$h_config['reshuiqi']=1;}
        if(in_array('燃气灶',$config)){$h_config['ranqizao']=1;}
        if(in_array('抽烟机',$config)){$h_config['chouyanji']=1;}
        if(in_array('电磁炉',$config)){$h_config['diancilu']=1;}
        if(in_array('独立卫生间',$config)){$h_config['duliweishengjian']=1;}
        if(in_array('阳台',$config)){$h_config['yangtai']=1;}
        if(in_array('可做饭',$config)){$h_config['kezuofan']=1;}

        $h_ask = [];
        if(in_array('只限女生',$ask)){$h_ask['zhixiannvsheng']=1;}
        if(in_array('一家人',$ask)){$h_ask['yijiaren']=1;}
        if(in_array('禁止养宠物',$ask)){$h_ask['jinzhiyangchongwu']=1;}
        if(in_array('半年起租',$ask)){$h_ask['bannianqizu']=1;}
        if(in_array('一年起租',$ask)){$h_ask['yinianqizu']=1;}
        if(in_array('租户稳定',$ask)){$h_ask['zuhuwending']=1;}
        if(in_array('作息正常',$ask)){$h_ask['zuoxizhengchang']=1;}
        if(in_array('禁烟',$ask)){$h_ask['jinyan']=1;}

        $h_config = json_encode($h_config,JSON_UNESCAPED_UNICODE);
        $h_ask = json_encode($h_ask,JSON_UNESCAPED_UNICODE);

        return ['h_config'=>$h_config,'h_ask'=>$h_ask];
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