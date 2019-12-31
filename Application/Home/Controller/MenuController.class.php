<?php
namespace Home\Controller;

use Think\Controller;
use Think\Db;

class MenuController extends BaseController
{
    public function index()
    {

    }

    public function list()
    {
        parent::special();
        parent::list();
        $this->display();
    }

    public function edit()
    {
        parent::edit();
        $this->display('edit');
    }

    public function content()
    {
        parent::content();
        $this->display();
    }

    public function foods()
    {
        if($_POST) $result = D('Foods')->field('id,name,dose')->where(['type' => $_POST['type'], 'status' => 1])->order('addtime desc')->select();
        $result = $result ? json_encode($result) : false;
        echo $result;
    }
}