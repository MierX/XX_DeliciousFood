<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends BaseController
{
    public function index()
    {

    }

    public function content()
    {
        parent::content();
        $this->display();
    }

    public function list()
    {
        parent::list();
        $this->display();
    }
}