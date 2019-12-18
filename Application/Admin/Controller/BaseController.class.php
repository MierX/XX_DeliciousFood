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

    public function list()
    {
        $page = (intval(I('page')) > 0) ? intval(I('page')) : 1;
        $size = (intval(I('size')) > 0) ? intval(I('size')) : 10;
        $data = D($_GET['table'])->field('*')->where($_GET['where'])->order('id asc')->page($page.",".$size)->select();
        $count = D($_GET['table'])->field('*')->where($_GET['where'])->count();

        $this->assign('page',$page);
        $this->assign('count',$count);
        $this->assign('data',$data);
    }

    public function out()
    {
        session('admin',null);
        echo true;
    }
}