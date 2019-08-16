<?php
namespace  app\admin\controller;
use app\admin\model\BookModel;
use think\Controller;
use app\admin\tools\Page;
use think\Db;

class Book extends Controller{
   public function index(){
       $result = BookModel::page_list($_POST);
       $this->assign('list',$result['list']);
       $this->assign('pagelist',$result['pagelist']);
       return $this->fetch();
   }

    public function update(){
        if($_POST){
            $book = new BookModel();
            $id = $_POST['b_id'];
            $data = Db::table('book')->where('b_id','=',$id)->find();
            $image1 = BookModel::upload_card($data);
            $image2 = BookModel::upload_people1($data);
            $image3 = BookModel::upload_people2($data);
            $map = array_filter($_POST);
            $map['b_card'] = $image1;
            $map['b_people1'] = $image2;
            $map['b_people2'] = $image3;
            $book->save($map,['b_id'=>$id]);
            $this->redirect('/admin/book/index');

        }else{
            $data = Db::table('book b')
                ->join('user u','u.u_id = b.bu_id','left')
                ->field('u.u_id,u.u_name,u.uh_id,b.*')
                ->where('b_id','=',$_GET['id'])
                ->find();
            $this->assign($data);
            return $this->fetch();
        }
    }

    public function add(){
        if($_POST){
            $user = Db::table('user')->where('u_id','=',$_POST['bu_id'])->find();
            $image1 = BookModel::upload_card();
            $image2 = BookModel::upload_people1();
            $image3 = BookModel::upload_people2();
            if(!empty($image1)){
                $map['b_card'] = $image1;
            }
            if(!empty($image2)){
                $map['b_people1'] = $image2;
            }
            if(!empty($image3)){
                $map['b_people2'] = $image3;
            }

            $map['bu_id'] = $user['u_id'];
            $map['b_time'] = $_POST['b_time'];
            $book = new BookModel();
            $book->save($map);
            $this->redirect('/admin/book/index');
        }else{
            $user = Db::table('user')->where('u_level','=',1)->select();
            $this->assign('users',$user);
            return $this->fetch();
        }
    }



}



?>
