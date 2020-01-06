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

        $data = $this->view->get('data');
        foreach ($data as $key => &$value)
        {
            $fids = array_column(D('MenuFoods')->field('fid')->where(['mid' => $value['id']])->order('addtime desc,id asc')->select(),'fid');
            $value['menuFoods'] = $fids ?  implode(',',array_column(D('Foods')->field('name')->where(['id' => ['in', $fids]])->select(),'name')) : '这个菜谱没有添加食材~';
        }

        $this->assign('data',$data);
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

        $menuFoods = D('MenuFoods')->field('*')->where(['mid' => $_GET['where']['id']])->order('addtime desc,id asc')->select();
        foreach ($menuFoods as $key => &$value)
        {
            $value['name'] = D('Foods')->field('name')->where(['id' => $value['fid']])->find()['name'];
            $value['desc'] = D('Foods')->field('desc')->where(['id' => $value['fid']])->find()['desc'];
        }

        $fids = array_column($menuFoods,'fid');
        $mids = array_column(D('MenuFoods')->field('mid')->where(['fid' => ['in', $fids], 'mid' => ['neq', $_GET['where']['id']]])->select(),'mid');
        $recommend = $mids ? D('Menu')->field('*')->where(['id' => ['in', $mids], 'status' => 1])->order('addtime desc,hot desc')->limit(6)->select() : [];

        $isCollection = D('collection')->field('id')->where(['uid' => $_SESSION['user']['id'], 'mid' => $_GET['where']['id']])->find() ? 1 : 0;
        $comment = D('Comment')->field('*')->where(['mid' => $_GET['where']['id']])->order('addtime desc')->select();
        foreach ($comment as $key => &$value)
        {
            if($value['status'] != 1) $value['content'] = "<span style='color: red'>该评论已被管理员删除！！</span>";
        }


        if(count($recommend) == 6) $this->assign('recommend',$recommend);
        $this->assign('menuFoods',$menuFoods);
        $this->assign('isCollection',$isCollection);
        $this->assign('comment',$comment);
        $this->display();
    }

    public function foods()
    {
        if($_POST) $result = D('Foods')->field('id,name,dose')->where(['type' => $_POST['type'], 'status' => 1])->order('addtime desc')->select();
        $result = $result ? json_encode($result) : false;
        echo $result;
    }
}