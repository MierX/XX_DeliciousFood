<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        parent::index();
        $this->assign('title','豆果美食_菜谱_菜谱大全_优质美食社区');
        $this->display();
    }
}