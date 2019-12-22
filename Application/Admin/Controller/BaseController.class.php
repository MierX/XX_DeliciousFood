<?php
namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    public function _initialize()
    {
        if(!$_SESSION['admin']['isLogin'])
        {
            $this->login();
            exit;
        }
    }

    public function index()
    {

    }

    public function content()
    {
        $title = $_GET['title'];
        $data = D($_GET['table'])->where($_GET['where'])->find();

        $this->assign('title',$title);
        $this->assign('data',$data);
    }

    public function list()
    {
        $title = $_GET['title'];
        $count = D($_GET['table'])->field('*')->where($_GET['where'])->count();
        $data = D($_GET['table'])->field('*')->where($_GET['where'])->select();

        $this->assign('title',$title);
        $this->assign('count',$count);
        $this->assign('data',$data);
    }

    public function change()
    {
        $result = D($_POST['table'])->where(['id' => $_POST['id']])->save([$_POST['field'] => $_POST['value']]);
        echo $result;
    }

    public function out()
    {
        session('admin',null);
        echo true;
    }
}