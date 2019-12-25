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
}