<?php
namespace Home\Controller;

use \Home\Controller\BaseController;
use Think\Controller;
use Think\Db;

class IndexController extends BaseController
{
    public function index()
    {
        $this->assign('title','豆果美食_菜谱_菜谱大全_优质美食社区');
        $this->display();
    }

    public function login()
    {
        if($_POST)
        {
            $userInfo = D('User') -> field('*') -> where(['username' => $_POST['username'], 'password' => $_POST['password']]) -> find();
            if(empty($userInfo))
            {
                echo 'error';
            }
            elseif ($userInfo['status'] == 0)
            {
                echo 'close';
            }
            else
            {
                $_SESSION = $userInfo;
                unset($_SESSION['password']);
                $_SESSION['addtime'] = date('Y-m-d H:i:s', $_SESSION['addtime']);
                $_SESSION['isLogin'] = 1;
                echo 'success';
            }
            exit;
        }
        $this->assign('title','登录 - 豆果美食');
        $this->display();
    }

    public function register()
    {
        $this->assign('title','注册 - 豆果美食');
        $this->display();
    }
}