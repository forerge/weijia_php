<?php
namespace  app\admin\controller;
use think\Controller;
use app\admin\model\AdminModel;
use think\Db;

class Admin extends Controller{
   public function index(){
       $adm = new AdminModel();
       $list =$adm::where('a_status','=',1)->paginate(6);
       $page = $list->render();
       $this->assign('list',$list);
       $this->assign('page',$page);
       return $this->fetch();
   }

    public function add(){
        if($_POST){
            $result = AdminModel::add_data($_POST);
            if(empty($result)){
                echo '请输入完整！';
            }else{
                $adm = new AdminModel();
                if($adm->save($result)){
                    $this->success('添加成功','/admin/admin/index',1);
                }else{
                    $this->error('添加失败！');
                }
            }
        }else{
            return view();
        }
    }

    public function update(){
        if($_POST){
            $adm = new AdminModel();
            $result = AdminModel::update_data($_POST);
            if($adm->save($result[0],['a_id'=>$result[1]])){
                $this->success('修改成功','/admin/admin/index');
            }else{
                $this->error('修改失败');
            }
        }else{
            $id = $_GET['id'];
            $list = Db::table('admin')->where('a_id','=',$id)->find();
            $this->assign($list);
            return $this->fetch();
        }
    }

    public function revise_pwd(){
        if($_POST){
            var_dump($_POST);
        }else{
            return $this->fetch();
        }
    }

    public function del(){
        $id = intval($_POST['id']);
        Db::table('admin')->where('a_id','=',$id)->update(['a_status'=>-1]);
    }

    public function come(){
        return $this->fetch();
    }

}



?>
