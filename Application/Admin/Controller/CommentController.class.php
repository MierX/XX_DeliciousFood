<?php
namespace Admin\Controller;

use Think\Controller;

class CommentController extends BaseController
{
    public function index()
    {

    }

    public function list()
    {
        parent::list();
        $data = $this->view->get('data');
        foreach ($data as $key => &$value)
        {
            $value['menu'] = D('Menu')->field('title')->where(['id' => $value['mid']])->find()['title'];
        }
        $this->assign('data',$data);
        $this->display();
    }
}