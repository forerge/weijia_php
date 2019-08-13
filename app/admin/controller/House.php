<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\HouseModel;
use think\Db;
use think\Request;

class House extends Controller{
   public function index(){
       if($_POST){

       }else{
           $list = Db::table('house')->select();
       }
       $this->assign('list',$list);
       return view();
   }

    public function add(){
        if($_POST){
            $data = $_POST;
            $result = HouseModel::upload_add();
            if(!empty($result)){
                $data['h_img'] = $result[0];
                $data['h_uploads'] = json_encode($result,true);
            }else{
                $data['h_uploads'] = 0;
            }
            $data['h_config'] = json_encode($data['h_config'],true);
            $data['h_ask'] = json_encode($data['h_ask'],true);
            $data['h_inmoney'] = json_encode($data['h_inmoney'],true);
            $data['h_ctime'] = time();
            $house = new HouseModel();
            if($house->save($data)){
                $this->redirect('/admin/house/index');
            }else{
                $this->error('添加失败！');
            }
        }else{
            $provinces = Db::table('j_position_provice')->select();
            $this->assign('provinces',$provinces);
            return view();
        }
    }

    public function update(){
        if($_POST){
            $list = $_POST;
            $id = $list['h_id'];
            $data = Db::table('house')->where('h_id','=',$id)->find();
            $images = json_decode($data['h_uploads'],true);
            unset($list['h_id']);
            $result = HouseModel::upload_add($images);
            $list['h_config'] = json_encode($list['h_config'],true);
            $list['h_ask'] = json_encode($list['h_ask'],true);
            $list['h_inmoney'] = json_encode($list['h_inmoney'],true);
            if(!empty($images)){
                if(!empty($result[1])){
                    $list['h_uploads'] = json_encode($result[1],true);
                }else{
                    $list['h_uploads'] = json_encode($images,true);
                }
            }else{
                if(!empty($result)){
                    $list['h_uploads'] = json_encode($result,true);
                }
            }


            $house = new HouseModel();
            $house->save($list,['h_id'=>$id]);
            $this->redirect('/admin/house/index');
        }else{
            $id = $_GET['id'];
            $list = Db::table('house')->where('h_id','=',$id)->find();
            $list['h_inmoney'] = json_decode($list['h_inmoney'],true);
            $list['h_config'] = json_decode($list['h_config'],true);
            $list['h_ask'] = json_decode($list['h_ask'],true);
            $list['h_uploads'] = json_decode($list['h_uploads'],true);
            $provinces = Db::table('j_position_provice')->select();
            $this->assign('provinces',$provinces);
            $this->assign($list);
        }
        return $this->fetch();
    }

    public function del_image(){
        $list = Db::table('house')->where('h_id','=',$_POST['h_id'])->find();
        $uploads = json_decode($list['h_uploads'],true);
        unset($uploads[$_POST['num']]);
        $json = json_encode($uploads,true);
        if(file_exists(ROOT_PATH . 'public' . DS . 'uploads'.DS.$uploads[$_POST['num']])) {
            unlink(ROOT_PATH . 'public' . DS . 'uploads' . DS . $uploads[$_POST['num']]);
        }
        Db::table('house')->where('h_id','=',$_POST['h_id'])->update(['h_uploads'=>$json]);
    }

    public function province(){
        $id = $_POST['id'];
        $data = Db::table('j_position_city')->where('province_id','=',$id)->select();
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    public function city(){
        $id = $_POST['id'];
        $data_county = Db::table('j_position_county')->where('city_id','=',$id)->select();
        return json_encode($data_county,JSON_UNESCAPED_UNICODE);
    }
    public function county(){
        $id = $_POST['id'];
        $data_town = Db::table('j_position_town')->where('county_id','=',$id)->select();
        return json_encode($data_town,JSON_UNESCAPED_UNICODE);
    }



}



?>
