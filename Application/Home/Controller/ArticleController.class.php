<?php
namespace Home\Controller;

use Think\Controller;
use Think\Db;

class ArticleController extends BaseController
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

    public function content()
    {
        parent::content();
        $this->display();
    }
}