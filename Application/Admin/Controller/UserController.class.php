<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends BaseController
{
    public function index()
    {

    }

    public function list()
    {
        parent::list();
        $this->assign('title','用户管理 - 用户列表');
        $this->display();
    }
}