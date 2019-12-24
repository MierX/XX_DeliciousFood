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
        $result = false;
        if($_POST) $result = D($_POST['table'])->where(['id' => $_POST['id']])->save([$_POST['field'] => $_POST['value']]);
        $result = $result ? true : false;
        echo $result;
    }

    public function changeV2()
    {
        $result = false;
        if($_GET) $result = D($_GET['table'])->where($_GET['where'])->save($_GET['save']);
        $result = $result ? true : false;
        echo $result;
    }

    public function edit()
    {
        if($_GET) $data = D($_GET['table'])->field('*')->where($_GET['where'])->find();
        if($_POST)
        {
            if($_POST['id'])
            {
                $result = D($_GET['table'])->where(['id' => $_POST['id']])->save($_POST);
            }
            else
            {
                $_POST['addtime'] = time();
                $result = D($_GET['table'])->add($_POST);
            }
            $result = $result ? true : false;
            echo $result;
            exit;
        }
        $this->assign('data',$data);
    }

    public function del()
    {
        $result = false;
        if($_GET)
        {
            $result = D($_GET['table'])->where($_GET['where'])->delete();
            $result = $result ? true : false;
        }
        echo $result;
    }

    public function out()
    {
        session('admin',null);
        echo true;
    }
}