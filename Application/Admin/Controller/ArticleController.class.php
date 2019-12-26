<?php
namespace Admin\Controller;

use Think\Controller;

class ArticleController extends BaseController
{
    public function index()
    {

    }

    public function list()
    {
        parent::list();
        $this->display();
    }

    public function edit()
    {
        parent::edit();
        $this->display();
    }
}